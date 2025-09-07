<?php

namespace App\Exports;

use App\Models\Pengajuan;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class LaporanBerkalaKadisExport
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
            ->setTitle('Data Laporan Berkala - Dashboard Kadis')
            ->setSubject('Laporan Berkala')
            ->setDescription('Export data laporan berkala dari dashboard kepala dinas')
            ->setKeywords('laporan berkala kadis excel export')
            ->setCategory('Laporan');

        // Set sheet title
        $sheet->setTitle('Data Laporan Berkala Kadis');

        // Create header
        $headers = [
            'A1' => 'No',
            'B1' => 'Nomor Pengajuan',
            'C1' => 'Tanggal Laporan', 
            'D1' => 'Nama Pelaku Usaha',
            'E1' => 'NIB',
            'F1' => 'Lokasi Usaha',
            'G1' => 'Status Persetujuan'
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
        $sheet->getStyle($headerRange)->getFill()->getStartColor()->setARGB('FFFF8C00'); // Orange background (Kadis color)
        $sheet->getStyle($headerRange)->getFont()->getColor()->setARGB('FFFFFFFF'); // White text

        // Set column widths
        $sheet->getColumnDimension('A')->setWidth(8);  // No
        $sheet->getColumnDimension('B')->setWidth(20); // Nomor Pengajuan
        $sheet->getColumnDimension('C')->setWidth(15); // Tanggal
        $sheet->getColumnDimension('D')->setWidth(30); // Nama Pelaku Usaha
        $sheet->getColumnDimension('E')->setWidth(20); // NIB
        $sheet->getColumnDimension('F')->setWidth(35); // Lokasi Usaha
        $sheet->getColumnDimension('G')->setWidth(25); // Status

        // Get data from database - hanya data yang relevan untuk Kadis
        try {
            $pengajuans = Pengajuan::with(['pengguna.identitas'])
                ->whereIn('status', ['validasi', 'menunggu persetujuan kadis', 'disetujui kadis'])
                ->orderBy('updated_at', 'desc')
                ->orderBy('created_at', 'desc')
                ->get();
        } catch (\Exception $e) {
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
            
            // Status Persetujuan - mapping khusus untuk Kadis
            $status = strtolower($pengajuan->status ?? '');
            $statusPersetujuan = '';
            
            switch ($status) {
                case 'validasi':
                case 'menunggu persetujuan kadis':
                    $statusPersetujuan = 'MENUNGGU PERSETUJUAN';
                    break;
                case 'disetujui kadis':
                    $statusPersetujuan = 'DISETUJUI';
                    break;
                default:
                    $statusPersetujuan = strtoupper($status);
                    break;
            }
            
            $sheet->setCellValue('G' . $row, $statusPersetujuan);
            
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
            $spreadsheet = $this->export();
            $filename = 'Laporan_Berkala_Kadis_' . date('Y-m-d_H-i-s') . '.xlsx';

            // Create writer
            $writer = new Xlsx($spreadsheet);

            // Clean any output buffer
            if (ob_get_level()) {
                ob_end_clean();
            }

            // Set headers for download
            return response()->streamDownload(function() use ($writer) {
                $writer->save('php://output');
            }, $filename, [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Cache-Control' => 'max-age=0',
                'Cache-Control' => 'max-age=1', 
                'Expires' => 'Mon, 26 Jul 1997 05:00:00 GMT',
                'Last-Modified' => gmdate('D, d M Y H:i:s') . ' GMT',
                'Cache-Control' => 'cache, must-revalidate',
                'Pragma' => 'public'
            ]);
        } catch (\Exception $e) {
            \Log::error('Excel export error for Kadis: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error generating Excel file: ' . $e->getMessage()
            ], 500);
        }
    }
}
