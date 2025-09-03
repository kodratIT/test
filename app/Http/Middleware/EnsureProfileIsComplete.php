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
            !$identitas->namabadanusaha ||
            !$identitas->nib ||
            !$identitas->email_perusahaan ||
            !$identitas->alamatkantorpusat ||
            !$identitas->notelpkantorpusat ||
            !$identitas->contact_person_nama ||
            !$identitas->contact_person_jabatan ||
            !$identitas->contact_person_email ||
            !$identitas->contact_person_no_telp
        ) {
            // Biarkan akses ke halaman profileidentitas atau logout
            if ($request->is('profileidentitas') || $request->is('logout') || $request->is('profile*')) {
                return $next($request);
            }

            return redirect('/profileidentitas')->with('error', 'Silakan lengkapi seluruh data profil terlebih dahulu.');
        }

        return $next($request);
    }
}
