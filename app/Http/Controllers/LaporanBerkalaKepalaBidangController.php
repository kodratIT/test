<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;

class LaporanBerkalaKepalaBidangController extends Controller
{
    public function index()
    {
        return view('daftarlaporanberkalakabid');
    }


    public function getList()
    {
        $data = Pengajuan::with(['pengguna.identitas']) // ✅ pake relasi yg bener
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($item) {
                return [
                    'no_pengajuan' => $item->no_pengajuan,
                    'created_at'   => $item->created_at->format('Y-m-d'),
                    'badan_usaha'  => optional(optional($item->pengguna)->identitas)->namabadanusaha ?? '-',
                    'catatan'      => $item->catatan ?? '-',
                    'status'       => $item->status,
                    'action_text'  => 'Lihat',
                    'action_link'  => route('pengajuan.show', $item->id)
                ];
            });

        return response()->json($data);
    }

    public function show($id)
    {
        $pengajuan = Pengajuan::with(['pengguna.identitas'])
            ->findOrFail($id);

        return view('halamanverifikasi', compact('pengajuan'));
    }


    public function export()
    {
        // nanti bisa pakai Excel atau PDF export
        return "Export laporan berhasil (belum diimplementasikan)";
    }
}
