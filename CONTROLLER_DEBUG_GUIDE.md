# Panduan Debugging Controller DaftarPengajuanController

## Perbaikan yang Telah Dilakukan

### 🔧 **Masalah yang Dipecahkan:**
1. **Data array jadi NULL** saat update
2. **Field tidak terisi** menjadi overwrite data existing
3. **Tidak ada logging** untuk debugging
4. **Distribusi dan Pemakaian Sendiri** selalu ter-overwrite

### ✅ **Perbaikan yang Diterapkan:**

#### 1. **Enhanced Logging System**
```php
// Log data BEFORE update
\Log::info('BEFORE UPDATE - Existing data for pengajuan ' . $id, [
    'existing_slo' => $pengajuan->slo,
    'existing_mesin' => $pengajuan->mesin,
    'existing_generator' => $pengajuan->generator,
    // ... dll
]);

// Log request data untuk debugging
\Log::info('REQUEST DATA DEBUG for pengajuan ' . $id, [
    'request_method' => $request->method(),
    'has_jenis_penggerak' => $request->has('jenis_penggerak'),
    // ... dll
]);

// Log data AFTER update untuk verification
\Log::info('AFTER UPDATE - Verifying data for pengajuan ' . $id, [
    'updated_slo_count' => is_array($pengajuan->slo) ? count($pengajuan->slo) : 'null',
    // ... dll
]);
```

#### 2. **Conditional Updates - Hanya Update Field yang Ada Data**

**Sebelum (Bermasalah):**
```php
// ❌ Selalu set data, bahkan jika kosong
$data['pemakaian_sendiri'] = $this->mapDynamicGroup(
    $request->pemakaian_sendiri ?? [],
    ['kapasitas', 'faktor_daya', 'jam_nyala', 'daya_terpakai']
);
```

**Sesudah (Diperbaiki):**
```php
// ✅ Hanya update jika ada data yang dikirim
if ($request->has('pemakaian_sendiri') && !empty($request->pemakaian_sendiri)) {
    $pemakaianData = $this->mapDynamicGroup(
        $request->pemakaian_sendiri,
        ['kapasitas', 'faktor_daya', 'jam_nyala', 'daya_terpakai']
    );
    if (!empty($pemakaianData)) {
        $data['pemakaian_sendiri'] = $pemakaianData;
    }
}
// Jika tidak ada data, field tidak ditambahkan ke $data = preserve existing
```

#### 3. **Smart Distribusi Handling**
```php
// Cek apakah ada data distribusi atau trafo
$hasDistribusiData = false;
foreach ($distribusiFields as $field) {
    if ($request->filled($field)) {
        $hasDistribusiData = true;
        break;
    }
}

// Hanya update jika ada data
if ($hasDistribusiData || $hasTrafoData) {
    $existingDistribusi = $pengajuan->distribusi ?? ['jaringan_distribusi' => [], 'trafo' => []];
    // Update hanya bagian yang ada datanya
    if ($hasDistribusiData) {
        $existingDistribusi['jaringan_distribusi'] = $jaringanDistribusi;
    }
    if ($hasTrafoData) {
        $existingDistribusi['trafo'] = [...];
    }
    $data['distribusi'] = $existingDistribusi;
}
```

#### 4. **Final Validation sebelum Update**
```php
$arrayFields = ['slo', 'mesin', 'generator', 'skttk', 'pemakaian_sendiri'];

foreach ($arrayFields as $field) {
    if (isset($data[$field])) {
        if (empty($data[$field])) {
            \Log::warning("Removing empty $field from update data to preserve existing data");
            unset($data[$field]); // Remove kosong = preserve existing
        }
    }
}
```

#### 5. **Data Integrity Check**
```php
// Cek integritas data setelah update
$integrityIssues = [];
if (is_array($pengajuan->slo)) {
    foreach ($pengajuan->slo as $i => $slo) {
        $hasValidData = false;
        foreach ($slo as $value) {
            if (!is_null($value) && trim((string)$value) !== '') {
                $hasValidData = true;
                break;
            }
        }
        if (!$hasValidData) {
            $integrityIssues[] = "SLO item $i is empty";
        }
    }
}
```

