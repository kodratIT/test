<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class PenugasanController extends Controller
{
    public function create()
{
    // Ambil semua user dengan role evaluator
    $evaluators = User::where('role_pengguna', 'evaluator')->get();

    return view('penugasan.create', compact('evaluators'));
}

}


