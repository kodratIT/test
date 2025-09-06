<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GantiKataSandi extends Controller
{
    public function update(Request $request)
    {

        // Validasi input
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $userId = Auth::id();

        // 🔹 Ambil password lama langsung dari database
        $hashedPassword = DB::table('users')
            ->where('id', $userId)
            ->value('password');

        // Cek apakah old_password sesuai


        if (!Hash::check($request->old_password, $hashedPassword)) {
            return back()->with('error', 'Kata sandi lama tidak sesuai.');
        }


        // Update password baru
        DB::table('users')
            ->where('id', $userId)
            ->update([
                'password' => Hash::make($request->new_password),
                'updated_at' => now(),
            ]);

        return back()->with('success', 'Kata sandi berhasil diperbarui.');
    }
}
