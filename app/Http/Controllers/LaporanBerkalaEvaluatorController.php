<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Pengajuan;
use App\Models\EvaluasiPengajuan;
use Carbon\Carbon;

class LaporanBerkalaEvaluatorController extends Controller
{
    public function index()
    {
        return view('daftarlaporanberkalaevaluator');
    }

    public function getList()
    {
        $evaluatorId = Auth::id();

        try {
            // Ambil pengajuan yang ditugaskan ke evaluator ini
            $data = Pengajuan::with(['pengguna.identitas', 'evaluasiPengajuan' => function($query) use ($evaluatorId) {
                    $query->where('evaluator_id', $evaluatorId);
                }])
                ->where('evaluator_id', $evaluatorId)
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($item) {
                    // Dapatkan status evaluasi spesifik untuk evaluator
                    $evaluasiStatus = $this->getEvaluatorStatus($item);
                    
                    return [
                        'id' => $item->id,
                        'no_pengajuan' => $item->no_pengajuan ?? 'N/A',
                        'created_at' => $item->created_at->format('Y-m-d'),
                        'badan_usaha' => optional(optional($item->pengguna)->identitas)->namabadanusaha ?? '-',
                        'status' => $evaluasiStatus['text'],
                        'status_color' => $evaluasiStatus['color'],
                        'action_text' => $evaluasiStatus['action'],
                        'action_link' => route('laporan.evaluator.show', $item->id),
                        'can_evaluate' => $evaluasiStatus['can_evaluate'],
                        'days_assigned' => $item->created_at->diffInDays(now())
                    ];
                });

            return response()->json($data);
            
        } catch (\Exception $e) {
            \Log::error('Error in evaluator getList: ' . $e->getMessage());
            return response()->json([
                'error' => true,
                'message' => 'Terjadi kesalahan saat memuat data',
                'data' => []
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            // Verifikasi akses evaluator
            $pengajuan = Pengajuan::with([
                'pengguna.identitas', 
                'evaluator',
                'evaluasiPengajuan' => function($query) {
                    $query->where('evaluator_id', Auth::id())->latest();
                }
            ])
            ->where('evaluator_id', Auth::id())
            ->findOrFail($id);
            
            // Dapatkan data evaluasi untuk evaluator ini
            $currentEvaluation = EvaluasiPengajuan::where('pengajuan_id', $id)
                ->where('evaluator_id', Auth::id())
                ->latest()
                ->first();
                
            // Ambil data evaluasi per section jika ada
            $evaluasiData = [];
            if ($currentEvaluation && !empty($currentEvaluation->metadata['sections'])) {
                $evaluasiData = $currentEvaluation->metadata['sections'];
            }
                
            // Tentukan view berdasarkan status evaluasi
            $viewName = $this->determineView($pengajuan, $currentEvaluation);
            
            return view($viewName, compact('pengajuan', 'currentEvaluation', 'evaluasiData'));
            
        } catch (\Exception $e) {
            \Log::error('Error in evaluator show: ' . $e->getMessage());
            return redirect()->route('laporan.evaluator.index')
                ->with('error', 'Pengajuan tidak ditemukan atau tidak memiliki akses.');
        }
    }

    public function saveSection(Request $request, $id)
    {
        \Log::info('saveSection called', [
            'request_data' => $request->all(),
            'id' => $id,
            'user_id' => Auth::id()
        ]);
        
        try {
            $request->validate([
                'section' => 'required|string',
                'catatan' => 'nullable|string|max:1000',
                'status' => 'required|in:Disetujui,Ditolak'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation failed in saveSection', [
                'errors' => $e->errors(),
                'request_data' => $request->all()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal: ' . implode(', ', array_map('implode', $e->errors()))
            ], 422);
        }
        
        try {
            // Verifikasi pengajuan
            $pengajuan = Pengajuan::where('evaluator_id', Auth::id())
                ->findOrFail($id);
                
            // Ambil atau buat evaluasi record
            $evaluasi = EvaluasiPengajuan::where('pengajuan_id', $id)
                ->where('evaluator_id', Auth::id())
                ->latest()
                ->first();
                
            if (!$evaluasi) {
                // Buat record evaluasi baru jika tidak ada
                $evaluasi = EvaluasiPengajuan::create([
                    'pengajuan_id' => $id,
                    'evaluator_id' => Auth::id(),
                    'status' => 'menunggu evaluasi',
                    'assigned_at' => now(),
                    'metadata' => []
                ]);
                
                \Log::info('Created new evaluation record', [
                    'pengajuan_id' => $id,
                    'evaluator_id' => Auth::id()
                ]);
            }
            
            // Update metadata dengan evaluasi per bagian
            $metadata = $evaluasi->metadata ?? [];
            $metadata['sections'] = $metadata['sections'] ?? [];
            
            $metadata['sections'][$request->section] = [
                'catatan' => $request->catatan,
                'status' => $request->status,
                'evaluated_at' => now()->toISOString(),
                'evaluator_id' => Auth::id()
            ];
            
            $evaluasi->update(['metadata' => $metadata]);
            
            return response()->json([
                'success' => true,
                'message' => 'Evaluasi bagian berhasil disimpan'
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Error in saveSection: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function submit(Request $request, $id)
    {
        \Log::info('Submit evaluasi called', [
            'request_data' => $request->all(),
            'id' => $id,
            'user_id' => Auth::id()
        ]);
        
        // Validasi sederhana karena ini final submit
        $request->validate([
            'hasil_evaluasi' => 'nullable|string|max:2000'
        ]);

        DB::beginTransaction();
        try {
            // Verifikasi pengajuan dan pastikan evaluator memiliki akses
            $pengajuan = Pengajuan::where('evaluator_id', Auth::id())
                ->where('status', 'proses evaluasi')
                ->findOrFail($id);
                
            // Ambil record evaluasi yang ada
            $evaluasiRecord = EvaluasiPengajuan::where('pengajuan_id', $id)
                ->where('evaluator_id', Auth::id())
                ->latest()
                ->first();
                
            if (!$evaluasiRecord) {
                throw new \Exception('Record evaluasi tidak ditemukan');
            }
            
            // Cek apakah ada evaluasi sections yang sudah disimpan
            $metadata = $evaluasiRecord->metadata ?? [];
            $sections = $metadata['sections'] ?? [];
            
            if (empty($sections)) {
                throw new \Exception('Belum ada evaluasi per bagian yang disimpan. Silakan evaluasi setiap bagian terlebih dahulu.');
            }
            
            // Tentukan rekomendasi keseluruhan berdasarkan evaluasi per section
            $rejectedSections = 0;
            $totalSections = count($sections);
            
            foreach ($sections as $sectionData) {
                if (isset($sectionData['status']) && $sectionData['status'] === 'Ditolak') {
                    $rejectedSections++;
                }
            }
            
            // Jika ada section yang ditolak, maka keseluruhan reject
            $overallRecommendation = $rejectedSections > 0 ? 'reject' : 'approve';
            $newStatus = $overallRecommendation === 'approve' ? 'evaluasi' : 'perbaikan';
            
            // Update pengajuan
            $pengajuan->update([
                'status' => $newStatus,
                'evaluated_at' => now(),
                'evaluator_recommendation' => $overallRecommendation,
                'evaluator_notes' => $request->hasil_evaluasi ?? 'Evaluasi telah diselesaikan'
            ]);
            
            // Update record evaluasi menjadi selesai
            $finalMetadata = $metadata;
            $finalMetadata['final_submission'] = [
                'submitted_at' => now()->toISOString(),
                'overall_recommendation' => $overallRecommendation,
                'final_notes' => $request->hasil_evaluasi ?? '',
                'total_sections' => $totalSections,
                'rejected_sections' => $rejectedSections,
                'evaluator_id' => Auth::id()
            ];
            
            $evaluasiRecord->update([
                'status' => 'selesai',
                'catatan' => $request->hasil_evaluasi ?? 'Evaluasi diselesaikan',
                'completed_at' => now(),
                'evaluation_days' => $evaluasiRecord->assigned_at ? 
                    $evaluasiRecord->assigned_at->diffInDays(now()) : 0,
                'metadata' => $finalMetadata
            ]);
            
            // Log activity
            $this->logActivity($pengajuan->id, 'evaluated', 
                'Evaluasi diselesaikan dan dikirim ke Kabid dengan rekomendasi: ' . $overallRecommendation,
                $request->hasil_evaluasi);
                
            DB::commit();
            
            \Log::info('Evaluasi berhasil di-submit', [
                'pengajuan_id' => $id,
                'new_status' => $newStatus,
                'recommendation' => $overallRecommendation
            ]);
            
            return response()->json([
                'success' => true, 
                'message' => 'Evaluasi berhasil dikirim ke Kabid!',
                'redirect' => route('laporan.evaluator.index'),
                'status' => $newStatus,
                'recommendation' => $overallRecommendation
            ]);
            
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Error in evaluator submit: ' . $e->getMessage(), [
                'id' => $id,
                'user_id' => Auth::id(),
                'request_data' => $request->all()
            ]);
            return response()->json([
                'success' => false, 
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
    
    // Helper methods
    private function getEvaluatorStatus($pengajuan)
    {
        switch ($pengajuan->status) {
            case 'proses evaluasi':
                return [
                    'text' => 'Menunggu Evaluasi',
                    'color' => 'yellow',
                    'action' => 'Evaluasi',
                    'can_evaluate' => true
                ];
            case 'evaluasi':
                return [
                    'text' => 'Telah Dievaluasi',
                    'color' => 'blue', 
                    'action' => 'Lihat Hasil',
                    'can_evaluate' => false
                ];
            case 'validasi':
                return [
                    'text' => 'Dalam Validasi',
                    'color' => 'purple',
                    'action' => 'Lihat',
                    'can_evaluate' => false
                ];
            case 'perbaikan':
                return [
                    'text' => 'Butuh Perbaikan',
                    'color' => 'red',
                    'action' => 'Lihat',
                    'can_evaluate' => false
                ];
            default:
                return [
                    'text' => 'Status Tidak Dikenal',
                    'color' => 'gray',
                    'action' => 'Lihat',
                    'can_evaluate' => false
                ];
        }
    }
    
    private function determineView($pengajuan, $currentEvaluation)
    {
        // Jika status masih 'proses evaluasi', tampilkan form evaluasi
        if ($pengajuan->status === 'proses evaluasi') {
            return 'halamanevaluasi'; // View untuk melakukan evaluasi
        }
        
        // Jika sudah dievaluasi, tampilkan hasil evaluasi (read-only)
        return 'halamanverifikasitelahdievaluasi'; // View read-only
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
}
