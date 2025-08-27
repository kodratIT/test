<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Auth;

class LaporanBerkalaEvaluatorController extends Controller
{
    public function index()
    {
        return view('daftarlaporanberkalaevaluator');
    }

    public function getList()
    {
        $evaluatorId = Auth::id(); // ambil id user yang login sebagai evaluator

        $data = Pengajuan::with(['pengguna.identitas'])
            ->where('evaluator_id', $evaluatorId) // hanya yg ditugaskan
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($item) {
                // tentukan status khusus evaluator
                $statusEvaluator = $item->status == 'proses evaluasi'
                    ? 'Menunggu Evaluasi'
                    : 'Telah Dievaluasi';

                return [
                    'no_pengajuan' => $item->no_pengajuan,
                    'created_at'   => $item->created_at->format('Y-m-d'),
                    'badan_usaha'  => optional(optional($item->pengguna)->identitas)->namabadanusaha ?? '-',
                    'status'       => $statusEvaluator,
                    'action_text'  => 'Lihat',
                    'action_link'  => route('laporan.evaluator.show', $item->id)
                ];
            });

        return response()->json($data);
    }

    public function show($id)
    {
        $pengajuan = Pengajuan::with(['pengguna.identitas'])
            ->where('evaluator_id', Auth::id()) // hanya boleh akses miliknya
            ->findOrFail($id);

        return view('halamanevaluasi', compact('pengajuan'));
    }
}
