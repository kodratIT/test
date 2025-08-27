<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IdentitasTimAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class IdentitasTimAdminController extends Controller
{
    public function showProfile()
    {
        // Ambil identitas, buat baru jika belum ada
        $identitas = IdentitasTimAdmin::with('user')->firstOrCreate(
            ['pengguna_id' => Auth::id()],
            [] // field default kosong, nanti bisa diupdate
        );

        return view('profilevalidator', compact('identitas'));
    }



    public function showProfileKabid()
    {

        $user = Auth::user();
        // dd($user->role_pengguna);
        if ($user->role_pengguna !== "kabid") {
            abort(403, 'Unauthorized');
        }

        $identitas = \App\Models\IdentitasTimAdmin::firstOrCreate(
            ['pengguna_id' => $user->id],
            [] // kalau kosong, tetap buat instance baru
        );

        return view('profilekabid', compact('user', 'identitas'));
    }








    public function showProfileEvaluator()
    {

        $user = Auth::user();

        // ambil data identitas evaluator jika ada
        $identitas = \App\Models\IdentitasTimAdmin::where('pengguna_id', $user->id)->first();

        // kalau butuh daftar evaluator
        $evaluators = \App\Models\User::where('role_pengguna', 'evaluator')->get();

        return view('profileevaluator', compact('user', 'identitas', 'evaluators'));
    }




    public function edit()
    {
        $user = Auth::user();

        // Ambil identitas atau buat baru jika belum ada
        $identitas = IdentitasTimAdmin::firstOrCreate(
            ['pengguna_id' => $user->id],
            [] // field default kosong
        );

        return view('tim_admin.edit', [
            'user' => $user,
            'identitas' => $identitas,
        ]);
    }

    public function update(Request $request)
    {

        //dd($request->all());

        $request->validate([

            'nip' => 'nullable|digits:18',
            'pangkat' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $user = Auth::user();
        $data2 = IdentitasTimAdmin::where('pengguna_id', Auth::id())->first();

        $identitas = $user->identitasTimAdmin;

        $data = $request->except(['_token', 'foto']);
        //dd($request->all(), $request->file('foto'));

        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($identitas && $identitas->foto) {
                Storage::disk('public')->delete($identitas->foto);
            }

            $data['foto'] = $request->file('foto')->store('foto-admin', 'public');
        }


        //dd($data);
        $result = IdentitasTimAdmin::updateOrCreate(
            ['pengguna_id' => $user->id],
            $data
        );

        $identitas = IdentitasTimAdmin::with('user')->where('pengguna_id', $user->id)->first();
        $identitas->user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);


        return redirect()->back()->with('alert', [
            'type' => 'success',
            'message' => 'Profil berhasil di disimpan!'
        ]);
    }
}
