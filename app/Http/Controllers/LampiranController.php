<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class LampiranController extends Controller
{
    public function show($path)
    {
        // pastikan path relatif dari storage/app
        $path = 'private/lampiran_slo/' . $path;

        if (Storage::exists($path)) {
            return response()->file(storage_path('app/' . $path));
        }

        return abort(404, "File tidak ditemukan: {$path}");
    }
}
