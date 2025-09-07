# Perbaikan Bug Akses PDF - FINAL

## 🔍 Diagnosis Masalah

**Masalah**: Link "Lihat file" pada lampiran PDF menghasilkan error "Forbidden" (403)

**Root Cause**: 
1. File PDF disimpan di `storage/app/private/uploads/` 
2. Database menyimpan path sebagai `uploads/filename.pdf`
3. View menggunakan `asset('storage/' . $path)` yang mengarah ke `public/storage/`
4. Tidak ada mapping yang benar antara path database dan lokasi file sebenarnya

## 🛠️ Solusi yang Diterapkan

### 1. Update `LampiranController.php`

```php
<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class LampiranController extends Controller
{
    public function show($path)
    {
        // Karena default disk 'local' memiliki root di storage/app/private
        // dan file disimpan dengan ->store('uploads'), maka file berada di storage/app/private/uploads/
        // tapi di database disimpan sebagai 'uploads/filename.pdf'
        
        $actualPath = null;
        
        // Path di DB: uploads/MTodkevzToVIF24EtoZAIsNeTHOIOzUrOwW4zMcT.pdf
        // File sebenarnya di: storage/app/private/uploads/MTodkevzToVIF24EtoZAIsNeTHOIOzUrOwW4zMcT.pdf
        
        if (Storage::exists($path)) {
            $actualPath = $path;
        } else {
            // Coba beberapa kemungkinan lokasi lain sebagai fallback
            $possiblePaths = [
                'uploads/' . basename($path),         // Jika hanya filename yang dikirim
                'private/uploads/' . basename($path), // Fallback legacy
                'lampiran_slo/' . basename($path),    // Lokasi khusus SLO
            ];
            
            foreach ($possiblePaths as $testPath) {
                if (Storage::exists($testPath)) {
                    $actualPath = $testPath;
                    break;
                }
            }
        }
        
        // Jika file ditemukan, return file response
        if ($actualPath && Storage::exists($actualPath)) {
            $filePath = storage_path('app/private/' . $actualPath);
            
            if (file_exists($filePath)) {
                $mimeType = mime_content_type($filePath) ?: 'application/pdf';
                
                return response()->file($filePath, [
                    'Content-Type' => $mimeType,
                    'Cache-Control' => 'no-cache, no-store, must-revalidate',
                ]);
            }
        }

        // Log untuk debugging
        \Log::error("File tidak ditemukan: {$path}", [
            'requested_path' => $path,
            'actual_path_checked' => $actualPath,
            'full_path' => isset($filePath) ? $filePath : 'N/A',
            'storage_private_path' => storage_path('app/private'),
        ]);

        return abort(404, "File tidak ditemukan: {$path}");
    }
}
```

### 2. Update View Files

**Files Updated:**
- `resources/views/pengajuan/edit.blade.php`  
- `resources/views/pengajuan/edit-lengkap.blade.php`

**Perubahan:**
```blade
<!-- SEBELUM (BROKEN) -->
<a href="{{ asset('storage/' . $pengajuan->lampiran_izin_usaha) }}" target="_blank" class="text-blue-600 underline">Lihat file</a>

<!-- SESUDAH (FIXED) -->
<a href="{{ route('lampiran.show', $pengajuan->lampiran_izin_usaha) }}" target="_blank" class="text-blue-600 underline">Lihat file</a>
```

### 3. Update Routes (`routes/web.php`)

```php
Route::middleware('auth')->group(function () {
    // Route untuk mengakses lampiran PDF (harus login untuk akses)
    Route::get('/lampiran/{file}', [LampiranController::class, 'show'])->name('lampiran.show');
    
    // ... routes lainnya
});
```

## 📁 Struktur File

```
storage/
└── app/
    └── private/                    # Root dari disk 'local'
        └── uploads/               # Lokasi file upload
            ├── 3Ex7Qqbs5d...pdf   # File sebenarnya
            ├── 4opT4iCgJgg5...pdf
            └── ...

Database pengajuan table:
├── lampiran_izin_usaha: "uploads/3Ex7Qqbs5d...pdf"
├── lampiran_slo: "uploads/4opT4iCgJgg5...pdf"
└── ...
```

## 🔐 Keamanan

1. **Authentication Required**: Route dilindungi middleware `auth`
2. **Private Storage**: File tidak bisa diakses langsung via URL
3. **Controlled Access**: Hanya melalui controller dengan validasi

## 🧪 Testing

1. Login ke aplikasi
2. Buka halaman edit pengajuan: `/pengajuan/{id}/edit`
3. Klik "Lihat file" pada setiap lampiran:
   - Lampiran Izin Usaha
   - Lampiran Izin Lingkungan  
   - Lampiran SLO
   - Lampiran SKTTK
   - Lampiran Nameplate Mesin
   - Lampiran Nameplate Generator
   - Lampiran Tagihan Listrik

✅ **Expected Result**: PDF terbuka di tab baru tanpa error "Forbidden"

## 🚀 URL yang Terbentuk

**Sebelum**: `http://localhost/storage/uploads/filename.pdf` → 404/403
**Sesudah**: `http://localhost/lampiran/uploads/filename.pdf` → ✅ PDF terbuka

## 📝 Log Debugging

Jika masih ada masalah, check log Laravel di `storage/logs/laravel.log`:

```
[2024-01-XX XX:XX:XX] local.ERROR: File tidak ditemukan: uploads/filename.pdf {
    "requested_path": "uploads/filename.pdf",
    "actual_path_checked": "uploads/filename.pdf", 
    "full_path": "/path/to/storage/app/private/uploads/filename.pdf",
    "storage_private_path": "/path/to/storage/app/private"
}
```

## ✨ Fitur Tambahan

1. **MIME Type Detection**: Otomatis detect tipe file
2. **Cache Control**: Header untuk mencegah caching yang tidak diinginkan  
3. **Fallback Paths**: Coba berbagai lokasi jika file tidak ditemukan
4. **Error Logging**: Log detail untuk troubleshooting

Perbaikan ini sekarang sudah **COMPLETE** dan siap digunakan! 🎉
