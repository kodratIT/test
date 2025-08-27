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

    body.modal-open {
        overflow: hidden;
        height: 100vh;
        position: fixed;
        width: 100%;
    }

    .swal2-confirm.btn-primary {
        background-color: #2563eb !important;
        /* biru Tailwind: blue-600 */
        color: white !important;
        font-weight: 600;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        font-size: 1rem;
    }
</style>

<body
    class="m-0 font-sans text-base antialiased font-normal dark:bg-slate-900 leading-default bg-gray-50 text-slate-500">
    <div class="absolute w-full dark:hidden min-h-75 bg-blue-500"></div>



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
                                                            <td class=" text-left text-middle align-middle">
                                                                PT. AGRINDO PANCA TUNGGAL PERKASA
                                                                <input type="hidden" name="badan_usaha" value="datapemilik" readonly>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td class="text-left align-middle font-bold min-w-[150px] max-w-[150px] w-[150px]">NIB</td>
                                                            <td class="text-left align-middle">
                                                                1234567890123
                                                                <input type="hidden" name="nib" value="1234567890123" readonly>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td class="text-left align-middle font-bold">Alamat Kantor Pusat</td>
                                                            <td class="text-left align-middle">
                                                                Gold Coast Office PIK Lt. 11, Eiffel Tower, Penjaringan, Kamal Mauara, Jakarta Utara
                                                                <input type="hidden" name="alamat_pusat" value="datapemilik" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left align-middle font-bold">Alamat Kantor Cabang</td>
                                                            <td class="text-left align-middle">
                                                                Kelurahan Gunung Kembang, Kecamatan Sarolangun dan Desa Muara Danau, Desa Rantau Tenang,
                                                                Desa Lubuk Sepuh, Kecamatan Pelawan, Kabupaten Sarolangun, Provinsi Jambi
                                                                <input type="hidden" name="alamat_cabang" value="datapemilik" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left align-middle font-bold">E-mail</td>
                                                            <td class="text-left align-middle">
                                                                Mill.engineering@sthgroup.com
                                                                <input type="hidden" name="email" value="datapemilik" readonly>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td class="text-left align-middle font-bold">Nama</td>
                                                            <td class="text-left align-middle">
                                                                Krisno Aritonang
                                                                <input type="hidden" name="nama" value="datapemilik" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left align-middle font-bold">Jabatan</td>
                                                            <td class="text-left align-middle">
                                                                Mill Manager
                                                                <input type="hidden" name="jabatan" value="datapemilik" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left align-middle font-bold">E-mail</td>
                                                            <td class="text-left align-middle">
                                                                mm.asm@sthgroup.com
                                                                <input type="hidden" name="e-mail" value="datapemilik" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left align-middle font-bold">No. Telp/HP</td>
                                                            <td class="text-left align-middle">
                                                                081250871264
                                                                <input type="hidden" name="no.telp" value="datapemilik" readonly>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- EVALUASI 1 -->
                                        <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                                            <h2 class="text-lg text-center font-bold border-b pb-2 mb-2">Evaluasi</h2>

                                            <label for="catatan-perbaikan-1" class="text-sm font-semibold">Catatan Perbaikan :</label>
                                            <textarea
                                                id="catatan-perbaikan-1"
                                                name="catatan_perbaikan_1"
                                                rows="8"
                                                class="w-full p-2 border rounded text-sm bg-gray-100 text-gray-700 "
                                                disabled>Sudah Benar </textarea>

                                            <label for="status-permohonan-1" class="text-sm font-semibold">Status Permohonan :</label>
                                            <select
                                                id="status-permohonan-1"
                                                name="status_permohonan_1"
                                                class="w-full border p-2 rounded text-sm bg-white text-gray-700"
                                                disabled>
                                                <option value="Disetujui" selected>Disetujui</option>
                                            </select>



                                            <!-- Tombol Simpan 3 -->
                                            <div class="pt-2 mt-6">
                                                <button class="bg-green-600 text-white font-semibold px-4 py-2 rounded w-full cursor-not-allowed" type="button" disabled>
                                                    Simpan Evaluasi
                                                </button>
                                            </div>

                                        </div>

                                        <!-- Modal Pop-up 3 
                                        <div id="popupBerhasil2" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
                                            <div class="bg-white p-6 rounded-lg shadow-lg text-center w-80">
                                                <h2 class="text-lg font-semibold text-green-700 mb-2">Berhasil!</h2>
                                                <p class="text-gray-700 mb-4">Evaluasi berhasil disimpan.</p>
                                                <button onclick="tutupPopup2()" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded">
                                                    OK
                                                </button>
                                            </div>
                                        </div>

                                        <script>
                                            function tampilkanPopup2() {
                                                document.getElementById('popupBerhasil2').classList.remove('hidden');
                                                document.body.classList.add('overflow-hidden'); // Opsional: mencegah scroll background
                                            }

                                            function tutupPopup2() {
                                                document.getElementById('popupBerhasil2').classList.add('hidden');
                                                document.body.classList.remove('overflow-hidden');
                                            }
                                        </script>-->
                                        <!-- Tombol navigasi: Keluar di kiri, Selanjutnya di kanan -->
                                    </div>
                                    <div class="mt-6 flex justify-between">

                                        <!-- Tombol Keluar -->
                                        <a href="/daftarpermohonaneval"
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
                                                            <td class=" text-left text-middle align-middle">
                                                                PB-UMKU : 91201042324600040003
                                                                <input type="hidden" name="nomor" value="dataumum" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left align-middle font-bold">Tanggal Terbit</td>
                                                            <td class="text-left align-middle">
                                                                21 November 2024
                                                                <input type="hidden" name="tanggal" value="dataumum" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left align-middle font-bold"> Tanggal Masa Berlaku</td>
                                                            <td class="text-left align-middle">
                                                                5 tahun
                                                                <input type="hidden" name="masaberlaku" value="dataumum" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left align-middle font-bold">Kelebihan Tenaga Lsitrik dijual Kepada</td>
                                                            <td class="text-left align-middle">
                                                                Tidak ada kelebihan tenaga listrik
                                                                <input type="hidden" name="kelebihan" value="dataumum" readonly>
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

                                                <!-- Iframe dengan fitur zoom -->
                                                <div class="w-full h-[500px] rounded overflow-hidden border">
                                                    <iframe
                                                        src="https://drive.google.com/file/d/13Be63aeAeqLQqcZAKnf0JqMFoQ8gT_w-/preview#zoom=100"
                                                        class="w-full h-full"
                                                        allowfullscreen>
                                                    </iframe>
                                                </div>
                                                <!-- Tombol Lihat di Tab Baru -->
                                                <div class="mt-2 text-right">
                                                    <a href="https://drive.google.com/file/d/13Be63aeAeqLQqcZAKnf0JqMFoQ8gT_w-/view"
                                                        target="_blank"
                                                        class="inline-block px-4 py-2 bg-blue-500 text-white text-sm rounded hover:bg-blue-600 transition">
                                                        Lihat di Tab Baru
                                                    </a>
                                                </div>
                                            </div>

                                        </div>

                                        <!--  Evaluasi 2 -->
                                        <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                                            <h2 class="text-lg text-center font-bold border-b pb-2 mb-2">Evaluasi</h2>
                                            <label for="catatan-perbaikan-2" class="text-sm font-semibold">Catatan Perbaikan :</label>
                                            <textarea
                                                id="catatan-perbaikan-2"
                                                name="catatan_perbaikan_2"
                                                rows="8"
                                                class="w-full p-2 border rounded text-sm bg-gray-100  text-gray-700"
                                                disabled>Sudah Benar</textarea>

                                            <label for="status-permohonan-2" class="text-sm font-semibold">Status Permohonan :</label>
                                            <select
                                                id="status-permohonan-2"
                                                name="status_permohonan_2"
                                                class="w-full border p-2 rounded text-sm bg-white text-gray-700"
                                                disabled>
                                                <option value="Disetujui" selected>Disetujui</option>
                                            </select>
                                            <!-- Tombol Simpan 3 -->
                                            <div class="pt-2 mt-6">
                                                <button class="bg-green-600 text-white font-semibold px-4 py-2 rounded w-full cursor-not-allowed" type="button" disabled>
                                                    Simpan Evaluasi
                                                </button>
                                            </div>


                                            <!-- Modal Pop-up 3 
                                        <div id="popupBerhasil2" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
                                            <div class="bg-white p-6 rounded-lg shadow-lg text-center w-80">
                                                <h2 class="text-lg font-semibold text-green-700 mb-2">Berhasil!</h2>
                                                <p class="text-gray-700 mb-4">Evaluasi berhasil disimpan.</p>
                                                <button onclick="tutupPopup2()" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded">
                                                    OK
                                                </button>
                                            </div>
                                        </div>-->
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
                                                            <td class=" text-left text-middle align-middle">
                                                                Persetujuan Andal
                                                                <input type="hidden" name="jenisizin" value="dataumum" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left align-middle font-bold">Nomor</td>
                                                            <td class="text-left align-middle">
                                                                186 Tahun 2023
                                                                <input type="hidden" name="no" value="dataumum" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left align-middle font-bold">Tanggal Terbit</td>
                                                            <td class="text-left align-middle">
                                                                08 Mei 2023
                                                                <input type="hidden" name="tnggal" value="dataumum" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left align-middle font-bold">Tanggal Masa Berlaku</td>
                                                            <td class="text-left align-middle">
                                                                -
                                                                <input type="hidden" name="masa_berlaku" value="dataumum" readonly>
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

                                                <!-- Iframe dengan fitur zoom -->
                                                <div class="w-full h-[500px] rounded overflow-hidden border">
                                                    <iframe
                                                        src="https://drive.google.com/file/d/13Be63aeAeqLQqcZAKnf0JqMFoQ8gT_w-/preview#zoom=100"
                                                        class="w-full h-full"
                                                        allowfullscreen>
                                                    </iframe>
                                                </div>
                                                <!-- Tombol Lihat di Tab Baru -->
                                                <div class="mt-2 text-right">
                                                    <a href="https://drive.google.com/file/d/13Be63aeAeqLQqcZAKnf0JqMFoQ8gT_w-/view"
                                                        target="_blank"
                                                        class="inline-block px-4 py-2 bg-blue-500 text-white text-sm rounded hover:bg-blue-600 transition">
                                                        Lihat di Tab Baru
                                                    </a>
                                                </div>
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
                                                class="w-full p-2 border rounded text-sm bg-gray-100 text-gray-700"
                                                disabled>Sudah benar</textarea>

                                            <label for="status-permohonan-3" class="text-sm font-semibold">Status Permohonan :</label>
                                            <select
                                                id="status-permohonan-3"
                                                name="status_permohonan_3"
                                                class="w-full border p-2 rounded text-sm bg-white text-gray-700"
                                                disabled>
                                                <option value="Disetujui" selected>Disetujui</option>
                                            </select>


                                            <!-- Tombol Simpan 3 -->
                                            <div class="pt-2 mt-6">
                                                <button class="bg-green-600 text-white font-semibold px-4 py-2 rounded w-full cursor-not-allowed" type="button" disabled>
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


                                    <!-- Container 3: DATA UMUM | LAMPIRAN | EVALUASI -->
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 border border-gray-200 rounded shadow-sm overflow-hidden p-4">
                                        <!-- KOLOM 1: SLO -->
                                        <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                                            <h2 class="text-lg font-bold text-center border-b pb-2 mb-2">Sertifikat Laik Operasi (SLO)</h2>
                                            <div class="overflow-x-auto">
                                                <table class="w-full table-auto border-collapse border border-gray-300 text-sm text-left">
                                                    <thead class="bg-gray-100 min-w-[150px] max-w-[150px] w-[150px]">
                                                        <tr id="header-SLO">
                                                            <th> </th>
                                                            <th>#1</th>
                                                            <th>#2</th>
                                                            <th>#3</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody id="body-SLO">
                                                        <tr>
                                                            <td class="text-left align-middle font-bold min-w-[150px] max-w-[150px] w-[150px]">Nomor Sertifikat</td>
                                                            <td class="text-left align-middle">
                                                                7JJ.1.S.DJ.320.1505.24
                                                                <input type="hidden" name="nosertif" value="dataumum" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                3WW.0.S..18.307.1505.23
                                                                <input type="hidden" name="nosertif" value="dataumum" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                004.O.PP.111.1505.0000.18
                                                                <input type="hidden" name="nosertif" value="dataumum" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left align-middle font-bold">Nomor Register</td>
                                                            <td class="text-left align-middle">
                                                                7KB.0.E24
                                                                <input type="hidden" name="noregis" value="dataumum" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                3XD.1.D23
                                                                <input type="hidden" name="noregis" value="dataumum" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                C033.18
                                                                <input type="hidden" name="noregis" value="dataumum" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left align-middle font-bold">Tanggal Terbit</td>
                                                            <td class="text-left align-middle">
                                                                28 Mei 2024
                                                                <input type="hidden" name="tnggal" value="dataumum" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                10 April 2023
                                                                <input type="hidden" name="tnggal" value="dataumum" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                20 Maret 2013
                                                                <input type="hidden" name="tnggal" value="dataumum" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left align-middle font-bold">Tanggal Masa Berlaku</td>
                                                            <td class="text-left align-middle">
                                                                30 Mei 2025
                                                                <input type="hidden" name="masa_berlaku" value="dataumum" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                25 April 2025
                                                                <input type="hidden" name="masa_berlaku" value="dataumum" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                25 Maret 2025
                                                                <input type="hidden" name="masa_berlaku" value="dataumum" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left align-middle font-bold">Lembaga Inspeksi Teknik (LIT)</td>
                                                            <td class="text-left align-middle">
                                                                PT. Sucofindo (Persero)
                                                                <input type="hidden" name="lembaga" value="dataumum" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                PT. Sucofindo (Persero)
                                                                <input type="hidden" name="lembaga" value="dataumum" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                PT. Sucofindo (Persero)
                                                                <input type="hidden" name="lembaga" value="dataumum" readonly>
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

                                                <!-- Iframe dengan fitur zoom -->
                                                <div class="w-full h-[500px] rounded overflow-hidden border">
                                                    <iframe
                                                        src="https://drive.google.com/file/d/13Be63aeAeqLQqcZAKnf0JqMFoQ8gT_w-/preview#zoom=100"
                                                        class="w-full h-full"
                                                        allowfullscreen>
                                                    </iframe>
                                                </div>
                                                <!-- Tombol Lihat di Tab Baru -->
                                                <div class="mt-2 text-right">
                                                    <a href="https://drive.google.com/file/d/13Be63aeAeqLQqcZAKnf0JqMFoQ8gT_w-/view"
                                                        target="_blank"
                                                        class="inline-block px-4 py-2 bg-blue-500 text-white text-sm rounded hover:bg-blue-600 transition">
                                                        Lihat di Tab Baru
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- KOLOM 3: Evaluasi 4-->
                                        <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                                            <h2 class="text-lg text-center font-bold border-b pb-2 mb-2">Evaluasi</h2>

                                            <label for="catatan-perbaikan-4" class="text-sm font-semibold">Catatan Perbaikan :</label>
                                            <textarea
                                                id="catatan-perbaikan-4"
                                                name="catatan_perbaikan_4"
                                                rows="8"
                                                class="w-full p-2 border rounded text-sm bg-gray-100 text-gray-700"
                                                disabled>Sudah benar</textarea>

                                            <label for="status-permohonan-4" class="text-sm font-semibold">Status Permohonan :</label>
                                            <select
                                                id="status-permohonan-4"
                                                name="status_permohonan_4"
                                                class="w-full border p-2 rounded text-sm bg-white text-gray-700"
                                                disabled>
                                                <option value="Disetujui" selected>Disetujui</option>
                                            </select>


                                            <!-- Tombol Simpan 3 -->
                                            <div class="pt-2 mt-6">
                                                <button class="bg-green-600 text-white font-semibold px-4 py-2 rounded w-full cursor-not-allowed" type="button" disabled>
                                                    Simpan Evaluasi
                                                </button>
                                            </div>


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
                                            <h2 class="text-lg font-bold text-center border-b pb-2 mb-2">Sertifikat Kompetensi Tenaga Teknik Ketenagalistrikan (SKTTK)</h2>
                                            <div class="overflow-x-auto">
                                                <table class="w-full table-auto border-collapse border border-gray-300 text-sm text-left">
                                                    <thead class="bg-gray-100 min-w-[150px] max-w-[150px] w-[150px]">
                                                        <tr id="header-SLO">
                                                            <th> </th>
                                                            <th>SKTTK #1</th>
                                                            <th>SKTTK #2</th>
                                                            <th>SKTTK #3</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody id="body-SKTTK">
                                                        <tr>
                                                            <td class="text-left align-middle font-bold min-w-[150px] max-w-[150px] w-[150px]">Nomor Sertifikat</td>
                                                            <td class="text-left align-middle">
                                                                1154.0,15.P042.12.2024
                                                                <input type="hidden" name="nama" value="dataumum" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                1154.0,15.P042.12.2024
                                                                <input type="hidden" name="nama" value="dataumum" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                1154.0,15.P042.12.2024
                                                                <input type="hidden" name="nama" value="dataumum" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left align-middle font-bold min-w-[150px] max-w-[150px] w-[150px]">Nomor Registrasi</td>
                                                            <td class="text-left align-middle">
                                                                88562.1.2024
                                                                <input type="hidden" name="nama" value="dataumum" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                88562.1.2024
                                                                <input type="hidden" name="nama" value="dataumum" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                88562.1.2024
                                                                <input type="hidden" name="nama" value="dataumum" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left align-middle font-bold min-w-[150px] max-w-[150px] w-[150px]">Nama</td>
                                                            <td class="text-left align-middle">
                                                                Samuel Manogi Purba
                                                                <input type="hidden" name="nama" value="dataumum" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                Ahmad Putra
                                                                <input type="hidden" name="nama" value="dataumum" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                Kelvin Purba
                                                                <input type="hidden" name="nama" value="dataumum" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left align-middle font-bold">Jabatan</td>
                                                            <td class="text-left align-middle">
                                                                Junior Lokal Peralatan Bantu Boiler
                                                                <input type="hidden" name="jabatan" value="dataumum" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                Junior Lokal Peralatan Bantu Boiler
                                                                <input type="hidden" name="jabatan" value="dataumum" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                Junior Lokal Peralatan Bantu Boiler
                                                                <input type="hidden" name="jabatan" value="dataumum" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left align-middle font-bold">Jenjang Kualifikasi</td>
                                                            <td class="text-left align-middle">
                                                                D.35.114.01.KUALIFIKASI.2.KITLBM
                                                                <input type="hidden" name="jenjang" value="skttk" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                D.35.114.01.KUALIFIKASI.2.KITLBM
                                                                <input type="hidden" name="jenjang" value="skttk" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                D.35.114.01.KUALIFIKASI.2.KITLBM
                                                                <input type="hidden" name="jenjang" value="skttk" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left align-middle font-bold">Unit Kompetensi Inti (1)</td>
                                                            <td class="text-left align-middle">
                                                                Mengoperasikan Sistem Udara Pembakaran bagi Pelaksana Madya
                                                                <input type="hidden" name="unitKI" value="skttk" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                Mengoperasikan Sistem Udara Pembakaran bagi Pelaksana Madya
                                                                <input type="hidden" name="unitKI" value="skttk" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                Mengoperasikan Sistem Udara Pembakaran bagi Pelaksana Madya
                                                                <input type="hidden" name="unitKI" value="skttk" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left align-middle font-bold">Unit Kompetensi Inti (2)</td>
                                                            <td class="text-left align-middle">
                                                                D.35.114.00.011.1
                                                                <input type="hidden" name="unitKI" value="skttk" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                D.35.114.00.011.2
                                                                <input type="hidden" name="unitKI" value="skttk" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                D.35.114.00.011.3
                                                                <input type="hidden" name="unitKI" value="skttk" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left align-middle font-bold">Unit Kompetensi Pilihan (1)</td>
                                                            <td class="text-left align-middle">
                                                                Mengoperasikan Auxiliary Boiler bagi Pelaksana Madya
                                                                <input type="hidden" name="unitKP" value="skttk" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                Mengoperasikan Auxiliary Boiler bagi Pelaksana Madya
                                                                <input type="hidden" name="unitKP" value="skttk" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                Mengoperasikan Auxiliary Boiler bagi Pelaksana Madya
                                                                <input type="hidden" name="unitKP" value="skttk" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left align-middle font-bold">Unit Kompetensi Pilihan(2)</td>
                                                            <td class="text-left align-middle">
                                                                D.35.114.00.007.1
                                                                <input type="hidden" name="unitKI" value="skttk" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                D.35.114.00.007.2
                                                                <input type="hidden" name="unitKI" value="skttk" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                D.35.114.00.007.3
                                                                <input type="hidden" name="unitKI" value="skttk" readonly>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td class="text-left align-middle font-bold">Tanggal Terbit</td>
                                                            <td class="text-left align-middle">
                                                                28 Mei 2024
                                                                <input type="hidden" name="tnggal" value="dataumum" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                10 April 2023
                                                                <input type="hidden" name="tnggal" value="dataumum" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                20 Maret 2013
                                                                <input type="hidden" name="tnggal" value="dataumum" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left align-middle font-bold">Tanggal Masa Berlaku</td>
                                                            <td class="text-left align-middle">
                                                                30 Mei 2025
                                                                <input type="hidden" name="masa_berlaku" value="dataumum" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                25 April 2025
                                                                <input type="hidden" name="masa_berlaku" value="dataumum" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                25 Maret 2025
                                                                <input type="hidden" name="masa_berlaku" value="dataumum" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                        <tr>
                                                            <td class="text-left align-middle font-bold">Lembaga Sertikasi</td>
                                                            <td class="text-left align-middle">
                                                                PT.SERTIFIKASI
                                                                <input type="hidden" name="lembaga" value="skttk" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                PT.SERTIFIKASI
                                                                <input type="hidden" name="lembaga" value="skttk" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                PT.SERTIFIKASI
                                                                <input type="hidden" name="lembaga" value="skttk" readonly>
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

                                                <!-- Iframe dengan fitur zoom -->
                                                <div class="w-full h-[500px] rounded overflow-hidden border">
                                                    <iframe
                                                        src="https://drive.google.com/file/d/13Be63aeAeqLQqcZAKnf0JqMFoQ8gT_w-/preview#zoom=100"
                                                        class="w-full h-full"
                                                        allowfullscreen>
                                                    </iframe>
                                                </div>
                                                <!-- Tombol Lihat di Tab Baru -->
                                                <div class="mt-2 text-right">
                                                    <a href="https://drive.google.com/file/d/13Be63aeAeqLQqcZAKnf0JqMFoQ8gT_w-/view"
                                                        target="_blank"
                                                        class="inline-block px-4 py-2 bg-blue-500 text-white text-sm rounded hover:bg-blue-600 transition">
                                                        Lihat di Tab Baru
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- KOLOM 3: Evaluasi 5 -->
                                        <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                                            <h2 class="text-lg text-center font-bold border-b pb-2 mb-2">Evaluasi</h2>

                                            <label for="catatan-perbaikan-5" class="text-sm font-semibold">Catatan Perbaikan :</label>
                                            <textarea
                                                id="catatan-perbaikan-5"
                                                name="catatan_perbaikan_5"
                                                rows="8"
                                                class="w-full p-2 border rounded text-sm bg-gray-100 text-gray-700"
                                                disabled>Sudah benar</textarea>

                                            <label for="status-permohonan-5" class="text-sm font-semibold">Status Permohonan :</label>
                                            <select
                                                id="status-permohonan-5"
                                                name="status_permohonan_5"
                                                class="w-full border p-2 rounded text-sm bg-white text-gray-700"
                                                disabled>
                                                <option value="Disetujui" selected>Disetujui</option>
                                            </select>

                                            <!-- Tombol Simpan 3 -->
                                            <div class="pt-2 mt-6">
                                                <button class="bg-green-600 text-white font-semibold px-4 py-2 rounded w-full cursor-not-allowed" type="button" disabled>
                                                    Simpan Evaluasi
                                                </button>
                                            </div>


                                            <!-- Modal Pop-up 3 -->
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
                                            <h2 class="text-lg font-bold text-center border-b pb-2 mb-2">Data Mesin Penggerak Mula</h2>
                                            <div class="overflow-x-auto">
                                                <table class="w-full table-auto border-collapse border border-gray-300 text-sm text-left">
                                                    <thead class="bg-gray-100 min-w-[150px] max-w-[150px] w-[150px]">
                                                        <tr id="header-Data Instalasi">
                                                            <th>Data Mesin</th>
                                                            <th>Unit 1</th>
                                                            <th>Unit 2</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody id="body-Data Instalasi">
                                                        <tr>
                                                            <td class="text-left font-bold">Jenis Penggerak¹</td>
                                                            <td class="text-left">
                                                                PLTBM
                                                                <input type="hidden" name="jenis_1" value="datainstalasi" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                PLTD
                                                                <input type="hidden" name="jenis_2" value="datainstalasi" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left font-bold">Energi Primer Utama</td>
                                                            <td class="text-left align-middle">
                                                                FIBER
                                                                <input type="hidden" name="primer_1" value="datainstalasi" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                SOLAR
                                                                <input type="hidden" name="primer_2" value="datainstalasi" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left font-bold">Merk/Tipe/Seri</td>
                                                            <td class="text-left align-middle">
                                                                ELLIOT/DYRU G III/F202302-1
                                                                <input type="hidden" name="merek_1" value="datainstalasi" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                CAMLER-BENZ/OM 444 LA/402.900-000-260938/1
                                                                <input type="hidden" name="merek_2" value="datainstalasi" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left font-bold">Pabrikan/Tahun</td>
                                                            <td class="text-left align-middle">
                                                                USA/2012
                                                                <input type="hidden" name="pabrik_1" value="datainstalasi" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                JERMAN/-
                                                                <input type="hidden" name="pabrik_2" value="datainstalasi" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left font-bold">Kapasitas (KW/KVA)</td>
                                                            <td class="text-left align-middle">
                                                                2126
                                                                <input type="hidden" name="kapasitas_1" value="datainstalasi" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                135
                                                                <input type="hidden" name="kapasitas_2" value="datainstalasi" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left font-bold">Putaran (rpm)</td>
                                                            <td class="text-left align-middle">
                                                                5500
                                                                <input type="hidden" name="putaran_1" value="datainstalasi" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                1500
                                                                <input type="hidden" name="putaran_2" value="datainstalasi" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left font-bold">Lokasi Unit (Kab/Kota)</td>
                                                            <td class="text-left align-middle">
                                                                KAB. MUARO JAMBI
                                                                <input type="hidden" name="lokasi_1" value="datainstalasi" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                KAB. MUARO JAMBI
                                                                <input type="hidden" name="lokasi_2" value="datainstalasi" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left font-bold">Titik Kordinat</td>
                                                            <td class="text-left align-middle">
                                                                S 103°43'36.85" E 1°31'47.95" S
                                                                <input type="hidden" name="titikkoordinat_1" value="datainstalasi" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                S 103°43'36.99" E 1°31'47.88" S
                                                                <input type="hidden" name="titikkoordinat_2" value="datainstalasi" readonly>
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

                                                <!-- Iframe dengan fitur zoom -->
                                                <div class="w-full h-[500px] rounded overflow-hidden border">
                                                    <iframe
                                                        src="https://drive.google.com/file/d/13Be63aeAeqLQqcZAKnf0JqMFoQ8gT_w-/preview#zoom=100"
                                                        class="w-full h-full"
                                                        allowfullscreen>
                                                    </iframe>
                                                </div>
                                                <!-- Tombol Lihat di Tab Baru -->
                                                <div class="mt-2 text-right">
                                                    <a href="https://drive.google.com/file/d/13Be63aeAeqLQqcZAKnf0JqMFoQ8gT_w-/view"
                                                        target="_blank"
                                                        class="inline-block px-4 py-2 bg-blue-500 text-white text-sm rounded hover:bg-blue-600 transition">
                                                        Lihat di Tab Baru
                                                    </a>
                                                </div>
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
                                                class="w-full p-2 border rounded text-sm bg-gray-100 text-gray-700"
                                                disabled>Sudah benar</textarea>

                                            <label for="status-permohonan-6" class="text-sm font-semibold">Status Permohonan :</label>
                                            <select
                                                id="status-permohonan-6"
                                                name="status_permohonan_6"
                                                class="w-full border p-2 rounded text-sm bg-white text-gray-700"
                                                disabled>
                                                <option value="Disetujui" selected>Disetujui</option>
                                            </select>

                                            <!-- Tombol Simpan 1 -->
                                            <div class="pt-2 mt-6">
                                                <button class="bg-green-600 text-white font-semibold px-4 py-2 rounded w-full cursor-not-allowed" type="button" disabled>
                                                    Simpan Evaluasi
                                                </button>
                                            </div>


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
                                                <table class="w-full table-auto border-collapse border border-gray-300 text-sm text-left">
                                                    <thead class="bg-gray-100  min-w-[150px] max-w-[150px] w-[150px]">
                                                        <tr id="header-data generator">
                                                            <th>Data Generator</th>
                                                            <th>Unit 1</th>
                                                            <th>Unit 2</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody id="body-data generator">
                                                        <tr>
                                                            <td class="text-left font-bold">Merk/Tipe/Seri</td>
                                                            <td class="text-left">
                                                                ABB/SB-W4-2000-WA-34-1/603346
                                                                <input type="hidden" name="merek_1" value="datainstalasi" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                AVK/DKB-49/150-4TS/5133091
                                                                <input type="hidden" name="merek_2" value="datainstalasi" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left font-bold">Pabrikan/Tahun</td>
                                                            <td class="text-left align-middle">
                                                                -/2006
                                                                <input type="hidden" name="pabrik_1" value="datainstalasi" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                JERMAN/-
                                                                <input type="hidden" name="pabrik_2" value="datainstalasi" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left font-bold">Kapasitas (KW/KVA)</td>
                                                            <td class="text-left align-middle">
                                                                2000 KW/2500 KVA
                                                                <input type="hidden" name="kapasitas_1" value="datainstalasi" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                120 KW/150 KVA
                                                                <input type="hidden" name="kapasitas_2" value="datainstalasi" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left font-bold">Tegangan</td>
                                                            <td class="text-left align-middle">
                                                                400
                                                                <input type="hidden" name="tegangan_1" value="datainstalasi" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                400
                                                                <input type="hidden" name="tegangan_2" value="datainstalasi" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left font-bold">Arus (A)</td>
                                                            <td class="text-left align-middle">
                                                                3608
                                                                <input type="hidden" name="arus_1" value="datainstalasi" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                -
                                                                <input type="hidden" name="arus_2" value="datainstalasi" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left font-bold">Faktor Daya</td>
                                                            <td class="text-left align-middle">
                                                                0.8
                                                                <input type="hidden" name="faktordaya_1" value="datainstalasi" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                0.8
                                                                <input type="hidden" name="faktordaya_2" value="datainstalasi" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left font-bold">Fasa</td>
                                                            <td class="text-left align-middle">
                                                                3
                                                                <input type="hidden" name="fasa_1" value="datainstalasi" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                3
                                                                <input type="hidden" name="fasa_2" value="datainstalasi" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left font-bold">Frekuensi (Hz)</td>
                                                            <td class="text-left align-middle">
                                                                50
                                                                <input type="hidden" name="frekuensi_1" value="datainstalasi" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                50
                                                                <input type="hidden" name="frekuensi_2" value="datainstalasi" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left font-bold">Putaran (rpm)</td>
                                                            <td class="text-left align-middle">
                                                                1500
                                                                <input type="hidden" name="putaran_1" value="datainstalasi" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                1500
                                                                <input type="hidden" name="putaran_2" value="datainstalasi" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left font-bold">Lokasi Unit (Kab/Kota)</td>
                                                            <td class="text-left align-middle">
                                                                KAB. MUARO JAMBI
                                                                <input type="hidden" name="lokasi_1" value="datainstalasi" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                KAB. MUARO JAMBI
                                                                <input type="hidden" name="lokasi_2" value="datainstalasi" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left font-bold">Titik Kordinat²</td>
                                                            <td class="text-left align-middle">
                                                                S 103°43'36.85" E 1°31'47.95" S
                                                                <input type="hidden" name="titikkoordinat_1" value="datainstalasi" readonly>
                                                            </td>
                                                            <td class="text-left align-middle">
                                                                S 103°43'36.99" E 1°31'47.88" S
                                                                <input type="hidden" name="titikkoordinat_2" value="datainstalasi" readonly>
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

                                                <!-- Iframe dengan fitur zoom -->
                                                <div class="w-full h-[500px] rounded overflow-hidden border">
                                                    <iframe
                                                        src="https://drive.google.com/file/d/13Be63aeAeqLQqcZAKnf0JqMFoQ8gT_w-/preview#zoom=100"
                                                        class="w-full h-full"
                                                        allowfullscreen>
                                                    </iframe>
                                                </div>
                                                <!-- Tombol Lihat di Tab Baru -->
                                                <div class="mt-2 text-right">
                                                    <a href="https://drive.google.com/file/d/13Be63aeAeqLQqcZAKnf0JqMFoQ8gT_w-/view"
                                                        target="_blank"
                                                        class="inline-block px-4 py-2 bg-blue-500 text-white text-sm rounded hover:bg-blue-600 transition">
                                                        Lihat di Tab Baru
                                                    </a>
                                                </div>
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
                                                class="w-full p-2 border rounded text-sm bg-gray-100 text-gray-700"
                                                disabled>Sudah benar</textarea>

                                            <label for="status-permohonan-7" class="text-sm font-semibold">Status Permohonan :</label>
                                            <select
                                                id="status-permohonan-7"
                                                name="status_permohonan_7"
                                                class="w-full border p-2 rounded text-sm bg-white text-gray-700"
                                                disabled>
                                                <option value="Disetujui" selected>Disetujui</option>
                                            </select>

                                            <!-- Tombol Simpan 2 -->
                                            <div class="pt-2 mt-6">
                                                <button class="bg-green-600 text-white font-semibold px-4 py-2 rounded w-full cursor-not-allowed" type="button" disabled>
                                                    Simpan Evaluasi
                                                </button>
                                            </div>


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
                                        <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                                            <h2 class="text-lg font-bold text-center border-b pb-2 mb-2">Sambungan Listrik</h2>
                                            <div class="overflow-x-auto">
                                                <table class="w-full table-auto border-collapse border border-gray-300 text-sm text-left">
                                                    <thead class="bg-gray-100 ">
                                                        <tr>
                                                            <th class=" text-left w-[150px]"></th>
                                                            <th>Distribusi-1</th>
                                                            <th>Distribusi-2</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-left font-bold border ">Pemilik</td>
                                                            <td class="text-left">-<input type="hidden" name="pemilik_1" value="-" readonly></td>
                                                            <td class="text-left">-<input type="hidden" name="pemilik_2" value="-" readonly></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left font-bold border ">Tegangan (V)</td>
                                                            <td class="text-left">-<input type="hidden" name="tegangan_1" value="-" readonly></td>
                                                            <td class="text-left">-<input type="hidden" name="tegangan_2" value="-" readonly></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left font-bold border ">Panjang (Kms)</td>
                                                            <td class="text-left">-<input type="hidden" name="panjang_1" value="-" readonly></td>
                                                            <td class="text-left">-<input type="hidden" name="panjang_2" value="-" readonly></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left font-bold border ">Kabupaten/Kota</td>
                                                            <td class="text-left">-<input type="hidden" name="kabupaten_1" value="-" readonly></td>
                                                            <td class="text-left">-<input type="hidden" name="kabupaten_2" value="-" readonly></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left font-bold border ">Provinsi</td>
                                                            <td class="text-left">-<input type="hidden" name="provinsi_1" value="-" readonly></td>
                                                            <td class="text-left">-<input type="hidden" name="provinsi_2" value="-" readonly></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left font-bold border ">Koordinat</td>
                                                            <td class="text-left">-<input type="hidden" name="koordinat_1" value="-" readonly></td>
                                                            <td class="text-left">-<input type="hidden" name="koordinat_2" value="-" readonly></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left font-bold border ">Tahun Operasi</td>
                                                            <td class="text-left">-<input type="hidden" name="tahun_operasi_1" value="-" readonly></td>
                                                            <td class="text-left">-<input type="hidden" name="tahun_operasi_2" value="-" readonly></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <table class="min-w-full text-sm border border-gray-300 mt-6">
                                                <thead class="bg-gray-100">
                                                    <tr>
                                                        <th class="text-left w-[150px]"></th>
                                                        <th class="text-center">Transformator</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="font-bold text-left">Pemilik</td>
                                                        <td class="text-left">-</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-bold text-left">Tegangan Primer (V)</td>
                                                        <td class="text-left">-</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-bold text-left">Tegangan Sekunder (V)</td>
                                                        <td class="text-left">-</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-bold text-left">Kapasitas Daya (kVa)</td>
                                                        <td class="text-left">-</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-bold text-left">Kabupaten/Kota</td>
                                                        <td class="text-left">-</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-bold text-left">Provinsi</td>
                                                        <td class="text-left">-</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-bold text-left">Koordinat</td>
                                                        <td class="text-left">-</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-bold text-left">Tahun Operasi</td>
                                                        <td class="text-left">-</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- KOLOM 2: LAMPIRAN -->
                                        <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                                            <h2 class="text-lg text-center font-bold border-b pb-2 mb-2">Lampiran</h2>
                                            <div>

                                                <!-- Iframe dengan fitur zoom -->
                                                <div class="w-full h-[500px] rounded overflow-hidden border">
                                                    <iframe
                                                        src="https://drive.google.com/file/d/13Be63aeAeqLQqcZAKnf0JqMFoQ8gT_w-/preview#zoom=100"
                                                        class="w-full h-full"
                                                        allowfullscreen>
                                                    </iframe>
                                                </div>
                                                <!-- Tombol Lihat di Tab Baru -->
                                                <div class="mt-2 text-right">
                                                    <a href="https://drive.google.com/file/d/13Be63aeAeqLQqcZAKnf0JqMFoQ8gT_w-/view"
                                                        target="_blank"
                                                        class="inline-block px-4 py-2 bg-blue-500 text-white text-sm rounded hover:bg-blue-600 transition">
                                                        Lihat di Tab Baru
                                                    </a>
                                                </div>
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
                                                class="w-full p-2 border rounded text-sm bg-gray-100 text-gray-700"
                                                disabled>Sudah benar</textarea>

                                            <label for="status-permohonan-8" class="text-sm font-semibold">Status Permohonan :</label>
                                            <select
                                                id="status-permohonan-8"
                                                name="status_permohonan_8"
                                                class="w-full border p-2 rounded text-sm bg-white text-gray-700"
                                                disabled>
                                                <option value="Disetujui" selected>Disetujui</option>
                                            </select>

                                            <!-- Tombol Simpan 3 -->
                                            <div class="pt-2 mt-6">
                                                <button class="bg-green-600 text-white font-semibold px-4 py-2 rounded w-full cursor-not-allowed" type="button" disabled>
                                                    Simpan Evaluasi
                                                </button>
                                            </div>

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


                        <!-- HALAMAN 3 : KAPASITAS PRODUKSI TENAGA LISTRIK  -->
                        <div id="page3" class="hidden">
                            <h2 class="text-center font-bold text-lg bg-gray-100 p-3 rounded-t border-b border-gray-300">Kapasitas Produksi Tenaga Listrik</h2>

                            <!-- Container 4: KAPASITAS PRODUKSI TENAGA LISTRIK | EVALUASI -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 border border-gray-200 rounded shadow-sm overflow-hidden p-4">
                                <!-- KOLOM 1: KAPASITAS PRODUKSI TENAGA LISTRIK -->
                                <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                                    <h2 class="text-lg font-bold text-center border-b pb-2 mb-2">PLTBm</h2>
                                    <div class="overflow-x-auto">
                                        <table class="w-full table-auto border-collapse border border-gray-300 text-sm text-left">
                                            <thead class="bg-gray-100  min-w-[150px] max-w-[150px] w-[150px]">
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
                                                    <td class="text-left font-bold">Januari</td>
                                                    <td class="text-left">
                                                        2.500 kVA/2.000 Kw
                                                        <input type="hidden" name="januari1" value="kapasitas" readonly>
                                                    </td>
                                                    <td class="text-left align-middle">
                                                        0.8
                                                        <input type="hidden" name="januari2" value="kapasitas" readonly>
                                                    </td>
                                                    <td class="text-left align-middle">
                                                        -
                                                        <input type="hidden" name="januari3" value="kapasitas" readonly>
                                                    </td>
                                                    <td class="text-left align-middle">
                                                        -
                                                        <input type="hidden" name="januari4" value="kapasitas" readonly>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left font-bold">Februari</td>
                                                    <td class="text-left align-middle">
                                                        2.500 kVA/2.000 Kw
                                                        <input type="hidden" name="februari1" value="kapasitas" readonly>
                                                    </td>
                                                    <td class="text-left align-middle">
                                                        0.8
                                                        <input type="hidden" name="februari2" value="kapasitas" readonly>
                                                    </td>
                                                    <td class="text-left align-middle">
                                                        -
                                                        <input type="hidden" name="februari3" value="kapasitas" readonly>
                                                    </td>
                                                    <td class="text-left align-middle">
                                                        -
                                                        <input type="hidden" name="februari4" value="kapasitas" readonly>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left font-bold">Maret</td>
                                                    <td class="text-left align-middle">
                                                        2.500 kVA/2.000 Kw
                                                        <input type="hidden" name="maret1" value="kapasitas" readonly>
                                                    </td>
                                                    <td class="text-left align-middle">
                                                        0.8
                                                        <input type="hidden" name="maret2" value="kapasitas" readonly>
                                                    </td>
                                                    <td class="text-left align-middle">
                                                        -
                                                        <input type="hidden" name="maret3" value="kapasitas" readonly>
                                                    </td>
                                                    <td class="text-left align-middle">
                                                        -
                                                        <input type="hidden" name="maret4" value="kapasitas" readonly>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left font-bold">April</td>
                                                    <td class="text-left align-middle">
                                                        2.500 kVA/2.000 Kw
                                                        <input type="hidden" name="april1" value="kapasitas" readonly>
                                                    </td>
                                                    <td class="text-left align-middle">
                                                        0.8
                                                        <input type="hidden" name="april2" value="kapasitas" readonly>
                                                    </td>
                                                    <td class="text-left align-middle">
                                                        -
                                                        <input type="hidden" name="april3" value="kapasitas" readonly>
                                                    </td>
                                                    <td class="text-left align-middle">
                                                        -
                                                        <input type="hidden" name="april4" value="kapasitas" readonly>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- KOLOM 2: Evaluasi 9 -->
                                <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                                    <h2 class="text-lg text-center font-bold border-b pb-2 mb-2">Evaluasi</h2>

                                    <label for="catatan-perbaikan-9" class="text-sm font-semibold">Catatan Perbaikan :</label>
                                    <textarea
                                        id="catatan-perbaikan-9"
                                        name="catatan_perbaikan_9"
                                        rows="8"
                                        class="w-full p-2 border rounded text-sm bg-gray-100 text-gray-700"
                                        disabled>Sudah benar</textarea>

                                    <label for="status-permohonan-9" class="text-sm font-semibold">Status Permohonan :</label>
                                    <select
                                        id="status-permohonan-9"
                                        name="status_permohonan_9"
                                        class="w-full border p-2 rounded text-sm bg-white text-gray-700"
                                        disabled>
                                        <option value="Disetujui" selected>Disetujui</option>
                                    </select>

                                    <!-- Tombol Simpan 4 -->
                                    <div class="pt-2 mt-6">
                                        <button class="bg-green-600 text-white font-semibold px-4 py-2 rounded w-full cursor-not-allowed" type="button" disabled>
                                            Simpan Evaluasi
                                        </button>
                                    </div>


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


                                <!--Container : GENSET/PLTD -->
                                <div class="grid grid-cols-1 gap-4 border-gray-200 rounded shadow-sm">
                                    <!-- KOLOM 1: GENSET / PLTD -->
                                    <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                                        <h2 class="text-lg text-center font-bold border-b pb-2 mb-2">PLTD</h2>
                                        <div class="overflow-x-auto">
                                            <table class="w-full table-auto border-collapse border border-gray-300 text-sm text-left">
                                                <thead class="bg-gray-100  min-w-[150px] max-w-[150px] w-[150px]">
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
                                                        <td class="text-left font-bold">Januari</td>
                                                        <td class="text-left align-middle">
                                                            2.500 kVA/2.000 Kw
                                                            <input type="hidden" name="januari1" value="genset" readonly>
                                                        </td>
                                                        <td class="text-left align-middle">
                                                            0.8
                                                            <input type="hidden" name="januari2" value="genset" readonly>
                                                        </td>
                                                        <td class="text-left align-middle">
                                                            -
                                                            <input type="hidden" name="januari3" value="genset" readonly>
                                                        </td>
                                                        <td class="text-left align-middle">
                                                            -
                                                            <input type="hidden" name="januari4" value="genset" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-left font-bold">Februari</td>
                                                        <td class="text-left align-middle">
                                                            2.500 kVA/2.000 Kw
                                                            <input type="hidden" name="februari1" value="genset" readonly>
                                                        </td>
                                                        <td class="text-left align-middle">
                                                            0.8
                                                            <input type="hidden" name="februari2" value="genset" readonly>
                                                        </td>
                                                        <td class="text-left align-middle">
                                                            -
                                                            <input type="hidden" name="februari3" value="genset" readonly>
                                                        </td>
                                                        <td class="text-left align-middle">
                                                            -
                                                            <input type="hidden" name="februari4" value="genset" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-left font-bold">Maret</td>
                                                        <td class="text-left align-middle">
                                                            2.500 kVA/2.000 Kw
                                                            <input type="hidden" name="maret1" value="genset" readonly>
                                                        </td>
                                                        <td class="text-left align-middle">
                                                            0.8
                                                            <input type="hidden" name="maret2" value="genset" readonly>
                                                        </td>
                                                        <td class="text-left align-middle">
                                                            -
                                                            <input type="hidden" name="maret3" value="genset" readonly>
                                                        </td>
                                                        <td class="text-left align-middle">
                                                            -
                                                            <input type="hidden" name="maret4" value="genset" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-left font-bold">April</td>
                                                        <td class="text-left align-middle">
                                                            2.500 kVA/2.000 Kw
                                                            <input type="hidden" name="april1" value="genset" readonly>
                                                        </td>
                                                        <td class="text-left align-middle">
                                                            0.8
                                                            <input type="hidden" name="april1" value="genset" readonly>
                                                        </td>
                                                        <td class="text-left align-middle">
                                                            -
                                                            <input type="hidden" name="april1" value="genset" readonly>
                                                        </td>
                                                        <td class="text-left align-middle">
                                                            -
                                                            <input type="hidden" name="april1" value="genset" readonly>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- KOLOM 2: Evaluasi 10 -->
                                <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                                    <h2 class="text-lg text-center font-bold border-b pb-2 mb-2">Evaluasi</h2>

                                    <label for="catatan-perbaikan-10" class="text-sm font-semibold">Catatan Perbaikan :</label>
                                    <textarea
                                        id="catatan-perbaikan-10"
                                        name="catatan_perbaikan_10"
                                        rows="8"
                                        class="w-full p-2 border rounded text-sm bg-gray-100 text-gray-700"
                                        disabled>Sudah benar</textarea>

                                    <label for="status-permohonan-10" class="text-sm font-semibold">Status Permohonan :</label>
                                    <select
                                        id="status-permohonan-10"
                                        name="status_permohonan_10"
                                        class="w-full border p-2 rounded text-sm bg-white text-gray-700"
                                        disabled>
                                        <option value="Disetujui" selected>Disetujui</option>
                                    </select>

                                    <!-- Tombol Simpan 5 -->
                                    <div class="pt-2 mt-6">
                                        <button class="bg-green-600 text-white font-semibold px-4 py-2 rounded w-full cursor-not-allowed" type="button" disabled>
                                            Simpan Evaluasi
                                        </button>
                                    </div>


                                    <!-- Modal Pop-up 5 -->
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

                                <!--Penjualan kelebihan tenaga listrik/Excess Power. -->
                                <div class="grid grid-cols-1 gap-4 border-gray-200 rounded shadow-sm">
                                    <!-- KOLOM 1: Penjualan kelebihan tenaga listrik -->
                                    <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                                        <h2 class="text-lg font-bold text-center border-b pb-2 mb-2">Penjualan Kelebihan Tenaga Listrik</h2>
                                        <div class="overflow-x-auto">
                                            <table class="w-full table-auto border-collapse border border-gray-300 text-sm text-left">
                                                <thead class="bg-gray-100  min-w-[150px] max-w-[150px] w-[150px]">
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
                                                        <td class="text-left font-bold">Januari</td>
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
                                                        <td class="text-left font-bold">Februari</td>
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
                                                        <td class="text-left font-bold">dst</td>
                                                        <td colspan="9"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- KOLOM 2: Evaluasi 11 -->
                                <div class="bg-white rounded shadow p-4 space-y-4 border-2 border-gray-300">
                                    <h2 class="text-lg text-center font-bold border-b pb-2 mb-2">Evaluasi</h2>

                                    <label for="catatan-perbaikan-11" class="text-sm font-semibold">Catatan Perbaikan :</label>
                                    <textarea
                                        id="catatan-perbaikan-11"
                                        name="catatan_perbaikan_11"
                                        rows="8"
                                        class="w-full p-2 border rounded text-sm bg-gray-100 text-gray-700"
                                        disabled>Sudah benar</textarea>

                                    <label for="status-permohonan-11" class="text-sm font-semibold">Status Permohonan :</label>
                                    <select
                                        id="status-permohonan-11"
                                        name="status_permohonan_11"
                                        class="w-full border p-2 rounded text-sm bg-white text-gray-700"
                                        disabled>
                                        <option value="Disetujui" selected>Disetujui</option>
                                    </select>

                                    <!-- Tombol Simpan 6 -->
                                    <div class="pt-2 mt-6">
                                        <button class="bg-green-600 text-white font-semibold px-4 py-2 rounded w-full cursor-not-allowed" type="button" disabled>
                                            Simpan Evaluasi
                                        </button>
                                    </div>


                                    <!-- Modal Pop-up 6 -->
                                    <div id="popupBerhasil11" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
                                        <div class="bg-white p-6 rounded-lg shadow-lg text-center w-80">
                                            <h2 class="text-lg font-semibold text-green-700 mb-2">Berhasil!</h2>
                                            <p class="text-gray-700 mb-4">Evaluasi berhasil disimpan.</p>
                                            <button onclick="tutupPopup11()" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded">
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
                                <!-- Tombol Kirim Hasil Evaluasi -->

                                <div class="relative inline-block">
                                    <button onclick="openKirimHasilModal()" class="px-5 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition">
                                        Proses Laporan Bekala
                                    </button>
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
                                            showPage.scrollIntoView({
                                                behavior: "auto",
                                                block: "start"
                                            });
                                        });
                                    }

                                    function nextPage() {
                                        showPage("page1", "page2");
                                    }

                                    function prevPage() {
                                        showPage("page2", "page1");
                                    }
                                </script>

                                <script>
                                    function openModal(docName) {
                                        document.getElementById('modal-evaluasi').classList.remove('hidden');
                                        document.body.classList.add('overflow-hidden');
                                        document.getElementById('nama-dokumen').textContent = Dokumen: $ {
                                            docName
                                        };
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
                                        console.log(Evaluasi disimpan untuk $ {
                                            doc
                                        }: $ {
                                            status
                                        }, Catatan: $ {
                                            catatan
                                        });
                                        closeModal();
                                    }
                                </script>

                                <div id="modal-kirim-hasil" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
                                    <div class="bg-white dark:bg-slate-800 rounded-lg p-6 w-full max-w-sm shadow-lg relative">

                                        <!-- Tombol 1: Penugasan Evaluator (Nonaktif) -->
                                        <button disabled class="w-full text-left px-4 py-2 mb-3 bg-yellow-300 text-white rounded cursor-not-allowed opacity-60">
                                            Penugasan Evaluator
                                        </button>

                                        <!-- Tombol 2: Perbaikan (Nonaktif) -->
                                        <button disabled class="w-full text-left px-4 py-2 mb-3 bg-red-300 text-white rounded cursor-not-allowed opacity-60">
                                            Perbaikan
                                        </button>

                                        <!-- Tombol 3: Verifikasi (Aktif) -->
                                        <button onclick="verifikasiDokumen()" class="w-full text-left px-4 py-2 mb-3 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                                            Verifikasi
                                        </button>

                                        <!-- Tombol Close -->
                                        <button onclick="closeKirimHasilModal()" class="absolute top-0 right-2 font-bold text-xl text-gray-600 hover:text-gray-900 dark:hover:text-white">&times;</button>
                                    </div>
                                </div>


                                <script>
                                    function openKirimHasilModal() {
                                        document.getElementById('modal-kirim-hasil').classList.remove('hidden');
                                        document.body.classList.add('overflow-hidden');
                                    }

                                    function closeKirimHasilModal() {
                                        document.getElementById('modal-kirim-hasil').classList.add('hidden');
                                        document.body.classList.remove('overflow-hidden');
                                    }

                                    // fungsi kirim langsung
                                    function kirimLangsung() {
                                        alert("Dokumen dikirim ke Validator.");
                                        closeKirimHasilModal();
                                        // Tambahkan aksi kirim langsung sesuai kebutuhanmu
                                    }
                                </script>

                                <script>
                                    function openKirimHasilModal() {
                                        document.getElementById('modal-kirim-hasil')?.classList.remove('hidden');
                                        document.body.classList.add('overflow-hidden');
                                    }

                                    function closeKirimHasilModal() {
                                        document.getElementById('modal-kirim-hasil')?.classList.add('hidden');
                                        document.body.classList.remove('overflow-hidden');
                                    }

                                    function verifikasiDokumen() {
                                        closeKirimHasilModal(); // Tutup modal pengiriman

                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Verifikasi Berhasil',
                                            text: 'Data Telah Dikirim Untuk Proses Validasi.',
                                            confirmButtonText: 'OK',
                                            customClass: {
                                                confirmButton: 'swal2-confirm btn-primary'
                                            }
                                        }).then(() => {
                                            // Redirect ke halaman setelah verifikasi
                                            window.location.href = "/daftarlaporanberkalakabid"; // ganti URL ini sesuai kebutuhan
                                        });
                                    }
                                </script>
                                <!-- Modal Popup Proses Verifikasi 
                                <div id="verifikasi-popup" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
                                    <div class="bg-white dark:bg-slate-800 rounded-lg p-6 w-full max-w-sm shadow-lg relative">
                                        <h3 class="text-lg font-semibold mb-4 text-center text-gray-800 dark:text-white">Verifikasi</h3>
                                        <p class="text-sm text-gray-700 dark:text-gray-300 text-center mb-4">Data Telah Dikirim Untuk Proses Validasi</p>
                                        <div class="flex justify-center">
                                            <a href="javascript:history.back()" class="inline-block px-5 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition text-center">
                                                Tutup</a>
                                        </div>
                                    </div>
                                </div>-->

                                <!-- Script JavaScript 
                                <script>
                                    // Sembunyikan semua popup lain (misalnya evaluasi, revisi, dll) di sini
                                    function closeAllOtherPopups() {
                                        const allPopups = ['modal-evaluator', 'modal-revisi', 'modal-kirim-hasil']; // tambahkan ID popup lain jika ada
                                        allPopups.forEach(id => {
                                            const el = document.getElementById(id);
                                            if (el) el.classList.add('hidden');
                                        });
                                    }

                                    function openVerifikasiPopup() {
                                        closeAllOtherPopups(); // pastikan popup lain disembunyikan
                                        document.getElementById('verifikasi-popup').classList.remove('hidden');
                                        document.body.classList.add('overflow-hidden');
                                    }

                                    function closeVerifikasiPopup() {
                                        document.getElementById('verifikasi-popup').classList.add('hidden');
                                        document.body.classList.remove('overflow-hidden');
                                    }

                                    function redirectAfterVerifikasi() {
                                        // Tutup popup (opsional)
                                        closeVerifikasiPopup();
                                        // Redirect ke halaman lain
                                        window.location.href = "/verifikasi/selesai"; // ganti dengan URL tujuanmu
                                    }
                                </script>-->

                                <!-- Modal Perbaikan -->
                                <div id="modal-evaluasi" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
                                    <div class="bg-white dark:bg-slate-800 rounded-xl p-6 w-full max-w-md shadow-lg relative">
                                        <!-- Catatan -->
                                        <label class="text-sm font-semibold text-gray-700 dark:text-white mb-1">Catatan Perbaikan :</label>
                                        <textarea id="catatan-evaluasi" rows="8" class="w-full p-2 border rounded text-sm mb-4" placeholder="Tulis catatan perbaikan..."></textarea>

                                        <!-- Status 
                        <label class="text-sm font-semibold text-gray-700 dark:text-white mb-1">Status Permohonan :</label>
                        <select id="status-evaluasi" class="w-full border p-2 rounded text-sm mb-4">
                          <option value="" disabled selected hidden>-- Status --</option>
                          <option value="Disetujui">Disetujui</option>
                          <option value="Ditolak">Ditolak</option>
                        </select>-->

                                        <!-- Tombol Aksi -->
                                        <div class="pt-2 flex justify-end gap-2">
                                            <button onclick="closeModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-4 py-2 rounded">
                                                Batal
                                            </button>
                                            <button onclick="simpanEvaluasi()" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded">
                                                Kirim
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Pop-up 1 -->
                                <div id="popupBerhasil1" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
                                    <div class="bg-white p-6 rounded-lg shadow-lg text-center w-80">
                                        <h2 class="text-lg font-semibold text-green-700 mb-2">Berhasil!</h2>
                                        <p class="text-gray-700 mb-4">Evaluasi Berhasil Disimpan</p>
                                        <button onclick="tutupPopup1()" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded">
                                            OK
                                        </button>
                                    </div>
                                </div>

                                <script>
                                    function openModal() {
                                        closeKirimHasilModal(); // Fungsi ini diasumsikan sudah didefinisikan di tempat lain
                                        const modal = document.getElementById('modal-evaluasi');
                                        if (modal) {
                                            modal.classList.remove('hidden');
                                            document.body.classList.add('overflow-hidden');

                                            // Reset nilai input
                                            const catatan = document.getElementById('catatan-evaluasi');
                                            const status = document.getElementById('status-evaluasi');
                                            if (catatan) catatan.value = '';
                                            if (status) status.value = '';
                                        }
                                    }

                                    function closeModal() {
                                        const modal = document.getElementById('modal-evaluasi');
                                        if (modal) {
                                            modal.classList.add('hidden');
                                            document.body.classList.remove('overflow-hidden');
                                        }
                                    }

                                    function tampilkanPopup1() {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Berhasil!',
                                            text: 'Evaluasi Berhasil Disimpan.',
                                            confirmButtonText: 'OK',
                                            customClass: {
                                                confirmButton: 'swal2-confirm btn-primary'
                                            }
                                        });
                                        closeModal();
                                    }

                                    function tampilkanPopup2() {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Berhasil!',
                                            text: 'Evaluasi Berhasil Disimpan.',
                                            confirmButtonText: 'OK',
                                            customClass: {
                                                confirmButton: 'swal2-confirm btn-primary'
                                            }
                                        });
                                        closeModal();
                                    }

                                    function simpanEvaluasi() {
                                        const catatan = document.getElementById('catatan-evaluasi')?.value.trim();

                                        if (!catatan) {
                                            Swal.fire({
                                                icon: 'warning',
                                                title: 'Catatan Wajib Diisi',
                                                text: 'Silakan Isi Catatan Sebelum Menyimpan Evaluasi.',
                                                confirmButtonText: 'OK',
                                                focusConfirm: true,
                                                customClass: {
                                                    confirmButton: 'swal2-confirm btn-primary'
                                                }
                                            });
                                            return;
                                        }

                                        console.log("Catatan:", catatan);
                                        closeModal();

                                        // Tampilkan notifikasi sukses
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Evaluasi Disimpan',
                                            text: 'Catatan Evaluasi Telah Berhasil Disimpan.',
                                            confirmButtonText: 'OK',
                                            focusConfirm: true,
                                            customClass: {
                                                confirmButton: 'swal2-confirm btn-primary'
                                            }
                                        });
                                    }

                                    // Jika masih dibutuhkan untuk nutup popup manual
                                    function tutupPopup1() {
                                        closeModal();
                                    }

                                    function tutupPopup2() {
                                        closeModal();
                                    }
                                </script>


                                <!-- Popup Notifikasi Evaluasi
                                <div id="popup-evaluasi-notif" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 hidden z-[999]">
                                    <div class="bg-white dark:bg-slate-800 rounded-lg p-6 max-w-sm w-full shadow-lg text-center">
                                        <p class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Terkirim ke Badan Usaha</p>
                                        <a href="javascript:history.back()" class="inline-block px-5 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition text-center">
                                            Tutup</a>
                                    </div>
                                </div>
 -->
                                <script>
                                    function showPopupEvaluasi() {
                                        closeKirimHasilModal(); // Tutup modal kirim hasil
                                        document.getElementById('popup-evaluasi-notif').classList.remove('hidden');
                                        document.body.classList.add('overflow-hidden');
                                    }


                                    function closePopupEvaluasi() {
                                        document.getElementById('popup-evaluasi-notif').classList.add('hidden');
                                        document.body.classList.remove('overflow-hidden');
                                    }
                                </script>



                                <!-- Modal Pilih Evaluator -->
                                <div id="modal-evaluator" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
                                    <div class="bg-white dark:bg-slate-800 rounded-xl p-6 w-full max-w-2xl shadow-lg relative max-h-[90vh] flex flex-col">

                                        <h2 class="text-xl font-bold mb-4 text-gray-800 dark:text-white">Penugasan Evaluator</h2>

                                        <!-- Scrollable Evaluator List -->
                                        <div class="space-y-4 overflow-y-auto pr-2" style="max-height: 60vh;">
                                            <!-- Evaluator 1 -->
                                            <label class="flex items-center gap-4 border p-3 rounded-lg cursor-pointer hover:bg-gray-100 dark:hover:bg-slate-700 transition-all">
                                                <input type="radio" name="evaluator" value="evaluator1" class="hidden peer" />
                                                <img src="https://img.freepik.com/vektor-premium/ilustrasi-datar-vektor-dalam-skala-abu-abu-ikon-orang-profil-pengguna-avatar-gambar-profil-siluet-netral-gender-cocok-untuk-ikon-profil-media-sosial-screensaver-dan-sebagai-templatx9xa_719432-1096.jpg" alt="Foto Evaluator" class="w-12 h-12 rounded-full object-cover" />
                                                <div>
                                                    <p class="font-semibold text-gray-800 dark:text-white">Ahmad Yusuf</p>
                                                    <p class="text-sm text-gray-500 dark:text-gray-300">NIP: 1987654321</p>
                                                </div>
                                                <div class="ml-auto hidden peer-checked:flex items-center justify-center w-6 h-6 rounded-full bg-blue-500 text-white font-bold transition-all duration-200">
                                                    ✓
                                                </div>
                                            </label>

                                            <!-- Evaluator 2 -->
                                            <label class="flex items-center gap-4 border p-3 rounded-lg cursor-pointer hover:bg-gray-100 dark:hover:bg-slate-700 transition-all">
                                                <input type="radio" name="evaluator" value="evaluator2" class="hidden peer" />
                                                <img src="https://img.freepik.com/vektor-premium/ilustrasi-datar-vektor-dalam-skala-abu-abu-ikon-orang-profil-pengguna-avatar-gambar-profil-siluet-netral-gender-cocok-untuk-ikon-profil-media-sosial-screensaver-dan-sebagai-templatx9xa_719432-1096.jpg" alt="Foto Evaluator" class="w-12 h-12 rounded-full object-cover" />
                                                <div>
                                                    <p class="font-semibold text-gray-800 dark:text-white">Siti Rahmawati</p>
                                                    <p class="text-sm text-gray-500 dark:text-gray-300">NIP: 1990123456</p>
                                                </div>
                                                <div class="ml-auto hidden peer-checked:flex items-center justify-center w-6 h-6 rounded-full bg-blue-500 text-white font-bold transition-all duration-200">
                                                    ✓
                                                </div>
                                            </label>

                                            <!-- Evaluator 3 -->
                                            <label class="flex items-center gap-4 border p-3 rounded-lg cursor-pointer hover:bg-gray-100 dark:hover:bg-slate-700 transition-all">
                                                <input type="radio" name="evaluator" value="evaluator3" class="hidden peer" />
                                                <img src="https://img.freepik.com/vektor-premium/ilustrasi-datar-vektor-dalam-skala-abu-abu-ikon-orang-profil-pengguna-avatar-gambar-profil-siluet-netral-gender-cocok-untuk-ikon-profil-media-sosial-screensaver-dan-sebagai-templatx9xa_719432-1096.jpg" alt="Foto Evaluator" class="w-12 h-12 rounded-full object-cover" />
                                                <div>
                                                    <p class="font-semibold text-gray-800 dark:text-white">Rizki Monika</p>
                                                    <p class="text-sm text-gray-500 dark:text-gray-300">NIP: 19901234587</p>
                                                </div>
                                                <div class="ml-auto hidden peer-checked:flex items-center justify-center w-6 h-6 rounded-full bg-blue-500 text-white font-bold transition-all duration-200">
                                                    ✓
                                                </div>
                                            </label>

                                            <!-- Tambahkan evaluator baru sebanyak yang kamu mau disini -->
                                            <!-- Contoh evaluator tambahan -->
                                            <label class="flex items-center gap-4 border p-3 rounded-lg cursor-pointer hover:bg-gray-100 dark:hover:bg-slate-700 transition-all">
                                                <input type="radio" name="evaluator" value="evaluator4" class="hidden peer" />
                                                <img src="https://img.freepik.com/vektor-premium/ilustrasi-datar-vektor-dalam-skala-abu-abu-ikon-orang-profil-pengguna-avatar-gambar-profil-siluet-netral-gender-cocok-untuk-ikon-profil-media-sosial-screensaver-dan-sebagai-templatx9xa_719432-1096.jpg" alt="Foto Evaluator" class="w-12 h-12 rounded-full object-cover" />
                                                <div>
                                                    <p class="font-semibold text-gray-800 dark:text-white">Budi Santoso</p>
                                                    <p class="text-sm text-gray-500 dark:text-gray-300">NIP: 1990112233</p>
                                                </div>
                                                <div class="ml-auto hidden peer-checked:flex items-center justify-center w-6 h-6 rounded-full bg-blue-500 text-white font-bold transition-all duration-200">
                                                    ✓
                                                </div>
                                            </label>

                                            <label class="flex items-center gap-4 border p-3 rounded-lg cursor-pointer hover:bg-gray-100 dark:hover:bg-slate-700 transition-all">
                                                <input type="radio" name="evaluator" value="evaluator4" class="hidden peer" />
                                                <img src="https://img.freepik.com/vektor-premium/ilustrasi-datar-vektor-dalam-skala-abu-abu-ikon-orang-profil-pengguna-avatar-gambar-profil-siluet-netral-gender-cocok-untuk-ikon-profil-media-sosial-screensaver-dan-sebagai-templatx9xa_719432-1096.jpg" alt="Foto Evaluator" class="w-12 h-12 rounded-full object-cover" />
                                                <div>
                                                    <p class="font-semibold text-gray-800 dark:text-white">Budi Santoso</p>
                                                    <p class="text-sm text-gray-500 dark:text-gray-300">NIP: 1990112233</p>
                                                </div>
                                                <div class="ml-auto hidden peer-checked:flex items-center justify-center w-6 h-6 rounded-full bg-blue-500 text-white font-bold transition-all duration-200">
                                                    ✓
                                                </div>
                                            </label>

                                            <label class="flex items-center gap-4 border p-3 rounded-lg cursor-pointer hover:bg-gray-100 dark:hover:bg-slate-700 transition-all">
                                                <input type="radio" name="evaluator" value="evaluator4" class="hidden peer" />
                                                <img src="https://img.freepik.com/vektor-premium/ilustrasi-datar-vektor-dalam-skala-abu-abu-ikon-orang-profil-pengguna-avatar-gambar-profil-siluet-netral-gender-cocok-untuk-ikon-profil-media-sosial-screensaver-dan-sebagai-templatx9xa_719432-1096.jpg" alt="Foto Evaluator" class="w-12 h-12 rounded-full object-cover" />
                                                <div>
                                                    <p class="font-semibold text-gray-800 dark:text-white">Budi Santoso</p>
                                                    <p class="text-sm text-gray-500 dark:text-gray-300">NIP: 1990112233</p>
                                                </div>
                                                <div class="ml-auto hidden peer-checked:flex items-center justify-center w-6 h-6 rounded-full bg-blue-500 text-white font-bold transition-all duration-200">
                                                    ✓
                                                </div>
                                            </label>

                                            <!-- dst... -->
                                        </div>

                                        <!-- Tombol Aksi di Bawah -->
                                        <div class="mt-6 space-y-3">
                                            <button onclick="kirimKeEvaluator()" class="w-full px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                                                Kirim
                                            </button>
                                            <button onclick="closeEvaluatorModal()" class="w-full px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition">
                                                Batal
                                            </button>
                                        </div>
                                    </div>
                                </div>



                                <!-- Popup Notifikasi 
                                <div id="popup-notif" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 hidden z-[999]">
                                    <div class="bg-white dark:bg-slate-800 rounded-lg p-6 max-w-sm w-full shadow-lg text-center">
                                        <p class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Dokumen Berhasil Dikirim Evaluator</p>
                                        <a href="javascript:history.back()" class="inline-block px-5 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition text-center">
                                            Tutup</a>
                                    </div>
                                </div>-->

                                <script>
                                    function openEvaluatorModal() {
                                        closeKirimHasilModal(); // Tutup modal kirim hasil (fungsi eksternal)
                                        const modal = document.getElementById('modal-evaluator');
                                        if (modal) {
                                            modal.classList.remove('hidden');
                                            document.body.classList.add('overflow-hidden');
                                        }
                                    }

                                    function closeEvaluatorModal() {
                                        const modal = document.getElementById('modal-evaluator');
                                        if (modal) {
                                            modal.classList.add('hidden');
                                            document.body.classList.remove('overflow-hidden');
                                        }
                                    }

                                    function kirimKeEvaluator() {
                                        const selected = document.querySelector('input[name="evaluator"]:checked');
                                        if (!selected) {
                                            Swal.fire({
                                                icon: 'warning',
                                                title: 'Evaluator Belum Dipilih',
                                                text: 'Silakan Pilih Salah Satu Evaluator Sebelum Mengirim.',
                                                confirmButtonText: 'OK',
                                                customClass: {
                                                    confirmButton: 'swal2-confirm btn-primary'
                                                }
                                            });
                                            return;
                                        }

                                        const evaluatorID = selected.value;
                                        console.log("Evaluator yang dipilih:", evaluatorID);

                                        // Tutup modal evaluator
                                        closeEvaluatorModal();

                                        // Notifikasi berhasil
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Dokumen Terkirim',
                                            text: 'Dokumen Berhasil Dikirim Ke Evaluator.',
                                            confirmButtonText: 'OK',
                                            customClass: {
                                                confirmButton: 'swal2-confirm btn-primary'
                                            }
                                        }).then(() => {
                                            // Kembali ke halaman sebelumnya setelah notifikasi
                                             window.location.href = "/daftarlaporanberkalakabid"; // Atau gunakan window.location.href jika mau arahkan ke URL tertentu
                                        });
                                    }

                                   
                                </script>





                                <!--
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
                            </script>-->

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