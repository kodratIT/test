<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lembar Pengesahan - {{ $pengajuan->pengguna->identitas->namabadanusaha ?? 'N/A' }}</title>
    <style>
        @page {
            size: A4;
            margin: 2.5cm 2cm 2.5cm 2cm;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 12pt;
            line-height: 1.5;
            text-align: center;
            max-width: 210mm;
            margin: 0 auto;
            padding: 20px;
        }

        .logo-placeholder {
            width: 5cm;
            height: 5cm;
            border: 2px solid #1E40AF;
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #F3F4F6;
            color: #1E40AF;
            font-weight: bold;
            font-size: 14px;
        }

        .judul {
            font-size: 16pt;
            font-weight: 500;
            text-transform: uppercase;
            margin: 10px 0;
        }

        .judul-besar {
            font-size: 18pt;
            font-weight: bold;
            display: block;
            margin: 5px 0 15px 0;
        }

        .teks {
            font-size: 14pt;
            font-weight: 550;
            text-transform: uppercase;
            margin: 5px 0;
        }

        .subjudul {
            margin: 10px 0 20px 0;
        }

        .isi {
            margin: 25px 0 35px 0;
            font-size: 12pt;
        }

        .nama {
            font-weight: bold;
            text-transform: uppercase;
            font-size: 16pt;
            margin: 5px 0;
        }

        .nomor {
            font-size: 14pt;
            font-weight: bold;
            margin: 15px 0;
        }

        .info-perusahaan {
            margin: 10px 0;
            font-size: 13pt;
        }

        .tte-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 40px;
            flex-wrap: wrap;
        }

        .tte-table {
            border: 1px solid black;
            border-collapse: collapse;
            font-size: 11.5pt;
        }

        .tte-table td {
            border: 1px solid black;
            padding: 10px 12px;
            vertical-align: top;
        }

        .qr-placeholder {
            width: 110px;
            height: 110px;
            border: 1px solid #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f9f9f9;
            font-size: 10px;
            text-align: center;
        }

        .text-ttd {
            text-align: left;
            line-height: 1.6;
            min-width: 200px;
        }

        .bold {
            font-weight: bold;
        }

        @media print {
            body {
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
</head>

<body>

    <!-- Logo Placeholder -->
    <div class="logo-placeholder">
        LOGO<br>JAMBI
    </div>

    <!-- Header -->
    <div class="judul">
        PEMERINTAH PROVINSI JAMBI<br>
        <span class="judul-besar">DINAS ENERGI DAN SUMBER DAYA MINERAL</span>
    </div>

    <div class="subjudul">
        <div class="teks">
            LEMBAR PENGESAHAN EVALUASI TEKNIS <br>
            LAPORAN PELAKSANAAN USAHA PENYEDIAAN TENAGA LISTRIK <br>
            UNTUK KEPENTINGAN SENDIRI <br>
            PERIODE TAHUN {{ date('Y') }}
        </div>
    </div>

    <div class="nomor">
        <strong>NOMOR: {{ $pengajuan->nomor_pengesahan ?? 'LP-' . str_pad($pengajuan->id, 4, '0', STR_PAD_LEFT) . '/' . date('Y') }}</strong>
    </div>

    <!-- Isi -->
    <div class="isi">
        <p>Diberikan kepada</p>
        <div class="nama">{{ strtoupper($pengajuan->pengguna->identitas->namabadanusaha ?? 'N/A') }}</div>

        <div class="info-perusahaan">
            <p><strong>NIB:</strong> {{ $pengajuan->pengguna->identitas->nib ?? '-' }}</p>
            <p><strong>Alamat:</strong> {{ $pengajuan->pengguna->identitas->alamatbadanusaha ?? 'Alamat tidak tersedia' }}</p>
        </div>

        <p style="margin-top: 20px;">
            Bahwa laporan pelaksanaan usaha penyediaan tenaga listrik untuk kepentingan sendiri 
            yang diajukan oleh perusahaan tersebut di atas telah sesuai dengan ketentuan yang berlaku 
            dan telah melalui proses evaluasi teknis.
        </p>

        <p style="margin-top: 15px;">
            <strong>Tanggal Pengajuan:</strong> {{ $pengajuan->created_at ? $pengajuan->created_at->format('d F Y') : '-' }}<br>
            <strong>Status:</strong> {{ ucfirst($pengajuan->status) }}<br>
            @if($pengajuan->catatan_kadis)
            <strong>Catatan:</strong> {{ $pengajuan->catatan_kadis }}
            @endif
        </p>
    </div>

    <!-- Container untuk QR & TTE -->
    <div class="tte-container">
        <!-- Tabel QR -->
        <table class="tte-table">
            <tr>
                <td style="text-align: center;">
                    <div class="qr-placeholder">
                        QR CODE<br>
                        {{ 'LP-' . str_pad($pengajuan->id, 4, '0', STR_PAD_LEFT) }}
                    </div>
                </td>
            </tr>
        </table>

        <!-- Tabel TTE Teks -->
        <table class="tte-table">
            <tr>
                <td class="text-ttd">
                    Jambi, {{ date('d F Y') }} <br><br>
                    Ditandatangani secara elektronik oleh: <br>
                    <span class="bold">Kepala Dinas Energi dan Sumber Daya Mineral<br>
                        Provinsi Jambi</span> <br><br>
                    <span class="bold">Tandry Adi Negara, S.STP., M.Si.</span>
                </td>
            </tr>
        </table>
    </div>

</body>
</html>
