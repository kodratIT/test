<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Ambil data pengajuan milik user yang sedang login
        $userPengajuan = Pengajuan::where('pengguna_id', $user->id)
                                  ->with(['evaluator'])
                                  ->get();
        
        // Statistik pengajuan pengguna
        $stats = [
            'total_pengajuan' => $userPengajuan->count(),
            'menunggu_evaluasi' => $userPengajuan->where('status', 'proses evaluasi')->count(),
            'sedang_evaluasi' => $userPengajuan->where('status', 'evaluasi')->count(), 
            'siap_validasi' => $userPengajuan->where('status', 'validasi')->count(),
            'dalam_pengesahan' => $userPengajuan->where('status', 'pengesahan')->count(),
            'perlu_perbaikan' => $userPengajuan->where('status', 'perbaikan')->count(),
            'selesai' => $userPengajuan->where('status', 'disetujui kadis')->count(),
        ];
        
        // Pengajuan terbaru
        $latestPengajuan = $userPengajuan->sortByDesc('created_at')->first();
        
        // Status progress untuk step indicator
        $currentStep = 1;
        if ($latestPengajuan) {
            switch ($latestPengajuan->status) {
                case 'proses evaluasi':
                    $currentStep = 1; // Laporan Berkala
                    break;
                case 'evaluasi':
                    $currentStep = 2; // Dievaluasi
                    break;
                case 'validasi':
                    $currentStep = 3; // Diverifikasi
                    break;
                case 'pengesahan':
                    $currentStep = 4; // Lembar Pengesahan (menunggu Kadis)
                    break;
                case 'disetujui kadis':
                    $currentStep = 5; // Selesai (disetujui Kadis)
                    break;
                default:
                    $currentStep = 1;
            }
        }
        
        // Pengajuan dengan detail untuk dashboard
        $recentPengajuan = $userPengajuan->sortByDesc('created_at')->take(5);
        
        return view('berandapengguna', compact(
            'stats',
            'latestPengajuan', 
            'currentStep',
            'recentPengajuan'
        ));
    }
}
