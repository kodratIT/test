<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Pengajuan;

class BerandakabidController extends Controller
{
    public function index()
    {
        // Hitung jumlah laporan berdasarkan status
        $jumlahMasuk = Pengajuan::where('status', 'masuk')->count();
        $jumlahEvaluasi = Pengajuan::where('status', 'evaluasi')->count();
        $jumlahValidasi = Pengajuan::where('status', 'validasi')->count();
        $jumlahPengesahan = Pengajuan::where('status', 'pengesahan')->count();

        // Kirim data ke view
        return view('berandakabid', compact(
            'jumlahMasuk',
            'jumlahEvaluasi',
            'jumlahValidasi',
            'jumlahPengesahan'
        ));
    }
}