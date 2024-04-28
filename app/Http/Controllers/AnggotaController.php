<?php

namespace App\Http\Controllers;

use App\Models\t_anggota;
use App\Models\t_detailpeminjaman;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function store(Request $req)
    {
        $req->validate([
            'f_nama' => 'required',
            'f_username' => 'required|unique:t_anggota,f_username',
            'f_password' => 'required',
            'f_tempatlahir' => 'required',
            'f_tanggallahir' => 'required',
        ]);

        $anggota = new t_anggota();
        $anggota->f_nama = $req->f_nama;
        $anggota->f_username = $req->f_username;
        $anggota->f_password = bcrypt($req->f_password);
        $anggota->f_tempatlahir = $req->f_tempatlahir;
        $anggota->f_tanggallahir = $req->f_tanggallahir;
        $anggota->save();

        return redirect()->back()->with('success', 'BERHASIL MENAMBAH ANGGOTA BARU!');
    }

    public function update(Request $req, $id)
    {
        $anggota = t_anggota::findOrFail($id);

        if (!$anggota) {
            return redirect()->back()->with('error', 'ANGGOTA TIDAK DITEMUKAN!');
        }

        $req->validate([
            'f_nama' => 'required',
            'f_username' => 'required|unique:t_anggota,f_username,'.$anggota->f_id.',f_id',
            'f_tempatlahir' => 'required',
            'f_tanggallahir' => 'required',
        ]);

        $anggota->f_nama = $req->f_nama;
        $anggota->f_username = $req->f_username;
        
        if ($req->f_password) {
            $anggota->f_password = bcrypt($req->f_password);
        }

        $anggota->f_tempatlahir = $req->f_tempatlahir;
        $anggota->f_tanggallahir = $req->f_tanggallahir;
        $anggota->save();

        return redirect()->back()->with('success', 'BERHASIL MENGUPDATE ANGGOTA!');

    }

    public function destroy($id)
    {
        $anggota = t_anggota::findOrFail($id);

        if (!$anggota) {
            return redirect()->back()->with('error', 'ANGGOTA TIDAK DITEMUKAN!');
        }

        if ($anggota->peminjaman) {
            $anggota->peminjaman->each(function($peminjaman) {
                $peminjaman->detailpeminjaman->delete();
                $peminjaman->delete();
            });
        }

        $anggota->delete();

        return redirect()->back()->with('success', 'BERHASIL MENGHAPUS ANGGOTA');
    }





    public function historiPeminjaman()
    {
        $pgMenu = 'Histori Peminjaman';
        $dPeminjaman = t_detailpeminjaman::whereHas('peminjaman', function($q) {
            $q->where('f_idanggota', auth()->guard('anggota')->user()->f_id);
        })->where('f_status', 'Dipinjam') ->get();

        return view('pages.anggota.profile.historiPeminjaman', compact('pgMenu', 'dPeminjaman'));
    }


    public function historiPengembalian()
    {
        $pgMenu = 'Histori Pengembalian';
        $dPeminjaman = t_detailpeminjaman::whereHas('peminjaman', function($q) {
            $q->where('f_idanggota', auth()->guard('anggota')->user()->f_id);
        })->where('f_status', 'Dikembalikan') ->get();

        return view('pages.anggota.profile.historiPengembalian', compact('pgMenu', 'dPeminjaman'));
    }

}
