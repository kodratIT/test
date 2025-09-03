<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pengajuan;
use App\Models\EvaluasiPengajuan;
use App\Models\User;
use Carbon\Carbon;

class BerandakabidController extends Controller
{
    public function index()
    {
        // Statistik dasar
        $stats = $this->getBasicStats();
        
        // Data untuk charts
        $chartData = $this->getChartData();
        
        // Performance evaluator
        $evaluatorPerformance = $this->getEvaluatorPerformance();
        
        // Pengajuan yang perlu perhatian (priority alerts)
        $priorityAlerts = $this->getPriorityAlerts();
        
        // Recent activities
        $recentActivities = $this->getRecentActivities();

        return view('berandakabid', compact(
            'stats',
            'chartData', 
            'evaluatorPerformance',
            'priorityAlerts',
            'recentActivities'
        ));
    }

    /**
     * Get dashboard statistics via AJAX
     */
    public function getStats(Request $request)
    {
        $period = $request->get('period', 'thisMonth'); // thisMonth, lastMonth, thisYear
        $dates = $this->getPeriodDates($period);
        
        return response()->json([
            'stats' => $this->getBasicStats($dates['start'], $dates['end']),
            'chart_data' => $this->getChartData($dates['start'], $dates['end']),
            'evaluator_performance' => $this->getEvaluatorPerformance($dates['start'], $dates['end']),
        ]);
    }

    /**
     * Get quick actions data
     */
    public function getQuickActions()
    {
        $actions = [
            'pending_assignments' => Pengajuan::whereNull('evaluator_id')
                ->where('status', 'proses evaluasi')
                ->count(),
            'pending_approvals' => Pengajuan::where('status', 'evaluasi')
                ->count(),
            'overdue_evaluations' => $this->getOverdueEvaluations(),
            'need_reassignment' => $this->getNeedReassignment(),
        ];

        return response()->json($actions);
    }

    /**
     * Get evaluator workload for assignment
     */
    public function getEvaluatorWorkload()
    {
        $evaluators = User::where('role_pengguna', 'evaluator')
            ->withCount([
                'evaluasiPengajuan as pending_count' => function($query) {
                    $query->where('status', 'menunggu evaluasi');
                },
                'evaluasiPengajuan as total_assigned' => function($query) {
                    $query->whereIn('status', ['menunggu evaluasi', 'selesai']);
                }
            ])
            ->get()
            ->map(function($evaluator) {
                $avgDays = $this->getAverageEvaluationDays($evaluator->id);
                return [
                    'id' => $evaluator->id,
                    'name' => $evaluator->name,
                    'pending_count' => $evaluator->pending_count,
                    'total_assigned' => $evaluator->total_assigned,
                    'avg_days' => $avgDays,
                    'workload_status' => $this->getWorkloadStatus($evaluator->pending_count),
                ];
            });

        return response()->json($evaluators);
    }

    // Private helper methods
    private function getBasicStats($startDate = null, $endDate = null)
    {
        if (!$startDate) $startDate = now()->startOfMonth();
        if (!$endDate) $endDate = now()->endOfMonth();

        // Base query untuk semua pengajuan
        $baseQuery = Pengajuan::query();
        
        return [
            // Total keseluruhan laporan berkala
            'total_pengajuan' => (clone $baseQuery)->count(),
            
            // Step 1: Laporan Berkala - pengajuan yang baru masuk dan menunggu evaluasi
            // Status: 'proses evaluasi', 'menunggu evaluasi'
            'menunggu_evaluasi' => (clone $baseQuery)->whereIn('status', ['proses evaluasi', 'menunggu evaluasi'])->count(),
            
            // Step 2: Dievaluasi - pengajuan yang sedang dalam proses evaluasi
            // Status: 'evaluasi', 'dalam evaluasi'
            'sedang_evaluasi' => (clone $baseQuery)->whereIn('status', ['evaluasi', 'dalam evaluasi'])->count(),
            
            // Step 3: Diverifikasi - pengajuan yang sudah selesai evaluasi dan siap validasi kabid
            // Status: 'validasi', 'siap validasi', 'menunggu persetujuan kabid'
            'siap_validasi' => (clone $baseQuery)->whereIn('status', ['validasi', 'siap validasi', 'menunggu persetujuan kabid'])->count(),
            
            // Step 4: Lembar Pengesahan - pengajuan yang sudah selesai dan ada PDF-nya
            // Berdasarkan field lembar_pengesahan_pdf yang ada isinya
            'selesai' => (clone $baseQuery)->whereNotNull('lembar_pengesahan_pdf')
                ->where('lembar_pengesahan_pdf', '!=', '')
                ->count(),
            
            // Additional stats for internal use
            'perlu_perbaikan' => (clone $baseQuery)->whereIn('status', ['perbaikan', 'perlu perbaikan'])->count(),
            'disetujui_kadis' => (clone $baseQuery)->where('status', 'disetujui kadis')->count(),
            'unassigned' => (clone $baseQuery)->whereNull('evaluator_id')
                ->whereIn('status', ['proses evaluasi', 'menunggu evaluasi'])
                ->count(),
        ];
    }

