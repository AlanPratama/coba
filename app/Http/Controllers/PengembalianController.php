<?php

namespace App\Http\Controllers;

use App\Models\t_detailbuku;
use App\Models\t_peminjaman;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\t_detailpeminjaman;

class PengembalianController extends Controller
{
    public function update(Request $req, $id)
    {
        $req->validate([
            'f_idanggota' => 'required',
            'f_idadmin' => 'required',
            'f_iddetailbuku' => 'required',
            'f_tanggalpeminjaman' => 'required',
            'f_tanggalkembali' => 'required',
        ]);


        $peminjaman = t_peminjaman::findOrFail($id);

        if (!$peminjaman) {
            return redirect()->back()->with('error', 'INVALID! ENTRI PENGEMBALIAN TIDAK DITEMUKAN!');
        }

        $peminjaman->f_idanggota = $req->f_idanggota;
        $peminjaman->f_idadmin = $req->f_idadmin;
        $peminjaman->f_tanggalpeminjaman = $req->f_tanggalpeminjaman;
        $peminjaman->save();

        $peminjaman->detailPeminjaman->f_tanggalkembali = $req->f_tanggalkembali;

        $peminjaman->detailPeminjaman->f_iddetailbuku = $req->f_iddetailbuku;

        $peminjaman->detailPeminjaman->save();

        return redirect()->back()->with('success', 'BERHASIL MENGUPDATE ENTRI PEMINJAMAN');
    }

    public function destroy($id)
    {
        $peminjaman = t_peminjaman::findOrFail($id);

        if (!$peminjaman) {
            return redirect()->back()->with('error', 'INVALID! ENTRI PENGEMBALIAN TIDAK DITEMUKAN!');
        }

        $peminjaman->detailPeminjaman->delete();
        $peminjaman->delete();

        return redirect()->back()->with('success', 'BERHASIL MENGHAPUS ENTRI PENGEMBALIAN!');
    }


    public function rollback($id)
    {
        $dPeminjaman = t_detailpeminjaman::findOrFail($id);

        if (!$dPeminjaman) {
            return redirect()->back()->with('error', 'INVALID! ENTRI PENGEMBALIAN TIDAK DITEMUKAN!');
        }

        $userPeminjaman = t_detailpeminjaman::where('f_status', 'Dipinjam')->whereHas('peminjaman', function($q) use($dPeminjaman) {
            $q->where('f_idanggota', $dPeminjaman->peminjaman->f_idanggota);
        })->get();

        if ($userPeminjaman->count() >= 3) {
            return redirect()->back()->with('error', 'MAKSIMAL ENTRI PEMINJAMAN ADALAH 3/USER!');
        }

        
        $dPeminjaman->detailBuku->save();

        $dPeminjaman->f_tanggalkembali = null;
        $dPeminjaman->f_status = 'Dipinjam';
        $dPeminjaman->save();

        return redirect()->back()->with('success', 'BERHASIL MENGEMBALIKAN ENTRI MENJADI ENTRI PEMINJAMAN!');
    }

    public function streamPdf()
    {
        $dPeminjaman = t_detailpeminjaman::where('f_status', 'Dikembalikan')->whereHas('peminjaman', function ($q) {
            $q->orderBy('f_tanggalpeminjaman', 'asc');
        })->get();

        $pdf = Pdf::loadView('pages.admin.PDF.pdfPengembalian', compact('dPeminjaman'));

        return $pdf->stream('entri-peminjaman.pdf');
    }


    public function downloadPdf()
    {
        $dPeminjaman = t_detailpeminjaman::where('f_status', 'Dikembalikan')->whereHas('peminjaman', function ($q) {
            $q->orderBy('f_tanggalpeminjaman', 'asc');
        })->get();

        $pdf = Pdf::loadView('pages.admin.PDF.pdfPengembalian', compact('dPeminjaman'));

        return $pdf->download('entri-pengembalian.pdf');
    }
}
