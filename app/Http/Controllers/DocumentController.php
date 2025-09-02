<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\Style\Font;

class DocumentController extends Controller
{
    /**
     * Generate dan download Word document untuk lembar pengesahan
     */
    public function downloadLembarPengesahan($pengajuanId)
    {
        try {
            // Set time limit untuk mencegah timeout
            set_time_limit(120);
            
            // Cari pengajuan berdasarkan ID dengan data lengkap
            $pengajuan = Pengajuan::with([
                'pengguna.identitas',
                'pengguna.identitasPengguna',
                'evaluator.identitasTimAdmin'
            ])->findOrFail($pengajuanId);
            
            // Pastikan status sudah disetujui
            if (!in_array($pengajuan->status, ['disetujui', 'disetujui kadis'])) {
                return back()->with('error', 'Dokumen hanya dapat diunduh untuk pengajuan yang telah disetujui.');
            }

            // Generate Word document
            $phpWord = $this->createWordDocument($pengajuan);
            
            // Nama file
            $namaPerusahaan = preg_replace('/[^A-Za-z0-9_-]/', '_', $pengajuan->pengguna->identitas->namabadanusaha ?? 'Unknown');
            $fileName = 'Lembar_Pengesahan_' . substr($namaPerusahaan, 0, 20) . '_' . date('Y') . '.docx';
            
            // Generate temporary file
            $tempFile = tempnam(sys_get_temp_dir(), 'word_') . '.docx';
            
            $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
            $objWriter->save($tempFile);
            
            // Return file download
            return response()->download($tempFile, $fileName, [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
            ])->deleteFileAfterSend();
            
        } catch (\Exception $e) {
            \Log::error('Download Document Error: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat membuat dokumen: ' . $e->getMessage());
        }
    }
    
