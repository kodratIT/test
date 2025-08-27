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



// Halaman utama evaluator
Route::get('/daftarlaporanberkalaevaluator', [LaporanBerkalaEvaluatorController::class, 'index'])
    ->name('laporan.evaluator.index');

// API untuk ambil list data evaluator (AJAX)
Route::get('/daftarlaporanberkalaevaluator/list', [LaporanBerkalaEvaluatorController::class, 'getList'])
    ->name('laporan.evaluator.list');

// Detail pengajuan yang ditugaskan ke evaluator
Route::get('/daftarlaporanberkalaevaluator/{id}', [LaporanBerkalaEvaluatorController::class, 'show'])
    ->name('laporan.evaluator.show');

    Route::get('/daftarlaporanberkalaevaluator', [LaporanBerkalaEvaluatorController::class, 'index'])
    ->name('laporan.evaluator.index');



Route::post('/pengajuan/{id}/kirim-evaluator', [PengajuanController::class, 'kirimKeEvaluator'])->name('pengajuan.kirimEvaluator');

// routes/web.php
Route::post('/pengajuan/{id}/kirim-evaluator', [PengajuanController::class, 'kirimKeEvaluator'])->name('pengajuan.kirim');
Route::get('/evaluator/pengajuan', [EvaluatorController::class, 'daftarPengajuan'])->name('evaluator.pengajuan');
Route::get('/daftarlaporanberkalaevaluator', [PengajuanController::class, 'daftarLaporanEvaluator'])->name('daftarlaporanberkalaevaluator');





Route::prefix('daftarlaporanberkalakabid')->group(function () {
    Route::get('/', [LaporanBerkalaKepalaBidangController::class, 'index'])->name('laporan.kabid.index');
    Route::get('/list', [LaporanBerkalaKepalaBidangController::class, 'getList'])->name('laporan.kabid.list');
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







// Kelola Pegawai (oleh Kepala Bidang)
Route::get('/kelolapegawai', [KepalaBidangController::class, 'index'])->name('kepala-bidang.index');
Route::post('/kepala-bidang', [KepalaBidangController::class, 'store'])->name('kepala-bidang.store');
Route::delete('/kepala-bidang/{id}', [KepalaBidangController::class, 'destroy'])->name('kepala-bidang.destroy');

// kelola evaluator
Route::get('/kelolaevaluator', [EvaluatorController::class, 'index'])->name('evaluator.index');
Route::post('/evaluator/store', [EvaluatorController::class, 'store'])->name('evaluator.store');
Route::delete('/evaluator/{id}', [EvaluatorController::class, 'destroy'])->name('evaluator.destroy');

//kelola badan usaha
Route::get('/kelolabadanusaha', [BadanusahaController::class, 'index'])->name('pengguna.index');
Route::post('/pengguna/store', [BadanusahaController::class, 'store'])->name('pengguna.store');
Route::delete('/pengguna/{id}', [BadanusahaController::class, 'destroy'])->name('pengguna.destroy');


Route::post('/identitas/store', [IdentitasTimAdminController::class, 'store'])
    ->name('identitas.store');



Route::get('/profilevalidator', [IdentitasTimAdminController::class, 'showProfile'])->name('profilevalidator');
Route::get('/tim-admin/edit', [IdentitasTimAdminController::class, 'edit'])->name('tim_admin.edit');
Route::post('/tim-admin/update', [IdentitasTimAdminController::class, 'update'])->name('tim_admin.update');



Route::get('/profilekabid', [IdentitasTimAdminController::class, 'showProfileKabid'])->name('profile.kabid');




Route::get('/profileevaluator', [IdentitasTimAdminController::class, 'showProfileEvaluator'])
    ->name('profileevaluator');



Route::get('/masuk', fn() => view('auth.masuk'))->name('masuk');
Route::post('/daftar', [AuthControllerManual::class, 'daftar'])->name('daftar');
Route::get('/masuk', [AuthControllerManual::class, 'showMasukForm'])->name('masuk');
Route::post('/masuk', [AuthControllerManual::class, 'masuk'])->name('masuk');
Route::post('/logout', [AuthControllerManual::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
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

    // Route AJAX list pengajuan
    Route::get('/daftar-pengajuan/list', [DaftarPengajuanController::class, 'list']);



    /* Profil berdasarkan role
Route::get('/profilevalidator', [IdentitasTimAdminController::class, 'showProfileValidator'])->name('profile.validator');
Route::get('/profilekabid', [IdentitasTimAdminController::class, 'showProfileKabid'])->name('profile.kabid');
Route::get('/profileevaluator', [IdentitasTimAdminController::class, 'showProfileEvaluator'])->name('profile.evaluator');
*/
    // Edit & Update (umum)
    Route::get('/profile/edit', [IdentitasTimAdminController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [IdentitasTimAdminController::class, 'update'])->name('profile.update');















    // Halaman form pengajuan (misalnya view: resources/views/pengajuan/form.blade.php)
    Route::get('/pengajuan', function () {
        return view('pengajuan.form');
    })->name('pengajuan.form');

    // Proses simpan data pengajuan
    Route::post('/pengajuan/store', [PengajuanController::class, 'store'])->name('pengajuan.store');
});



Route::middleware(['auth', 'profile.complete'])->group(function () {
    Route::get('/berandapengguna', [DashboardController::class, 'index'])->name('berandapengguna');

    /* Tampilkan form
    Route::get('/laporanberkala', [LaporanBerkalaController::class, 'create'])->name('laporanberkala.create');
    Route::post('/laporanberkala', [LaporanBerkalaController::class, 'store'])->name('laporanberkala.store');
*/
});


// Halaman form pengisian surat berkala
Route::get('/laporanberkala', function () {
    return view('laporanberkala');
})->name('laporanberkala');

/* Menyimpan data dari form
Route::post('/laporanberkala', [LaporanBerkalaController::class, 'store'])->name('laporanberkala.store');

// Melihat data yang telah diinputkan
Route::get('/laporanberkala/data', [LaporanBerkalaController::class, 'index'])->name('lamporanberkala.index');
*/

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


//Route::get('/dashboarduser', function () {
//return view('baseuser');
// })->name('dashboarduser');//



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




Route::get('/daftarlaporanberkalaevaluator', function () {
    return view('daftarlaporanberkalaevaluator');
})->name('daftarlaporanberkalaevaluator');



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
