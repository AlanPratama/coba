<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class notAnggota
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('anggota')->user()) {
            return $next($request);
        }

        return redirect()->back()->with('error', 'KAMU BUKAN ADMIN/PUSTAKAWAN! AKSES AKUN KAMU DIBATASI!');
    }
}
