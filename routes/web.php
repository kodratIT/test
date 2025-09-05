<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\AuthControllerManual;
use App\Http\Controllers\DataAdmController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\DaftarPengajuanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IdentitasTimAdminController;
use App\Http\Controllers\LaporanBerkalaKepalaBidangController;
use App\Http\Controllers\KepalaBidangController;
use App\Http\Controllers\BerandakabidController;
use App\Http\Controllers\EvaluatorController;
use App\Http\Controllers\BadanusahaController;
use App\Http\Controllers\LaporanBerkalaEvaluatorController;
use App\Http\Controllers\LaporanBerkalaKadisController;
use App\Http\Controllers\LampiranController;
use App\Http\Controllers\DocumentController;

//pengguna
Route::middleware(['auth', 'is_pengguna'])->group(function () {
    Route::post('/profile', [DataAdmController::class, 'simpan'])->name('profile.simpan');
    Route::get('/profileidentitas', [DataAdmController::class, 'identitas'])->name('profileidentitas');
    Route::get('/profile', [DataAdmController::class, 'profileidentitas'])->name('profile');
    Route::get('/profile', [DataAdmController::class, 'showProfile'])->name('profile.show');

    Route::get('/pengajuan', [PengajuanController::class, 'index'])->name('pengajuan.index');
    Route::get('/pengajuan/create', [PengajuanController::class, 'create'])->name('pengajuan.create');
    Route::post('/pengajuan', [PengajuanController::class, 'store'])->name('pengajuan.store');


    Route::get('/daftar-pengajuan', [DaftarPengajuanController::class, 'index'])->name('daftar.pengajuan.index');
    Route::get('/daftar-pengajuan/list', [DaftarPengajuanController::class, 'list'])->name('daftar.pengajuan.list');
    
    // Routes for pengajuan CRUD
    Route::get('/pengajuan/{id}/detail', [DaftarPengajuanController::class, 'detail'])->name('pengajuan.detail');
    Route::get('/pengajuan/{id}/edit', [DaftarPengajuanController::class, 'edit'])->name('pengajuan.edit');
    Route::put('/pengajuan/{id}', [DaftarPengajuanController::class, 'update'])->name('pengajuan.update');
    Route::delete('/pengajuan/{id}/delete', [DaftarPengajuanController::class, 'delete'])->name('pengajuan.delete');
    Route::get('/pengajuan/{id}/download', [DaftarPengajuanController::class, 'download'])->name('pengajuan.download');


        Route::get('daftarpengajuanpengguna', function () {
            return view('daftarlaporanberkalapengguna');
        })->name('daftarpengajuanpengguna');


    // Route untuk perbaikan (signed)
    Route::get('/laporanperbaikan/{id}', [DaftarPengajuanController::class, 'perbaiki'])
        ->name('laporanperbaikan.perbaiki')
        ->middleware('signed');

    // Route untuk melihat lembar pengesahan (signed)
    Route::get('/lembarpengesahanuser/{id}', [DaftarPengajuanController::class, 'lihat'])
        ->name('lembarpengesahanuser.lihat')
        ->middleware('signed');

    // Halaman form pengajuan (misalnya view: resources/views/pengajuan/form.blade.php)
    Route::get('/pengajuan', function () {
        return view('pengajuan.form');
    })->name('pengajuan.form');

    // Proses simpan data pengajuan
    Route::post('/pengajuan/store', [PengajuanController::class, 'store'])->name('pengajuan.store');
});


