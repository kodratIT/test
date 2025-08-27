<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/png" href=" {{ asset('assets/img/logo-esdm.svg') }} " />
  <title>Kelola Badan Usaha</title>
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
  <div class="absolute w-full bg-blue-400 dark:hidden min-h-75" ></div>
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
            <li class="text-sm pl-2 capitalize leading-normal text-white before:float-left before:pr-2 before:text-white before:content-['/']" aria-current="page">Kelola Badan Usaha</li>
          </ol>
          <h6 class="mb-0 font-bold text-white capitalize">Kelola Badan Usaha</h6>
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
                <!-- add show class on dropdown open js -->
                <li class="relative mb-2">
                  <a class="dark:hover:bg-slate-900 ease py-1.2 clear-both block w-full whitespace-nowrap rounded-lg bg-transparent px-4 duration-300 hover:bg-gray-200 hover:text-slate-700 lg:transition-colors" href="javascript:;">
                    <div class="flex py-1">
                      <div class="my-auto">
                        <img src="../assets/img/team-2.jpg" class="inline-flex items-center justify-center mr-4 text-sm text-white h-9 w-9 max-w-none rounded-xl" />
                      </div>
                      <div class="flex flex-col justify-center">
                        <h6 class="mb-1 text-sm font-normal leading-normal dark:text-white"><span class="font-semibold">New message</span> from Laur</h6>
                        <p class="mb-0 text-xs leading-tight text-slate-400 dark:text-white/80">
                          <i class="mr-1 fa fa-clock"></i>
                          13 minutes ago
                        </p>
                      </div>
                    </div>
                  </a>
                </li>

                <li class="relative mb-2">
                  <a class="dark:hover:bg-slate-900 ease py-1.2 clear-both block w-full whitespace-nowrap rounded-lg px-4 transition-colors duration-300 hover:bg-gray-200 hover:text-slate-700" href="javascript:;">
                    <div class="flex py-1">
                      <div class="my-auto">
                        <img src="../assets/img/small-logos/logo-spotify.svg" class="inline-flex items-center justify-center mr-4 text-sm text-white bg-gradient-to-tl from-zinc-800 to-zinc-700 dark:bg-gradient-to-tl dark:from-slate-750 dark:to-gray-850 h-9 w-9 max-w-none rounded-xl" />
                      </div>
                      <div class="flex flex-col justify-center">
                        <h6 class="mb-1 text-sm font-normal leading-normal dark:text-white"><span class="font-semibold">New album</span> by Travis Scott</h6>
                        <p class="mb-0 text-xs leading-tight text-slate-400 dark:text-white/80">
                          <i class="mr-1 fa fa-clock"></i>
                          1 day
                        </p>
                      </div>
                    </div>
                  </a>
                </li>

                <li class="relative">
                  <a class="dark:hover:bg-slate-900 ease py-1.2 clear-both block w-full whitespace-nowrap rounded-lg px-4 transition-colors duration-300 hover:bg-gray-200 hover:text-slate-700" href="javascript:;">
                    <div class="flex py-1">
                      <div class="inline-flex items-center justify-center my-auto mr-4 text-sm text-white transition-all duration-200 ease-nav-brand bg-gradient-to-tl from-slate-600 to-slate-300 h-9 w-9 rounded-xl">
                        <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <title>credit-card</title>
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                              <g transform="translate(1716.000000, 291.000000)">
                                <g transform="translate(453.000000, 454.000000)">
                                  <path class="color-background" d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z" opacity="0.593633743"></path>
                                  <path class="color-background" d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z"></path>
                                </g>
                              </g>
                            </g>
                          </g>
                        </svg>
                      </div>
                      <div class="flex flex-col justify-center">
                        <h6 class="mb-1 text-sm font-normal leading-normal dark:text-white">Payment successfully completed</h6>
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
  <div class="max-w-7xl mx-auto p-6">
    <div class="overflow-x-auto bg-white shadow-lg rounded-xl p-4">
      <table class="min-w-full table-auto">
        <thead class="bg-blue-400 text-white">
          <tr>
            <th class="py-3 text-left text-sm px-4">No</th>
            <th class="py-3 px-4 text-sm text-left">Badan Usaha</th>
            <th class="py-3 px-4 text-sm text-left">Nama Pengguna</th>
            <th class="py-3 px-4 text-sm text-left">Email </th>
            <th class="py-3 px-4 text-sm text-left">Peran</th>
            <th class="py-3 px-4 text-sm text-center">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
        
        @foreach($penggunas as $index => $pengguna)
        <tr class="hover:bg-blue-50">
        <td class="py-3 px-4 text-xs">{{ $index + 1 }}</td>
            <td class="py-3 px-4 text-xs font-medium">{{ $pengguna->identitasPengguna->namabadanusaha ?? '-' }}
            <td class="py-3 px-4 text-xs font-medium">{{ $pengguna->name }}</td>
            <td class="py-3 px-4 text-xs font-medium">{{ $pengguna->email }}</td>
            <td class="py-3 px-4 text-xs font-medium">{{ $pengguna->role_pengguna }}</td>
          <td class="py-3 px-4 text-center">
          <form action="{{ route('pengguna.destroy', $pengguna->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
              @method('DELETE')
              <button type="submit"
              class="bg-red-600 hover:bg-red-700 text-white text-xs font-semibold px-4 py-2 rounded-lg transition">
              Hapus
            </button>
            </form>
          </td>
        </tr>
        @endforeach

