# Panduan Implementasi Form Edit Laravel dengan Nested Array

## Ringkasan Masalah dan Solusi

### Masalah yang Dipecahkan:
1. ❌ **Field array NULL setelah submit** - Data SKTTK, Mesin, Generator hilang
2. ❌ **Struktur form salah** - Menggunakan `field[]` bukan nested array
3. ❌ **Data lama tidak preserved** - Controller selalu overwrite semua data
4. ❌ **Validasi tidak sesuai** - Rules tidak cocok dengan struktur form

### Solusi yang Diterapkan:
1. ✅ **Struktur nested array** - `skttk[0][nama]`, `mesin[1][kapasitas]`
2. ✅ **Proper old() usage** - Fallback ke data database dengan format yang benar
3. ✅ **Selective update** - Hanya update field yang berubah/tidak kosong
4. ✅ **Matched validation** - Rules sesuai dengan struktur form

## Implementasi

### Step 1: Update Struktur Form Blade

Ganti struktur form lama:
```blade
{{-- ❌ SALAH - Array sederhana --}}
<input name="nama_skttk[]" value="{{ old('nama_skttk.'.$i, $data[$i]['nama'] ?? '') }}">
<input name="tanggal_terbit_skttk[]" value="{{ old('tanggal_terbit_skttk.'.$i, $data[$i]['tanggal'] ?? '') }}">
```

Dengan struktur nested array yang benar:
```blade
{{-- ✅ BENAR - Nested array --}}
<input name="skttk[{{ $i }}][nama]" value="{{ old('skttk.'.$i.'.nama', $skttkData[$i]['nama_skttk'] ?? '') }}">
<input name="skttk[{{ $i }}][tanggal_terbit]" value="{{ old('skttk.'.$i.'.tanggal_terbit', $skttkData[$i]['tanggal_terbit_skttk'] ?? '') }}">
```

### Step 2: Update Validasi Controller

```php
// ✅ Validasi yang benar untuk nested array
$rules = [
    'skttk' => 'nullable|array',
    'skttk.*.nama' => 'nullable|string|max:255',
    'skttk.*.tanggal_terbit' => 'nullable|date',
    'skttk.*.tanggal_masa_berlaku' => 'nullable|date|after_or_equal:skttk.*.tanggal_terbit',
    
    'mesin' => 'nullable|array',
    'mesin.*.jenis_penggerak' => 'nullable|string|max:255',
    'mesin.*.jenis_pembangkit' => 'nullable|string|in:PLTD,PLTBm,PLTMH,PLTU,PLTBg,PLTMG',
    
    'generator' => 'nullable|array',
    'generator.*.latitude' => 'nullable|numeric|between:-90,90',
    'generator.*.longitude' => 'nullable|numeric|between:-180,180',
];
```

### Step 3: Implementasi Selective Update

```php
// ✅ Hanya update jika ada data valid
if ($request->has('skttk') && is_array($request->skttk)) {
    $skttkData = $this->processNestedArrayData($request->skttk, [
        'nama' => 'nama_skttk',
        'tanggal_terbit' => 'tanggal_terbit_skttk',
    ]);
    
    if (!empty($skttkData)) {
        $updateData['skttk'] = $skttkData; // Hanya update jika ada data
    }
}
// Jika tidak ada data baru, field tidak diubah (preserved)
```

## Testing dan Debugging

### 1. Test Case - Data Tidak Hilang

```bash
# Test scenario:
1. Buat pengajuan dengan data lengkap (SKTTK, Mesin, Generator)
2. Edit pengajuan, ubah hanya satu field (misal: nomor izin usaha)
3. Submit form
4. Verifikasi: Data SKTTK, Mesin, Generator tetap utuh
```

### 2. Monitor Logs

```bash
# Monitor log Laravel untuk debugging
tail -f storage/logs/laravel.log | grep "UPDATE REQUEST DATA"
tail -f storage/logs/laravel.log | grep "FINAL UPDATE DATA"
```

### 3. Test Script Database

```php
// Script untuk verifikasi data di database
$pengajuan = App\Models\Pengajuan::find($id);

echo "=== SKTTK Data ===\n";
if (!empty($pengajuan->skttk)) {
    foreach ($pengajuan->skttk as $i => $skttk) {
        echo "SKTTK $i: " . json_encode($skttk) . "\n";
    }
} else {
    echo "SKTTK: NULL atau kosong\n";
}

echo "\n=== Mesin Data ===\n";
if (!empty($pengajuan->mesin)) {
    foreach ($pengajuan->mesin as $i => $mesin) {
        echo "Mesin $i: " . json_encode($mesin) . "\n";
    }
} else {
    echo "Mesin: NULL atau kosong\n";
}
```

## Perbedaan Kunci

### Request Data Format

**Struktur Lama (Bermasalah):**
```php
// Data yang diterima controller:
[
    "nama_skttk" => ["John Doe", "Jane Smith"],
    "tanggal_terbit_skttk" => ["2023-01-01", "2023-02-01"],
    "jenis_penggerak" => ["Diesel", "Gas"]
]
```

**Struktur Baru (Benar):**
```php
// Data yang diterima controller:
[
    "skttk" => [
        0 => [
            "nama" => "John Doe",
            "tanggal_terbit" => "2023-01-01"
        ],
        1 => [
            "nama" => "Jane Smith", 
            "tanggal_terbit" => "2023-02-01"
        ]
    ],
    "mesin" => [
        0 => [
            "jenis_penggerak" => "Diesel",
            "jenis_pembangkit" => "PLTD"
        ]
    ]
]
```

### Database Mapping

```php
// Mapping form field ke database field
$fieldMap = [
    // Form field => Database field
    'nomor_sertifikat' => 'nomor_sertifikat_skttk',
    'nama' => 'nama_skttk', 
    'tanggal_terbit' => 'tanggal_terbit_skttk',
    'tanggal_masa_berlaku' => 'tanggal_masa_berlaku_skttk'
];
```

## Expected Results

✅ **Setelah implementasi:**
- Data existing tetap utuh saat edit
- Hanya field yang diubah yang ter-update
- Validasi error menunjuk ke field spesifik (e.g., `skttk.0.nama`)
- Tanggal dan koordinat tersimpan dengan benar
- Log menunjukkan data mana yang di-update vs preserved

❌ **Sebelum perbaikan:**
- Data SKTTK, Mesin, Generator jadi NULL/kosong
- Koordinat dan tanggal tidak tersimpan
- Validasi error tidak jelas
- Tidak ada logging untuk debugging

## File yang Perlu Diubah

1. `resources/views/pengajuan/edit.blade.php` - Struktur form
2. `app/Http/Controllers/DaftarPengajuanController.php` - Method update() 
3. `routes/web.php` - Pastikan route mengarah ke controller yang benar

## Rollback Plan

Jika terjadi masalah:
1. Backup file lama sebelum implementasi
2. Restore dari backup: `cp edit.blade.php.backup edit.blade.php`
3. Atau gunakan git: `git checkout HEAD~1 -- path/to/file`
