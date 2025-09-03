<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\Pengajuan;
use App\Models\EvaluasiPengajuan;
use App\Models\User;
use Carbon\Carbon;

class LaporanBerkalaKepalaBidangController extends Controller
{
    public function index()
    {
        return view('daftarlaporanberkalakabid');
    }

    public function getList(Request $request)
    {
        try {
            $query = Pengajuan::with(['pengguna.identitas', 'evaluator'])
                ->orderBy('created_at', 'desc');

            // Filter berdasarkan status jika ada
            if ($request->has('status') && $request->status != '') {
                $query->where('status', $request->status);
            }

            // Filter berdasarkan periode jika ada
            if ($request->has('start_date') && $request->start_date != '') {
                $query->whereDate('created_at', '>=', $request->start_date);
            }
            if ($request->has('end_date') && $request->end_date != '') {
                $query->whereDate('created_at', '<=', $request->end_date);
            }

            $pengajuanData = $query->get();

            $data = $pengajuanData->map(function ($item) {
                // Safe access untuk mencegah undefined
                $identitas = optional(optional($item->pengguna)->identitas);
                $evaluator = optional($item->evaluator);
                
                return [
                    'id' => $item->id ?? 0,
                    'no_pengajuan' => $item->no_pengajuan ?? 'N/A',
                    'created_at' => $item->created_at ? $item->created_at->format('Y-m-d') : date('Y-m-d'),
                    'badan_usaha' => $identitas->namabadanusaha ?? 'Tidak Tersedia',
                    'evaluator' => $evaluator->name ?? 'Belum Ditugaskan',
                    'catatan' => $item->catatan ?? '-',
                    'status' => $item->status ?? 'Unknown',
                    'days_pending' => $item->created_at ? $item->created_at->diffInDays(now()) : 0,
                    // Action untuk view (compatible dengan view lama)
                    'action_text' => $this->getActionText($item->status ?? 'Unknown'),
                    'action_link' => route('pengajuan.show', $item->id ?? 0),
                    // Extended data untuk fitur baru
                    'can_assign' => !$item->evaluator_id && in_array($item->status, ['proses evaluasi']),
                    'can_reassign' => $item->evaluator_id && in_array($item->status, ['proses evaluasi']),
                    'can_approve' => in_array($item->status, ['evaluasi']),
                    'can_reject' => in_array($item->status, ['evaluasi']),
                    // PDF information
                    'has_pdf' => $this->checkPdfExists($item->lembar_pengesahan_pdf),
                    'pdf_filename' => $item->lembar_pengesahan_pdf ? basename($item->lembar_pengesahan_pdf) : null,
                ];
            });

            return response()->json($data);
            
        } catch (\Exception $e) {
            \Log::error('Error in getList: ' . $e->getMessage());
            return response()->json([
                'error' => true,
                'message' => 'Terjadi kesalahan saat memuat data',
                'data' => []
            ], 500);
        }
    }

    public function show($id)
    {
        $pengajuan = Pengajuan::with(['pengguna.identitas', 'evaluator', 'evaluasiPengajuan.evaluator'])
            ->findOrFail($id);
            
        $evaluators = User::where('role_pengguna', 'evaluator')
            ->with('identitasTimAdmin')
            ->where('id', '!=', $pengajuan->evaluator_id)
            ->get();
            
        // Data evaluasi untuk ditampilkan di review section
        $evaluasiPengajuan = EvaluasiPengajuan::where('pengajuan_id', $id)
            ->with('evaluator')
            ->orderBy('created_at', 'desc')
            ->get();
            
        // History evaluasi (untuk keperluan log)
        $evaluasiHistory = $evaluasiPengajuan;

        // Load data evaluasi per section dari metadata (mengikuti struktur yang sama dengan evaluator)
        $currentEvaluation = EvaluasiPengajuan::where('pengajuan_id', $id)
            ->where('evaluator_id', $pengajuan->evaluator_id)
            ->latest()
            ->first();
            
        $evaluasiData = [];
        if ($currentEvaluation && $currentEvaluation->metadata) {
            $metadata = is_string($currentEvaluation->metadata) 
                ? json_decode($currentEvaluation->metadata, true) 
                : $currentEvaluation->metadata;
                
            // Mengikuti struktur yang sama dengan controller evaluator
            if (is_array($metadata) && isset($metadata['sections'])) {
                $evaluasiData = $metadata['sections'];
            }
        }

        return view('halamanverifikasi', compact('pengajuan', 'evaluators', 'evaluasiPengajuan', 'evaluasiHistory', 'evaluasiData', 'currentEvaluation'));
    }

