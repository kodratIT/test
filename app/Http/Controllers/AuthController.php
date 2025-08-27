<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthControllermanual extends Controller
{
    // Proses register
    public function daftar(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|unique:users,email',
        'password' => 'required|string|min:6',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    return redirect()->route('masuk')->with('success', 'Pendaftaran berhasil, silakan login.');
}


   // Proses login
public function masuk(Request $request)
{
    // Validasi input form
    $request->validate([
        'email'    => 'required|email',
        'password' => 'required',
    ]);

    // Cek apakah email sudah terdaftar di tabel pengguna
    $user = \App\Models\User::where('email', $request->email)->first();

    if (!$user) {
        // Email tidak ditemukan
        return back()->withErrors([
            'email' => 'Akun dengan email tersebut belum terdaftar.',
        ])->withInput();
    }

    // Coba login dengan Auth::attempt
    if (Auth::attempt([
        'email'    => $request->email,
        'password' => $request->password
    ])) {
        // Jika login berhasil, arahkan ke dashboard
        return redirect()->route('profile');
    }

    // Jika password salah
    return back()->withErrors([
        'password' => 'Password yang dimasukkan salah.',
    ])->withInput();
}



    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('/');
    }
}