    private function getChartData($startDate = null, $endDate = null)
    {
        if (!$startDate) $startDate = now()->startOfYear();
        if (!$endDate) $endDate = now()->endOfYear();

        // Data bulanan
        $monthlyData = Pengajuan::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Data status
        $statusData = Pengajuan::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get();

        // Trend mingguan (4 minggu terakhir)
        $weeklyTrend = [];
        for ($i = 3; $i >= 0; $i--) {
            $weekStart = now()->subWeeks($i)->startOfWeek();
            $weekEnd = now()->subWeeks($i)->endOfWeek();
            
            $weeklyTrend[] = [
                'week' => 'Week ' . (4 - $i),
                'count' => Pengajuan::whereBetween('created_at', [$weekStart, $weekEnd])->count(),
                'completed' => Pengajuan::whereBetween('updated_at', [$weekStart, $weekEnd])
                    ->where('status', 'pengesahan')->count(),
            ];
        }

        return [
            'monthly' => $monthlyData,
            'status' => $statusData,
            'weekly_trend' => $weeklyTrend,
        ];
    }

    private function getEvaluatorPerformance($startDate = null, $endDate = null)
    {
        if (!$startDate) $startDate = now()->startOfMonth();
        if (!$endDate) $endDate = now()->endOfMonth();

        return User::where('role_pengguna', 'evaluator')
            ->withCount([
                'evaluasiPengajuan as total_assigned' => function($query) use ($startDate, $endDate) {
                    $query->whereBetween('created_at', [$startDate, $endDate]);
                },
                'evaluasiPengajuan as completed' => function($query) use ($startDate, $endDate) {
                    $query->where('status', 'selesai')
                          ->whereBetween('updated_at', [$startDate, $endDate]);
                },
                'evaluasiPengajuan as pending' => function($query) {
                    $query->where('status', 'menunggu evaluasi');
                }
            ])
            ->get()
            ->map(function($evaluator) {
                $avgDays = $this->getAverageEvaluationDays($evaluator->id);
                $efficiency = $evaluator->total_assigned > 0 
                    ? round(($evaluator->completed / $evaluator->total_assigned) * 100, 1) 
                    : 0;
                    
                return [
                    'id' => $evaluator->id,
                    'name' => $evaluator->name,
                    'total_assigned' => $evaluator->total_assigned,
                    'completed' => $evaluator->completed,
                    'pending' => $evaluator->pending,
                    'avg_days' => $avgDays,
                    'efficiency' => $efficiency,
                    'rating' => $this->calculateEvaluatorRating($efficiency, $avgDays),
                ];
            });
    }

    private function getPriorityAlerts()
    {
        $alerts = [];
        
        // Pengajuan tanpa evaluator > 1 hari
        $unassigned = Pengajuan::whereNull('evaluator_id')
            ->where('status', 'proses evaluasi')
            ->where('created_at', '<', now()->subDay())
            ->count();
            
        if ($unassigned > 0) {
            $alerts[] = [
                'type' => 'warning',
                'title' => 'Pengajuan Belum Ditugaskan',
                'message' => $unassigned . ' pengajuan belum ditugaskan ke evaluator',
                'action_url' => route('laporan.kabid.index') . '?filter=unassigned',
                'count' => $unassigned
            ];
        }

        // Evaluasi terlalu lama (> 7 hari)
        $overdue = Pengajuan::where('status', 'proses evaluasi')
            ->whereNotNull('evaluator_id')
            ->where('updated_at', '<', now()->subDays(7))
            ->count();
            
        if ($overdue > 0) {
            $alerts[] = [
                'type' => 'danger',
                'title' => 'Evaluasi Terlambat',
                'message' => $overdue . ' pengajuan evaluasi melebihi 7 hari',
                'action_url' => route('laporan.kabid.index') . '?filter=overdue',
                'count' => $overdue
            ];
        }

        // Menunggu approval Kabid
        $needApproval = Pengajuan::where('status', 'evaluasi')->count();
        if ($needApproval > 0) {
            $alerts[] = [
                'type' => 'info',
                'title' => 'Menunggu Approval',
                'message' => $needApproval . ' pengajuan menunggu approval Anda',
                'action_url' => route('laporan.kabid.index') . '?filter=need_approval',
                'count' => $needApproval
            ];
        }

        return $alerts;
    }

