<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;

class BadanusahaController extends Controller
{
    public function index()
    {
        $penggunas = User::with('identitasPengguna')
            ->where('role_pengguna', 'pengguna')
            ->get();
    
        return view('kelolabadanusaha', compact('penggunas'));
    }
  
    public function store(Request $request)
    {
        // contoh: simpan data kepala bidang baru
        User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => bcrypt($request->password),
            'role_pengguna' => 'pengguna',
            'pangkat'       => $request->pangkat, // simpan ke DB
        ]);

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil dihapus');
    }
}