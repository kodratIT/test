<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Pengajuan;
use App\Models\User;
use App\Models\EvaluasiPengajuan;
use Carbon\Carbon;

class LaporanBerkalaKadisController extends Controller
{
    /**
     * Menampilkan daftar laporan berkala untuk Kadis
     * Menampilkan data dengan status:
     * - 'validasi' (sudah diapprove Kabid, menunggu persetujuan Kadis)
     * - 'menunggu persetujuan kadis' 
     * - 'disetujui kadis' (yang sudah disetujui, tetap ditampilkan untuk history)
     */
    public function index()
    {
        // Ambil data pengajuan yang sudah divalidasi oleh Kabid
        // Status 'validasi' = sudah diapprove Kabid, menunggu persetujuan Kadis
        // Status 'menunggu persetujuan kadis' = untuk kompatibilitas jika ada status khusus
        // Status 'disetujui kadis' = yang sudah disetujui Kadis (tetap ditampilkan untuk history)
        $pengajuans = Pengajuan::with(['pengguna.identitas', 'evaluator'])
            ->whereIn('status', ['validasi', 'menunggu persetujuan kadis', 'disetujui kadis'])
            ->orderBy('updated_at', 'desc') // Urutkan berdasarkan waktu update terbaru
            ->orderBy('created_at', 'desc') // Kemudian berdasarkan waktu pembuatan
            ->get();

        return view('daftarlaporanberkalakadis', compact('pengajuans'));
    }