//kabid
Route::middleware(['auth', 'is_kabid'])->group(function () {

    Route::get('/profilekabid', [IdentitasTimAdminController::class, 'showProfileKabid'])->name('profile.kabid');

    // Dashboard Kabid API endpoints
    Route::get('/berandakabid/stats', [BerandakabidController::class, 'getStats'])->name('berandakabid.stats');
    Route::get('/berandakabid/quick-actions', [BerandakabidController::class, 'getQuickActions'])->name('berandakabid.quickActions');
    Route::get('/berandakabid/evaluator-workload', [BerandakabidController::class, 'getEvaluatorWorkload'])->name('berandakabid.evaluatorWorkload');

    Route::prefix('daftarlaporanberkalakabid')->group(function () {
        Route::get('/', [LaporanBerkalaKepalaBidangController::class, 'index'])->name('laporan.kabid.index');
        Route::get('/list', [LaporanBerkalaKepalaBidangController::class, 'getList'])->name('laporan.kabid.list');
        Route::get('/statistics', [LaporanBerkalaKepalaBidangController::class, 'getStatistics'])->name('laporan.kabid.statistics');
        Route::get('/recent-activities', [LaporanBerkalaKepalaBidangController::class, 'getRecentActivities'])->name('laporan.kabid.recentActivities');
        Route::get('/pending-approvals', [LaporanBerkalaKepalaBidangController::class, 'getPendingApprovals'])->name('laporan.kabid.pendingApprovals');
        Route::get('/export', [LaporanBerkalaKepalaBidangController::class, 'export'])->name('laporan.kabid.export');
    });

    // Pengajuan management endpoints
    Route::post('/pengajuan/{id}/kirim-evaluator', [LaporanBerkalaKepalaBidangController::class, 'kirimKeEvaluator'])->name('pengajuan.kirimEvaluator');
    Route::post('/pengajuan/{id}/approve', [LaporanBerkalaKepalaBidangController::class, 'approve'])->name('pengajuan.approve');
    Route::post('/pengajuan/{id}/reject', [LaporanBerkalaKepalaBidangController::class, 'reject'])->name('pengajuan.reject');
    Route::post('/pengajuan/{id}/reassign-evaluator', [LaporanBerkalaKepalaBidangController::class, 'reassignEvaluator'])->name('pengajuan.reassignEvaluator');
    
    // Route untuk kabid mengedit/menyimpan data evaluasi per section
    Route::post('/kabid/evaluasi/{id}/save-section', [LaporanBerkalaKepalaBidangController::class, 'saveSection'])
        ->name('laporan.kabid.save_section');
    
    // Route untuk laporan berkala Kabid
    Route::prefix('laporan-berkala-kabid')->group(function () {
        Route::get('/', [LaporanBerkalaKepalaBidangController::class, 'index'])->name('laporan-berkala-kabid.index');
        Route::post('/{id}/approve', [LaporanBerkalaKepalaBidangController::class, 'approve'])->name('laporan-berkala-kabid.approve');
        Route::post('/{id}/reject', [LaporanBerkalaKepalaBidangController::class, 'reject'])->name('laporan-berkala-kabid.reject');
        Route::post('/{id}/reassign-evaluator', [LaporanBerkalaKepalaBidangController::class, 'reassignEvaluator'])->name('laporan-berkala-kabid.reassign-evaluator');
    });

    // kelola evaluator
    Route::get('/kelolaevaluator', [EvaluatorController::class, 'index'])->name('evaluator.index');
    Route::post('/evaluator/store', [EvaluatorController::class, 'store'])->name('evaluator.store');
    Route::delete('/evaluator/{id}', [EvaluatorController::class, 'destroy'])->name('evaluator.destroy');

    //kelola badan usaha
    Route::get('/kelolabadanusaha', [BadanusahaController::class, 'index'])->name('pengguna.index');
    Route::post('/pengguna/store', [BadanusahaController::class, 'store'])->name('pengguna.store');
    Route::delete('/pengguna/{id}', [BadanusahaController::class, 'destroy'])->name('pengguna.destroy');
});

//evaluator
Route::middleware(['auth', 'is_evaluator'])->group(function () {


    Route::get('/profileevaluator', [IdentitasTimAdminController::class, 'showProfileEvaluator'])
        ->name('profileevaluator');

    // Halaman utama evaluator
    Route::get('/daftarlaporanberkalaevaluator', [LaporanBerkalaEvaluatorController::class, 'index'])
        ->name('laporan.evaluator.index');

    // API untuk ambil list data evaluator (AJAX)
    Route::get('/daftarlaporanberkalaevaluator/list', [LaporanBerkalaEvaluatorController::class, 'getList'])
        ->name('laporan.evaluator.list');

    // Detail pengajuan yang ditugaskan ke evaluator
    Route::get('/daftarlaporanberkalaevaluator/{id}', [LaporanBerkalaEvaluatorController::class, 'show'])
        ->name('laporan.evaluator.show');

    // route simpan evaluasi per bagian (AJAX)
    Route::post('/evaluasi/{id}/save-section', [LaporanBerkalaEvaluatorController::class, 'saveSection'])
        ->name('laporan.evaluator.save_section');
        
    // route submit evaluasi final
    Route::post('/evaluasi/{id}/submit', [LaporanBerkalaEvaluatorController::class, 'submit'])
        ->name('laporan.evaluator.submit');

    Route::get('/evaluator/pengajuan', [EvaluatorController::class, 'daftarPengajuan'])->name('evaluator.pengajuan');
});