<!-- Modal Konfirmasi -->
<div id="popup-konfirmasi-hapus-evaluator1" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
            <div class="bg-white rounded-lg p-6 w-80 shadow-lg text-center">
              <h2 class="text-lg font-semibold mb-4">Konfirmasi Hapus</h2>
              <p class="text-sm text-gray-700 mb-6">Apakah Anda yakin ingin menghapus badan usaha ini?</p>
              <div class="flex justify-center gap-4">
                <button onclick="hapusPengguna()" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">Hapus</button>
                <button onclick="tutupPopupHapus()" class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded">Batal</button>
              </div>
            </div>
          </div>

  <script>
  let nomor = 1;
  let barisYangAkanDihapus = null;

  function openTambahEvaluatorModal() {
    document.getElementById("modalTambahEvaluator").classList.remove("hidden");
    document.getElementById("modalTambahEvaluator").classList.add("flex");
  }

  function closeTambahEvaluatorModal() {
    document.getElementById("modalTambahEvaluator").classList.remove("flex");
    document.getElementById("modalTambahEvaluator").classList.add("hidden");
    document.getElementById("formEvaluator").reset();
  }

  function bukaPopupHapus(button) {
    barisYangAkanDihapus = button.closest('tr');
    document.getElementById('popup-konfirmasi-hapus').classList.remove('hidden');
  }

  function tutupPopupHapus() {
    barisYangAkanDihapus = null;
    document.getElementById('popup-konfirmasi-hapus').classList.add('hidden');
  }

  function hapusEvaluator() {
    if (barisYangAkanDihapus) {
      barisYangAkanDihapus.remove();
    }
    tutupPopupHapus();
  }

  function submitFormEvaluator(event) {
    event.preventDefault();

    const name = document.getElementById("name").value;
    const pangkat = document.getElementById("pangkat").value;
    const email = document.getElementById("email").value;

    const tbody = document.querySelector("table tbody");
    const tr = document.createElement("tr");

    tr.innerHTML = `
      <td class="py-3 px-4 text-xs">${nomor}</td>
      <td class="py-3 px-4 text-xs font-medium">${name}</td>
      <td class="py-3 px-4 text-xs text-center">
        <span class="inline-block px-2 py-1 text-xs text-xs rounded">${pangkat}</span>
      </td>
      <td class="py-3 px-4 text-xs text-center">${email}</td>
      <td class="py-3 px-4 text-xs font-medium text-center">Evaluator</td>
      <td class="py-3 px-4 text-center">
        <button onclick="bukaPopupHapus(this)" class="bg-green-600 hover:bg-green-700 text-white text-xs font-semibold px-4 py-2 rounded-lg transition">
          Hapus
        </button>
      </td>
    `;

    tbody.appendChild(tr);
    nomor++;
    closeTambahEvaluatorModal();
  }
