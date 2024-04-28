<?php

namespace App\Http\Controllers;

use App\Models\t_anggota;
use App\Models\t_buku;
use App\Models\t_detailbuku;
use App\Models\t_detailpeminjaman;
use App\Models\t_peminjaman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

use function Symfony\Component\String\b;

class PeminjamanController extends Controller
{
    public function store(Request $req)
    {
        $req->validate([
            'f_idanggota' => 'required',
            'f_iddetailbuku' => 'required',
            'f_tanggalpeminjaman' => 'required',
        ]);

        $anggota = t_anggota::findOrFail($req->f_idanggota);
        $dBuku = t_detailbuku::findOrFail($req->f_iddetailbuku);

        if (!$anggota) {
            return redirect()->back()->with('error', 'PEMINJAM TIDAK DITEMUKAN / TIDAK VALID!');
        }

        if (!$dBuku) {
            return redirect()->back()->with('error', 'BUKU TIDAK DITEMNUKAN / TIDAK VALID!');
        }

        $peminjaman = t_detailpeminjaman::where('f_status', 'Dipinjam')->whereHas('peminjaman', function($q) use($req) {
            $q->where('f_idanggota', $req->f_idanggota);
        })->get();

        if ($peminjaman->count() >= 3) {
            return redirect()->back()->with('error', 'MAKSIMAL ENTRI PEMINJAMAN ADALAH 3/USER!');
        }

        $peminjaman = new t_peminjaman();
        $peminjaman->f_idanggota = $req->f_idanggota;
        $peminjaman->f_idadmin = Auth::guard('admin')->user()->f_id;
        $peminjaman->f_tanggalpeminjaman = $req->f_tanggalpeminjaman;
        $peminjaman->save();

        $dPeminjaman = new t_detailpeminjaman();
        $dPeminjaman->f_idpeminjaman = $peminjaman->f_id;
        $dPeminjaman->f_iddetailbuku = $req->f_iddetailbuku;
        $dPeminjaman->f_tanggalkembali = null;
        $dPeminjaman->f_status = 'Dipinjam';
        $dPeminjaman->save();

        

        return redirect()->back()->with('success', 'BERHASIL MENAMBAH ENTRI PEMINJAMAN BARU');
    }


    public function update(Request $req, $id)
    {
        $req->validate([
            'f_idanggota' => 'required',
            'f_idadmin' => 'required',
            'f_iddetailbuku' => 'required',
            'f_tanggalpeminjaman' => 'required',
        ]);

        $anggota = t_anggota::findOrFail($req->f_idanggota);
        $dBuku = t_detailbuku::findOrFail($req->f_iddetailbuku);

        if (!$anggota) {
            return redirect()->back()->with('error', 'PEMINJAM TIDAK DITEMUKAN / TIDAK VALID!');
        }

        if (!$dBuku) {
            return redirect()->back()->with('error', 'BUKU TIDAK DITEMNUKAN / TIDAK VALID!');
        }

        $peminjaman = t_peminjaman::findOrFail($id);
        if ($req->f_idanggota != $peminjaman->f_idanggota) {
            $userNewPeminjaman = t_detailpeminjaman::where('f_status', 'Dipinjam')->whereHas('peminjaman', function($q) use($req) {
                $q->where('f_idanggota', $req->f_idanggota);
            })->get();

            if ($userNewPeminjaman->count() >= 3) {
                return redirect()->back()->with('error', 'MAKSIMAL ENTRI PEMINJAMAN ADALAH 3/USER!');
            }

            $peminjaman->f_idanggota = $req->f_idanggota;
        } else {
            $peminjaman->f_idanggota = $req->f_idanggota;
        }
        $peminjaman->f_idadmin = $req->f_idadmin;
        $peminjaman->f_tanggalpeminjaman = $req->f_tanggalpeminjaman;
        $peminjaman->save();
        $peminjaman->detailPeminjaman->f_iddetailbuku = $req->f_iddetailbuku;

        $peminjaman->detailPeminjaman->save();

        return redirect()->back()->with('success', 'BERHASIL MENGUPDATE ENTRI PEMINJAMAN');
    }


    public function destroy($id)
    {
        $peminjaman = t_peminjaman::findOrFail($id);

        if (!$peminjaman) {
            return redirect()->back()->with('error', 'INVALID! PEMINJAMAN TIDAK DITEMUKAN!');
        }

        $peminjaman->detailPeminjaman->detailBuku->save();

        $peminjaman->detailPeminjaman->delete();
        $peminjaman->delete();

        return redirect()->back()->with('success', 'BERHASIL MENGHAPUS ENTRI PEMINJAMAN!');
    }




    public function dikembalikan($id)
    {
        $dPeminjaman = t_detailpeminjaman::findOrFail($id);

        $dPeminjaman->detailBuku->save();

        $dPeminjaman->f_tanggalkembali = Carbon::now()->toDateString();
        $dPeminjaman->f_status = 'Dikembalikan';
        $dPeminjaman->save();

        return redirect()->back()->with('success', 'PEMINJAM TELAH MENGEMBALIKAN BUKU! PEMINJAMAN TELAH SELESAI!');
    }


    public function streamPdf()
    {
        $dPeminjaman = t_detailpeminjaman::where('f_status', 'Dipinjam')->whereHas('peminjaman', function($q) {
            $q->orderBy('f_tanggalpeminjaman', 'asc');
        })->get();

        $pdf = Pdf::loadView('pages.admin.PDF.pdfPeminjaman', compact('dPeminjaman'));

        return $pdf->stream('entri-peminjaman.pdf');
    }


    public function downloadPdf()
    {
        $dPeminjaman = t_detailpeminjaman::where('f_status', 'Dipinjam')->whereHas('peminjaman', function($q) {
            $q->orderBy('f_tanggalpeminjaman', 'asc');
        })->get();

        $pdf = Pdf::loadView('pages.admin.PDF.pdfPeminjaman', compact('dPeminjaman'));

        return $pdf->download('entri-peminjaman.pdf');
    }
}