#### 6. **Helper Methods untuk Validasi**
```php
// Cek apakah array punya konten yang bermakna
private function hasValidArrayContent($data)
{
    // Check if array has any non-empty values
}

// Safe merge data existing dengan data baru
private function safeMergeArrayData($existingData, $newData)
{
    // Preserve existing if new data is empty
}
```

## 🔍 **Monitoring dan Debugging**

### 1. **Monitor Log Laravel**
```bash
# Real-time monitoring
tail -f storage/logs/laravel.log | grep "pengajuan"

# Filter specific logs
tail -f storage/logs/laravel.log | grep "BEFORE UPDATE"
tail -f storage/logs/laravel.log | grep "AFTER UPDATE"
tail -f storage/logs/laravel.log | grep "REQUEST DATA DEBUG"
```

### 2. **Log Markers untuk Debugging**
- `BEFORE UPDATE` - Data existing sebelum update
- `REQUEST DATA DEBUG` - Data yang dikirim dari form
- `AFTER UPDATE` - Data setelah update
- `Data integrity issues` - Warning jika ada data kosong

### 3. **Test Scenarios**

#### **Scenario 1: Edit Tanpa Mengubah Array Data**
```bash
# Expected behavior:
1. Form edit dibuka dengan data existing
2. User ubah hanya field statis (misal: nomor_izin_usaha)  
3. Submit form
4. Check log: "preserved" untuk semua array fields
5. Verify: Data SLO, Mesin, Generator tetap utuh
```

#### **Scenario 2: Edit Dengan Menambah Data Array**
```bash
# Expected behavior:
1. Form edit dibuka
2. User tambah 1 item SLO baru
3. Submit form
4. Check log: "Field slo will be updated" dengan count baru
5. Verify: Data SLO lama + data baru ada semua
```

#### **Scenario 3: Edit Field Distribusi/Trafo**
```bash
# Expected behavior:
1. User ubah hanya field trafo
2. Check log: "has_trafo" = true, "has_jaringan" = false
3. Verify: Jaringan distribusi existing preserved, trafo updated
```

### 4. **Database Verification Script**
```php
// Script untuk cek data setelah update
$pengajuan = App\Models\Pengajuan::find($id);

echo "=== SLO Data ===\n";
if (is_array($pengajuan->slo) && !empty($pengajuan->slo)) {
    foreach ($pengajuan->slo as $i => $slo) {
        echo "SLO $i: ";
        $hasData = false;
        foreach ($slo as $key => $value) {
            if (!is_null($value) && trim($value) !== '') {
                $hasData = true;
                break;
            }
        }
        echo $hasData ? "OK\n" : "EMPTY - ISSUE!\n";
    }
} else {
    echo "SLO: NULL or empty\n";
}
```

## 🚨 **Warning Signs di Log**

Perhatikan log entries ini yang menandakan masalah:

```bash
# ❌ Data akan hilang
"Removing empty slo from update data to preserve existing data"

# ❌ Data integrity issue  
"Data integrity issues found after update"

# ✅ Normal operation
"Field slo will be updated"
"Pengajuan updated successfully"
```

## 📋 **Expected Results**

✅ **Setelah perbaikan:**
- Data array existing preserved saat tidak diubah
- Hanya field yang benar-benar diisi yang ter-update
- Log comprehensive untuk debugging
- Data integrity check otomatis
- No more mysterious NULL values

❌ **Sebelumnya:**
- Data array jadi NULL tanpa alasan
- Tidak ada logging untuk debugging  
- Field kosong overwrite data existing
- Tidak ada validasi integrity

## 🔄 **Rollback Plan**

Jika masih ada masalah:
1. Check log untuk identify exact issue
2. Backup database sebelum testing
3. Use git untuk rollback: `git checkout HEAD~1 -- app/Http/Controllers/DaftarPengajuanController.php`
