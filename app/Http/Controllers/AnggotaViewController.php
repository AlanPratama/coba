<?php

namespace App\Http\Controllers;

use App\Models\t_detailbuku;
use Illuminate\Http\Request;

class AnggotaViewController extends Controller
{
    public function homepage()
    {
        $pgMenu = 'Homepage';
        $buku = t_detailbuku::where('f_status', 'Tersedia')->get();

        return view('pages.anggota.homepage', compact('pgMenu', 'buku'));
    }
    
    public function buku(Request $req)
    {
        $pgMenu = 'Buku';
        if ($req->judul) {
            $buku = t_detailbuku::where('f_status', 'Tersedia')
                ->whereHas('buku', function($q) use($req) {
                    $q->where('f_judul', 'LIKE', '%' . $req->judul . '%');
                })
                ->get();
        } else {
            $buku = t_detailbuku::where('f_status', 'Tersedia')->get();
        }

        return view('pages.anggota.buku', compact('pgMenu', 'buku'));
    }

    public function bukuDetail($id)
    {
        $pgMenu = 'Buku';
        $buku = t_detailbuku::find($id);

        return view('pages.anggota.bukuDetail', compact('buku', 'pgMenu'));
    }
}
