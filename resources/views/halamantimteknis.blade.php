<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/png" href=" {{ asset('assets/img/logo-esdm.svg') }} " />
  <title>Daftar Pengajuan</title>
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

<body class="m-0 font-sans text-base antialiased font-normal dark:bg-slate-900 leading-default bg-gray-50 text-slate-500">
    <div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>
    

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
                <h4 class="text-lg font-bold mb-4 text-gray-700 dark:text-white text-center uppercase">Data Teknis</h4>

                <!-- Halaman 1: Data Administrasi -->
                <div id="page1">
                <p class="text-lg font-bold uppercase dark:text-white dark:opacity-90 mb-4">DATA ADMINISTRASI</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                    <label class="block mb-2 text-m font-bold text-slate-700 dark:text-white/80">Nama Badan Usaha / Instansi / Perseorangan</label>
                    <input type="text" value="Perseroan Terbatas (PT)" readonly class="w-full px-3 py-2 text-sm bg-white-100 border border-gray-300 rounded-lg text-gray-700 focus:outline-none dark:bg-slate-700 dark:text-white">
                    </div>
                    <div>
                    <label class="block mb-2 text-m font-bold text-slate-700 dark:text-white/80">Nama Pengguna</label>
                    <input type="text" value="Fahrul Uron" readonly class="w-full px-3 py-2 text-sm bg-white-100 border border-gray-300 rounded-lg text-gray-700 focus:outline-none dark:bg-slate-700 dark:text-white">
                    </div>
                    <div>
                    <label class="block mb-2 text-m font-bold text-slate-700 dark:text-white/80">Kode KBLI</label>
                    <input type="text" value="55311" readonly class="w-full px-3 py-2 text-sm bg-white-100 border border-gray-300 rounded-lg text-gray-700 focus:outline-none dark:bg-slate-700 dark:text-white">
                    </div>
                    <div>
                    <label class="block mb-2 text-m font-bold text-slate-700 dark:text-white/80">Judul KBLI</label>
                    <input type="text" value="Pertambangan dan Penggalian" readonly class="w-full px-3 py-2 text-sm bg-white-100 border border-gray-300 rounded-lg text-gray-700 focus:outline-none dark:bg-slate-700 dark:text-white">
                    </div>
                    <div>
                    <label class="block mb-2 text-m font-bold text-slate-700 dark:text-white/80">No Tlp. / Hp</label>
                    <input type="text" value="0812345678" readonly class="w-full px-3 py-2 text-sm bg-white-100 border border-gray-300 rounded-lg text-gray-700 focus:outline-none dark:bg-slate-700 dark:text-white">
                    </div>
                    <div>
                    <label class="block mb-2 text-m font-bold text-slate-700 dark:text-white/80">Email Perusahaan</label>
                    <input type="text" value="ptabcd@Ggmail.com" readonly class="w-full px-3 py-2 text-sm bg-white-100 border border-gray-300 rounded-lg text-gray-700 focus:outline-none dark:bg-slate-700 dark:text-white">
                    </div>
                </div>
                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                    <label class="block mb-2 text-m font-bold text-slate-700 dark:text-white/80">Alamat Badan Usaha</label>
                    <input type="text" value="Jl. Arid Rahman Hakim No.30 A, Simpang IV Sipin, Kec.Telanaipura, Kota Jambi" readonly class="w-full px-3 py-2 text-sm bg-white-100 border border-gray-300 rounded-lg text-gray-700 focus:outline-none dark:bg-slate-700 dark:text-white">
                    </div>
                    <div>
                    <label class="block mb-2 text-m font-bold text-slate-700 dark:text-white/80">NIB</label>
                    <input type="text" value="1234567890123" readonly class="w-full px-3 py-2 text-sm bg-white-100 border border-gray-300 rounded-lg text-gray-700 focus:outline-none dark:bg-slate-700 dark:text-white">
                    </div>
                    <div>
                    <label class="block mb-2 text-m font-bold text-slate-700 dark:text-white/80">NPWP</label>
                    <input type="text" value="61.318.029.8-723.000" readonly class="w-full px-3 py-2 text-sm bg-white-100 border border-gray-300 rounded-lg text-gray-700 focus:outline-none dark:bg-slate-700 dark:text-white">
                    </div>
                </div>
                <div class="mt-6 text-right">
                    <button onclick="nextPage()" type="button" class="inline-block px-5 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                    Next
                    </button>
                </div>
                </div>

        <!-- Halaman 2: Data Teknis -->
        <div id="page2" class="hidden">
          <!-- Anda bisa meletakkan isi dari HALAMAN DATA TEKNIS DI SINI sesuai yang sudah Anda sediakan -->
          <p class="text-lg font-bold uppercase dark:text-white dark:opacity-60 mb-4">DATA TEKNIS</p>
                  <div class="flex flex-wrap -mx-3">
                    <div class="w-full max-w-full px-3 shrink-0 md:w-full md:flex-0">

                      <label class="block text-m font-medium text-gray-700 mb-2">
                        Data Pembangkit Tenaga Listrik
                      </label>
                      <p class="w-full border px-4 py-2 rounded mb-4 bg-gray-100">
                        Pembangkit Listrik Selain Tenaga Surya
                      </p>
                      <!-- FORM NON SURYA -->
                      <div id="form-nonSurya" class="">
                        <h3 class="font-semibold mb-2"></h3>
                        <div class="overflow-scroll">
                          <table id="table-nonSurya"  class="block text-m font-medium text-gray-700 mb-2">
                            <thead>
                              <tr id="header-nonSurya">
                                <th>Spesifikasi</th>
                                <th>Unit 1</th>
                                <th>Unit 2</th>
                              </tr>
                            </thead>

                            <tbody id="body-nonSurya">
                              <tr>
                                <td class="text-middle align-middle">Jenis Penggerak</td>
                                <td class="text-middle align-middle">
                                  Turbin Uap
                                  <input type="hidden" name="jenis_1" value="nonSurya" readonly>
                                </td>
                                <td class="text-middle align-middle">
                                  Mesin Diesel
                                  <input type="hidden" name="jenis_2" value="nonSurya" readonly>
                                </td>
                              </tr>
                              <tr>
                                <td>Merek</td>
                                <td class="text-center align-middle">
                                  Elliott
                                  <input type="hidden" name="merek_1" value="nonSurya" readonly>
                                </td>
                                <td class="text-center align-middle">
                                  FG WILSON
                                  <input type="hidden" name="merek_2" value="nonSurya" readonly>
                                </td>
                              </tr>
                              <tr>
                                <td>Tipe</td>
                                <td class="text-center align-middle">
                                  DYRUG III
                                  <input type="hidden" name="tipe_1" value="nonSurya" readonly>
                                </td>
                                <td class="text-center align-middle">
                                  D2840LE201
                                  <input type="hidden" name="tipe_2" value="nonSurya" readonly>
                                </td>
                              </tr>
                              <tr>
                                <td>Negara Pembuat</td>
                                <td class="text-center align-middle">
                                  USA
                                  <input type="hidden" name="negara_1" value="nonSurya" readonly>
                                </td>
                                <td class="text-center align-middle">
                                  GERMANY
                                  <input type="hidden" name="negara_2" value="nonSurya" readonly>
                                </td>
                              </tr>
                              <tr>
                                <td>Tahun Pembuatan</td>
                                <td class="text-center align-middle">
                                  2010
                                  <input type="hidden" name="tahun_1" value="nonSurya" readonly>
                                </td>
                                <td class="text-center align-middle">
                                  2009
                                  <input type="hidden" name="tahun_2" value="nonSurya" readonly>
                                </td>
                              </tr>
                              <tr>
                                <td>Kapasitas (kW)</td>
                                <td class="text-center align-middle">
                                  1488
                                  <input type="hidden" name="kapasitas_1" value="nonSurya" readonly>
                                </td>
                                <td class="text-center align-middle">
                                  496
                                  <input type="hidden" name="kapasitas_2" value="nonSurya" readonly>
                                </td>
                              </tr>
                              <tr>
                                <td>Energi Primer</td>
                                <td class="text-center align-middle">
                                  <input type="hidden" name="primer_1" value="nonSurya" readonly>
                                </td>
                                <td class="text-center align-middle">
                                  <input type="hidden" name="primer_2" value="nonSurya" readonly>
                                </td>
                              </tr>
                              <tr>
                                <td>Titik Kordinat (Latitude)</td>
                                <td class="text-center align-middle">
                                  -1.234567
                                  <input type="hidden" name="titikkoordinat_1" value="nonSurya" readonly>
                                </td>
                                <td class="text-center align-middle">
                                  -1.234567
                                  <input type="hidden" name="titikkoordinat_2" value="nonSurya" readonly>
                                </td>
                              </tr>
                              <tr>
                                <td>Titik Kordinat (Longitude)</td>
                                <td class="text-center align-middle">
                                  103.456789
                                  <input type="hidden" name="titikkoordinat_1" value="nonSurya" readonly>
                                </td>
                                <td class="text-center align-middle">
                                  103.456789
                                  <input type="hidden" name="titikkoordinat_2" value="nonSurya" readonly>
                                </td>
                              </tr>
                              <tr>
                                <td>Sifat Penggunaan</td>
                                <td class="text-center align-middle">
                                  Darurat
                                  <input type="hidden" name="sifatpenggunaan_1" value="nonSurya" readonly>
                                </td>
                                <td class="text-center align-middle">
                                  Sementara
                                  <input type="hidden" name="sifatpenggunaan_2" value="nonSurya" readonly>
                                </td>
                              </tr>
                            </tbody>

                          </table>
                        </div>
                      </div>

                      <!-- Bagian 2: Jaringan Distribusi -->
                      <div class="mb-4">

                        <!-- Form Tambahan Jaringan Distribusi -->

                        <div id="form-jaringan" class="">
                          <div class="mb-4">
                            <label for="panjangSaluran" class="block text-m font-medium text-gray-700">Panjang Saluran (Kms)</label>
                            <input type="text" id="panjangSaluran" name="panjang_saluran"
                              class="mt-1 w-full p-2 border rounded dark:bg-slate-700 dark:text-white"
                              placeholder="13,00"
                              pattern="^\d+(,\d{1,2})?$"
                              title="Gunakan angka bulat atau dengan koma maksimal dua angka desimal, misal: 220, 220,5 atau 220,50"
                              readonly>
                          </div>

                          <div class="mb-4">
                            <label for="tegangan" class="block text-m font-medium text-gray-700">Tegangan (Volt)</label>
                            <input type="text" id="tegangan" name="tegangan"
                              class="mt-1 w-full p-2 border rounded dark:bg-slate-700 dark:text-white"
                              placeholder="220,00"
                              pattern="^\d+(,\d{1,2})?$"
                              title="Gunakan angka bulat atau dengan koma maksimal dua angka desimal, misal: 220, 220,5 atau 220,50"
                              readonly>
                          </div>
                        </div>

                        <script>
                          function formatKomaOnly(event) {
                            let input = event.target.value;

                            // Hapus semua karakter kecuali angka dan koma
                            input = input.replace(/[^0-9,]/g, '');

                            // Izinkan hanya satu koma
                            const parts = input.split(',');
                            if (parts.length > 2) {
                              input = parts[0] + ',' + parts[1]; // hapus koma tambahan
                            }

                            // Batasi 2 angka setelah koma jika ada
                            if (parts.length === 2) {
                              parts[1] = parts[1].substring(0, 2);
                              input = parts[0] + ',' + parts[1];
                            }

                            event.target.value = input;
                          }

                          document.getElementById("panjangSaluran").addEventListener("input", formatKomaOnly);
                          document.getElementById("tegangan").addEventListener("input", formatKomaOnly);
                        </script>

                        <!-- Bagian 3: Sambungan Listrik dari Pihak Lain -->
                        <div class="mb-4">
                          
                          <!-- Form Tambahan Jika "Ada" -->
                          <div id="form-sambungan" class="">
                            <div class="mb-4">
                              <label for="pihakLain" class="block text-m font-medium text-gray-700">Dari Pihak
                                Lain</label>
                              <input type="text" id="pihakLain" name="pihak_lain"
                                class="mt-1 w-full p-2 border rounded dark:bg-slate-700 dark:text-white"
                                placeholder="PT. PLN" readonly>
                            </div>

                            <div class="mb-4">
                              <label for="dayaTersambung" class="block text-m font-medium text-gray-700">Daya Tersambung
                                (kVA)</label>
                              <input type="text" id="dayaTersambung" name="daya_tersambung"
                                class="mt-1 w-full p-2 border rounded dark:bg-slate-700 dark:text-white"
                                placeholder="50,00"
                                pattern="^\d+(,\d{1,2})?$"
                                title="Gunakan angka bulat atau dengan koma maksimal dua angka desimal, misal: 50, 50,5 atau 50,00"
                                readonly>
                            </div>
                          </div>
                        </div>

                        <script>
                          function toggleJaringanDistribusi() {
                            const value = document.getElementById("jaringanDistribusi").value;
                            const form = document.getElementById("form-jaringan");
                            form.classList.toggle("hidden", value !== "ada");
                          }

                          function toggleSambunganForm() {
                            const value = document.getElementById("sambunganListrik").value;
                            const form = document.getElementById("form-sambungan");
                            form.classList.toggle("hidden", value !== "ada");
                          }

                          function formatKomaOnly(event) {
                            const input = event.target;
                            // hanya izinkan angka dan koma
                            let value = input.value.replace(/[^\d,]/g, '');

                            // jika ada koma, potong hanya 2 digit setelahnya
                            if (value.includes(',')) {
                              const parts = value.split(',');
                              const decimal = parts[1].slice(0, 2); // maksimal 2 angka di belakang koma
                              value = parts[0] + ',' + decimal;
                            }

                            input.value = value;
                          }

                          // Daftar ID input yang butuh format angka + koma maksimal 2 angka
                          const inputIds = ["panjangSaluran", "tegangan", "dayaTersambung"];
                          inputIds.forEach(id => {
                            const el = document.getElementById(id);
                            if (el) el.addEventListener("input", formatKomaOnly);
                          });
                        </script>


                        <!--Lokasi Instalasi Penyedia Tenaga Listrik-->

                        <div class="flex flex-wrap -mx-3">
                          <div class="w-full max-w-full px-3 shrink-0 md:w-full md:flex-0">
                            <div id="alamatForm" class="mb-4">

                              <div class="mb-4">
                              <label for="addressjl" class="block text-sm font-medium text-gray-700 mb-1">Nama Jalan</label>
                              <input type="text" id="addressjl" name="addressjl"
                                value="JL. Tanah Tumbuh"
                                class="mt-1 w-full px-3 py-2 border rounded text-sm dark:bg-slate-700 dark:text-white"
                                readonly>
                            </div>


                            <div class="mb-4">
                              <label for="addressjl" class="block text-sm font-medium text-gray-700 mb-1">Desa / Kelurahan </label>
                              <input type="text" id="addressjl" name="addressjl"
                                value="Sungai Gambir"
                                class="mt-1 w-full px-3 py-2 border rounded text-sm dark:bg-slate-700 dark:text-white"
                                readonly>
                            </div>


                            <div class="mb-4">
                              <label for="addressjl" class="block text-sm font-medium text-gray-700 mb-1">Kecamatan</label>
                              <input type="text" id="addressjl" name="addressjl"
                                value="Tanah Sepenggal"
                                class="mt-1 w-full px-3 py-2 border rounded text-sm dark:bg-slate-700 dark:text-white"
                                readonly>
                            </div>

                            <div class="mb-4">
                              <label for="addressjl" class="block text-sm font-medium text-gray-700 mb-1">Kota / Kabupatan </label>
                              <input type="text" id="addressjl" name="addressjl"
                                value="Bungo"
                                class="mt-1 w-full px-3 py-2 border rounded text-sm dark:bg-slate-700 dark:text-white"
                                readonly>
                            </div>
                            <div class="mb-4">
                              <label for="addressjl" class="block text-sm font-medium text-gray-700 mb-1">Provinsi</label>
                              <input type="text" id="addressjl" name="addressjl"
                                value="Jambi"
                                class="mt-1 w-full px-3 py-2 border rounded text-sm dark:bg-slate-700 dark:text-white"
                                readonly>
                            </div>
                              <div class="mt-6 flex justify-between">
                                <button onclick="prevPage()" type="button" class="inline-block px-5 py-2 bg-green-400 text-white font-semibold rounded-lg hover:bg-green-500 transition">
                                    Kembali
                                </button>
                                <button type="button" onclick="nextToPage3()" class="inline-block px-5 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                                    Berikutnya
                                </button>
                            </div>
                            </div>
                          </div>
                        </div>
                    </div>
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

                <!-- LAMPIRAN DOKUMEN -->
                
                <div id="page3" class="hidden px-6 py-8">
                  <p class="text-lg font-bold uppercase dark:text-white dark:opacity-60 mb-4">LAPORAN DOKUMEN</p>
                  <div class="overflow-x-auto">
                    <table class="min-w-full table-auto border border-gray-300 dark:border-white">
                      <thead class="bg-gray-100 dark:bg-gray-800">
                        <tr>
                          <th class="border px-4 py-2 text-center text-lg font-semibold text-gray-700 dark:text-white">Dokumen Persyaratan</th>
                        </tr>
                      </thead>
                      <tbody class="text-sm text-gray-800 dark:text-white">

                        <!-- Dokumen 1 -->
                        <tr>
                          <td class="border px-4 py-2 text-m text-left">
                            Print Out NIB via OSS RBA (Untuk Badan Usaha)<br>
                            <img src="../assets/img/NIB.jpg" class="max-h-32 rounded border mt-2" />
                          </td>
                        </tr>

                        <!-- Dokumen 2 -->
                        <tr>
                          <td class="border px-4 py-2 text-m text-left">
                            KTP Penanggung Jawab<br>
                            <img src="../assets/img/KTP.jpg" class="max-h-32 rounded border mt-2" />
                          </td>
                        </tr>

                        <!-- Dokumen 3 -->
                        <tr>
                          <td class="border px-4 py-2 text-m text-left">
                            NPWP<br>
                            <img src="../assets/img/NPWP.jpg" class="max-h-32 rounded border mt-2" />
                          </td>
                        </tr>

                        <!-- Dokumen 4 -->
                        <tr>
                          <td class="border px-4 py-2 text-m text-left">
                            Gambar Situasi / Tata Letak<br>
                            <img src="../assets/img/situasi.png" class="max-h-32 rounded border mt-2" />
                          </td>
                        </tr>

                        <!-- Dokumen 5 -->
                        <tr>
                          <td class="border px-4 py-2 text-m text-left">
                            Bukti Pembayaran Tagihan Listrik Bulan Terakhir<br>
                            <img src="../assets/img/buktitagihan.png" class="max-h-32 rounded border mt-2" />
                            
                          </td>
                        </tr>

                        <!-- Dokumen 6 -->
                        <tr>
                          <td class="border px-4 py-2 text-m text-left">
                            Unit 1<br>
                            <img src="../assets/img/generator.jpg" class="max-h-32 rounded border mt-2" />
                            <img src="../assets/img/generator.jpg" class="max-h-32 rounded border mt-2" />
                            <img src="../assets/img/generator.jpg" class="max-h-32 rounded border mt-2" />
                          </td>
                        </tr>

                        <!-- Dokumen 7 -->
                        <tr>
                          <td class="border px-4 py-2 text-m text-left">
                            Unit 2<br>
                            <img src="../assets/img/mesin.jpg" class="max-h-32 rounded border mt-2" />
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  

                <!-- Tombol Navigasi -->
                <div class="w-full flex justify-between mt-6 ">
                <!-- Tombol Kembali -->
                <div class="w-full flex justify-end gap-3 mt-6 flex-wrap">
                <!-- Tombol Kembali -->
                <button onclick="backToPage2()" type="button" class="px-5 py-2 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-600 transition">
                    Kembali
                </button>

                <!-- Tombol Ditolak -->
                <button onclick="openModal('Nama Dokumen')" type="button" class="px-5 py-2 bg-red-500 text-white font-semibold rounded-lg hover:bg-red-600 transition">
                    Ditolak
                </button>

                <!-- Tombol Kirim ke Evaluator -->
                <button onclick="openEvaluatorModal()" type="button" class="px-5 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                    Kirim ke Evaluator
                </button>
                </div>
            </div>


            <!-- Modal Evaluasi Ditolak  -->
                <div id="modal-evaluasi" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
                <div class="bg-white dark:bg-slate-800 rounded-xl p-6 w-full max-w-lg shadow-lg relative">
                    <h2 id="nama-dokumen" class="text-xl font-bold mb-4 text-gray-800 dark:text-white">Dokumen: </h2>

                    <!-- Catatan -->
                    <label for="catatan-evaluasi" class="block text-m text-gray-700 dark:text-gray-300 mb-1">Catatan Kenapa Ditolak:</label>
                    <textarea id="catatan-evaluasi" class="w-full border rounded p-2 mb-4 dark:bg-gray-700 dark:text-white" rows="4" placeholder="Tulis alasan penolakan..."></textarea>

                    <!-- Status -->
                    <label for="status-evaluasi" class="block text-m text-gray-700 dark:text-gray-300 mb-2">Status Evaluasi:</label>
                    <select id="status-evaluasi" class="w-full px-4 py-2 mb-4 border rounded-lg dark:bg-slate-700 dark:text-white">
                    <option value="Setuju">Setuju</option>
                    <option value="Perlu Perbaikan" selected>Perlu Perbaikan</option>
                    </select>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-end gap-3 mt-4">
                    <button onclick="closeModal()" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                        Batal
                    </button>
                    <button onclick="simpanEvaluasi()" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                        Simpan
                    </button>
                    </div>
                </div>
                </div>
                <script>
                function openModal(docName) {
                    document.getElementById('modal-evaluasi').classList.remove('hidden');
                    document.body.classList.add('overflow-hidden');
                    document.getElementById('nama-dokumen').textContent = `Dokumen: ${docName}`;
                    document.getElementById('catatan-evaluasi').value = '';
                    document.getElementById('status-evaluasi').value = 'Perlu Perbaikan';
                }

                function closeModal() {
                    document.getElementById('modal-evaluasi').classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                }

                function simpanEvaluasi() {
                    const doc = document.getElementById('nama-dokumen').textContent;
                    const catatan = document.getElementById('catatan-evaluasi').value;
                    const status = document.getElementById('status-evaluasi').value;

                    if (!catatan.trim()) {
                    alert("Catatan tidak boleh kosong.");
                    return;
                    }

                    console.log(`Evaluasi disimpan untuk ${doc}: ${status}, Catatan: ${catatan}`);
                    closeModal();
                }
                </script>

                <!-- Modal Pilih Evaluator -->
                <div id="modal-evaluator" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
                <div class="bg-white dark:bg-slate-800 rounded-xl p-6 w-full max-w-2xl shadow-lg relative max-h-[90vh] overflow-y-auto">
                    <h2 class="text-xl font-bold mb-4 text-gray-800 dark:text-white">Pilih Evaluator</h2>

                    <div class="space-y-4">
                    <!-- Contoh Card Evaluator -->
                    <label class="flex items-center gap-4 border p-3 rounded-lg cursor-pointer hover:bg-gray-100 dark:hover:bg-slate-700">
                        <input type="radio" name="evaluator" value="evaluator1" class="hidden peer" />
                        <img src="https://img.freepik.com/vektor-premium/ilustrasi-datar-vektor-dalam-skala-abu-abu-ikon-orang-profil-pengguna-avatar-gambar-profil-siluet-netral-gender-cocok-untuk-ikon-profil-media-sosial-screensaver-dan-sebagai-templatx9xa_719432-1096.jpg" alt="Foto Evaluator" class="w-12 h-12 rounded-full object-cover" />
                        <div>
                        <p class="font-semibold text-gray-800 dark:text-white">Ahmad Yusuf</p>
                        <p class="text-sm text-gray-500 dark:text-gray-300">NIP: 1987654321</p>
                        </div>
                        <div class="ml-auto peer-checked:block hidden text-blue-500 font-bold">✓</div>
                    </label>

                    <!-- Tambahkan lebih banyak evaluator -->
                    <label class="flex items-center gap-4 border p-3 rounded-lg cursor-pointer hover:bg-gray-100 dark:hover:bg-slate-700">
                        <input type="radio" name="evaluator" value="evaluator2" class="hidden peer" />
                        <img src="https://img.freepik.com/vektor-premium/ilustrasi-datar-vektor-dalam-skala-abu-abu-ikon-orang-profil-pengguna-avatar-gambar-profil-siluet-netral-gender-cocok-untuk-ikon-profil-media-sosial-screensaver-dan-sebagai-templatx9xa_719432-1096.jpg" alt="Foto Evaluator" class="w-12 h-12 rounded-full object-cover" />
                        <div>
                        <p class="font-semibold text-gray-800 dark:text-white">Siti Rahmawati</p>
                        <p class="text-sm text-gray-500 dark:text-gray-300">NIP: 1990123456</p>
                        </div>
                        <div class="ml-auto peer-checked:block hidden text-blue-500 font-bold">✓</div>
                    </label>
                    </div>

                    <!-- Tambahkan lebih banyak evaluator -->
                    <label class="flex items-center gap-4 border p-3 rounded-lg cursor-pointer hover:bg-gray-100 dark:hover:bg-slate-700">
                        <input type="radio" name="evaluator" value="evaluator2" class="hidden peer" />
                        <img src="https://img.freepik.com/vektor-premium/ilustrasi-datar-vektor-dalam-skala-abu-abu-ikon-orang-profil-pengguna-avatar-gambar-profil-siluet-netral-gender-cocok-untuk-ikon-profil-media-sosial-screensaver-dan-sebagai-templatx9xa_719432-1096.jpg" alt="Foto Evaluator" class="w-12 h-12 rounded-full object-cover" />
                        <div>
                        <p class="font-semibold text-gray-800 dark:text-white">Rizki Monika</p>
                        <p class="text-sm text-gray-500 dark:text-gray-300">NIP: 19901234587</p>
                        </div>
                        <div class="ml-auto peer-checked:block hidden text-blue-500 font-bold">✓</div>
                    </label>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="mt-6 space-y-3">
                    <button onclick="kirimKeEvaluator()" class="w-full px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                        Kirim
                    </button>
                    <button onclick="closeEvaluatorModal()" class="w-full px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                        Batal
                    </button>
                    </div>

                </div>
                </div>
                <script>
                function openEvaluatorModal() {
                    document.getElementById('modal-evaluator').classList.remove('hidden');
                    document.body.classList.add('overflow-hidden');
                }

                function closeEvaluatorModal() {
                    document.getElementById('modal-evaluator').classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                }

                function kirimKeEvaluator() {
                    const selected = document.querySelector('input[name="evaluator"]:checked');
                    if (!selected) {
                    alert("Pilih salah satu evaluator terlebih dahulu.");
                    return;
                    }

                    const evaluatorID = selected.value;
                    console.log("Evaluator yang dipilih:", evaluatorID);

                    // Tambahkan AJAX / pengiriman data ke server di sini jika perlu

                    closeEvaluatorModal();
                    alert("Dokumen berhasil dikirim ke evaluator.");
                }
                </script>



      <!--<script>
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

</body>
<!-- plugin for charts  -->
<script src="../assets/js/plugins/chartjs.min.js" async></script>
<!-- plugin for scrollbar  -->
<script src="../assets/js/plugins/perfect-scrollbar.min.js" async></script>
<!-- main script file  -->
<script src="../assets/js/argon-dashboard-tailwind.js?v=1.0.1" async></script>

</html>