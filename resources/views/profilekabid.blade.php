<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/png" href=" {{ asset('assets/img/logo-esdm.svg') }} " />
  <title>Profile Kepala Bidang</title>
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
  @keyframes slideOutUp {
    0% {
      opacity: 1;
      transform: translateY(0);
    }

    100% {
      opacity: 0;
      transform: translateY(-30px);
    }
  }

  .floating-alert {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
    padding: 15px 20px;
    border-left: 5px solid;
    border-radius: 5px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: opacity 0.5s ease-in-out;
  }

  .floating-alert.success {
    background-color: #d4edda;
    color: #155724;
    border-left-color: #28a745;
  }

  .floating-alert.warning {
    background-color: #f8d7da;
    color: #721c24;
    border-left-color: #f44336;
  }

  .slide-out {
    animation: slideOutUp 0.8s forwards;
  }
</style>

<body
  class="m-0 font-sans antialiased font-normal dark:bg-slate-900 text-base leading-default bg-gray-50 text-slate-500">
  <div
    class="absolute bg-y-50 w-full top-0 bg-[url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/profile-layout-header.jpg')] min-h-75">
    <span class="absolute top-0 left-0 w-full h-full bg-blue-500 opacity-80"></span>
  </div>

  @include('components.sidebarkabidberkala')
  @if (session('alert'))
  <div id="alert" class="floating-alert {{ session('alert.type', 'success') }}">
    {{ session('alert.message') }}
  </div>
  <script>
    setTimeout(() => {
      const el = document.getElementById('alert');
      if (el) el.classList.add('slide-out');
    }, 3000);
    setTimeout(() => {
      const el = document.getElementById('alert');
      if (el) el.remove();
    }, 3800);
  </script>
  @endif

  <div class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68">
    <nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all ease-in shadow-none duration-250 rounded-2xl lg:flex-nowrap lg:justify-start" navbar-main navbar-scroll="false">
      <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
        <nav>
          <!-- breadcrumb -->
          <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
            <li class="text-sm leading-normal">
              <a class="text-white opacity-50" href="javascript:;">Halaman</a>
            </li>
            <li class="text-sm pl-2 capitalize leading-normal text-white before:float-left before:pr-2 before:text-white before:content-['/']" aria-current="page">Profil</li>
          </ol>
          <h6 class="mb-0 font-bold text-white capitalize">Profil Kepala Bidang</h6>
        </nav>

        <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
          <div class="flex items-center md:ml-auto md:pr-4">
            <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
              <span class="text-sm ease leading-5.6 absolute z-50 -ml-px flex h-full items-center whitespace-nowrap rounded-lg rounded-tr-none rounded-br-none border border-r-0 border-transparent bg-transparent py-2 px-2.5 text-center font-normal text-slate-500 transition-all">
                <i class="fas fa-search"></i>
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
                <i fixed-plugin-button-nav class="cursor-pointer fa fa-cog"></i>
                <!-- fixed-plugin-button-nav  -->
              </a>
            </li>

            <!-- notifications -->

            <li class="relative flex items-center pr-2">
              <p class="hidden transform-dropdown-show"></p>
              <a href="javascript:;" class="block p-0 text-sm text-white transition-all ease-nav-brand" dropdown-trigger aria-expanded="false">
                <i class="cursor-pointer fa fa-bell"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="relative w-full mx-auto mt-0">
      <div class="w-full mt-4 p-6 mx-auto">

        <div class="flex flex-wrap -mx-3">
          <div class="w-full px-4 md:w-full">
            <div
              class="relative z-20 flex flex-col min-w-0 break-words bg-white border-0 shadow-2xl shadow-black/20 dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">

              @php
              // Supaya tidak Undefined variable saat debug jika controller belum mengirim (sementara)
              $user = $user ?? Auth::user();
              $identitas = $identitas ?? null;
              $foto = data_get($identitas, 'foto'); // aman meskipun $identitas null
              @endphp


              <form action="{{ route('tim_admin.update') }}" method="POST" enctype="multipart/form-data" class="w-full px-4 py-6 bg-white rounded-xl shadow-md  dark:bg-slate-800">
                @csrf

                <div class="flex flex-wrap -mx-3">
                  <div class="flex-none w-auto max-w-full px-3">
                  </div>
                  <div class="flex items-center justify-end space-x-6 p-4 bg-transparent">
                    <!-- Foto Profil -->
                    <div class="relative w-32 h-32">
                      <!-- Preview Gambar -->

                      <img id="previewFoto"
                        src="{{ $foto ? asset('storage/' . $foto) : asset('assets/img/profil1.jpeg') }}"
                        alt="Foto Profil"
                        class="w-32 h-32 object-cover rounded-full border-2 border-gray-300 shadow-md" />



                      <!-- Input File (disembunyikan) -->
                      <input type="file" name="foto" id="uploadFoto" accept="image/*"
                        class="hidden" onchange="previewGambar(event)">

                      <!-- Tombol Upload -->
                      <label for="uploadFoto"
                        class="absolute bottom-1 right-1 bg-white p-2 rounded-full shadow-md cursor-pointer hover:bg-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700" fill="none" viewBox="0 0 24 24"
                          stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 7h4l2-3h6l2 3h4v13H3V7z" />
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 11a3 3 0 110 6 3 3 0 010-6z" />
                        </svg>
                      </label>
                    </div>

                    <!-- Script Preview -->
                    <script>
                      function previewGambar(event) {
                        const file = event.target.files[0];
                        if (file) {
                          const reader = new FileReader();
                          reader.onload = function(e) {
                            document.getElementById('previewFoto').src = e.target.result;
                          };
                          reader.readAsDataURL(file);
                        }
                      }
                    </script>

                    <!-- Nama dan Jabatan -->
                    <div class="flex flex-col justify-center">
                      <h1 class="text-base font-bold dark:text-white">{{ $identitas->user->name ?? Auth::user()->name ?? '-' }}</h1>
                      <p class="text-sm font-semibold leading-normal dark:text-white dark:opacity-60">{{ $identitas->nip ?? '-' }}</p>
                    </div>
                  </div>
                </div>
                <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                  <div class="flex items-center">

                    <!--  <p class="mb-0 dark:text-white/80">Edit Profil</p>-->
                    <button type="button" onclick="enableReadonlyForm()"
                      class="inline-block px-8 py-2 mb-4 ml-auto font-bold leading-normal text-center text-white align-middle transition-all ease-in 
                  bg-blue-500 border-0 rounded-lg shadow-md cursor-pointer text-m tracking-tight-rem hover:shadow-m 
                  hover:-translate-y-px active:opacity-85">Edit Profil</button>
                  </div>
                </div>

                <div class="max-w-6xl mx-auto">

                  <!-- Bagian: Data Akun -->
                  <div class="mb-6">
                    <p class="text-lg font-bold uppercase dark:text-white dark:opacity-60 mb-4">DATA AKUN</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                      <div>
                        <label for="username" class="block mb-2 text-m font-bold text-slate-700 dark:text-white/80">Nama Pengguna</label>
                        <input type="text" name="name" id="username" data-required value="{{ old('name', $identitas->user->name ?? Auth::user()->name) }}" readonly
                          class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg placeholder:text-gray-500 focus:outline-none focus:border-blue-500 dark:bg-slate-850 dark:text-white" />
                      </div>
                      <div>
                        <label for="email" class="block mb-2 text-m font-bold text-slate-700 dark:text-white/80">Email Pengguna</label>
                        <input type="email" name="email" id="email" data-required value="{{ old('email', $identitas->user->email ?? Auth::user()->email) }}" readonly
                          pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                          title="Masukkan email yang valid (misal: nama@example.com)"
                          placeholder="nama@example.com"
                          class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg placeholder:text-gray-500 focus:outline-none focus:border-blue-500 dark:bg-slate-850 dark:text-white" />
                      </div>

                      <div>
                        <label for="nip" class="block mb-2 text-m font-bold text-slate-700 dark:text-white/80">NIP</label>
                        <input type="text" name="nip" id="nip" data-required maxlength="18" minlength="18" pattern="\d{18}"
                          inputmode="numeric"
                          placeholder="Masukkan 18 digit NIP"
                          value="{{ old('nip', data_get($identitas, 'nip', '')) }}" readonly
                          class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg placeholder:text-gray-500 focus:outline-none focus:border-blue-500 dark:bg-slate-850 dark:text-white" />
                      </div>

                      <div>
                        <label for="pangkat" class="block mb-2 text-m font-bold text-slate-700 dark:text-white/80">
                          Pangkat / Golongan
                        </label>
                        <select name="pangkat" id="pangkat" data-required disabled
                          class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg placeholder:text-gray-500 focus:outline-none focus:border-blue-500 dark:bg-slate-850 dark:text-white">
                          <option value="" disabled selected hidden>-- Pilih Pangkat / Golongan --</option>

                          <!--Golongan I-->
                          <optgroup label="Golongan I">
                            <option value="Juru Muda (I/a)" @selected(old('pangkat', $identitas->pangkat ?? '') == 'Juru Muda (I/a)')>Juru Muda (I/a)</option>
                            <option value="Juru Muda Tingkat I (I/b)" @selected(old('pangkat', $identitas->pangkat ?? '') == 'Juru Muda Tingkat I (I/b)')>Juru Muda Tingkat I (I/b)</option>
                            <option value="Juru (I/c)" @selected(old('pangkat', $identitas->pangkat ?? '') == 'Juru (I/c)')>Juru (I/c)</option>
                            <option value="Juru Tingkat I (I/d)" @selected(old('pangkat', $identitas->pangkat ?? '') == 'Juru Tingkat I (I/d)')>Juru Tingkat I (I/d)</option>
                          </optgroup>

                          <!--Golongan II-->
                          <optgroup label="Golongan II">
                            <option value="Pengatur Muda (II/a)" @selected(old('pangkat', $identitas->pangkat ?? '') == 'Pengatur Muda (II/a)')>Pengatur Muda (II/a)</option>
                            <option value="Pengatur Muda Tingkat I (II/b)" @selected(old('pangkat', $identitas->pangkat ?? '') == 'Pengatur Muda Tingkat I (II/b)')>Pengatur Muda Tingkat I (II/b)</option>
                            <option value="Pengatur (II/c)" @selected(old('pangkat', $identitas->pangkat ?? '') == 'Pengatur (II/c)')>Pengatur (II/c)</option>
                            <option value="Pengatur Tingkat I (II/d)" @selected(old('pangkat', $identitas->pangkat ?? '') == 'Pengatur Tingkat I (II/d)')>Pengatur Tingkat I (II/d)</option>
                          </optgroup>

                          <!--Golongan III-->
                          <optgroup label="Golongan III">
                            <option value="Penata Muda (III/a)" @selected(old('pangkat', $identitas->pangkat ?? '') == 'Penata Muda (III/a)')>Penata Muda (III/a)</option>
                            <option value="Penata Muda Tingkat I (III/b)" @selected(old('pangkat', $identitas->pangkat ?? '') == 'Penata Muda Tingkat I (III/b)')>Penata Muda Tingkat I (III/b)</option>
                            <option value="Penata (III/c)" @selected(old('pangkat', $identitas->pangkat ?? '') == 'Penata (III/c)')>Penata (III/c)</option>
                            <option value="Penata Tingkat I (III/d)" @selected(old('pangkat', $identitas->pangkat ?? '') == 'Penata Tingkat I (III/d)')>Penata Tingkat I (III/d)</option>
                          </optgroup>

                          <!--Golongan IV-->
                          <optgroup label="Golongan IV">
                            <option value="Pembina (IV/a)" @selected(old('pangkat', $identitas->pangkat ?? '') == 'Pembina (IV/a)')>Pembina (IV/a)</option>
                            <option value="Pembina Tingkat I (IV/b)" @selected(old('pangkat', $identitas->pangkat ?? '') == 'Pembina Tingkat I (IV/b)')>Pembina Tingkat I (IV/b)</option>
                            <option value="Pembina Utama Muda (IV/c)" @selected(old('pangkat', $identitas->pangkat ?? '') == 'Pembina Utama Muda (IV/c)')>Pembina Utama Muda (IV/c)</option>
                            <option value="Pembina Utama Madya (IV/d)" @selected(old('pangkat', $identitas->pangkat ?? '') == 'Pembina Utama Madya (IV/d)')>Pembina Utama Madya (IV/d)</option>
                            <option value="Pembina Utama (IV/e)" @selected(old('pangkat', $identitas->pangkat ?? '') == 'Pembina Utama (IV/e)')>Pembina Utama (IV/e)</option>
                          </optgroup>
                        </select>

                        <!-- input hidden agar tetap terkirim saat disabled -->

                      </div>
                      <!-- Tombol Reset & Simpan: sejajar di sebelah kiri -->
                      <div class="mt-6 flex gap-4">
                        <button type="button"
                          class="px-6 py-3 text-sm font-bold text-white bg-red-400 rounded-lg hover:bg-red-500 transition-all">
                          Reset Password
                        </button>
                        <button type="submit"
                          class="px-6 py-3 text-sm font-bold text-white bg-blue-500 rounded-lg hover:bg-blue-600 transition-all">
                          Simpan
                        </button>
                      </div>
                    </div>
                  </div>
              </form>
</body>
<script>
  function enableReadonlyForm() {

    const inputs = document.querySelectorAll('input, select');
    inputs.forEach(input => {

      //if (input.id === 'email') return;

      if (input.hasAttribute('readonly') || input.hasAttribute('disabled')) {
        input.removeAttribute('readonly');
        input.removeAttribute('disabled');
        input.classList.remove('cursor-not-allowed', 'bg-gray-100');
      }
    });

    // Sinkronisasi select pangkat dengan hidden input
    const select = document.getElementById('pangkat');
    const hidden = document.getElementById('pangkat_hidden');

    select.addEventListener('change', function() {
      hidden.value = this.value;
    });

  }

  function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        const preview = document.getElementById('previewFoto');
        preview.src = e.target.result;
      };
      reader.readAsDataURL(file);
    }
  }
</script>
<!-- plugin for scrollbar  -->
<script src="../assets/js/plugins/perfect-scrollbar.min.js" async></script>
<!-- main script file  -->
<script src="../assets/js/argon-dashboard-tailwind.js?v=1.0.1" async></script>

</html>