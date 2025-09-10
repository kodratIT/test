# 🔍 DEBUG: Data Corruption Issue

Data masih hilang meskipun controller sudah diperbaiki. Mari kita debug dengan logging yang lebih detail.

## 🎯 Field Yang Bermasalah

1. **SKTTK**: tanggal terbit & tanggal masa berlaku
2. **Data mesin**: jenis pembangkit & generator  
3. **Data lokasi**: kabupaten/kota, latitude, longitude
4. **Data jaringan distribusi**: kabupaten/kota, latitude, longitude
5. **Data trafo**: kabupaten/kota, latitude, longitude

## 🔧 Perbaikan Yang Sudah Dilakukan

### 1. Enhanced Debug Logging
Sudah ditambahkan logging comprehensive di controller:

- 🔍 **BEFORE UPDATE**: Log data existing sebelum processing
- 📥 **RAW REQUEST DATA**: Log semua data dari form
- 🎯 **SPECIFIC FIELD DEBUG**: Log field-field yang bermasalah
- 🔧 **PROCESSING**: Log untuk setiap section (SKTTK, Mesin, Generator, Distribusi)
- ✅ **AFTER UPDATE**: Verifikasi data setelah update

### 2. Conditional Updates
Controller hanya update field yang benar-benar ada datanya:

```php
// ✅ Hanya update jika ada data valid
if ($request->has('nomor_sertifikat_skttk') && is_array($request->nomor_sertifikat_skttk) && !empty(array_filter($request->nomor_sertifikat_skttk))) {
    // Process data...
    if (!empty($skttkList)) {
        $data['skttk'] = $skttkList;
    }
}
// ✅ Jika tidak ada data, preserve existing
```

## 📊 Tools Debugging

### 1. Monitor Script
```bash
# Make script executable
chmod +x debug-monitor.sh

# Monitor real-time logs
./debug-monitor.sh monitor

# Check specific pengajuan data  
./debug-monitor.sh check 16

# Show logs for specific pengajuan
./debug-monitor.sh logs 16

# Test data integrity
./debug-monitor.sh test
```

### 2. Manual Laravel Commands
```bash
# Monitor logs real-time
tail -f storage/logs/laravel.log | grep "pengajuan"

# Check specific pengajuan
php artisan tinker
>>> $p = App\Models\Pengajuan::find(16);
>>> $p->skttk;
>>> $p->mesin;
>>> $p->generator;
>>> $p->distribusi;
```

## 🔍 Debugging Steps

### Step 1: Monitor Real-time
```bash
# Terminal 1 - Start monitoring
./debug-monitor.sh monitor

# Terminal 2 - Trigger update from web interface
# (User submit form edit)
```

### Step 2: Check Specific Data
```bash
# Check data before issue
./debug-monitor.sh check 16

# Submit form edit from web

# Check data after issue  
./debug-monitor.sh check 16
```

### Step 3: Analyze Logs
Look for these patterns in logs:

```bash
# ✅ Good patterns
🔍 BEFORE UPDATE - Existing data for pengajuan 16
🎯 SPECIFIC FIELD DEBUG for pengajuan 16
✅ SKTTK will be updated
✅ GENERATOR will be updated

# ❌ Bad patterns  
🔒 SKTTK data preserved (no new data or invalid)
⚠️ SKTTK list is empty after processing
🔒 GENERATOR data preserved (no new data or invalid)
```

## 🚨 Possible Root Causes

### 1. Form Not Sending Data
**Symptom**: Log shows `preserved` for all fields
**Cause**: Form HTML tidak mengirim data array dengan benar
**Check**: Log `📥 RAW REQUEST DATA` - apakah data ada?

### 2. Data Validation Failing
**Symptom**: Log shows data received tapi tidak diproses
**Cause**: Conditional check (`array_filter`, `empty`) gagal
**Check**: Log `🔧 PROCESSING` - apakah condition check benar?

### 3. Data Processing Error
**Symptom**: Data diproses tapi jadi NULL saat save
**Check**: Log `✅ will be updated` vs `AFTER UPDATE`

### 4. Form Structure Mismatch
**Symptom**: Request ada tapi format salah
**Cause**: Form menggunakan nama field yang berbeda dari controller
**Check**: Log `🎯 SPECIFIC FIELD DEBUG` - bandingkan nama field

## 📋 Testing Scenarios

### Test 1: Simple Field Edit
1. Edit hanya 1 field statis (misal: nomor_izin_usaha)
2. Submit form
3. **Expected**: Semua array data preserved
4. **Check**: `./debug-monitor.sh check <ID>`

### Test 2: Add New Array Item  
1. Tambah 1 item SKTTK baru dengan tanggal lengkap
2. Submit form
3. **Expected**: Data SKTTK lama + baru ada semua
4. **Check**: Tanggal tidak jadi NULL

### Test 3: Edit Array Field Only
1. Edit hanya jenis pembangkit di mesin existing
2. Submit form  
3. **Expected**: Mesin data terupdate, field lain preserved
4. **Check**: Jenis pembangkit tidak jadi NULL

## 🔄 Next Steps

1. **Start Monitoring**:
   ```bash
   ./debug-monitor.sh monitor
   ```

2. **Reproduce Issue**:
   - Buka form edit pengajuan yang ada data
   - Edit field apapun  
   - Submit form

3. **Analyze Logs**:
   - Cek apakah data dikirim dari form
   - Cek apakah data diproses controller
   - Cek apakah data disave dengan benar

4. **Identify Pattern**:
   - Field mana yang hilang?
   - Apakah semua field atau field tertentu?
   - Apakah terjadi di semua pengajuan?

## 📄 Log Markers Reference

- 🔍 `BEFORE UPDATE` - Data existing
- 📥 `RAW REQUEST DATA` - Data dari form  
- 🎯 `SPECIFIC FIELD DEBUG` - Field bermasalah
- 🔧 `PROCESSING SKTTK/MESIN/GENERATOR` - Processing section
- ✅ `will be updated` - Field akan diupdate
- 🔒 `preserved` - Field dipertahankan
- ⚠️ `empty after processing` - Data hilang saat processing
- 📊 `AFTER UPDATE` - Hasil akhir

**Mari mulai debugging dengan monitoring real-time saat form disubmit!** 🚀
