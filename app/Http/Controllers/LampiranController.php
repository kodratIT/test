<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class LampiranController extends Controller
{
    public function show($path)
    {
        // Debug: Log parameter yang diterima
        \Log::info("LampiranController@show called", [
            'requested_path' => $path,
            'storage_disk_root' => Storage::disk('local')->path(''),
            'storage_app_private' => storage_path('app/private'),
        ]);
        
        // Karena default disk 'local' memiliki root di storage/app/private
        // dan file disimpan dengan ->store('uploads'), maka file berada di storage/app/private/uploads/
        // tapi di database disimpan sebagai 'uploads/filename.pdf'
        
        $actualPath = null;
        
        // Path di DB: uploads/Vj5ynOkLgUp3ZQOec5fZzeVO038wxyr5QG3NqiE5.pdf
        // File sebenarnya di: storage/app/private/uploads/Vj5ynOkLgUp3ZQOec5fZzeVO038wxyr5QG3NqiE5.pdf
        
        // Langsung build path file berdasarkan struktur yang kita tahu
        $filePath = storage_path('app/private/' . $path);
        
        \Log::info("Checking file path", [
            'path_from_db' => $path,
            'full_file_path' => $filePath,
            'file_exists' => file_exists($filePath)
        ]);
        
        // Pastikan file benar-benar ada di sistem file
        if (file_exists($filePath)) {
            // Set header yang tepat untuk PDF
            $mimeType = mime_content_type($filePath) ?: 'application/pdf';
            
            \Log::info("File found, serving", [
                'mime_type' => $mimeType,
                'file_size' => filesize($filePath)
            ]);
            
            return response()->file($filePath, [
                'Content-Type' => $mimeType,
                'Cache-Control' => 'no-cache, no-store, must-revalidate',
            ]);
        }

        // Log untuk debugging
        \Log::error("File tidak ditemukan: {$path}", [
            'requested_path' => $path,
            'full_file_path' => $filePath,
            'file_exists' => file_exists($filePath),
            'storage_private_path' => storage_path('app/private'),
            'is_readable' => is_readable($filePath ?? ''),
        ]);

        return abort(404, "File tidak ditemukan: {$path}");
    }
}
