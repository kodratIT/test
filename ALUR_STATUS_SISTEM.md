# Alur Status Sistem Laporan Berkala

## Ketentuan Status & Pewarnaan (4 Status Utama)

### 1. **Proses Evaluasi** - 🟡 **KUNING** (`bg-yellow-500`)
- **Kondisi:**
  - Saat badan usaha mengajukan permohonan
  - Saat permohonan diperiksa oleh Evaluator
- **Status dalam sistem:** `proses evaluasi`, `evaluasi`

### 2. **Proses Verifikasi** - 🔵 **BIRU** (`bg-blue-500`)
- **Kondisi:**
  - Setelah Evaluator menyelesaikan evaluasi dan memberikan hasil
- **Status dalam sistem:** `proses verifikasi`, `validasi`

### 3. **Proses Pengesahan** - 🟢 **HIJAU** (`bg-green-500`)
- **Kondisi:**
  - Setelah Kabid klik Verifikasi namun Kadis belum menyetujui
- **Status dalam sistem:** `proses pengesahan`, `menunggu persetujuan kadis`

### 4. **Disetujui** - 🟢 **HIJAU PEKAT** (`bg-green-600`)
- **Kondisi:**
  - Saat Kadis klik Setujui
- **Status dalam sistem:** `disetujui`, `disetujui kadis`

---

## Alur Status Lengkap

```
┌─────────────┐    ┌─────────────┐    ┌─────────────┐    ┌─────────────────┐
│ Pengusaha   │───▶│    Kadip    │───▶│  Evaluator  │───▶│ 🟡 Proses       │
│ Mengajukan  │    │             │    │ Memeriksa   │    │   Evaluasi      │
└─────────────┘    └─────────────┘    └─────────────┘    └─────────────────┘
                                                                    │
                                                                    ▼
┌─────────────────┐    ┌─────────────┐    ┌─────────────────────┐
│ 🔵 Proses       │◀───│   Kabid     │◀───│ Evaluator ACC       │
│   Verifikasi    │    │ Verifikasi  │    │ (Menyetujui)        │
└─────────────────┘    └─────────────┘    └─────────────────────┘
          │
          │
          ▼
┌─────────────────┐    ┌─────────────┐
│ 🟢 Proses       │◀───│   Kabid     │
│   Pengesahan    │    │ Klik        │
│                 │    │ Verifikasi  │
└─────────────────┘    └─────────────┘
          │
          │
          ▼
┌─────────────────┐    ┌─────────────┐
│ 🟢 Disetujui    │◀───│    Kadis    │
│   (Pekat)       │    │ Klik Setujui│
└─────────────────┘    └─────────────┘
```

---

## Implementasi dalam Kode

### Status Mapping (JavaScript) - 4 Status Utama
```javascript
// Mapping 4 status utama dengan warna yang ditentukan
if (statusText === 'proses evaluasi' || statusText === 'evaluasi') {
  // Proses Evaluasi = Kuning
  badgeClass = 'bg-yellow-500';
  statusLabel = 'PROSES EVALUASI';
} else if (statusText === 'proses verifikasi' || statusText === 'validasi') {
  // Proses Verifikasi = Biru  
  badgeClass = 'bg-blue-500';
  statusLabel = 'PROSES VERIFIKASI';
} else if (statusText === 'proses pengesahan' || statusText === 'menunggu persetujuan kadis') {
  // Proses Pengesahan = Hijau
  badgeClass = 'bg-green-500';
  statusLabel = 'PROSES PENGESAHAN';
} else if (statusText === 'disetujui' || statusText === 'disetujui kadis') {
  // Disetujui = Hijau Pekat
  badgeClass = 'bg-green-600';
  statusLabel = 'DISETUJUI';
}
```

---

## Logika Aksi Berdasarkan Status

### 🟢 **Status "Proses Pengesahan"** 
**Menampilkan dropdown dengan 2 opsi:**
- 📄 **"Unduh Draft (Word)"** - Download file draft dalam format Word
- 📎 **"Upload Draft (PDF)"** - Upload file PDF hasil revisi
- ✅ **Tombol "Lihat"** muncul setelah kedua aksi (download + upload) selesai

### 🟢 **Status "Disetujui"** (Hijau Pekat)
**Menampilkan tombol "Lihat" langsung** - Akses ke dokumen final yang sudah disetujui

### **Status Lainnya** (Proses Evaluasi & Verifikasi)
**Menampilkan link aksi standar** - Sesuai dengan action_text dari backend

---

## File yang Dimodifikasi
- **File:** `/resources/views/daftarlaporanberkalakabid.blade.php`
- **Bagian yang diubah:** 
  - Status color mapping (baris ~147-160)
  - Status label mapping (baris ~162-177)
  - Action logic (baris ~185-225)
  - JavaScript functions untuk file handling

---

## Catatan Implementasi
1. ✅ **4 Status utama** sudah diimplementasikan dengan warna yang tepat:
   - 🟡 **Proses Evaluasi** = `bg-yellow-500`
   - 🔵 **Proses Verifikasi** = `bg-blue-500`  
   - 🟢 **Proses Pengesahan** = `bg-green-500`
   - 🟢 **Disetujui** = `bg-green-600` (lebih pekat)
2. ✅ **Dropdown muncul pada status "Proses Pengesahan"**
3. ✅ **Modal upload success dengan validasi PDF**
4. ✅ **State tracking per baris untuk show/hide tombol Lihat**
5. ✅ **Sistem lebih sederhana** dengan hanya 4 status core
6. ✅ **CSS styling konsisten** dengan template yang ada
7. ✅ Fallback color (gray) untuk status yang tidak terdefinisi
