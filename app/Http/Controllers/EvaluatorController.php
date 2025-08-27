<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pengajuan; 
use Illuminate\Support\Facades\Auth;
use App\Models\EvaluasiPengajuan;


class EvaluatorController extends Controller
{
    // === Bagian Manajemen Evaluator ===


    public function index()
{
    $evaluators = User::with('identitasTimAdmin')
        ->where('role_pengguna', 'evaluator')
        ->get();

    return view('kelolaevaluator', compact('evaluators'));
}

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'pangkat'  => 'nullable|string|max:100',
        ]);

        User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => bcrypt($request->password),
            'role_pengguna' => 'evaluator',
            'pangkat'       => $request->pangkat,
        ]);

        return redirect()->route('evaluator.index')
            ->with('success', 'Evaluator berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // jangan sampai menghapus diri sendiri kalau lagi login sebagai evaluator
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Anda tidak bisa menghapus akun sendiri.');
        }

        $user->delete();

        return redirect()->route('evaluator.index')
            ->with('success', 'Evaluator berhasil dihapus');
    }

    // === Bagian Proses Evaluasi Pengajuan ===
  public function daftarPengajuan()
{
    $evaluatorId = Auth::id(); 

   $pengajuanList = Pengajuan::where('evaluator_id', $evaluatorId)
        ->orderBy('created_at', 'desc')
        ->get();

    return view('evaluator.daftar_pengajuan', compact('pengajuanList'));
}



    public function showPengajuan($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        return view('evaluator.show', compact('pengajuan'));
    }

    public function updatePengajuan(Request $request, $id)
    {
        $request->validate([
            'status'             => 'required|in:disetujui,ditolak',
            'catatan_evaluator'  => 'nullable|string',
        ]);

        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->status            = $request->status;
        $pengajuan->catatan_evaluator = $request->catatan_evaluator;
        $pengajuan->evaluator_id      = Auth::id(); // simpan evaluator yang login
        $pengajuan->save();

        return redirect()->route('evaluator.pengajuan')
            ->with('success', 'Pengajuan berhasil dievaluasi.');
    }
}
