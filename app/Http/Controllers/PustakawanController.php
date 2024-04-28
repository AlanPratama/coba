<?php

namespace App\Http\Controllers;

use App\Models\t_admin;
use Illuminate\Http\Request;

class PustakawanController extends Controller
{
    public function store(Request $req)
    {
        $req->validate([
            'f_nama' => 'required',
            'f_username' => 'required|unique:t_admin,f_username',
            'f_password' => 'required',
            'f_level' => '',
            'f_status' => 'required',
        ]);

        $admin = new t_admin();
        $admin->f_nama = $req->f_nama;
        $admin->f_username = $req->f_username;
        $admin->f_password = bcrypt($req->f_password);
        $admin->f_level = 'Pustakawan';
        $admin->f_status = $req->f_status;
        $admin->save();

        return redirect()->back()->with('success', 'Berhasil Menambah Akun '. $admin->f_level . ' Baru');
    }

    public function update(Request $req, $id)
    {
        $admin = t_admin::findOrFail($id);

        if (!$admin) {
            return redirect()->back()->with('error', 'Akun Tidak Ditemukan!');
        }

        $req->validate([
            'f_nama' => 'required',
            'f_username' => 'required|unique:t_admin,f_username,'. $id . ',f_id',
            'f_password' => '',
            'f_level' => '',
            'f_status' => 'required',
        ]);

        $admin->f_nama = $req->f_nama;
        $admin->f_username = $req->f_username;

        if ($req->f_password) {
            $admin->f_password = bcrypt($req->f_password);
        }

        $admin->f_level = 'Pustakawan';
        $admin->f_status = $req->f_status;
        $admin->save();

        return redirect()->back()->with('success', 'Berhasil Menambah Akun '. $admin->f_level . ' Baru');
    }

    public function destroy($id)
    {
        $admin = t_admin::findOrFail($id);

        if (!$admin) {
            return redirect()->back()->with('error', 'Akun Tidak Ditemukan!');
        }

        if ($admin->peminjaman) {
            $admin->peminjaman->each(function($peminjaman) {
                $peminjaman->detailpeminjaman->delete();
                $peminjaman->delete();
            });
        }

        $admin->delete();

        return redirect()->back()->with('success', 'Berhasil Menghapus Akun!');
    }
}