//kadis
Route::middleware(['auth', 'is_kadis'])->group(function () {
    Route::get('/profilevalidator', [IdentitasTimAdminController::class, 'showProfile'])->name('profilevalidator');

    // Daftar laporan berkala untuk Kadis - hanya yang sudah divalidasi Kabid
    Route::get('/daftarlaporanberkalakadis', [LaporanBerkalaKadisController::class, 'index'])->name('kadis.laporan.index');
    Route::get('/daftarlaporanberkalakadis/{id}', [LaporanBerkalaKadisController::class, 'show'])->name('kadis.laporan.show');


    // Aksi approval oleh Kadis
    Route::post('/pengajuan/{id}/approve-kadis', [LaporanBerkalaKadisController::class, 'approve'])->name('pengajuan.approve.kadis');

    // Kelola Pegawai (oleh Kepala Bidang)
    Route::get('/kelolapegawai', [KepalaBidangController::class, 'index'])->name('kepala-bidang.index');
    Route::post('/kepala-bidang', [KepalaBidangController::class, 'store'])->name('kepala-bidang.store');
    Route::delete('/kepala-bidang/{id}', [KepalaBidangController::class, 'destroy'])->name('kepala-bidang.destroy');
});






// Route untuk Kabid - melihat detail pengajuan untuk verifikasi
Route::get('/pengajuan/{id}', [LaporanBerkalaKepalaBidangController::class, 'show'])
    ->name('pengajuan.show');

// Route untuk pengguna biasa - melihat detail pengajuan sendiri
Route::get('/pengajuan/{id}/detail', [PengajuanController::class, 'show'])->name('pengajuan.detail');

Route::get('/lampiran/{filename}', function ($filename) {
    $path = storage_path('app/private/uploads/' . $filename);

    if (!file_exists($path)) {
        abort(404, 'File tidak ditemukan: ' . $path);
    }

    return response()->file($path);
})->name('lampiran.show');

Route::get('/lampiran/{file}', [LampiranController::class, 'show'])->name('lampiran.show');

// Document routes - untuk download lembar pengesahan
Route::middleware('auth')->group(function () {
    Route::get('/dokumen/lembar-pengesahan/{id}/download', [DocumentController::class, 'downloadLembarPengesahan'])
        ->name('dokumen.lembar-pengesahan.download');
    Route::get('/dokumen/lembar-pengesahan/{id}/preview', [DocumentController::class, 'previewLembarPengesahan'])
        ->name('dokumen.lembar-pengesahan.preview');
    Route::get('/dokumen/word/{id}/download', [DocumentController::class, 'downloadWordDocument'])
        ->name('dokumen.word.download');
    
    // Upload dan download PDF yang sudah diupload
    Route::post('/dokumen/upload-pdf', [DocumentController::class, 'uploadPengesahanPdf'])
        ->name('dokumen.upload-pdf');
    Route::get('/dokumen/pdf/{id}/download', [DocumentController::class, 'downloadUploadedPdf'])
        ->name('dokumen.pdf.download');
    Route::get('/dokumen/pdf/{id}/preview', [DocumentController::class, 'previewPdf'])
        ->name('dokumen.pdf.preview');
});

// Debug route (remove in production)
Route::get('/debug/document/{id}', function($id) {
    try {
        // Gunakan query yang sama seperti DocumentController methods
        $pengajuan = App\Models\Pengajuan::with([
            'pengguna.identitas',
            'pengguna.identitasPengguna',
            'evaluator.identitasTimAdmin'
        ])->findOrFail($id);
        
        // Ambil data lengkap untuk debugging
        $identitas = $pengajuan->pengguna->identitas;
        $identitasPengguna = $pengajuan->pengguna->identitasPengguna;
        $evaluator = $pengajuan->evaluator;
        
        return response()->json([
            'success' => true,
            'data' => [
                'id' => $pengajuan->id,
                'status' => $pengajuan->status,
                'nomor_pengesahan' => $pengajuan->nomor_pengesahan,
                'created_at' => $pengajuan->created_at->format('d F Y'),
                'catatan_kadis' => $pengajuan->catatan_kadis,
                'perusahaan' => [
                    'nama_badan_usaha' => $identitas->namabadanusaha ?? null,
                    'nib' => $identitas->nib ?? null,
                    'email_perusahaan' => $identitas->email_perusahaan ?? null,
                    'alamat_kantor_pusat' => $identitas->alamatkantorpusat ?? null,
                    'alamat_kantor_cabang' => $identitas->alamatkantorcabang ?? null,
                    'no_telp_pusat' => $identitas->notelpkantorpusat ?? null,
                    'no_telp_cabang' => $identitas->notelpkantorcabang ?? null,
                    'contact_person_nama' => $identitas->contact_person_nama ?? null,
                    'contact_person_jabatan' => $identitas->contact_person_jabatan ?? null,
                    'contact_person_email' => $identitas->contact_person_email ?? null,
                    'contact_person_no_telp' => $identitas->contact_person_no_telp ?? null
                ],
                'pengguna' => [
                    'nama' => $identitasPengguna->nama ?? null,
                    'email' => $pengajuan->pengguna->email ?? null
                ],
                'evaluator' => [
                    'nama' => $evaluator->identitasTimAdmin->nama ?? null,
                    'nip' => $evaluator->identitasTimAdmin->nip ?? null
                ]
            ]
        ]);
    } catch (Exception $e) {
        return response()->json([
            'success' => false,
            'error' => $e->getMessage()
        ]);
    }
})->middleware('auth');