    /**
     * Preview dokumen sebelum download
     */
    public function previewLembarPengesahan($pengajuanId)
    {
        try {
            // Gunakan query yang sama seperti downloadLembarPengesahan
            $pengajuan = Pengajuan::with([
                'pengguna.identitas',
                'pengguna.identitasPengguna',
                'evaluator.identitasTimAdmin'
            ])->findOrFail($pengajuanId);
            
            // Return view langsung untuk preview di browser
            return view('documents.lembar-pengesahan', compact('pengajuan'));
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Pengajuan tidak ditemukan.'
            ], 404);
        }
    }
    
    /**
     * Generate Word document (menggunakan PhpWord dengan template sesuai permintaan)
     */
    public function downloadWordDocument($pengajuanId)
    {
        // Redirect to proper Word document generator
        return $this->downloadLembarPengesahan($pengajuanId);
    }
    
    /**
     * Upload PDF lembar pengesahan
     */
    public function uploadPengesahanPdf(Request $request)
    {
        try {
            // Debug logging
            \Log::info('Upload PDF Request received', [
                'pengajuan_id' => $request->input('pengajuan_id'),
                'has_file' => $request->hasFile('pdf_file'),
                'user_id' => auth()->id()
            ]);
            
            // Validasi input
            $request->validate([
                'pengajuan_id' => 'required|exists:pengajuan,id',
                'pdf_file' => 'required|file|mimes:pdf|max:10240', // Max 10MB
                'keterangan' => 'nullable|string|max:500'
            ]);
            
            $pengajuanId = $request->input('pengajuan_id');
            
            // Cari pengajuan dan pastikan statusnya disetujui
            $pengajuan = Pengajuan::findOrFail($pengajuanId);
            
            if (!in_array($pengajuan->status, ['disetujui', 'disetujui kadis'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'PDF hanya dapat diupload untuk pengajuan yang telah disetujui.'
                ], 400);
            }
            
            // Handle file upload
            $file = $request->file('pdf_file');
            
            // Generate nama file yang unique
            $namaPerusahaan = preg_replace('/[^A-Za-z0-9_-]/', '_', $pengajuan->pengguna->identitas->namabadanusaha ?? 'Unknown');
            $fileName = 'lembar_pengesahan_' . $pengajuanId . '_' . substr($namaPerusahaan, 0, 20) . '_' . time() . '.pdf';
            
            // Simpan file ke storage/app/private/pengesahan
            $filePath = $file->storeAs('private/pengesahan', $fileName);
            
            // Hapus file lama jika ada
            if ($pengajuan->lembar_pengesahan_pdf && \Storage::exists($pengajuan->lembar_pengesahan_pdf)) {
                \Storage::delete($pengajuan->lembar_pengesahan_pdf);
            }
            
            // Update database
            $pengajuan->update([
                'lembar_pengesahan_pdf' => $filePath
            ]);
            
            // Log activity
            \Log::info('PDF Lembar Pengesahan uploaded', [
                'pengajuan_id' => $pengajuanId,
                'file_path' => $filePath,
                'uploaded_by' => auth()->id(),
                'keterangan' => $request->input('keterangan')
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'PDF berhasil diupload',
                'filename' => $fileName,
                'file_path' => $filePath,
                'pdf_url' => '/dokumen/pdf/' . $pengajuanId . '/download'
            ]);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal: ' . implode(', ', $e->validator->errors()->all())
            ], 422);
            
        } catch (\Exception $e) {
            \Log::error('Upload PDF Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat upload: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Download PDF lembar pengesahan yang sudah diupload
     */
    public function downloadUploadedPdf($pengajuanId)
    {
        try {
            $pengajuan = Pengajuan::findOrFail($pengajuanId);
            
            if (!$pengajuan->lembar_pengesahan_pdf || !\Storage::exists($pengajuan->lembar_pengesahan_pdf)) {
                return back()->with('error', 'File PDF tidak ditemukan.');
            }
            
            $filePath = storage_path('app/' . $pengajuan->lembar_pengesahan_pdf);
            $fileName = 'Lembar_Pengesahan_' . ($pengajuan->pengguna->identitas->namabadanusaha ?? 'Unknown') . '.pdf';
            
            return response()->download($filePath, $fileName, [
                'Content-Type' => 'application/pdf'
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Download Uploaded PDF Error: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat download PDF.');
        }
    }
    
    /**
     * Generate simple text document
     */
    private function generateSimpleDocument($pengajuan)
    {
        $nomor = $pengajuan->nomor_pengesahan ?? 'LP-' . str_pad($pengajuan->id, 4, '0', STR_PAD_LEFT) . '/' . date('Y');
        $tanggal = date('d F Y');
        $namaPerusahaan = strtoupper($pengajuan->pengguna->identitas->namabadanusaha ?? 'N/A');
        $nib = $pengajuan->pengguna->identitas->nib ?? '-';
        $alamat = $pengajuan->pengguna->identitas->alamatbadanusaha ?? 'Alamat tidak tersedia';
        $tanggalPengajuan = $pengajuan->created_at ? $pengajuan->created_at->format('d F Y') : '-';
        
        return "===============================================\n" .
               "    PEMERINTAH PROVINSI JAMBI\n" .
               "  DINAS ENERGI DAN SUMBER DAYA MINERAL\n" .
               "===============================================\n\n" .
               "LEMBAR PENGESAHAN EVALUASI TEKNIS\n" .
               "LAPORAN PELAKSANAAN USAHA PENYEDIAAN TENAGA LISTRIK\n" .
               "UNTUK KEPENTINGAN SENDIRI\n" .
               "PERIODE TAHUN " . date('Y') . "\n\n" .
               "NOMOR: {$nomor}\n\n" .
               "Diberikan kepada\n" .
               "{$namaPerusahaan}\n\n" .
               "NIB: {$nib}\n" .
               "Alamat: {$alamat}\n\n" .
               "Bahwa laporan pelaksanaan usaha penyediaan tenaga listrik untuk kepentingan sendiri " .
               "yang diajukan oleh perusahaan tersebut di atas telah sesuai dengan ketentuan yang berlaku " .
               "dan telah melalui proses evaluasi teknis.\n\n" .
               "Tanggal Pengajuan: {$tanggalPengajuan}\n" .
               "Status: " . ucfirst($pengajuan->status) . "\n" .
               ($pengajuan->catatan_kadis ? "Catatan: {$pengajuan->catatan_kadis}\n" : "") . "\n\n" .
               "Jambi, {$tanggal}\n\n" .
               "Ditandatangani secara elektronik oleh:\n" .
               "Kepala Dinas Energi dan Sumber Daya Mineral\n" .
               "Provinsi Jambi\n\n" .
               "Tandry Adi Negara, S.STP., M.Si.\n\n" .
               "===============================================\n" .
               "Dokumen ini dihasilkan secara elektronik\n" .
               "Tanggal Cetak: " . date('d F Y H:i:s') . "\n" .
               "===============================================";
    }
    
    /**
     * Create Word document sesuai template yang diminta
     */
    private function createWordDocument($pengajuan)
    {
        $phpWord = new PhpWord();
        
        // Set document properties
        $properties = $phpWord->getDocInfo();
        $properties->setCreator('Dinas ESDM Provinsi Jambi');
        $properties->setCompany('Pemerintah Provinsi Jambi');
        $properties->setTitle('Lembar Pengesahan');
        $properties->setDescription('Lembar Pengesahan Evaluasi Teknis');
        $properties->setCategory('Official Document');
        
        // Create section with A4 margins (2.5cm top/bottom, 2cm left/right)
        $section = $phpWord->addSection([
            'marginTop' => Converter::cmToTwip(2.5),
            'marginBottom' => Converter::cmToTwip(2.5),
            'marginLeft' => Converter::cmToTwip(2),
            'marginRight' => Converter::cmToTwip(2)
        ]);
        
        // Define styles
        $phpWord->addFontStyle('judul', [
            'name' => 'Arial',
            'size' => 16,
            'bold' => false,
            'allCaps' => true
        ]);
        
        $phpWord->addFontStyle('judulBesar', [
            'name' => 'Arial',
            'size' => 18,
            'bold' => true,
            'allCaps' => true
        ]);
        
        $phpWord->addFontStyle('teks', [
            'name' => 'Arial',
            'size' => 14,
            'bold' => true,
            'allCaps' => true
        ]);
        
        $phpWord->addFontStyle('isi', [
            'name' => 'Arial',
            'size' => 12,
            'bold' => false
        ]);
        
        $phpWord->addFontStyle('nama', [
            'name' => 'Arial',
            'size' => 16,
            'bold' => true,
            'allCaps' => true
        ]);
        
        $phpWord->addFontStyle('bold', [
            'name' => 'Arial',
            'size' => 11.5,
            'bold' => true
        ]);
        
        $phpWord->addFontStyle('normal', [
            'name' => 'Arial',
            'size' => 11.5,
            'bold' => false
        ]);
        
        // Add paragraph styles
        $phpWord->addParagraphStyle('center', ['alignment' => Jc::CENTER]);
        $phpWord->addParagraphStyle('left', ['alignment' => Jc::START]);
        
        // Logo placeholder (5cm x 5cm)
        $section->addText('', [], ['alignment' => Jc::CENTER, 'spaceAfter' => 200]);
        $section->addText('[LOGO PROVINSI JAMBI]', ['name' => 'Arial', 'size' => 12, 'color' => '666666'], 
                         ['alignment' => Jc::CENTER, 'spaceAfter' => 300]);
        
        // Header
        $section->addText('PEMERINTAH PROVINSI JAMBI', 'judul', 'center');
        $section->addText('DINAS ENERGI DAN SUMBER DAYA MINERAL', 'judulBesar', 
                         ['alignment' => Jc::CENTER, 'spaceAfter' => 200]);
        
        // Subjudul
        $section->addText('LEMBAR PENGESAHAN EVALUASI TEKNIS', 'teks', 'center');
        $section->addText('LAPORAN PELAKSANAAN USAHA PENYEDIAAN TENAGA LISTRIK', 'teks', 'center');
        $section->addText('UNTUK KEPENTINGAN SENDIRI', 'teks', 'center');
        $section->addText('PERIODE TAHUN ' . date('Y'), 'teks', 
                         ['alignment' => Jc::CENTER, 'spaceAfter' => 300]);
        
        // Nomor
        $nomor = $pengajuan->nomor_pengesahan ?? 'LP-' . str_pad($pengajuan->id, 4, '0', STR_PAD_LEFT) . '/' . date('Y');
        $section->addText('NOMOR: ' . $nomor, ['name' => 'Arial', 'size' => 14, 'bold' => true], 
                         ['alignment' => Jc::CENTER, 'spaceAfter' => 400]);
        
        // Isi
        $section->addText('Diberikan kepada', 'isi', 
                         ['alignment' => Jc::CENTER, 'spaceAfter' => 100]);
        
        // Ambil data lengkap perusahaan
        $identitas = $pengajuan->pengguna->identitas;
        $namaPerusahaan = strtoupper($identitas->namabadanusaha ?? 'N/A');
        $section->addText($namaPerusahaan, 'nama', 
                         ['alignment' => Jc::CENTER, 'spaceAfter' => 300]);
        
        // Info perusahaan lengkap
        $nib = $identitas->nib ?? '-';
        $emailPerusahaan = $identitas->email_perusahaan ?? '-';
        $alamatKantorPusat = $identitas->alamatkantorpusat ?? 'Alamat tidak tersedia';
        $alamatKantorCabang = $identitas->alamatkantorcabang ?? '-';
        $noTelpPusat = $identitas->notelpkantorpusat ?? '-';
        $noTelpCabang = $identitas->notelpkantorcabang ?? '-';
        
        // Contact person
        $cpNama = $identitas->contact_person_nama ?? '-';
        $cpJabatan = $identitas->contact_person_jabatan ?? '-';
        $cpEmail = $identitas->contact_person_email ?? '-';
        $cpNoTelp = $identitas->contact_person_no_telp ?? '-';
        
        $section->addText('NIB: ' . $nib, 'isi', 
                         ['alignment' => Jc::CENTER, 'spaceAfter' => 50]);
        $section->addText('Email Perusahaan: ' . $emailPerusahaan, 'isi', 
                         ['alignment' => Jc::CENTER, 'spaceAfter' => 50]);
        $section->addText('Alamat Kantor Pusat: ' . $alamatKantorPusat, 'isi', 
                         ['alignment' => Jc::CENTER, 'spaceAfter' => 50]);
        $section->addText('Telp. Kantor Pusat: ' . $noTelpPusat, 'isi', 
                         ['alignment' => Jc::CENTER, 'spaceAfter' => 50]);
        
        if ($alamatKantorCabang !== '-') {
            $section->addText('Alamat Kantor Cabang: ' . $alamatKantorCabang, 'isi', 
                             ['alignment' => Jc::CENTER, 'spaceAfter' => 50]);
            $section->addText('Telp. Kantor Cabang: ' . $noTelpCabang, 'isi', 
                             ['alignment' => Jc::CENTER, 'spaceAfter' => 50]);
        }
        
        // Contact Person section
        $section->addText('', [], ['spaceAfter' => 100]);
        $section->addText('Contact Person:', ['name' => 'Arial', 'size' => 12, 'bold' => true], 
                         ['alignment' => Jc::CENTER, 'spaceAfter' => 50]);
        $section->addText('Nama: ' . $cpNama, 'isi', 
                         ['alignment' => Jc::CENTER, 'spaceAfter' => 25]);
        $section->addText('Jabatan: ' . $cpJabatan, 'isi', 
                         ['alignment' => Jc::CENTER, 'spaceAfter' => 25]);
        $section->addText('Email: ' . $cpEmail, 'isi', 
                         ['alignment' => Jc::CENTER, 'spaceAfter' => 25]);
        $section->addText('No. Telp: ' . $cpNoTelp, 'isi', 
                         ['alignment' => Jc::CENTER, 'spaceAfter' => 300]);
        
        // Paragraph isi
        $textRun = $section->addTextRun(['alignment' => Jc::BOTH, 'spaceAfter' => 300]);
        $textRun->addText('Bahwa laporan pelaksanaan usaha penyediaan tenaga listrik untuk kepentingan sendiri ' .
                         'yang diajukan oleh perusahaan tersebut di atas telah sesuai dengan ketentuan yang berlaku ' .
                         'dan telah melalui proses evaluasi teknis.', 'isi');
        
        // Info tambahan
        $tanggalPengajuan = $pengajuan->created_at ? $pengajuan->created_at->format('d F Y') : '-';
        $section->addText('Tanggal Pengajuan: ' . $tanggalPengajuan, 'isi', 
                         ['alignment' => Jc::CENTER, 'spaceAfter' => 50]);
        $section->addText('Status: ' . ucfirst($pengajuan->status), 'isi', 
                         ['alignment' => Jc::CENTER, 'spaceAfter' => 100]);
        
        if ($pengajuan->catatan_kadis) {
            $section->addText('Catatan: ' . $pengajuan->catatan_kadis, 'isi', 
                             ['alignment' => Jc::CENTER, 'spaceAfter' => 200]);
        }
        
        // Tabel untuk QR dan TTE (side by side)
        $table = $section->addTable([
            'borderSize' => 6,
            'borderColor' => '000000',
            'cellMargin' => 80,
            'alignment' => Jc::CENTER
        ]);
        
        $table->addRow();
        
        // Cell untuk QR Code
        $cell1 = $table->addCell(2500, ['borderSize' => 6]);
        $cell1->addText('[QR CODE]', ['name' => 'Arial', 'size' => 10, 'color' => '666666'], 
                      ['alignment' => Jc::CENTER]);
        $cell1->addText('', [], ['spaceAfter' => 800]);
        
        // Cell untuk TTE Text
        $cell2 = $table->addCell(4500, ['borderSize' => 6]);
        $textRun2 = $cell2->addTextRun(['alignment' => Jc::START]);
        $textRun2->addText('Jambi, ' . date('d F Y'), 'normal');
        $textRun2->addTextBreak(2);
        $textRun2->addText('Ditandatangani secara elektronik oleh:', 'normal');
        $textRun2->addTextBreak();
        $textRun2->addText('Kepala Dinas Energi dan Sumber Daya Mineral', 'bold');
        $textRun2->addTextBreak();
        $textRun2->addText('Provinsi Jambi', 'bold');
        $textRun2->addTextBreak(2);
        $textRun2->addText('Tandry Adi Negara, S.STP., M.Si.', 'bold');
        
        return $phpWord;
    }
}
