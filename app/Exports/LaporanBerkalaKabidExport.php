<?php

namespace App\Exports;

use App\Models\Pengajuan;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class LaporanBerkalaKabidExport
{
    public function export()
    {
        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set document properties
        $spreadsheet->getProperties()
            ->setCreator('Sistem Laporan Berkala')
            ->setLastModifiedBy('Sistem Laporan Berkala')
            ->setTitle('Data Laporan Berkala - Dashboard Kabid')
            ->setSubject('Laporan Berkala')
            ->setDescription('Export data laporan berkala dari dashboard kepala bidang')
            ->setKeywords('laporan berkala kabid excel export')
            ->setCategory('Laporan');

        // Set sheet title
        $sheet->setTitle('Data Laporan Berkala');

        // Create header
        $headers = [
            'A1' => 'No',
            'B1' => 'Nomor Pengajuan',
            'C1' => 'Tanggal Laporan', 
            'D1' => 'Nama Pelaku Usaha',
            'E1' => 'NIB',
            'F1' => 'Lokasi Usaha',
            'G1' => 'Keterangan (Status)'
        ];

        // Set headers
        foreach ($headers as $cell => $value) {
            $sheet->setCellValue($cell, $value);
        }

        // Style headers
        $headerRange = 'A1:G1';
        $sheet->getStyle($headerRange)->getFont()->setBold(true);
        $sheet->getStyle($headerRange)->getFont()->setSize(12);
        $sheet->getStyle($headerRange)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle($headerRange)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle($headerRange)->getFill()->setFillType(Fill::FILL_SOLID);
        $sheet->getStyle($headerRange)->getFill()->getStartColor()->setARGB('FF4472C4'); // Blue background
        $sheet->getStyle($headerRange)->getFont()->getColor()->setARGB('FFFFFFFF'); // White text

        // Set column widths
        $sheet->getColumnDimension('A')->setWidth(8);  // No
        $sheet->getColumnDimension('B')->setWidth(20); // Nomor Pengajuan
        $sheet->getColumnDimension('C')->setWidth(15); // Tanggal
        $sheet->getColumnDimension('D')->setWidth(30); // Nama Pelaku Usaha
        $sheet->getColumnDimension('E')->setWidth(20); // NIB
        $sheet->getColumnDimension('F')->setWidth(35); // Lokasi Usaha
        $sheet->getColumnDimension('G')->setWidth(25); // Keterangan

        // Get data from database
        try {
            $pengajuans = Pengajuan::with(['pengguna.identitas'])
                ->orderBy('created_at', 'desc')
                ->get();
            
            \Log::info('Kabid Excel Export: Found ' . $pengajuans->count() . ' records');
        } catch (\Exception $e) {
            \Log::error('Kabid Excel Export: Database error: ' . $e->getMessage());
            // Fallback to empty collection if database fails
            $pengajuans = collect([]);
        }

        // Fill data
        $row = 2; // Start from row 2 (after header)
        $no = 1;

        foreach ($pengajuans as $pengajuan) {
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, $pengajuan->no_pengajuan ?? $pengajuan->id);
            $sheet->setCellValue('C' . $row, $pengajuan->created_at ? $pengajuan->created_at->format('d/m/Y') : '-');
            $sheet->setCellValue('D' . $row, $pengajuan->pengguna->identitas->namabadanusaha ?? 'Tidak Ada');
            $sheet->setCellValue('E' . $row, $pengajuan->pengguna->identitas->nib ?? 'Tidak Ada');
            
            // Lokasi usaha (gabungan alamat kantor pusat dan cabang)
            $lokasiUsaha = '';
            $kantorPusat = $pengajuan->pengguna->identitas->alamatkantorpusat ?? '';
            $kantorCabang = $pengajuan->pengguna->identitas->alamatkantorcabang ?? '';
            
            if (!empty($kantorPusat) && !empty($kantorCabang)) {
                $lokasiUsaha = "Pusat: {$kantorPusat}, Cabang: {$kantorCabang}";
            } elseif (!empty($kantorPusat)) {
                $lokasiUsaha = "Pusat: {$kantorPusat}";
            } elseif (!empty($kantorCabang)) {
                $lokasiUsaha = "Cabang: {$kantorCabang}";
            } else {
                $lokasiUsaha = 'Tidak Ada';
            }
            
            $sheet->setCellValue('F' . $row, $lokasiUsaha);
            
            // Keterangan (Status) - mapping sesuai dengan yang ada di frontend
            $status = strtolower($pengajuan->status ?? '');
            $keterangan = '';
            
            switch ($status) {
                case 'proses evaluasi':
                case 'menunggu evaluasi':
                    $keterangan = 'PROSES EVALUASI';
                    break;
                case 'evaluasi':
                case 'selesai':
                    $keterangan = 'PROSES VERIFIKASI';
                    break;
                case 'perbaikan':
                    $keterangan = 'PERBAIKAN';
                    break;
                case 'validasi':
                case 'menunggu persetujuan kadis':
                    $keterangan = 'VALIDASI';
                    break;
                case 'disetujui kadis':
                    $keterangan = 'DISETUJUI';
                    break;
                default:
                    $keterangan = strtoupper($status);
                    break;
            }
            
            $sheet->setCellValue('G' . $row, $keterangan);
            
            $row++;
            $no++;
        }

        // Style data rows
        if ($row > 2) {
            $dataRange = 'A2:G' . ($row - 1);
            $sheet->getStyle($dataRange)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
            $sheet->getStyle('A2:A' . ($row - 1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('C2:C' . ($row - 1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('E2:E' . ($row - 1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('G2:G' . ($row - 1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        }

        // Add borders to all data
        $allDataRange = 'A1:G' . ($row - 1);
        $sheet->getStyle($allDataRange)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        // Set row height
        for ($i = 1; $i < $row; $i++) {
            $sheet->getRowDimension($i)->setRowHeight(25);
        }

        return $spreadsheet;
    }

    public function download()
    {
        try {
            \Log::info('Kabid Excel Export: Starting export process');
            $spreadsheet = $this->export();
            $filename = 'Laporan_Berkala_Kadis_' . date('Y-m-d_H-i-s') . '.xlsx'; // Fix filename untuk Kadis
            \Log::info('Kabid Excel Export: Spreadsheet created, filename: ' . $filename);

            $writer = new Xlsx($spreadsheet);
            \Log::info('Kabid Excel Export: Writer created, streaming response');
            
            // Use streamDownload for AJAX blob compatibility
            return response()->streamDownload(function() use ($writer) {
                // Clean any output buffer
                while (ob_get_level()) {
                    ob_end_clean();
                }
                $writer->save('php://output');
            }, $filename, [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Cache-Control' => 'no-cache, no-store, must-revalidate',
                'Pragma' => 'no-cache',
                'Expires' => '0'
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Excel export error for Kabid: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            
            // Return JSON error for AJAX calls
            if (request()->wantsJson() || request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error generating Excel file: ' . $e->getMessage()
                ], 500);
            }
            
            // Return redirect with error for regular requests
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengunduh file Excel: ' . $e->getMessage());
        }
    }
}