    /**
     * Menampilkan detail pengajuan untuk Kadis
     */
    public function show($id)
    {
        try {
            // Debug: Log the ID being requested
            \Log::info('Kadis show method called with ID: ' . $id);
            
            $pengajuan = Pengajuan::with([
                'pengguna.identitas',
                'evaluator'
            ])->findOrFail($id);
            
            // Debug: Log pengajuan found
            \Log::info('Pengajuan found with status: ' . $pengajuan->status);
            
            // Validasi akses - hanya pengajuan dengan status tertentu yang bisa dilihat Kadis
            if (!in_array($pengajuan->status, ['validasi', 'menunggu persetujuan kadis', 'disetujui kadis'])) {
                \Log::warning('Access denied for status: ' . $pengajuan->status);
                return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk melihat pengajuan ini. Status: ' . $pengajuan->status);
            }
            
            // Ambil data evaluasi terbaru dari evaluator (dengan null check)
            $currentEvaluation = null;
            if ($pengajuan->evaluator_id) {
                $currentEvaluation = EvaluasiPengajuan::where('pengajuan_id', $id)
                    ->where('evaluator_id', $pengajuan->evaluator_id)
                    ->latest()
                    ->first();
            }
                
            // Ambil data evaluasi per section jika ada (dengan null check)
            $evaluasiData = [];
            if ($currentEvaluation && isset($currentEvaluation->metadata) && is_array($currentEvaluation->metadata) && !empty($currentEvaluation->metadata['sections'])) {
                $evaluasiData = $currentEvaluation->metadata['sections'];
            }
            
            // Ambil daftar evaluator untuk keperluan reassign (jika diperlukan)
            $evaluators = User::where('role_pengguna', 'evaluator')
                ->get(); // Remove status check for now to debug
            
            \Log::info('About to return view with data');
            return view('halamanshowkadis', compact('pengajuan', 'evaluasiData', 'currentEvaluation', 'evaluators'));
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            \Log::error('Pengajuan not found with ID: ' . $id);
            return redirect()->back()->with('error', 'Pengajuan dengan ID ' . $id . ' tidak ditemukan.');
        } catch (\Exception $e) {
            \Log::error('Error in Kadis show: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Approve pengajuan oleh Kadis (persetujuan akhir)
     */
    public function approve(Request $request, $id)
    {
        $request->validate([
            'catatan_kadis' => 'nullable|string|max:1000',
        ]);

        DB::beginTransaction();
        try {
            $pengajuan = Pengajuan::findOrFail($id);
            
            // Validasi status - hanya bisa approve jika sudah divalidasi Kabid
            if (!in_array($pengajuan->status, ['validasi', 'menunggu persetujuan kadis'])) {
                return response()->json([
                    'success' => false, 
                    'message' => 'Pengajuan tidak dapat disetujui dengan status saat ini: ' . $pengajuan->status
                ], 400);
            }

            // Update status ke disetujui akhir
            $pengajuan->update([
                'status' => 'disetujui kadis',
                'catatan_kabid' => $request->catatan_kadis, // Gunakan field yang ada atau sesuaikan
                'updated_at' => now(), // Timestamp persetujuan akan tercatat di updated_at
            ]);

            // Log activity
            $this->logActivity($pengajuan->id, 'final_approved', 
                'Pengajuan disetujui final oleh Kepala Dinas', 
                $request->catatan_kadis);

            // TODO: Send final approval notification email to user
            // $this->sendFinalApprovalNotification($pengajuan);

            DB::commit();
            
            return response()->json([
                'success' => true, 
                'message' => 'Laporan berkala berhasil disetujui oleh Kepala Dinas.'
            ]);
            
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false, 
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Dashboard untuk Kepala Dinas
     */
    public function dashboard()
    {
        try {
            // Statistik umum
            // Total Permohonan = pengajuan yang masuk proses verifikasi dan disetujui
            // Status yang relevan: 'validasi', 'menunggu persetujuan kadis', 'disetujui kadis'
            $totalPermohonan = Pengajuan::whereIn('status', ['validasi', 'menunggu persetujuan kadis', 'disetujui kadis'])->count();
            
            // Total Surat Keterangan = pengajuan yang sudah diinput PDF-nya
            // Field lembar_pengesahan_pdf tidak null dan tidak kosong
            $totalSuratKeterangan = Pengajuan::whereNotNull('lembar_pengesahan_pdf')
                ->where('lembar_pengesahan_pdf', '!=', '')
                ->count();
            
            // Total Badan Usaha tetap sama (unique users)
            $totalBadanUsaha = Pengajuan::distinct('pengguna_id')->count('pengguna_id');
            
            // Data untuk chart per bulan (12 bulan terakhir)
            $chartData = [];
            $months = [];
            
            for ($i = 11; $i >= 0; $i--) {
                $date = now()->subMonths($i);
                $months[] = $date->format('M');
                
                // Surat Masuk = pengajuan yang masuk ke proses verifikasi (status relevan untuk Kadis)
                $suratMasuk = Pengajuan::whereMonth('created_at', $date->month)
                    ->whereYear('created_at', $date->year)
                    ->whereIn('status', ['validasi', 'menunggu persetujuan kadis', 'disetujui kadis'])
                    ->count();
                    
                // Surat Selesai = pengajuan yang sudah ada PDF-nya (sudah selesai diproses)
                $suratSelesai = Pengajuan::whereMonth('created_at', $date->month)
                    ->whereYear('created_at', $date->year)
                    ->whereNotNull('lembar_pengesahan_pdf')
                    ->where('lembar_pengesahan_pdf', '!=', '')
                    ->count();
                    
                $chartData['surat_masuk'][] = $suratMasuk;
                $chartData['surat_selesai'][] = $suratSelesai;
            }
            
            return view('berandakadis', compact(
                'totalPermohonan',
                'totalSuratKeterangan', 
                'totalBadanUsaha',
                'chartData',
                'months'
            ));
            
        } catch (\Exception $e) {
            // Fallback data jika terjadi error
            return view('berandakadis', [
                'totalPermohonan' => 0,
                'totalSuratKeterangan' => 0,
                'totalBadanUsaha' => 0,
                'chartData' => ['surat_masuk' => array_fill(0, 12, 0), 'surat_selesai' => array_fill(0, 12, 0)],
                'months' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            ]);
        }
    }

    /**
     * Get statistics for dashboard (optional)
     */
    public function getStatistics()
    {
        try {
            $stats = [
                'menunggu_persetujuan' => Pengajuan::whereIn('status', ['validasi', 'menunggu persetujuan kadis'])->count(),
                'disetujui_kadis' => Pengajuan::where('status', 'disetujui kadis')->count(),
                'total_bulan_ini' => Pengajuan::whereIn('status', ['validasi', 'menunggu persetujuan kadis', 'disetujui kadis'])
                    ->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->count(),
            ];

            return response()->json($stats);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Terjadi kesalahan saat memuat statistik',
                'data' => []
            ], 500);
        }
    }

    /**
     * Log activity untuk audit trail
     */
    private function logActivity($pengajuanId, $action, $description, $notes = null)
    {
        DB::table('activity_logs')->insert([
            'pengajuan_id' => $pengajuanId,
            'user_id' => Auth::id(),
            'action' => $action,
            'description' => $description,
            'notes' => $notes,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Helper method untuk menentukan teks aksi berdasarkan status
     */
    private function getActionText($status)
    {
        switch ($status) {
            case 'validasi':
            case 'menunggu persetujuan kadis':
                return 'Setujui';
            case 'disetujui kadis':
                return 'Disetujui';
            default:
                return '-';
        }
    }

    
}
