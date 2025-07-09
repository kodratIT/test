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
}) ->name('daftar');

Route::get('/dashboarduser', function () {
    return view('baseuser');
}) ->name('dashboarduser');

Route::get('/dashboardadmin', function () {
    return view('baseadmin');
}) ->name('dashbordadmin');

Route::get('/dashboardver', function () {
    return view('basever');
}) ->name('dashbordver');

Route::get('/verbase', function () {
    return view('verbase');
}) ->name('verbase');


Route::get('/profile', function () {
    return view('profile');
}) ->name('profile');


Route::get('/pengajuansurat', function () {
    return view('surat');
}) ->name('pengajuansurat');

Route::get('/lihatsertifikat', function () {
    return view('lihatsertifikat');
}) ->name('lihatsertifikat');





