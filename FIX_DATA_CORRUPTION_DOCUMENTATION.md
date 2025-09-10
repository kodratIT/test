# Fix: Data Corruption Bug pada Status Perbaikan

## Masalah yang Ditemukan

Ketika Kabid mengubah status pengajuan menjadi "perbaikan", data teknis seperti SLO, Mesin, Generator, dan SKTTK berubah menjadi nilai "1" atau kosong/null. 

## Analisis Root Cause

1. **Controller Update Method** (`DaftarPengajuanController@update`) menggunakan logika yang tidak tepat untuk menangani array dinamis
2. **Data Array Handling** - Controller selalu mengganti data existing dengan data baru, tanpa memeriksa apakah data baru valid
3. **Form Submission** - Ketika form tidak mengirim data array yang lengkap, controller mengganti dengan array kosong

## Perbaikan yang Dilakukan

### 1. Update Method Controller (`app/Http/Controllers/DaftarPengajuanController.php`)

#### Sebelum (Bermasalah):
```php
// ===== Mesin Data =====
$mesinList = [];
if ($request->has('jenis_penggerak')) {
    foreach ($request->input('jenis_penggerak', []) as $i => $jenis) {
        $mesinList[] = [
            'jenis_penggerak' => $request->input("jenis_penggerak.$i"),
            // ... field lainnya
        ];
    }
}
$data['mesin'] = $mesinList; // ❌ SELALU mengganti, bahkan jika kosong
```

#### Sesudah (Diperbaiki):
```php
// ===== Mesin Data =====
// Hanya update Mesin jika ada data yang dikirim dan valid
if ($request->has('jenis_penggerak') && is_array($request->input('jenis_penggerak')) && !empty(array_filter($request->input('jenis_penggerak')))) {
    $mesinList = [];
    foreach ($request->input('jenis_penggerak', []) as $i => $jenis) {
        // Skip baris kosong
        if (empty(trim($jenis ?? ''))) continue;
        
        $mesinList[] = [
            'jenis_penggerak' => $request->input("jenis_penggerak")[$i] ?? null,
            // ... field lainnya
        ];
    }
    // Hanya update jika ada data valid
    if (!empty($mesinList)) {
        $data['mesin'] = $mesinList;
    }
}
// ✅ Jika tidak ada data mesin baru, pertahankan data lama
```

### 2. Tambahan Logging dan Validasi

```php
// Log data sebelum update untuk debugging
\Log::info('Updating pengajuan ID: ' . $id, [
    'user_id' => $userId,
    'old_status' => $pengajuan->status,
    'new_status' => $data['status'] ?? $pengajuan->status,
    'has_slo_data' => isset($data['slo']),
    'has_mesin_data' => isset($data['mesin']),
    'has_generator_data' => isset($data['generator']),
    'has_skttk_data' => isset($data['skttk']),
]);

// Validasi data sebelum update
if (isset($data['slo']) && empty($data['slo'])) {
    unset($data['slo']); // Hapus field kosong untuk preserve data lama
}
if (isset($data['mesin']) && empty($data['mesin'])) {
    unset($data['mesin']);
}
if (isset($data['generator']) && empty($data['generator'])) {
    unset($data['generator']);
}
if (isset($data['skttk']) && empty($data['skttk'])) {
    unset($data['skttk']);
}
```

## Files yang Diubah

1. `app/Http/Controllers/DaftarPengajuanController.php` - Method `update()` 

## Testing yang Diperlukan

### 1. Test Scenario: Perbaikan Data Tidak Merusak Data Existing

```bash
# 1. Buat pengajuan dengan data lengkap (SLO, Mesin, Generator)
# 2. Submit untuk evaluasi 
# 3. Kabid ubah status ke "perbaikan"
# 4. User edit dan submit kembali
# 5. Verifikasi data teknis tidak berubah menjadi "1" atau null
```

### 2. Test Script untuk Verifikasi Database

```php
// Jalankan script PHP untuk cek data
$pengajuan = App\Models\Pengajuan::find([ID]);

echo "=== Data SLO ===\n";
var_dump($pengajuan->slo);

echo "\n=== Data Mesin ===\n";  
var_dump($pengajuan->mesin);

echo "\n=== Data Generator ===\n";
var_dump($pengajuan->generator);

echo "\n=== Status ===\n";
echo $pengajuan->status;
```

### 3. Monitoring Logs

```bash
# Monitor log Laravel untuk melihat proses update
tail -f storage/logs/laravel.log | grep "Updating pengajuan"
```

## Expected Results

✅ **Setelah perbaikan:**
- Data SLO, Mesin, Generator, SKTTK tetap utuh saat status diubah ke "perbaikan"
- Hanya field yang benar-benar diubah user yang akan terupdate
- Data existing yang tidak disentuh akan tetap preserved
- Log menunjukkan field mana yang diupdate vs yang dipreserve

❌ **Sebelum perbaikan:**
- Data array berubah menjadi nilai "1" atau null
- Data teknis hilang setelah status "perbaikan"
- Tidak ada logging untuk debugging

## Rollback Plan

Jika terjadi masalah, rollback dengan:

```bash
git checkout [COMMIT_HASH_SEBELUM_PERUBAHAN]
```

Atau restore method `update()` dari backup sebelumnya.

## Additional Notes

- Form edit SUDAH BENAR dalam menampilkan data existing
- Masalah utama ada di controller, bukan di view
- Perbaikan ini bersifat backward compatible
- Tidak mempengaruhi pengajuan baru atau flow normal lainnya