    private function getRecentActivities($limit = 10)
    {
        return DB::table('activity_logs')
            ->leftJoin('pengajuan', 'activity_logs.pengajuan_id', '=', 'pengajuan.id')
            ->leftJoin('users', 'activity_logs.user_id', '=', 'users.id')
            ->select(
                'activity_logs.*',
                'pengajuan.no_pengajuan',
                'users.name as user_name'
            )
            ->orderBy('activity_logs.created_at', 'desc')
            ->limit($limit)
            ->get()
            ->map(function($activity) {
                return [
                    'id' => $activity->id,
                    'action' => $activity->action,
                    'description' => $activity->description,
                    'no_pengajuan' => $activity->no_pengajuan,
                    'user_name' => $activity->user_name,
                    'created_at' => Carbon::parse($activity->created_at)->format('d/m/Y H:i'),
                    'time_ago' => Carbon::parse($activity->created_at)->diffForHumans(),
                ];
            });
    }

    private function getPeriodDates($period)
    {
        switch ($period) {
            case 'lastMonth':
                return [
                    'start' => now()->subMonth()->startOfMonth(),
                    'end' => now()->subMonth()->endOfMonth()
                ];
            case 'thisYear':
                return [
                    'start' => now()->startOfYear(),
                    'end' => now()->endOfYear()
                ];
            case 'lastYear':
                return [
                    'start' => now()->subYear()->startOfYear(),
                    'end' => now()->subYear()->endOfYear()
                ];
            default: // thisMonth
                return [
                    'start' => now()->startOfMonth(),
                    'end' => now()->endOfMonth()
                ];
        }
    }

    private function getAverageEvaluationDays($evaluatorId)
    {
        $completed = EvaluasiPengajuan::where('evaluator_id', $evaluatorId)
            ->where('status', 'selesai')
            ->whereNotNull('completed_at')
            ->get();
            
        if ($completed->count() == 0) return 0;
        
        $totalDays = $completed->sum(function($eval) {
            return Carbon::parse($eval->created_at)->diffInDays(Carbon::parse($eval->completed_at));
        });
        
        return round($totalDays / $completed->count(), 1);
    }

    private function calculateEvaluatorRating($efficiency, $avgDays)
    {
        // Rating berdasarkan efisiensi dan kecepatan
        $speedScore = 5; // Default
        if ($avgDays <= 2) $speedScore = 5;
        elseif ($avgDays <= 4) $speedScore = 4;
        elseif ($avgDays <= 6) $speedScore = 3;
        elseif ($avgDays <= 8) $speedScore = 2;
        else $speedScore = 1;
        
        $efficiencyScore = 5; // Default
        if ($efficiency >= 90) $efficiencyScore = 5;
        elseif ($efficiency >= 80) $efficiencyScore = 4;
        elseif ($efficiency >= 70) $efficiencyScore = 3;
        elseif ($efficiency >= 60) $efficiencyScore = 2;
        else $efficiencyScore = 1;
        
        return round(($speedScore + $efficiencyScore) / 2, 1);
    }

    private function getWorkloadStatus($pendingCount)
    {
        if ($pendingCount >= 8) return 'overloaded';
        if ($pendingCount >= 5) return 'busy';
        if ($pendingCount >= 2) return 'normal';
        return 'available';
    }

    private function getOverdueEvaluations()
    {
        return Pengajuan::where('status', 'proses evaluasi')
            ->whereNotNull('evaluator_id')
            ->where('assigned_at', '<', now()->subDays(7))
            ->with(['evaluator', 'pengguna.identitas'])
            ->get()
            ->map(function($pengajuan) {
                return [
                    'id' => $pengajuan->id,
                    'no_pengajuan' => $pengajuan->no_pengajuan,
                    'badan_usaha' => optional(optional($pengajuan->pengguna)->identitas)->namabadanusaha ?? '-',
                    'evaluator' => optional($pengajuan->evaluator)->name ?? '-',
                    'days_overdue' => Carbon::parse($pengajuan->assigned_at)->diffInDays(now()),
                ];
            });
    }

    private function getNeedReassignment()
    {
        // Pengajuan yang evaluatornya inactive atau overloaded
        return Pengajuan::where('status', 'proses evaluasi')
            ->whereNotNull('evaluator_id')
            ->whereHas('evaluator', function($query) {
                $query->where('role_pengguna', '!=', 'evaluator'); // Evaluator yang role berubah
            })
            ->orWhere(function($query) {
                // Atau evaluator yang overloaded
                $query->where('status', 'proses evaluasi')
                      ->whereNotNull('evaluator_id')
                      ->whereHas('evaluator.evaluasiPengajuan', function($subQuery) {
                          $subQuery->where('status', 'menunggu evaluasi')
                                   ->havingRaw('COUNT(*) >= 10');
                      });
            })
            ->with(['evaluator', 'pengguna.identitas'])
            ->get();
    }
}
