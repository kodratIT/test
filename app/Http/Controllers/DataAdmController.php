<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\IdentitasPengguna;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class DataAdmController extends Controller
{

 public function show()
{
    $user = Auth::user(); // ambil user yang sedang login

    // ambil data identitas berdasarkan pengguna_id
    $identitas = IdentitasPengguna::where('pengguna_id', $user->id)->first();

    return view('profile', compact('identitas'));
}


    public function identitas()
{
    $user = auth()->user();
    $identitas = $user->identitas; // bisa null kalau belum ada
    return view('profile', compact('identitas', 'user'));
}


    public function simpan(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'namabadanusaha' => 'required|string|max:255',
            'nib' => 'nullable|string|max:255',
            'email_perusahaan' => 'required|email',
            'alamatkantorpusat' => 'required|string',
            'notelpkantorpusat' => 'required|string',
            'alamatkantorcabang' => 'nullable|string',
            'notelpkantorcabang' => 'nullable|string',
            'contact_person_nama' => 'required|string',
            'contact_person_jabatan' => 'required|string',
            'contact_person_email' => 'required|email',
            'contact_person_no_telp' => 'required|string',
        ]);

        DB::transaction(function () use ($user, $validated) {
            // update nama di tabel users dulu
            $user->update(['name' => $validated['nama']]);

            // simpan/update data di identitas_pengguna
           $user->identitas()->updateOrCreate(
                ['pengguna_id' => $user->id],
                array_merge($validated, ['email' => $user->email])
            );

            // reload relasi supaya immediate konsisten
            $user->load('identitas');
        });

            // langsung kembalikan view, bukan redirect
            return view('profile', [
                'identitas' => $user->identitas,
                'user' => $user,
            ])->with('success', 'Profil berhasil disimpan.');

        }

        public function store(Request $request)
{
    $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'namabadanusaha' => 'required|string|max:255',
            'nib' => 'nullable|string|max:255',
            'email_perusahaan' => 'required|email',
            'alamatkantorpusat' => 'required|string',
            'notelpkantorpusat' => 'required|string',
            'alamatkantorcabang' => 'nullable|string',
            'notelpkantorcabang' => 'nullable|string',
            'contact_person_nama' => 'required|string',
            'contact_person_jabatan' => 'required|string',
            'contact_person_email' => 'required|email',
            'contact_person_no_telp' => 'required|string',
    ]);

    $user = Auth::user();

    $user->identitas()->updateOrCreate(
        ['pengguna_id' => $user->id],
        array_merge($validated, ['email' => $user->email])
    );

    // Ambil data terbaru untuk ditampilkan di halaman profile
    $identitas = $user->identitas;

    return view('profile', compact('identitas'))
           ->with('success', 'Data berhasil disimpan');
}

}
