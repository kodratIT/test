<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pengajuan; 
use Illuminate\Support\Facades\Auth;
use App\Models\EvaluasiPengajuan;


class EvaluatorController extends Controller
{
    // === Bagian Dashboard Evaluator ===
    public function dashboard()
    {
        $evaluatorId = Auth::id();
        
        // Ambil semua pengajuan yang ditugaskan ke evaluator ini
        $pengajuanEvaluator = Pengajuan::where('evaluator_id', $evaluatorId)->get();
        
        // Statistik pengajuan evaluator
        $stats = [
            'laporan_masuk' => $pengajuanEvaluator->whereIn('status', ['proses evaluasi', 'evaluasi'])->count(),
            'dalam_evaluasi' => $pengajuanEvaluator->where('status', 'evaluasi')->count(),
            'menunggu_evaluasi' => $pengajuanEvaluator->where('status', 'proses evaluasi')->count(),
            'selesai_evaluasi' => $pengajuanEvaluator->whereIn('status', ['validasi', 'pengesahan', 'disetujui kadis'])->count(),
        ];
        
        // Data untuk chart (12 bulan terakhir)
        $chartData = [];
        $months = [];
        
        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $months[] = $date->format('M');
            
            // Laporan masuk ke evaluator (assigned) - fallback ke created_at jika assigned_at null
            $laporanMasuk = Pengajuan::where('evaluator_id', $evaluatorId)
                ->where(function($query) use ($date) {
                    $query->where(function($subQuery) use ($date) {
                        $subQuery->whereNotNull('assigned_at')
                                 ->whereMonth('assigned_at', $date->month)
                                 ->whereYear('assigned_at', $date->year);
                    })->orWhere(function($subQuery) use ($date) {
                        $subQuery->whereNull('assigned_at')
                                 ->whereMonth('created_at', $date->month)
                                 ->whereYear('created_at', $date->year);
                    });
                })->count();
                
            // Laporan selesai dievaluasi - fallback ke updated_at jika evaluated_at null
            $laporanSelesai = Pengajuan::where('evaluator_id', $evaluatorId)
                ->whereIn('status', ['validasi', 'pengesahan', 'disetujui kadis'])
                ->where(function($query) use ($date) {
                    $query->where(function($subQuery) use ($date) {
                        $subQuery->whereNotNull('evaluated_at')
                                 ->whereMonth('evaluated_at', $date->month)
                                 ->whereYear('evaluated_at', $date->year);
                    })->orWhere(function($subQuery) use ($date) {
                        $subQuery->whereNull('evaluated_at')
                                 ->whereMonth('updated_at', $date->month)
                                 ->whereYear('updated_at', $date->year);
                    });
                })->count();
                
            $chartData['laporan_masuk'][] = $laporanMasuk;
            $chartData['laporan_selesai'][] = $laporanSelesai;
        }
        
        // Pengajuan terbaru untuk evaluator
        $recentPengajuan = Pengajuan::where('evaluator_id', $evaluatorId)
            ->with(['pengguna.identitas'])
            ->orderBy('assigned_at', 'desc')
            ->take(5)
            ->get();
            
        return view('berandaevaluator', compact('stats', 'chartData', 'months', 'recentPengajuan'));
    }

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
