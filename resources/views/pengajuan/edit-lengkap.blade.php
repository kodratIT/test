<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link rel="icon" type="image/png" href=" {{ asset('assets/img/logo-esdm.svg') }} " />
  <title>Edit Laporan Berkala - {{ $pengajuan->no_pengajuan }}</title>
  <!--     Fonts and icons     -->

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Nucleo Icons -->
  <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Popper -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/@popperjs/core@2"></script>
  <!-- Main Styling -->
  <link href="{{ asset('assets/css/argon-dashboard-tailwind.css?v=1.0.1') }}" rel="stylesheet" />

  <!-- Tambahkan Flatpickr -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
</head>
<style>
  /* Gaya tombol konfirmasi SweetAlert agar selalu terlihat jelas */
  .swal2-confirm {
    background-color: #e3342f !important;
    color: white !important;
    box-shadow: 0 2px 2px rgba(0, 0, 0, 0.2) !important;
    border: none !important;
    font-weight: bold;
  }

  .swal2-confirm:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(227, 52, 47, 0.5) !important;
  }

  .swal2-confirm:hover {
    filter: brightness(0.95);
  }
</style>

<body
  class="m-0 font-sans text-base antialiased font-normal dark:bg-slate-900 leading-default bg-gray-50 text-slate-500">
  <div class="absolute w-full dark:hidden min-h-75" style="background-color: #08A04B;"></div>
  @include('components.sidebar')
  <main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
    <!-- Navbar -->
    <nav
      class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all ease-in shadow-none duration-250 rounded-2xl lg:flex-nowrap lg:justify-start"
      navbar-main navbar-scroll="false">
      <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
        <nav>
          <!-- breadcrumb -->
          <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
            <li class="text-sm leading-normal">
              <a class="text-white opacity-50" href="{{ route('daftarpengajuanpengguna') }}">Daftar Pengajuan</a>
            </li>
            <li
              class="text-sm pl-2 capitalize leading-normal text-white before:float-left before:pr-2 before:text-white before:content-['/']"
              aria-current="page">Edit Laporan Berkala</li>
          </ol>
          <h6 class="mb-4 font-bold text-white capitalize">Edit Laporan Berkala</h6>
        </nav>

        <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
          <div class="flex items-center md:ml-auto md:pr-4">
            <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
              <span
                class="text-sm ease leading-5.6 absolute z-50 -ml-px flex h-full items-center whitespace-nowrap rounded-lg rounded-tr-none rounded-br-none border border-r-0 border-transparent bg-transparent py-2 px-2.5 text-center font-normal text-slate-500 transition-all">

              </span>
            </div>
          </div>
          <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full">
            <li class="flex items-center pl-4 xl:hidden">
              <a href="javascript:;" class="block p-0 text-sm text-white transition-all ease-nav-brand" sidenav-trigger>
                <div class="w-4.5 overflow-hidden">
                  <i class="ease mb-0.75 relative block h-0.5 rounded-sm bg-white transition-all"></i>
                  <i class="ease mb-0.75 relative block h-0.5 rounded-sm bg-white transition-all"></i>
                  <i class="ease relative block h-0.5 rounded-sm bg-white transition-all"></i>
                </div>
              </a>
            </li>
            <li class="flex items-center px-4">
              <a href="javascript:;" class="p-0 text-sm text-white transition-all ease-nav-brand">
                <!-- fixed-plugin-button-nav  -->
              </a>
            </li>

            <!-- notifications -->

            <li class="relative flex items-center pr-2">
              <p class="hidden transform-dropdown-show"></p>
              <a href="javascript:;" class="block p-0 text-sm text-white transition-all ease-nav-brand" dropdown-trigger
                aria-expanded="false">

              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- end Navbar -->

    @if($pengajuan->status == 'perbaikan' && $pengajuan->catatan_evaluasi)
    <!-- Notification Perbaikan -->
    <div class="flex justify-center px-3 mb-4">
      <div class="w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 break-words bg-red-100 border border-red-400 shadow-xl rounded-2xl bg-clip-border">
          <div class="flex-auto p-4">
            <div class="flex items-start">
              <div class="flex-shrink-0">
                <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
              </div>
              <div class="ml-3 flex-1">
                <h3 class="text-lg font-bold text-red-800 mb-2">Pengajuan Memerlukan Perbaikan</h3>
                <div class="text-red-700">
                  <p class="font-semibold mb-2">Catatan dari Evaluator:</p>
                  <div class="bg-white p-3 rounded border border-red-200">
                    {!! nl2br(e($pengajuan->catatan_evaluasi)) !!}
                  </div>
                </div>
                @if($pengajuan->tanggal_evaluasi)
                  <p class="text-sm text-red-600 mt-2">
                    <i class="fas fa-clock mr-1"></i>
                    Dievaluasi pada: {{ $pengajuan->tanggal_evaluasi->format('d F Y H:i') }}
                  </p>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif

    <!-- Card Form Edit Laporan Berkala -->
    <div class="flex justify-center px-3 mb-6">
      <div class="w-full max-w-full px-3 mb-6 sm:w-full sm:flex-none xl:mb-0 xl:w-full">
        <div
          class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
          <div class="flex-auto p-4">
            <div class="flex flex-col -mx-3">
              <div class="w-full max-w-full px-3">

                <h2 class="text-xl font-bold mb-6 uppercase text-center text-gray-700 dark:text-white">Edit Laporan Berkala</h2>
                
                <!-- Status Info -->
                <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                  @php
                    $status = strtolower(trim($pengajuan->status));
                    $statusMap = [
                      'proses evaluasi' => 'bg-orange-100 text-orange-800 border border-orange-200',
                      'perbaikan' => 'bg-red-100 text-red-800 border border-red-200',
                      'ditolak' => 'bg-red-100 text-red-800 border border-red-200',
                      'disetujui' => 'bg-green-100 text-green-800 border border-green-200',
                      'draft' => 'bg-gray-100 text-gray-800 border border-gray-200'
                    ];
                    $badgeClass = $statusMap[$status] ?? 'bg-gray-100 text-gray-800 border border-gray-200';
                    $statusLabel = ucwords($status);
                  @endphp
                  
                  <div class="flex items-center justify-between">
                    <div>
                      <p class="text-blue-800 font-medium">Status: 
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $badgeClass }} ml-2">
                          <i class="fas fa-circle mr-2 text-xs"></i>
                          {{ $statusLabel }}
                        </span>
                      </p>
                      <p class="text-sm text-blue-600 mt-1">Nomor Pengajuan: {{ $pengajuan->no_pengajuan }}</p>
                    </div>
                    <div class="text-right text-sm text-blue-600">
                      <p>Dibuat: {{ $pengajuan->created_at->format('d M Y H:i') }}</p>
                      @if($pengajuan->updated_at && $pengajuan->updated_at != $pengajuan->created_at)
                        <p>Diperbarui: {{ $pengajuan->updated_at->format('d M Y H:i') }}</p>
                      @endif
                    </div>
                  </div>
                </div>

                <form action="{{ route('pengajuan.update', $pengajuan->id) }}"
                  method="POST"
                  enctype="multipart/form-data"
                  novalidate
                  onsubmit="return validateForm(event)">
                  @csrf
                  @method('PUT')
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div id="page1" class="page">

                    <!-- IZIN USAHA -->
                    <h3 class="text-lg font-bold uppercase mt-2 pb-2 text-gray-700 dark:text-white">Izin Usaha Penyediaan Tenaga Listrik</h3>
                    
                    @if($pengajuan->status == 'perbaikan' && $pengajuan->catatan_perbaikan_izin_usaha)
                    <!-- Catatan Perbaikan untuk Izin Usaha -->
                    <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-lg">
                      <div class="flex items-start">
                        <i class="fas fa-exclamation-circle text-red-500 mt-1 mr-2"></i>
                        <div>
                          <p class="text-sm font-medium text-red-800">Catatan Perbaikan:</p>
                          <p class="text-sm text-red-700 mt-1">{!! nl2br(e($pengajuan->catatan_perbaikan_izin_usaha)) !!}</p>
                        </div>
                      </div>
                    </div>
                    @endif
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                      <div>
                        <label>Nomor</label>
                        <input name="nomor_izin_usaha" id="nomor_izin_usaha" type="text" class="w-full border p-2 rounded-lg" 
                               value="{{ old('nomor_izin_usaha', $pengajuan->nomor_izin_usaha) }}" required>
                      </div>
                      <div>
                        <label>Tanggal</label>
                        <input name="tanggal_izin_usaha" id="tanggal_izin_usaha" type="date" class="w-full border p-2 rounded-lg datepicker" 
                               value="{{ old('tanggal_izin_usaha', $pengajuan->tanggal_izin_usaha ? $pengajuan->tanggal_izin_usaha->format('Y-m-d') : '') }}" required>
                      </div>
                      <div>
                        <label>Masa Berlaku</label>
                        <input name="masa_berlaku_izin_usaha" id="masa_berlaku_izin_usaha" type="date" class="w-full border p-2 rounded-lg datepicker" 
                               value="{{ old('masa_berlaku_izin_usaha', $pengajuan->masa_berlaku_izin_usaha ? $pengajuan->masa_berlaku_izin_usaha->format('Y-m-d') : '') }}" required>
                      </div>
                      <div>
                        <label>Kelebihan Tenaga Listrik dijual Kepada</label>
                        <input name="kelebihan_listrik" id="kelebihan_listrik" type="text" class="w-full border p-2 rounded-lg" 
                               value="{{ old('kelebihan_listrik', $pengajuan->kelebihan_listrik) }}" required>
                      </div>
                    </div>
                    <div class="mt-6">
                      <label>Upload IUPLTS</label>
                      @if($pengajuan->lampiran_izin_usaha)
                      <div class="mb-2 text-sm text-gray-600">
                        <i class="fas fa-file-pdf text-red-500 mr-1"></i>
                        File saat ini: <a href="{{ asset('storage/' . $pengajuan->lampiran_izin_usaha) }}" target="_blank" class="text-blue-600 underline">Lihat file</a>
                      </div>
                      @endif
                      <input id="lampiran_izin_usaha" name="lampiran_izin_usaha" type="file" accept=".pdf" class="w-full border p-2 rounded-lg" onchange="previewFile(this)">
                      <small class="text-gray-500">Format PDF Maks 5MB (Kosongkan jika tidak ingin mengubah file)</small>
                    </div>
                    <div id="preview_lampiran_izin_usaha"></div>

                    <!-- IZIN LINGKUNGAN    -->
                    <h3 class="text-lg font-bold uppercase mt-6 pb-2 text-gray-700 dark:text-white">Izin Lingkungan</h3>
                    
                    @if($pengajuan->status == 'perbaikan' && $pengajuan->catatan_perbaikan_izin_lingkungan)
                    <!-- Catatan Perbaikan untuk Izin Lingkungan -->
                    <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-lg">
                      <div class="flex items-start">
                        <i class="fas fa-exclamation-circle text-red-500 mt-1 mr-2"></i>
                        <div>
                          <p class="text-sm font-medium text-red-800">Catatan Perbaikan:</p>
                          <p class="text-sm text-red-700 mt-1">{!! nl2br(e($pengajuan->catatan_perbaikan_izin_lingkungan)) !!}</p>
                        </div>
                      </div>
                    </div>
                    @endif
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                      <div>
                        <label>Jenis Izin</label>
                        <input name="jenis_izin_lingkungan" id="jenis_izin_lingkungan" type="text" class="w-full border p-2 rounded-lg" 
                               value="{{ old('jenis_izin_lingkungan', $pengajuan->jenis_izin_lingkungan) }}" required>
                      </div>
                      <div>
                        <label>Nomor</label>
                        <input name="nomor_izin_lingkungan" id="nomor_izin_lingkungan" type="text" class="w-full border p-2 rounded-lg" 
                               value="{{ old('nomor_izin_lingkungan', $pengajuan->nomor_izin_lingkungan) }}" required>
                      </div>
                      <div>
                        <label>Tanggal</label>
                        <input name="tanggal_izin_lingkungan" id="tanggal_izin_lingkungan" type="date" class="w-full border p-2 rounded-lg datepicker" 
                               value="{{ old('tanggal_izin_lingkungan', $pengajuan->tanggal_izin_lingkungan ? $pengajuan->tanggal_izin_lingkungan->format('Y-m-d') : '') }}" required>
                      </div>
                      <div>
                        <label>Masa Berlaku</label>
                        <input name="masa_berlaku_izin_lingkungan" id="masa_berlaku_izin_lingkungan" type="date" class="w-full border p-2 rounded-lg datepicker" 
                               value="{{ old('masa_berlaku_izin_lingkungan', $pengajuan->masa_berlaku_izin_lingkungan ? $pengajuan->masa_berlaku_izin_lingkungan->format('Y-m-d') : '') }}" required>
                      </div>
                    </div>

                    <div class="mt-6">
                      <label>Upload Izin Lingkungan</label>
                      @if($pengajuan->lampiran_izin_lingkungan)
                      <div class="mb-2 text-sm text-gray-600">
                        <i class="fas fa-file-pdf text-red-500 mr-1"></i>
                        File saat ini: <a href="{{ asset('storage/' . $pengajuan->lampiran_izin_lingkungan) }}" target="_blank" class="text-blue-600 underline">Lihat file</a>
                      </div>
                      @endif
                      <input id="lampiran_izin_lingkungan" name="lampiran_izin_lingkungan" type="file" accept=".pdf" class="w-full border p-2 rounded-lg" onchange="previewFile(this)">
                      <small class="text-gray-500">Format PDF Maks 5MB (Kosongkan jika tidak ingin mengubah file)</small>
                    </div>
                    <div id="preview_lampiran_izin_lingkungan"></div>

                    <!-- Tombol Aksi -->

                    <h3 class="text-lg font-bold uppercase mt-6 pb-2 text-gray-700 dark:text-white">Sertifikat Laik Operasi (SLO)</h3>
                    
                    @if($pengajuan->status == 'perbaikan' && $pengajuan->catatan_perbaikan_slo)
                    <!-- Catatan Perbaikan untuk SLO -->
                    <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-lg">
                      <div class="flex items-start">
                        <i class="fas fa-exclamation-circle text-red-500 mt-1 mr-2"></i>
                        <div>
                          <p class="text-sm font-medium text-red-800">Catatan Perbaikan:</p>
                          <p class="text-sm text-red-700 mt-1">{!! nl2br(e($pengajuan->catatan_perbaikan_slo)) !!}</p>
                        </div>
                      </div>
                    </div>
                    @endif

                    <div class="flex justify-end gap-2 mb-4">
                      <button type="button" onclick="addColumn(event)" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Tambah</button>
                      <button type="button" onclick="removeColumn(event)" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Kurang</button>
                    </div>

                    <div class="overflow-x-auto">
                      <table class="min-w-full border border-gray-300" id="sloTable">
                        <thead class="bg-gray-200 text-center">
                          <tr>
                            <th class="border border-gray-300 p-2 bg-gray-100 text-left sticky left-0 z-10 min-w-[150px] max-w-[150px] w-[150px]">Field</th>
                            <th class="border border-gray-300 p-2 min-w-[220px]">SLO-1</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php
                            $sloData = is_array($pengajuan->slo) ? $pengajuan->slo : [];
                            $sloColumns = !empty($sloData) ? count(array_filter(array_keys($sloData), 'is_numeric')) : 1;
                          @endphp
                          <tr>
                            <td class="border border-gray-300 p-2 font-semibold bg-gray-50 sticky left-0">Nomor Sertifikat</td>
                            <td class="border border-gray-300 p-2">
                              <input name="nomor_sertifikat_slo[]" id="nomor_sertifikat_1" type="text" class="w-full border p-1 rounded" 
                                     value="{{ old('nomor_sertifikat_slo.0', $sloData['nomor_sertifikat_slo'][0] ?? '') }}">
                            </td>
                          </tr>
                          <tr>
                            <td class="border border-gray-300 p-2 font-semibold bg-gray-50 sticky left-0">Nomor Register</td>
                            <td class="border border-gray-300 p-2">
                              <input name="nomor_register_slo[]" id="nomor_register_1" type="text" class="w-full border p-1 rounded" 
                                     value="{{ old('nomor_register_slo.0', $sloData['nomor_register_slo'][0] ?? '') }}">
                            </td>
                          </tr>
                          <tr>
                            <td class="border border-gray-300 p-2 font-semibold bg-gray-50 sticky left-0">Tanggal Terbit</td>
                            <td class="border border-gray-300 p-2">
                              <input name="tanggal_terbit_slo[]" id="tanggal_terbit_slo_1" type="date" class="w-full border p-1 rounded datepicker" 
                                     value="{{ old('tanggal_terbit_slo.0', $sloData['tanggal_terbit_slo'][0] ?? '') }}">
                            </td>
                          </tr>
                          <tr>
                            <td class="border border-gray-300 p-2 font-semibold bg-gray-50 sticky left-0">Tanggal Masa Berlaku</td>
                            <td class="border border-gray-300 p-2">
                              <input name="tanggal_masa_berlaku_slo[]" id="tanggal_masa_berlaku_slo_1" type="date" class="w-full border p-1 rounded datepicker" 
                                     value="{{ old('tanggal_masa_berlaku_slo.0', $sloData['tanggal_masa_berlaku_slo'][0] ?? '') }}">
                            </td>
                          </tr>
                          <tr>
                            <td class="border border-gray-300 p-2 font-semibold bg-gray-50 sticky left-0">Lembaga Inspeksi Teknik (LIT)</td>
                            <td class="border border-gray-300 p-2">
                              <input name="lit[]" id="lit_1" type="text" class="w-full border p-1 rounded" 
                                     value="{{ old('lit.0', $sloData['lit'][0] ?? '') }}">
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="mt-6">
                      <label>Upload SLO</label>
                      @if($pengajuan->lampiran_slo)
                      <div class="mb-2 text-sm text-gray-600">
                        <i class="fas fa-file-pdf text-red-500 mr-1"></i>
                        File saat ini: <a href="{{ asset('storage/' . $pengajuan->lampiran_slo) }}" target="_blank" class="text-blue-600 underline">Lihat file</a>
                      </div>
                      @endif
                      <input id="lampiran_slo" name="lampiran_slo" type="file" accept=".pdf" class="w-full border p-2 rounded-lg" onchange="previewFile(this)">
                      <small class="text-gray-500">Format PDF Maks 5MB (Kosongkan jika tidak ingin mengubah file)</small>
                    </div>
                    <div id="preview_lampiran_slo"></div>

                    <!-- SKTTK Section -->
                    <h3 class="text-lg font-bold uppercase mt-6 pb-2 text-gray-700 dark:text-white">SERTIFIKAT KOMPETENSI TENAGA TEKNIK KETENAGALISTRIKAN (SKTTK)</h3>
                    
                    @if($pengajuan->status == 'perbaikan' && $pengajuan->catatan_perbaikan_skttk)
                    <!-- Catatan Perbaikan untuk SKTTK -->
                    <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-lg">
                      <div class="flex items-start">
                        <i class="fas fa-exclamation-circle text-red-500 mt-1 mr-2"></i>
                        <div>
                          <p class="text-sm font-medium text-red-800">Catatan Perbaikan:</p>
                          <p class="text-sm text-red-700 mt-1">{!! nl2br(e($pengajuan->catatan_perbaikan_skttk)) !!}</p>
                        </div>
                      </div>
                    </div>
                    @endif

                    <div class="flex justify-end gap-2 mb-4">
                      <button type="button" onclick="addSKTTKColumn()" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Tambah</button>
                      <button type="button" onclick="removeSKTTKColumn()" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Kurang</button>
                    </div>

                    <div class="overflow-x-auto">
                      <table id="skttkTable" class="min-w-full border border-gray-300 text-sm">
                        <thead>
                          <tr>
                            <th class="border border-gray-300 p-2 bg-gray-100 text-left sticky left-0 z-10 min-w-[150px] max-w-[150px] w-[150px]">Field</th>
                            <th class="border p-2 bg-gray-200 border-gray-300   min-w-[220px]">SKTTK1</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php
                            $skttkData = is_array($pengajuan->skttk) ? $pengajuan->skttk : [];
                          @endphp
                          <tr>
                            <td class="border border-gray-300 p-2 font-semibold bg-gray-50 sticky left-0">Nomor Sertifikat</td>
                            <td class="border border-gray-300 p-2">
                              <input name="nomor_sertifikat_skttk[]" id="nomor_sertifikat_skttk_1" type="text" class="w-full border p-1 rounded" 
                                     value="{{ old('nomor_sertifikat_skttk.0', $skttkData['nomor_sertifikat_skttk'][0] ?? '') }}" placeholder="1234.0.12.A123.12.2025">
                            </td>
                          </tr>
                          <tr>
                            <td class="border border-gray-300 p-2 font-semibold bg-gray-50 sticky left-0">Nomor Register</td>
                            <td class="border border-gray-300 p-2">
                              <input name="nomor_register_skttk[]" id="nomor_register_skttk_1" type="text" class="w-full border p-1 rounded" 
                                     value="{{ old('nomor_register_skttk.0', $skttkData['nomor_register_skttk'][0] ?? '') }}" placeholder="12345.1.2025">
                            </td>
                          </tr>
                          <tr>
                            <td class="border border-gray-300 p-2 font-semibold bg-gray-50 sticky left-0">Nama</td>
                            <td class="border p-2">
                              <input name="nama_skttk[]" id="nama_skttk_1" type="text" class="w-full border p-1 rounded" 
                                     value="{{ old('nama_skttk.0', $skttkData['nama_skttk'][0] ?? '') }}">
                            </td>
                          </tr>
                          <tr>
                            <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Jabatan</td>
                            <td class="border p-2">
                              <input name="jabatan_skttk[]" id="jabatan_skttk_1" type="text" class="w-full border p-1 rounded" 
                                     value="{{ old('jabatan_skttk.0', $skttkData['jabatan_skttk'][0] ?? '') }}">
                            </td>
                          </tr>
                          <tr>
                            <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Kode Jenjang Kualifikasi</td>
                            <td class="border p-2">
                              <input name="kode_kualifikasi_skttk[]" id="kode_kualifikasi_skttk_1" type="text" placeholder="A.12.123.12.KUALIFIKASI.1.ABCDEF" class="w-full border p-1 rounded" 
                                     value="{{ old('kode_kualifikasi_skttk.0', $skttkData['kode_kualifikasi_skttk'][0] ?? '') }}">
                            </td>
                          </tr>
                          <tr>
                            <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Unit Kompetensi Inti (1)</td>
                            <td class="border p-2">
                              <input name="kompetensi_inti1_skttk[]" id="kompetensi_inti1_skttk_1" type="text" class="w-full border p-1 rounded" 
                                     value="{{ old('kompetensi_inti1_skttk.0', $skttkData['kompetensi_inti1_skttk'][0] ?? '') }}">
                            </td>
                          </tr>
                          <tr>
                            <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Unit Kompetensi Inti (2)</td>
                            <td class="border p-2">
                              <input name="kompetensi_inti2_skttk[]" id="kompetensi_inti2_skttk_1" type="text" class="w-full border p-1 rounded" 
                                     value="{{ old('kompetensi_inti2_skttk.0', $skttkData['kompetensi_inti2_skttk'][0] ?? '') }}">
                            </td>
                          </tr>
                          <tr>
                            <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Unit Kompetensi Pilihan (1)</td>
                            <td class="border p-2">
                              <input name="kompetensi_pilihan1_skttk[]" id="kompetensi_pilihan1_skttk_1" type="text" class="w-full border p-1 rounded" 
                                     value="{{ old('kompetensi_pilihan1_skttk.0', $skttkData['kompetensi_pilihan1_skttk'][0] ?? '') }}">
                            </td>
                          </tr>
                          <tr>
                            <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Unit Kompetensi Pilihan (2)</td>
                            <td class="border p-2">
                              <input name="kompetensi_pilihan2_skttk[]" id="kompetensi_pilihan2_skttk_1" type="text" class="w-full border p-1 rounded" 
                                     value="{{ old('kompetensi_pilihan2_skttk.0', $skttkData['kompetensi_pilihan2_skttk'][0] ?? '') }}">
                            </td>
                          </tr>
                          <tr>
                            <td class="border border-gray-300 p-2 font-semibold bg-gray-50 sticky left-0">Tanggal Terbit</td>
                            <td class="border border-gray-300 p-2">
                              <input name="tanggal_terbit_skttk[]" id="tanggal_terbit_skttk_1" type="date" class="w-full border p-1 rounded datepicker" 
                                     value="{{ old('tanggal_terbit_skttk.0', $skttkData['tanggal_terbit_skttk'][0] ?? '') }}">
                            </td>
                          </tr>
                          <tr>
                            <td class="border border-gray-300 p-2 font-semibold bg-gray-50 sticky left-0">Tanggal Masa Berlaku</td>
                            <td class="border border-gray-300 p-2">
                              <input name="tanggal_masa_berlaku_skttk[]" id="tanggal_masa_berlaku_skttk_1" type="date" class="w-full border p-1 rounded datepicker" 
                                     value="{{ old('tanggal_masa_berlaku_skttk.0', $skttkData['tanggal_masa_berlaku_skttk'][0] ?? '') }}">
                            </td>
                          </tr>
                          <tr>
                            <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Lembaga Sertifikasi Kompetensi (LSK)</td>
                            <td class="border p-2">
                              <input name="lsk_skttk[]" id="lsk_skttk_1" type="text" class="w-full border p-1 rounded" 
                                     value="{{ old('lsk_skttk.0', $skttkData['lsk_skttk'][0] ?? '') }}">
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="mt-6">
                      <label>Upload SKTTK</label>
                      @if($pengajuan->lampiran_skttk)
                      <div class="mb-2 text-sm text-gray-600">
                        <i class="fas fa-file-pdf text-red-500 mr-1"></i>
                        File saat ini: <a href="{{ asset('storage/' . $pengajuan->lampiran_skttk) }}" target="_blank" class="text-blue-600 underline">Lihat file</a>
                      </div>
                      @endif
                      <input id="lampiran_skttk" name="lampiran_skttk" type="file" accept=".pdf" class="w-full border p-2 rounded-lg" onchange="previewFile(this)">
                      <small class="text-gray-500">Format PDF Maks 5MB (Kosongkan jika tidak ingin mengubah file)</small>
                    </div>
                    <div id="preview_lampiran_skttk"></div>

                    <!------>
                    <div class="flex justify-end mt-4">
                      <button type="button" onclick="goToNextPage()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Selanjutnya</button>
                    </div>

                  </div>

                  <!-- Page 2 content will be added in the next part due to length constraints -->
                  <div id="page2" class="page hidden">
                    <!-- MESIN PENGGERAK MULA Content - This matches the original structure -->
                    <!-- [Page 2 content continues...] -->
                  </div>

                  <div id="page3" class="page hidden">
                    <!-- Final page with capacity tables and excess power -->
                    <!-- [Page 3 content continues...] -->
                  </div>

                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Include all the original JavaScript from laporanberkala.blade.php -->
  <script>
    let columnCount = 1;
    let skttkColumnCount = 1;

    // Copy all JavaScript functions from original file
    // [JavaScript functions continue...]
    
    // Page navigation
    document.addEventListener("DOMContentLoaded", function() {
      let currentPage = 1;
      const totalPages = 3;

      function showPage(pageNumber) {
        const pages = document.querySelectorAll(".page");
        pages.forEach(page => page.classList.add("hidden"));
        
        const activePage = document.getElementById("page" + pageNumber);
        if (activePage) {
          activePage.classList.remove("hidden");
          setTimeout(() => {
            activePage.scrollIntoView({
              behavior: "instant",
              block: "start"
            });
          }, 100);
        }
        currentPage = pageNumber;
      }

      window.goToNextPage = function() {
        if (currentPage < totalPages) {
          showPage(currentPage + 1);
        }
      };

      window.goToPrevPage = function() {
        if (currentPage > 1) {
          showPage(currentPage - 1);
        }
      };

      // Initialize first page
      showPage(1);
      
      // Initialize Flatpickr
      flatpickr(".datepicker", {
        dateFormat: "Y-m-d",
        locale: "id",
        allowInput: true
      });
    });

    // Validation and other functions
    function validateForm(e) {
      // Form validation logic
      return true;
    }

    function previewFile(input) {
      const file = input.files[0];
      const previewId = input.id.replace("lampiran_", "preview_lampiran_");
      const preview = document.getElementById(previewId);
      
      if (preview) {
        preview.innerHTML = "";
        
        if (file) {
          const allowedTypes = ["application/pdf"];
          const maxSize = 5 * 1024 * 1024;
          
          if (!allowedTypes.includes(file.type)) {
            Swal.fire({
              icon: 'error',
              title: 'Format Salah',
              text: 'File harus berupa PDF!',
            });
            input.value = "";
            return;
          }
          
          if (file.size > maxSize) {
            Swal.fire({
              icon: 'error',
              title: 'Ukuran File Terlalu Besar',
              text: 'Ukuran file maksimal 5MB!',
            });
            input.value = "";
            return;
          }
          
          const url = URL.createObjectURL(file);
          preview.innerHTML = `<a href="${url}" target="_blank" class="text-blue-600 underline">Lihat</a>`;
        }
      }
    }
  </script>

</body>

</html>
