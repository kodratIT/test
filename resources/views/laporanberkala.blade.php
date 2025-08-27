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
              <a class="text-white opacity-50" href="javascript:;">Halaman</a>
            </li>
            <li
              class="text-sm pl-2 capitalize leading-normal text-white before:float-left before:pr-2 before:text-white before:content-['/']"
              aria-current="page">Buat Pengajuan</li>
          </ol>
          <h6 class="mb-4 font-bold text-white capitalize">Buat Pengajuan</h6>
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

    <!-- Card Form Pengajuan Surat -->
    <div class="flex justify-center px-3 mb-6">
      <div class="w-full max-w-full px-3 mb-6 sm:w-full sm:flex-none xl:mb-0 xl:w-full">
        <div
          class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
          <div class="flex-auto p-4">
            <div class="flex flex-col -mx-3">
              <div class="w-full max-w-full px-3">

                <h2 class="text-xl font-bold mb-6 uppercase text-center text-gray-700 dark:text-white">laporan Berkala</h2>




                <form action="{{ route('pengajuan.store') }}"
                  method="POST"
                  enctype="multipart/form-data"
                  novalidate
                  onsubmit="return validateForm(event)">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div id="page1" class="page">

                    <!-- IZIN USAHA -->
                    <h3 class="text-lg font-bold uppercase mt-2 pb-2 text-gray-700 dark:text-white">Izin Usaha Penyediaan Tenaga Listrik</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                      <div>
                        <label>Nomor</label>
                        <input name="nomor_izin_usaha" id="nomor_izin_usaha" type="text" class="w-full border p-2 rounded-lg" required>
                      </div>
                      <div>
                        <label>Tanggal</label>
                        <input name="tanggal_izin_usaha" id="tanggal_izin_usaha" type="date" class="w-full border p-2 rounded-lg datepicker" placeholder="DD-MM-YYYY" required>
                      </div>
                      <div>
                        <label>Masa Berlaku</label>
                        <input name="masa_berlaku_izin_usaha" id="masa_berlaku_izin_usaha" type="date" class="w-full border p-2 rounded-lg datepicker" placeholder="DD-MM-YYYY" required>
                      </div>
                      <div>
                        <label>Kelebihan Tenaga Listrik dijual Kepada</label>
                        <input name="kelebihan_listrik" id="kelebihan_listrik" type="text" class="w-full border p-2 rounded-lg" required>
                      </div>

                    </div>
                    <div class="mt-6">
                      <label>Upload Lampiran IUPLTS </label>
                      <input id="lampiran_izin_usaha" name="lampiran_izin_usaha" type="file" accept=".pdf" class="w-full border p-2 rounded-lg" required onchange="previewFile(this)">
                      <small class="text-gray-500">Format PDF Maks 5MB</small>
                    </div>
                    <div id="preview_lampiran_izin_usaha"></div>

                    <!-- IZIN LINGKUNGAN    -->
                    <h3 class="text-lg font-bold uppercase mt-6 pb-2 text-gray-700 dark:text-white">Izin Lingkungan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                      <div>
                        <label>Jenis Izin</label>
                        <input name="jenis_izin_lingkungan" id="jenis_izin_lingkungan" type="text" class="w-full border p-2 rounded-lg" required>
                      </div>
                      <div>
                        <label>Nomor</label>
                        <input name="nomor_izin_lingkungan" id="nomor_izin_lingkungan" type="text" class="w-full border p-2 rounded-lg" required>
                      </div>
                      <div>
                        <label>Tanggal</label>
                        <input name="tanggal_izin_lingkungan" id="tanggal_izin_lingkungan" type="text" class="w-full border p-2 rounded-lg datepicker" placeholder="DD-MM-YYYY" required>
                      </div>
                      <div>
                        <label>Masa Berlaku</label>
                        <input name="masa_berlaku_izin_lingkungan" id="masa_berlaku_izin_lingkungan" type="text" class="w-full border p-2 rounded-lg datepicker" placeholder="DD-MM-YYYY" required>
                      </div>
                    </div>

                    <div class="mt-6">
                      <label>Upload Lampiran Izin Lingkungan</label>
                      <input id="lampiran_izin_lingkungan" name="lampiran_izin_lingkungan" type="file" accept=".pdf" class="w-full border p-2 rounded-lg" required onchange="previewFile(this)">
                      <small class="text-gray-500">Format PDF Maks 5MB</small>
                    </div>
                    <div id="preview_lampiran_izin_lingkungan"></div>

                    <!-- Tombol Aksi -->

                    <h3 class="text-lg font-bold uppercase mt-6 pb-2 text-gray-700 dark:text-white">Sertifikat Laik Operasi (SLO)</h3>


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
                          <tr>
                            <td class="border border-gray-300 p-2 font-semibold bg-gray-50 sticky left-0">Nomor Sertifikat</td>
                            <td class="border border-gray-300 p-2">
                              <input name="nomor_sertifikat_slo[]" id="nomor_sertifikat_1" type="text" class="w-full border p-1 rounded" placeholder="">
                            </td>
                          </tr>
                          <tr>
                            <td class="border border-gray-300 p-2 font-semibold bg-gray-50 sticky left-0">Nomor Register</td>
                            <td class="border border-gray-300 p-2">
                              <input name="nomor_register_slo[]" id="nomor_register_1" type="text" class="w-full border p-1 rounded" placeholder="">
                            </td>
                          </tr>

                          <tr>
                            <td class="border border-gray-300 p-2 font-semibold bg-gray-50 sticky left-0">Tanggal Terbit</td>
                            <td class="border border-gray-300 p-2">
                              <input name="tanggal_terbit_slo[]" id="tanggal_terbit_slo_1" type="text" class="w-full border p-1 rounded datepicker" placeholder="DD-MM-YYYY">
                            </td>
                          </tr>
                          <tr>
                            <td class="border border-gray-300 p-2 font-semibold bg-gray-50 sticky left-0">Tanggal Masa Berlaku</td>
                            <td class="border border-gray-300 p-2">
                              <input name="tanggal_masa_berlaku_slo[]" id="tanggal_masa_berlaku_slo_1" type="text" class="w-full border p-1 rounded datepicker" placeholder="DD-MM-YYYY">
                            </td>
                          </tr>

                          <tr>
                            <td class="border border-gray-300 p-2 font-semibold bg-gray-50 sticky left-0">Lembaga Inspeksi Teknik (LIT)</td>
                            <td class="border border-gray-300 p-2">
                              <input name="lit[]" id="lit_1" type="text" class="w-full border p-1 rounded">
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="mt-6">
                      <label>Upload Lampiran SLO</label>
                      <input id="lampiran_slo1" name="lampiran_slo1" type="file" accept=".pdf" class="w-full border p-2 rounded-lg" onchange="previewFile(this)">
                      <small class="text-gray-500">Format PDF Maks 5MB</small>
                    </div>
                    <div id="preview_lampiran_slo1"></div>


                    <!-- SCRIPT TAMBAH, KURANG, DAN VALIDASI FILE -->


                    <script>
                      let columnCount = 1;

                      function addColumn(event) {
                        columnCount++;

                        const table = document.getElementById("sloTable");
                        const thead = table.querySelector("thead tr");
                        const tbodyRows = table.querySelectorAll("tbody tr");

                        const newHeader = document.createElement("th");
                        newHeader.className = "border border-gray-300 p-2 min-w-[220px]";
                        newHeader.innerText = `SLO-${columnCount}`;
                        thead.appendChild(newHeader);

                        tbodyRows.forEach((row, index) => {
                          const newCell = document.createElement("td");
                          newCell.className = "border border-gray-200 p-2";

                          let inputHTML = '';
                          switch (index) {
                            case 0:
                              inputHTML = `<input name="nomor_sertifikat_slo[]" id="nomor_sertifikat_${columnCount}" type="text" class="w-full border p-1 rounded">`;
                              break;
                            case 1:
                              inputHTML = `<input name="nomor_register_slo[]" id="nomor_register_${columnCount}" type="text" class="w-full border p-1 rounded">`;
                              break;
                            case 2:
                              inputHTML = `<input name="tanggal_terbit_slo[]" id="tanggal_terbit_slo_${columnCount}" type="date" class="w-full border p-1 rounded datepicker" placeholder="DD-MM-YYYY"">`;
                              break;
                            case 3:
                              inputHTML = `<input name="tanggal_masa_berlaku_slo[]" id="tanggal_masa_berlaku_slo_${columnCount}" type="date" class="w-full border p-1 rounded datepicker" placeholder="DD-MM-YYYY"">`;
                              break;
                            case 4:
                              inputHTML = `<input name="lit[]" id="lit_${columnCount}" type="text" class="w-full border p-1 rounded">`;
                              break;
                          }

                          newCell.innerHTML = inputHTML;
                          row.appendChild(newCell);
                        });

                        flatpickr(".datepicker", {
                          dateFormat: "d-m-Y",
                          locale: "id",
                          allowInput: true
                        });
                      }

                      function removeColumn(event) {
                        if (columnCount <= 1) return;

                        const table = document.getElementById("sloTable");
                        const thead = table.querySelector("thead tr");
                        const tbodyRows = table.querySelectorAll("tbody tr");

                        thead.removeChild(thead.lastElementChild);
                        tbodyRows.forEach((row) => {
                          row.removeChild(row.lastElementChild);
                        });

                        columnCount--;
                      }

                      function previewFile(input) {
                        const file = input.files[0];
                        const previewId = input.id.replace("lampiran_", "preview_lampiran_");
                        const preview = document.getElementById(previewId);
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
                            setBorderColor(input, "error");
                            return;
                          }

                          if (file.size > maxSize) {
                            Swal.fire({
                              icon: 'error',
                              title: 'Ukuran File Terlalu Besar',
                              text: 'Ukuran file maksimal 5MB!',
                            });
                            input.value = "";
                            setBorderColor(input, "error");
                            return;
                          }

                          const url = URL.createObjectURL(file);
                          preview.innerHTML = `<a href="${url}" target="_blank" class="text-blue-600 underline">Lihat</a>`;
                          setBorderColor(input, "success");
                        }
                      }

                      function setBorderColor(input, status) {
                        if (!input) return;
                        input.classList.remove("border-red-500", "border-green-500");
                        if (status === "error") {
                          input.classList.add("border-red-500");
                        } else if (status === "success") {
                          input.classList.add("border-green-500");
                        }
                      }

                      // Hapus fungsi validateBeforeSubmit karena form tidak perlu dicek wajib isi
                      document.addEventListener("DOMContentLoaded", () => {
                        const form = document.getElementById("formSuratBerkala");
                        if (form) {
                          form.addEventListener("submit", function(e) {
                            // Tidak ada validasi yang menghalangi pengiriman form
                            // Hanya untuk styling hijau jika input terisi
                            const inputs = form.querySelectorAll("input[type='text'], input[type='date']");
                            inputs.forEach(input => {
                              if (input.value.trim() !== "") {
                                setBorderColor(input, "success");
                              }
                            });

                            const fileInputs = form.querySelectorAll("input[type='file']");
                            fileInputs.forEach(input => {
                              if (input.files.length > 0) {
                                setBorderColor(input, "success");
                              }
                            });
                          });
                        }
                      });
                    </script>




                    <!-- -->
                    <h3 class="text-lg font-bold uppercase mt-6 pb-2 text-gray-700 dark:text-white">SERTIFIKAT KOMPETENSI TENAGA TEKNIK KETENAGALISTRIKAN (SKTTK)</h3>


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
                          <tr>
                            <td class="border border-gray-300 p-2 font-semibold bg-gray-50 sticky left-0">Nomor Sertifikat</td>
                            <td class="border border-gray-300 p-2">
                              <input name="nomor_sertifikat_skttk[]" id="nomor_sertifikat_skttk_1" type="text" class="w-full border p-1 rounded" placeholder="1234.0.12.A123.12.2025">
                            </td>
                          </tr>
                          <tr>
                            <td class="border border-gray-300 p-2 font-semibold bg-gray-50 sticky left-0">Nomor Register</td>
                            <td class="border border-gray-300 p-2">
                              <input name="nomor_register_skttk[]" id="nomor_register_skttk_1" type="text" class="w-full border p-1 rounded" placeholder="12345.1.2025">
                            </td>
                          </tr>
                          <tr>
                            <td class="border border-gray-300 p-2 font-semibold bg-gray-50 sticky left-0">Nama</td>
                            <td class="border p-2">
                              <input name="nama_skttk[]" id="nama_skttk_1" type="text" class="w-full border p-1 rounded">
                            </td>
                          </tr>
                          <tr>
                            <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Jabatan</td>
                            <td class="border p-2">
                              <input name="jabatan_skttk[]" id="jabatan_skttk_1" type="text" class="w-full border p-1 rounded">
                            </td>
                          </tr>
                          <tr>
                            <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Kode Jenjang Kualifikasi</td>
                            <td class="border p-2">
                              <input name="kode_kualifikasi_skttk[]" id="kode_kualifikasi_skttk_1" type="text" placeholder="A.12.123.12.KUALIFIKASI.1.ABCDEF" class="w-full border p-1 rounded">
                            </td>
                          </tr>
                          <tr>
                            <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Unit Kompetensi Inti (1)</td>
                            <td class="border p-2">
                              <input name="kompetensi_inti1_skttk[]" id="kompetensi_inti1_skttk_1" type="text" class="w-full border p-1 rounded">
                            </td>
                          </tr>
                          <tr>
                            <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Unit Kompetensi Inti (2)</td>
                            <td class="border p-2">
                              <input name="kompetensi_inti2_skttk[]" id="kompetensi_inti2_skttk_1" type="text" class="w-full border p-1 rounded">
                            </td>
                          </tr>
                          <tr>
                            <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Unit Kompetensi Pilihan (1)</td>
                            <td class="border p-2">
                              <input name="kompetensi_pilihan1_skttk[]" id="kompetensi_pilihan1_skttk_1" type="text" class="w-full border p-1 rounded">
                            </td>
                          </tr>
                          <tr>
                            <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Unit Kompetensi Pilihan (2)</td>
                            <td class="border p-2">
                              <input name="kompetensi_pilihan2_skttk[]" id="kompetensi_pilihan2_skttk_1" type="text" class="w-full border p-1 rounded">
                            </td>
                          </tr>
                          <tr>
                            <td class="border border-gray-300 p-2 font-semibold bg-gray-50 sticky left-0">Tanggal Terbit</td>
                            <td class="border border-gray-300 p-2">
                              <input name="tanggal_terbit_skttk[]" id="tanggal_terbit_skttk_1" type="text" class="w-full border p-1 rounded datepicker" placeholder="DD-MM-YYYY">
                            </td>
                          </tr>
                          <tr>
                            <td class="border border-gray-300 p-2 font-semibold bg-gray-50 sticky left-0">Tanggal Masa Berlaku</td>
                            <td class="border border-gray-300 p-2">
                              <input name="tanggal_masa_berlaku_skttk[]" id="tanggal_masa_berlaku_skttk_1" type="text" class="w-full border p-1 rounded datepicker" placeholder="DD-MM-YYYY">
                            </td>
                          </tr>
                          <tr>
                            <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Lembaga Sertifikasi Kompetensi (LSK)</td>
                            <td class="border p-2">
                              <input name="lsk_skttk[]" id="lsk_skttk_1" type="text" class="w-full border p-1 rounded">
                            </td>
                          </tr>

                        </tbody>
                      </table>
                    </div>
                    <div class="mt-6">
                      <label>Upload Lampiran SKTTK</label>
                      <input id="lampiran_skttk" name="lampiran_skttk" type="file" accept=".pdf" class="w-full border p-2 rounded-lg" onchange="previewFile(this)">
                      <small class="text-gray-500">Format PDF Maks 5MB</small>
                    </div>
                    <div id="preview_lampiran_skttk"></div>

                    <script>
                      let skttkColumnCount = 1;

                      const fieldIds = [
                        "nomor_sertifikat_skttk",
                        "nomor_register_skttk",
                        "nama_skttk",
                        "jabatan_skttk",
                        "kode_kualifikasi_skttk",
                        "kompetensi_inti1_skttk",
                        "kompetensi_inti2_skttk",
                        "kompetensi_pilihan1_skttk",
                        "kompetensi_pilihan2_skttk",
                        "tanggal_terbit_skttk",
                        "tanggal_masa_berlaku_skttk",
                        "lsk_skttk"
                      ];

                      // ✅ Tambahan fungsi inisialisasi datepicker
                      function initializeDatepickers() {
                        const dateInputs = document.querySelectorAll("#skttkTable input[type='date']");
                        dateInputs.forEach(input => {
                          flatpickr(input, {
                            dateFormat: "d-m-y",
                            allowInput: true
                          });
                        });
                      }

                      function addSKTTKColumn() {
                        skttkColumnCount++;
                        const table = document.getElementById("skttkTable");
                        const thead = table.querySelector("thead tr");
                        const tbodyRows = table.querySelectorAll("tbody tr");

                        // Header baru
                        const newHeader = document.createElement("th");
                        newHeader.className = "border border-gray-300 p-2 min-w-[220px] bg-gray-200 text-center";
                        newHeader.innerText = `SKTTK${skttkColumnCount}`;
                        thead.appendChild(newHeader);

                        // Kolom baru
                        tbodyRows.forEach((row, index) => {
                          const newCell = document.createElement("td");
                          newCell.className = "border border-gray-300 p-2";

                          const name = fieldIds[index];
                          if (name) {
                            const type = name.includes("tanggal") ? "date" : "text";
                            const placeholder = (name === "nomor_sertifikat_skttk") ? "1234.0.12.A123.12.2025" :
                              (name === "nomor_register_skttk") ? "12345.1.2025" :
                              (name === "kode_kualifikasi_skttk") ? "A.12.123.12.KUALIFIKASI.1.ABCDEF" :
                              (name === "tanggal_terbit_skttk") ? "DD-MM-YYYY" :
                              (name === "tanggal_masa_berlaku_skttk") ? "DD-MM-YYYY" :
                              "";

                            const id = `${name}_${skttkColumnCount}`;
                            newCell.innerHTML = `<input name="${name}[]" id="${id}" type="${type}" class="w-full border p-1 rounded" ${placeholder ? `placeholder="${placeholder}"` : ''}>`;
                          } else {
                            newCell.innerHTML = `<input type="text" class="w-full border p-1 rounded">`;
                          }

                          row.appendChild(newCell);
                        });

                        // ✅ Inisialisasi datepicker untuk input baru
                        initializeDatepickers();
                      }

                      function removeSKTTKColumn() {
                        if (skttkColumnCount <= 1) return;

                        const table = document.getElementById("skttkTable");
                        const thead = table.querySelector("thead tr");
                        const tbodyRows = table.querySelectorAll("tbody tr");

                        thead.removeChild(thead.lastElementChild);
                        tbodyRows.forEach(row => row.removeChild(row.lastElementChild));

                        skttkColumnCount--;
                      }

                      function previewFile(input) {
                        const file = input.files[0];
                        const previewId = input.id.replace("lampiran_", "preview_lampiran_");
                        const preview = document.getElementById(previewId);
                        preview.innerHTML = "";

                        if (file) {
                          const allowedTypes = ["application/pdf"];
                          const maxSize = 5 * 1024 * 1024;

                          if (!allowedTypes.includes(file.type)) {
                            Swal.fire({
                              icon: 'error',
                              title: 'Format Salah',
                              text: 'File harus berupa PDF!'
                            });
                            input.value = "";
                            setBorderColor(input, "error");
                            return;
                          }

                          if (file.size > maxSize) {
                            Swal.fire({
                              icon: 'error',
                              title: 'Ukuran File Terlalu Besar',
                              text: 'Ukuran maksimal 5MB!'
                            });
                            input.value = "";
                            setBorderColor(input, "error");
                            return;
                          }

                          const url = URL.createObjectURL(file);
                          preview.innerHTML = `<a href="${url}" target="_blank" class="text-blue-600 underline">Lihat</a>`;
                          setBorderColor(input, "success");
                        }
                      }

                      function setBorderColor(input, status) {
                        if (!input) return;
                        input.classList.remove("border-red-500", "border-green-500");

                        if (status === "error") {
                          input.classList.add("border-red-500");
                        } else if (status === "success") {
                          input.classList.add("border-green-500");
                        } else {
                          input.classList.remove("border-red-500", "border-green-500");
                        }
                      }

                      function validateSKTTK() {
                        let valid = true;
                        let errorMessages = [];

                        const sertifikatPattern = /^\d{4}\.\d\.\d{2}\.[A-Z0-9]+\.\d{2}\.\d{4}$/;
                        const registerPattern = /^\d{5}\.\d\.\d{4}$/;
                        const kualifikasiPattern = /^[A-Z]\.\d{2}\.\d{3}\.\d{2}\.[A-Z]+\.\d\.[a-zA-Z]{6}$/;

                        for (let i = 1; i <= skttkColumnCount; i++) {
                          for (let name of fieldIds) {
                            const el = document.getElementById(`${name}_${i}`);
                            if (!el) continue;

                            const value = el.value.trim();
                            if (!value) {
                              setBorderColor(el, "neutral");
                              continue;
                            }

                            // Cek format masing-masing input
                            if (name === "nomor_sertifikat_skttk" && !sertifikatPattern.test(value)) {
                              setBorderColor(el, "error");
                              valid = false;
                              errorMessages.push(`Format Nomor Sertifikat SKTTK${i} tidak valid.`);
                            } else if (name === "nomor_register_skttk" && !registerPattern.test(value)) {
                              setBorderColor(el, "error");
                              valid = false;
                              errorMessages.push(`Format Nomor Register SKTTK${i} tidak valid.`);
                            } else if (name === "kode_kualifikasi_skttk" && !kualifikasiPattern.test(value)) {
                              setBorderColor(el, "error");
                              valid = false;
                              errorMessages.push(`Format Kode Kualifikasi SKTTK${i} tidak valid.`);
                            } else {
                              setBorderColor(el, "success");
                            }
                          }
                        }

                        // Validasi file lampiran
                        const lampiran = document.getElementById("lampiran_skttk");
                        if (lampiran && lampiran.files.length > 0) {
                          const file = lampiran.files[0];
                          const allowedTypes = ["application/pdf"];
                          const maxSize = 5 * 1024 * 1024;

                          if (!allowedTypes.includes(file.type)) {
                            Swal.fire({
                              icon: 'error',
                              title: 'Format Salah',
                              text: 'File harus berupa PDF!'
                            });
                            setBorderColor(lampiran, "error");
                            return false;
                          }

                          if (file.size > maxSize) {
                            Swal.fire({
                              icon: 'error',
                              title: 'Ukuran File Terlalu Besar',
                              text: 'Ukuran maksimal 5MB!'
                            });
                            setBorderColor(lampiran, "error");
                            return false;
                          }

                          setBorderColor(lampiran, "success");
                        } else {
                          setBorderColor(lampiran, "neutral");
                        }

                        // Tampilkan error jika ada
                        if (!valid && errorMessages.length > 0) {
                          Swal.fire({
                            icon: 'error',
                            title: 'Kesalahan Pengisian',
                            html: errorMessages.join("<br>"),
                            confirmButtonText: 'Perbaiki'
                          });
                        }

                        return valid;
                      }


                      document.addEventListener("DOMContentLoaded", () => {
                        // ✅ Panggil datepicker saat halaman pertama kali load
                        initializeDatepickers();

                        const form = document.getElementById("formSuratBerkala");
                        if (form) {
                          form.addEventListener("submit", function(e) {
                            if (!validateSKTTK()) {
                              e.preventDefault(); // Stop submit kalau ada error
                            }
                          });
                        }
                      });
                    </script>
                    <!---->
                    <div class="flex justify-end mt-4">
                      <button type="button" onclick="goToNextPage()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Selanjutnya</button>
                    </div>


                  </div>


                  <div id="page2" class="page hidden">
                    <!-- -->
                    <h3 class="text-lg font-bold uppercase mt-6 pb-2 text-gray-700 dark:text-white">
                      DATA MESIN PENGGERAK MULA
                    </h3>

                    <div class="flex justify-end gap-2 mb-4">
                      <button type="button" onclick="addMesinColumn()" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Tambah</button>
                      <button type="button" onclick="removeMesinColumn()" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Kurang</button>
                    </div>

                    <div class="overflow-x-auto">
                      <table id="mesinTable" class="min-w-full border border-gray-300 text-sm">
                        <thead>
                          <tr>
                            <th class="border border-gray-300 p-2 bg-gray-100 text-left sticky left-0 min-w-[150px] max-w-[150px] w-[150px]">Data Mesin</th>
                            <th class="border border-gray-300 p-2 bg-gray-100 min-w-[220px]">Unit 1</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Jenis Penggerak</td>
                            <td class="border p-2">
                              <input id="mesin_jenis_penggerak_1" name="jenis_penggerak[]" type="text" class="w-full border p-1 rounded" required>
                            </td>
                          </tr>
                          <tr>
                            <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Jenis Pembangkit</td>
                            <td class="border p-2">
                              <select id="mesin_jenis_pembangkit_1" name="jenis_pembangkit[]" class="w-full border p-1 rounded" required>
                                <option value="">Pilih</option>
                                <option>PLTD</option>
                                <option>PLTBm</option>
                                <option>PLTMH</option>
                                <option>PLTU</option>
                                <option>PLTBg</option>
                                <option>PLTMG</option>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Energi Primer / Utama</td>
                            <td class="border p-2">
                              <input id="mesin_energi_primer_1" name="energi_primer[]" type="text" class="w-full border p-1 rounded" required>
                            </td>
                          </tr>
                          <tr>
                            <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Merk / Tipe / Seri</td>
                            <td class="border p-2">
                              <input id="mesin_merk_tipe_1" name="mesin_merk_tipe[]" type="text" class="w-full border p-1 rounded" required>
                            </td>
                          </tr>
                          <tr>
                            <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Pabrikan / Tahun</td>
                            <td class="border p-2">
                              <input id="mesin_pabrikan_1" name="mesin_pabrikan[]" type="text" class="w-full border p-1 rounded" required>
                            </td>
                          </tr>
                          <tr>
                            <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Kapasitas (kW / kVA)</td>
                            <td class="border p-2">
                              <input id="mesin_kapasitas_1" name="mesin_kapasitas[]" type="text" class="w-full border p-1 rounded" required>
                            </td>
                          </tr>
                          <tr>
                            <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Putaran (rpm)</td>
                            <td class="border p-2">
                              <input id="mesin_putaran_1" name="mesin_putaran[]" type="text" class="w-full border p-1 rounded" required>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="mt-6">
                      <label>Upload Lampiran Nameplate Mesin</label>
                      <input id="lampiran_nameplate_mesin" name="lampiran_nameplate_mesin" type="file" accept=".pdf" class="w-full border p-2 rounded-lg" required onchange="previewFile(this)">
                      <small class="text-gray-500">Format PDF Maks 5MB</small>
                    </div>
                    <div id="preview_lampiran_nameplate_mesin"></div>


                    <script>
                      let mesinUnitCount = 1;

                      const mesinFields = [
                        "jenis_penggerak",
                        "jenis_pembangkit",
                        "energi_primer",
                        "mesin_merk_tipe",
                        "mesin_pabrikan",
                        "mesin_kapasitas",
                        "mesin_putaran"
                      ];

                      function addMesinColumn() {
                        mesinUnitCount++;
                        const table = document.getElementById("mesinTable");
                        const thead = table.querySelector("thead tr");
                        const tbodyRows = table.querySelectorAll("tbody tr");

                        // Tambahkan header baru
                        const newHeader = document.createElement("th");
                        newHeader.className = "border border-gray-300 p-2 bg-gray-100 min-w-[220px]";
                        newHeader.innerText = `Unit ${mesinUnitCount}`;
                        thead.appendChild(newHeader);

                        // Tambahkan kolom baru untuk setiap baris
                        tbodyRows.forEach((row, index) => {
                          const newCell = document.createElement("td");
                          newCell.className = "border p-2";

                          const name = mesinFields[index];
                          if (name) {
                            let element = "";
                            const id = `mesin_${name}_${mesinUnitCount}`;
                            const inputName = `${name}[]`;

                            if (name === "jenis_pembangkit") {
                              element = `
            <select id="${id}" name="${inputName}" class="w-full border p-1 rounded" required>
              <option value="">Pilih</option>
              <option>PLTD</option>
              <option>PLTBm</option>
              <option>PLTMH</option>
              <option>PLTU</option>
              <option>PLTBg</option>
              <option>PLTMG</option>
            </select>`;
                            } else {
                              element = `<input id="${id}" name="${inputName}" type="text" class="w-full border p-1 rounded" required>`;
                            }

                            newCell.innerHTML = element;
                          } else {
                            newCell.innerHTML = `<input type="text" class="w-full border p-1 rounded">`;
                          }

                          row.appendChild(newCell);
                        });
                      }

                      function removeMesinColumn() {
                        if (mesinUnitCount <= 1) return;

                        const table = document.getElementById("mesinTable");
                        const thead = table.querySelector("thead tr");
                        const tbodyRows = table.querySelectorAll("tbody tr");

                        // Hapus header terakhir
                        thead.removeChild(thead.lastElementChild);

                        // Hapus sel terakhir di setiap baris
                        tbodyRows.forEach(row => row.removeChild(row.lastElementChild));

                        mesinUnitCount--;
                      }

                      function validateMesinForm() {
                        let valid = true;

                        // ✅ Validasi Unit 1 (static)
                        mesinFields.forEach(field => {
                          const el = document.getElementById(`mesin_${field}_1`);
                          if (!el) return;

                          const value = el.value.trim();
                          if (!value) {
                            setBorderColor(el, "error");
                            valid = false;
                          } else {
                            setBorderColor(el, "success");
                          }
                        });

                        // ✅ Validasi Unit 2, 3, dst
                        for (let i = 2; i <= mesinUnitCount; i++) {
                          mesinFields.forEach(field => {
                            const el = document.getElementById(`mesin_${field}_${i}`);
                            if (!el) return;

                            const value = el.value.trim();
                            if (!value) {
                              setBorderColor(el, "error");
                              valid = false;
                            } else {
                              setBorderColor(el, "success");
                            }
                          });
                        }

                        const lampiran = document.getElementById("lampiran_nameplate_mesin");
                        if (!lampiran || lampiran.files.length === 0) {
                          setBorderColor(lampiran, "error");
                          valid = false;
                        } else {
                          setBorderColor(lampiran, "success");
                        }

                        if (!valid) {
                          Swal.fire({
                            icon: 'error',
                            title: 'Formulir Belum Lengkap!',
                            text: 'Beberapa belum diisi.',
                            confirmButtonColor: '#e3342f',
                            confirmButtonText: 'OK'
                          });
                        }

                        return valid;
                      }

                      function setBorderColor(input, status) {
                        if (!input) return;
                        input.classList.remove("border-red-500", "border-green-500");
                        input.classList.add(status === "error" ? "border-red-500" : "border-green-500");
                      }

                      // ✅ Trigger validasi saat form disubmit
                      document.addEventListener("DOMContentLoaded", () => {
                        const form = document.getElementById("formSuratBerkala"); // Ganti ID jika berbeda
                        if (form) {
                          form.addEventListener("submit", function(e) {
                            if (!validateMesinForm()) {
                              e.preventDefault(); // Hentikan submit jika tidak valid
                            }
                          });
                        }
                      });
                    </script>

                    <!-- -->

                    <h3 class="text-lg font-bold uppercase mt-6 pb-2 text-gray-700 dark:text-white">
                      DATA GENERATOR
                    </h3>

                    <div class="flex justify-end gap-2 mb-4">
                      <button type="button" onclick="addGeneratorColumn()" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Tambah</button>
                      <button type="button" onclick="removeGeneratorColumn()" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Kurang</button>
                    </div>

                    <div class="overflow-x-auto">
                      <table id="generatorTable" class="min-w-full border border-gray-300 text-sm">
                        <thead>
                          <tr>
                            <th class="border border-gray-300 p-2 bg-gray-100 text-left sticky left-0 min-w-[150px] max-w-[150px] w-[150px]">Data Generator</th>
                            <th class="border border-gray-300 p-2 bg-gray-100 min-w-[220px]">Unit 1</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Merk / Tipe / Seri</td>
                            <td class="border p-2">
                              <input id="generator_merk_tipe_1" name="generator_merk_tipe[]" type="text" class="w-full border p-1 rounded" required>
                            </td>
                          </tr>
                          <tr>
                            <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Pabrikan / Tahun</td>
                            <td class="border p-2">
                              <input id="generator_pabrikan_1" name="generator_pabrikan[]" type="text" class="w-full border p-1 rounded" required>
                            </td>
                          </tr>
                          <tr>
                            <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Kapasitas (kW / kVA)</td>
                            <td class="border p-2">
                              <input id="generator_kapasitas_1" name="generator_kapasitas[]" type="text" class="w-full border p-1 rounded" required>
                            </td>
                          </tr>
                          <tr>
                            <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Tegangan (V)</td>
                            <td class="border p-2">
                              <input id="generator_tegangan_1" name="generator_tegangan[]" type="text" class="w-full border p-1 rounded" required>
                            </td>
                          </tr>
                          <tr>
                            <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Arus (A)</td>
                            <td class="border p-2">
                              <input id="generator_arus_1" name="generator_arus[]" type="text" class="w-full border p-1 rounded" required>
                            </td>
                          </tr>
                          <tr>
                            <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Faktor Daya</td>
                            <td class="border p-2">
                              <input id="generator_faktor_daya_1" name="generator_faktor_daya[]" type="text" class="w-full border p-1 rounded" required>
                            </td>
                          </tr>
                          <tr>
                            <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Fasa</td>
                            <td class="border p-2">
                              <input id="generator_fasa_1" name="generator_fasa[]" type="text" class="w-full border p-1 rounded" required>
                            </td>
                          </tr>
                          <tr>
                            <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Frekuensi (Hz)</td>
                            <td class="border p-2">
                              <input id="generator_frekuensi_1" name="generator_frekuensi[]" type="text" class="w-full border p-1 rounded" required>
                            </td>
                          </tr>
                          <tr>
                            <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Putaran (rpm)</td>
                            <td class="border p-2">
                              <input id="generator_putaran_1" name="generator_putaran[]" type="text" class="w-full border p-1 rounded" required>
                            </td>
                          </tr>
                          <tr>
                            <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Lokasi Unit (Kab / Kota)</td>
                            <td class="border p-2">
                              <select id="generator_lokasi_1" name="generator_lokasi[]" class="w-full border p-1 rounded" required>
                                <option value="">Pilih Lokasi</option>
                                <option>Kota Jambi</option>
                                <option>Kabupaten Muaro Jambi</option>
                                <option>Kabupaten Batanghari</option>
                                <option>Kabupaten Tanjung Jabung Barat</option>
                                <option>Kabupaten Tanjung Jabung Timur</option>
                                <option>Kabupaten Bungo</option>
                                <option>Kabupaten Tebo</option>
                                <option>Kabupaten Merangin</option>
                                <option>Kabupaten Sarolangun</option>
                                <option>Kabupaten Kerinci</option>
                                <option>Kota Sungai Penuh</option>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Koordinat</td>
                            <td class="border p-2 space-y-1">
                              <input id="generator_latitude_1" name="generator_latitude[]" type="number" step="any"
                                placeholder="Latitude (cth: -1.234567)" class="w-full border p-1 rounded mb-1" required>
                              <input id="generator_longitude_1" name="generator_longitude[]" type="number" step="any"
                                placeholder="Longitude (cth: 103.456789)" class="w-full border p-1 rounded" required>
                            </td>
                          </tr>

                        </tbody>
                      </table>
                    </div>

                    <div class="mt-6">
                      <label>Upload Lampiran Nameplate Generator</label>
                      <input id="lampiran_nameplate_generator" name="lampiran_nameplate_generator" type="file" accept=".pdf" class="w-full border p-2 rounded-lg" required onchange="previewFile(this)">
                      <small class="text-gray-500">Format PDF Maks 5MB</small>
                    </div>
                    <div id="preview_lampiran_nameplate_generator"></div>


                    <script>
                      let generatorUnitCount = 1;

                      const generatorFields = [
                        "generator_merk_tipe",
                        "generator_pabrikan",
                        "generator_kapasitas",
                        "generator_tegangan",
                        "generator_arus",
                        "generator_faktor_daya",
                        "generator_fasa",
                        "generator_frekuensi",
                        "generator_putaran",
                        "generator_lokasi"
                        // ⛔️ latitude dan longitude dihapus dari sini karena ditangani terpisah
                      ];

                      function addGeneratorColumn() {
                        generatorUnitCount++;
                        const table = document.getElementById("generatorTable");
                        const thead = table.querySelector("thead tr");
                        const tbodyRows = table.querySelectorAll("tbody tr");

                        const newHeader = document.createElement("th");
                        newHeader.className = "border border-gray-300 p-2 bg-gray-100 min-w-[220px]";
                        newHeader.innerText = `Unit ${generatorUnitCount}`;
                        thead.appendChild(newHeader);

                        tbodyRows.forEach((row, index) => {
                          const newCell = document.createElement("td");
                          newCell.className = "border p-2";

                          if (index === tbodyRows.length - 1) {
                            // Baris koordinat (latitude + longitude)
                            const latId = `generator_latitude_${generatorUnitCount}`;
                            const lonId = `generator_longitude_${generatorUnitCount}`;
                            newCell.innerHTML = `
          <input id="${latId}" name="generator_latitude[]" type="number" step="any" placeholder="Latitude (cth: -1.234567)" class="w-full border p-1 rounded mb-1" required>
          <input id="${lonId}" name="generator_longitude[]" type="number" step="any" placeholder="Longitude (cth: 103.456789)" class="w-full border p-1 rounded" required>
        `;
                          } else {
                            // Field lain (berdasarkan urutan index)
                            const name = generatorFields[index];
                            if (name) {
                              const id = `${name}_${generatorUnitCount}`;
                              const inputName = `${name}[]`;
                              let element = "";

                              if (name === "generator_lokasi") {
                                element = `
              <select id="${id}" name="${inputName}" class="w-full border p-1 rounded" required>
                <option value="">Pilih Lokasi</option>
                <option>Kota Jambi</option>
                <option>Kabupaten Muaro Jambi</option>
                <option>Kabupaten Batanghari</option>
                <option>Kabupaten Tanjung Jabung Barat</option>
                <option>Kabupaten Tanjung Jabung Timur</option>
                <option>Kabupaten Bungo</option>
                <option>Kabupaten Tebo</option>
                <option>Kabupaten Merangin</option>
                <option>Kabupaten Sarolangun</option>
                <option>Kabupaten Kerinci</option>
                <option>Kota Sungai Penuh</option>
              </select>`;
                              } else {
                                element = `<input id="${id}" name="${inputName}" type="text" class="w-full border p-1 rounded" required>`;
                              }

                              newCell.innerHTML = element;
                            }
                          }

                          row.appendChild(newCell);
                        });
                      }

                      function removeGeneratorColumn() {
                        if (generatorUnitCount <= 1) return;

                        const table = document.getElementById("generatorTable");
                        const thead = table.querySelector("thead tr");
                        const tbodyRows = table.querySelectorAll("tbody tr");

                        thead.removeChild(thead.lastElementChild);
                        tbodyRows.forEach(row => row.removeChild(row.lastElementChild));

                        generatorUnitCount--;
                      }

                      function validateGeneratorForm() {
                        let valid = true;

                        for (let i = 1; i <= generatorUnitCount; i++) {
                          // Validasi field generator biasa
                          generatorFields.forEach(field => {
                            const el = document.getElementById(`${field}_${i}`);
                            if (!el) return;
                            const value = el.value.trim();

                            if (field === "lokasi") {
                              if (value === "") {
                                setBorderColor(el, "error");
                                valid = false;
                              } else {
                                setBorderColor(el, "success");
                              }
                            } else {
                              if (!value) {
                                setBorderColor(el, "error");
                                valid = false;
                              } else {
                                setBorderColor(el, "success");
                              }
                            }
                          });

                          // Validasi LATITUDE
                          const latInput = document.getElementById(`generator_latitude_${i}`);
                          if (latInput) {
                            const latVal = parseFloat(latInput.value.trim());
                            if (!latInput.value.trim() || isNaN(latVal) || latVal < -90 || latVal > 90) {

                              setBorderColor(latInput, "error");
                              valid = false;
                            } else {
                              setBorderColor(latInput, "success");
                            }
                          }

                          // Validasi LONGITUDE
                          const lonInput = document.getElementById(`generator_longitude_${i}`);
                          if (lonInput) {
                            const lonVal = parseFloat(lonInput.value.trim());
                            if (isNaN(lonVal) || lonVal < -180 || lonVal > 180) {
                              setBorderColor(lonInput, "error");
                              valid = false;
                            } else {
                              setBorderColor(lonInput, "success");
                            }
                          }
                        }

                        // Validasi LAMPIRAN
                        const lampiran = document.getElementById("lampiran_nameplate_generator");
                        if (!lampiran || lampiran.files.length === 0) {
                          setBorderColor(lampiran, "error");
                          valid = false;
                        } else {
                          setBorderColor(lampiran, "success");
                        }

                        if (!valid) {
                          Swal.fire({
                            icon: 'error',
                            title: 'Formulir Generator Belum Lengkap!',
                            text: 'Beberapa field belum diisi atau format tidak sesuai.',
                            confirmButtonColor: '#e3342f',
                            confirmButtonText: 'OK'
                          });
                        }

                        return valid;
                      }

                      // Fungsi bantu ubah warna border input
                      function setBorderColor(input, status) {
                        if (!input) return;
                        input.classList.remove("border-red-500", "border-green-500");
                        input.classList.add(status === "error" ? "border-red-500" : "border-green-500");
                      }

                      // Trigger validasi saat form disubmit
                      document.addEventListener("DOMContentLoaded", () => {
                        const form = document.getElementById("formSuratBerkala");
                        if (form) {
                          form.addEventListener("submit", function(e) {
                            if (!validateGeneratorForm()) {
                              e.preventDefault();
                            }
                          });
                        }
                      });
                    </script> -->

                    <!-- Tabel Sambungan Listrik-->
                    <!-- Dropdown Sambungan Listrik -->
                    <div class="mt-6">
                      <label for="sambunganListrik" class="block text-sm font-medium text-gray-700">Apakah ada sambungan listrik dari pihak lain?</label>
                      <select id="sambunganListrik" name="sambunganListrik" class="mt-1 block w-full p-2 border rounded-md" onchange="toggleSambunganListrikTable()" required>
                        <option value="" disabled selected hidden>Pilih</option>
                        <option value="ada">Ada</option>
                        <option value="tidak">Tidak</option>
                      </select>
                    </div>

                    <!-- Container Sambungan Listrik -->
                    <div id="sambunganListrikTable" class="mt-6 hidden">

                      <h3 class="text-lg font-bold uppercase mt-6 pb-2 text-gray-700 dark:text-white">Jaringan / Saluran Distribusi</h3>

                      <div class="flex justify-end gap-2 mb-4">
                        <button type="button" onclick="addDistribusiColumn(event)" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Tambah</button>
                        <button type="button" onclick="removeDistribusiColumn(event)" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Kurang</button>
                      </div>

                      <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-300" id="distribusiTable">
                          <thead class="bg-gray-200 text-center">
                            <tr>
                              <th class="border border-gray-300 p-2 bg-gray-100 text-left sticky left-0 z-10 w-[200px] min-w-[200px] max-w-[200px]">Field</th>
                              <th class="border border-gray-300 p-2 min-w-[220px]">Saluran Distribusi-1</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr id="row-pemilik_instalasi_distribusi">
                              <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Pemilik Instalasi</td>
                              <td><input id="pemilik_instalasi_distribusi-0" name="pemilik_instalasi_distribusi[]" type="text" class="w-full border p-1 rounded"></td>
                            </tr>
                            <tr id="row-tegangan_distribusi">
                              <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Tegangan (V)</td>
                              <td><input id="tegangan_distribusi-0" name="tegangan_distribusi[]" type="text" class="w-full border p-1 rounded"></td>
                            </tr>
                            <tr id="row-kapasitas_panjang_distribusi">
                              <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Panjang (kms)</td>
                              <td><input id="kapasitas_panjang_distribusi-0" name="kapasitas_panjang_distribusi[]" type="text" class="w-full border p-1 rounded"></td>
                            </tr>
                            <tr id="row-kabupaten_kota_distribusi">
                              <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Kabupaten/Kota</td>
                              <td>
                                <select id="kabupaten_kota_distribusi-0" name="kabupaten_kota_distribusi[]" class="w-full border p-1 rounded">
                                  <option disabled selected>Pilih Kabupaten/Kota</option>
                                  <option value="Batanghari">Batanghari</option>
                                  <option value="Bungo">Bungo</option>
                                  <option value="Kerinci">Kerinci</option>
                                  <option value="Merangin">Merangin</option>
                                  <option value="Muaro Jambi">Muaro Jambi</option>
                                  <option value="Sarolangun">Sarolangun</option>
                                  <option value="Tanjung Jabung Barat">Tanjung Jabung Barat</option>
                                  <option value="Tanjung Jabung Timur">Tanjung Jabung Timur</option>
                                  <option value="Tebo">Tebo</option>
                                  <option value="Kota Jambi">Kota Jambi</option>
                                  <option value="Kota Sungai Penuh">Kota Sungai Penuh</option>
                                </select>
                              </td>
                            </tr>
                            <tr id="row-provinsi_distribusi">
                              <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Provinsi</td>
                              <td><input id="provinsi_distribusi-0" name="provinsi_distribusi[]" type="text" class="w-full border p-1 rounded bg-gray-100" readonly value="Jambi"></td>
                            </tr>
                            <tr id="row-koordinat_distribusi">
                              <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Koordinat</td>
                              <td>
                                <input id="latitude_distribusi-0" name="latitude_distribusi[]" type="number" step="any" placeholder="Latitude (cth: -1.234567)" class="w-full border p-1 rounded mb-1">
                                <input id="longitude_distribusi-0" name="longitude_distribusi[]" type="number" step="any" placeholder="Longitude (cth: 103.456789)" class="w-full border p-1 rounded">
                              </td>
                            </tr>
                            <tr id="row-tahun_operasi_distribusi">
                              <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Tahun Operasi</td>
                              <td><input id="tahun_operasi_distribusi-0" name="tahun_operasi_distribusi[]" type="text" class="w-full border p-1 rounded"></td>
                            </tr>
                          </tbody>
                        </table>

                      </div>


                      <script>
                        let distribusiCount = 1; // kolom pertama sudah ada di HTML

                        const fieldKeys = [
                          "pemilik_instalasi_distribusi",
                          "tegangan_distribusi",
                          "kapasitas_panjang_distribusi",
                          "kabupaten_kota_distribusi",
                          "provinsi_distribusi",
                          "koordinat_distribusi",
                          "tahun_operasi_distribusi"
                        ];

                        function addDistribusiColumn() {
                          const table = document.getElementById("distribusiTable");
                          const headerRow = table.querySelector("thead tr");

                          // Tambah header kolom
                          const th = document.createElement("th");
                          th.className = "border border-gray-300 p-2 min-w-[220px]";
                          th.innerText = `Saluran Distribusi-${distribusiCount + 1}`;
                          headerRow.appendChild(th);

                          fieldKeys.forEach(key => {
                            const row = document.getElementById(`row-${key}`);
                            const td = document.createElement("td");
                            td.innerHTML = generateInputField(key, distribusiCount);
                            row.appendChild(td);
                          });

                          distribusiCount++;
                        }

                        function removeDistribusiColumn() {
                          if (distribusiCount <= 1) return;

                          const table = document.getElementById("distribusiTable");
                          const headerRow = table.querySelector("thead tr");
                          headerRow.removeChild(headerRow.lastElementChild);

                          fieldKeys.forEach(key => {
                            const row = document.getElementById(`row-${key}`);
                            row.removeChild(row.lastElementChild);
                          });

                          distribusiCount--;
                        }

                        function generateInputField(field, index) {
                          switch (field) {
                            case "kabupaten_kota_distribusi":
                              return `
          <select id="kabupaten_kota_distribusi-${index}" name="kabupaten_kota_distribusi[]" class="w-full border p-1 rounded">
            <option disabled selected>-- Pilih Kabupaten/Kota --</option>
            <option value="Batanghari">Batanghari</option>
            <option value="Bungo">Bungo</option>
            <option value="Kerinci">Kerinci</option>
            <option value="Merangin">Merangin</option>
            <option value="Muaro Jambi">Muaro Jambi</option>
            <option value="Sarolangun">Sarolangun</option>
            <option value="Tanjung Jabung Barat">Tanjung Jabung Barat</option>
            <option value="Tanjung Jabung Timur">Tanjung Jabung Timur</option>
            <option value="Tebo">Tebo</option>
            <option value="Kota Jambi">Kota Jambi</option>
            <option value="Kota Sungai Penuh">Kota Sungai Penuh</option>
          </select>`;
                            case "provinsi_distribusi":
                              return `<input id="provinsi_distribusi-${index}" name="provinsi_distribusi[]" type="text" class="w-full border p-1 rounded bg-gray-100" readonly value="Jambi">`;
                            case "koordinat_distribusi":
                              return `
          <input id="latitude_distribusi-${index}" name="latitude_distribusi[]" type="number" step="any" placeholder="Latitude (cth: -1.234567)" class="w-full border p-1 rounded mb-1">
          <input id="longitude_distribusi-${index}" name="longitude_distribusi[]" type="number" step="any" placeholder="Longitude (cth: 103.456789)" class="w-full border p-1 rounded">`;
                            default:
                              return `<input id="${field}-${index}" name="${field}[]" type="text" class="w-full border p-1 rounded">`;
                          }
                        }



                        function validateDistribusiFields() {
                          const pilihan = document.getElementById("sambunganListrik").value;

                          // Jika pengguna memilih "tidak", lewati validasi tabel
                          if (pilihan === "tidak") {
                            return true;
                          }

                          // Validasi hanya dijalankan jika pengguna memilih "ada"
                          for (let i = 0; i < distribusiCount; i++) {
                            const requiredFields = [
                              `pemilik_instalasi_distribusi-${i}`,
                              `tegangan_distribusi-${i}`,
                              `kapasitas_panjang_distribusi-${i}`,
                              `kabupaten_kota_distribusi-${i}`,
                              `latitude_distribusi-${i}`,
                              `longitude_distribusi-${i}`,
                              `tahun_operasi_distribusi-${i}`
                            ];

                            for (let fieldId of requiredFields) {
                              const el = document.getElementById(fieldId);
                              if (!el || !el.value) {
                                Swal.fire({
                                  icon: "warning",
                                  title: "Validasi Gagal",
                                  text: `Field ${fieldId.replace(/[-_]/g, ' ')} wajib diisi.`,
                                });
                                return false;
                              }
                            }

                            const lat = parseFloat(document.getElementById(`latitude_distribusi-${i}`).value);
                            const long = parseFloat(document.getElementById(`longitude_distribusi-${i}`).value);

                            if (isNaN(lat) || lat < -90 || lat > 90) {
                              Swal.fire({
                                icon: "error",
                                title: "Koordinat Salah",
                                text: `Latitude Saluran Distribusi-${i + 1} harus antara -90 dan 90.`,
                              });
                              return false;
                            }

                            if (isNaN(long) || long < -180 || long > 180) {
                              Swal.fire({
                                icon: "error",
                                title: "Koordinat Salah",
                                text: `Longitude Saluran Distribusi-${i + 1} harus antara -180 dan 180.`,
                              });
                              return false;
                            }
                          }

                          Swal.fire({
                            icon: "success",
                            title: "Validasi Berhasil",
                            text: "Semua data sudah lengkap dan sesuai format.",
                          });

                          return true;
                        }
                      </script>




                      <h3 class="text-lg font-bold uppercase mt-6 pb-2 text-gray-700 dark:text-white">Transformator</h3>

                      <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-300 table-fixed" id="trafoTable">
                          <thead class="bg-gray-200 text-center">
                            <tr>
                              <th class="border border-gray-300 p-2 bg-gray-100 text-left sticky left-0 z-10 w-[200px] min-w-[200px] max-w-[200px]">Field</th>
                              <th class="border border-gray-300 p-2 min-w-[220px]">Transformator</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Pemilik</td>
                              <td class="border p-2">
                                <input id="pemilik_trafo" name="pemilik_trafo" type="text" class="w-full border p-1 rounded">
                              </td>
                            </tr>
                            <tr>
                              <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Tegangan Primer (V)</td>
                              <td class="border p-2">
                                <input id="tegangan_primer_trafo" name="tegangan_primer_trafo" type="text" class="w-full border p-1 rounded">
                              </td>
                            </tr>
                            <tr>
                              <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Tegangan Sekunder (V)</td>
                              <td class="border p-2">
                                <input id="tegangan_sekunder_trafo" name="tegangan_sekunder_trafo" type="text" class="w-full border p-1 rounded">
                              </td>
                            </tr>
                            <tr>
                              <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Kapasitas Daya (kVA)</td>
                              <td class="border p-2">
                                <input id="kapasitas_daya_trafo" name="kapasitas_daya_trafo" type="text" class="w-full border p-1 rounded">
                              </td>
                            </tr>
                            <tr>
                              <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Kabupaten/Kota</td>
                              <td class="border p-2">
                                <select id="kabupaten_kota_trafo" name="kabupaten_kota_trafo" class="w-full border p-1 rounded">
                                  <option disabled selected>Pilih Kabupaten/Kota</option>
                                  <option value="Batanghari">Batanghari</option>
                                  <option value="Bungo">Bungo</option>
                                  <option value="Kerinci">Kerinci</option>
                                  <option value="Merangin">Merangin</option>
                                  <option value="Muaro Jambi">Muaro Jambi</option>
                                  <option value="Sarolangun">Sarolangun</option>
                                  <option value="Tanjung Jabung Barat">Tanjung Jabung Barat</option>
                                  <option value="Tanjung Jabung Timur">Tanjung Jabung Timur</option>
                                  <option value="Tebo">Tebo</option>
                                  <option value="Kota Jambi">Kota Jambi</option>
                                  <option value="Kota Sungai Penuh">Kota Sungai Penuh</option>
                                </select>
                              </td>
                            </tr>
                            <tr>
                              <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Provinsi</td>
                              <td class="border p-2">
                                <input id="provinsi_trafo" type="text" name="provinsi_trafo" value="Jambi" readonly class="w-full border p-1 rounded bg-gray-100">
                              </td>
                            </tr>
                            <tr>
                              <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Koordinat</td>
                              <td class="border p-2">
                                <input id="latitude_trafo" name="latitude_trafo" type="number" step="any" placeholder="Latitude (cth: -1.234567)" class="w-full border p-1 rounded mb-1">
                                <input id="longitude_trafo" name="longitude_trafo" type="number" step="any" placeholder="Longitude (cth: 103.456789)" class="w-full border p-1 rounded">
                              </td>
                            </tr>
                            <tr>
                              <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Tahun Operasi</td>
                              <td class="border p-2">
                                <input id="tahun_operasi_trafo" name="tahun_operasi_trafo" type="text" class="w-full border p-1 rounded">
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>



                      <!-- Upload Lampiran -->
                      <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 dark:text-white mb-1">Upload Lampiran Tagihan Listrik</label>
                        <input id="lampiran_tagihan_listrik" name="lampiran_tagihan_listrik" type="file" accept=".pdf" class="border border-gray-300 p-2 rounded w-full" onchange="previewFile(this)">
                        <small class="text-gray-500">Format PDF Maks 5MB</small>
                      </div>
                      <div id="preview_lampiran_tagihan_listrik"></div>
                    </div>

                    <script>
                      function toggleSambunganListrikTable() {
                        const pilihan = document.getElementById("sambunganListrik").value;
                        const tableDistribusi = document.getElementById("sambunganListrikTable");
                        const inputsDistribusi = tableDistribusi.querySelectorAll("input, select");

                        if (pilihan === "ada") {
                          tableDistribusi.classList.remove("hidden");

                          // Aktifkan semua input
                          inputsDistribusi.forEach(input => {
                            input.disabled = false;
                          });
                        } else {
                          tableDistribusi.classList.add("hidden");

                          // Nonaktifkan semua input (agar tidak ikut submit)
                          inputsDistribusi.forEach(input => {
                            input.disabled = true;
                          });
                        }
                      }
                    </script>



                    <div class="flex justify-between mt-4">
                      <button type="button" onclick="goToPrevPage()" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-green-500">Kembali</button>
                      <button type="button" onclick="goToNextPage()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Selanjutnya</button>
                    </div>
                  </div>


                  <div id="page3" class="page hidden">

                    <!-- Container Tabel Kapasitas -->
                    <div id="kapasitasContainer" class="mt-6"></div>

                    <script>
                      const bulanList = [
                        "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
                      ];

                      const jenisPembangkitTabelSet = new Set();

                      function createEnergiTable(jenis) {
                        const jenisKey = jenis.replace(/\s+/g, '_');
                        const tableId = `energiTable_${jenisKey}`;
                        const container = document.getElementById("kapasitasContainer");

                        // Jangan buat ulang kalau sudah ada
                        if (document.getElementById(tableId)) return;

                        const section = document.createElement("div");
                        section.classList.add("mb-6");

                        section.innerHTML = `
    <h3 class="text-lg font-bold uppercase mt-6 pb-2 text-gray-700 dark:text-white">
      Kapasitas Produksi Tenaga Listrik Pemakaian Sendiri (${jenis})
    </h3>
    <div class="overflow-x-auto">
      <table id="${tableId}" class="min-w-full border border-gray-300 text-sm">
        <thead>
          <tr>
            <th class="border border-gray-300 p-2 bg-gray-100">Bulan</th>
            <th class="border border-gray-300 p-2 bg-gray-100">Total Kapasitas Pembangkit (kW)</th>
            <th class="border border-gray-300 p-2 bg-gray-100">Faktor Daya (Cos φ)</th>
            <th class="border border-gray-300 p-2 bg-gray-100">Jam Nyala (Jam)</th>
            <th class="border border-gray-300 p-2 bg-gray-100">Daya Terpakai (kWh)</th>
          </tr>
        </thead>
        <tbody id="body_${tableId}"></tbody>
      </table>
    </div>
  `;

                        container.appendChild(section);
                        const tbody = section.querySelector(`#body_${tableId}`);

                        bulanList.forEach((bulan, i) => {
                          const tr = document.createElement("tr");
                          tr.innerHTML = `
      <td class="border p-2">${bulan}</td>
      <td class="border p-2">
        <input type="text" name="pemakaian_sendiri[${jenisKey}][${bulan}][kapasitas]" class="w-full border p-1 rounded" required>
      </td>
      <td class="border p-2">
        <input type="text" name="pemakaian_sendiri[${jenisKey}][${bulan}][faktor_daya]" class="w-full border p-1 rounded" required>
      </td>
      <td class="border p-2">
        <input type="text" name="pemakaian_sendiri[${jenisKey}][${bulan}][jam_nyala]" class="w-full border p-1 rounded" required>
      </td>
      <td class="border p-2">
        <input type="text" name="pemakaian_sendiri[${jenisKey}][${bulan}][daya_terpakai]" class="w-full border p-1 rounded" required>
      </td>
    `;
                          tbody.appendChild(tr);
                        });
                      }

                      function handleJenisPembangkitChange(selectElement) {
                        const jenis = selectElement.value.trim();
                        if (!jenis || jenisPembangkitTabelSet.has(jenis)) return;

                        jenisPembangkitTabelSet.add(jenis);
                        createEnergiTable(jenis);
                      }

                      document.addEventListener("DOMContentLoaded", () => {
                        // Attach listener ke dropdown yang dinamis
                        const observer = new MutationObserver(() => {
                          document.querySelectorAll('select[name="jenis_pembangkit[]"]').forEach(select => {
                            if (!select.dataset.listenerAttached) {
                              select.addEventListener("change", () => handleJenisPembangkitChange(select));
                              select.dataset.listenerAttached = "true";
                            }
                          });
                        });

                        observer.observe(document.body, {
                          childList: true,
                          subtree: true
                        });

                        // Trigger awal untuk select yang sudah ada
                        document.querySelectorAll('select[name="jenis_pembangkit[]"]').forEach(select => {
                          select.addEventListener("change", () => handleJenisPembangkitChange(select));
                          select.dataset.listenerAttached = "true";
                        });
                      });
                    </script>







                    <div class="mt-6">
                      <label for="excessPowerDropdown" class="block text-sm font-medium text-gray-700">
                        Apakah ada penjualan kelebihan tenaga listrik?
                      </label>
                      <select name="penjualan_listrik" id="excessPowerDropdown" class="mt-1 block w-full p-2 border rounded-md" onchange="toggleExcessPowerTable()" required>
                        <option value="" disabled selected hidden>Pilih</option>
                        <option value="yes">Ada</option>
                        <option value="no">Tidak</option>
                      </select>
                    </div>

                    <!-- Section Tabel -->
                    <div class="mt-6 hidden" id="excessPowerSection">
                      <h3 class="text-lg font-bold uppercase mt-6 pb-2 text-gray-700 dark:text-white">
                        Penjualan Kelebihan Tenaga Listrik (Excess Power)
                      </h3>
                      <div class="overflow-x-auto">
                        <table id="excessPowerTable" name="data_penjualan" class="min-w-full border border-gray-300 text-sm">
                          <thead>
                            <tr class="bg-gray-100">
                              <th class="border p-2">Bulan</th>
                              <th class="border p-2">DMN/NDC</th>
                              <th class="border p-2">Beban Tertinggi (MW)</th>
                              <th class="border p-2">Capacity Factor (%)</th>
                              <th class="border p-2">AFpm (%)</th>
                              <th class="border p-2">AFa (%)</th>
                              <th class="border p-2">Pembelian (MWh)</th>
                              <th class="border p-2">Produksi Bruto (MWh)</th>
                              <th class="border p-2">Pemakaian Sendiri (MWh)</th>
                              <th class="border p-2">Produksi Netto (MWh)</th>
                            </tr>
                          </thead>
                          <tbody id="excessPowerTableBody"></tbody>
                        </table>
                      </div>
                      <p class="text-xs mt-2 text-gray-600">
                        *) Hanya diisi jika terdapat penjualan kelebihan daya listrik.
                      </p>
                    </div>

                    <script>
                      function toggleExcessPowerTable() {
                        const dropdown = document.getElementById("excessPowerDropdown");
                        const tableSection = document.getElementById("excessPowerSection");
                        const tableBody = document.getElementById("excessPowerTableBody");

                        if (dropdown.value === "yes") {
                          tableSection.classList.remove("hidden");

                          // Bersihkan dulu tbody supaya tidak dobel
                          tableBody.innerHTML = "";

                          const months = [
                            "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
                          ];

                          months.forEach((month, index) => {
                            let row = document.createElement("tr");
                            row.innerHTML = `
          <td class="border p-1">${month}</td>
          <td class="border p-1"><input type="text" name="excess_power[${index}][dmn_ndc]" class="w-full border rounded px-1 py-0.5" /></td>
          <td class="border p-1"><input type="text" name="excess_power[${index}][beban_tertinggi]" class="w-full border rounded px-1 py-0.5" /></td>
          <td class="border p-1"><input type="text" name="excess_power[${index}][capacity_factor]" class="w-full border rounded px-1 py-0.5" /></td>
          <td class="border p-1"><input type="text" name="excess_power[${index}][afpm]" class="w-full border rounded px-1 py-0.5" /></td>
          <td class="border p-1"><input type="text" name="excess_power[${index}][afa]" class="w-full border rounded px-1 py-0.5" /></td>
          <td class="border p-1"><input type="text" name="excess_power[${index}][pembelian]" class="w-full border rounded px-1 py-0.5" /></td>
          <td class="border p-1"><input type="text" name="excess_power[${index}][produksi_bruto]" class="w-full border rounded px-1 py-0.5" /></td>
          <td class="border p-1"><input type="text" name="excess_power[${index}][pemakaian_sendiri]" class="w-full border rounded px-1 py-0.5" /></td>
          <td class="border p-1"><input type="text" name="excess_power[${index}][produksi_netto]" class="w-full border rounded px-1 py-0.5" /></td>
        `;
                            tableBody.appendChild(row);
                          });

                        } else {
                          tableSection.classList.add("hidden");
                          tableBody.innerHTML = ""; // kosongkan kalau pilih "no"
                        }
                      }

                      // VALIDASI SAAT SUBMIT
                      document.getElementById("formSuratBerkala").addEventListener("submit", function(e) {
                        const dropdown = document.getElementById("excessPowerDropdown");

                        // Validasi dropdown
                        if (dropdown.value === "") {
                          e.preventDefault();
                          Swal.fire({
                            icon: 'warning',
                            title: 'Pilih Opsi Diperlukan',
                            text: 'Silakan pilih apakah ada penjualan kelebihan tenaga listrik.',
                            confirmButtonColor: '#2563eb'
                          });
                          dropdown.focus();
                          return;
                        }

                        // Validasi input tabel jika "yes"
                        if (dropdown.value === "yes") {
                          const inputs = document.querySelectorAll("#excessPowerTableBody input");
                          let empty = false;

                          inputs.forEach(input => {
                            if (input.value.trim() === "") {
                              empty = true;
                              input.classList.add("border-red-500");
                            } else {
                              input.classList.remove("border-red-500");
                            }
                          });

                          if (empty) {
                            e.preventDefault();
                            Swal.fire({
                              icon: 'warning',
                              title: 'Tabel Belum Lengkap',
                              text: 'Silakan lengkapi semua kolom pada tabel Excess Power.',
                              confirmButtonColor: '#2563eb'
                            });
                          }
                        }
                      });
                    </script>


                    <!-- CHECKBOX -->
                    <label class="inline-block my-4 font-bold text-m text-slate-700 dark:text-white">
                      <input type="checkbox" class="form-checkbox" id="slo_agreement">
                      <span class="ml-2 text-m">Dengan ini menyatakan bahwa saya bertanggung jawab sepenuhnya atas data yang telah disampaikan.
                        Apabila dikemudian hari ditemukan bahwa data tersebut tidak benar dan mengakibatkan konsekuensi hukum,
                        maka saya atau Badan Usaha / Instansi yang saya wakili bersedia menerima segala bentuk sanksi sesuai dengan ketentuan peraturan perundang-undangan yang berlaku.
                      </span>
                    </label>

                    <div class="flex justify-between mt-4">
                      <button type="button" onclick="goToPrevPage()" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">Kembali</button>
                      <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Kirim</button>
                    </div>
                  </div>
                </form>


              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </main>


  <script>
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

      // Validasi semua input, select, textarea yang required di halaman aktif
      function validateCurrentPage() {
        const currentInputs = document.querySelectorAll(
          `#page${currentPage} input, #page${currentPage} select, #page${currentPage} textarea`
        );

        let valid = true;

        currentInputs.forEach(input => {
          const isRequired = input.hasAttribute("required");
          const type = input.type;

          if (isRequired) {
            if (type === "file") {
              if (!input.files || input.files.length === 0) {
                input.classList.add("border-red-500");
                valid = false;
              } else {
                input.classList.remove("border-red-500");
              }
            } else if (input.tagName === "SELECT") {
              if (!input.value) {
                input.classList.add("border-red-500");
                valid = false;
              } else {
                input.classList.remove("border-red-500");
              }
            } else {
              if (!input.value.trim()) {
                input.classList.add("border-red-500");
                valid = false;
              } else {
                input.classList.remove("border-red-500");
              }
            }
          }
        });

        return valid;
      }

      // Tombol Selanjutnya
      window.goToNextPage = function() {
        if (validateCurrentPage()) {
          if (currentPage < totalPages) {
            showPage(currentPage + 1);
          }
        } else {
          Swal.fire({
            icon: 'warning',
            title: 'Data Belum Lengkap',
            text: 'Mohon lengkapi semua data terlebih dahulu.',
            confirmButtonText: 'Oke',
            confirmButtonColor: '#2563eb'
          });
        }
      };

      // Tombol Sebelumnya
      window.goToPrevPage = function() {
        if (currentPage > 1) {
          showPage(currentPage - 1);
        }
      };

      // Validasi AKHIR saat SUBMIT
      const form = document.querySelector("form");
      form.addEventListener("submit", function(e) {
        // Cek ulang semua halaman (jika perlu)
        const allRequired = document.querySelectorAll("input[required], select[required], textarea[required]");
        let complete = true;

        allRequired.forEach(field => {
          if (field.type === "file") {
            if (!field.files || field.files.length === 0) {
              field.classList.add("border-red-500");
              complete = false;
            } else {
              field.classList.remove("border-red-500");
            }
          } else if (field.tagName === "SELECT") {
            if (!field.value) {
              field.classList.add("border-red-500");
              complete = false;
            } else {
              field.classList.remove("border-red-500");
            }
          } else {
            if (!field.value.trim()) {
              field.classList.add("border-red-500");
              complete = false;
            } else {
              field.classList.remove("border-red-500");
            }
          }
        });

        // Validasi checkbox setelah semua input valid
        const agreement = document.getElementById("slo_agreement");
        if (!complete) {
          e.preventDefault();
          Swal.fire({
            icon: 'warning',
            title: 'Data Belum Lengkap',
            text: 'Mohon lengkapi semua kolom yang wajib diisi.',
            confirmButtonColor: '#2563eb'
          });
          return;
        }

        if (!agreement || !agreement.checked) {
          e.preventDefault();
          Swal.fire({
            icon: 'warning',
            title: 'Centang Pernyataan',
            text: 'Harap centang pernyataan sebelum mengirim.',
            confirmButtonColor: '#2563eb'
          });
        }
      });

      // Inisialisasi Halaman Pertama
      showPage(1);
    });

    // Inisialisasi Flatpickr
    document.addEventListener("DOMContentLoaded", function() {
      flatpickr(".datepicker", {
        dateFormat: "d-m-Y",
        locale: "id",
        allowInput: true
      });
    });

    function validateForm(e) {
      // === 1. Validasi kapasitasContainer ===
      const kapasitasContainer = document.getElementById("kapasitasContainer");

      // ambil semua input di dalam container
      const kapasitasInputs = kapasitasContainer.querySelectorAll('input[type="text"]');

      // cek kalau belum ada tabel/input sama sekali
      if (kapasitasInputs.length === 0) {
        e.preventDefault();
        Swal.fire({
          icon: 'warning',
          title: 'Isi Kapasitas',
          text: 'Harap pilih jenis pembangkit dan isi tabel kapasitas terlebih dahulu.',
          confirmButtonColor: '#2563eb'
        });
        return false;
      }

      // cek kalau ada input yang masih kosong
      let kosong = false;
      kapasitasInputs.forEach(input => {
        if (input.value.trim() === "") {
          kosong = true;
          input.classList.add("border-red-500");
        } else {
          input.classList.remove("border-red-500");
        }
      });

      if (kosong) {
        e.preventDefault();
        Swal.fire({
          icon: 'warning',
          title: 'Lengkapi Kapasitas',
          text: 'Harap lengkapi semua data kapasitas di tabel.',
          confirmButtonColor: '#2563eb'
        });
        return false;
      }



      // === 2. Validasi excessPowerDropdown ===
      const excessPowerDropdown = document.getElementById("excessPowerDropdown");
      if (!excessPowerDropdown.value || excessPowerDropdown.value.trim() === "") {
        e.preventDefault();
        excessPowerDropdown.classList.add("border-red-500");
        Swal.fire({
          icon: 'warning',
          title: 'Pilih Opsi',
          text: 'Harap pilih salah satu pada dropdown.',
          confirmButtonColor: '#2563eb'
        });
        return false;
      } else {
        excessPowerDropdown.classList.remove("border-red-500");
      }

      // === 3. Validasi isi tabel (hanya jika dropdown = yes) ===
      if (excessPowerDropdown.value === "yes") {
        const excessPowerTableBody = document.getElementById("excessPowerTableBody");

        // Cek apakah tabel ada dan punya baris
        if (!excessPowerTableBody || excessPowerTableBody.children.length === 0) {
          e.preventDefault();
          excessPowerTableBody.classList.add("border", "border-red-500");
          Swal.fire({
            icon: 'warning',
            title: 'Isi Tabel',
            text: 'Harap isi data pada tabel terlebih dahulu.',
            confirmButtonColor: '#2563eb'
          });
          return false;
        } else {
          excessPowerTableBody.classList.remove("border-red-500");
        }

        // Cek apakah ada input kosong di dalam tabel
        const inputs = excessPowerTableBody.querySelectorAll("input");
        let emptyInput = Array.from(inputs).find(input => input.value.trim() === "");

        if (emptyInput) {
          e.preventDefault();
          emptyInput.classList.add("border-red-500");
          emptyInput.focus();
          Swal.fire({
            icon: 'warning',
            title: 'Data Tabel Belum Lengkap',
            text: 'Harap lengkapi semua input pada tabel.',
            confirmButtonColor: '#2563eb'
          });
          return false;
        }
      }

      // === 4. Validasi checkbox ===
      const checkbox = document.getElementById("slo_agreement");
      if (!checkbox || !checkbox.checked) {
        e.preventDefault();
        Swal.fire({
          icon: 'warning',
          title: 'Centang Pernyataan',
          text: 'Harap centang pernyataan sebelum mengirim.',
          confirmButtonColor: '#2563eb'
        });
        return false;
      }

      return true; // kalau semua valid, kirim form

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