Route::post('/identitas/store', [IdentitasTimAdminController::class, 'store'])
    ->name('identitas.store');

// Route AJAX list pengajuan
Route::get('/daftar-pengajuan/list', [DaftarPengajuanController::class, 'list']);



Route::get('/masuk', fn() => view('auth.masuk'))->name('masuk');
Route::post('/daftar', [AuthControllerManual::class, 'daftar'])->name('daftar');
Route::get('/masuk', [AuthControllerManual::class, 'showMasukForm'])->name('masuk');
Route::post('/masuk', [AuthControllerManual::class, 'masuk'])->name('masuk');
Route::post('/logout', [AuthControllerManual::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {


    // Edit & Update (umum)
    Route::get('/profile/edit', [IdentitasTimAdminController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [IdentitasTimAdminController::class, 'update'])->name('profile.update');
    Route::get('/tim-admin/edit', [IdentitasTimAdminController::class, 'edit'])->name('tim_admin.edit');
    Route::post('/tim-admin/update', [IdentitasTimAdminController::class, 'update'])->name('tim_admin.update');
});



Route::middleware(['auth', 'profile.complete'])->group(function () {
    Route::get('/berandapengguna', [DashboardController::class, 'index'])->name('berandapengguna');

    /* Tampilkan form
    Route::get('/laporanberkala', [LaporanBerkalaController::class, 'create'])->name('laporanberkala.create');
    Route::post('/laporanberkala', [LaporanBerkalaController::class, 'store'])->name('laporanberkala.store');
*/
});


// Route lamaaa
Route::get('/laporanberkala', function () {
    return view('laporanberkala');
})->name('laporanberkala');


Route::get('/formBerkala', function () {
    return view('Controller');
})->name('/formBerkala');


Route::get('/', function () {
    return view('index');
})->name('/');

Route::get('/masuk', function () {
    return view('masuk');
})->name('masuk');

Route::get('/daftar', function () {
    return view('daftar');
})->name('daftar');

Route::get('/berandakabid', [BerandakabidController::class, 'index'])->name('berandakabid');

Route::get('/berandaevaluator', [EvaluatorController::class, 'dashboard'])
    ->name('berandaevaluator')
    ->middleware('auth', 'is_evaluator');

Route::get('/berandakadis', [LaporanBerkalaKadisController::class, 'dashboard'])->name('berandakadis');


Route::get('/verbase', function () {
    return view('verbase');
})->name('verbase');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::get('/laporanberkala', function () {
    return view('laporanberkala');
})->name('laporanberkala');

Route::get('/daftarlaporanberkalapengguna', function () {
    return view('daftarlaporanberkalapengguna');
})->name('daftarlaporanberkalapengguna');

// Route ini sudah dipindahkan ke middleware is_kadis

Route::get('/halamanverifikasi', function () {
    return view('halamanverifikasi');
})->name('halamanverfikasi');

Route::get('/halamanverifikasiperbaikan', function () {
    return view('halamanverifikasiperbaikan');
})->name('halamanverifikasiperbaikan');

Route::get('/halamanverifikasiselesai', function () {
    return view('halamanverifikasitelahdievaluasi');
})->name('halamanverifikasiselesai');

Route::get('/halamankepalabidang', function () {
    return view('halamankepalabidang');
})->name('halamankepalabidang');


Route::get('/lembarpengesahankadis', function () {
    return view('lembarpengesahankadis');
})->name('lembarpengesahankadis');


Route::get('/suratperbaikan', function () {
    return view('suratperbaikan');
})->name('suratperbaikan');

Route::get('/laporanberkala', function () {
    return view('laporanberkala');
})->name('laporanberkala');

Route::get('/verifikasiemail', function () {
    return view('verifikasiemail');
})->name('verifikasiemail');


Route::get('/formdataberkala', function () {
    return view('formdataberkala');
})->name('formdataberkala');

Route::get('/formdataumum', function () {
    return view('formdataumum');
})->name('formdataumum');
