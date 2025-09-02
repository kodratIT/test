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
            font-family: "arial", serif;
            font-size: 12pt;
            line-height: 1.5;
            text-align: center;
        }

        .logo {
            width: 5cm;
            height: 5cm;
            object-fit: contain;
        }

        p {
            margin: 0;
            padding: 0;
        }

        .judul {
            font-size: 16pt;
            font-weight: 500;
            text-transform: uppercase;
        }

        .judul-besar {
            font-size: 18pt;
            font-weight: bold;
            display: block;
            margin-top: 2px;
            margin-bottom: 10px;
        }

        .teks {
            font-size: 14pt;
            font-weight: 550;
            text-transform: uppercase;
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .subjudul {
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .isi {
            margin-top: 25px;
            margin-bottom: 35px;
            font-size: 12pt;
        }

        .nama {
            font-weight: bold;
            text-transform: uppercase;
            font-size: 16pt;
            margin-top: 5px;
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

        /* Flex container untuk QR & TTE */
        .tte-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 40px;
        }

        table.tte {
            border: 1px solid black;
            border-collapse: collapse;
            font-size: 11.5pt;
        }

        table.tte td {
            border: 1px solid black;
            padding: 10px 12px;
            vertical-align: top;
        }

        .qr {
            width: 110px;
        }

        .text-ttd {
            text-align: left;
            line-height: 1.6;
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

    <!-- Logo -->
    <img src="{{ asset('assets/img/logo-jambi.svg') }}" alt="Logo Provinsi Jambi" class="logo">

    <!-- Header -->
    <p class="judul">PEMERINTAH PROVINSI JAMBI<br>
        <span class="judul-besar">DINAS ENERGI DAN SUMBER DAYA MINERAL</span>
    </p>

    <div class="subjudul">
        <p class="teks">
            LEMBAR PENGESAHAN EVALUASI TEKNIS <br>
            LAPORAN PELAKSANAAN USAHA PENYEDIAAN TENAGA LISTRIK <br>
            UNTUK KEPENTINGAN SENDIRI <br>
            PERIODE TAHUN {{ date('Y') }}
        </p>
    </div>

    <div class="nomor">
        <p><b>NOMOR: {{ $pengajuan->nomor_pengesahan ?? 'LP-' . str_pad($pengajuan->id, 4, '0', STR_PAD_LEFT) . '/' . date('Y') }}</b></p>
    </div>

    <!-- Isi -->
    <div class="isi">
        <p>Diberikan kepada</p>
        <p class="nama">{{ strtoupper($pengajuan->pengguna->identitas->namabadanusaha ?? 'N/A') }}</p>

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

    <!-- Flex untuk 2 tabel sampingan -->
    <div class="tte-container">
        <!-- Tabel QR -->
        <table class="tte">
            <tr>
                <td style="text-align: center;">
                    <!-- QR Code bisa diganti dengan generator QR yang sesuai -->
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=110x110&data={{ urlencode('Dokumen Pengesahan No: ' . ($pengajuan->nomor_pengesahan ?? 'LP-' . str_pad($pengajuan->id, 4, '0', STR_PAD_LEFT) . '/' . date('Y'))) }}" alt="QR TTE" class="qr">
                </td>
            </tr>
        </table>

        <!-- Tabel TTE Teks -->
        <table class="tte">
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
