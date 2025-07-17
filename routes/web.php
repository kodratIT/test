<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('/');

Route::get('/masuk', function () {
    return view('masuk');
})->name('masuk');

Route::get('/daftar', function () {
    return view('daftar');
})->name('daftar');

Route::get('/dashboarduser', function () {
    return view('baseuser');
})->name('dashboarduser');

Route::get('/dashboardadmin', function () {
    return view('baseadmin');
})->name('dashbordadmin');

Route::get('/dashboardver', function () {
    return view('basever');
})->name('dashbordver');

Route::get('/berandaevaluator', function () {
    return view('berandaevaluator');
})->name('berandaevaluator');

Route::get('/berandavalidator', function () {
    return view('berandavalidator');
})->name('berandavalidator');

Route::get('/verbase', function () {
    return view('verbase');
})->name('verbase');


Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::get('/profilevalidator', function () {
    return view('profilevalidator');
})->name('profilevalidator');

Route::get('/profileevaluator', function () {
    return view('profileevaluator');
})->name('profileevaluator');


Route::get('/pengajuansurat', function () {
    return view('surat');
})->name('pengajuansurat');

Route::get('/lihatsertifikat', function () {
    return view('lihatsertifikat');
})->name('lihatsertifikat');

Route::get('/validator', function () {
    return view('validator');
})->name('validator');

Route::get('/daftarpengajuanpengguna', function () {
    return view('daftarpengajuanpengguna');
})->name('daftarpengajuanpengguna');

Route::get('/daftarpengajuanevaluator', function () {
    return view('daftarpengajuaneval');
})->name('daftarpengajuanevaluator');

Route::get('/halamanevaluasi', function () {
    return view('halamanevaluasi');
})->name('halamanevaluasi');

Route::get('/daftarpengajuanvalidator', function () {
    return view('daftarpengajuanvalidator');
})->name('daftarpengajuanvalidator');


Route::get('/daftarpengajuanteknis', function () {
    return view('pengajuantimteknis');
})->name('daftarpengajuanteknis');

Route::get('/daftarpengajuanval', function () {
    return view('daftarpengajuanval');
})->name('daftarpengajuanval');

Route::get('/suketval', function () {
    return view('suketval');
})->name('suketval');


Route::get('/suratterbituser', function () {
    return view('suratterbituser');
})->name('suratterbituser');

Route::get('/verifikasiemail', function () {
    return view('verifikasiemail');
})->name('verifikasiemail');


