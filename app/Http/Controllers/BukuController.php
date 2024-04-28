<?php

namespace App\Http\Controllers;

use App\Models\t_buku;
use App\Models\t_detailbuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BukuController extends Controller
{
    public function store(Request $req)
    {

        $req->validate([
            'f_idkategori' => 'required',
            'f_judul' => 'required|unique:t_buku,f_judul',
            'f_pengarang' => 'required',
            'f_penerbit' => 'required',
            'f_deskripsi' => 'required',
            'f_gambar' => 'image|mimes:jpeg,jpg,png|max:2048', // Batasi ukuran file menjadi 2MB',
        ]);

        $buku = new t_buku();
        $gambar = null;
        if ($req->hasFile('f_gambar')) {
            $file = $req->file('f_gambar');
            $nama = Str::slug($req->f_judul) . Str::random(3) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('buku', $nama);
            $gambar = $path;
        }
        $buku->f_gambar = $gambar;

        $buku->f_idkategori = $req->f_idkategori;
        $buku->f_judul = $req->f_judul;
        $buku->f_pengarang = $req->f_pengarang;
        $buku->f_penerbit = $req->f_penerbit;
        $buku->f_deskripsi = $req->f_deskripsi;
        $buku->save();

        $dBuku = new t_detailbuku();
        $dBuku->f_idbuku = $buku->f_id;
        $dBuku->f_status = 'Tersedia';
        $dBuku->save();

        return redirect()->back()->with('success', 'BERHASIL MENAMBAH BUKU!');
    }

    // THE ID IS FROM T_DETAILBUKU MODEL!
    public function update(Request $req, $id)
    {
        $dBuku = t_detailbuku::findOrFail($id);

        if (!$dBuku) {
            return redirect()->back()->with('error', 'BUKU TIDAK DITEMUKAN!');
        }


        $req->validate([
            'f_idkategori' => 'required',
            'f_judul' => 'required|unique:t_buku,f_judul,'.$dBuku->f_id.',f_id',
            'f_pengarang' => 'required',
            'f_penerbit' => 'required',
            'f_deskripsi' => 'required',
            'f_gambar' => 'image|mimes:jpeg,jpg,png|max:2048', // Batasi ukuran file menjadi 2MB',
        ]);

        $buku = $dBuku->buku;

        if ($req->hasFile('f_gambar')) {
            if ($buku->f_gambar) {
                Storage::delete($buku->f_gambar);
            }

            $file = $req->file('f_gambar');
            $nama = Str::slug($req->f_judul) . Str::random(3) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('buku', $nama);
            $buku->f_gambar = $path;
        }

        $buku->f_idkategori = $req->f_idkategori;
        $buku->f_judul = $req->f_judul;
        $buku->f_pengarang = $req->f_pengarang;
        $buku->f_penerbit = $req->f_penerbit;
        $buku->f_deskripsi = $req->f_deskripsi;
        $buku->save();

        $dBuku->f_status = $req->f_status;
        $dBuku->save();
        
        return redirect()->back()->with('success', 'BERHASIL MENGUPDATE BUKU!');
    }

    public function destroy($id)
    {
        $dBuku = t_detailbuku::findOrFail($id);
        $buku = $dBuku->buku;
        // dd($dBuku->detailpeminjaman->count());
        if ($dBuku->detailPeminjaman->count() > 0) {
            $dBuku->detailPeminjaman->each(function($dPeminjaman) {
                $dPeminjaman->delete();
                $dPeminjaman->peminjaman->delete();
            });
        }
        $dBuku->delete();
        $buku->delete();
        
        if ($buku->f_gambar) {
            Storage::delete($buku->f_gambar);
        }

        return redirect()->back()->with('success', 'BERHASIL MENGHAPUS BUKU!');
    }
}
