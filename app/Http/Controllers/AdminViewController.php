<?php

namespace App\Http\Controllers;

use App\Models\t_admin;
use App\Models\t_anggota;
use App\Models\t_buku;
use App\Models\t_detailbuku;
use App\Models\t_detailpeminjaman;
use App\Models\t_kategori;
use App\Models\t_peminjaman;
use Illuminate\Http\Request;

class AdminViewController extends Controller
{
    public function dashboard()
    {
        $pgMenu = 'Dashboard';
        return view('pages.admin.dashboard', compact('pgMenu'));
    }


    public function peminjaman()
    {
        $pgMenu = 'Peminjaman';
        $dPeminjaman = t_detailpeminjaman::where('f_status', 'Dipinjam')->whereHas('peminjaman', function($q) {
            $q->orderBy('f_tanggalpeminjaman', 'asc');
        })->get();
        $anggota = t_anggota::orderBy('f_nama', 'asc')->get();
        $buku = t_detailbuku::where('f_status', 'Tersedia')->get();
        $admin = t_admin::orderBy('f_nama', 'asc')->get();


        return view('pages.admin.entriPeminjaman', compact('pgMenu', 'dPeminjaman', 'anggota', 'buku', 'admin'));
    }

    public function pengembalian()
    {
        $pgMenu = 'Pengembalian';
        $dPeminjaman = t_detailpeminjaman::where('f_status', 'Dikembalikan')->whereHas('peminjaman', function($q) {
            $q->orderBy('f_tanggalpeminjaman', 'asc');
        })->get();
        $anggota = t_anggota::orderBy('f_nama', 'asc')->get();
        $buku = t_detailbuku::where('f_status', 'Tersedia')->get();
        $admin = t_admin::orderBy('f_nama', 'asc')->get();


        return view('pages.admin.entriPengembalian', compact('pgMenu', 'dPeminjaman', 'anggota', 'buku', 'admin'));
    }





















    // ONLY ADMIN || ONLY ADMIN || ONLY ADMIN || ONLY ADMIN
    public function buku()
    {
        $pgMenu = 'Buku';
        $dBuku = t_detailbuku::all();
        $kategori = t_kategori::orderBy('f_kategori', 'asc')->get();

        return view('pages.admin.onlyAdmin.buku', compact('pgMenu', 'dBuku', 'kategori'));
    }

    public function bukuDetail($id)
    {
        $dBuku = t_detailbuku::find($id);

        if (!$dBuku) {
            return redirect('/admin/buku')->with('error', 'BUKU TIDAK DITEMUKAN!');
        }

        $entriPeminjaman = t_peminjaman::whereHas('detailPeminjaman', function($q) use($id) {
            $q->where('f_iddetailbuku', $id)->where('f_status', 'Dipinjam');
        })->get();

        $entriPengembalian = t_peminjaman::whereHas('detailPeminjaman', function($q) use($id) {
            $q->where('f_iddetailbuku', $id)->where('f_status', 'Dikembalikan');
        })->get();

        $pgMenu = 'Buku';

        return view('pages.admin.onlyAdmin.bukuDetail', compact('pgMenu', 'dBuku', 'entriPeminjaman', 'entriPengembalian'));
    }


    public function kategori()
    {
        $pgMenu = 'Kategori';
        $kategori = t_kategori::orderBy('f_kategori', 'asc')->with('buku')->get();

        return view('pages.admin.onlyAdmin.katetgori', compact('pgMenu', 'kategori'));
    }

    public function anggota()
    {
        $pgMenu = 'Anggota';
        $anggota = t_anggota::orderBy('f_nama', 'asc')->get();

        return view('pages.admin.onlyAdmin.anggota', compact('pgMenu', 'anggota'));
    }

    public function anggotaDetail($id)
    {
        $anggota = t_anggota::find($id);

        if (!$anggota) {
            return redirect('/admin/anggota')->with('error', 'ANGGOTA TIDAK DITEMUKAN!');
        }

        $entriPeminjaman = t_peminjaman::where('f_idanggota', $anggota->f_id)->whereHas('detailPeminjaman', function($q) {
            $q->where('f_status', 'Dipinjam');
        })->get();

        $entriPengembalian = t_peminjaman::where('f_idanggota', $anggota->f_id)->whereHas('detailPeminjaman', function($q) {
            $q->where('f_status', 'Dikembalikan');
        })->get();

        $pgMenu = 'Anggota';

        return view('pages.admin.onlyAdmin.anggotaDetail', compact('anggota', 'entriPeminjaman', 'entriPengembalian', 'pgMenu'));
    }

    public function pustakawan()
    {
        $pgMenu = 'Pustakawan';
        $pustakawan = t_admin::orderBy('f_nama', 'asc')->where('f_level', 'Pustakawan')->get();

        return view('pages.admin.onlyAdmin.pustakawan', compact('pgMenu', 'pustakawan'));
    }

    public function pustakawanDetail($id) 
    {
        $pustakawan = t_admin::find($id);

        if (!$pustakawan) {
            return redirect('/admin/pustakawan')->with('error', 'AKUN TIDAK DITEMUKAN!');
        }


        $entriPeminjaman = t_peminjaman::where('f_idadmin', $id)->whereHas('detailPeminjaman', function($q) {
            $q->where('f_status', 'Dipinjam');
        })->get();

        $entriPengembalian = t_peminjaman::where('f_idadmin', $id)->whereHas('detailPeminjaman', function($q) {
            $q->where('f_status', 'Dikembalikan');
        })->get();

        $pgMenu = 'Pustakawan';

        return view('pages.admin.onlyAdmin.pustakawanDetail', compact('pustakawan', 'entriPeminjaman', 'entriPengembalian', 'pgMenu'));

    }
}
