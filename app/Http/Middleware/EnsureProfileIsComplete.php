<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureProfileIsComplete
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Asumsi profil disimpan di relasi user->identitas
        $identitas = $user->identitas; // pastikan relasi ada di model User

        if (
            !$user->name ||
            !$user->email ||
            !$identitas ||
            !$identitas->nama_badan_usaha ||
            !$identitas->nib ||
            !$identitas->email_perusahaan ||
            !$identitas->alamat_kantor_pusat ||
            !$identitas->telepon_kantor_pusat ||
            !$identitas->nama_kontak_person ||
            !$identitas->jabatan_kontak_person ||
            !$identitas->email_kontak_person ||
            !$identitas->telepon_kontak_person
        ) {
            // Biarkan akses ke halaman profile atau logout
            if ($request->is('profile') || $request->is('logout')) {
                return $next($request);
            }

            return redirect('/profile')->with('error', 'Silakan lengkapi seluruh data profil terlebih dahulu.');
        }

        return $next($request);
    }
}
