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
        
        // Array jalur yang mungkin untuk mencari file
        $possiblePaths = [
            // Path 1: storage/app/private/[path] (untuk file yang disimpan dengan store())
            storage_path('app/private/' . $path),
            
            // Path 2: storage/app/[path] (untuk file yang disimpan tanpa 'private')
            storage_path('app/' . $path),
            
            // Path 3: storage/app/public/[path] (untuk file publik)
            storage_path('app/public/' . $path),
            
            // Path 4: public/storage/[path] (untuk file yang di-link)
            public_path('storage/' . $path)
        ];
        
        \Log::info("Checking multiple file paths", [
            'path_from_db' => $path,
            'possible_paths' => $possiblePaths
        ]);
        
        // Coba setiap jalur yang mungkin
        foreach ($possiblePaths as $filePath) {
            if (file_exists($filePath)) {
                // Set header yang tepat untuk PDF
                $mimeType = mime_content_type($filePath) ?: 'application/pdf';
                
                \Log::info("File found at path", [
                    'found_path' => $filePath,
                    'mime_type' => $mimeType,
                    'file_size' => filesize($filePath)
                ]);
                
                return response()->file($filePath, [
                    'Content-Type' => $mimeType,
                    'Cache-Control' => 'no-cache, no-store, must-revalidate',
                ]);
            }
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
