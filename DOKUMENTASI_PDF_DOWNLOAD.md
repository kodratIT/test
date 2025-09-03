# Dokumentasi Fungsi Download PDF

## Overview
Fungsi download PDF memungkinkan pengguna untuk mendownload file PDF lembar pengesahan yang sudah diupload sebelumnya.

## Komponen yang Terlibat

### 1. Route
```php
// File: routes/web.php (line 202)
Route::get('/dokumen/pdf/{id}/download', [DocumentController::class, 'downloadUploadedPdf'])
    ->name('dokumen.pdf.download');
```

### 2. Controller Method
```php
// File: app/Http/Controllers/DocumentController.php
public function downloadUploadedPdf($pengajuanId)
```

**Fitur:**
- ✅ Validasi pengajuan exists
- ✅ Cek file PDF exists di database
- ✅ Cek file fisik exists di storage
- ✅ Security check file readable
- ✅ Proper HTTP headers untuk download
- ✅ Error handling lengkap
- ✅ Logging untuk audit trail
- ✅ JSON response untuk AJAX calls

### 3. Database Field
```php
// File: app/Models/Pengajuan.php (line 89)
'lembar_pengesahan_pdf' // menyimpan path file PDF
```

### 4. Storage Location
```
storage/app/private/pengesahan/
```

## Cara Kerja

### 1. Upload PDF (Prerequisite)
Sebelum bisa download, PDF harus diupload dulu melalui form upload:
```
POST /dokumen/upload-pdf
```

### 2. Download PDF
```
GET /dokumen/pdf/{pengajuan_id}/download
```

**Flow:**
1. User klik link "Download PDF" 
2. Browser request ke `/dokumen/pdf/{id}/download`
3. Controller cek:
   - Pengajuan exists ✅
   - Field `lembar_pengesahan_pdf` not null ✅
   - File exists di storage ✅
   - File readable ✅
4. Return file download dengan proper headers

## Frontend Integration

### Di Blade Template (daftarlaporanberkalakabid.blade.php)

**Kondisi untuk menampilkan Download PDF:**
```javascript
if (item.has_pdf) {
    // Tampilkan menu "Download PDF"
    menuItems.push(`
      <a href="/dokumen/pdf/${item.id}/download" class="...">
        <svg>...</svg>
        Download PDF
      </a>
    `);
} else {
    // Tampilkan menu "Upload PDF"
    // ...
}
```

## Error Handling

### 1. File Belum Diupload
```json
{
    "success": false,
    "message": "File PDF belum diupload untuk pengajuan ini."
}
```

### 2. File Tidak Ditemukan di Server
```json
{
    "success": false,
    "message": "File PDF tidak ditemukan di server."
}
```

### 3. Pengajuan Tidak Ditemukan
```json
{
    "success": false,
    "message": "Pengajuan tidak ditemukan."
}
```

## Security Features

### 1. File Path Sanitization
```php
$namaPerusahaanClean = preg_replace('/[^A-Za-z0-9_-]/', '_', $namaPerusahaan);
```

### 2. Proper HTTP Headers
```php
return response()->download($filePath, $fileName, [
    'Content-Type' => 'application/pdf',
    'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
    'Cache-Control' => 'no-cache, no-store, must-revalidate',
    'Pragma' => 'no-cache',
    'Expires' => '0'
]);
```

### 3. File Readable Check
```php
if (!is_readable($filePath)) {
    // Handle error
}
```

## Logging & Monitoring

### Success Log
```php
\Log::info('PDF download successful', [
    'pengajuan_id' => $pengajuanId,
    'file_path' => $pengajuan->lembar_pengesahan_pdf,
    'file_name' => $fileName,
    'user_id' => auth()->id()
]);
```

### Error Log
```php
\Log::error('Download Uploaded PDF Error: ' . $e->getMessage(), [
    'pengajuan_id' => $pengajuanId,
    'user_id' => auth()->id(),
    'stack_trace' => $e->getTraceAsString()
]);
```

## Testing

### Manual Test
1. Login sebagai user yang berhak
2. Buka halaman daftar laporan berkala
3. Pilih pengajuan dengan status "disetujui"
4. Upload PDF melalui form upload
5. Refresh halaman
6. Klik "Download PDF"
7. File harus terdownload dengan nama yang sesuai

### Automated Test Script
```bash
php test_pdf_download.php
```

## Status Implementation

✅ **SELESAI & SIAP DIGUNAKAN**

- [x] Route registered
- [x] Controller method implemented
- [x] Database field ready
- [x] Storage directory exists
- [x] Frontend integration complete
- [x] Error handling comprehensive
- [x] Security features implemented
- [x] Logging & monitoring active
- [x] Testing completed

## File Yang Sudah Diupload (dari test)
- lembar_pengesahan_10_CV_Solar_Power_Indon_1756789703.pdf (280KB)
- lembar_pengesahan_11_CV_Solar_Power_Indon_1756863430.pdf (280KB) 
- lembar_pengesahan_11_CV_Solar_Power_Indon_1756863935.pdf (280KB)
- lembar_pengesahan_11_CV_Solar_Power_Indon_1756864008.pdf (280KB)

**Fungsi download PDF siap digunakan!** 🎉