    /**
     * Approve pengajuan dari Kabid
     */
    public function approve(Request $request, $id)
    {
        $request->validate([
            'catatan_kabid' => 'nullable|string|max:1000',
        ]);

        DB::beginTransaction();
        try {
            $pengajuan = Pengajuan::findOrFail($id);
            
            // Validasi status - hanya bisa approve jika sudah dievaluasi
            if (!in_array($pengajuan->status, ['evaluasi', 'proses evaluasi'])) {
                return response()->json([
                    'success' => false, 
                    'message' => 'Pengajuan tidak dapat diapprove dengan status saat ini: ' . $pengajuan->status
                ], 400);
            }

            // Update status ke validasi
            $pengajuan->update([
                'status' => 'validasi',
                'approved_by_kabid_at' => now(),
                'approved_by_kabid_id' => Auth::id(),
                'catatan_kabid' => $request->catatan_kabid,
            ]);

            // Log activity
            $this->logActivity($pengajuan->id, 'approved', 'Pengajuan disetujui oleh Kabid', $request->catatan_kabid);

            // TODO: Send notification email to user
            // $this->sendApprovalNotification($pengajuan);

            DB::commit();
            
            return response()->json([
                'success' => true, 
                'message' => 'Pengajuan berhasil disetujui dan diteruskan untuk validasi.'
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
     * Reject pengajuan dari Kabid
     */
    public function reject(Request $request, $id)
    {
        $request->validate([
            'catatan_kabid' => 'required|string|max:1000',
            'alasan_penolakan' => 'required|string|max:500',
        ]);

        DB::beginTransaction();
        try {
            $pengajuan = Pengajuan::findOrFail($id);
            
            // Update status ke perbaikan
            $pengajuan->update([
                'status' => 'perbaikan',
                'rejected_by_kabid_at' => now(),
                'rejected_by_kabid_id' => Auth::id(),
                'catatan_kabid' => $request->catatan_kabid,
                'alasan_penolakan' => $request->alasan_penolakan,
            ]);

            // Log activity
            $this->logActivity($pengajuan->id, 'rejected', 'Pengajuan ditolak oleh Kabid', $request->catatan_kabid);

            // TODO: Send rejection notification email to user
            // $this->sendRejectionNotification($pengajuan);

            DB::commit();
            
            return response()->json([
                'success' => true, 
                'message' => 'Pengajuan ditolak dan dikembalikan untuk perbaikan.'
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
     * Kirim pengajuan ke evaluator (assignment pertama kali)
     */
    public function kirimKeEvaluator(Request $request, $id)
    {
        $request->validate([
            'evaluator_id' => 'required|exists:users,id',
        ]);

        DB::beginTransaction();
        try {
            $pengajuan = Pengajuan::findOrFail($id);
            
            // Validasi: pengajuan belum memiliki evaluator
            if ($pengajuan->evaluator_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pengajuan sudah memiliki evaluator. Gunakan reassign jika ingin mengganti.'
                ], 400);
            }
            
            // Validasi evaluator
            $evaluator = User::where('id', $request->evaluator_id)
                ->where('role_pengguna', 'evaluator')
                ->first();
                
            if (!$evaluator) {
                return response()->json([
                    'success' => false,
                    'message' => 'Evaluator tidak valid.'
                ], 400);
            }

            // Cek workload evaluator (opsional)
            $currentWorkload = EvaluasiPengajuan::where('evaluator_id', $request->evaluator_id)
                ->where('status', 'menunggu evaluasi')
                ->count();
                
            if ($currentWorkload >= 10) { // batas maksimal 10 pengajuan aktif
                return response()->json([
                    'success' => false,
                    'message' => 'Evaluator sedang overload. Pilih evaluator lain.'
                ], 400);
            }

            // Update pengajuan
            $pengajuan->update([
                'evaluator_id' => $request->evaluator_id,
                'status' => 'proses evaluasi',
                'assigned_at' => now(),
                'assigned_by' => Auth::id(),
            ]);

            // Buat record evaluasi
            EvaluasiPengajuan::create([
                'pengajuan_id' => $pengajuan->id,
                'evaluator_id' => $request->evaluator_id,
                'status' => 'menunggu evaluasi',
                'assigned_at' => now(),
                'assigned_by' => Auth::id(),
            ]);

            // Log activity
            $this->logActivity($pengajuan->id, 'assigned', 
                'Pengajuan ditugaskan ke evaluator: ' . $evaluator->name);

            // TODO: Send notification email to evaluator
            // $this->sendAssignmentNotification($pengajuan, $evaluator);

            DB::commit();
            
            return response()->json([
                'success' => true, 
                'message' => 'Pengajuan berhasil dikirim ke evaluator: ' . $evaluator->name
            ]);
            
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Error in kirimKeEvaluator: ' . $e->getMessage());
            return response()->json([
                'success' => false, 
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Reassign pengajuan ke evaluator lain
     */
    public function reassignEvaluator(Request $request, $id)
    {
        $request->validate([
            'evaluator_id' => 'required|exists:users,id',
            'alasan_reassign' => 'nullable|string|max:500',
        ]);

        DB::beginTransaction();
        try {
            $pengajuan = Pengajuan::findOrFail($id);
            $oldEvaluatorId = $pengajuan->evaluator_id;
            
            // Validasi evaluator baru
            $newEvaluator = User::where('id', $request->evaluator_id)
                ->where('role_pengguna', 'evaluator')
                ->first();
                
            if (!$newEvaluator) {
                return response()->json([
                    'success' => false,
                    'message' => 'Evaluator tidak valid.'
                ], 400);
            }

            // Update pengajuan
            $pengajuan->update([
                'evaluator_id' => $request->evaluator_id,
                'status' => 'proses evaluasi',
                'reassigned_at' => now(),
                'reassigned_by' => Auth::id(),
            ]);

            // Update evaluasi lama jika ada
            if ($oldEvaluatorId) {
                EvaluasiPengajuan::where('pengajuan_id', $id)
                    ->where('evaluator_id', $oldEvaluatorId)
                    ->update(['status' => 'reassigned']);
            }

            // Buat record evaluasi baru
            EvaluasiPengajuan::create([
                'pengajuan_id' => $pengajuan->id,
                'evaluator_id' => $request->evaluator_id,
                'status' => 'menunggu evaluasi',
            ]);

            // Log activity
            $this->logActivity($pengajuan->id, 'reassigned', 
                'Pengajuan di-reassign ke evaluator: ' . $newEvaluator->name, 
                $request->alasan_reassign);

            DB::commit();
            
            return response()->json([
                'success' => true, 
                'message' => 'Pengajuan berhasil di-reassign ke ' . $newEvaluator->name
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
     * Get statistics for dashboard
     */
    public function getStatistics(Request $request)
    {
        $startDate = $request->get('start_date', now()->startOfMonth());
        $endDate = $request->get('end_date', now()->endOfMonth());

        $stats = [
            'total_pengajuan' => Pengajuan::whereBetween('created_at', [$startDate, $endDate])->count(),
            'menunggu_evaluasi' => Pengajuan::where('status', 'proses evaluasi')
                ->whereBetween('created_at', [$startDate, $endDate])->count(),
            'sedang_evaluasi' => Pengajuan::where('status', 'evaluasi')
                ->whereBetween('created_at', [$startDate, $endDate])->count(),
            'siap_validasi' => Pengajuan::where('status', 'validasi')
                ->whereBetween('created_at', [$startDate, $endDate])->count(),
            'perlu_perbaikan' => Pengajuan::where('status', 'perbaikan')
                ->whereBetween('created_at', [$startDate, $endDate])->count(),
            'selesai' => Pengajuan::where('status', 'pengesahan')
                ->whereBetween('created_at', [$startDate, $endDate])->count(),
        ];

        // Performance evaluator
        $evaluatorPerformance = User::where('role_pengguna', 'evaluator')
            ->withCount([
                'evaluasiPengajuan as total_assigned',
                'evaluasiPengajuan as completed' => function($query) use ($startDate, $endDate) {
                    $query->where('status', 'selesai')
                          ->whereBetween('created_at', [$startDate, $endDate]);
                },
                'evaluasiPengajuan as pending' => function($query) {
                    $query->where('status', 'menunggu evaluasi');
                }
            ])
            ->get()
            ->map(function($evaluator) {
                $avgDays = $this->getAverageEvaluationDays($evaluator->id);
                return [
                    'name' => $evaluator->name,
                    'total_assigned' => $evaluator->total_assigned,
                    'completed' => $evaluator->completed,
                    'pending' => $evaluator->pending,
                    'avg_days' => $avgDays,
                    'efficiency' => $evaluator->total_assigned > 0 
                        ? round(($evaluator->completed / $evaluator->total_assigned) * 100, 1) 
                        : 0
                ];
            });

        return response()->json([
            'stats' => $stats,
            'evaluator_performance' => $evaluatorPerformance,
            'chart_data' => $this->getChartData($startDate, $endDate)
        ]);
    }

    /**
     * Export laporan dalam berbagai format
     */
    public function export(Request $request)
    {
        $format = $request->get('format', 'excel'); // excel, pdf, csv
        $startDate = $request->get('start_date', now()->startOfMonth());
        $endDate = $request->get('end_date', now()->endOfMonth());
        
        $pengajuanData = Pengajuan::with(['pengguna.identitas', 'evaluator'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        switch ($format) {
            case 'pdf':
                return $this->exportToPdf($pengajuanData, $startDate, $endDate);
            case 'csv':
                return $this->exportToCsv($pengajuanData);
            default:
                return $this->exportToExcel($pengajuanData, $startDate, $endDate);
        }
    }

    /**
     * Get recent activities for dashboard
     */
    public function getRecentActivities()
    {
        $activities = DB::table('activity_logs')
            ->leftJoin('pengajuan', 'activity_logs.pengajuan_id', '=', 'pengajuan.id')
            ->leftJoin('users', 'activity_logs.user_id', '=', 'users.id')
            ->select(
                'activity_logs.*',
                'pengajuan.no_pengajuan',
                'users.name as user_name'
            )
            ->orderBy('activity_logs.created_at', 'desc')
            ->limit(10)
            ->get();

        return response()->json($activities);
    }

    /**
     * Get pending approvals that need Kabid attention
     */
    public function getPendingApprovals()
    {
        $pending = Pengajuan::with(['pengguna.identitas', 'evaluator'])
            ->where('status', 'evaluasi') // Yang sudah selesai dievaluasi, menunggu approval Kabid
            ->orderBy('updated_at', 'asc') // Yang paling lama menunggu dulu
            ->get()
            ->map(function($item) {
                return [
                    'id' => $item->id,
                    'no_pengajuan' => $item->no_pengajuan,
                    'badan_usaha' => optional(optional($item->pengguna)->identitas)->namabadanusaha ?? '-',
                    'evaluator' => optional($item->evaluator)->name ?? '-',
                    'waiting_days' => $item->updated_at->diffInDays(now()),
                    'priority' => $this->calculatePriority($item),
                ];
            });

        return response()->json($pending);
    }

    /**
     * Save evaluation section - Kabid can edit/update evaluation data
     */
    public function saveSection(Request $request, $id)
    {
        \Log::info('Kabid saveSection called', [
            'request_data' => $request->all(),
            'id' => $id,
            'user_id' => Auth::id()
        ]);
        
        try {
            $request->validate([
                'section' => 'required|string',
                'catatan' => 'nullable|string|max:1000',
                'status' => 'required|in:Disetujui,Ditolak,Perbaikan'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation failed in kabid saveSection', [
                'errors' => $e->errors(),
                'request_data' => $request->all()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal: ' . implode(', ', array_map('implode', $e->errors()))
            ], 422);
        }

        DB::beginTransaction();
        try {
            $pengajuan = Pengajuan::findOrFail($id);
            
            // Get or create evaluation record for this pengajuan
            $evaluasi = EvaluasiPengajuan::where('pengajuan_id', $id)
                ->where('evaluator_id', $pengajuan->evaluator_id)
                ->latest()
                ->first();
            
            if (!$evaluasi) {
                // If no evaluation exists, create one
                $evaluasi = EvaluasiPengajuan::create([
                    'pengajuan_id' => $id,
                    'evaluator_id' => $pengajuan->evaluator_id,
                    'status' => 'draft',
                    'metadata' => json_encode(['sections' => []])
                ]);
            }
            
            // Get current metadata
            $metadata = [];
            if ($evaluasi->metadata) {
                $metadata = is_string($evaluasi->metadata) 
                    ? json_decode($evaluasi->metadata, true) 
                    : $evaluasi->metadata;
            }
            
            // Initialize sections if not exists
            if (!isset($metadata['sections'])) {
                $metadata['sections'] = [];
            }
            
            // Update the specific section with the same structure as evaluator
            $metadata['sections'][$request->section] = [
                'catatan' => $request->catatan,
                'status' => $request->status,
                'evaluated_at' => now()->toISOString(),
                'evaluator_id' => $pengajuan->evaluator_id, // Keep original evaluator
                'updated_by_kabid' => Auth::id(),
                'kabid_updated_at' => now()->toISOString()
            ];
            
            $metadata['last_updated_by_kabid'] = Auth::id();
            $metadata['last_updated_at'] = now()->toISOString();
            
            // Save updated metadata
            $evaluasi->update([
                'metadata' => json_encode($metadata),
                'updated_at' => now()
            ]);
            
            // Log activity
            $this->logActivity($pengajuan->id, 'section_updated_by_kabid', 
                'Section ' . $request->section . ' diupdate oleh Kabid');
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Data evaluasi berhasil disimpan'
            ]);
            
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Error saving evaluation section by Kabid: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }

    // Helper methods
    private function getStatusBadge($status)
    {
        $badges = [
            'proses evaluasi' => '<span class="px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-200 rounded-full">Proses Evaluasi</span>',
            'evaluasi' => '<span class="px-2 py-1 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">Menunggu Approval</span>',
            'validasi' => '<span class="px-2 py-1 text-xs font-semibold text-purple-800 bg-purple-200 rounded-full">Validasi</span>',
            'perbaikan' => '<span class="px-2 py-1 text-xs font-semibold text-red-800 bg-red-200 rounded-full">Perbaikan</span>',
            'pengesahan' => '<span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-200 rounded-full">Selesai</span>',
        ];
        
        return $badges[$status] ?? '<span class="px-2 py-1 text-xs font-semibold text-gray-800 bg-gray-200 rounded-full">' . ucfirst($status) . '</span>';
    }

    private function getActionButtons($pengajuan)
    {
        $buttons = [];
        
        // Tombol Lihat Detail selalu ada
        $buttons[] = '<a href="' . route('pengajuan.show', $pengajuan->id) . '" class="px-3 py-1 text-xs font-semibold text-blue-600 bg-blue-100 rounded hover:bg-blue-200">Lihat</a>';
        
        // Tombol berdasarkan status
        switch ($pengajuan->status) {
            case 'proses evaluasi':
                if (!$pengajuan->evaluator_id) {
                    $buttons[] = '<button onclick="assignEvaluator(' . $pengajuan->id . ')" class="px-3 py-1 text-xs font-semibold text-green-600 bg-green-100 rounded hover:bg-green-200">Assign Evaluator</button>';
                } else {
                    $buttons[] = '<button onclick="reassignEvaluator(' . $pengajuan->id . ')" class="px-3 py-1 text-xs font-semibold text-yellow-600 bg-yellow-100 rounded hover:bg-yellow-200">Reassign</button>';
                }
                break;
                
            case 'evaluasi':
                $buttons[] = '<button onclick="approvePengajuan(' . $pengajuan->id . ')" class="px-3 py-1 text-xs font-semibold text-green-600 bg-green-100 rounded hover:bg-green-200">Approve</button>';
                $buttons[] = '<button onclick="rejectPengajuan(' . $pengajuan->id . ')" class="px-3 py-1 text-xs font-semibold text-red-600 bg-red-100 rounded hover:bg-red-200">Reject</button>';
                break;
        }
        
        return implode(' ', $buttons);
    }

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

    private function getAverageEvaluationDays($evaluatorId)
    {
        $completed = EvaluasiPengajuan::where('evaluator_id', $evaluatorId)
            ->where('status', 'selesai')
            ->get();
            
        if ($completed->count() == 0) return 0;
        
        $totalDays = $completed->sum(function($eval) {
            return $eval->created_at->diffInDays($eval->updated_at);
        });
        
        return round($totalDays / $completed->count(), 1);
    }

    private function calculatePriority($pengajuan)
    {
        $daysPending = $pengajuan->updated_at->diffInDays(now());
        
        if ($daysPending > 7) return 'high';
        if ($daysPending > 3) return 'medium';
        return 'low';
    }

    private function getChartData($startDate, $endDate)
    {
        // Data untuk chart per bulan
        $monthlyData = Pengajuan::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Data untuk chart status
        $statusData = Pengajuan::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get();

        return [
            'monthly' => $monthlyData,
            'status' => $statusData
        ];
    }

    // TODO: Implement export methods
    private function exportToExcel($data, $startDate, $endDate)
    {
        // Implementasi export Excel menggunakan Laravel Excel
        return response()->json(['message' => 'Excel export akan diimplementasikan']);
    }

    private function exportToPdf($data, $startDate, $endDate)
    {
        // Implementasi export PDF menggunakan DomPDF atau TCPDF
        return response()->json(['message' => 'PDF export akan diimplementasikan']);
    }

    private function exportToCsv($data)
    {
        // Implementasi export CSV
        return response()->json(['message' => 'CSV export akan diimplementasikan']);
    }

    private function getActionText($status)
    {
        $actionTexts = [
            'proses evaluasi' => 'Lihat & Assign',
            'evaluasi' => 'Review & Approve',
            'validasi' => 'Lihat',
            'perbaikan' => 'Lihat',
            'pengesahan' => 'Lihat',
            'Unknown' => 'Lihat'
        ];
        
        return $actionTexts[$status] ?? 'Lihat';
    }
    
    /**
     * Check if PDF file exists using multiple possible paths
     */
    private function checkPdfExists($filePath)
    {
        if (empty($filePath)) {
            return false;
        }
        
        // Check multiple possible locations for the file
        $possiblePaths = [
            storage_path('app/' . $filePath),
            storage_path('app/private/' . $filePath),
            storage_path('app/public/' . $filePath)
        ];
        
        foreach ($possiblePaths as $path) {
            if (file_exists($path) && is_readable($path)) {
                return true;
            }
        }
        
        return false;
    }
}
