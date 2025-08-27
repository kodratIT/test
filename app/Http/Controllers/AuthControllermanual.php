<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthControllermanual extends Controller
{
    // Proses daftar
    public function daftar(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'role_pengguna' => 'pengguna', // default role
        ]);

        return redirect()->route('masuk')->with('success', 'Pendaftaran berhasil, silakan masuk.');
    }

    // Proses masuk
    public function masuk(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Jika role adalah "pengguna", cek identitas
            if ($user->role_pengguna === 'pengguna') {
                $identitasLengkap = $user->identitas &&
                                    $user->identitas->nama &&
                                    $user->identitas->email &&
                                    $user->identitas->namabadanusaha &&
                                    $user->identitas->nib &&
                                    $user->identitas->email_perusahaan &&
                                    $user->identitas->alamatkantorpusat &&
                                    $user->identitas->notelpkantorpusat &&
                                    $user->identitas->alamatkantorcabang &&
                                    $user->identitas->notelpkantorcabang &&
                                    $user->identitas->contact_person_nama &&
                                    $user->identitas->contact_person_jabatan &&
                                    $user->identitas->contact_person_email &&
                                    $user->identitas->contact_person_no_telp;

                if ($identitasLengkap) {
                    return redirect()->route('berandapengguna');
                } else {
                    return redirect()->route('profileidentitas');
                }
            }

            // Jika role lain, arahkan sesuai dashboard role
            switch ($user->role_pengguna) {
                case 'kabid':
                    return redirect()->route('berandakabid');
                case 'evaluator':
                    return redirect()->route('berandaevaluator');
                case 'kadis':
                    return redirect()->route('berandakadis');
                default:
                    return redirect()->route('home');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect('/masuk');
    }
}
