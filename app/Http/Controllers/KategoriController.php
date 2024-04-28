<?php

namespace App\Http\Controllers;

use App\Models\t_kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function store(Request $req)
    {
        $req->validate([
            'f_kategori' => 'required|unique:t_kategori,f_kategori',
        ]);

        $kategori = new t_kategori();
        $kategori->f_kategori = $req->f_kategori;
        $kategori->save();

        return redirect()->back()->with('success', 'BERHASIL MENAMBAH KATEGORI!');
    }


    public function update(Request $req, $id)
    {
        $req->validate([
            'f_kategori' => 'required|unique:t_kategori,f_kategori,'.$id.',f_id'
        ]);

        $kategori = t_kategori::findOrFail($id);

        $kategori->f_kategori = $req->f_kategori;
        $kategori->save();

        return redirect()->back()->with('success', 'BERHASIL MENGUPDATE KATEGORI!');
    }

    public function destroy($id)
    {
        $kategori = t_kategori::findOrFail($id);

        if ($kategori->buku) {
            $kategori->buku->each(function ($buku) {
                $buku->f_idkategori = null;
                $buku->save();
            });
        }

        $kategori->delete();

        return redirect()->back()->with('success', 'BERHASIL MENGHAPUS KATEGORI!');
    }
}
