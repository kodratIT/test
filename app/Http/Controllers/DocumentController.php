<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Models\Pengajuan;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\Style\Font;
use Carbon\Carbon;

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
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'PDF hanya dapat diupload untuk pengajuan yang telah disetujui.'
                    ], 400);
                }
                return back()->with('error', 'PDF hanya dapat diupload untuk pengajuan yang telah disetujui.');
            }
            
            // Handle file upload
            $file = $request->file('pdf_file');
            
            // Generate nama file yang unique
            $namaPerusahaan = preg_replace('/[^A-Za-z0-9_-]/', '_', $pengajuan->pengguna->identitas->namabadanusaha ?? 'Unknown');
            $fileName = 'lembar_pengesahan_' . $pengajuanId . '_' . substr($namaPerusahaan, 0, 20) . '_' . time() . '.pdf';
            
            // Simpan file ke storage/app/pengesahan
            $filePath = $file->storeAs('pengesahan', $fileName);
            
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
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'PDF berhasil diupload',
                    'filename' => $fileName,
                    'file_path' => $filePath,
                    'pdf_url' => '/dokumen/pdf/' . $pengajuanId . '/download'
                ]);
            }
            return back()->with('success', 'PDF berhasil diupload.');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal: ' . implode(', ', $e->validator->errors()->all())
                ], 422);
            }
            return back()->withErrors($e->validator)->withInput()->with('error', 'Validasi gagal.');
            
        } catch (\Exception $e) {
            \Log::error('Upload PDF Error: ' . $e->getMessage());
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat upload: ' . $e->getMessage()
                ], 500);
            }
            return back()->with('error', 'Terjadi kesalahan saat upload.');
        }
    }
    
    /**
     * Download PDF lembar pengesahan yang sudah diupload
     */
    public function downloadUploadedPdf($pengajuanId)
    {
        try {
            \Log::info('Download PDF request', [
                'pengajuan_id' => $pengajuanId,
                'user_id' => auth()->id()
            ]);
            
            // Load pengajuan dengan relasi yang diperlukan
            $pengajuan = Pengajuan::with('pengguna.identitas')->findOrFail($pengajuanId);
            
            // Cek apakah file PDF ada
            if (!$pengajuan->lembar_pengesahan_pdf) {
                \Log::warning('PDF file path not found in database', ['pengajuan_id' => $pengajuanId]);
                
                if (request()->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'File PDF belum diupload untuk pengajuan ini.'
                    ], 404);
                }
                return back()->with('error', 'File PDF belum diupload untuk pengajuan ini.');
            }
            
            // Cek beberapa kemungkinan path file
            $possiblePaths = [
                storage_path('app/' . $pengajuan->lembar_pengesahan_pdf),
                storage_path('app/private/' . $pengajuan->lembar_pengesahan_pdf),
                storage_path('app/public/' . $pengajuan->lembar_pengesahan_pdf)
            ];
            
            $filePath = null;
            foreach ($possiblePaths as $path) {
                if (file_exists($path) && is_readable($path)) {
                    $filePath = $path;
                    break;
                }
            }
            
            if (!$filePath) {
                \Log::error('PDF file not found in any expected locations', [
                    'pengajuan_id' => $pengajuanId,
                    'database_path' => $pengajuan->lembar_pengesahan_pdf,
                    'checked_paths' => $possiblePaths
                ]);
                
                if (request()->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'File PDF tidak ditemukan di server.'
                    ], 404);
                }
                return back()->with('error', 'File PDF tidak ditemukan di server.');
            }
            
            // Sanitize nama perusahaan untuk nama file
            $namaPerusahaan = $pengajuan->pengguna->identitas->namabadanusaha ?? 'Unknown';
            $namaPerusahaanClean = preg_replace('/[^A-Za-z0-9_-]/', '_', $namaPerusahaan);
            $fileName = 'Lembar_Pengesahan_' . substr($namaPerusahaanClean, 0, 30) . '_' . date('Y') . '.pdf';
            
            // Log download activity
            \Log::info('PDF download successful', [
                'pengajuan_id' => $pengajuanId,
                'file_path' => $filePath,
                'file_name' => $fileName,
                'user_id' => auth()->id()
            ]);
            
            // Return file download dengan proper headers
            return response()->download($filePath, $fileName, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Cache-Control' => 'no-cache, no-store, must-revalidate',
                'Pragma' => 'no-cache',
                'Expires' => '0'
            ]);
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            \Log::error('Pengajuan not found for PDF download', [
                'pengajuan_id' => $pengajuanId,
                'user_id' => auth()->id()
            ]);
            
            if (request()->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pengajuan tidak ditemukan.'
                ], 404);
            }
            return back()->with('error', 'Pengajuan tidak ditemukan.');
            
        } catch (\Exception $e) {
            \Log::error('Download Uploaded PDF Error: ' . $e->getMessage(), [
                'pengajuan_id' => $pengajuanId,
                'user_id' => auth()->id(),
                'stack_trace' => $e->getTraceAsString()
            ]);
            
            if (request()->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat download PDF: ' . $e->getMessage()
                ], 500);
            }
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
    
    // Create section with A4 margins
    $section = $phpWord->addSection([
        'marginTop' => Converter::cmToTwip(2.5),
        'marginBottom' => Converter::cmToTwip(2.5),
        'marginLeft' => Converter::cmToTwip(2),
        'marginRight' => Converter::cmToTwip(2)
    ]);
    
    // Define styles
    $phpWord->addFontStyle('judul', [
        'name' => 'Arial','size' => 16,'bold' => false,'allCaps' => true
    ]);
    $phpWord->addFontStyle('judulBesar', [
        'name' => 'Arial','size' => 18,'bold' => true,'allCaps' => true
    ]);
    $phpWord->addFontStyle('teks', [
        'name' => 'Arial','size' => 14,'bold' => true,'allCaps' => true
    ]);
    $phpWord->addFontStyle('isi', [
        'name' => 'Arial','size' => 12,'bold' => false
    ]);
    $phpWord->addFontStyle('nama', [
        'name' => 'Arial','size' => 16,'bold' => true,'allCaps' => true
    ]);
    $phpWord->addFontStyle('bold', [
        'name' => 'Arial','size' => 11.5,'bold' => true
    ]);
    $phpWord->addFontStyle('normal', [
        'name' => 'Arial','size' => 11.5,'bold' => false
    ]);
    
    // Add paragraph styles
    $phpWord->addParagraphStyle('center', ['alignment' => Jc::CENTER]);
    $phpWord->addParagraphStyle('left', ['alignment' => Jc::START]);
    
    // =========================
    // Logo Provinsi Jambi (asli)
    // =========================
    $section->addText('', [], ['alignment' => Jc::CENTER, 'spaceAfter' => 200]);
    $logoPath = public_path('assets/images/logo_jambi.png'); // pastikan file ada di sini
    if (file_exists($logoPath)) {
        $section->addImage($logoPath, [
            'width' => 120,    // sekitar 4cm
            'height' => 120,   // proporsional
            'alignment' => Jc::CENTER
        ]);
        $section->addTextBreak(1);
    } else {
        // fallback jika file tidak ada
        $section->addText('[LOGO PROVINSI JAMBI]', 
            ['name' => 'Arial', 'size' => 12, 'color' => '666666'], 
            ['alignment' => Jc::CENTER, 'spaceAfter' => 300]
        );
    }
    
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
    $section->addText('Diberikan kepada', 'isi', ['alignment' => Jc::CENTER, 'spaceAfter' => 100]);
    
    // Ambil data lengkap perusahaan
    $identitas = $pengajuan->pengguna->identitas;
    $namaPerusahaan = strtoupper($identitas->namabadanusaha ?? 'N/A');
    $section->addText($namaPerusahaan, 'nama', ['alignment' => Jc::CENTER, 'spaceAfter' => 300]);
    
    // Info perusahaan
    $nib = $identitas->nib ?? '-';
    $alamatKantorPusat = $identitas->alamatkantorpusat ?? 'Alamat tidak tersedia';
    $section->addText('NIB: ' . $nib, 'isi', ['alignment' => Jc::CENTER, 'spaceAfter' => 400]);
    $section->addText($alamatKantorPusat, 'isi', ['alignment' => Jc::CENTER, 'spaceAfter' => 400]);
    
    // =========================
    // Tambahkan jarak sebelum tabel
    // =========================
    $section->addTextBreak(6); // supaya tabel tidak mentok ke bawah
    
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
    $cell1->addText('[QR CODE]', 
        ['name' => 'Arial', 'size' => 10, 'color' => '666666'], 
        ['alignment' => Jc::CENTER]
    );
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


    /**
     * Generate official document with Jambi Province header and logo
     */
    public function generateOfficialDocument($pengajuanId, $type = 'pengesahan')
    {
        try {
            $pengajuan = Pengajuan::with([
                'pengguna.identitas',
                'evaluator',
                'evaluasiPengajuan'
            ])->findOrFail($pengajuanId);

            $phpWord = $this->createOfficialWordDocument($pengajuan, $type);
            
            $namaPerusahaan = preg_replace('/[^A-Za-z0-9_-]/', '_', 
                $pengajuan->pengguna->identitas->namabadanusaha ?? 'Unknown');
            $fileName = ucfirst($type) . '_' . substr($namaPerusahaan, 0, 20) . '_' . date('Ymd') . '.docx';
            
            $tempFile = tempnam(sys_get_temp_dir(), 'jambi_doc_') . '.docx';
            
            $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
            $objWriter->save($tempFile);
            
            return response()->download($tempFile, $fileName, [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
            ])->deleteFileAfterSend();
            
        } catch (\Exception $e) {
            \Log::error('Generate Official Document Error: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Create enhanced Word document with Jambi Province branding
     */
    private function createOfficialWordDocument($pengajuan, $type)
    {
        $phpWord = new PhpWord();
        
        // Set document properties dengan branding Jambi
        $properties = $phpWord->getDocInfo();
        $properties->setCreator('Dinas Energi dan Sumber Daya Mineral Provinsi Jambi');
        $properties->setCompany('Pemerintah Provinsi Jambi');
        $properties->setTitle('Dokumen Resmi - ' . ucfirst($type));
        $properties->setDescription('Dokumen resmi dari Dinas ESDM Provinsi Jambi');
        $properties->setCategory('Official Government Document');
        $properties->setKeywords('Jambi, ESDM, Laporan Berkala');
        
        // Section dengan margin resmi
        $section = $phpWord->addSection([
            'marginTop' => Converter::cmToTwip(3.0),
            'marginBottom' => Converter::cmToTwip(2.5),
            'marginLeft' => Converter::cmToTwip(3.0),
            'marginRight' => Converter::cmToTwip(2.0)
        ]);
        
        // Define enhanced styles
        $this->defineOfficialStyles($phpWord);
        
        // Header dengan logo Jambi
        $this->addOfficialHeader($section);
        
        // Content berdasarkan type
        switch ($type) {
            case 'pengesahan':
                $this->addPengesahanContent($section, $pengajuan);
                break;
            case 'sertifikat':
                $this->addSertifikatContent($section, $pengajuan);
                break;
            case 'surat_resmi':
                $this->addSuratResmiContent($section, $pengajuan);
                break;
            default:
                $this->addDefaultContent($section, $pengajuan);
        }
        
        // Footer dengan tanda tangan elektronik
        $this->addOfficialFooter($section, $pengajuan);
        
        return $phpWord;
    }

    /**
     * Define official document styles
     */
    private function defineOfficialStyles($phpWord)
    {
        // Header styles
        $phpWord->addFontStyle('header_main', [
            'name' => 'Times New Roman',
            'size' => 18,
            'bold' => true,
            'allCaps' => true,
            'color' => '000080'
        ]);
        
        $phpWord->addFontStyle('header_sub', [
            'name' => 'Times New Roman', 
            'size' => 16,
            'bold' => true,
            'allCaps' => true
        ]);
        
        $phpWord->addFontStyle('title_doc', [
            'name' => 'Times New Roman',
            'size' => 16,
            'bold' => true,
            'allCaps' => true,
            'underline' => 'single'
        ]);
        
        // Content styles
        $phpWord->addFontStyle('content_bold', [
            'name' => 'Times New Roman',
            'size' => 12,
            'bold' => true
        ]);
        
        $phpWord->addFontStyle('content_normal', [
            'name' => 'Times New Roman',
            'size' => 12,
            'bold' => false
        ]);
        
        $phpWord->addFontStyle('signature', [
            'name' => 'Times New Roman',
            'size' => 11,
            'bold' => true
        ]);
        
        // Paragraph styles
        $phpWord->addParagraphStyle('center_header', [
            'alignment' => Jc::CENTER,
            'spaceAfter' => 240
        ]);
        
        $phpWord->addParagraphStyle('justify_content', [
            'alignment' => Jc::BOTH,
            'spaceAfter' => 120,
            'lineHeight' => 1.5
        ]);
    }

    /**
     * Add official header with Jambi Province branding
     */
    private function addOfficialHeader($section)
    {
        // Logo placeholder - akan diganti dengan logo sebenarnya
        $logoPath = public_path('assets/img/benner.png');
        
        if (file_exists($logoPath)) {
            // Add logo image (centered, 3cm width)
            $section->addImage($logoPath, [
                'width' => Converter::cmToPoint(3),
                'height' => Converter::cmToPoint(3),
                'alignment' => Jc::CENTER
            ]);
        } else {
            // Fallback jika logo tidak ditemukan
            $section->addText('[LOGO PROVINSI JAMBI]', 
                ['name' => 'Times New Roman', 'size' => 10, 'color' => '808080'], 
                ['alignment' => Jc::CENTER, 'spaceAfter' => 120]);
        }
        
        // Header text
        $section->addText('PEMERINTAH PROVINSI JAMBI', 'header_main', 'center_header');
        $section->addText('DINAS ENERGI DAN SUMBER DAYA MINERAL', 'header_sub', 'center_header');
        
        // Address and contact info
        $section->addText('Jl. Jenderal Sudirman No. 1, Jambi 36122', 'content_normal', 
            ['alignment' => Jc::CENTER, 'spaceAfter' => 60]);
        $section->addText('Telp. (0741) 61234, Fax. (0741) 61235', 'content_normal', 
            ['alignment' => Jc::CENTER, 'spaceAfter' => 60]);
        $section->addText('Email: esdm@jambiprov.go.id | Website: www.jambiprov.go.id', 'content_normal', 
            ['alignment' => Jc::CENTER, 'spaceAfter' => 240]);
        
        // Horizontal line separator
        $section->addLine([
            'weight' => 2,
            'width' => Converter::cmToTwip(15),
            'height' => 0,
            'color' => '000000'
        ]);
        
        $section->addTextBreak(1);
    }

    /**
     * Add pengesahan content
     */
    private function addPengesahanContent($section, $pengajuan)
    {
        // Document title
        $section->addText('LEMBAR PENGESAHAN EVALUASI TEKNIS', 'title_doc', 'center_header');
        $section->addText('LAPORAN PELAKSANAAN USAHA PENYEDIAAN TENAGA LISTRIK', 'title_doc', 'center_header');
        $section->addText('UNTUK KEPENTINGAN SENDIRI', 'title_doc', 'center_header');
        $section->addText('PERIODE TAHUN ' . date('Y'), 'title_doc', 'center_header');
        
        // Document number
        $nomor = $this->generateDocumentNumber($pengajuan, 'pengesahan');
        $section->addText('NOMOR: ' . $nomor, 'content_bold', 
            ['alignment' => Jc::CENTER, 'spaceAfter' => 360]);
        
        // Company information
        $identitas = $pengajuan->pengguna->identitas;
        $section->addText('Diberikan kepada:', 'content_normal', 'center_header');
        $section->addText(strtoupper($identitas->namabadanusaha ?? 'N/A'), 'content_bold', 'center_header');
        
        // Company details
        $section->addText('NIB: ' . ($identitas->nib ?? '-'), 'content_normal', 'center_header');
        $section->addText($identitas->alamatkantorpusat ?? 'Alamat tidak tersedia', 'content_normal', 'center_header');
        
        if ($identitas->contact_person_nama) {
            $section->addText('Contact Person: ' . $identitas->contact_person_nama . 
                ' (' . ($identitas->contact_person_jabatan ?? '-') . ')', 'content_normal', 'center_header');
        }
        
        // Official statement
        $section->addTextBreak(2);
        $statement = 'Berdasarkan hasil evaluasi teknis yang telah dilakukan, dengan ini menyatakan bahwa ' .
                    'laporan pelaksanaan usaha penyediaan tenaga listrik untuk kepentingan sendiri ' .
                    'yang disampaikan oleh perusahaan tersebut di atas telah memenuhi persyaratan ' .
                    'dan ketentuan yang berlaku sesuai dengan peraturan perundang-undangan.';
        
        $section->addText($statement, 'content_normal', 'justify_content');
        
        // Additional info
        $section->addText('Tanggal Pengajuan: ' . 
            ($pengajuan->created_at ? $pengajuan->created_at->translatedFormat('d F Y') : '-'), 
            'content_normal', ['spaceAfter' => 120]);
        $section->addText('Status: ' . ucfirst($pengajuan->status), 'content_normal', ['spaceAfter' => 120]);
        
        if ($pengajuan->catatan_kadis) {
            $section->addText('Catatan: ' . $pengajuan->catatan_kadis, 'content_normal', ['spaceAfter' => 240]);
        }
    }

    /**
     * Add official footer with electronic signature
     */
    private function addOfficialFooter($section, $pengajuan)
    {
        $section->addTextBreak(2);
        
        // Create table for signature area
        $table = $section->addTable([
            'borderSize' => 0,
            'cellMargin' => 80,
            'alignment' => Jc::CENTER,
            'width' => 100 * 50
        ]);
        
        $table->addRow();
        
        // Left cell (empty for QR code area)
        $leftCell = $table->addCell(3000, ['borderSize' => 1, 'borderColor' => '808080']);
        $leftCell->addText('QR Code untuk Verifikasi', 
            ['name' => 'Times New Roman', 'size' => 9, 'color' => '808080'], 
            ['alignment' => Jc::CENTER]);
        $leftCell->addText('', [], ['spaceAfter' => 600]); // Space for QR code
        
        // Right cell (signature area)
        $rightCell = $table->addCell(4000);
        $rightCell->addText('Jambi, ' . Carbon::now()->translatedFormat('d F Y'), 'content_normal');
        $rightCell->addTextBreak(1);
        $rightCell->addText('Ditandatangani secara elektronik oleh:', 'content_normal');
        $rightCell->addText('Kepala Dinas Energi dan Sumber Daya Mineral', 'content_bold');
        $rightCell->addText('Provinsi Jambi', 'content_bold');
        $rightCell->addTextBreak(3);
        $rightCell->addText('Tandry Adi Negara, S.STP., M.Si.', 'signature');
        $rightCell->addText('NIP. 197608152006041002', ['name' => 'Times New Roman', 'size' => 10]);
    }

    /**
     * Generate document number based on type
     */
    private function generateDocumentNumber($pengajuan, $type)
    {
        $year = date('Y');
        $month = date('m');
        $sequence = str_pad($pengajuan->id, 3, '0', STR_PAD_LEFT);
        
        switch ($type) {
            case 'pengesahan':
                return "421.2/{$sequence}/ESDM-LP/{$month}/{$year}";
            case 'sertifikat':
                return "SERT-LB/{$sequence}/{$year}";
            case 'surat_resmi':
                return "005/{$sequence}/ESDM/{$month}/{$year}";
            default:
                return "DOC/{$sequence}/{$year}";
        }
    }

    /**
     * Show document preview with Jambi branding
     */
    public function showOfficialPreview($pengajuanId, $type = 'pengesahan')
    {
        try {
            $pengajuan = Pengajuan::with([
                'pengguna.identitas',
                'evaluator'
            ])->findOrFail($pengajuanId);
            
            $data = [
                'pengajuan' => $pengajuan,
                'logo_url' => asset('assets/img/benner.png'),
                'document_type' => $type,
                'document_number' => $this->generateDocumentNumber($pengajuan, $type),
                'generated_date' => Carbon::now()->translatedFormat('d F Y'),
                'province_info' => [
                    'name' => 'PEMERINTAH PROVINSI JAMBI',
                    'department' => 'DINAS ENERGI DAN SUMBER DAYA MINERAL',
                    'address' => 'Jl. Jenderal Sudirman No. 1, Jambi 36122',
                    'phone' => 'Telp. (0741) 61234',
                    'fax' => 'Fax. (0741) 61235',
                    'email' => 'esdm@jambiprov.go.id',
                    'website' => 'www.jambiprov.go.id'
                ],
                'official_info' => [
                    'kadis_name' => 'Tandry Adi Negara, S.STP., M.Si.',
                    'kadis_nip' => '197608152006041002',
                    'title' => 'Kepala Dinas Energi dan Sumber Daya Mineral Provinsi Jambi'
                ]
            ];
            
            return view('documents.official-preview', $data);
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Dokumen tidak ditemukan: ' . $e->getMessage());
        }
    }
}
