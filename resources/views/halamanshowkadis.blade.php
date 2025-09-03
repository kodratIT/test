<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" type="image/png" href=" {{ asset('assets/img/logo-esdm.svg') }} " />
  <title>Daftar Permohonan</title>
  <!--     Fonts and icons     -->

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Nucleo Icons -->
  <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Popper -->
  <script src="https://unpkg.com/@popperjs/core@2"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Main Styling -->
  <link href="{{ asset('assets/css/argon-dashboard-tailwind.css?v=1.0.1') }}" rel="stylesheet" />
</head>
<style>
  .border-red-500 {
    border-color: red !important;
    outline: none;
  }

  .hidden {
    display: none;
  }

  .overflow-scroll {
    overflow-x: auto;
  }

  table {
    border-collapse: collapse;
    min-width: 600px;
  }

  th,
  td {
    border: 1px solid #ccc;
    padding: 6px;
    text-align: center;
  }

  input {
    width: 100%;
    padding: 4px;
    box-sizing: border-box;
  }

  @media screen and (max-width: 768px) {
    .overflow-scroll {
      width: 100%;
      display: block;
    }
  }
</style>

<body
  class="m-0 font-sans text-base antialiased font-normal dark:bg-slate-900 leading-default bg-gray-50 text-slate-500">
  <div class="absolute w-full dark:hidden min-h-75 bg-yellow-500"></div>



  <!-- end sidenav -->






  <main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-90 rounded-xl">
    <!-- Navbar -->
    <nav
      class="relative flex flex-wrap items-center justify-between px-2 py-2 mx-1 transition-all ease-in shadow-none duration-250 rounded-2xl lg:flex-nowrap lg:justify-start"
      navbar-main navbar-scroll="false">
      <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
        <nav>
          <!-- breadcrumb -->
          <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
            <li class="text-sm leading-normal">
              <a class="text-white opacity-50" href="javascript:;">Halaman</a>
            </li>
            <li
              class="text-sm pl-2 capitalize leading-normal text-white before:float-left before:pr-2 before:text-white before:content-['/']"
              aria-current="page">Data Teknis</li>
          </ol>
          <h6 class="mb-0 font-bold text-white capitalize">Data Teknis</h6>
        </nav>

      <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
        <!-- <div class="mr-4">
          <span class="text-white text-sm">Evaluator: {{ Auth::user()->name }}</span>
        </div> -->
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

              <ul dropdown-menu
                class="text-sm transform-dropdown before:font-awesome before:leading-default before:duration-350 before:ease lg:shadow-3xl duration-250 min-w-44 before:sm:right-8 before:text-5.5 pointer-events-none absolute right-0 top-0 z-50 origin-top list-none rounded-lg border-0 border-solid border-transparent dark:shadow-dark-xl dark:bg-slate-850 bg-white bg-clip-padding px-2 py-4 text-left text-slate-500 opacity-0 transition-all before:absolute before:right-2 before:left-auto before:top-0 before:z-50 before:inline-block before:font-normal before:text-white before:antialiased before:transition-all before:content-['\f0d8'] sm:-mr-6 lg:absolute lg:right-0 lg:left-auto lg:mt-2 lg:block lg:cursor-pointer">
                <!-- add show class on dropdown open js -->
                <li class="relative mb-2">
                  <a class="dark:hover:bg-slate-900 ease py-1.2 clear-both block w-full whitespace-nowrap rounded-lg bg-transparent px-4 duration-300 hover:bg-gray-200 hover:text-slate-700 lg:transition-colors"
                    href="javascript:;">
                    <div class="flex py-1">
                      <div class="my-auto">
                        <img src="../assets/img/team-2.jpg"
                          class="inline-flex items-center justify-center mr-4 text-sm text-white h-9 w-9 max-w-none rounded-xl" />
                      </div>
                      <div class="flex flex-col justify-center">
                        <h6 class="mb-1 text-sm font-normal leading-normal dark:text-white"><span
                            class="font-semibold"> New message</span> from Laur</h6>
                        <p class="mb-0 text-xs leading-tight text-slate-400 dark:text-white/80">
                          <i class="mr-1 fa fa-clock"></i>
                          13 minutes ago
                        </p>
                      </div>
                    </div>
                  </a>
                </li>

                <li class="relative mb-2">
                  <a class="dark:hover:bg-slate-900 ease py-1.2 clear-both block w-full whitespace-nowrap rounded-lg px-4 transition-colors duration-300 hover:bg-gray-200 hover:text-slate-700"
                    href="javascript:;">
                    <div class="flex py-1">
                      <div class="my-auto">
                        <img src="../assets/img/small-logos/logo-spotify.svg"
                          class="inline-flex items-center justify-center mr-4 text-sm text-white bg-gradient-to-tl from-zinc-800 to-zinc-700 dark:bg-gradient-to-tl dark:from-slate-750 dark:to-gray-850 h-9 w-9 max-w-none rounded-xl" />
                      </div>
                      <div class="flex flex-col justify-center">
                        <h6 class="mb-1 text-sm font-normal leading-normal dark:text-white"><span
                            class="font-semibold">New album</span> by Travis Scott</h6>
                        <p class="mb-0 text-xs leading-tight text-slate-400 dark:text-white/80">
                          <i class="mr-1 fa fa-clock"></i>
                          1 day
                        </p>
                      </div>
                    </div>
                  </a>
                </li>

                <li class="relative">
                  <a class="dark:hover:bg-slate-900 ease py-1.2 clear-both block w-full whitespace-nowrap rounded-lg px-4 transition-colors duration-300 hover:bg-gray-200 hover:text-slate-700"
                    href="javascript:;">
                    <div class="flex py-1">
                      <div
                        class="inline-flex items-center justify-center my-auto mr-4 text-sm text-white transition-all duration-200 ease-nav-brand bg-gradient-to-tl from-slate-600 to-slate-300 h-9 w-9 rounded-xl">
                        <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1"
                          xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <title>credit-card</title>
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                              <g transform="translate(1716.000000, 291.000000)">
                                <g transform="translate(453.000000, 454.000000)">
                                  <path class="color-background"
                                    d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z"
                                    opacity="0.593633743"></path>
                                  <path class="color-background"
                                    d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z">
                                  </path>
                                </g>
                              </g>
                            </g>
                          </g>
                        </svg>
                      </div>
                      <div class="flex flex-col justify-center">
                        <h6 class="mb-1 text-sm font-normal leading-normal dark:text-white">Payment successfully
                          completed</h6>
                        <p class="mb-0 text-xs leading-tight text-slate-400 dark:text-white/80">
                          <i class="mr-1 fa fa-clock"></i>
                          2 days
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- end Navbar -->

    <!-- Card Form Pengajuan Surat -->
    <div class="flex justify-center px-3 mb-6">
      <div class="w-full max-w-full px-3 mb-6 sm:w-full sm:flex-none xl:mb-0 xl:w-full">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
          <div class="flex-auto p-4">
            <div class="flex flex-col -mx-3">
              <div class="w-full max-w-full px-3">

                <!-- Halaman 0: Data Pemilik -->
                <div id="page0">
                  <h2 class="text-center font-bold text-lg bg-gray-100 p-3 rounded-t border-b border-gray-300">DATA PEMILIK</h2>

                  <!-- Container 1: DATA PEMILIK | LAMPIRAN | EVALUASI -->
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 border border-gray-200 rounded shadow-sm overflow-hidden p-4">
                    <!-- KOLOM 1: DATA PEMILIK -->

                    <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                      <h2 class="text-lg font-bold text-center border-b pb-2 mb-2">Profil Badan Usaha</h2>
                      <div class="overflow-x-auto">
                        <table class="w-full table-auto border-collapse border border-gray-300 text-sm text-left">

                          <tbody id="body-Data Pemilik">
                            <tr>
                              <td class="text-left align-middle font-bold min-w-[150px] max-w-[150px] w-[150px]">Nama Badan Usaha</td>

                              <td class="text-left align-middle">{{ $pengajuan->pengguna->identitas->namabadanusaha ?? 'Tidak Ada' }}</td>
                            </tr>

                            <tr>
                              <td class="text-left align-middle font-bold min-w-[150px] max-w-[150px] w-[150px]">NIB</td>

                              <td class="text-left align-middle">{{ $pengajuan->pengguna->identitas->nib ?? 'Tidak Ada' }}</td>
                            </tr>

                            <tr>
                              <td class="text-left align-middle font-bold">Alamat Kantor Pusat</td>

                              <td class="text-left align-middle">{{ $pengajuan->pengguna->identitas->alamatkantorpusat ?? 'Tidak Ada' }}</td>
                            </tr>
                            <tr>
                              <td class="text-left align-middle font-bold">Alamat Kantor Cabang</td>

                              <td class="text-left align-middle">{{ $pengajuan->pengguna->identitas->alamatkantorcabang ?? 'Tidak Ada' }}</td>
                            </tr>
                            <tr>
                              <td class="text-left align-middle font-bold">E-mail</td>

                              <td class="text-left align-middle">{{ $pengajuan->pengguna->identitas->email_perusahaan ?? 'Tidak Ada' }}</td>
                            </tr>

                            <tr>
                              <td class="text-left align-middle font-bold">Nama</td>

                              <td class="text-left align-middle">{{ $pengajuan->pengguna->identitas->contact_person_nama ?? 'Tidak Ada' }} </td>

                            </tr>
                            <tr>
                              <td class="text-left align-middle font-bold">Jabatan</td>

                              <td class="text-left align-middle"> ({{ $pengajuan->pengguna->identitas->contact_person_jabatan ?? 'Tidak Ada' }})</td>
                            </tr>
                            <tr>
                              <td class="text-left align-middle font-bold">E-mail</td>

                              <td class="text-left align-middle">{{ $pengajuan->pengguna->identitas->contact_person_email ?? 'Tidak Ada' }}</td>
                            </tr>
                            <tr>
                              <td class="text-left align-middle font-bold">No. Telp/HP</td>

                              <td class="text-left align-middle">{{ $pengajuan->pengguna->identitas->contact_person_no_telp ?? 'Tidak Ada' }}</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>

                    <!-- KOLOM 2: Evaluasi 1 -->
                    <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                      <h2 class="text-lg text-center font-bold border-b pb-2 mb-2">Evaluasi</h2>

                      <label for="catatan-perbaikan-1" class="text-sm font-semibold">Catatan Perbaikan :</label>
                      <textarea
                        id="catatan-perbaikan-1"
                        name="catatan_perbaikan_1"
                        rows="8"
                        class="w-full p-2 border rounded text-sm"
                        placeholder="Tulis catatan perbaikan..."></textarea>

                      <label for="status-permohonan-1" class="text-sm font-semibold">Status Permohonan :</label>
                      <select
                        id="status-permohonan-1"
                        name="status_permohonan_1"
                        class="w-full border p-2 rounded text-sm">
                        <option value="" disabled selected hidden>-- Status --</option>
                        <option value="Disetujui">Disetujui</option>
                        <option value="Ditolak">Ditolak</option>
                        <option value="Perbaikan">Perbaikan</option>
                      </select>

                      <!-- Tombol Simpan 1 -->
                      <!-- <div class="pt-2 mt-6">
                        <button onclick="simpanEvaluasiBagian('data_pemilik', 1)" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded w-full">
                          Simpan Evaluasi
                        </button>
                      </div> -->

                      <!-- Modal Pop-up 3 -->
                      <div id="popupBerhasil1" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
                        <div class="bg-white p-6 rounded-lg shadow-lg text-center w-80">
                          <h2 class="text-lg font-semibold text-green-700 mb-2">Berhasil!</h2>
                          <p class="text-gray-700 mb-4">Evaluasi berhasil disimpan.</p>
                          <button onclick="tutupPopup1()" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded">
                            OK
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Tombol navigasi: Keluar di kiri, Selanjutnya di kanan -->
                  <div class="mt-6 flex justify-between">
                    <!-- Tombol Keluar -->
                    <a href="{{ route('laporan.evaluator.index') }}"
                      class="inline-block px-5 py-2 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition">
                      Keluar
                    </a>

                    <!-- Tombol Selanjutnya -->
                    <button type="button" onclick="goToNextPage(0)" class="px-5 py-2 bg-blue-600 text-white rounded-lg">Selanjutnya</button>
                  </div>
                </div>

                <!-- Halaman 1: Data Umum -->
                <div id="page1" class="hidden">
                  <h2 class="text-center font-bold text-lg bg-gray-100 p-3 rounded-t border-b border-gray-300">DATA UMUM</h2>

                  <!-- Container 1: DATA UMUM | LAMPIRAN | EVALUASI -->
                  <div class="grid grid-cols-1 md:grid-cols-3 gap-4 border border-gray-200 rounded shadow-sm overflow-hidden p-4">
                    <!-- KOLOM 1: Izin Usaha Penyediaan Tenaga Listrik -->
                    <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                      <h2 class="text-lg font-bold text-center border-b pb-2 mb-2">Izin Usaha Penyediaan Tenaga Listrik</h2>
                      <div class="overflow-x-auto">
                        <table class="w-full table-auto border-collapse border border-gray-300 text-sm text-left">

                          <tbody id="body-Data Umum">
                            <tr>
                              <td class="text-left align-middle font-bold min-w-[150px] max-w-[150px] w-[150px]">Nomor</td>
                              <td class="text-left align-middle">
                                {{ $pengajuan->nomor_izin_usaha ?? 'Tidak Ada' }}
                                <input type="hidden" name="nomor" value="{{ $pengajuan->nomor_izin_usaha }}" readonly>
                              </td>
                            </tr>
                            <tr>
                              <td class="text-left align-middle font-bold">Tanggal Terbit</td>

                              <td class="text-left align-middle">
                                {{ $pengajuan->tanggal_izin_usaha 
                                                                    ? \Carbon\Carbon::parse($pengajuan->tanggal_izin_usaha)->translatedFormat('d F Y') 
                                                                    : 'Tidak Ada' 
                                                                }}
                              </td>

                            </tr>
                            <tr>
                              <td class="text-left align-middle font-bold"> Tanggal Masa Berlaku</td>

                              <td class="text-left align-middle">
                                {{ $pengajuan->masa_berlaku_izin_usaha 
                                                                    ? \Carbon\Carbon::parse($pengajuan->masa_berlaku_izin_usaha)->translatedFormat('d F Y') 
                                                                    : 'Tidak Ada' 
                                                                }}
                              </td>


                            </tr>
                            <tr>
                              <td class="text-left align-middle font-bold">Kelebihan Tenaga Lsitrik dijual Kepada</td>

                              <td class="text-left align-middle">
                                {{ $pengajuan->kelebihan_listrik ?? 'Tidak Ada' }}
                                <input type="hidden" name="nomor" value="{{ $pengajuan->kelebihan_listrik }}" readonly>
                              </td>

                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>

                    <!-- KOLOM 2: LAMPIRAN -->
                    <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                      <h2 class="text-lg text-center font-bold border-b pb-2 mb-2">Lampiran</h2>
                      <div>
                        @if($pengajuan->lampiran_izin_usaha)
                        <!-- Iframe dengan fitur zoom -->
                        <div class="w-full h-[500px] rounded overflow-hidden border">
                          <iframe
                            src="{{ route('lampiran.show', basename($pengajuan->lampiran_izin_usaha)) }}"
                            class="w-full h-full"
                            allowfullscreen>
                          </iframe>
                        </div>
                        <!-- Tombol Lihat di Tab Baru -->
                        <div class="mt-2 text-right">
                          <a href="{{ route('lampiran.show', basename($pengajuan->lampiran_izin_usaha)) }}"
                            target="_blank"
                            class="inline-block px-4 py-2 bg-blue-500 text-white text-sm rounded hover:bg-blue-600 transition">
                            Lihat di Tab Baru
                          </a>
                        </div>
                        @else
                        <p class="text-gray-500 text-center">Tidak ada lampiran</p>
                        @endif
                      </div>
                    </div>


                    <!-- KOLOM 3: Evaluasi 2 -->
                    <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                      <h2 class="text-lg text-center font-bold border-b pb-2 mb-2">Evaluasi</h2>

                      <label for="catatan-perbaikan-2" class="text-sm font-semibold">Catatan Perbaikan :</label>
                      <textarea
                        id="catatan-perbaikan-2"
                        name="catatan_perbaikan_2"
                        rows="8"
                        class="w-full p-2 border rounded text-sm"
                        placeholder="Tulis catatan perbaikan..."></textarea>

                      <label for="status-permohonan-2" class="text-sm font-semibold">Status Permohonan :</label>
                      <select
                        id="status-permohonan-2"
                        name="status_permohonan_2"
                        class="w-full border p-2 rounded text-sm">
                        <option value="" disabled selected hidden>-- Status --</option>
                        <option value="Disetujui">Disetujui</option>
                        <option value="Ditolak">Ditolak</option>
                        <option value="Perbaikan">Perbaikan</option>
                      </select>
                      <!-- Tombol Simpan 3 -->
                      <!-- <div class="pt-2 mt-6">
                        <button onclick="simpanEvaluasiBagian('izin_usaha', 2)"  class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded w-full">
                          Simpan Evaluasi
                        </button>
                      </div> -->

                      <!-- Modal Pop-up 3 -->
                      <div id="popupBerhasil2" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
                        <div class="bg-white p-6 rounded-lg shadow-lg text-center w-80">
                          <h2 class="text-lg font-semibold text-green-700 mb-2">Berhasil!</h2>
                          <p class="text-gray-700 mb-4">Evaluasi berhasil disimpan.</p>
                          <button onclick="tutupPopup2()" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded">
                            OK
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Container 2: DATA UMUM | LAMPIRAN | EVALUASI -->
                  <div class="grid grid-cols-1 md:grid-cols-3 gap-4 border border-gray-200 rounded shadow-sm overflow-hidden p-4">
                    <!-- KOLOM 1: Data Izin Lingkungan -->
                    <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                      <h2 class="text-lg font-bold text-center border-b pb-2 mb-2">Izin Lingkungan</h2>
                      <div class="overflow-x-auto">
                        <table class="w-full table-auto border-collapse border border-gray-300 text-sm text-left">

                          <tbody id="body-Data Izin Lingkungan">
                            <tr>
                              <td class="text-left align-middle font-bold min-w-[150px] max-w-[150px] w-[150px]">Jenis Izin</td>

                              <td class="text-left align-middle">
                                {{ $pengajuan->jenis_izin_lingkungan ?? 'Tidak Ada' }}
                              </td>
                            </tr>
                            <tr>
                              <td class="text-left align-middle font-bold">Nomor</td>

                              <td class="text-left align-middle">
                                {{ $pengajuan->nomor_izin_lingkungan ?? 'Tidak Ada' }}

                              </td>
                            </tr>
                            <tr>
                              <td class="text-left align-middle font-bold">Tanggal Terbit</td>

                              <td class="text-left align-middle">
                                {{ $pengajuan->tanggal_izin_lingkungan
                                                                    ? \Carbon\Carbon::parse($pengajuan->tanggal_izin_lingkungan)->translatedFormat('d F Y') 
                                                                    : 'Tidak Ada' 
                                                                }}
                              </td>
                            </tr>
                            <tr>
                              <td class="text-left align-middle font-bold">Tanggal Masa Berlaku</td>

                              <td class="text-left align-middle">
                                {{ $pengajuan->masa_berlaku_izin_lingkungan
                                                                    ? \Carbon\Carbon::parse($pengajuan->masa_berlaku_izin_lingkungan)->translatedFormat('d F Y') 
                                                                    : 'Tidak Ada' 
                                                                }}
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>

                    <!-- KOLOM 2: LAMPIRAN -->
                    <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                      <h2 class="text-lg text-center font-bold border-b pb-2 mb-2">Lampiran</h2>
                      <div>
                        @if($pengajuan->lampiran_izin_lingkungan)
                        <!-- Iframe dengan fitur zoom -->
                        <div class="w-full h-[500px] rounded overflow-hidden border">
                          <iframe
                            src="{{ route('lampiran.show', basename($pengajuan->lampiran_izin_lingkungan)) }}"
                            class="w-full h-full"
                            allowfullscreen>
                          </iframe>
                        </div>
                        <!-- Tombol Lihat di Tab Baru -->
                        <div class="mt-2 text-right">
                          <a href="{{ route('lampiran.show', basename($pengajuan->lampiran_izin_lingkungan)) }}"
                            target="_blank"
                            class="inline-block px-4 py-2 bg-blue-500 text-white text-sm rounded hover:bg-blue-600 transition">
                            Lihat di Tab Baru
                          </a>
                        </div>
                        @else
                        <p class="text-gray-500 text-center">Tidak ada lampiran</p>
                        @endif
                      </div>
                    </div>

                    <!-- KOLOM 3: Evaluasi 3 -->
                    <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                      <h2 class="text-lg text-center font-bold border-b pb-2 mb-2">Evaluasi</h2>

                      <label for="catatan-perbaikan-3" class="text-sm font-semibold">Catatan Perbaikan :</label>
                      <textarea
                        id="catatan-perbaikan-3"
                        name="catatan_perbaikan_3"
                        rows="8"
                        class="w-full p-2 border rounded text-sm"
                        placeholder="Tulis catatan perbaikan..."></textarea>

                      <label for="status-permohonan-3" class="text-sm font-semibold">Status Permohonan :</label>
                      <select
                        id="status-permohonan-3"
                        name="status_permohonan_3"
                        class="w-full border p-2 rounded text-sm">
                        <option value="" disabled selected hidden>-- Status --</option>
                        <option value="Disetujui">Disetujui</option>
                        <option value="Ditolak">Ditolak</option>
                        <option value="Perbaikan">Perbaikan</option>
                      </select>
                      <!-- Tombol Simpan 3 -->
                      <!-- <div class="pt-2 mt-6">
                        <button onclick="simpanEvaluasiBagian('izin_lingkungan', 3)" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded w-full">
                          Simpan Evaluasi
                        </button>
                      </div> -->

                      <!-- Modal Pop-up 3 -->
                      <div id="popupBerhasil3" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
                        <div class="bg-white p-6 rounded-lg shadow-lg text-center w-80">
                          <h2 class="text-lg font-semibold text-green-700 mb-2">Berhasil!</h2>
                          <p class="text-gray-700 mb-4">Evaluasi berhasil disimpan.</p>
                          <button onclick="tutupPopup3()" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded">
                            OK
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Container 3: DATA UMUM | LAMPIRAN | EVALUASI -->
                  <div class="grid grid-cols-1 md:grid-cols-3 gap-4 border border-gray-200 rounded shadow-sm overflow-hidden p-4">
                    <!-- KOLOM 1: SLO -->
                    <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                      <h2 class="text-lg font-bold text-center border-b pb-2 mb-2">Sertifikat Laik Operasi (SLO)</h2>
                      <div class="overflow-x-auto">
                        @php
                        $listSlo = is_array($pengajuan->slo) ? $pengajuan->slo : [];
                        @endphp

                        <table class="w-full table-auto border-collapse border border-gray-300 text-sm">

                          <thead class="bg-gray-100">
                            <tr id="header-SLO">
                              {{-- Kolom pertama (judul data) selalu rata kiri --}}
                              <th class="border px-2 py-1 text-left w-[150px]"></th>

                              {{-- Kolom berikutnya (#1, #2, dst) rata tengah --}}
                              @foreach($listSlo as $i => $item)
                              <th class="border px-2 py-1 text-center">SLO - {{ $loop->iteration }}</th>
                              @endforeach
                            </tr>
                          </thead>

                          <tbody id="body-SLO">
                            <tr>
                              <td class="font-bold border text-left px-2 py-1">Nomor Sertifikat</td>
                              @foreach($listSlo as $item)
                              <td class="border px-2 py-1 text-left">
                                {{ $item['nomor_sertifikat_slo'] ?? 'Tidak ada' }}
                                <input type="hidden" name="nomor_sertifikat_slo[]" value="{{ $item['nomor_sertifikat_slo'] ?? '' }}">
                              </td>
                              @endforeach
                            </tr>

                            <tr>
                              <td class="font-bold border text-left px-2 py-1">Nomor Register</td>
                              @foreach($listSlo as $item)
                              <td class="border px-2 py-1 text-left">
                                {{ $item['nomor_register_slo'] ?? 'Tidak ada' }}
                                <input type="hidden" name="nomor_register_slo[]" value="{{ $item['nomor_register_slo'] ?? '' }}">
                              </td>
                              @endforeach
                            </tr>

                            <tr>
                              <td class="font-bold border text-left px-2 py-1">Tanggal Terbit</td>
                              @foreach($listSlo as $item)
                              <td class="border px-2 py-1 text-left">
                                {{ !empty($item['tanggal_terbit_slo'])
                                                                    ? \Carbon\Carbon::parse($item['tanggal_terbit_slo'])->translatedFormat('d F Y')
                                                                    : '-' }}
                                <input type="hidden" name="tanggal_terbit_slo[]" value="{{ $item['tanggal_terbit_slo'] ?? '' }}">
                              </td>
                              @endforeach
                            </tr>

                            <tr>
                              <td class="font-bold border text-left px-2 py-1">Tanggal Masa Berlaku</td>
                              @foreach($listSlo as $item)
                              <td class="border px-2 py-1 text-left">
                                {{ !empty($item['tanggal_masa_berlaku_slo'])
                                                                    ? \Carbon\Carbon::parse($item['tanggal_masa_berlaku_slo'])->translatedFormat('d F Y')
                                                                    : '-' }}
                                <input type="hidden" name="tanggal_masa_berlaku_slo[]" value="{{ $item['tanggal_masa_berlaku_slo'] ?? '' }}">
                              </td>
                              @endforeach
                            </tr>

                            <tr>
                              <td class="font-bold border text-left px-2 py-1">Lembaga Inspeksi Teknik (LIT)</td>
                              @foreach($listSlo as $item)
                              <td class="border px-2 py-1 text-left">
                                {{ $item['lit'] ?? 'Tidak ada' }}
                                <input type="hidden" name="lit[]" value="{{ $item['lit'] ?? '' }}">
                              </td>
                              @endforeach
                            </tr>
                          </tbody>
                        </table>

                      </div>
                    </div>

                    <!-- KOLOM 2: LAMPIRAN -->
                    <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                      <h2 class="text-lg text-center font-bold border-b pb-2 mb-2">Lampiran</h2>
                      <div>
                        @if($pengajuan->lampiran_slo)
                        <!-- Iframe dengan fitur zoom -->
                        <div class="w-full h-[500px] rounded overflow-hidden border">
                          <iframe
                            src="{{ route('lampiran.show', basename($pengajuan->lampiran_slo)) }}"
                            class="w-full h-full"
                            allowfullscreen>
                          </iframe>
                        </div>
                        <!-- Tombol Lihat di Tab Baru -->
                        <div class="mt-2 text-right">
                          <a href="{{ route('lampiran.show', basename($pengajuan->lampiran_slo)) }}"
                            target="_blank"
                            class="inline-block px-4 py-2 bg-blue-500 text-white text-sm rounded hover:bg-blue-600 transition">
                            Lihat di Tab Baru
                          </a>
                        </div>
                        @else
                        <p class="text-gray-500 text-center">Tidak ada lampiran</p>
                        @endif
                      </div>
                    </div>


                    <!-- KOLOM 3: Evaluasi 4 -->
                    <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                      <h2 class="text-lg text-center font-bold border-b pb-2 mb-2">Evaluasi</h2>

                      <label for="catatan-perbaikan-4" class="text-sm font-semibold">Catatan Perbaikan :</label>
                      <textarea
                        id="catatan-perbaikan-4"
                        name="catatan_perbaikan_4"
                        rows="8"
                        class="w-full p-2 border rounded text-sm"
                        placeholder="Tulis catatan perbaikan..."></textarea>

                      <label for="status-permohonan-4" class="text-sm font-semibold">Status Permohonan :</label>
                      <select
                        id="status-permohonan-4"
                        name="status_permohonan_4"
                        class="w-full border p-4 rounded text-sm">
                        <option value="" disabled selected hidden>-- Status --</option>
                        <option value="Disetujui">Disetujui</option>
                        <option value="Ditolak">Ditolak</option>
                        <option value="Perbaikan">Perbaikan</option>
                      </select>
                      <!-- Tombol Simpan 3 -->
                      <!-- <div class="pt-2 mt-6">
                        <button onclick="simpanEvaluasiBagian('slo', 4)" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded w-full">
                          Simpan Evaluasi
                        </button>
                      </div> -->

                      <!-- Modal Pop-up 3 -->
                      <div id="popupBerhasil4" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
                        <div class="bg-white p-6 rounded-lg shadow-lg text-center w-80">
                          <h2 class="text-lg font-semibold text-green-700 mb-2">Berhasil!</h2>
                          <p class="text-gray-700 mb-4">Evaluasi berhasil disimpan.</p>
                          <button onclick="tutupPopup4()" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded">
                            OK
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Container 4: DATA UMUM | LAMPIRAN | EVALUASI -->
                  <div class="grid grid-cols-1 md:grid-cols-3 gap-4 border border-gray-200 rounded shadow-sm overflow-hidden p-4">
                    <!-- KOLOM 1: SLO -->
                    <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                      <h2 class="text-lg font-bold text-center border-b pb-2 mb-2">
                        Sertifikat Kompetensi Tenaga Teknik Ketenagalistrikan (SKTTK)
                      </h2>

                      <div class="overflow-x-auto">
                        @php
                        $listSkttk = is_array($pengajuan->skttk) ? $pengajuan->skttk : [];
                        @endphp

                        <table class="w-full table-auto border-collapse border border-gray-300 text-sm">
                          <thead class="bg-gray-100">
                            <tr id="header-SKTTK">
                              {{-- Kolom pertama judul data rata kiri --}}
                              <th class="border px-2 py-1 text-left w-[150px]"></th>

                              {{-- Kolom berikutnya (#1, #2, dst) rata tengah --}}
                              @foreach($listSkttk as $i => $item)
                              <th class="border px-2 py-1 text-center">SKTTK - {{ $loop->iteration }}</th>
                              @endforeach
                            </tr>
                          </thead>

                          <tbody id="body-SKTTK">
                            <tr>
                              <td class="font-bold border text-left px-2 py-1">Nomor Sertifikat</td>
                              @foreach($listSkttk as $item)
                              <td class="border px-2 py-1 text-left">
                                {{ $item['nomor_sertifikat_skttk'] ?? 'Tidak ada' }}
                                <input type="hidden" name="nomor_sertifikat_skttk[]" value="{{ $item['nomor_sertifikat_skttk'] ?? '' }}">
                              </td>
                              @endforeach
                            </tr>

                            <tr>
                              <td class="font-bold border text-left px-2 py-1">Nomor Register</td>
                              @foreach($listSkttk as $item)
                              <td class="border px-2 py-1 text-left">
                                {{ $item['nomor_register_skttk'] ?? 'Tidak ada' }}
                                <input type="hidden" name="nomor_register_skttk[]" value="{{ $item['nomor_register_skttk'] ?? '' }}">
                              </td>
                              @endforeach
                            </tr>

                            <tr>
                              <td class="font-bold border text-left px-2 py-1">Nama</td>
                              @foreach($listSkttk as $item)
                              <td class="border px-2 py-1 text-left">
                                {{ $item['nama_skttk'] ?? 'Tidak ada' }}
                                <input type="hidden" name="nama_skttk[]" value="{{ $item['nama_skttk'] ?? '' }}">
                              </td>
                              @endforeach
                            </tr>

                            <tr>
                              <td class="font-bold border text-left px-2 py-1">Jabatan</td>
                              @foreach($listSkttk as $item)
                              <td class="border px-2 py-1 text-left">
                                {{ $item['jabatan_skttk'] ?? 'Tidak ada' }}
                                <input type="hidden" name="jabatan_skttk[]" value="{{ $item['jabatan_skttk'] ?? '' }}">
                              </td>
                              @endforeach
                            </tr>

                            <tr>
                              <td class="font-bold border text-left px-2 py-1">Kode Kualifikasi</td>
                              @foreach($listSkttk as $item)
                              <td class="border px-2 py-1 text-left">
                                {{ $item['kode_kualifikasi_skttk'] ?? 'Tidak ada' }}
                                <input type="hidden" name="kode_kualifikasi_skttk[]" value="{{ $item['kode_kualifikasi_skttk'] ?? '' }}">
                              </td>
                              @endforeach
                            </tr>

                            <tr>
                              <td class="font-bold border text-left px-2 py-1">Kompetensi Inti 1</td>
                              @foreach($listSkttk as $item)
                              <td class="border px-2 py-1 text-left">
                                {{ $item['kompetensi_inti1_skttk'] ?? 'Tidak ada' }}
                                <input type="hidden" name="kompetensi_inti1_skttk[]" value="{{ $item['kompetensi_inti1_skttk'] ?? '' }}">
                              </td>
                              @endforeach
                            </tr>

                            <tr>
                              <td class="font-bold border text-left px-2 py-1">Kompetensi Inti 2</td>
                              @foreach($listSkttk as $item)
                              <td class="border px-2 py-1 text-left">
                                {{ $item['kompetensi_inti2_skttk'] ?? 'Tidak ada' }}
                                <input type="hidden" name="kompetensi_inti2_skttk[]" value="{{ $item['kompetensi_inti2_skttk'] ?? '' }}">
                              </td>
                              @endforeach
                            </tr>

                            <tr>
                              <td class="font-bold border text-left px-2 py-1">Kompetensi Pilihan 1</td>
                              @foreach($listSkttk as $item)
                              <td class="border px-2 py-1 text-left">
                                {{ $item['kompetensi_pilihan1_skttk'] ?? 'Tidak ada' }}
                                <input type="hidden" name="kompetensi_pilihan1_skttk[]" value="{{ $item['kompetensi_pilihan1_skttk'] ?? '' }}">
                              </td>
                              @endforeach
                            </tr>

                            <tr>
                              <td class="font-bold border text-left px-2 py-1">Kompetensi Pilihan 2</td>
                              @foreach($listSkttk as $item)
                              <td class="border px-2 py-1 text-left">
                                {{ $item['kompetensi_pilihan2_skttk'] ?? 'Tidak ada' }}
                                <input type="hidden" name="kompetensi_pilihan2_skttk[]" value="{{ $item['kompetensi_pilihan2_skttk'] ?? '' }}">
                              </td>
                              @endforeach
                            </tr>

                            <tr>
                              <td class="font-bold border text-left px-2 py-1">Tanggal Terbit</td>
                              @foreach($listSkttk as $item)
                              <td class="border px-2 py-1 text-left">
                                {{ !empty($item['tanggal_terbit_skttk'])
                                ? \Carbon\Carbon::parse($item['tanggal_terbit_skttk'])->translatedFormat('d F Y')
                                : '-' }}
                                <input type="hidden" name="tanggal_terbit_skttk[]" value="{{ $item['tanggal_terbit_skttk'] ?? '' }}">
                              </td>
                              @endforeach
                            </tr>

                            <tr>
                              <td class="font-bold border text-left px-2 py-1">Tanggal Masa Berlaku</td>
                              @foreach($listSkttk as $item)
                              <td class="border px-2 py-1 text-left">
                                {{ !empty($item['tanggal_masa_berlaku_skttk'])
                                ? \Carbon\Carbon::parse($item['tanggal_masa_berlaku_skttk'])->translatedFormat('d F Y')
                                : '-' }}
                                <input type="hidden" name="tanggal_masa_berlaku_skttk[]" value="{{ $item['tanggal_masa_berlaku_skttk'] ?? '' }}">
                              </td>
                              @endforeach
                            </tr>

                            <tr>
                              <td class="font-bold border text-left px-2 py-1">LSK</td>
                              @foreach($listSkttk as $item)
                              <td class="border px-2 py-1 text-left">
                                {{ $item['lsk_skttk'] ?? 'Tidak ada' }}
                                <input type="hidden" name="lsk_skttk[]" value="{{ $item['lsk_skttk'] ?? '' }}">
                              </td>
                              @endforeach
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>


                    <!-- KOLOM 2: LAMPIRAN -->
                    <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                      <h2 class="text-lg text-center font-bold border-b pb-2 mb-2">Lampiran</h2>
                      <div>
                        @if($pengajuan->lampiran_skttk)
                        <!-- Iframe dengan fitur zoom -->
                        <div class="w-full h-[500px] rounded overflow-hidden border">
                          <iframe
                            src="{{ route('lampiran.show', basename($pengajuan->lampiran_skttk)) }}"
                            class="w-full h-full"
                            allowfullscreen>
                          </iframe>
                        </div>
                        <!-- Tombol Lihat di Tab Baru -->
                        <div class="mt-2 text-right">
                          <a href="{{ route('lampiran.show', basename($pengajuan->lampiran_skttk)) }}"
                            target="_blank"
                            class="inline-block px-4 py-2 bg-blue-500 text-white text-sm rounded hover:bg-blue-600 transition">
                            Lihat di Tab Baru
                          </a>
                        </div>
                        @else
                        <p class="text-gray-500 text-center">Tidak ada lampiran</p>
                        @endif
                      </div>
                    </div>

                    <!-- KOLOM 3: Evaluasi 5-->
                    <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                      <h2 class="text-lg text-center font-bold border-b pb-2 mb-2">Evaluasi</h2>

                      <label for="catatan-perbaikan-5" class="text-sm font-semibold">Catatan Perbaikan :</label>
                      <textarea
                        id="catatan-perbaikan-5"
                        name="catatan_perbaikan_5"
                        rows="8"
                        class="w-full p-2 border rounded text-sm"
                        placeholder="Tulis catatan perbaikan..."></textarea>

                      <label for="status-permohonan-5" class="text-sm font-semibold">Status Permohonan :</label>
                      <select
                        id="status-permohonan-5"
                        name="status_permohonan_5"
                        class="w-full border p-2 rounded text-sm">
                        <option value="" disabled selected hidden>-- Status --</option>
                        <option value="Disetujui">Disetujui</option>
                        <option value="Ditolak">Ditolak</option>
                        <option value="Perbaikan">Perbaikan</option>
                      </select>
                      <!-- Tombol Simpan 5 -->
                      <!-- <div class="pt-2 mt-6">
                        <button onclick="simpanEvaluasiBagian('skttk', 5)" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded w-full">
                          Simpan Evaluasi
                        </button>
                      </div> -->

                      <!-- Modal Pop-up 5 -->
                      <div id="popupBerhasil5" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
                        <div class="bg-white p-6 rounded-lg shadow-lg text-center w-80">
                          <h2 class="text-lg font-semibold text-green-700 mb-2">Berhasil!</h2>
                          <p class="text-gray-700 mb-4">Evaluasi berhasil disimpan.</p>
                          <button onclick="tutupPopup5()" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded">
                            OK
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>


                  <div class="mt-6 flex justify-between">
                    <button onclick="goToPrevPage(1)" type="button" class="inline-block px-5 py-2 bg-green-400 text-white font-semibold rounded-lg hover:bg-green-500 transition">
                      Kembali
                    </button>
                    <button type="button" onclick="goToNextPage(1)" class="inline-block px-5 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                      Selanjutnya
                    </button>
                  </div>
                </div>

                <!-- Halaman 2: Data Instalasi -->
                <div id="page2" class="hidden">
                  <h2 class="text-center font-bold text-lg bg-gray-100 p-3 rounded-t border-b border-gray-300">DATA INSTALASI PENYEDIAAN TENAGA LISTRIK</h2>
                  <!-- Container 1: DATA INSTALASI | LAMPIRAN | EVALUASI -->
                  <div class="grid grid-cols-1 md:grid-cols-3 gap-4 border border-gray-200 rounded shadow-sm overflow-hidden p-4">
                    <!-- KOLOM 1: DATA INSTALASI -->
                    <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                      <h2 class="text-lg font-bold text-center border-b pb-2 mb-2">Data Mesin</h2>
                      <div class="overflow-x-auto">
                        @php
                        $mesinData = $pengajuan->mesin ?? [];


                        @endphp

                        <table class="w-full table-auto border-collapse border border-gray-300 text-sm">
                          <thead class="bg-gray-100">
                            <tr>
                              <th class="border px-2 py-1 text-left w-[150px]">Data Mesin</th>
                              @foreach($mesinData as $i => $item)
                              <th class="border px-2 py-1 text-center">Unit - {{ $loop->iteration }}</th>
                              @endforeach
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td class="font-bold border px-2 py-1 text-left">Jenis Penggerak</td>
                              @foreach($mesinData as $item)
                              <td class="border px-2 py-1 text-left">{{ $item['jenis_penggerak'] ?? 'Tidak ada' }}</td>
                              @endforeach
                            </tr>
                            <tr>
                              <td class="font-bold border px-2 py-1 text-left">Jenis Pembangkit</td>
                              @foreach($mesinData as $item)
                              <td class="border px-2 py-1 text-left">{{ $item['jenis_pembangkit'] ?? 'Tidak ada' }}</td>
                              @endforeach
                            </tr>
                            <tr>
                              <td class="font-bold border px-2 py-1 text-left">Energi Primer</td>
                              @foreach($mesinData as $item)
                              <td class="border px-2 py-1 text-left">{{ $item['energi_primer'] ?? 'Tidak ada' }}</td>
                              @endforeach
                            </tr>
                            <tr>
                              <td class="font-bold border px-2 py-1 text-left">Merk & Tipe Mesin</td>
                              @foreach($mesinData as $item)
                              <td class="border px-2 py-1 text-left">{{ $item['mesin_merk_tipe'] ?? 'Tidak ada' }}</td>
                              @endforeach
                            </tr>
                            <tr>
                              <td class="font-bold border px-2 py-1 text-left">Pabrikan</td>
                              @foreach($mesinData as $item)
                              <td class="border px-2 py-1 text-left">{{ $item['mesin_pabrikan'] ?? 'Tidak ada' }}</td>
                              @endforeach
                            </tr>
                            <tr>
                              <td class="font-bold border px-2 py-1 text-left">Kapasitas</td>
                              @foreach($mesinData as $item)
                              <td class="border px-2 py-1 text-left">{{ $item['mesin_kapasitas'] ?? 'Tidak ada' }}</td>
                              @endforeach
                            </tr>
                            <tr>
                              <td class="font-bold border px-2 py-1 text-left">Putaran</td>
                              @foreach($mesinData as $item)
                              <td class="border px-2 py-1 text-left">{{ $item['mesin_putaran'] ?? 'Tidak ada' }}</td>
                              @endforeach
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>

                    <!-- KOLOM 2: LAMPIRAN -->
                    <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                      <h2 class="text-lg text-center font-bold border-b pb-2 mb-2">Lampiran</h2>
                      <div>
                        @if($pengajuan->lampiran_nameplate_mesin)
                        <!-- Iframe dengan fitur zoom -->
                        <div class="w-full h-[500px] rounded overflow-hidden border">
                          <iframe
                            src="{{ route('lampiran.show', basename($pengajuan->lampiran_nameplate_mesin)) }}"
                            class="w-full h-full"
                            allowfullscreen>
                          </iframe>
                        </div>
                        <!-- Tombol Lihat di Tab Baru -->
                        <div class="mt-2 text-right">
                          <a href="{{ route('lampiran.show', basename($pengajuan->lampiran_nameplate_mesin)) }}"
                            target="_blank"
                            class="inline-block px-4 py-2 bg-blue-500 text-white text-sm rounded hover:bg-blue-600 transition">
                            Lihat di Tab Baru
                          </a>
                        </div>
                        @else
                        <p class="text-gray-500 text-center">Tidak ada lampiran</p>
                        @endif
                      </div>
                    </div>

                    <!-- KOLOM 3: EVALUASI 6 -->
                    <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                      <h2 class="text-lg text-center font-bold border-b pb-2 mb-2">Evaluasi</h2>

                      <label for="catatan-perbaikan-6" class="text-sm font-semibold">Catatan Perbaikan :</label>
                      <textarea
                        id="catatan-perbaikan-6"
                        name="catatan_perbaikan_6"
                        rows="8"
                        class="w-full p-2 border rounded text-sm"
                        placeholder="Tulis catatan perbaikan..."></textarea>

                      <label for="status-permohonan-6" class="text-sm font-semibold">Status Permohonan :</label>
                      <select
                        id="status-permohonan-6"
                        name="status_permohonan_6"
                        class="w-full border p-2 rounded text-sm">
                        <option value="" disabled selected hidden>-- Status --</option>
                        <option value="Disetujui">Disetujui</option>
                        <option value="Ditolak">Ditolak</option>
                        <option value="Perbaikan">Perbaikan</option>
                      </select>
                      <!-- Tombol Simpan 1 -->
                      <!-- <div class="pt-2">
                        <button onclick="simpanEvaluasiBagian('data_mesin', 6)" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded w-full">
                          Simpan Evaluasi
                        </button>
                      </div> -->

                      <!-- Modal Pop-up 1 -->
                      <div id="popupBerhasil6" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
                        <div class="bg-white p-6 rounded-lg shadow-lg text-center w-80">
                          <h2 class="text-lg font-semibold text-green-700 mb-2">Berhasil!</h2>
                          <p class="text-gray-700 mb-4">Evaluasi berhasil disimpan.</p>
                          <button onclick="tutupPopup6()" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded">
                            OK
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="mt-6 text-left">

                  </div>

                  <!-- Container 2: DATA GENERATOR | LAMPIRAN | EVALUASI -->
                  <div class="grid grid-cols-1 md:grid-cols-3 gap-4 border border-gray-200 rounded shadow-sm overflow-hidden p-4">
                    <!-- KOLOM 1: DATA GENERATOR -->
                    <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                      <h2 class="text-lg font-bold text-center border-b pb-2 mb-2">Data Generator</h2>
                      <div class="overflow-x-auto">
                        @php
                        $generatorData = $pengajuan->generator ?? [];


                        @endphp

                        <table class="w-full table-auto border-collapse border border-gray-300 text-sm">
                          <thead class="bg-gray-100">
                            <tr>
                              <th class="border px-2 py-1 text-left w-[150px]"></th>
                              @foreach($generatorData as $i => $item)
                              <th class="border px-2 py-1 text-center">Unit - {{ $loop->iteration }}</th>
                              @endforeach
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td class="font-bold border px-2 py-1 text-left">Merk & Tipe</td>
                              @foreach($generatorData as $item)
                              <td class="border px-2 py-1 text-left">{{ $item['generator_merk_tipe'] ?? 'Tidak ada' }}</td>
                              @endforeach
                            </tr>
                            <tr>
                              <td class="font-bold border px-2 py-1 text-left">Pabrikan</td>
                              @foreach($generatorData as $item)
                              <td class="border px-2 py-1 text-left">{{ $item['generator_pabrikan'] ?? 'Tidak ada' }}</td>
                              @endforeach
                            </tr>
                            <tr>
                              <td class="font-bold border px-2 py-1 text-left">Kapasitas</td>
                              @foreach($generatorData as $item)
                              <td class="border px-2 py-1 text-left">{{ $item['generator_kapasitas'] ?? 'Tidak ada' }}</td>
                              @endforeach
                            </tr>
                            <tr>
                              <td class="font-bold border px-2 py-1 text-left">Tegangan</td>
                              @foreach($generatorData as $item)
                              <td class="border px-2 py-1 text-left">{{ $item['generator_tegangan'] ?? 'Tidak ada' }}</td>
                              @endforeach
                            </tr>
                            <tr>
                              <td class="font-bold border px-2 py-1 text-left">Arus</td>
                              @foreach($generatorData as $item)
                              <td class="border px-2 py-1 text-left">{{ $item['generator_arus'] ?? 'Tidak ada' }}</td>
                              @endforeach
                            </tr>
                            <tr>
                              <td class="font-bold border px-2 py-1 text-left">Faktor Daya</td>
                              @foreach($generatorData as $item)
                              <td class="border px-2 py-1 text-left">{{ $item['generator_faktor_daya'] ?? 'Tidak ada' }}</td>
                              @endforeach
                            </tr>
                            <tr>
                              <td class="font-bold border px-2 py-1 text-left">Fasa</td>
                              @foreach($generatorData as $item)
                              <td class="border px-2 py-1 text-left">{{ $item['generator_fasa'] ?? 'Tidak ada' }}</td>
                              @endforeach
                            </tr>
                            <tr>
                              <td class="font-bold border px-2 py-1 text-left">Frekuensi</td>
                              @foreach($generatorData as $item)
                              <td class="border px-2 py-1 text-left">{{ $item['generator_frekuensi'] ?? 'Tidak ada' }}</td>
                              @endforeach
                            </tr>
                            <tr>
                              <td class="font-bold border px-2 py-1 text-left">Putaran</td>
                              @foreach($generatorData as $item)
                              <td class="border px-2 py-1 text-left">{{ $item['generator_putaran'] ?? 'Tidak ada' }}</td>
                              @endforeach
                            </tr>
                            <tr>
                              <td class="font-bold border px-2 py-1 text-left">Lokasi</td>
                              @foreach($generatorData as $item)
                              <td class="border px-2 py-1 text-left">{{ $item['generator_lokasi'] ?? 'Tidak ada' }}</td>
                              @endforeach
                            </tr>
                            <tr>
                              <td class="font-bold border px-2 py-1 text-left">Koordinat</td>
                              @foreach($generatorData as $item)
                              <td class="border px-2 py-1 text-left">
                                {{ $item['generator_latitude'] ?? 'Tidak ada' }}, {{ $item['generator_longitude'] ?? 'Tidak ada' }}
                              </td>
                              @endforeach
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>

                    <!-- KOLOM 2: LAMPIRAN -->
                    <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                      <h2 class="text-lg text-center font-bold border-b pb-2 mb-2">Lampiran</h2>
                      <div>
                        @if($pengajuan->lampiran_nameplate_generator)
                        <!-- Iframe dengan fitur zoom -->
                        <div class="w-full h-[500px] rounded overflow-hidden border">
                          <iframe
                            src="{{ route('lampiran.show', basename($pengajuan->lampiran_nameplate_generator)) }}"
                            class="w-full h-full"
                            allowfullscreen>
                          </iframe>
                        </div>
                        <!-- Tombol Lihat di Tab Baru -->
                        <div class="mt-2 text-right">
                          <a href="{{ route('lampiran.show', basename($pengajuan->lampiran_nameplate_generator)) }}"
                            target="_blank"
                            class="inline-block px-4 py-2 bg-blue-500 text-white text-sm rounded hover:bg-blue-600 transition">
                            Lihat di Tab Baru
                          </a>
                        </div>
                        @else
                        <p class="text-gray-500 text-center">Tidak ada lampiran</p>
                        @endif
                      </div>
                    </div>


                    <!-- KOLOM 3: Evaluasi 7 -->
                    <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                      <h2 class="text-lg text-center font-bold border-b pb-2 mb-2">Evaluasi</h2>

                      <label for="catatan-perbaikan-7" class="text-sm font-semibold">Catatan Perbaikan :</label>
                      <textarea
                        id="catatan-perbaikan-7"
                        name="catatan_perbaikan_7"
                        rows="8"
                        class="w-full p-2 border rounded text-sm"
                        placeholder="Tulis catatan perbaikan..."></textarea>

                      <label for="status-permohonan-7" class="text-sm font-semibold">Status Permohonan :</label>
                      <select
                        id="status-permohonan-7"
                        name="status_permohonan_7"
                        class="w-full border p-2 rounded text-sm">
                        <option value="" disabled selected hidden>-- Status --</option>
                        <option value="Disetujui">Disetujui</option>
                        <option value="Ditolak">Ditolak</option>
                        <option value="Perbaikan">Perbaikan</option>
                      </select>
                      <!-- Tombol Simpan 2 -->
                      <!-- <div class="pt-2 mt-6">
                        <button onclick="simpanEvaluasiBagian('data_generator', 7)" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded w-full">
                          Simpan Evaluasi
                        </button>
                      </div> -->

                      <!-- Modal Pop-up 2 -->
                      <div id="popupBerhasil7" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
                        <div class="bg-white p-6 rounded-lg shadow-lg text-center w-80">
                          <h2 class="text-lg font-semibold text-green-700 mb-2">Berhasil!</h2>
                          <p class="text-gray-700 mb-4">Evaluasi berhasil disimpan.</p>
                          <button onclick="tutupPopup7()" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded">
                            OK
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Container 3: SAMBUNGAN LISTRIK DARI PIHAK LAIN | LAMPIRAN | EVALUASI -->
                  <div class="grid grid-cols-1 md:grid-cols-3 gap-4 border border-gray-200 rounded shadow-sm overflow-hidden p-4">
                    <!-- KOLOM 1: SAMBUNGAN LISTRIK DARI PIHAK LAIN -->
                    @php
                    $jaringan = $pengajuan->distribusi['jaringan_distribusi'] ?? [];
                    $trafo = $pengajuan->distribusi['trafo'] ?? [];
                    @endphp

                    <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">

                      {{-- Jaringan Distribusi --}}
                      <div class="bg-white rounded shadow p-4 mb-6 border-2 border-gray-300">
                        <h2 class="text-lg font-bold text-center border-b pb-2 mb-2">Data Jaringan Distribusi</h2>
                        <div class="overflow-x-auto">
                          <table class="w-full table-auto border-collapse border border-gray-300 text-sm">
                            <thead class="bg-gray-100">
                              <tr>
                                <th class="border px-2 py-1 text-left w-[150px]"></th>
                                @forelse($jaringan as $i => $item)
                                <th class="border px-2 py-1 text-center">{{ $loop->iteration }}</th>
                                @empty
                                <th class="border px-2 py-1 text-center">Tidak ada</th>
                                @endforelse
                              </tr>
                            </thead>
                            <tbody class="text-left">
                              <tr>
                                <td class="font-bold border px-2 py-1 text-left">Pemilik Instalasi</td>
                                @forelse($jaringan as $item)
                                <td class="border px-2 py-1 text-left">{{ $item['pemilik_instalasi_distribusi'] ?? 'Tidak ada' }}</td>
                                @empty
                                <td class="border px-2 py-1 text-left">Tidak ada</td>
                                @endforelse
                              </tr>
                              <tr>
                                <td class="font-bold border px-2 py-1 text-left">Tegangan</td>
                                @forelse($jaringan as $item)
                                <td class="border px-2 py-1 text-left">{{ $item['tegangan_distribusi'] ?? 'Tidak ada' }}</td>
                                @empty
                                <td class="border px-2 py-1 text-left">Tidak ada</td>
                                @endforelse
                              </tr>
                              <tr>
                                <td class="font-bold border px-2 py-1 text-left">Kapasitas / Panjang</td>
                                @forelse($jaringan as $item)
                                <td class="border px-2 py-1 text-left">{{ $item['kapasitas_panjang_distribusi'] ?? 'Tidak ada' }}</td>
                                @empty
                                <td class="border px-2 py-1 text-left">Tidak ada</td>
                                @endforelse
                              </tr>
                              <tr>
                                <td class="font-bold border px-2 py-1 text-left">Kabupaten / Kota</td>
                                @forelse($jaringan as $item)
                                <td class="border px-2 py-1 text-left">{{ $item['kabupaten_kota_distribusi'] ?? 'Tidak ada' }}</td>
                                @empty
                                <td class="border px-2 py-1 text-left">Tidak ada</td>
                                @endforelse
                              </tr>
                              <tr>
                                <td class="font-bold border px-2 py-1 text-left">Provinsi</td>
                                @forelse($jaringan as $item)
                                <td class="border px-2 py-1 text-left">{{ $item['provinsi_distribusi'] ?? 'Tidak ada' }}</td>
                                @empty
                                <td class="border px-2 py-1 text-left">Tidak ada</td>
                                @endforelse
                              </tr>
                              <tr>
                                <td class="font-bold border px-2 py-1 text-left">Latitude</td>
                                @forelse($jaringan as $item)
                                <td class="border px-2 py-1 text-left">{{ $item['latitude_distribusi'] ?? 'Tidak ada' }}</td>
                                @empty
                                <td class="border px-2 py-1 text-left">Tidak ada</td>
                                @endforelse
                              </tr>
                              <tr>
                                <td class="font-bold border px-2 py-1 text-left">Longitude</td>
                                @forelse($jaringan as $item)
                                <td class="border px-2 py-1 text-left">{{ $item['longitude_distribusi'] ?? 'Tidak ada' }}</td>
                                @empty
                                <td class="border px-2 py-1 text-left">Tidak ada</td>
                                @endforelse
                              </tr>
                              <tr>
                                <td class="font-bold border px-2 py-1 text-left">Tahun Operasi</td>
                                @forelse($jaringan as $item)
                                <td class="border px-2 py-1 text-left">{{ $item['tahun_operasi_distribusi'] ?? 'Tidak ada' }}</td>
                                @empty
                                <td class="border px-2 py-1 text-left">Tidak ada</td>
                                @endforelse
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>


                      {{-- Data Trafo --}}
                      <div class="bg-white rounded shadow p-4 mb-6 border-2 border-gray-300">
                        <h2 class="text-lg font-bold text-center border-b pb-2 mb-2">Data Trafo</h2>
                        <div class="overflow-x-auto">
                          <table class="w-full table-auto border-collapse border border-gray-300 text-sm">
                            <tbody class="text-left">
                              <tr>
                                <td class="font-bold border px-2 py-1 text-left w-[150px]">Pemilik Trafo</td>
                                <td class="border px-2 py-1 text-left">{{ $trafo['pemilik_trafo'] ?? 'Tidak ada' }}</td>
                              </tr>
                              <tr>
                                <td class="font-bold border px-2 py-1 text-left w-[150px]">Tegangan Primer</td>
                                <td class="border px-2 py-1 text-left">{{ $trafo['tegangan_primer_trafo'] ?? 'Tidak ada' }}</td>
                              </tr>
                              <tr>
                                <td class="font-bold border px-2 py-1 text-left">Tegangan Sekunder</td>
                                <td class="border px-2 py-1 text-left">{{ $trafo['tegangan_sekunder_trafo'] ?? 'Tidak ada' }}</td>
                              </tr>
                              <tr>
                                <td class="font-bold border px-2 py-1 text-left">Kapasitas Daya</td>
                                <td class="border px-2 py-1 text-left">{{ $trafo['kapasitas_daya_trafo'] ?? 'Tidak ada' }}</td>
                              </tr>
                              <tr>
                                <td class="font-bold border px-2 py-1 text-left">Kabupaten / Kota</td>
                                <td class="border px-2 py-1 text-left">{{ $trafo['kabupaten_kota_trafo'] ?? 'Tidak ada' }}</td>
                              </tr>
                              <tr>
                                <td class="font-bold border px-2 py-1 text-left">Provinsi</td>
                                <td class="border px-2 py-1 text-left">{{ $trafo['provinsi_trafo'] ?? 'Tidak ada' }}</td>
                              </tr>
                              <tr>
                                <td class="font-bold border px-2 py-1 text-left">Latitude</td>
                                <td class="border px-2 py-1 text-left">{{ $trafo['latitude_trafo'] ?? 'Tidak ada' }}</td>
                              </tr>
                              <tr>
                                <td class="font-bold border px-2 py-1 text-left">Longitude</td>
                                <td class="border px-2 py-1 text-left">{{ $trafo['longitude_trafo'] ?? 'Tidak ada' }}</td>
                              </tr>
                              <tr>
                                <td class="font-bold border px-2 py-1 text-left">Tahun Operasi</td>
                                <td class="border px-2 py-1 text-left">{{ $trafo['tahun_operasi_trafo'] ?? 'Tidak ada' }}</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>


                    <!-- KOLOM 2: LAMPIRAN -->
                    <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                      <h2 class="text-lg text-center font-bold border-b pb-2 mb-2">Lampiran</h2>
                      <div>
                        @if($pengajuan->lampiran_tagihan_listrik)
                        <!-- Iframe dengan fitur zoom -->
                        <div class="w-full h-[500px] rounded overflow-hidden border">
                          <iframe
                            src="{{ route('lampiran.show', basename($pengajuan->lampiran_tagihan_listrik)) }}"
                            class="w-full h-full"
                            allowfullscreen>
                          </iframe>
                        </div>
                        <!-- Tombol Lihat di Tab Baru -->
                        <div class="mt-2 text-right">
                          <a href="{{ route('lampiran.show', basename($pengajuan->lampiran_tagihan_listrik)) }}"
                            target="_blank"
                            class="inline-block px-4 py-2 bg-blue-500 text-white text-sm rounded hover:bg-blue-600 transition">
                            Lihat di Tab Baru
                          </a>
                        </div>
                        @else
                        <p class="text-gray-500 text-center">Tidak ada lampiran</p>
                        @endif
                      </div>
                    </div>

                    <!-- KOLOM 3: Evaluasi 8 -->
                    <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                      <h2 class="text-lg text-center font-bold border-b pb-2 mb-2">Evaluasi</h2>

                      <label for="catatan-perbaikan-8" class="text-sm font-semibold">Catatan Perbaikan :</label>
                      <textarea
                        id="catatan-perbaikan-8"
                        name="catatan_perbaikan_8"
                        rows="8"
                        class="w-full p-2 border rounded text-sm"
                        placeholder="Tulis catatan perbaikan..."></textarea>

                      <label for="status-permohonan-8" class="text-sm font-semibold">Status Permohonan :</label>
                      <select
                        id="status-permohonan-8"
                        name="status_permohonan_8"
                        class="w-full border p-2 rounded text-sm">
                        <option value="" disabled selected hidden>-- Status --</option>
                        <option value="Disetujui">Disetujui</option>
                        <option value="Ditolak">Ditolak</option>
                        <option value="Perbaikan">Perbaikan</option>
                      </select>
                      <!-- Tombol Simpan 3 -->
                      <!-- <div class="pt-2 mt-6">
                        <button onclick="simpanEvaluasiBagian('sambungan_listrik', 8)" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded w-full">
                          Simpan Evaluasi
                        </button>
                      </div> -->

                      <!-- Modal Pop-up 3 -->
                      <div id="popupBerhasil8" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
                        <div class="bg-white p-6 rounded-lg shadow-lg text-center w-80">
                          <h2 class="text-lg font-semibold text-green-700 mb-2">Berhasil!</h2>
                          <p class="text-gray-700 mb-4">Evaluasi berhasil disimpan.</p>
                          <button onclick="tutupPopup8()" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded">
                            OK
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>


                  <div class="mt-6 flex justify-between">
                    <button onclick="goToPrevPage(2)" type="button" class="inline-block px-5 py-2 bg-green-400 text-white font-semibold rounded-lg hover:bg-green-500 transition">
                      Kembali
                    </button>
                    <button type="button" onclick="goToNextPage(2)" class="inline-block px-5  py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                      Selanjutnya
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <!-- HALAMAN 3 : KAPASITAS PRODUKSI TENAGA LISTRIK -->
            <div id="page3" class="hidden">
              <h2 class="text-center font-bold text-lg bg-gray-100 p-3 rounded-t border-b border-gray-300">Kapasitas Produksi Tenaga Listrik</h2>

              <!-- Container 4: KAPASITAS PRODUKSI TENAGA LISTRIK | EVALUASI -->
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4 border border-gray-200 rounded shadow-sm overflow-hidden p-4">
                <!-- KOLOM 1: KAPASITAS PRODUKSI TENAGA LISTRIK -->
                @php
                $pemakaian = $pengajuan->pemakaian_sendiri ?? [];
                @endphp

                <div class="space-y-8">
                  @foreach($pemakaian as $jenis => $dataBulan)
                  <div class="bg-white rounded shadow p-4 border-2 border-gray-300">
                    <h2 class="text-lg font-bold text-center border-b pb-2 mb-4">
                      Data Pemakaian Sendiri - {{ $jenis }}
                    </h2>
                    <div class="overflow-x-auto">
                      <table class="w-full table-auto border-collapse border border-gray-300 text-sm">
                        <thead class="bg-gray-100 text-center">
                          <tr>
                            <th class="border px-3 py-2">Bulan</th>
                            <th class="border px-3 py-2">Kapasitas (kVA)</th>
                            <th class="border px-3 py-2">Faktor (Cos)</th>
                            <th class="border px-3 py-2">Jam Nyala (Jam)</th>
                            <th class="border px-3 py-2">Daya Terpakai (kWh)</th>
                          </tr>
                        </thead>
                        <tbody class="text-left">
                          @foreach($dataBulan as $bulan => $row)
                          <tr>
                            <td class="border px-3 py-1">{{ $bulan }}</td>
                            <td class="border px-3 py-1">{{ $row['kapasitas'] ?? 'Tidak ada' }}</td>
                            <td class="border px-3 py-1">{{ $row['faktor_daya'] ?? 'Tidak ada' }}</td>
                            <td class="border px-3 py-1">{{ $row['jam_nyala'] ?? 'Tidak ada' }}</td>
                            <td class="border px-3 py-1">{{ $row['daya_terpakai'] ?? 'Tidak ada' }}</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                  @endforeach
                </div>

                <!-- KOLOM 2: Evaluasi 9 -->
                <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                  <h2 class="text-lg text-center font-bold border-b pb-2 mb-2">Evaluasi</h2>

                  <label for="catatan-perbaikan-9" class="text-sm font-semibold">Catatan Perbaikan :</label>
                  <textarea
                    id="catatan-perbaikan-9"
                    name="catatan_perbaikan_9"
                    rows="8"
                    class="w-full p-2 border rounded text-sm"
                    placeholder="Tulis catatan perbaikan..."></textarea>

                  <label for="status-permohonan-9" class="text-sm font-semibold">Status Permohonan :</label>
                  <select
                    id="status-permohonan-9"
                    name="status_permohonan_9"
                    class="w-full border p-2 rounded text-sm">
                    <option value="" disabled selected hidden>-- Status --</option>
                    <option value="Disetujui">Disetujui</option>
                    <option value="Ditolak">Ditolak</option>
                    <option value="Perbaikan">Perbaikan</option>
                  </select>
                  <!-- Tombol Simpan 4 -->
                  <!-- <div class="pt-2 mt-6">
                    <button onclick="simpanEvaluasiBagian('kapasitas_produksi', 9)" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded w-full">
                      Simpan Evaluasi
                    </button>
                  </div> -->

                  <!-- Modal Pop-up 4 -->
                  <div id="popupBerhasil9" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
                    <div class="bg-white p-6 rounded-lg shadow-lg text-center w-80">
                      <h2 class="text-lg font-semibold text-green-700 mb-2">Berhasil!</h2>
                      <p class="text-gray-700 mb-4">Evaluasi berhasil disimpan.</p>
                      <button onclick="tutupPopup9()" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded">
                        OK
                      </button>
                    </div>
                  </div>
                </div>



                <!--Penjualan kelebihan tenaga listrik/Excess Power. -->
                <div class="grid grid-cols-1 gap-4 border-gray-200 rounded shadow-sm">
                  @php
                  $penjualan = $pengajuan->penjualan_listrik ?? null;
                  $bulanList = [
                  'Januari','Februari','Maret','April','Mei','Juni',
                  'Juli','Agustus','September','Oktober','November','Desember'
                  ];

                  // siapkan data default (12 bulan × kolom kosong)
                  $defaultRows = array_fill(0, 12, [
                  'dmn_ndc' => null,
                  'beban_tertinggi' => null,
                  'capacity_factor' => null,
                  'afpm' => null,
                  'afa' => null,
                  'pembelian' => null,
                  'produksi_bruto' => null,
                  'pemakaian_sendiri' => null,
                  'produksi_netto' => null,
                  ]);

                  // jika status "yes" dan ada data, gunakan datanya, kalau tidak pakai default
                  $rows = ($penjualan && $penjualan['status'] === 'yes' && !empty($penjualan['excess_power']))
                  ? $penjualan['excess_power']
                  : $defaultRows;
                  @endphp

                  <div class="bg-white rounded shadow p-4 border-2 border-gray-300 mt-6">
                    <h2 class="text-lg font-bold text-center border-b pb-2 mb-4">
                      Data Penjualan Listrik (Excess Power)
                    </h2>
                    <div class="overflow-x-auto">
                      <table class="w-full table-auto border-collapse border border-gray-300 text-sm">
                        <thead class="bg-gray-100 text-center">
                          <tr>
                            <th class="border px-3 py-2">Bulan</th>
                            <th class="border px-3 py-2">DMN / NDC (MW)</th>
                            <th class="border px-3 py-2">Beban Tertinggi (MW)</th>
                            <th class="border px-3 py-2">Capacity Factor (CF)</th>
                            <th class="border px-3 py-2">AFPM (%)</th>
                            <th class="border px-3 py-2">AFA (%)</th>
                            <th class="border px-3 py-2">Pembelian (kWh)</th>
                            <th class="border px-3 py-2">Produksi Bruto (kWh)</th>
                            <th class="border px-3 py-2">Pemakaian Sendiri (kWh)</th>
                            <th class="border px-3 py-2">Produksi Netto (kWh)</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($rows as $i => $row)
                          <tr>
                            <td class="border px-3 py-1 text-center">{{ $bulanList[$i] ?? 'Tidak ada' }}</td>
                            <td class="border px-3 py-1">{{ $row['dmn_ndc'] ?? 'Tidak ada' }}</td>
                            <td class="border px-3 py-1">{{ $row['beban_tertinggi'] ?? 'Tidak ada' }}</td>
                            <td class="border px-3 py-1">{{ $row['capacity_factor'] ?? 'Tidak ada' }}</td>
                            <td class="border px-3 py-1">{{ $row['afpm'] ?? 'Tidak ada' }}</td>
                            <td class="border px-3 py-1">{{ $row['afa'] ?? 'Tidak ada' }}</td>
                            <td class="border px-3 py-1">{{ $row['pembelian'] ?? 'Tidak ada' }}</td>
                            <td class="border px-3 py-1">{{ $row['produksi_bruto'] ?? 'Tidak ada' }}</td>
                            <td class="border px-3 py-1">{{ $row['pemakaian_sendiri'] ?? 'Tidak ada' }}</td>
                            <td class="border px-3 py-1">{{ $row['produksi_netto'] ?? 'Tidak ada' }}</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

                <!-- KOLOM 2: Evaluasi Excess Power (10) -->
                <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                  <h2 class="text-lg text-center font-bold border-b pb-2 mb-2">Evaluasi</h2>
                  
                  <label for="catatan-perbaikan-10" class="text-sm font-semibold">Catatan Perbaikan :</label>
                  <textarea
                    id="catatan-perbaikan-10"
                    name="catatan_perbaikan_10"
                    rows="8"
                    class="w-full p-2 border rounded text-sm"
                    placeholder="Tulis catatan perbaikan..."></textarea>
                    
                  <label for="status-permohonan-10" class="text-sm font-semibold">Status Permohonan :</label>
                  <select
                    id="status-permohonan-10"
                    name="status_permohonan_10"
                    class="w-full border p-2 rounded text-sm">
                    <option value="" disabled selected hidden>-- Status --</option>
                    <option value="Disetujui">Disetujui</option>
                    <option value="Ditolak">Ditolak</option>
                    <option value="Perbaikan">Perbaikan</option>
                  </select>
                  <!-- Tombol Simpan 10 -->
                  <div class="pt-2 mt-6">
                    <button onclick="simpanEvaluasiBagian('excess_power', 10)" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded w-full">
                      Simpan Evaluasi
                    </button>
                  </div>

                  <!-- Modal Pop-up 10 -->
                  <div id="popupBerhasil10" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
                    <div class="bg-white p-6 rounded-lg shadow-lg text-center w-80">
                      <h2 class="text-lg font-semibold text-green-700 mb-2">Berhasil!</h2>
                      <p class="text-gray-700 mb-4">Evaluasi berhasil disimpan.</p>
                      <button onclick="tutupPopup10()" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded">
                        OK
                      </button>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Tombol Navigasi (Tengah secara vertikal dan tidak terlalu turun) -->
              <div class="w-full flex justify-between items-center py-4">
                <!-- Tombol Kembali di Kiri -->
                <button
                  onclick="goToPrevPage(3)"
                  type="button"
                  class="px-5 py-2  bg-green-500 text-white font-semibold rounded-lg hover:bg-green-600 transition">
                  Kembali
                </button>

                <!-- Tombol Aksi di kanan -->
                <!-- Tombol Proses Laporan Berkala berdasarkan Status -->
                <div class="relative inline-block">
                    @php
                    $status = $pengajuan->status ?? 'unknown';
                    $canProcess = in_array($status, ['proses evaluasi', 'evaluasi']); // Allow for 'proses evaluasi' and 'evaluasi' (after evaluator ACC)
                    $isDisabled = in_array($status, ['perbaikan', 'pengesahan', 'validasi']); // Disable for final statuses
                    @endphp
                    
                    @if($canProcess)
                        <!-- Status: proses evaluasi atau evaluasi (sudah di-ACC evaluator) - Tombol aktif -->
                        <button onclick="openKirimHasilModal()" class="px-5 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition">
                            Proses Laporan Berkala
                        </button>
                    @elseif($isDisabled)
                        <!-- Status: perbaikan, pengesahan, atau validasi - Tombol disabled -->
                        <button disabled class="px-5 py-2 bg-gray-400 text-gray-600 font-semibold rounded-lg cursor-not-allowed transition" title="Dokumen dalam status {{ $status }}, tidak dapat diproses">
                            Proses Laporan Berkala
                        </button>
                        <p class="text-xs text-gray-500 mt-1 text-center">Status: {{ ucfirst($status) }}</p>
                    @else
                        <!-- Status lainnya - Tombol disabled dengan pesan -->
                        <button disabled class="px-5 py-2 bg-gray-400 text-gray-600 font-semibold rounded-lg cursor-not-allowed transition" title="Status {{ $status }} tidak dapat diproses">
                            Proses Laporan Berkala
                        </button>
                        <p class="text-xs text-gray-500 mt-1 text-center">Status: {{ ucfirst($status) }}</p>
                    @endif
                </div>
              </div>
            </div>
            <!-- Card Pop-up Konfirmasi -->
            <div id="popupCard" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
              <div class="bg-white rounded-2xl shadow-xl p-6 w-full max-w-md text-center">
                <h2 class="text-lg font-bold text-gray-800 mb-3">Konfirmasi Pengiriman</h2>
                <p class="text-sm text-gray-600 mb-6">Apakah Anda yakin ingin mengirim hasil evaluasi ini?</p>
                <div class="flex justify-center gap-4">
                  <button onclick="submitEvaluasi()" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                    Iya
                  </button>
                  <button onclick="closePopup()" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition">
                    Tidak
                  </button>
                </div>
              </div>
            </div>

            <!-- Modal Popup Pilihan Kirim Hasil -->
            <div id="modal-kirim-hasil" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
                <div class="bg-white dark:bg-slate-800 rounded-lg p-6 w-full max-w-sm shadow-lg relative">
                    @php
                    $currentStatus = $pengajuan->status ?? 'unknown';
                    $showEvaluatorButton = $currentStatus !== 'evaluasi'; // Hide when status is 'evaluasi' (proses verifikasi)
                    @endphp
                    
                    @if($showEvaluatorButton)
                    <!-- Tombol Penugasan Evaluator - Hidden saat status 'evaluasi' -->
                    <button onclick="openEvaluatorModal()" class="w-full text-left px-4 py-2 mb-3 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
                        Penugasan Evaluator
                    </button>
                    @endif
                    
                    <!-- Tombol Perbaikan - Selalu tampil -->
                    <button onclick="openPerbaikanModal()" class="w-full text-left px-4 py-2 mb-3 bg-red-600 text-white rounded hover:bg-red-700 transition">
                        Perbaikan
                    </button>
                    
                    <!-- Tombol Proses Verifikasi - Selalu tampil -->
                    <button onclick="verifikasiDokumen()" class="w-full text-left px-4 py-2 mb-3 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                        Verifikasi
                    </button>
                    
                    <button onclick="closeKirimHasilModal()" class="absolute top-0 right-2 font-bold text-xl text-gray-600 hover:text-gray-900 dark:hover:text-white">&times;</button>
                </div>
            </div>

            <!-- Modal untuk Penugasan Evaluator -->
            <div id="modal-evaluator" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
                <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-lg">
                    <h2 class="text-lg font-bold mb-4">Penugasan Evaluator</h2>
                    
                    <!-- Info Evaluator Sebelumnya -->
                    @if($pengajuan->evaluator)
                    <div class="mb-4 p-3 bg-blue-50 rounded border-l-4 border-blue-400">
                        <p class="text-sm font-medium text-blue-800">Evaluator Sebelumnya:</p>
                        <p class="text-sm text-blue-600">{{ $pengajuan->evaluator->name }}</p>
                    </div>
                    @endif
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">Pilih Evaluator Baru:</label>
                        <select id="evaluator-select" class="w-full border rounded p-2">
                            <option value="">-- Pilih Evaluator --</option>
                            <!-- Evaluator yang sedang menangani saat ini -->
                            @if($pengajuan->evaluator)
                            <option value="{{ $pengajuan->evaluator->id }}" class="bg-yellow-50">
                                {{ $pengajuan->evaluator->name }} (Saat ini)
                            </option>
                            @endif
                            <!-- Evaluator lainnya -->
                            @foreach($evaluators ?? [] as $evaluator)
                            @if($evaluator->id !== $pengajuan->evaluator_id)
                            <option value="{{ $evaluator->id }}">{{ $evaluator->name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">Alasan Penugasan Ulang:</label>
                        <textarea id="catatan-evaluator" class="w-full border rounded p-2" rows="3" placeholder="Jelaskan alasan penugasan ulang evaluator..."></textarea>
                    </div>
                    <div class="flex justify-end gap-4">
                        <button onclick="closeEvaluatorModal()" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                            Batal
                        </button>
                        <button onclick="kirimKeEvaluator()" class="px-4 py-2 bg-yellow-600 text-white rounded hover:bg-yellow-700">
                            Tugaskan Evaluator
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal untuk Perbaikan -->
            <div id="modal-perbaikan" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
                <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-lg">
                    <h2 class="text-lg font-bold mb-4">Kirim untuk Perbaikan</h2>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">Catatan Perbaikan:</label>
                        <textarea id="catatan-perbaikan-kabid" class="w-full border rounded p-2" rows="4" placeholder="Jelaskan hal yang perlu diperbaiki..."></textarea>
                    </div>
                    <div class="flex justify-end gap-4">
                        <button onclick="closePerbaikanModal()" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                            Batal
                        </button>
                        <button onclick="kirimPerbaikan()" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                            Kirim Perbaikan
                        </button>
                    </div>
                </div>
            </div>
          </div>

          <!-- Script JavaScript -->
          <script>
            function showPopup() {
              document.getElementById('popupCard').classList.remove('hidden');
            }

            function closePopup() {
              document.getElementById('popupCard').classList.add('hidden');
            }

            function submitEvaluasi() {
              closePopup(); // tutup pop-up dulu
            }
          </script>
          <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

          <script>
            function submitEvaluasi() {
              const laporanId = "{{ $pengajuan->id }}";
              
              // Show loading dengan SweetAlert
              if (typeof Swal !== 'undefined') {
                Swal.fire({
                  title: 'Mengirim Evaluasi...',
                  html: 'Mohon tunggu sebentar',
                  allowOutsideClick: false,
                  didOpen: () => {
                    Swal.showLoading();
                  }
                });
              }

              fetch(`/evaluasi/${laporanId}/submit`, {
                  method: "POST",
                  headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                  },
                  body: JSON.stringify({
                    hasil_evaluasi: "Evaluasi telah diselesaikan dan siap dikirim ke Kabid"
                  })
                })
                .then(response => {
                  console.log('Submit response status:', response.status);
                  if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                  }
                  return response.json();
                })
                .then(data => {
                  console.log('Submit response data:', data);
                  
                  if (typeof Swal !== 'undefined') {
                    Swal.close();
                  }
                  
                  if (data.success) {
                    closePopup();
                    
                    if (typeof Swal !== 'undefined') {
                      Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data.message || 'Hasil evaluasi berhasil dikirim ke Kabid!',
                        confirmButtonText: 'OK'
                      }).then(() => {
                        window.location.href = "{{ route('laporan.evaluator.index') }}";
                      });
                    } else {
                      alert(data.message || "Hasil evaluasi berhasil dikirim ke Kabid!");
                      window.location.href = "{{ route('laporan.evaluator.index') }}";
                    }
                  } else {
                    const errorMessage = data.message || 'Terjadi kesalahan saat mengirim evaluasi.';
                    console.error('Server error:', errorMessage);
                    
                    if (typeof Swal !== 'undefined') {
                      Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: errorMessage,
                        confirmButtonText: 'OK'
                      });
                    } else {
                      alert('Error: ' + errorMessage);
                    }
                  }
                })
                .catch(error => {
                  console.error('Submit error:', error);
                  
                  if (typeof Swal !== 'undefined') {
                    Swal.close();
                    Swal.fire({
                      icon: 'error',
                      title: 'Error!',
                      text: 'Terjadi kesalahan jaringan: ' + error.message,
                      confirmButtonText: 'OK'
                    });
                  } else {
                    alert('Error jaringan: ' + error.message);
                  }
                });
            }
          </script>


        </div>

        <script>
          function tampilkanPopup1() {
            document.getElementById('popupBerhasil1').classList.remove('hidden');
          }

          function tutupPopup1() {
            document.getElementById('popupBerhasil1').classList.add('hidden');
          }

          function tampilkanPopup2() {
            document.getElementById('popupBerhasil2').classList.remove('hidden');
          }

          function tutupPopup2() {
            document.getElementById('popupBerhasil2').classList.add('hidden');
          }

          function tampilkanPopup3() {
            document.getElementById('popupBerhasil3').classList.remove('hidden');
          }

          function tutupPopup3() {
            document.getElementById('popupBerhasil3').classList.add('hidden');
          }

          function tampilkanPopup4() {
            document.getElementById('popupBerhasil4').classList.remove('hidden');
          }

          function tutupPopup4() {
            document.getElementById('popupBerhasil4').classList.add('hidden');
          }

          function tampilkanPopup5() {
            document.getElementById('popupBerhasil5').classList.remove('hidden');
          }

          function tutupPopup5() {
            document.getElementById('popupBerhasil5').classList.add('hidden');
          }

          function tampilkanPopup6() {
            document.getElementById('popupBerhasil6').classList.remove('hidden');
          }

          function tutupPopup6() {
            document.getElementById('popupBerhasil6').classList.add('hidden');
          }

          function tampilkanPopup7() {
            document.getElementById('popupBerhasil7').classList.remove('hidden');
          }

          function tutupPopup7() {
            document.getElementById('popupBerhasil7').classList.add('hidden');
          }

          function tampilkanPopup8() {
            document.getElementById('popupBerhasil8').classList.remove('hidden');
          }

          function tutupPopup8() {
            document.getElementById('popupBerhasil8').classList.add('hidden');
          }

          function tampilkanPopup9() {
            document.getElementById('popupBerhasil9').classList.remove('hidden');
          }

          function tutupPopup9() {
            document.getElementById('popupBerhasil9').classList.add('hidden');
          }

          function tampilkanPopup10() {
            document.getElementById('popupBerhasil10').classList.remove('hidden');
          }

          function tutupPopup10() {
            document.getElementById('popupBerhasil10').classList.add('hidden');
          }

          function tampilkanPopup11() {
            document.getElementById('popupBerhasil11').classList.remove('hidden');
          }

          function tutupPopup11() {
            document.getElementById('popupBerhasil11').classList.add('hidden');
          }
        </script>

        <script>
          // Menyembunyikan semua halaman, menampilkan satu berdasarkan id
          function showOnlyPage(pageNumber) {
            const totalPages = 4; // Ubah sesuai jumlah page (0–3)
            for (let i = 0; i < totalPages; i++) {
              const page = document.getElementById("page" + i);
              if (page) {
                page.classList.add("hidden");
              }
            }

            const targetPage = document.getElementById("page" + pageNumber);
            if (targetPage) {
              targetPage.classList.remove("hidden");
              requestAnimationFrame(() => {
                targetPage.scrollIntoView({
                  behavior: "auto",
                  block: "start"
                });
              });
            } else {
              console.error("Halaman tidak ditemukan: page" + pageNumber);
            }
          }

          // Fungsi untuk tombol "Selanjutnya"
          function goToNextPage(current) {
            const next = current + 1;
            showOnlyPage(next);
          }

          // Fungsi untuk tombol "Kembali"
          function goToPrevPage(current) {
            const prev = current - 1;
            showOnlyPage(prev);
          }
        </script>

        <script>
          function openModal(docName) {
            document.getElementById('modal-evaluasi').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
            document.getElementById('nama-dokumen').textContent = `Dokumen: ${docName}`;
            document.getElementById('catatan-evaluasi').value = '';
            document.getElementById('status-evaluasi').value = 'Setuju';
          }

          function closeModal() {
            document.getElementById('modal-evaluasi').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
          }

          function simpanEvaluasi() {
            const doc = document.getElementById('nama-dokumen').textContent;
            const catatan = document.getElementById('catatan-evaluasi').value;
            const status = document.getElementById('status-evaluasi').value;
            console.log(`Evaluasi disimpan untuk ${doc}: ${status}, Catatan: ${catatan}`);
            closeModal();
          }

          // Fungsi untuk simpan evaluasi per bagian dengan AJAX
          function simpanEvaluasiBagian(sectionName, sectionNumber) {
            console.log('simpanEvaluasiBagian called:', sectionName, sectionNumber);
            
            // Cek apakah field ada
            const catatanField = document.getElementById(`catatan-perbaikan-${sectionNumber}`);
            const statusField = document.getElementById(`status-permohonan-${sectionNumber}`);
            
            if (!catatanField || !statusField) {
              console.error('Field tidak ditemukan:', {
                catatan: catatanField ? 'ada' : 'tidak ada',
                status: statusField ? 'ada' : 'tidak ada',
                sectionNumber: sectionNumber
              });
              alert('Error: Field form tidak ditemukan!');
              return;
            }
            
            const catatan = catatanField.value.trim();
            const status = statusField.value;
            
            console.log('Data yang akan dikirim:', { section: sectionName, catatan, status });
            
            // Validasi input
            if (!status) {
              if (typeof Swal !== 'undefined') {
                Swal.fire({
                  icon: 'warning',
                  title: 'Status Belum Dipilih',
                  text: 'Silakan pilih status evaluasi terlebih dahulu.',
                  confirmButtonText: 'OK'
                });
              } else {
                alert('Status evaluasi harus dipilih!');
              }
              return;
            }
            
            // Validasi khusus untuk status Perbaikan
            if (status === 'Perbaikan' && !catatan.trim()) {
              if (typeof Swal !== 'undefined') {
                Swal.fire({
                  icon: 'warning',
                  title: 'Catatan Perbaikan Diperlukan',
                  text: 'Silakan isi catatan perbaikan untuk memberikan panduan kepada pengusaha.',
                  confirmButtonText: 'OK'
                });
              } else {
                alert('Catatan perbaikan harus diisi untuk status Perbaikan!');
              }
              return;
            }
            
            // Show loading
            if (typeof Swal !== 'undefined') {
              Swal.fire({
                title: 'Menyimpan Evaluasi...',
                html: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                didOpen: () => {
                  Swal.showLoading();
                }
              });
            }
            
            // Kirim data ke backend - gunakan route sesuai role pengguna
            @if(auth()->user()->role_pengguna === 'kabid')
            const saveUrl = '/kabid/evaluasi/{{ $pengajuan->id }}/save-section';
            @else
            const saveUrl = '/evaluasi/{{ $pengajuan->id }}/save-section';
            @endif
            
            fetch(saveUrl, {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
              },
              body: JSON.stringify({
                section: sectionName,
                catatan: catatan,
                status: status
              })
            })
            .then(response => {
              console.log('Response status:', response.status);
              if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
              }
              return response.json();
            })
            .then(data => {
              console.log('Response data:', data);
              
              if (typeof Swal !== 'undefined') {
                Swal.close();
              }
              
              if (data.success) {
                // Disable input setelah berhasil disimpan
                if (catatanField) catatanField.disabled = true;
                if (statusField) statusField.disabled = true;
                
                // Ubah tombol menjadi tidak aktif
                const button = event && event.target ? event.target : null;
                if (button) {
                  button.disabled = true;
                  button.classList.add('cursor-not-allowed', 'bg-gray-400');
                  button.classList.remove('bg-green-600', 'hover:bg-green-700');
                  button.textContent = 'Tersimpan';
                }
                
                // Special message for Perbaikan status
                if (status === 'Perbaikan') {
                  if (typeof Swal !== 'undefined') {
                    Swal.fire({
                      icon: 'success',
                      title: 'Status Perbaikan Berhasil Disimpan!',
                      html: 'Evaluasi berhasil disimpan dengan status <strong>Perbaikan</strong>.<br><br>Dokumen akan dikembalikan ke pengusaha untuk diperbaiki sesuai catatan yang diberikan.',
                      confirmButtonText: 'OK'
                    });
                  } else {
                    alert('Status Perbaikan berhasil disimpan! Dokumen akan dikembalikan ke pengusaha untuk diperbaiki.');
                  }
                } else {
                  if (typeof Swal !== 'undefined') {
                    Swal.fire({
                      icon: 'success',
                      title: 'Berhasil!',
                      text: 'Evaluasi bagian berhasil disimpan.',
                      confirmButtonText: 'OK'
                    });
                  } else {
                    alert('Evaluasi bagian berhasil disimpan!');
                  }
                }
              } else {
                const errorMessage = data.message || 'Terjadi kesalahan saat menyimpan evaluasi.';
                console.error('Server error:', errorMessage);
                
                if (typeof Swal !== 'undefined') {
                  Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: errorMessage,
                    confirmButtonText: 'OK'
                  });
                } else {
                  alert('Error: ' + errorMessage);
                }
              }
            })
            .catch(error => {
              console.error('Fetch error:', error);
              
              if (typeof Swal !== 'undefined') {
                Swal.close();
                Swal.fire({
                  icon: 'error',
                  title: 'Error!',
                  text: 'Terjadi kesalahan jaringan: ' + error.message,
                  confirmButtonText: 'OK'
                });
              } else {
                alert('Error jaringan: ' + error.message);
              }
            });
          }
          
          // Load data evaluasi yang tersimpan saat halaman dimuat
          document.addEventListener('DOMContentLoaded', function() {
            loadSavedEvaluations();
          });
          
          // Fungsi untuk modal popup Kabid
          function openKirimHasilModal() {
              document.getElementById('modal-kirim-hasil').classList.remove('hidden');
              document.body.classList.add('overflow-hidden');
          }

          function closeKirimHasilModal() {
              document.getElementById('modal-kirim-hasil').classList.add('hidden');
              document.body.classList.remove('overflow-hidden');
          }

          // Fungsi untuk modal Evaluator
          function openEvaluatorModal() {
              closeKirimHasilModal();
              document.getElementById('modal-evaluator').classList.remove('hidden');
              document.body.classList.add('overflow-hidden');
          }

          function closeEvaluatorModal() {
              document.getElementById('modal-evaluator').classList.add('hidden');
              document.body.classList.remove('overflow-hidden');
          }

          // Fungsi untuk modal Perbaikan
          function openPerbaikanModal() {
              closeKirimHasilModal();
              document.getElementById('modal-perbaikan').classList.remove('hidden');
              document.body.classList.add('overflow-hidden');
          }

          function closePerbaikanModal() {
              document.getElementById('modal-perbaikan').classList.add('hidden');
              document.body.classList.remove('overflow-hidden');
          }

          // Fungsi untuk mengirim ke evaluator
          function kirimKeEvaluator() {
              const evaluatorId = document.getElementById('evaluator-select').value;
              const catatan = document.getElementById('catatan-evaluator').value;
              
              if (!evaluatorId) {
                  Swal.fire({
                      icon: 'warning',
                      title: 'Pilih Evaluator',
                      text: 'Silakan pilih evaluator terlebih dahulu.',
                      confirmButtonText: 'OK'
                  });
                  return;
              }
              
              // Show loading
              Swal.fire({
                  title: 'Menugaskan Evaluator...',
                  html: 'Mohon tunggu sebentar',
                  allowOutsideClick: false,
                  didOpen: () => {
                      Swal.showLoading();
                  }
              });
              
              fetch('/pengajuan/{{ $pengajuan->id }}/reassign-evaluator', {
                  method: 'POST',
                  headers: {
                      'Content-Type': 'application/json',
                      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                      'Accept': 'application/json'
                  },
                  body: JSON.stringify({
                      evaluator_id: evaluatorId,
                      alasan_reassign: catatan,
                      tipe_penugasan: 'pengiriman_ulang' // Menandakan ini pengiriman ulang
                  })
              })
              .then(response => response.json())
              .then(data => {
                  Swal.close();
                  if (data.success) {
                      closeEvaluatorModal();
                      Swal.fire({
                          icon: 'success',
                          title: 'Berhasil!',
                          text: data.message,
                          confirmButtonText: 'OK',
                          customClass: {
                              confirmButton: 'swal2-confirm btn-primary'
                          }
                      }).then(() => {
                          window.location.href = '/laporan-berkala-kabid';
                      });
                  } else {
                      Swal.fire({
                          icon: 'error',
                          title: 'Gagal!',
                          text: data.message,
                          confirmButtonText: 'OK'
                      });
                  }
              })
              .catch(error => {
                  Swal.close();
                  Swal.fire({
                      icon: 'error',
                      title: 'Error!',
                      text: 'Terjadi kesalahan: ' + error.message,
                      confirmButtonText: 'OK'
                  });
              });
          }

          // Fungsi untuk mengirim perbaikan
          function kirimPerbaikan() {
              const catatan = document.getElementById('catatan-perbaikan-kabid').value.trim();
              
              if (!catatan) {
                  Swal.fire({
                      icon: 'warning',
                      title: 'Catatan Diperlukan',
                      text: 'Silakan isi catatan perbaikan terlebih dahulu.',
                      confirmButtonText: 'OK'
                  });
                  return;
              }
              
              // Show loading
              Swal.fire({
                  title: 'Mengirim untuk Perbaikan...',
                  html: 'Mohon tunggu sebentar',
                  allowOutsideClick: false,
                  didOpen: () => {
                      Swal.showLoading();
                  }
              });
              
              fetch('/pengajuan/{{ $pengajuan->id }}/reject', {
                  method: 'POST',
                  headers: {
                      'Content-Type': 'application/json',
                      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                      'Accept': 'application/json'
                  },
                  body: JSON.stringify({
                      catatan_kabid: catatan,
                      alasan_penolakan: catatan
                  })
              })
              .then(response => response.json())
              .then(data => {
                  Swal.close();
                  if (data.success) {
                      closePerbaikanModal();
                      Swal.fire({
                          icon: 'success',
                          title: 'Berhasil!',
                          text: data.message,
                          confirmButtonText: 'OK'
                      }).then(() => {
                          window.location.href = '/laporan-berkala-kabid';
                      });
                  } else {
                      Swal.fire({
                          icon: 'error',
                          title: 'Gagal!',
                          text: data.message,
                          confirmButtonText: 'OK'
                      });
                  }
              })
              .catch(error => {
                  Swal.close();
                  Swal.fire({
                      icon: 'error',
                      title: 'Error!',
                      text: 'Terjadi kesalahan: ' + error.message,
                      confirmButtonText: 'OK'
                  });
              });
          }

          // Fungsi untuk verifikasi dokumen (approve)
          function verifikasiDokumen() {
              closeKirimHasilModal();
              
              // Show loading
              Swal.fire({
                  title: 'Memproses Verifikasi...',
                  html: 'Mohon tunggu sebentar',
                  allowOutsideClick: false,
                  didOpen: () => {
                      Swal.showLoading();
                  }
              });
              
              fetch('/pengajuan/{{ $pengajuan->id }}/approve', {
                  method: 'POST',
                  headers: {
                      'Content-Type': 'application/json',
                      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                      'Accept': 'application/json'
                  },
                  body: JSON.stringify({
                      catatan_kabid: 'Data telah diverifikasi dan disetujui untuk proses validasi.'
                  })
              })
              .then(response => response.json())
              .then(data => {
                  Swal.close();
                  if (data.success) {
                      Swal.fire({
                          icon: 'success',
                          title: 'Verifikasi Berhasil',
                          text: 'Data Telah Dikirim Untuk Proses Validasi.',
                          confirmButtonText: 'OK',
                          customClass: {
                              confirmButton: 'swal2-confirm btn-primary'
                          }
                      }).then(() => {
                          window.location.href = '/laporan-berkala-kabid';
                      });
                  } else {
                      Swal.fire({
                          icon: 'error',
                          title: 'Gagal!',
                          text: data.message,
                          confirmButtonText: 'OK'
                      });
                  }
              })
              .catch(error => {
                  Swal.close();
                  Swal.fire({
                      icon: 'error',
                      title: 'Error!',
                      text: 'Terjadi kesalahan: ' + error.message,
                      confirmButtonText: 'OK'
                  });
              });
          }

          function loadSavedEvaluations() {
            // Data evaluasi dari server
            const evaluasiData = @json($evaluasiData ?? []);
            const currentEvaluation = @json($currentEvaluation ?? null);
            const pengajuanStatus = @json($pengajuan->status ?? 'proses evaluasi');
            
            console.log('Loading saved evaluations:', {
              evaluasiData,
              currentEvaluation,
              pengajuanStatus
            });
            
            // Cek apakah evaluasi sudah dikirim ke kabid
            const isSubmittedToKabid = pengajuanStatus !== 'proses evaluasi' || 
                                      (currentEvaluation && currentEvaluation.status === 'selesai');
            
            console.log('Is submitted to Kabid?', isSubmittedToKabid);
            
          // Mapping section name ke section number
          const sectionMapping = {
            'data_pemilik': 1,
            'izin_usaha': 2,
            'izin_lingkungan': 3,
            'slo': 4,
            'skttk': 5,
            'data_mesin': 6,
            'data_generator': 7,
            'sambungan_listrik': 8,
            'kapasitas_produksi': 9,
            'excess_power': 10
          };
            
            // Loop melalui data evaluasi dan populate form
            Object.keys(evaluasiData).forEach(sectionName => {
              const sectionData = evaluasiData[sectionName];
              const sectionNumber = sectionMapping[sectionName];
              
              if (sectionNumber && sectionData) {
                console.log(`Loading section ${sectionName} (${sectionNumber}):`, sectionData);
                
                // Cari field dan populate
                const catatanField = document.getElementById(`catatan-perbaikan-${sectionNumber}`);
                const statusField = document.getElementById(`status-permohonan-${sectionNumber}`);
                
                if (catatanField && statusField) {
                  // Set nilai
                  catatanField.value = sectionData.catatan || '';
                  statusField.value = sectionData.status || '';
                  
                  // Update tombol dan field state
                  const container = catatanField.closest('.bg-white');
                  if (container) {
                    const button = container.querySelector('button[onclick*="simpanEvaluasiBagian"]');
                    if (button) {
                      // All sections remain editable for kabid - remove the disable logic
                      // Keep fields editable and show update button instead of disable
                      if (false) { // Never disable fields for kabid
                        // This block is disabled - kabid can always edit
                        catatanField.disabled = true;
                        statusField.disabled = true;
                        button.disabled = true;
                        button.classList.add('cursor-not-allowed', 'bg-gray-400');
                        button.classList.remove('bg-green-600', 'hover:bg-green-700');
                        button.textContent = 'Telah Dievaluasi';
                        
                        // Tambahkan info status
                        const info = document.createElement('small');
                        info.className = 'text-blue-600 block mt-1 font-semibold';
                        info.textContent = '';
                        if (!button.parentNode.querySelector('small')) {
                          button.parentNode.appendChild(info);
                        }
                      } else {
                        // Jika belum dikirim: field masih bisa diedit, ubah tombol jadi "Update"
                        catatanField.disabled = false;
                        statusField.disabled = false;
                        button.disabled = false;
                        button.classList.remove('cursor-not-allowed', 'bg-gray-400');
                        button.classList.add('bg-blue-600', 'hover:bg-blue-700');
                        button.textContent = 'Simpan Evaluasi';
                        
                        // Tambahkan info tanggal evaluasi terakhir
                        if (sectionData.evaluated_at) {
                          const evaluatedDate = new Date(sectionData.evaluated_at).toLocaleString('id-ID');
                          const info = document.createElement('small');
                          info.className = 'text-gray-500 block mt-1';
                          info.textContent = `Terakhir dievaluasi: ${evaluatedDate}`;
                          if (!button.parentNode.querySelector('small')) {
                            button.parentNode.appendChild(info);
                          }
                        }
                      }
                    }
                  }
                  
                  console.log(`Section ${sectionName} loaded successfully - editable: ${!isSubmittedToKabid}`);
                } else {
                  console.warn(`Fields not found for section ${sectionName} (${sectionNumber})`);
                }
              }
            });
            
            // Update tombol "Kirim Hasil Evaluasi" jika sudah dikirim
            if (isSubmittedToKabid) {
              const submitButton = document.querySelector('button[onclick="showPopup()"]');
              if (submitButton) {
                submitButton.disabled = true;
                submitButton.classList.add('cursor-not-allowed', 'bg-gray-400');
                submitButton.classList.remove('bg-blue-600', 'hover:bg-blue-700');
                submitButton.textContent = 'Telah Dikirim ke Kabid';
              }
            }
          }
        </script>

  </main>
  <!-- -right-90 in loc de 0-->
  <div fixed-plugin-card
    class="z-sticky backdrop-blur-2xl backdrop-saturate-200 dark:bg-slate-850/80 shadow-3xl w-90 ease -right-90 fixed top-0 left-auto flex h-full min-w-0 flex-col break-words rounded-none border-0 bg-white/80 bg-clip-border px-2.5 duration-200">
  </div>
  </div>
  </div>
  <script>
    function validateForm() {
      const form = document.getElementById("suratpengajuan");
      const requiredFields = form.querySelectorAll("input[required], select[required], textarea[required]");
      let isValid = true;

      requiredFields.forEach(field => {
        if (!field.value.trim()) {
          isValid = false;

          // Tambahkan efek visual kolom kosong
          field.classList.add("border-red-500");
          field.classList.add("ring");
          field.classList.add("ring-red-300");
        } else {
          field.classList.remove("border-red-500");
          field.classList.remove("ring");
          field.classList.remove("ring-red-300");
        }
      });

      if (!isValid) {
        alert("⚠️ Formulir belum lengkap. Silakan isi semua kolom yang wajib diisi.");
        return false;
      }

      const confirmSubmit = confirm("✅ Semua data sudah lengkap. Apakah Anda yakin ingin mengirim formulir?");
      return confirmSubmit;
    }
  </script>


</body>
<!-- plugin for charts  -->
<script src="../assets/js/plugins/chartjs.min.js" async></script>
<!-- plugin for scrollbar  -->
<script src="../assets/js/plugins/perfect-scrollbar.min.js" async></script>
<!-- main script file  -->
<script src="../assets/js/argon-dashboard-tailwind.js?v=1.0.1" async></script>

</html>