<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ucfirst($document_type) }} - {{ $pengajuan->pengguna->identitas->namabadanusaha ?? 'N/A' }}</title>
    <style>
        @page {
            size: A4;
            margin: 3cm 2cm 2.5cm 3cm;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Times New Roman', serif;
            font-size: 12pt;
            line-height: 1.5;
            color: #000;
            background: white;
        }
        
        .document-container {
            max-width: 21cm;
            margin: 0 auto;
            padding: 20px;
            background: white;
            min-height: 29.7cm;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #000;
            padding-bottom: 20px;
        }
        
        .logo {
            margin-bottom: 20px;
        }
        
        .logo img {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }
        
        .header-text {
            margin-bottom: 5px;
        }
        
        .header-main {
            font-size: 18pt;
            font-weight: bold;
            text-transform: uppercase;
            color: #000080;
            margin-bottom: 5px;
        }
        
        .header-sub {
            font-size: 16pt;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 15px;
        }
        
        .contact-info {
            font-size: 10pt;
            color: #333;
            line-height: 1.3;
        }
        
        .document-title {
            text-align: center;
            margin: 30px 0;
        }
        
        .title-text {
            font-size: 16pt;
            font-weight: bold;
            text-transform: uppercase;
            text-decoration: underline;
            margin-bottom: 10px;
        }
        
        .document-number {
            font-size: 14pt;
            font-weight: bold;
            margin: 20px 0;
        }
        
        .content {
            margin: 30px 0;
            text-align: justify;
        }
        
        .company-info {
            text-align: center;
            margin: 20px 0;
        }
        
        .company-name {
            font-size: 16pt;
            font-weight: bold;
            text-transform: uppercase;
            margin: 10px 0;
        }
        
        .company-details {
            font-size: 12pt;
            margin: 5px 0;
        }
        
        .signature-area {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        
        .qr-area {
            width: 150px;
            height: 150px;
            border: 1px solid #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10pt;
            color: #666;
        }
        
        .signature-block {
            text-align: left;
            min-width: 250px;
        }
        
        .signature-text {
            margin-bottom: 60px;
        }
        
        .official-name {
            font-weight: bold;
            border-bottom: 1px solid #000;
            padding-bottom: 2px;
        }
        
        .nip {
            font-size: 10pt;
            margin-top: 5px;
        }
        
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #ccc;
            font-size: 10pt;
            color: #666;
            text-align: center;
        }
        
        @media print {
            .no-print {
                display: none !important;
            }
            
            body {
                background: white;
            }
            
            .document-container {
                padding: 0;
                box-shadow: none;
            }
        }
        
        .print-controls {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            background: white;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .btn {
            padding: 8px 16px;
            margin: 0 5px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-primary {
            background: #007bff;
            color: white;
        }
        
        .btn-success {
            background: #28a745;
            color: white;
        }
        
        .btn-secondary {
            background: #6c757d;
            color: white;
        }
        
        .btn:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <!-- Print Controls -->
    <div class="print-controls no-print">
        <button onclick="window.print()" class="btn btn-primary">
            <i class="fas fa-print"></i> Print
        </button>
        <a href="/dokumen/{{ $pengajuan->id }}/download/{{ $document_type }}" class="btn btn-success">
            <i class="fas fa-download"></i> Download Word
        </a>
        <button onclick="window.history.back()" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </button>
    </div>

    <div class="document-container">
        <!-- Header -->
        <div class="header">
            <div class="logo">
                <img src="{{ $logo_url }}" alt="Logo Provinsi Jambi" onerror="this.style.display='none'">
            </div>
            
            <div class="header-text">
                <div class="header-main">{{ $province_info['name'] }}</div>
                <div class="header-sub">{{ $province_info['department'] }}</div>
            </div>
            
            <div class="contact-info">
                <div>{{ $province_info['address'] }}</div>
                <div>{{ $province_info['phone'] }}, {{ $province_info['fax'] }}</div>
                <div>{{ $province_info['email'] }} | {{ $province_info['website'] }}</div>
            </div>
        </div>

        <!-- Document Title -->
        <div class="document-title">
            @if($document_type === 'pengesahan')
                <div class="title-text">Lembar Pengesahan Evaluasi Teknis</div>
                <div class="title-text">Laporan Pelaksanaan Usaha Penyediaan Tenaga Listrik</div>
                <div class="title-text">Untuk Kepentingan Sendiri</div>
                <div class="title-text">Periode Tahun {{ date('Y') }}</div>
            @elseif($document_type === 'sertifikat')
                <div class="title-text">Sertifikat Laporan Berkala</div>
                <div class="title-text">Usaha Penyediaan Tenaga Listrik</div>
            @else
                <div class="title-text">Dokumen Resmi</div>
            @endif
        </div>

        <!-- Document Number -->
        <div class="document-number" style="text-align: center;">
            <strong>NOMOR: {{ $document_number }}</strong>
        </div>

        <!-- Company Information -->
        <div class="company-info">
            <div style="margin-bottom: 15px;">Diberikan kepada:</div>
            <div class="company-name">{{ strtoupper($pengajuan->pengguna->identitas->namabadanusaha ?? 'N/A') }}</div>
            <div class="company-details">NIB: {{ $pengajuan->pengguna->identitas->nib ?? '-' }}</div>
            <div class="company-details">{{ $pengajuan->pengguna->identitas->alamatkantorpusat ?? 'Alamat tidak tersedia' }}</div>
            @if($pengajuan->pengguna->identitas->contact_person_nama)
                <div class="company-details">
                    Contact Person: {{ $pengajuan->pengguna->identitas->contact_person_nama }}
                    ({{ $pengajuan->pengguna->identitas->contact_person_jabatan ?? '-' }})
                </div>
            @endif
        </div>

        <!-- Content -->
        <div class="content">
            @if($document_type === 'pengesahan')
                <p>
                    Berdasarkan hasil evaluasi teknis yang telah dilakukan, dengan ini menyatakan bahwa 
                    laporan pelaksanaan usaha penyediaan tenaga listrik untuk kepentingan sendiri 
                    yang disampaikan oleh perusahaan tersebut di atas telah memenuhi persyaratan 
                    dan ketentuan yang berlaku sesuai dengan peraturan perundang-undangan.
                </p>
            @elseif($document_type === 'sertifikat')
                <p>
                    Berdasarkan evaluasi dan verifikasi yang telah dilaksanakan, dengan ini memberikan 
                    sertifikat kepada perusahaan tersebut di atas bahwa laporan berkala usaha penyediaan 
                    tenaga listrik untuk kepentingan sendiri telah sesuai dengan standar dan ketentuan 
                    yang ditetapkan.
                </p>
            @endif

            <div style="margin-top: 20px;">
                <div><strong>Tanggal Pengajuan:</strong> {{ $pengajuan->created_at ? $pengajuan->created_at->translatedFormat('d F Y') : '-' }}</div>
                <div><strong>Status:</strong> {{ ucfirst($pengajuan->status) }}</div>
                @if($pengajuan->catatan_kadis)
                    <div><strong>Catatan:</strong> {{ $pengajuan->catatan_kadis }}</div>
                @endif
            </div>
        </div>

        <!-- Signature Area -->
        <div class="signature-area">
            <div class="qr-area">
                QR Code untuk Verifikasi<br>
                <small>{{ $document_number }}</small>
            </div>
            
            <div class="signature-block">
                <div class="signature-text">
                    <div>Jambi, {{ $generated_date }}</div>
                    <br>
                    <div>Ditandatangani secara elektronik oleh:</div>
                    <div><strong>{{ $official_info['title'] }}</strong></div>
                    <br><br><br>
                    <div class="official-name">{{ $official_info['kadis_name'] }}</div>
                    <div class="nip">NIP. {{ $official_info['kadis_nip'] }}</div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div>Dokumen ini dihasilkan secara elektronik oleh Sistem Informasi Dinas ESDM Provinsi Jambi</div>
            <div>Tanggal Cetak: {{ Carbon::now()->translatedFormat('d F Y H:i:s') }}</div>
        </div>
    </div>

    <script>
        // Auto-focus on print dialog for better UX
        document.addEventListener('DOMContentLoaded', function() {
            // Optional: Auto-print when opened
            // window.print();
        });
    </script>
</body>
</html>
