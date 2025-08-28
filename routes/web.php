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
use App\Http\Controllers\EvaluatorController;
use App\Http\Controllers\BadanusahaController;
use App\Http\Controllers\LaporanBerkalaEvaluatorController;
use App\Http\Controllers\LampiranController;

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

    Route::prefix('daftarlaporanberkalakabid')->group(function () {
        Route::get('/', [LaporanBerkalaKepalaBidangController::class, 'index'])->name('laporan.kabid.index');
        Route::get('/list', [LaporanBerkalaKepalaBidangController::class, 'getList'])->name('laporan.kabid.list');
    });

    Route::post('/pengajuan/{id}/kirim-evaluator', [PengajuanController::class, 'kirimKeEvaluator'])->name('pengajuan.kirimEvaluator');

    // routes/web.php
    Route::post('/pengajuan/{id}/kirim-evaluator', [PengajuanController::class, 'kirimKeEvaluator'])->name('pengajuan.kirim');

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

    // route submit evaluasi
    Route::post('/evaluasi/{id}/submit', [LaporanBerkalaEvaluatorController::class, 'submit'])
        ->name('laporan.evaluator.submit');

    Route::get('/evaluator/pengajuan', [EvaluatorController::class, 'daftarPengajuan'])->name('evaluator.pengajuan');
});


//kadis
Route::middleware(['auth', 'is_kadis'])->group(function () {
    Route::get('/profilevalidator', [IdentitasTimAdminController::class, 'showProfile'])->name('profilevalidator');

    // Kelola Pegawai (oleh Kepala Bidang)
    Route::get('/kelolapegawai', [KepalaBidangController::class, 'index'])->name('kepala-bidang.index');
    Route::post('/kepala-bidang', [KepalaBidangController::class, 'store'])->name('kepala-bidang.store');
    Route::delete('/kepala-bidang/{id}', [KepalaBidangController::class, 'destroy'])->name('kepala-bidang.destroy');
});






Route::get('/pengajuan/{id}', [PengajuanController::class, 'show'])->name('pengajuan.show');
Route::get('/pengajuan/{id}', [LaporanBerkalaKepalaBidangController::class, 'show'])
    ->name('pengajuan.show');

Route::get('/lampiran/{filename}', function ($filename) {
    $path = storage_path('app/private/uploads/' . $filename);

    if (!file_exists($path)) {
        abort(404, 'File tidak ditemukan: ' . $path);
    }

    return response()->file($path);
})->name('lampiran.show');

Route::get('/lampiran/{file}', [LampiranController::class, 'show'])->name('lampiran.show');


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

Route::get('/berandakabid', function () {
    return view('berandakabid');
})->name('berandakabid');

Route::get('/berandaevaluator', function () {
    return view('berandaevaluator');
})->name('berandaevaluator');

Route::get('/berandakadis', function () {
    return view('berandakadis');
})->name('berandakadis');

Route::get('/berandapengguna', function () {
    return view('berandapengguna');
})->name('berandapengguna');

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

Route::get('/daftarlaporanberkalakadis', function () {
    return view('daftarlaporanberkalakadis');
})->name('daftarlaporanberkalakadis');

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
