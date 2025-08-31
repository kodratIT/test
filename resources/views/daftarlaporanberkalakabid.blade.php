<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/png" href=" {{ asset('assets/img/logo-esdm.svg') }} " />
  <title>Daftar Laporan Berkala Kepala Bidang</title>
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

<body class="m-0 font-sans text-base antialiased font-normal dark:bg-slate-900 leading-default bg-gray-50 text-slate-500">
  <div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>

  @include('components.sidebarkabidberkala')
  <main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
    <!-- Navbar -->
    <nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all ease-in shadow-none duration-250 rounded-2xl lg:flex-nowrap lg:justify-start" navbar-main navbar-scroll="false">
      <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
        <nav>
          <!-- breadcrumb -->
          <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
            <li class="text-sm leading-normal">
              <a class="text-white opacity-50" href="javascript:;">Halaman</a>
            </li>
            <li class="text-sm pl-2 capitalize leading-normal text-white before:float-left before:pr-2 before:text-white before:content-['/']" aria-current="page">Daftar Laporan Berkala</li>
          </ol>
          <h6 class="mb-0 font-bold text-white capitalize">Daftar Laporan Berkala</h6>
        </nav>

        <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
          <div class="flex items-center md:ml-auto md:pr-4">
            <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
              <span class="text-sm ease leading-5.6 absolute z-50 -ml-px flex h-full items-center whitespace-nowrap rounded-lg rounded-tr-none rounded-br-none border border-r-0 border-transparent bg-transparent py-2 px-2.5 text-center font-normal text-slate-500 transition-all">
              </span>
              <!--<input type="text" class="pl-9 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 dark:bg-slate-850 dark:text-white bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" placeholder="Type here..." />
              -->
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
              <a href="javascript:;" class="block p-0 text-sm text-white transition-all ease-nav-brand" dropdown-trigger aria-expanded="false">
              </a>

              <ul dropdown-menu class="text-sm transform-dropdown before:font-awesome before:leading-default dark:shadow-dark-xl before:duration-350 before:ease lg:shadow-3xl duration-250 min-w-44 before:sm:right-8 before:text-5.5 pointer-events-none absolute right-0 top-0 z-50 origin-top list-none rounded-lg border-0 border-solid border-transparent dark:bg-slate-850 bg-white bg-clip-padding px-2 py-4 text-left text-slate-500 opacity-0 transition-all before:absolute before:right-2 before:left-auto before:top-0 before:z-50 before:inline-block before:font-normal before:text-white before:antialiased before:transition-all before:content-['\f0d8'] sm:-mr-6 lg:absolute lg:right-0 lg:left-auto lg:mt-2 lg:block lg:cursor-pointer">

              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>




    <div class="w-full px-6 py-6 mx-auto">
      <div class="flex flex-wrap -mx-3">
        <div class="w-full max-w-full px-3">
          <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border border-gray-200 shadow-lg rounded-2xl">

            <!-- Header -->
            <div class="p-4 flex justify-between items-center border-b border-gray-200">
              <h6 class="text-lg font-bold text-gray-700 uppercase tracking-wide">Daftar Laporan Berkala</h6>
              <button onclick="" class="bg-green-600 text-white px-4 py-2 font-semibold text-sm rounded-lg shadow hover:bg-green-500 transition">
                Unduh Data
              </button>
            </div>

            <!-- Table -->
            <div class="flex-auto overflow-x-auto">
              <table class="min-w-full text-sm text-left text-gray-700 border-separate border-spacing-0">
                <thead class="bg-blue-500 text-white uppercase text-xs tracking-wider">
                  <tr>
                    <th class="px-4 py-3 font-semibold">No</th>
                    <th class="px-4 py-3 font-semibold text-center">Tanggal</th>
                    <th class="px-4 py-3 font-semibold text-center">Badan Usaha</th>
                    <th class="px-4 py-3 font-semibold text-center">Catatan</th>
                    <th class="px-4 py-3 font-semibold text-center">Status</th>
                    <th class="px-4 py-3 font-semibold text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody id="laporan-kabid-table"></tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $(function() {
        function loadLaporanKabid() {
          $.ajax({
            url: "/daftarlaporanberkalakabid/list",
            type: "GET",
            dataType: "json",
            success: function(data) {
              let tbody = '';
              $.each(data, function(index, item) {
                const createdAt = new Date(item.created_at);
                const tanggal =
                  createdAt.getDate().toString().padStart(2, '0') + "-" +
                  (createdAt.getMonth() + 1).toString().padStart(2, '0') + "-" +
                  createdAt.getFullYear();

                // status badge
                const statusText = (item.status || '').toLowerCase();
                const statusMap = {
                  'proses evaluasi': 'bg-orange-400 text-white',
                  'perbaikan': 'bg-red-500 text-white',
                  'proses verifikasi': 'bg-blue-500 text-white',
                  'proses pengesahan': 'bg-green-400 text-white',
                  'disetujui': 'bg-green-600 text-white'
                };
                const badgeClass = statusMap[statusText] || 'bg-gray-400 text-white';
                const statusLabel = statusText.replace(/\b\w/g, c => c.toUpperCase());

                // striped rows
                const rowClass = index % 2 === 0 ? "bg-white" : "bg-gray-50";

                // sudut bawah untuk baris terakhir
                const isLast = index === data.length - 1;
                const firstTdRound = isLast ? ' rounded-bl-2xl' : '';
                const lastTdRound = isLast ? ' rounded-br-2xl' : '';

                // Kolom Action: jika status disetujui → tampilkan tombol Lihat + Dropdown
                let actionTd = '';
                if (statusText === 'disetujui') {
                  actionTd = `
    <td class="px-6 py-3 text-xs text-center dark:text-white border-b dark:border-white/40${lastTdRound}">
      <div class="inline-flex space-x-2">
        <!-- Tombol Lihat (hidden awal) -->
        <a id="lihatBtn-${index}" href="${item.action_link}" target="_blank" 
           class="hidden inline-flex items-center justify-center w-20 h-8 text-sm font-semibold text-white rounded bg-green-600 hover:bg-green-700 transition-all">
          Lihat
        </a>

        <!-- Tombol Dropdown -->
        <div class="relative inline-block text-left">
          <button onclick="toggleDropdown(this)" type="button" 
            class="inline-flex items-center justify-center w-28 h-8 text-sm font-semibold text-white bg-blue-500 rounded hover:bg-blue-600 transition-all">
            Pilih Aksi
            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
          </button>

          <!-- Dropdown Menu -->
          <div class="hidden absolute right-0 mt-2 w-36 bg-white rounded shadow-lg ring-1 ring-black ring-opacity-5 z-50">
            <a href="file_draft.docx" download onclick="markDownloaded(${index})"
               class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-100 hover:text-blue-700">
              Unduh Draft
            </a>
            <a href="javascript:;" onclick="document.getElementById('fileInput-${index}').click()"
               class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-100 hover:text-green-700">
              Upload Draft
            </a>
          </div>
        </div>

        <!-- Input File Tersembunyi -->
        <input type="file" id="fileInput-${index}" accept="application/pdf" class="hidden" onchange="handleFileUpload(this, ${index})">
      </div>
    </td>
  `;
                } else {
                  actionTd = `
                <td class="px-4 py-3 text-center${lastTdRound}">
                  <a href="${item.action_link}" class="text-blue-600 hover:underline font-medium text-sm">
                    ${item.action_text}
                  </a>
                </td>
              `;
                }

                // rakit baris tabel
                tbody += `
              <tr class="${rowClass} hover:bg-gray-100 transition">
                <td class="px-4 py-3 font-medium text-gray-800${firstTdRound}">${item.no_pengajuan}</td>
                <td class="px-4 py-3 text-center">${tanggal}</td>
                <td class="px-4 py-3 text-center">${item.badan_usaha}</td>
                <td class="px-4 py-3 text-center">${item.catatan}</td>
                <td class="px-4 py-3 text-center">
                  <span class="inline-block px-3 py-1 text-xs font-bold rounded-full ${badgeClass} whitespace-nowrap">
                    ${statusLabel}
                  </span>
                </td>
                ${actionTd}
              </tr>
            `;
              });
              $('#laporan-kabid-table').html(tbody);
            }
          });
        }

        loadLaporanKabid();
      });

      // === Script Tambahan untuk Dropdown & Modal ===
      function toggleDropdown(button) {
        const dropdown = button.nextElementSibling;
        dropdown.classList.toggle("hidden");
      }

    function handleFileUpload(input, rowId) {
  if (!rowStates[rowId]) rowStates[rowId] = { downloaded: false, uploaded: false };
  if (input.files.length > 0) {
    const file = input.files[0];
    // Validasi: hanya PDF
    if (file.type !== "application/pdf") {
      alert("Hanya file PDF yang diperbolehkan!");
      input.value = ""; // reset input
      return;
    }

    const fileName = file.name;
    document.getElementById("uploadedFileName").textContent = "File: " + fileName;
    document.getElementById("successModal").classList.remove("hidden");

    rowStates[rowId].uploaded = true;
    checkShowLihat(rowId);
  }
}


      function closeSuccessModal() {
        document.getElementById("successModal").classList.add("hidden");
      }

      // Tutup dropdown saat klik di luar
      window.addEventListener('click', function(e) {
        document.querySelectorAll('.relative.inline-block').forEach(function(el) {
          if (!el.contains(e.target)) {
            const menu = el.querySelector('div');
            if (menu) menu.classList.add('hidden');
          }
        });
      });
    </script>
    <script>
      // Track state per row
      const rowStates = {};

      function markDownloaded(rowId) {
        if (!rowStates[rowId]) rowStates[rowId] = {
          downloaded: false,
          uploaded: false
        };
        rowStates[rowId].downloaded = true;
        checkShowLihat(rowId);
      }

      function handleFileUpload(input, rowId) {
        if (!rowStates[rowId]) rowStates[rowId] = {
          downloaded: false,
          uploaded: false
        };
        if (input.files.length > 0) {
          const fileName = input.files[0].name;
          document.getElementById("uploadedFileName").textContent = "File: " + fileName;
          document.getElementById("successModal").classList.remove("hidden");

          rowStates[rowId].uploaded = true;
          checkShowLihat(rowId);
        }
      }

      function checkShowLihat(rowId) {
        const state = rowStates[rowId];
        if (state.downloaded && state.uploaded) {
          document.getElementById("lihatBtn-" + rowId).classList.remove("hidden");
        }
      }
    </script>


    <!-- Modal Notifikasi Upload -->
    <div id="successModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
      <div class="bg-white rounded-lg p-6 w-full max-w-sm text-center">
        <h2 class="text-lg font-semibold text-green-700 mb-2">Berhasil Upload!</h2>
        <p class="text-sm text-gray-600 mb-4" id="uploadedFileName">Nama file akan ditampilkan di sini.</p>
        <button onclick="closeSuccessModal()" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
          Tutup
        </button>
      </div>
    </div>

    </div>
    </div>
    </div>
    </footer>
    </div>
  </main>

  <!-- -right-90 in loc de 0-->
  <div fixed-plugin-card class="z-sticky backdrop-blur-2xl backdrop-saturate-200 dark:bg-slate-850/80 shadow-3xl w-90 ease -right-90 fixed top-0 left-auto flex h-full min-w-0 flex-col break-words rounded-none border-0 bg-white/80 bg-clip-border px-2.5 duration-200">
    <div class="px-6 pt-4 pb-0 mb-0 border-b-0 rounded-t-2xl">
      <div class="float-left">
        <h5 class="mt-4 mb-0 dark:text-white">Argon Configurator</h5>
        <p class="dark:text-white dark:opacity-80">See our dashboard options.</p>
      </div>
      <div class="float-right mt-6">
        <button fixed-plugin-close-button class="inline-block p-0 mb-4 text-sm font-bold leading-normal text-center uppercase align-middle transition-all ease-in bg-transparent border-0 rounded-lg shadow-none cursor-pointer hover:-translate-y-px tracking-tight-rem bg-150 bg-x-25 active:opacity-85 dark:text-white text-slate-700">
          <i class="fa fa-close"></i>
        </button>
      </div>
      <!-- End Toggle Button -->
    </div>
    <hr class="h-px mx-0 my-1 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent" />
    <div class="flex-auto p-6 pt-0 overflow-auto sm:pt-4">
      <!-- Sidebar Backgrounds -->
      <div>
        <h6 class="mb-0 dark:text-white">Sidebar Colors</h6>
      </div>
      <a href="javascript:void(0)">
        <div class="my-2 text-left" sidenav-colors>
          <span class="py-2.2 text-xs rounded-circle h-5.6 mr-1.25 w-5.6 ease-in-out bg-gradient-to-tl from-blue-500 to-violet-500 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-slate-700 text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700" active-color data-color="blue" onclick="sidebarColor(this)"></span>
          <span class="py-2.2 text-xs rounded-circle h-5.6 mr-1.25 w-5.6 ease-in-out bg-gradient-to-tl from-zinc-800 to-zinc-700 dark:bg-gradient-to-tl dark:from-slate-750 dark:to-gray-850 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700" data-color="gray" onclick="sidebarColor(this)"></span>
          <span class="py-2.2 text-xs rounded-circle h-5.6 mr-1.25 w-5.6 ease-in-out bg-gradient-to-tl from-blue-700 to-cyan-500 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700" data-color="cyan" onclick="sidebarColor(this)"></span>
          <span class="py-2.2 text-xs rounded-circle h-5.6 mr-1.25 w-5.6 ease-in-out bg-gradient-to-tl from-emerald-500 to-teal-400 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700" data-color="emerald" onclick="sidebarColor(this)"></span>
          <span class="py-2.2 text-xs rounded-circle h-5.6 mr-1.25 w-5.6 ease-in-out bg-gradient-to-tl from-orange-500 to-yellow-500 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700" data-color="orange" onclick="sidebarColor(this)"></span>
          <span class="py-2.2 text-xs rounded-circle h-5.6 mr-1.25 w-5.6 ease-in-out bg-gradient-to-tl from-red-600 to-orange-600 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700" data-color="red" onclick="sidebarColor(this)"></span>
        </div>
      </a>
      <!-- Sidenav Type -->
      <div class="mt-4">
        <h6 class="mb-0 dark:text-white">Sidenav Type</h6>
        <p class="text-sm leading-normal dark:text-white dark:opacity-80">Choose between 2 different sidenav types.</p>
      </div>
      <div class="flex">
        <button transparent-style-btn class="inline-block w-full px-4 py-2.5 mb-2 font-bold leading-normal text-center text-white capitalize align-middle transition-all bg-blue-500 border border-transparent border-solid rounded-lg cursor-pointer text-sm xl-max:cursor-not-allowed xl-max:opacity-65 xl-max:pointer-events-none xl-max:bg-gradient-to-tl xl-max:from-blue-500 xl-max:to-violet-500 xl-max:text-white xl-max:border-0 hover:-translate-y-px dark:cursor-not-allowed dark:opacity-65 dark:pointer-events-none dark:bg-gradient-to-tl dark:from-blue-500 dark:to-violet-500 dark:text-white dark:border-0 hover:shadow-xs active:opacity-85 ease-in tracking-tight-rem shadow-md bg-150 bg-x-25 bg-gradient-to-tl from-blue-500 to-violet-500 hover:border-blue-500" data-class="bg-transparent" active-style>White</button>
        <button white-style-btn class="inline-block w-full px-4 py-2.5 mb-2 ml-2 font-bold leading-normal text-center text-blue-500 capitalize align-middle transition-all bg-transparent border border-blue-500 border-solid rounded-lg cursor-pointer text-sm xl-max:cursor-not-allowed xl-max:opacity-65 xl-max:pointer-events-none xl-max:bg-gradient-to-tl xl-max:from-blue-500 xl-max:to-violet-500 xl-max:text-white xl-max:border-0 hover:-translate-y-px dark:cursor-not-allowed dark:opacity-65 dark:pointer-events-none dark:bg-gradient-to-tl dark:from-blue-500 dark:to-violet-500 dark:text-white dark:border-0 hover:shadow-xs active:opacity-85 ease-in tracking-tight-rem shadow-md bg-150 bg-x-25 bg-none hover:border-blue-500" data-class="bg-white">Dark</button>
      </div>
      <p class="block mt-2 text-sm leading-normal dark:text-white dark:opacity-80 xl:hidden">You can change the sidenav type just on desktop view.</p>
      <!-- Navbar Fixed -->
      <div class="flex my-4">
        <h6 class="mb-0 dark:text-white">Navbar Fixed</h6>
        <div class="block pl-0 ml-auto min-h-6">
          <input navbarFixed class="rounded-10 duration-250 ease-in-out after:rounded-circle after:shadow-2xl after:duration-250 checked:after:translate-x-5.3 h-5 relative float-left mt-1 ml-auto w-10 cursor-pointer appearance-none border border-solid border-gray-200 bg-slate-800/10 bg-none bg-contain bg-left bg-no-repeat align-top transition-all after:absolute after:top-px after:h-4 after:w-4 after:translate-x-px after:bg-white after:content-[''] checked:border-blue-500/95 checked:bg-blue-500/95 checked:bg-none checked:bg-right" type="checkbox" />
        </div>
      </div>
      <hr class="h-px my-6 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent " />
      <div class="flex mt-2 mb-12">
        <h6 class="mb-0 dark:text-white">Light / Dark</h6>
        <div class="block pl-0 ml-auto min-h-6">
          <input dark-toggle class="rounded-10 duration-250 ease-in-out after:rounded-circle after:shadow-2xl after:duration-250 checked:after:translate-x-5.3 h-5 relative float-left mt-1 ml-auto w-10 cursor-pointer appearance-none border border-solid border-gray-200 bg-slate-800/10 bg-none bg-contain bg-left bg-no-repeat align-top transition-all after:absolute after:top-px after:h-4 after:w-4 after:translate-x-px after:bg-white after:content-[''] checked:border-blue-500/95 checked:bg-blue-500/95 checked:bg-none checked:bg-right" type="checkbox" />
        </div>
      </div>
      <a target="_blank" class="dark:border dark:border-solid dark:border-white inline-block w-full px-6 py-2.5 mb-4 font-bold leading-normal text-center text-white align-middle transition-all bg-transparent border border-solid border-transparent rounded-lg cursor-pointer text-sm ease-in hover:shadow-xs hover:-translate-y-px active:opacity-85 tracking-tight-rem shadow-md bg-150 bg-x-25 bg-gradient-to-tl from-zinc-800 to-zinc-700 dark:bg-gradient-to-tl dark:from-slate-750 dark:to-gray-850" href="https://www.creative-tim.com/product/argon-dashboard-tailwind">Free Download</a>
      <a target="_blank" class="dark:border dark:border-solid dark:border-white dark:text-white inline-block w-full px-6 py-2.5 mb-4 font-bold leading-normal text-center align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer active:shadow-xs hover:-translate-y-px active:opacity-85 text-sm ease-in tracking-tight-rem bg-150 bg-x-25 border-slate-700 text-slate-700 hover:bg-transparent hover:text-slate-700 hover:shadow-none active:bg-slate-700 active:text-white active:hover:bg-transparent active:hover:text-slate-700 active:hover:shadow-none" href="https://www.creative-tim.com/learning-lab/tailwind/html/quick-start/argon-dashboard/">View documentation</a>
      <div class="w-full text-center">
        <a class="github-button" href="https://github.com/creativetimofficial/argon-dashboard-tailwind" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/argon-dashboard on GitHub">Star</a>
        <h6 class="mt-4 dark:text-white">Thank you for sharing!</h6>
        <a href="https://twitter.com/intent/tweet?text=Check%20Argon%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23tailwindcss&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fargon-dashboard-tailwind" class="inline-block px-5 py-2.5 mb-0 mr-2 font-bold text-center text-white align-middle transition-all border-0  rounded-lg cursor-pointer hover:shadow-xs hover:-translate-y-px active:opacity-85 leading-normal text-sm ease-in tracking-tight-rem shadow-md bg-150 bg-x-25 me-2 border-slate-700 bg-slate-700" target="_blank"> <i class="mr-1 fab fa-twitter"></i> Tweet </a>
        <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/argon-dashboard-tailwind" class="inline-block px-5 py-2.5 mb-0 mr-2 font-bold text-center text-white align-middle transition-all border-0  rounded-lg cursor-pointer hover:shadow-xs hover:-translate-y-px active:opacity-85 leading-normal text-sm ease-in tracking-tight-rem shadow-md bg-150 bg-x-25 me-2 border-slate-700 bg-slate-700" target="_blank"> <i class="mr-1 fab fa-facebook-square"></i> Share </a>
      </div>
    </div>
  </div>
  </div>
</body>
<!-- plugin for scrollbar  -->
<script src="../assets/js/plugins/perfect-scrollbar.min.js" async></script>
<!-- main script file  -->
<script src="../assets/js/argon-dashboard-tailwind.js?v=1.0.1" async></script>

</html>