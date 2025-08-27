<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
  <div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>

  

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
          <div class="flex items-center md:ml-auto md:pr-4">
            <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
              <span
                class="text-sm ease leading-5.6 absolute z-50 -ml-px flex h-full items-center whitespace-nowrap rounded-lg rounded-tr-none rounded-br-none border border-r-0 border-transparent bg-transparent py-2 px-2.5 text-center font-normal text-slate-500 transition-all">
                <i class="fas fa-search"></i>
              </span>
            </div>
          </div>
          <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full">
            <!-- online builder btn  -->
            <!-- <li class="flex items-center">
                <a class="inline-block px-8 py-2 mb-0 mr-4 text-xs font-bold text-center text-blue-500 uppercase align-middle transition-all ease-in bg-transparent border border-blue-500 border-solid rounded-lg shadow-none cursor-pointer leading-pro hover:-translate-y-px active:shadow-xs hover:border-blue-500 active:bg-blue-500 active:hover:text-blue-500 hover:text-blue-500 tracking-tight-rem hover:bg-transparent hover:opacity-75 hover:shadow-none active:text-white active:hover:bg-transparent" target="_blank" href="https://www.creative-tim.com/builder/soft-ui?ref=navbar-dashboard&amp;_ga=2.76518741.1192788655.1647724933-1242940210.1644448053">Online Builder</a>
              </li> -->

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
                <i fixed-plugin-button-nav class="cursor-pointer fa fa-cog"></i>
                <!-- fixed-plugin-button-nav  -->
              </a>
            </li>

            <!-- notifications -->

            <li class="relative flex items-center pr-2">
              <p class="hidden transform-dropdown-show"></p>
              <a href="javascript:;" class="block p-0 text-sm text-white transition-all ease-nav-brand" dropdown-trigger
                aria-expanded="false">
                <i class="cursor-pointer fa fa-bell"></i>
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

                <!-- Halaman 1: Data Administrasi -->
                <div id="page1">
                <p class="text-lg font-bold uppercase dark:text-white dark:opacity-60 mb-4">DATA ADMINISTRASI</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                    <label class="block mb-2 font-bold text-slate-700 dark:text-white/80">Nama Badan Usaha / Instansi / Perseorangan</label>
                    <input type="text" value="Perseroan Terbatas (PT)" readonly class="w-full px-3 py-2 text-sm bg-white-100 border border-gray-300 rounded-lg text-gray-700 focus:outline-none dark:bg-slate-700 dark:text-white">
                    </div>
                    <div>
                    <label class="block mb-2 font-bold text-slate-700 dark:text-white/80">Nama Pengguna</label>
                    <input type="text" value="Fahrul Uron" readonly class="w-full px-3 py-2 text-sm bg-white-100 border border-gray-300 rounded-lg text-gray-700 focus:outline-none dark:bg-slate-700 dark:text-white">
                    </div>
                    <div>
                    <label class="block mb-2 font-bold text-slate-700 dark:text-white/80">Kode KBLI</label>
                    <input type="text" value="5531" readonly class="w-full px-3 py-2 text-sm bg-white-100 border border-gray-300 rounded-lg text-gray-700 focus:outline-none dark:bg-slate-700 dark:text-white">
                    </div>
                    <div>
                    <label class="block mb-2 font-bold text-slate-700 dark:text-white/80">Judul KBLI</label>
                    <input type="text" value="Pertambangan dan Penggalian" readonly class="w-full px-3 py-2 text-sm bg-white-100 border border-gray-300 rounded-lg text-gray-700 focus:outline-none dark:bg-slate-700 dark:text-white">
                    </div>
                    <div>
                    <label class="block mb-2 font-bold text-slate-700 dark:text-white/80">No Tlp. / Hp</label>
                    <input type="text" value="0812345678" readonly class="w-full px-3 py-2 text-sm bg-white-100 border border-gray-300 rounded-lg text-gray-700 focus:outline-none dark:bg-slate-700 dark:text-white">
                    </div>
                    <div>
                    <label class="block mb-2 font-bold text-slate-700 dark:text-white/80">Email Perusahaan</label>
                    <input type="text" value="ptabcd@Ggmail.com" readonly class="w-full px-3 py-2 text-sm bg-white-100 border border-gray-300 rounded-lg text-gray-700 focus:outline-none dark:bg-slate-700 dark:text-white">
                    </div>
                </div>
                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                    <label class="block mb-2 font-bold text-slate-700 dark:text-white/80">Alamat Badan Usaha</label>
                    <input type="text" value="Jl. Arid Rahman Hakim No.30 A, Simpang IV Sipin, Kec.Telanaipura, Kota Jambi" readonly class="w-full px-3 py-2 text-sm bg-white-100 border border-gray-300 rounded-lg text-gray-700 focus:outline-none dark:bg-slate-700 dark:text-white">
                    </div>
                    <div>
                    <label class="block mb-2 font-bold text-slate-700 dark:text-white/80">NIB</label>
                    <input type="text" value="1234567890123" readonly class="w-full px-3 py-2 text-sm bg-white-100 border border-gray-300 rounded-lg text-gray-700 focus:outline-none dark:bg-slate-700 dark:text-white">
                    </div>
                    <div>
                    <label class="block mb-2 font-bold text-slate-700 dark:text-white/80">NPWP</label>
                    <input type="text" value="61.318.029.8-723.000" readonly class="w-full px-3 py-2 text-sm bg-white-100 border border-gray-300 rounded-lg text-gray-700 focus:outline-none dark:bg-slate-700 dark:text-white">
                    </div>
                </div>
                <div class="mt-6 flex justify-between">
                       <!-- Tombol Keluar -->
                      <a href="/daftarpermohonan"
                        class="inline-block px-5 py-2 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition">
                        Keluar
                      </a>
                      <button type="button" onclick="nextToPage3()" class="inline-block px-5 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                          Selanjutnya
                      </button>
                  </div>
                </div>

                <!-- Halaman 2: Data Teknis -->
                <div id="page2" class="hidden">
                  <h2 class="text-center font-bold text-lg bg-gray-100 p-3 rounded-t border-b border-gray-300">DATA INSTALASI PENYEDIAAN TENAGA LISTRIK</h2>

                <!-- Container 1: DATA INSTALASI | LAMPIRAN | EVALUASI -->
                 <div class="grid grid-cols-1 md:grid-cols-3 gap-4 border border-gray-200 rounded shadow-sm overflow-hidden p-4">
                  <!-- KOLOM 1: DATA INSTALASI -->
                  <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                    <h2 class="text-lg font-bold border-b pb-2 mb-2">Data Mesin (Penggerak Mula)</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto border-collapse border border-gray-300 text-sm text-left">
                          <thead class="bg-gray-100">
                              <tr id="header-SAMBUNGAN LISTRIK DARI PIHAK LAIN">
                                <th>Data Mesin</th>
                                <th>Unit 1</th>
                                <th>Unit 2</th>
                              </tr>
                            </thead>

                            <tbody id="body-SAMBUNGAN LISTRIK DARI PIHAK LAIN">
                              <tr>
                                <td class="text-middle align-middle">Jenis Penggerak¹</td>
                                <td class="text-middle align-middle">
                                  PLTBM
                                  <input type="hidden" name="jenis_1" value="nonSurya" readonly>
                                </td>
                                <td class="text-middle align-middle">
                                  PLTD
                                  <input type="hidden" name="jenis_2" value="nonSurya" readonly>
                                </td>
                              </tr>
                              <tr>
                                <td>Energi Primer Utama</td>
                                <td class="text-center align-middle">
                                  FIBER
                                  <input type="hidden" name="primer_1" value="nonSurya" readonly>
                                </td>
                                <td class="text-center align-middle">
                                  SOLAR
                                  <input type="hidden" name="primer_2" value="nonSurya" readonly>
                                </td>
                              </tr>
                              <tr>
                                <td>Merk/Tipe/Seri</td>
                                <td class="text-center align-middle">
                                  ELLIOT/DYRU G III/F202302-1
                                  <input type="hidden" name="merek_1" value="nonSurya" readonly>
                                </td>
                                <td class="text-center align-middle">
                                  CAMLER-BENZ/OM 444 LA/402.900-000-260938/1
                                  <input type="hidden" name="merek_2" value="nonSurya" readonly>
                                </td>
                              </tr>
                              <tr>
                                <td>Pabrikan/Tahun</td>
                                <td class="text-center align-middle">
                                  USA/2012
                                  <input type="hidden" name="pabrik_1" value="nonSurya" readonly>
                                </td>
                                <td class="text-center align-middle">
                                  JERMAN/-
                                  <input type="hidden" name="pabrik_2" value="nonSurya" readonly>
                                </td>
                              </tr>
                              <tr>
                                <td>Kapasitas (KW/KVA)</td>
                                <td class="text-center align-middle">
                                  2126
                                  <input type="hidden" name="kapasitas_1" value="nonSurya" readonly>
                                </td>
                                <td class="text-center align-middle">
                                  135
                                  <input type="hidden" name="kapasitas_2" value="nonSurya" readonly>
                                </td>
                              </tr>
                              <tr>
                                <td>Putaran (rpm)</td>
                                <td class="text-center align-middle">
                                  5500
                                  <input type="hidden" name="putaran_1" value="nonSurya" readonly>
                                </td>
                                <td class="text-center align-middle">
                                  1500
                                  <input type="hidden" name="putaran_2" value="nonSurya" readonly>
                                </td>
                              </tr>
                              <tr>
                                <td>Lokasi Unit (Kab/Kota)</td>
                                <td class="text-center align-middle">
                                  KAB. MUARO JAMBI
                                  <input type="hidden" name="lokasi_1" value="nonSurya" readonly>
                                </td>
                                <td class="text-center align-middle">
                                  KAB. MUARO JAMBI
                                  <input type="hidden" name="lokasi_2" value="nonSurya" readonly>
                                </td>
                              </tr>
                              <tr>
                                <td>Titik Kordinat</td>
                                <td class="text-center align-middle">
                                  S 103°43'36.85" E 1°31'47.95" S
                                  <input type="hidden" name="titikkoordinat_1" value="nonSurya" readonly>
                                </td>
                                <td class="text-center align-middle">
                                  S 103°43'36.99" E 1°31'47.88" S
                                  <input type="hidden" name="titikkoordinat_2" value="nonSurya" readonly>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>

                    <!-- KOLOM 2: LAMPIRAN -->
                    <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                      <h2 class="text-lg text-center font-bold border-b pb-2 mb-2">Lampiran</h2>
                      <div class="space-y-4 overflow-y-auto max-h-[500px] pr-2">
                        <div>
                            <p class="text-sm font-bold mb-2">Unit 1 (Gambar)</p><img src="../assets/img/mesinpenggerak.jpg" class="w-full rounded border mt-2" />
                          </div>
                          <div>
                            <p class="text-sm font-semibold mb-1">Nameplate Mesin Penggerak (Gambar)</p><img src="../assets/img/nameplatemesin.jpg" class="w-full rounded border mt-2" />
                          </div>
                          <div>
                            <p class="text-sm font-bold mb-2">Unit 2 (Gambar)</p><img src="../assets/img/generator.jpg" class="w-full rounded border mt-2" />
                          </div>
                          <div>
                            <p class="text-sm font-semibold mb-1">Nameplate Mesin Penggerak (Gambar)</p><img src="../assets/img/namemesin2.jpg" class="w-full rounded border mt-2" />
                          </div>
                        </div>
                      </div>

                    <!-- KOLOM 3: EVALUASI -->
                    <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                      <h2 class="text-lg text-center font-bold border-b pb-2 mb-2">Evaluasi</h2>
                      <label class="text-sm font-semibold">Catatan Perbaikan :</label>
                      <textarea rows="8" class="w-full p-2 border rounded text-sm" placeholder="Tulis catatan perbaikan..."></textarea>
                      <label class="text-sm font-semibold">Status Permohonan :</label>
                      <select class="w-full border p-2 rounded text-sm">
                        <option value="" disabled selected hidden>-- Status --</option>
                        <option>Disetujui</option>
                        <option>Ditolak</option>
                      </select>
                      <!-- Tombol Simpan 1 -->
                      <div class="pt-2">
                        <button onclick="tampilkanPopup1()" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded w-full">
                            Simpan Evaluasi 
                        </button>
                        </div>

                        <!-- Modal Pop-up 1 -->
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

                  <div class="mt-6 text-left">

                  </div>

                <!-- Container 2: DATA GENERATOR | LAMPIRAN | EVALUASI -->
                  <div class="grid grid-cols-1 md:grid-cols-3 gap-4 border border-gray-200 rounded shadow-sm overflow-hidden p-4">
                    <!-- KOLOM 1: DATA GENERATOR -->
                      <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                        <h2 class="text-lg font-bold border-b pb-2 mb-2">Data Generator</h2>
                        <div class="overflow-x-auto">
                         <table class="w-full table-auto border-collapse border border-gray-300 text-sm text-left">
                          <thead class="bg-gray-100">
                              <tr id="header-SAMBUNGAN LISTRIK DARI PIHAK LAIN">
                                <th>Data Generator</th>
                                <th>Unit 1</th>
                                <th>Unit 2</th>
                              </tr>
                            </thead>

                            <tbody id="body-SAMBUNGAN LISTRIK DARI PIHAK LAIN">
                              <tr>
                                <td class="text-middle align-middle">Merk/Tipe/Seri</td>
                                <td class="text-middle align-middle">
                                  ABB/SB-W4-2000-WA-34-1/603346
                                  <input type="hidden" name="merek_1" value="nonSurya" readonly>
                                </td>
                                <td class="text-middle align-middle">
                                  AVK/DKB-49/150-4TS/5133091
                                  <input type="hidden" name="merek_2" value="nonSurya" readonly>
                                </td>
                              </tr>
                              <tr>
                                <td>Pabrikan/Tahun</td>
                                <td class="text-center align-middle">
                                  -/2006
                                  <input type="hidden" name="pabrik_1" value="nonSurya" readonly>
                                </td>
                                <td class="text-center align-middle">
                                  JERMAN/-
                                  <input type="hidden" name="pabrik_2" value="nonSurya" readonly>
                                </td>
                              </tr>
                              <tr>
                                <td>Kapasitas (KW/KVA)</td>
                                <td class="text-center align-middle">
                                  2000 KW/2500 KVA
                                  <input type="hidden" name="kapasitas_1" value="nonSurya" readonly>
                                </td>
                                <td class="text-center align-middle">
                                  120 KW/150 KVA
                                  <input type="hidden" name="kapasitas_2" value="nonSurya" readonly>
                                </td>
                              </tr>
                              <tr>
                                <td>Tegangan</td>
                                <td class="text-center align-middle">
                                  400
                                  <input type="hidden" name="tegangan_1" value="nonSurya" readonly>
                                </td>
                                <td class="text-center align-middle">
                                  400
                                  <input type="hidden" name="tegangan_2" value="nonSurya" readonly>
                                </td>
                              </tr>
                              <tr>
                                <td>Arus (A)</td>
                                <td class="text-center align-middle">
                                  3608
                                  <input type="hidden" name="arus_1" value="nonSurya" readonly>
                                </td>
                                <td class="text-center align-middle">
                                  -
                                  <input type="hidden" name="arus_2" value="nonSurya" readonly>
                                </td>
                              </tr>
                              <tr>
                                <td>Faktor Daya</td>
                                <td class="text-center align-middle">
                                  0.8
                                  <input type="hidden" name="faktordaya_1" value="nonSurya" readonly>
                                </td>
                                <td class="text-center align-middle">
                                  0.8
                                  <input type="hidden" name="faktordaya_2" value="nonSurya" readonly>
                                </td>
                              </tr>
                              <tr>
                                <td>Fasa</td>
                                <td class="text-center align-middle">
                                  3
                                  <input type="hidden" name="fasa_1" value="nonSurya" readonly>
                                </td>
                                <td class="text-center align-middle">
                                  3
                                  <input type="hidden" name="fasa_2" value="nonSurya" readonly>
                                </td>
                              </tr>
                              <tr>
                                <td>Frekuensi (Hz)</td>
                                <td class="text-center align-middle">
                                  50
                                  <input type="hidden" name="frekuensi_1" value="nonSurya" readonly>
                                </td>
                                <td class="text-center align-middle">
                                  50
                                  <input type="hidden" name="frekuensi_2" value="nonSurya" readonly>
                                </td>
                              </tr>
                              <tr>
                                <td>Putaran (rpm)</td>
                                <td class="text-center align-middle">
                                  1500
                                  <input type="hidden" name="putaran_1" value="nonSurya" readonly>
                                </td>
                                <td class="text-center align-middle">
                                  1500
                                  <input type="hidden" name="putaran_2" value="nonSurya" readonly>
                                </td>
                              </tr>
                              <tr>
                                <td>Lokasi Unit (Kab/Kota)</td>
                                <td class="text-center align-middle">
                                  KAB. MUARO JAMBI
                                  <input type="hidden" name="lokasi_1" value="nonSurya" readonly>
                                </td>
                                <td class="text-center align-middle">
                                  KAB. MUARO JAMBI
                                  <input type="hidden" name="lokasi_2" value="nonSurya" readonly>
                                </td>
                              </tr>
                              <tr>
                                <td>Titik Kordinat²</td>
                                <td class="text-center align-middle">
                                  S 103°43'36.85" E 1°31'47.95" S
                                  <input type="hidden" name="titikkoordinat_1" value="nonSurya" readonly>
                                </td>
                                <td class="text-center align-middle">
                                  S 103°43'36.99" E 1°31'47.88" S
                                  <input type="hidden" name="titikkoordinat_2" value="nonSurya" readonly>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>

                    <!-- KOLOM 2: LAMPIRAN -->
                      <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                        <h2 class="text-lg text-center font-bold border-b pb-2 mb-2">Lampiran</h2>
                        <div class="space-y-4 overflow-y-auto max-h-[500px] pr-2">
                          <div>
                            <p class="text-sm font-bold mb-2">Unit 1 (Gambar)</p><img src="../assets/img/mesinpenggerak.jpg" class="w-full rounded border mt-2" />
                          </div>
                          <div>
                            <p class="text-sm font-semibold mb-1">Nameplate Generator (Gambar)</p><img src="../assets/img/namegenerator.jpg" class="w-full rounded border mt-2" />
                          </div>
                          <div>
                            <p class="text-sm font-bold mb-2">Unit 2 (Gambar)</p><img src="../assets/img/generator.jpg" class="w-full rounded border mt-2" />
                          </div>
                          <div>
                            <p class="text-sm font-semibold mb-1">Nameplate Generator (Gambar)</p><img src="../assets/img/namegenerator2.jpg" class="w-full rounded border mt-2" />
                          </div>
                        </div>
                      </div>

                    <!-- KOLOM 3: Evaluasi (copy) -->
                      <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                        <h2 class="text-lg text-center font-bold border-b pb-2 mb-2">Evaluasi</h2>
                        <label class="text-sm font-semibold">Catatan Perbaikan :</label>
                        <textarea rows="8" class="w-full p-2 border rounded text-sm" placeholder="Tulis catatan perbaikan..."></textarea>
                        <label class="text-sm font-semibold">Status Permohonan :</label>
                        <select class="w-full border p-2 rounded text-sm">
                          <option value="" disabled selected hidden>-- Status --</option>
                          <option>Disetujui</option>
                          <option>Ditolak</option>
                        </select>
                         <!-- Tombol Simpan 2 -->
                         <div class="pt-2 mt-6">
                        <button onclick="tampilkanPopup2()" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded w-full">
                            Simpan Evaluasi
                        </button>
                        </div>

                        <!-- Modal Pop-up 2 -->
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

                <!-- Container 3: SAMBUNGAN LISTRIK DARI PIHAK LAIN | LAMPIRAN | EVALUASI -->
                      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 border border-gray-200 rounded shadow-sm overflow-hidden p-4">
                      <!-- KOLOM 1: SAMBUNGAN LISTRIK DARI PIHAK LAIN -->
                      <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                        <h2 class="text-lg font-bold border-b pb-2 mb-2">Sambungan Lsitrik Dari Pihak Lain</h2>
                        <div class="overflow-x-auto">
                         <table class="w-full table-auto border-collapse border border-gray-300 text-sm text-left">
                          <thead class="bg-gray-100">
                              <tr id="header-SAMBUNGAN LISTRIK DARI PIHAK LAINa">
                                <th rowspan="2">Jenis Instalasi</th>
                                <th rowspan="2">Pemilik Instalasi</th>
                                <th rowspan="2">Tegangan (kV)</th>
                                <th rowspan="2">Kapasitas Unit Terpasang (MVA) atau Panjang Saluran (kms)</th>
                                <th colspan="3">Lokasi</th>
                                <th rowspan="2">COD / Rencana COD</th>
                              </tr>
                              <tr>
                                <th>Kabupaten/Kota</th>
                                <th>Provinsi</th>
                                <th>Koordinat</th>
                              </tr>
                            </thead>
                            <tbody id="body-SAMBUNGAN LISTRIK DARI PIHAK LAIN">
                              <tr>
                                <td>Jaringan/Saluran Distribusi</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                              </tr>
                              <tr>
                                <td>Transformator</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                              </tr>
                            </tbody>
                          </table>
                          </div>
                    </div>

                    <!-- KOLOM 2: LAMPIRAN -->
                    <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                      <h2 class="text-lg text-center font-bold border-b pb-2 mb-2">Lampiran</h2>

                      <div class="space-y-4 overflow-y-auto max-h-[500px] pr-2">
                        <div>
                          <p class="text-sm font-semibold mb-1">Bukti Tagihan Listrik (Gambar)</p><img src="../assets/img/tagihan.jpg" class="w-full rounded border mt-2" />
                        </div>
                      </div>
                    </div>

                    <!-- KOLOM 3: Evaluasi (copy) -->
                    <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                      <h2 class="text-lg text-center font-bold border-b pb-2 mb-2">Evaluasi</h2>
                      <label class="text-sm font-semibold">Catatan Perbaikan :</label>
                      <textarea rows="8" class="w-full p-2 border rounded text-sm" placeholder="Tulis catatan perbaikan..."></textarea>
                      <label class="text-sm font-semibold">Status Permohonan :</label>
                      <select class="w-full border p-2 rounded text-sm">
                        <option value="" disabled selected hidden>-- Status --</option>
                        <option>Disetujui</option>
                        <option>Ditolak</option>
                      </select>
                      <!-- Tombol Simpan 3 -->
                      <div class="pt-2 mt-6">
                        <button onclick="tampilkanPopup3()" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded w-full">
                            Simpan Evaluasi 
                        </button>
                        </div>

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

                  <div class="mt-6 flex justify-between">
                      <button onclick="prevPage()" type="button" class="inline-block px-5 py-2 bg-green-400 text-white font-semibold rounded-lg hover:bg-green-500 transition">
                          Kembali
                      </button>
                      <button type="button" onclick="nextToPage3()" class="inline-block px-5 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                          Selanjutnya
                      </button>
                  </div>
                </div>
              </div>
            </div>
            <script>
                function nextPage() {
                    // Dari Halaman 1 ke Halaman 2
                    document.getElementById("page1").classList.add("hidden");
                    document.getElementById("page2").classList.remove("hidden");

                    // Scroll ke atas halaman
                    window.scrollTo({ top: 0, behavior: "auto" });
                }

                function prevPage() {
                    // Dari Halaman 2 ke Halaman 1
                    document.getElementById("page2").classList.add("hidden");
                    document.getElementById("page1").classList.remove("hidden");

                    // Scroll ke atas halaman
                    requestAnimationFrame(() => {
                        document.getElementById("page1").scrollIntoView({ behavior: "auto", block: "start" });
                    });
                }

                function nextToPage3() {
                    // Dari Halaman 2 ke Halaman 3
                    document.getElementById("page2").classList.add("hidden");
                    document.getElementById("page3").classList.remove("hidden");

                    window.scrollTo({ top: 0, behavior: "auto" });
                }

                function backToPage2() {
                    // Dari Halaman 3 ke Halaman 2
                    document.getElementById("page3").classList.add("hidden");
                    document.getElementById("page2").classList.remove("hidden");

                    requestAnimationFrame(() => {
                        document.getElementById("page2").scrollIntoView({ behavior: "auto", block: "start" });
                    });
                }
            </script>

                <!-- HALAMAN 3 : KAPASITAS PRODUKSI TENAGA LISTRIK  -->
                <div id="page3" class="hidden">
                  <h2 class="text-center font-bold text-lg bg-gray-100 p-3 rounded-t border-b border-gray-300">Kapasitas Produk Tenaga Listrik</h2>

                  <!-- Container 4: PEMAKAIAN SENDIRI | EVALUASI -->
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 border border-gray-200 rounded shadow-sm overflow-hidden p-4">
                    <!-- KOLOM 1: DATA PEMAKAIAN SENDIRI -->
                    <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                      <h2 class="text-lg font-bold border-b pb-2 mb-2">PLTBm</h2>
                      <div class="overflow-x-auto">
                        <table class="w-full table-auto border-collapse border border-gray-300 text-sm text-left">
                          <thead class="bg-gray-100">
                              <tr id="header-PLTBm">
                                <th>Bulan</th>
                                <th>Total Kapasitas Pembangkit (KVA)</th>
                                <th>Faktor Daya (Cos)</th>
                                <th>Jam Nyala (Waktu Pengoprasian)(Jam)</th>
                                <th>Daya Terpakai (kWh)</th>
                              </tr>
                            </thead>

                            <tbody id="body-SAMBUNGAN LISTRIK DARI PIHAK LAIN">
                              <tr>
                                <td class="text-middle align-middle">Januari</td>
                                <td class="text-middle align-middle">
                                  2.500 kVA/2.000 Kw
                                  <input type="hidden" name="jenis_1" value="nonSurya" readonly>
                                </td>
                                <td class="text-middle align-middle">
                                  0.8
                                  <input type="hidden" name="jenis_2" value="nonSurya" readonly>
                                </td>
                                <td class="text-middle align-middle">
                                 -
                                  <input type="hidden" name="jenis_2" value="nonSurya" readonly>
                                </td>
                                <td class="text-middle align-middle">
                                 -
                                  <input type="hidden" name="jenis_2" value="nonSurya" readonly>
                                </td>
                              </tr>
                              <tr>
                                <td>Februari</td>
                                <td class="text-center align-middle">
                                  2.500 kVA/2.000 Kw
                                  <input type="hidden" name="pabrik_1" value="nonSurya" readonly>
                                </td>
                                <td class="text-center align-middle">
                                  0.8
                                  <input type="hidden" name="pabrik_2" value="nonSurya" readonly>
                                </td>
                                <td class="text-middle align-middle">
                                 -
                                  <input type="hidden" name="jenis_2" value="nonSurya" readonly>
                                </td>
                                <td class="text-middle align-middle">
                                 -
                                  <input type="hidden" name="jenis_2" value="nonSurya" readonly>
                                </td>
                              </tr>
                              <tr>
                                <td>Maret</td>
                                <td class="text-center align-middle">
                                  2.500 kVA/2.000 Kw
                                  <input type="hidden" name="pabrik_1" value="nonSurya" readonly>
                                </td>
                                <td class="text-center align-middle">
                                  0.8
                                  <input type="hidden" name="pabrik_2" value="nonSurya" readonly>
                                </td>
                                <td class="text-middle align-middle">
                                 -
                                  <input type="hidden" name="jenis_2" value="nonSurya" readonly>
                                </td>
                                <td class="text-middle align-middle">
                                 -
                                  <input type="hidden" name="jenis_2" value="nonSurya" readonly>
                                </td>
                              </tr>
                              <tr>
                                <td>April</td>
                                <td class="text-center align-middle">
                                  2.500 kVA/2.000 Kw
                                  <input type="hidden" name="pabrik_1" value="nonSurya" readonly>
                                </td>
                                <td class="text-center align-middle">
                                  0.8
                                  <input type="hidden" name="pabrik_2" value="nonSurya" readonly>
                                </td>
                                <td class="text-middle align-middle">
                                 -
                                  <input type="hidden" name="jenis_2" value="nonSurya" readonly>
                                </td>
                                <td class="text-middle align-middle">
                                 -
                                  <input type="hidden" name="jenis_2" value="nonSurya" readonly>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>

                      <!-- KOLOM 2: Evaluasi (copy) -->
                      <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                        <h2 class="text-lg text-center font-bold border-b pb-2 mb-2">Evaluasi</h2>
                        <label class="text-sm font-semibold">Catatan Perbaikan :</label>
                        <textarea rows="8" class="w-full p-2 border rounded text-sm" placeholder="Tulis catatan perbaikan..."></textarea>
                        <label class="text-sm font-semibold">Status Permohonan :</label>
                        <select class="w-full border p-2 rounded text-sm">
                          <option value="" disabled selected hidden>-- Status --</option>
                          <option>Disetujui</option>
                          <option>Ditolak</option>
                        </select>
                        <!-- Tombol Simpan 4 -->
                        <div class="pt-2 mt-6">
                          <button onclick="tampilkanPopup4()" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded w-full">
                            Simpan Evaluasi
                          </button>
                        </div>

                        <!-- Modal Pop-up 4 -->
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


                  <!--Container : GENSET/PLTD -->
                  <div class="grid grid-cols-1 gap-4 border-gray-200 rounded shadow-sm">
                    <!-- KOLOM 1: GENSET / PLTD -->
                    <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                        <h2 class="text-lg text-center font-bold border-b pb-2 mb-2">Genset / PLTD</h2>
                      <div class="overflow-x-auto">
                        <table class="w-full table-auto border-collapse border border-gray-300 text-sm text-left">
                          <thead class="bg-gray-100">
                              <tr id="header-Genset / PLTD">
                                <th>Bulan</th>
                                <th>Total Kapasitas Pembangkit (KVA)</th>
                                <th>Faktor Daya (Cos)</th>
                                <th>Jam Nyala (Waktu Pengoprasian)(Jam)</th>
                                <th>Daya Terpakai (kWh)</th>
                              </tr>
                            </thead>

                            <tbody id="body-Genset / PLTD">
                              <tr>
                                <td class="text-middle align-middle">Januari</td>
                                <td class="text-middle align-middle">
                                  2.500 kVA/2.000 Kw
                                  <input type="hidden" name="jenis_1" value="nonSurya" readonly>
                                </td>
                                <td class="text-middle align-middle">
                                  0.8
                                  <input type="hidden" name="jenis_2" value="nonSurya" readonly>
                                </td>
                                <td class="text-middle align-middle">
                                 -
                                  <input type="hidden" name="jenis_2" value="nonSurya" readonly>
                                </td>
                                <td class="text-middle align-middle">
                                 -
                                  <input type="hidden" name="jenis_2" value="nonSurya" readonly>
                                </td>
                              </tr>
                              <tr>
                                <td>Februari</td>
                                <td class="text-center align-middle">
                                  2.500 kVA/2.000 Kw
                                  <input type="hidden" name="pabrik_1" value="nonSurya" readonly>
                                </td>
                                <td class="text-center align-middle">
                                  0.8
                                  <input type="hidden" name="pabrik_2" value="nonSurya" readonly>
                                </td>
                                <td class="text-middle align-middle">
                                 -
                                  <input type="hidden" name="jenis_2" value="nonSurya" readonly>
                                </td>
                                <td class="text-middle align-middle">
                                 -
                                  <input type="hidden" name="jenis_2" value="nonSurya" readonly>
                                </td>
                              </tr>
                              <tr>
                                <td>Maret</td>
                                <td class="text-center align-middle">
                                  2.500 kVA/2.000 Kw
                                  <input type="hidden" name="pabrik_1" value="nonSurya" readonly>
                                </td>
                                <td class="text-center align-middle">
                                  0.8
                                  <input type="hidden" name="pabrik_2" value="nonSurya" readonly>
                                </td>
                                <td class="text-middle align-middle">
                                 -
                                  <input type="hidden" name="jenis_2" value="nonSurya" readonly>
                                </td>
                                <td class="text-middle align-middle">
                                 -
                                  <input type="hidden" name="jenis_2" value="nonSurya" readonly>
                                </td>
                              </tr>
                              <tr>
                                <td>April</td>
                                <td class="text-center align-middle">
                                  2.500 kVA/2.000 Kw
                                  <input type="hidden" name="pabrik_1" value="nonSurya" readonly>
                                </td>
                                <td class="text-center align-middle">
                                  0.8
                                  <input type="hidden" name="pabrik_2" value="nonSurya" readonly>
                                </td>
                                <td class="text-middle align-middle">
                                 -
                                  <input type="hidden" name="jenis_2" value="nonSurya" readonly>
                                </td>
                                <td class="text-middle align-middle">
                                 -
                                  <input type="hidden" name="jenis_2" value="nonSurya" readonly>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>

                      <!-- KOLOM 2: Evaluasi (copy) -->
                      <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                        <h2 class="text-lg text-center font-bold border-b pb-2 mb-2">Evaluasi</h2>
                        <label class="text-sm font-semibold">Catatan Perbaikan :</label>
                        <textarea rows="8" class="w-full p-2 border rounded text-sm" placeholder="Tulis catatan perbaikan..."></textarea>
                        <label class="text-sm font-semibold">Status Permohonan :</label>
                        <select class="w-full border p-2 rounded text-sm">
                          <option value="" disabled selected hidden>-- Status --</option>
                          <option>Disetujui</option>
                          <option>Ditolak</option>
                        </select>
                        <!-- Tombol Simpan 5 -->
                        <div class="pt-2 mt-6">
                          <button onclick="tampilkanPopup5()" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded w-full">
                            Simpan Evaluasi
                          </button>
                        </div>

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

                <!--Penjualan kelebihan tenaga listrik/Excess Power. -->
                  <div class="grid grid-cols-1 gap-4 border-gray-200 rounded shadow-sm">
                    <!-- KOLOM 1: Penjualan kelebihan tenaga listrik -->
                    <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                      <h2 class="text-lg font-bold border-b pb-2 mb-2">Penjualan kelebihan tenaga listrik</h2>
                      <div class="overflow-x-auto">
                        <table class="w-full table-auto border-collapse border border-gray-300 text-sm text-left">
                          <thead class="bg-gray-100">
                            <tr>
                              <th rowspan="3">Bulan</th>
                              <th colspan="9">Nama Pembangkit</th>
                            </tr>
                            <tr>
                              <th rowspan="2">DMN/NDC<sup>1</sup><br>(MW)</th>
                              <th rowspan="2">Beban Tertinggi<br>(MW)</th>
                              <th rowspan="2">Capacity Factor<br>(CF)</th>
                              <th colspan="2">Availability Factor (AF)<sup>2</sup></th>
                              <th colspan="4">Neraca Energi</th>
                            </tr>
                            <tr>
                              <th>AFom (%)</th>
                              <th>AFa (%)</th>
                              <th>Pembelian (kWh)</th>
                              <th>Produksi Bruto (kWh)</th>
                              <th>Pemakaian Sendiri (kWh)</th>
                              <th>Produksi Netto Ea (kWh)</th>
                            </tr>
                          </thead>
                                <tbody>
                                  <tr>
                                    <td>Januari</td>
                                    <td>10</td>
                                    <td>9</td>
                                    <td>85%</td>
                                    <td>90%</td>
                                    <td>95%</td>
                                    <td>10000</td>
                                    <td>20000</td>
                                    <td>1000</td>
                                    <td>19000</td>
                                  </tr>
                                  <tr>
                                    <td>Februari</td>
                                    <td>10</td>
                                    <td>8.5</td>
                                    <td>82%</td>
                                    <td>91%</td>
                                    <td>94%</td>
                                    <td>10500</td>
                                    <td>20500</td>
                                    <td>1200</td>
                                    <td>19300</td>
                                  </tr>
                                  <!-- Tambah baris berikutnya sesuai kebutuhan -->
                                  <tr>
                                    <td>dst</td>
                                    <td colspan="9"></td>
                                  </tr>
                                </tbody>
                        </table>
                      </div>
                    </div>
                  </div>

                      <!-- KOLOM 2: Evaluasi (copy) -->
                      <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                        <h2 class="text-lg text-center font-bold border-b pb-2 mb-2">Evaluasi</h2>
                        <label class="text-sm font-semibold">Catatan Perbaikan :</label>
                        <textarea rows="8" class="w-full p-2 border rounded text-sm" placeholder="Tulis catatan perbaikan..."></textarea>
                        <label class="text-sm font-semibold">Status Permohonan :</label>
                        <select class="w-full border p-2 rounded text-sm">
                          <option value="" disabled selected hidden>-- Status --</option>
                          <option>Disetujui</option>
                          <option>Ditolak</option>
                        </select>
                         <!-- Tombol Simpan 6 -->
                         <div class="pt-2 mt-6">
                          <button onclick="tampilkanPopup6()" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded w-full">
                            Simpan Evaluasi
                          </button>
                        </div>

                        <!-- Modal Pop-up 6 -->
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

                  <!-- Tombol Navigasi -->
                  <div class="w-full flex justify-between mt-6">
                    <button onclick="backToPage2()" type="button" class="px-5 py-2 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-600 transition">
                      Kembali
                    <button 
                      type="button" 
                      onclick="showPopup()"
                      class="inline-block px-5 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                      Kirim Hasil Evaluasi
                  </button>
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
                </div>
      
      <script>
        function showPage(hideId, showId) {
          const hidePage = document.getElementById(hideId);
          const showPage = document.getElementById(showId);

          if (!hidePage) {
            console.error("Element not found to hide:", hideId);
            return;
          }
          if (!showPage) {
            console.error("Element not found to show:", showId);
            return;
          }

          hidePage.classList.add("hidden");
          showPage.classList.remove("hidden");

          // Scroll ke atas halaman baru
          requestAnimationFrame(() => {
            showPage.scrollIntoView({ behavior: "auto", block: "start" });
          });
        }

        function nextPage() {
          showPage("page1", "page2");
        }

        function prevPage() {
          showPage("page2", "page1");
        }

        function nextToPage3() {
          showPage("page2", "page3");
        }

        function backToPage2() {
          showPage("page3", "page2");
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
                  </script>

</body>
<!-- plugin for charts  -->
<script src="../assets/js/plugins/chartjs.min.js" async></script>
<!-- plugin for scrollbar  -->
<script src="../assets/js/plugins/perfect-scrollbar.min.js" async></script>
<!-- main script file  -->
<script src="../assets/js/argon-dashboard-tailwind.js?v=1.0.1" async></script>

</html>