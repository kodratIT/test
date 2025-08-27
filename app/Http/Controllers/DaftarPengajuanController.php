<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

class DaftarPengajuanController extends Controller
{
    // Menampilkan halaman blade
    public function index()
    {
        return view('pengajuan.index'); // sesuaikan dengan nama blade kamu
    }

    // Mengambil data pengajuan untuk AJAX hanya berdasarkan pengguna
    public function list()
    {
        // Ambil id pengguna yang sedang login
        $userId = Auth::id();

        // Ambil data pengajuan milik user tersebut
        $pengajuan = Pengajuan::where('pengguna_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        // Tambahkan URL signed untuk setiap pengajuan
        $pengajuan->transform(function ($item) {
            $status = trim($item->status);

            if (strcasecmp($status, 'ditolak') === 0 || strcasecmp($status, 'perbaikan') === 0) {
                $item->action_link = URL::signedRoute('laporanperbaikan.perbaiki', ['id' => $item->id]);
                $item->action_text = 'Perbaiki';
            } elseif (strcasecmp($status, 'disetujui') === 0) {
                $item->action_link = URL::signedRoute('lembarpengesahanuser.lihat', ['id' => $item->id]);
                $item->action_text = 'Lihat';
            } else {
                $item->action_link = '';
                $item->action_text = '';
            }


            return $item;
        });

        return response()->json($pengajuan);
    }
}
