<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CekProfilLengkap
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        // Kalau user login dan bukan admin
        if ($user && $user->role !== 'admin') {
            
            // Cek apakah profil tidak lengkap
            $profilTidakLengkap =
                !$user->identitas ||
                $user->identitas->nama == '' ||
                $user->identitas->email == '' ||
                $user->identitas->namabadanusaha == '' ||
                $user->identitas->nib == '' ||
                $user->identitas->email_perusahaan == '' ||
                $user->identitas->alamatkantorpusat == '' ||
                $user->identitas->notelpkantorpusat == '' ||
                $user->identitas->alamatkantorcabang == '' ||
                $user->identitas->notelpkantorcabang == '' ||
                $user->identitas->contact_person_nama == '' ||
                $user->identitas->contact_person_jabatan == '' ||
                $user->identitas->contact_person_email == '' ||
                $user->identitas->contact_person_no_telp == '';

            // Kalau profil belum lengkap dan bukan di halaman profile atau logout
            if ($profilTidakLengkap && !$request->is('profile') && !$request->is('logout')) {
                return redirect()->route('profile')
                    ->with('warning', 'Silakan lengkapi profil Anda terlebih dahulu.');
            }
        }

        // Kalau semua oke, lanjutkan request
        return $next($request);
    }
}
