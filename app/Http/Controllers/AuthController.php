<?php

namespace App\Http\Controllers;

use App\Models\t_admin;
use App\Models\t_anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // ANGGOTA || ANGGOTA || ANGGOTA || ANGGOTA || ANGGOTA || ANGGOTA 
    public function anggotaView() {
        return view('pages.auth.loginAnggota');
    }

    public function anggotaProcess(Request $req)
    {
        $req->validate([
            'f_username' => 'required',
            'f_password' => 'required'
        ]);

        $akun = t_anggota::firstWhere('f_username', $req->f_username);

        if (!$akun) {
            return redirect()->back()->with('error', 'AKUN TIDAK DITEMUKAN!');
        }

        if (Auth::guard('anggota')->attempt(['f_username' => $req->f_username, 'password' => $req->f_password])) {
            return redirect('/');
        } else {
            return redirect()->back()->with('error', 'PASSWORD SALAH!');
        }
    }





    // ADMIN || ADMIN || ADMIN || ADMIN || ADMIN || ADMIN 
    public function adminView() {
        return view('pages.auth.loginAdmin');
    }

    public function adminProcess(Request $req)
    {
        $req->validate([
            'f_username' => 'required',
            'f_password' => 'required',
        ]);

        $akun = t_admin::firstWhere('f_username', $req->f_username);

        if (!$akun) {
            return redirect()->back()->with('error', 'AKUN TIDAK DITEMUKAN!');
        }

        if ($akun->f_status == 'Aktif') {
            if (Auth::guard('admin')->attempt(['f_username' => $req->f_username, 'password' => $req->f_password])) {
                // dd(Auth::guard('admin')->user());
                return redirect('/admin/dashboard')->with('success', 'BERHASIL LOGIN!');
            } else {
                return redirect()->back()->with('error', 'PASSWORD SALAH!');
            }
        } else {
            return redirect()->back()->with('error', 'STATUS AKUN TIDAK AKTIF!');
        }
    }


    public function logout()
    {
        if (Auth::guard('admin')->user()) {
            Auth::guard('admin')->logout();

            return redirect('/auth/admin');

        }   

        if (Auth::guard('anggota')->user()) {
            Auth::guard('anggota')->logout();

            return redirect('/auth/anggota');
        }
    }
}
