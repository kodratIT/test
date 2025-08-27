<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Kalau view dashboard kamu ada di resources/views/dashboarduser.blade.php
        return view('berandapengguna');
    }
}
