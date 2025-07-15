<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/png" href=" {{ asset('assets/img/logo-esdm.svg') }} " />
  <title>Pengajuan Surat</title>
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

  <!-- sidenav  -->
  <aside
    class="fixed inset-y-0 flex-wrap items-center justify-between block w-full p-0 my-4 overflow-y-auto antialiased transition-transform duration-200 -translate-x-full bg-white border-0 shadow-xl dark:shadow-none dark:bg-slate-850 max-w-64 ease-nav-brand z-990 xl:ml-6 rounded-2xl xl:left-0 xl:translate-x-0"
    aria-expanded="false">

    <div class="sticky top-0 z-50 bg-white h-19 px-4 flex items-center justify-between shadow-sm">
      <a class="flex items-center py-4 text-sm whitespace-nowrap dark:text-white text-slate-700"
        href="https://demos.creative-tim.com/argon-dashboard-tailwind/pages/dashboard.html" target="_blank">
        <img src="../assets/img/logo-esdm.svg" class="h-8 w-8 max-w-full transition-all duration-200 ease-nav-brand"
          alt="main_logo" />
        <span class="ml-2 font-semibold leading-tight transition-all duration-200 ease-nav-brand">
          Energi dan Sumber Daya <br>Mineral
        </span>
      </a>
    </div>

    <!-- tombol close -->
    <i class="xl:hidden fas fa-times absolute top-4 right-4 p-2 text-slate-400 dark:text-white opacity-70 cursor-pointer"
      sidenav-close></i>
    </div>

    <hr
      class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent" />
    <!-- menu fitur -->
    <div class="items-center block h-auto w-auto max-h-screen overflow-auto h-sidenav grow basis-full">
      <ul class="flex flex-col pl-0 mb-0">

        <li class="mt-0.5 w-full">
          <a class=" dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
            href="">
            <div
              class="mr-2 flex h-1 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
              <i class="relative top-0 text-sm leading-normal text-blue-500 ni ni-tv-2"></i>
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Dashboard</span>
          </a>
        </li>

        <li class="mt-0.5 w-full">
          <a class="py-2.7 bg-blue-500/13 dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors"
            href="">
            <div
              class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
              <i class="relative top-0 text-sm leading-normal text-orange-500 ni ni-calendar-grid-58"></i>
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Daftar Pengajuan</span>
          </a>
        </li>

        <li class="w-full mt-4">
          <h6 class="pl-6 ml-2 text-xs font-bold leading-tight uppercase dark:text-white opacity-60">Pengaturan Akun
          </h6>
        </li>

        <li class="mt-0.5 w-full">
          <a class=" dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
            href="">
            <div
              class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
              <i class="relative top-0 text-sm leading-normal text-slate-700 ni ni-single-02"></i>
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Profil</span>
          </a>
        </li>

      </ul>
    </div>

  </aside>

  <!-- end sidenav -->






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
              <a class="text-white opacity-50" href="javascript:;">Halaman</a>
            </li>
            <li
              class="text-sm pl-2 capitalize leading-normal text-white before:float-left before:pr-2 before:text-white before:content-['/']"
              aria-current="page">Buat Pengajuan</li>
          </ol>
          <h6 class="mb-0 font-bold text-white capitalize">Buat Pengajuan</h6>
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
        <div
          class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
          <div class="flex-auto p-4">
            <div class="flex flex-col -mx-3">
              <div class="w-full max-w-full px-3">
                <h4 class="text-lg font-bold mb-4 text-gray-700 dark:text-white text-center uppercase">Form Pengajuan
                  Surat</h4>

                <form id="suratpengajuan" method="POST" action="/submit-url" onsubmit="return validateForm()">
                  <p class="leading-normal  dark:text-white dark:opacity-60 text-base font-bold">Data Teknis
                  </p>
                  <div class="flex flex-wrap -mx-3">
                    <div class="w-full max-w-full px-3 shrink-0 md:w-full md:flex-0">

                      <label class="block text-sm font-medium text-gray-700 mb-2">
                        Jenis Pembangkit Tenaga Listrik
                      </label>
                      <p class="w-full border px-4 py-2 rounded mb-4 bg-gray-100">
                        Pembangkit Listrik Selain Tenaga Surya
                      </p>
                      <!-- FORM NON SURYA -->
                      <div id="form-nonSurya" class="">
                        <h3 class="font-semibold mb-2"></h3>
                        <div class="overflow-scroll">
                          <table id="table-nonSurya">
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
                                <td>Titik Kordinat</td>
                                <td class="text-center align-middle">
                                  S 01°54.00'22.90" E 103°00.00'46.10"
                                  <input type="hidden" name="titikkoordinat_1" value="nonSurya" readonly>
                                </td>
                                <td class="text-center align-middle">
                                  S 01°54.00'23.20" E 103°00.00'46.70"
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

                      <!-- FORM TENAGA SURYA 
                      <div id="form-surya" class="hidden">
                        <h3 class="font-semibold mb-2"></h3>
                        <div class="mb-4 flex flex-wrap gap-2">
                          <button type="button" onclick="tambahKolom('surya')"
                            class="bg-blue-600 hover:bg-blue-500 text-white px-3 py-1 rounded">
                            Tambah Unit
                          </button>
                          <button type="button" onclick="kurangiKolom('surya')"
                            class="bg-red-600 hover:bg-red-500 text-white px-3 py-1 rounded ">
                            Kurangi Unit
                          </button>
                        </div>
                        <div class="overflow-scroll">
                          <table id="table-surya">
                            <thead>
                              <tr id="header-surya">
                                <th>Spesifikasi</th>
                                <th>Unit 1</th>
                                <th>Unit 2</th>
                              </tr>
                            </thead>
                            <tbody id="body-surya">
                              <tr>
                                <td>Merek</td>
                                <td><label name="smerek_1" readonly></td>
                              </tr>
                              <tr>
                                <td>Tipe</td>
                                <td><label name="stipe_1" readonly></td>
                              </tr>
                              <tr>
                                <td>Negara Pembuat</td>
                                <td><label name="snegara_1" readonly></td>
                              </tr>
                              <tr>
                                <td>Tahun Pembuatan</td>
                                <td><label name="stahun_1" readonly></td>
                              </tr>
                              <tr>
                                <td>Kapasitas (watt-peak)</td>
                                <td><label name="skapasitas_1" readonly></td>
                              </tr>
                              <tr>
                                <td>Titik Kordinat</td>
                                <td><label name="stitikkordinat_1" readonly></td>
                              </tr>
                              <tr>
                                <td>Sifat Penggunaan</td>
                                <td>
                                  <select name="sifat_1" readonly>
                                    <option value="" disabled selected hidden>-- Pilih --</option>
                                    <option value="Darurat">Darurat</option>
                                    <option value="Permanen">Permanen</option>
                                    <option value="Sementara">Sementara</option>
                                    <option value="Musiman">Musiman</option>
                                  </select>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      -->

                      <!-- Bagian 2: Jaringan Distribusi -->
                      <div class="mb-4">
                        <p class="leading-normal dark:text-white dark:opacity-60 text-base font-bold">Jaringan
                          Distribusi</p>

                        <!-- Form Tambahan Jaringan Distribusi -->

                        <div id="form-jaringan" class="">
                          <div class="mb-4">
                            <label for="panjangSaluran" class="block text-sm font-medium text-gray-700">Panjang Saluran (Kms)</label>
                            <input type="text" id="panjangSaluran" name="panjang_saluran"
                              class="mt-1 w-full p-2 border rounded dark:bg-slate-700 dark:text-white"
                              placeholder="13,00"
                              pattern="^\d+(,\d{1,2})?$"
                              title="Gunakan angka bulat atau dengan koma maksimal dua angka desimal, misal: 220, 220,5 atau 220,50"
                              readonly>
                          </div>

                          <div class="mb-4">
                            <label for="tegangan" class="block text-sm font-medium text-gray-700">Tegangan (Volt)</label>
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
                          <p class="eading-normal dark:text-white dark:opacity-60 text-base font-bold">Sambungan
                            Listrik dari Pihak Lain</p>



                          <!-- Form Tambahan Jika "Ada" -->
                          <div id="form-sambungan" class="">
                            <div class="mb-4">
                              <label for="pihakLain" class="block text-sm font-medium text-gray-700">Dari Pihak
                                Lain</label>
                              <input type="text" id="pihakLain" name="pihak_lain"
                                class="mt-1 w-full p-2 border rounded dark:bg-slate-700 dark:text-white"
                                placeholder="PT. PLN" readonly>
                            </div>

                            <div class="mb-4">
                              <label for="dayaTersambung" class="block text-sm font-medium text-gray-700">Daya Tersambung
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

                        <hr class="h-px mx-0 my-4 bg-transparent border-0 opacity-25 bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent" />

                        <p id="toggleAlamat" class="leading-normal dark:text-white dark:opacity-60 text-base font-bold cursor-pointer">
                          Lokasi instalasi penyedia tenaga listrik
                          <svg class="w-4 h-4 ml-2 inline" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                          </svg>
                        </p>

                        <div class="flex flex-wrap -mx-3">
                          <div class="w-full max-w-full px-3 shrink-0 md:w-full md:flex-0">
                            <div id="alamatForm" class="hidden">

                              <div class="mb-2">
                                <label for="addressjl" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Nama Jalan</label>
                                <input type="text" name="addressjl" id="addressjl"
                                  value="JL. Tanah Tumbuh"
                                  class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm block w-full rounded-lg border border-gray-300 bg-white px-3 py-2"
                                  readonly>
                              </div>

                              <div class="mb-2">
                                <label for="addressdes" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Desa / Kelurahan</label>
                                <input type="text" name="addressdes" id="addressdes"
                                  value="Sungai Gambir"
                                  class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm block w-full rounded-lg border border-gray-300 bg-white px-3 py-2"
                                  readonly>
                              </div>

                              <div class="mb-2">
                                <label for="addresskec" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Kecamatan</label>
                                <input type="text" name="addresskec" id="addresskec"
                                  value="Tanah Sepenggal"
                                  class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm block w-full rounded-lg border border-gray-300 bg-white px-3 py-2"
                                  readonly>
                              </div>



                              <div class="mb-2">
                                <label for="addresskab" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">
                                  Kota / Kabupaten
                                </label>
                                <input type="text" name="addresskab" id="addresskab"
                                  value="Bungo"
                                  class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm block w-full rounded-lg border border-gray-300 bg-white px-3 py-2"
                                  readonly>
                              </div>



                              <div class="mb-2">
                                <label for="addressprov" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">
                                  Provinsi
                                </label>
                                <input type="text" name="addressprov" id="addressprov"
                                  value="Jambi"
                                  class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm block w-full rounded-lg border border-gray-300 bg-white px-3 py-2"
                                  readonly>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- Toggle Script  -->
                        <script>
                          document.addEventListener("DOMContentLoaded", function() {
                            const toggleAlamat = document.getElementById("toggleAlamat");
                            const alamatForm = document.getElementById("alamatForm");

                            if (toggleAlamat && alamatForm) {
                              toggleAlamat.addEventListener("click", function() {
                                alamatForm.classList.toggle("hidden");
                              });
                            }
                          });
                        </script>



                        <hr
                          class="h-px mx-0 my-4 bg-transparent border-0 opacity-25 bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent " />
                        <!-- Toggle Script -->
                        <p onclick="document.getElementById('alamatForm1').classList.toggle('hidden')" class="leading-normal  dark:text-white dark:opacity-60 text-base font-bold">Lampiran Dokumen <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                          </svg></p>

                        <div id="alamatForm1" class="">
                          <div class="mt-8 space-y-4">

                            <!-- NIB -->
                            <div>
                              <label class="block text-sm font-medium text-gray-700 dark:text-white mb-1">
                                Print Out NIB via OSS RBA (Untuk Badan Usaha)
                              </label>
                              <label for="nib" class="cursor-pointer inline-block">
                                <img id="preview-nib" src="../assets/img/NIB.jpg" class="mt-2 max-h-64 border rounded" />
                              </label>
                            </div>

                            <!-- KTP -->
                            <div>
                              <label class="block text-sm font-medium text-gray-700 dark:text-white mb-1">
                                KTP Penanggung Jawab
                              </label>
                              <label for="ktp" class="cursor-pointer inline-block">
                                <img id="preview-ktp" src="../assets/img/KTP.jpg" class="mt-2 max-h-64 border rounded" />
                              </label>
                            </div>

                            <!-- NPWP -->
                            <div>
                              <label class="block text-sm font-medium text-gray-700 dark:text-white mb-1">NPWP</label>
                              <label for="npwp" class="cursor-pointer inline-block">
                                <img id="preview-npwp" src="../assets/img/NPWP.jpg" class="mt-2 max-h-64 border rounded" />
                              </label>
                            </div>

                            <!-- Gambar Situasi -->
                            <div>
                              <label class="block text-sm font-medium text-gray-700 dark:text-white mb-1">Gambar Situasi / Tata Letak</label>
                              <label for="gambar_situasi" class="cursor-pointer inline-block">
                                <img id="preview-gambar_situasi" src="../assets/img/situasi.png" class="mt-2 max-h-64 border rounded" />
                              </label>
                            </div>

                            <!-- Bukti Tagihan -->
                            <div>
                              <label class="block text-sm font-medium text-gray-700 dark:text-white mb-1">Bukti Pembayaran Tagihan Listrik Bulan Terakhir</label>
                              <label for="bukti_tagihan" class="cursor-pointer inline-block">
                                <img id="preview-bukti_tagihan" src="../assets/img/tagihan.jpg" class="mt-2 max-h-64 border rounded" />
                              </label>
                            </div>

                            <!-- Foto Generator -->
                            <div>
                              <label for="foto_generator" id="label_generator" class="block text-sm font-medium text-gray-700 dark:text-white mb-1">
                                Foto Papan Nama (Name Plate) Generator
                              </label>
                              <label for="foto_generator" class="cursor-pointer inline-block">
                                <img id="preview-foto_generator" src="../assets/img/generator.jpg" class="mt-2 max-h-64 border rounded" />
                              </label>
                            </div>

                            <!-- Foto Mesin -->
                            <div>
                              <label for="foto_mesin" id="label_mesin" class="block text-sm font-medium text-gray-700 dark:text-white mb-1">
                                Foto Papan Nama (Name Plate) Mesin Penggerak
                              </label>
                              <label for="foto_mesin" class="cursor-pointer inline-block">
                                <img id="preview-foto_mesin" src="../assets/img/mesin.jpg" class="mt-2 max-h-64 border rounded" />
                              </label>
                            </div>
                          </div>

                        </div>
                        <div class="mt-4 flex items-start">

                          <label for="persetujuan" class="ml-2 text-sm text-gray-700 dark:text-white leading-relaxed">
                            Dengan ini menyatakan bahwa saya bertanggung jawab sepenuhnya atas data yang telah saya sampaikan.
                            Apabila di kemudian hari ditemukan bahwa data tersebut tidak benar dan mengakibatkan konsekuensi hukum,
                            maka saya atau Badan Usaha/Instansi yang saya wakili bersedia menerima segala bentuk sanksi sesuai dengan
                            ketentuan peraturan perundang-undangan yang berlaku.
                          </label>
                        </div>

                        <hr
                          class="h-px mx-0 my-4 bg-transparent border-0 opacity-25 bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent " />
                      </div>
                      <div class="w-full flex justify-center gap-x-6 my-6">
                        <a href="/daftarpengajuanvalidator"
                          class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-full shadow transition">
                          Validasi
                        </a>
                        <a href=""
                          class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-2 rounded-full shadow transition">
                          Tolak
                        </a>
                      </div>

                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- 
    <footer class="pt-4">
      <div class="w-full px-6 mx-auto">
        <div class="flex flex-wrap items-center -mx-3 lg:justify-between">
          <div class="w-full max-w-full px-3 mt-0 mb-6 shrink-0 lg:mb-0 lg:w-1/2 lg:flex-none">
            <div class="text-sm leading-normal text-center text-slate-500 lg:text-left">
              ©
              <script>
                document.write(new Date().getFullYear() + ",");
              </script>
              made with <i class="fa fa-heart"></i> by
              <a href="https://www.creative-tim.com" class="font-semibold text-slate-700 dark:text-white"
                target="_blank">Creative Tim</a>
              for a better web.
            </div>
          </div>
        </div>
      </div>
    </footer>
    </div>
    end cards -->
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