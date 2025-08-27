<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class KepalaBidangController extends Controller
{
    public function index()
    {
        $kepalaBidang = User::where('role_pengguna', 'kabid')->get();
        return view('kelolapegawai', compact('kepalaBidang'));
    }

    public function store(Request $request)
    {
        // contoh: simpan data kepala bidang baru
        User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => bcrypt($request->password),
            'role_pengguna' => 'kabid',
            'pangkat'       => $request->pangkat, // simpan ke DB
        ]);

        return redirect()->route('kepala-bidang.index')->with('success', 'Kepala Bidang berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('kepala-bidang.index')->with('success', 'Kepala Bidang berhasil dihapus');
    }
}