</script>

        <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold text-gray-700">Kelola Badan Usaha</h2>
        <!-- <!-- Contoh Baris 1 
        <tr class="hover:bg-blue-50">
            <td class="py-3 px-4 text-xs">1</td>
            <td class="py-3 px-4 text-xs text-left" id="badanusaha_1">PT. Jaya Kusuma</td>
            <td class="py-3 px-4 text-xs font-medium text-left" id="namapengguna_1">Budi Santoso,S.T</td>
            <td class="py-3 px-4 text-xs text-left">budi.santoso@email.com</td> <!-- Email ditambahkan 
            <td class="py-3 px-4 text-xs font-medium text-center" id="peran_1">Pengguna</td>
            </td>
            <td class="py-3 px-4 text-center">
            <button onclick="simpanPerubahan(1)" class="bg-green-600 hover:bg-green-700 text-white text-xs font-semibold px-4 py-2 rounded-lg transition">Hapus</button>
            <div id="popupBerhasil_1" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
                <div class="bg-white rounded-xl shadow-xl p-6 w-96 text-center">
                <h2 class="text-lg font-semibold text-green-700 mb-2">✅ Perubahan Disimpan</h2>
                <p id="pesan_1" class="text-sm text-gray-600 mb-4"></p>
                <button onclick="tutupPopup(1)" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">OK</button>
                </div>
            </div>
            </td>
            </tr>

        <!-- Contoh Baris 2 
        <tr class="hover:bg-blue-50">
            <td class="py-3 px-4 text-xs">2</td>
            <td class="py-3 px-4 text-xs text-left" id="badanusaha_2">PT. SAL 1</td>
            <td class="py-3 px-4 text-xs font-medium text-left" id="namapengguna_2">Suherman,S.T.</td>
            <td class="py-3 px-4 text-xs text-left">suhe@gmail.com</td> <!-- Email ditambahkan 
            <td class="py-3 px-4 text-xs font-medium text-center" id="peran_2">Pengguna</td>
            </td>
            <td class="py-3 px-4 text-center">
            <button onclick="simpanPerubahan(3)" class="bg-green-600 hover:bg-green-700 text-white text-xs font-semibold px-4 py-2 rounded-lg transition">Hapus</button>
            <div id="popupBerhasil_3" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
                <div class="bg-white rounded-xl shadow-xl p-6 w-96 text-center">
                <h2 class="text-lg font-semibold text-green-700 mb-2">✅ Perubahan Disimpan</h2>
                <p id="pesan_3" class="text-sm text-gray-600 mb-4"></p>
                <button onclick="tutupPopup(3)" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">OK</button>
                </div>
            </div>
            </td>
            </tr>

         <!-- Contoh Baris 3
         <tr class="hover:bg-blue-50">
            <td class="py-3 px-4 text-xs">3</td>
            <td class="py-3 px-4 text-xs text-left" id="badanusaha_3">PT. Jaya Ningrum</td>
            <td class="py-3 px-4 text-xs font-medium text-left" id="namapengguna_3">Evawati,S.T</td>
            <td class="py-3 px-4 text-xs text-left">wati@gmail.com</td> <!-- Email ditambahkan 
            <td class="py-3 px-4 text-xs font-medium text-center" id="peran_3">Pengguna</td>
            </td>
            <td class="py-3 px-4 text-center">
            <button onclick="simpanPerubahan(3)" class="bg-green-600 hover:bg-green-700 text-white text-xs font-semibold px-4 py-2 rounded-lg transition">Hapus</button>
            <div id="popupBerhasil_3" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
                <div class="bg-white rounded-xl shadow-xl p-6 w-96 text-center">
                <h2 class="text-lg font-semibold text-green-700 mb-2">✅ Perubahan Disimpan</h2>
                <p id="pesan_3" class="text-sm text-gray-600 mb-4"></p>
                <button onclick="tutupPopup(3)" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">OK</button>
                </div>
            </div>-->
            </td>
            </tr>
        </tbody>
      </table>
    </div>
  </div>

</body>
</html>