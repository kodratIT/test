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

  table#table-nonSurya th:first-child,
  table#table-nonSurya td:first-child,
  table#table-surya th:first-child,
  table#table-surya td:first-child {
    width: 250px;
    /* Sesuaikan ukuran sesuai kebutuhan */
    text-align: left;
    white-space: nowrap;
    vertical-align: top;
  }

  #imageModal {
    cursor: zoom-out;
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
                <h4 class="text-lg font-bold mb-4 text-gray-700 dark:text-white text-center uppercase">DATA TEKNIS</h4>

                <form id="suratpengajuan" method="POST" action="/submit-url" onsubmit="return validateForm()">
                  <p class="leading-normal text-lg my-2 text-gray-700 dark:text-white uppercase font-bold">Data Pembangkit Tenaga Listrik
                  </p>
                  <div class="flex flex-wrap -mx-3">
                    <div class="w-full max-w-full px-3 shrink-0 md:w-full md:flex-0">
                      <label class="block text-m font-medium text-gray-700 mb-2">
                        Jenis Pembangkit Tenaga Listrik
                      </label>
                      <select id="pembangkitSelect" class="w-full border px-4 py-2 rounded mb-4"
                        onchange="showForm(this.value)" data-required>
                        <option value="" disabled selected hidden>- Pilih Jenis Pembangkit -</option>
                        <option value="nonSurya">Pembangkit Listrik Selain Tenaga Surya</option>
                        <option value="surya">Pembangkit Listrik Tenaga Surya</option>
                      </select>
                      <!-- FORM NON SURYA -->
                      <div id="form-nonSurya" class="hidden">
                        <h3 class="font-semibold mb-2"></h3>
                        <div class="mb-4 flex flex-wrap gap-2">

                          <button type="button" onclick="tambahKolom('nonSurya')"
                            class="bg-blue-600 hover:bg-blue-500 text-white px-3 py-1 rounded">
                            Tambah Unit
                          </button>
                          <button type="button" onclick="kurangiKolom('nonSurya')"
                            class="bg-red-600 hover:bg-red-500 text-white px-3 py-1 rounded ">
                            Kurangi Unit
                          </button>
                        </div>
                        <div class="overflow-scroll">
                          <table id="table-nonSurya">
                            <thead>
                              <tr id="header-nonSurya">
                                <th>SPESIFIKASI</th>
                                <th>UNIT 1</th>
                              </tr>
                            </thead>
                            <tbody id="body-nonSurya">
                              <tr>
                                <td>Jenis Penggerak</td>
                                <td><input placeholder="Contoh: Air / Diesel / Gas dsb" name="jenis_1" data-required></td>
                              </tr>
                              <tr>
                                <td>Merek</td>
                                <td><input name="merek_1" data-required></td>
                              </tr>
                              <tr>
                                <td>Tipe</td>
                                <td><input name="tipe_1" data-required></td>
                              </tr>
                              <tr>
                                <td>Negara Pembuat</td>
                                <td><input name="negara_1" data-required></td>
                              </tr>
                              <tr>
                                <td>Tahun Pembuatan</td>
                                <td><input name="tahun_1" data-required></td>
                              </tr>
                              <tr>
                                <td>Kapasitas (kW)</td>
                                <td><input placeholder="Satuan Dalam kilo Watt (kW) " name="kapasitas_1" data-required></td>
                              </tr>
                              <tr>
                                <td>Energi Primer</td>
                                <td><input placeholder="Contoh: Air / Biosolar / Dexlite / Pertamax / LPG / Biogas dsb" name="primer_1" data-required></td>
                              </tr>

                              <tr>
                                <td>Titik Koordinat (Latitude)</td>
                                <td>
                                  <input
                                    type="text"
                                    name="titikkordinatla_2"
                                    inputmode="decimal"
                                    pattern="^-?\d{1,2},\d+$"
                                    placeholder="-1,234567"
                                    title="Masukkan format desimal dengan koma, contoh: -1,234567"
                                    required>
                                </td>
                              </tr>

                              <tr>
                                <td>Titik Koordinat (Longitude)</td>
                                <td>
                                  <input
                                    type="text"
                                    name="titikkordinatlo_2"
                                    inputmode="decimal"
                                    pattern="^-?\d{1,3},\d+$"
                                    placeholder="103,456789"
                                    title="Masukkan format desimal dengan koma, contoh: 103,456789"
                                    required>
                                </td>
                              </tr>
                              <tr>
                                <td>Sifat Penggunaan</td>
                                <td>
                                  <select name="sifat_1" data-required>
                                    <option value="" disabled selected hidden>- Pilih -</option>
                                    <option value="Darurat">Utama</option>
                                    <option value="Permanen">Cadangan</option>
                                    <option value="Sementara">Darurat</option>
                                    <option value="Musiman">Sementara</option>
                                  </select>
                                </td>
                              </tr>
                              <tr>
                                <td>Foto Unit</td>
                                <td>
                                  <input type="file" name="foto_unit_1" accept="application/pdf, image/jpeg, image/png/*" onchange="previewGambar(this, 'preview_unit_1')" class="block" required>
                                  <img id="preview_unit_1" class="mt-2 w-24 hidden border rounded" />
                                </td>
                              </tr>

                              <tr>
                                <td>Foto Papan Nama (Name Plate) Generator</td>
                                <td>
                                  <input type="file" name="foto_generator_1" accept="application/pdf, image/jpeg, image/png/*" onchange="previewGambar(this, 'preview_generator_1')" class="block" required>
                                  <img id="preview_generator_1" class="mt-2 w-24 hidden border rounded" />
                                </td>
                              </tr>
                              <tr>
                                <td>Foto Papan Nama (Name Plate) Mesin Penggerak</td>
                                <td>
                                  <input type="file" name="foto_mesin_1" accept="application/pdf, image/jpeg, image/png/*" onchange="previewGambar(this, 'preview_mesin_1')" class="block" required>
                                  <img id="preview_mesin_1" class="mt-2 w-24 hidden border rounded" />
                                </td>
                              </tr>

                            </tbody>
                          </table>
                        </div>
                      </div>

                      <!-- FORM TENAGA SURYA -->
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
                                <th>SPESIFIKASI</th>
                                <th>UNIT 1</th>
                              </tr>
                            </thead>
                            <tbody id="body-surya">
                              <tr>
                                <td>Merek</td>
                                <td><input name="smerek_1" data-required></td>
                              </tr>
                              <tr>
                                <td>Tipe</td>
                                <td><input name="stipe_1" data-required></td>
                              </tr>
                              <tr>
                                <td>Negara Pembuat</td>
                                <td><input name="snegara_1" data-required></td>
                              </tr>
                              <tr>
                                <td>Tahun Pembuatan</td>
                                <td><input name="stahun_1" data-required></td>
                              </tr>
                              <tr>
                                <td>Kapasitas (kilo Watt-peak)</td>
                                <td><input placeholder="Satuan Dalam kilo Watt peak (kWp) " name="skapasitas_1" data-required></td>
                              </tr>
                              <tr>
                                <td>Titik Koordinat (Latitude)</td>
                                <td>
                                  <input
                                    type="text"
                                    name="titikkordinatla_2"
                                    inputmode="decimal"
                                    pattern="^-?\d{1,2},\d+$"
                                    placeholder="-1,234567"
                                    title="Masukkan format desimal dengan koma, contoh: -1,234567"
                                    required>
                                </td>
                              </tr>

                              <tr>
                                <td>Titik Koordinat (Longitude)</td>
                                <td>
                                  <input
                                    type="text"
                                    name="titikkordinatlo_2"
                                    inputmode="decimal"
                                    pattern="^-?\d{1,3},\d+$"
                                    placeholder="103,456789"
                                    title="Masukkan format desimal dengan koma, contoh: 103,456789"
                                    required>
                                </td>
                              </tr>


                              <tr>
                                <td>Sifat Penggunaan</td>
                                <td>
                                  <select name="sifat_2" data-required>
                                    <option value="" disabled selected hidden>-- Pilih --</option>
                                    <option value="Darurat">Utama</option>
                                    <option value="Permanen">Cadangan</option>
                                    <option value="Sementara">Darurat</option>
                                    <option value="Musiman">Sementara</option>
                                  </select>
                                </td>
                              </tr>

                              <tr>
                                <td>Foto Unit</td>
                                <td>
                                  <input type="file" name="sfoto_unit_1" accept="application/pdf, image/jpeg, image/png/*" onchange="previewGambar(this, 'spreview_unit_1')" data-data-required>
                                  <img id="spreview_unit_1" class="mt-2 w-24 hidden border rounded" />
                                </td>
                              </tr>
                              <tr>
                                <td>Foto Papan Nama (Name Plate) Modul PLTS</td>
                                <td>
                                  <input type="file" name="sfoto_modul_1" accept="application/pdf, image/jpeg, image/png/*" onchange="previewGambar(this, 'spreview_modul_1')" data-required>
                                  <img id="spreview_modul_1" class="mt-2 w-24 hidden border rounded" />
                                </td>
                              </tr>
                              <tr>
                                <td>Foto Papan Nama (Name Plate) Inverter PLTS</td>
                                <td>
                                  <input type="file" name="sfoto_inverter_1" accept="application/pdf, image/jpeg, image/png/*" onchange="previewGambar(this, 'spreview_inverter_1')" data-required>
                                  <img id="spreview_inverter_1" class="mt-2 w-24 hidden border rounded" />
                                </td>
                              </tr>


                            </tbody>
                          </table>
                          <br>
                        </div>
                      </div>
                      <script>
                        const MAX_FILE_SIZE_MB = 5;
                        const MAX_FILE_SIZE = MAX_FILE_SIZE_MB * 1024 * 1024;

                        function showForm(val) {
                          document.getElementById('form-nonSurya').classList.add('hidden');
                          document.getElementById('form-surya').classList.add('hidden');
                          document.getElementById('alamatForm1').classList.add('hidden');

                          if (val === 'nonSurya') {
                            document.getElementById('form-nonSurya').classList.remove('hidden');
                            document.getElementById('alamatForm1').classList.remove('hidden');
                            tampilkanLampiran('nonSurya');
                          } else if (val === 'surya') {
                            document.getElementById('form-surya').classList.remove('hidden');
                            document.getElementById('alamatForm1').classList.remove('hidden');
                            tampilkanLampiran('surya');
                          }
                        }

                        function tampilkanLampiran(tipe) {
                          const labelGenerator = document.querySelector('label[for="foto_generator"]');
                          const labelMesin = document.querySelector('label[for="foto_mesin"]');
                          const inputGenerator = document.getElementById('foto_generator');
                          const inputMesin = document.getElementById('foto_mesin');

                          if (!labelGenerator || !labelMesin || !inputGenerator || !inputMesin) return;

                          if (tipe === 'nonSurya') {
                            labelGenerator.innerText = "Foto Papan Nama (Name Plate) Generator";
                            labelMesin.innerText = "Foto Papan Nama (Name Plate) Mesin Penggerak";
                            inputGenerator.name = "foto_generator";
                            inputMesin.name = "foto_mesin";
                          } else {
                            labelGenerator.innerText = "Foto Papan Nama (Name Plate) Modul PLTS";
                            labelMesin.innerText = "Foto Papan Nama (Name Plate) Inverter PLTS";
                            inputGenerator.name = "foto_modul";
                            inputMesin.name = "foto_inverter";
                          }

                          inputGenerator.required = true;
                          inputMesin.required = true;
                        }

                        

                        function previewGambar(input, previewId) {
                          const file = input.files[0];
                          if (!file) return;

                          if (file.size > MAX_FILE_SIZE) {
                            alert(`Ukuran file maksimal ${MAX_FILE_SIZE_MB}MB`);
                            input.value = "";
                            return;
                          }

                          const allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
                          if (!allowedTypes.includes(file.type)) {
                            alert("File harus berupa JPG, PNG, atau PDF");
                            input.value = "";
                            return;
                          }

                          const reader = new FileReader();
                          reader.onload = function(e) {
                            const img = document.getElementById(previewId);

                            if (file.type === "application/pdf") {
                              img.src = "/assets/img/iconpdf.jpg"; // Gambar ikon PDF
                              img.setAttribute('data-pdf', e.target.result); // Simpan base64 PDF
                              img.onclick = () => {
                                const pdfWindow = window.open();
                                pdfWindow.document.write(`
          <html>
            <head><title>Preview PDF</title></head>
            <body style="margin:0">
              <embed src="${e.target.result}" type="application/pdf" width="100%" height="100%"/>
            </body>
          </html>
        `);
                              };
                            } else {
                              img.src = e.target.result;
                              img.onclick = () => tampilkanModalGambar(e.target.result);
                            }

                            img.classList.remove('hidden');
                            img.classList.add('cursor-zoom-in');
                          };
                          reader.readAsDataURL(file);
                        }



                        function tampilkanModalGambar(src) {
                          const modal = document.getElementById('imageModal');
                          const modalImage = document.getElementById('modalImage');
                          const sidebar = document.getElementById('sidebar');

                          modalImage.src = src;
                          modal.classList.remove('hidden');

                          if (sidebar) {
                            sidebar.classList.add('-translate-x-full');
                            sidebar.classList.remove('translate-x-0', 'lg:translate-x-0');
                          }
                        }

                        function closeImageModal() {
                          const modal = document.getElementById('imageModal');
                          const sidebar = document.getElementById('sidebar');

                          modal.classList.add('hidden');
                          if (sidebar) {
                            sidebar.classList.remove('-translate-x-full');
                            sidebar.classList.add('translate-x-0', 'lg:translate-x-0');
                          }
                        }

                        function tambahKolom(tipe) {
                          const prefix = tipe === 'surya' ? 's' : '';
                          const header = document.getElementById('header-' + tipe);
                          const tbody = document.getElementById('body-' + tipe);
                          const kolomBaru = header.children.length;

                          const th = document.createElement('th');
                          th.innerText = 'UNIT ' + kolomBaru;
                          header.appendChild(th);

                          const rows = tbody.getElementsByTagName('tr');
                          for (let i = 0; i < rows.length; i++) {
                            const td = document.createElement('td');
                            const label = rows[i].children[0].innerText.trim().toLowerCase();

                            let input, preview;

                            if (label.includes('sifat penggunaan')) {
                              const select = document.createElement('select');
                              select.name = prefix + 'sifat_' + kolomBaru;
                              select.required = true;

                              ['-- Pilih --', 'Utama', 'Cadangan', 'Darurat', 'Sementara'].forEach((opt, idx) => {
                                const option = document.createElement('option');
                                option.value = idx === 0 ? '' : opt;
                                option.text = opt;
                                if (idx === 0) {
                                  option.disabled = true;
                                  option.selected = true;
                                  option.hidden = true;
                                }
                                select.appendChild(option);
                              });
                              td.appendChild(select);

                            } else if (label.includes('foto unit') || label.includes('modul') || label.includes('generator') || label.includes('inverter') || label.includes('mesin penggerak')) {
                              input = document.createElement('input');
                              input.type = 'file';
                              input.accept = 'application/pdf, image/jpeg, image/png';
                              input.name = prefix + 'foto_' + kolomBaru + '_' + i;
                              input.required = true;

                              preview = document.createElement('img');
                              preview.id = prefix + 'preview_' + kolomBaru + '_' + i;
                              preview.className = 'mt-2 w-24 hidden border rounded';

                              input.addEventListener('change', () => previewGambar(input, preview.id));

                              td.appendChild(input);
                              td.appendChild(preview);

                            } else if (label.includes('titik koordinat (latitude)')) {
                              input = document.createElement('input');
                              input.type = 'text';
                              input.name = prefix + 'titikkordinatla_' + kolomBaru;
                              input.pattern = "^-?\\d{1,2},\\d+$";
                              input.title = 'Masukkan format desimal, contoh: -1,234567';
                              input.placeholder = '-1,234567';
                              input.required = true;
                              input.addEventListener('input', () => {
                                input.value = input.value.replace(/\./g, ',');
                              });
                              td.appendChild(input);

                            } else if (label.includes('titik koordinat (longitude)')) {
                              input = document.createElement('input');
                              input.type = 'text';
                              input.name = prefix + 'titikkordinatlo_' + kolomBaru;
                              input.pattern = "^-?\\d{1,3},\\d+$";
                              input.title = 'Masukkan format desimal, contoh: 103,456789';
                              input.placeholder = '103,456789';
                              input.required = true;
                              input.addEventListener('input', () => {
                                input.value = input.value.replace(/\./g, ',');
                              });
                              td.appendChild(input);

                            } else {
                              input = document.createElement('input');
                              const nameBase = label.replace(/[()]/g, '').replace(/\s+/g, '').toLowerCase();
                              input.name = prefix + nameBase + '_' + kolomBaru;
                              input.required = true;
                              td.appendChild(input);
                            }

                            rows[i].appendChild(td);
                          }
                        }

                        function kurangiKolom(tipe) {
                          const header = document.getElementById('header-' + tipe);
                          const tbody = document.getElementById('body-' + tipe);

                          if (header.children.length > 2) {
                            header.removeChild(header.lastElementChild);
                            const rows = tbody.getElementsByTagName('tr');
                            for (let i = 0; i < rows.length; i++) {
                              rows[i].removeChild(rows[i].lastElementChild);
                            }
                          }
                        }

                        function formatKoordinatUnitAwal() {
                          const latitudeInput = document.querySelector('input[name="titikkordinatla_1"]');
                          const longitudeInput = document.querySelector('input[name="titikkordinatlo_1"]');

                          if (latitudeInput) {
                            latitudeInput.addEventListener('input', () => {
                              latitudeInput.value = latitudeInput.value.replace(/\./g, ',');
                            });
                          }

                          if (longitudeInput) {
                            longitudeInput.addEventListener('input', () => {
                              longitudeInput.value = longitudeInput.value.replace(/\./g, ',');
                            });
                          }
                        }

                        document.addEventListener('DOMContentLoaded', () => {
                          const closeBtn = document.getElementById('closeModalBtn');
                          if (closeBtn) {
                            closeBtn.addEventListener('click', closeImageModal);
                          }

                          formatKoordinatUnitAwal();
                        });
                      </script>

                      <!-- Bagian 2: Jaringan Distribusi -->
                      <div class="mb-10">
                        <p class="leading-normal text-lg text-gray-700 dark:text-white uppercase font-bold">Jaringan
                          Distribusi</p>

                        <label for="jaringanDistribusi" class="block text-m my-2 font-medium text-gray-700 mb-2">Apakah Ada
                          Jaringan Distribusi?</label>
                        <select id="jaringanDistribusi"
                          class="w-full px-4 py-2 border rounded-lg dark:bg-slate-700 dark:text-white"
                          onchange="toggleJaringanDistribusi()" data-required>
                          <option value="" disabled selected hidden>- Pilih -</option>
                          <option value="ada">Ada</option>
                          <option value="tidak">Tidak Ada</option>
                        </select>

                        <!-- Form Tambahan Jaringan Distribusi -->

                        <div id="form-jaringan" class="hidden mt-4">
                          <div class="mb-4">
                            <label for="panjangSaluran" class="block text-m my-2 font-medium text-gray-700">Panjang Saluran (Kms)</label>
                            <input type="text" id="panjangSaluran" name="panjang_saluran"
                              class="mt-1 w-full p-2 border rounded dark:bg-slate-700 dark:text-white"
                              placeholder="Contoh: 13,00"
                              pattern="^\d+(,\d{1,2})?$"
                              title="Gunakan angka bulat atau dengan koma maksimal dua angka desimal, misal: 220, 220,5 atau 220,50"
                              data-required>
                          </div>

                          <div class="mb-4">
                            <label for="tegangan" class="block text-m font-medium text-gray-700">Tegangan (Volt)</label>
                            <input type="text" id="tegangan" name="tegangan"
                              class="mt-1 w-full p-2 border rounded dark:bg-slate-700 dark:text-white"
                              placeholder="Contoh: 220,00"
                              pattern="^\d+(,\d{1,2})?$"
                              title="Gunakan angka bulat atau dengan koma maksimal dua angka desimal, misal: 220, 220,5 atau 220,50"
                              data-required>
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
                        <div class="mb-6">
                          <p class="leading-normal text-lg my-2 text-gray-700 dark:text-white uppercase font-bold">Sambungan
                            Listrik dari Pihak Lain</p>
                          <label for="sambunganListrik" class="block text-m font-medium text-gray-700 mb-2">Apakah Ada
                            Sambungan Listrik dari Pihak Lain?</label>
                          <select id="sambunganListrik"
                            class="w-full px-4 py-2 border rounded-lg dark:bg-slate-700 dark:text-white"
                            onchange="toggleSambunganForm()" data-required>
                            <option value="" disabled selected hidden>- Pilih -</option>
                            <option value="ada">Ada</option>
                            <option value="tidak">Tidak Ada</option>
                          </select>

                          <!-- Form Tambahan Jika "Ada" -->
                          <div id="form-sambungan" class="hidden mt-4">
                            <div class="mb-4">
                              <label for="pihakLain" class="block text-m my-2 font-medium text-gray-700">Dari Pihak
                                Lain</label>
                              <input type="text" id="pihakLain" name="pihak_lain"
                                class="mt-1 w-full p-2 border rounded dark:bg-slate-700 dark:text-white"
                                placeholder="Contoh: PT. PLN" data-required>
                            </div>

                            <div class="mb-4">
                              <label for="dayaTersambung" class="block text-m my-2 font-medium text-gray-700">Daya Tersambung
                                (kVA)</label>
                              <input type="text" id="dayaTersambung" name="daya_tersambung"
                                class="mt-1 w-full p-2 border rounded dark:bg-slate-700 dark:text-white"
                                placeholder="Contoh: 50,00"
                                pattern="^\d+(,\d{1,2})?$"
                                title="Gunakan angka bulat atau dengan koma maksimal dua angka desimal, misal: 50, 50,5 atau 50,00"
                                data-required>

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
                            const tagihan = document.getElementById("form-tagihan");

                            const isAda = value === "ada";
                            form.classList.toggle("hidden", !isAda);
                            tagihan.classList.toggle("hidden", !isAda);
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



                        <p class="leading-normal text-lg my-2 text-gray-700 dark:text-white uppercase font-bold">
                          Lokasi Instalasi Penyediaan Tenaga Listrik
                        </p>

                        <div class="flex flex-wrap -mx-3">
                          <div class="w-full max-w-full px-3 shrink-0 md:w-full md:flex-0">
                            <div id="alamatForm" class=" mb-4">
                              <div class="mb-2">
                                <label for="keterangan" class="inline-block mb-2 ml-1 font-bold text-m text-slate-700 dark:text-white/80">Nama Jalan</label>
                                <textarea name="keterangan" rows="2" id="keterangan" class="w-full px-4 py-2 border rounded-lg dark:bg-slate-700 dark:text-white" data-required></textarea>
                              </div>

                              <div class="mb-2">
                                <label for="addressdes" class="inline-block mb-2 ml-1 font-bold text-m text-slate-700 dark:text-white/80">Desa / Kelurahan</label>
                                <input type="text" name="addressdes" id="addressdes" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm block w-full rounded-lg border border-gray-300 bg-white px-3 py-2" data-required>
                              </div>

                              <div class="mb-2">
                                <label for="addresskec" class="inline-block mb-2 ml-1 font-bold text-m text-slate-700 dark:text-white/80">Kecamatan</label>
                                <input type="text" name="addresskec" id="addresskec" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm block w-full rounded-lg border border-gray-300 bg-white px-3 py-2" data-required>
                              </div>

                              <div class="mb-2">
                                <label for="addresskab" class="inline-block mb-2 ml-1 font-bold text-m text-slate-700 dark:text-white/80">
                                  Kabupaten / Kota
                                </label>
                                <select name="addresskab" id="addresskab"
                                  class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm block w-full rounded-lg border border-gray-300 bg-white px-3 py-2"
                                  data-required>
                                  <option value="" disabled selected>- Pilih Kabupaten/Kota -</option>
                                  <option value="Batang Hari">Batang Hari</option>
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
                              </div>

                              <div class="mb-2">
                                <label for="addressprov" class="inline-block mb-2 ml-1 font-bold text-m text-slate-700 dark:text-white/80">
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

                        <!-- Toggle Script -->
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


                        <p class="leading-normal text-lg text-gray-700 dark:text-white uppercase font-bold">
                          Lampiran Dokumen
                        </p>

                        <div id="alamatForm1" class="mb-1">
                          <div class="mt-3 space-y-4">

                            <!-- NIB -->
                            <div>
                              <label class="block text-m font-medium text-gray-700 dark:text-white mb-1">
                                Print Out NIB via OSS RBA (Untuk Badan Usaha)
                              </label>
                              <input type="file" name="nib" id="nib" accept=".jpg,.jpeg,.png,.pdf" onchange="previewGambar(this, 'preview_nib')"
                                class="block w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer bg-white 
                focus:outline-none dark:bg-slate-700 dark:text-white dark:border-gray-600" class="block" data-required>
                              <img id="preview_nib" class="mt-2 w-40 hidden border rounded" />
                            </div>

                            <!-- KTP -->
                            <div>
                              <label class="block text-m font-medium text-gray-700 dark:text-white mb-1">KTP Penanggung Jawab</label>
                              <input type="file" name="ktp" id="ktp" accept=".jpg,.jpeg,.png,.pdf" onchange="previewGambar(this, 'preview_ktp')"
                                class="block w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer bg-white 
                focus:outline-none dark:bg-slate-700 dark:text-white dark:border-gray-600" class="block" data-required>
                              <img id="preview_ktp" class="mt-2 w-40 hidden border rounded" />
                            </div>

                            <!-- NPWP -->
                            <div>
                              <label class="block text-m font-medium text-gray-700 dark:text-white mb-1">NPWP</label>
                              <input type="file" name="npwp" id="npwp" accept=".jpg,.jpeg,.png,.pdf" onchange="previewGambar(this, 'preview_npwp')"
                                class="block w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer bg-white 
                focus:outline-none dark:bg-slate-700 dark:text-white dark:border-gray-600" class="block" data-required>
                              <img id="preview_npwp" class="mt-2 w-40 hidden border rounded" />
                            </div>

                            <!-- Gambar Situasi -->
                            <div>
                              <label class="block text-m font-medium text-gray-700 dark:text-white mb-1">Gambar Situasi / Tata Letak</label>
                              <input type="file" name="gambar_situasi" id="gambar_situasi" accept=".jpg,.jpeg,.png,.pdf" onchange="previewGambar(this, 'preview_situasi')"
                                class="block w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer bg-white 
                focus:outline-none dark:bg-slate-700 dark:text-white dark:border-gray-600" class="block" data-required>
                              <img id="preview_situasi" class="mt-2 w-40 hidden border rounded" />
                            </div>

                            <!-- Bukti Tagihan -->
                            <div id="form-tagihan" class="hidden">
                              <label class="block text-m font-medium text-gray-700 dark:text-white mb-1">
                                Bukti Pembayaran Tagihan Listrik Bulan Terakhir
                              </label>
                              <input type="file" name="bukti_tagihan" id="bukti_tagihan" accept=".jpg,.jpeg,.png,.pdf" onchange="previewGambar(this, 'preview_tagihan')"
                                class="block w-full text-m text-gray-700 border border-gray-300 rounded-lg cursor-pointer bg-white 
                focus:outline-none dark:bg-slate-700 dark:text-white dark:border-gray-600" class="block" data-required>
                              <img id="preview_tagihan" class="mt-2 w-40 hidden border rounded" />
                            </div>

                          </div>
                        </div>

                        <!-- Persetujuan -->
                        <div class="mt-4 flex items-start">
                          <input type="checkbox" id="persetujuan" class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-2 focus:ring-blue-500" data-required>
                          <label for="persetujuan" class="ml-2 text-m text-gray-700 dark:text-white leading-relaxed">
                            Dengan ini menyatakan bahwa saya bertanggung jawab sepenuhnya atas data yang telah disampaikan.
                            Apabila dikemudian hari ditemukan bahwa data tersebut tidak benar dan mengakibatkan konsekuensi hukum,
                            maka saya atau Badan Usaha / Instansi yang saya wakili bersedia menerima segala bentuk sanksi sesuai dengan ketentuan peraturan perundang-undangan yang berlaku.
                          </label>
                        </div>

                        <!-- JavaScript untuk Preview -->


                        <hr
                          class="h-px mx-0 my-4 bg-transparent border-0 opacity-25 bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent " />
                      </div>

                      <div class="w-full flex justify-center my-4 ">
                        <button type="submit" id="submitkirim"
                          class=" bg-blue-400 from-blue-500 to-violet-500 text-white px-6 py-2 rounded-full shadow hover:opacity-90">
                          Kirim
                        </button>
                      </div>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


  </main>
  <!-- -right-90 in loc de 0-->
  <div fixed-plugin-card
    class="z-sticky backdrop-blur-2xl backdrop-saturate-200 dark:bg-slate-850/80 shadow-3xl w-90 ease -right-90 fixed top-0 left-auto flex h-full min-w-0 flex-col break-words rounded-none border-0 bg-white/80 bg-clip-border px-2.5 duration-200">
  </div>
  </div>
  </div>

  <!-- Modal untuk preview gambar -->
  <div id="imageModal" class="fixed hidden inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50">
    <div class="relative">
      <!-- Tombol close -->
      <button id="closeModalBtn" class="absolute top-2 right-2 bg-white text-black text-xl font-bold rounded-full w-8 h-8 hover:bg-red-500 hover:text-white flex items-center justify-center z-50">
        &times;
      </button>
      <!-- Gambar ditampilkan di sini -->
      <img id="modalImage" class="max-w-screen-md max-h-screen border-4 border-white rounded shadow-lg" />
    </div>
  </div>





  <script>
    document.getElementById("suratpengajuan").addEventListener("submit", function(e) {
      e.preventDefault();

      const alamatForm1 = document.getElementById("alamatForm1");
      const form = e.target;

      if (alamatForm1 && alamatForm1.classList.contains("hidden")) {
        const requiredInputs = alamatForm1.querySelectorAll("[data-required]");

        if (requiredInputs.length > 0) {
          Swal.fire({
            icon: 'error',
            title: 'Data Belum Lengkap!',
            text: 'Silakan lengkapi semua data yang wajib diisi.',
            confirmButtonColor: '#e3342f'
          });
          return false;
        }
      }


      const isValid = validateForm();

      if (isValid) {
        form.submit();
      }
    });

    function validateForm() {
      const form = document.getElementById("suratpengajuan");
      const checkbox = document.getElementById("persetujuan");
      const requiredFields = Array.from(form.querySelectorAll("input[required], select[required], textarea[required]"))
        .filter(field => field.offsetParent !== null); // hanya ambil yang terlihat

      let isValid = true;

      requiredFields.forEach(field => {
        if (!field.value.trim()) {
          isValid = false;

          field.classList.add("border-red-500", "ring", "ring-red-300");
        } else {
          field.classList.remove("border-red-500", "ring", "ring-red-300");
        }
      });

      if (!isValid) {
        Swal.fire({
          icon: 'warning',
          title: 'Formulir Belum Lengkap',
          text: 'Harap isi semua kolom wajib yang kosong.',
          confirmButtonColor: '#f59e0b'
        });
        return false;
      }
      if (!checkbox.checked) {
        Swal.fire({
          icon: 'warning',
          title: 'Persetujuan Belum Dicentang',
          text: 'Anda harus menyetujui pernyataan tanggung jawab sebelum melanjutkan.',
          confirmButtonColor: '#f97316'
        });
        checkbox.classList.add("ring", "ring-red-500");
        return false;
      } else {
        checkbox.classList.remove("ring", "ring-red-500");
      }


      return true;

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