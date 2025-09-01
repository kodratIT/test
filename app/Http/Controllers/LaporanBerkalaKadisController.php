<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Pengajuan;
use App\Models\User;
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
