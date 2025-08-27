<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/png" href=" {{ asset('assets/img/logo-esdm.svg') }} " />
  <title>Profile Perusahaan</title>
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
  <style>
    input[readonly] {
      background-color: #f1f5f9 !important;
      color: #9ca3af !important;
      cursor: not-allowed;
    }
  </style>
</head>

<body
  class="m-0 font-sans antialiased font-normal dark:bg-slate-900 text-base leading-default bg-gray-50 text-slate-500">
  <div
    class="absolute bg-y-50 w-full top-0 bg-[url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/profile-layout-header.jpg')] min-h-75">
    <span class="absolute top-0 left-0 w-full h-full" style="background-color: #08A04B; opacity:0.8;"></span>
  </div>

  @include('components.sidebar')

  <div class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68">
    <nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all ease-in shadow-none duration-250 rounded-2xl lg:flex-nowrap lg:justify-start" navbar-main navbar-scroll="false">
      <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
        <nav>
          <!-- breadcrumb -->
          <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
            <li class="text-sm leading-normal">
              <a class="text-white opacity-50" href="javascript:;">Halaman</a>
            </li>
            <li class="text-sm pl-2 capitalize leading-normal text-white before:float-left before:pr-2 before:text-white before:content-['/']" aria-current="page">Profil Badan Usaha</li>
          </ol>
          <h6 class="mb-0 font-bold text-white capitalize">Profil Badan Usaha</h6>
        </nav>

        <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
          <div class="flex items-center md:ml-auto md:pr-4">
            <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
              <span class="text-sm ease leading-5.6 absolute z-50 -ml-px flex h-full items-center whitespace-nowrap rounded-lg rounded-tr-none rounded-br-none border border-r-0 border-transparent bg-transparent py-2 px-2.5 text-center font-normal text-slate-500 transition-all">

              </span>
              <!--<input type="text" class="pl-9 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 dark:bg-slate-850 dark:text-white bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" placeholder="Type here..." />
                nama' => 'required|string|max:255',
        'nama_perusahaan' => 'required|string|max:255',
        'email_perusahaan' => 'required|email',
        'penanggung_jawab' => 'required|string',
        'kode_kbli' => 'required|string',
        'judul_kbli' => 'required|string',
        'nomorhp' => 'required|string',
        'alamatusaha' => 'required|string',
        'nomor_induk_berusaha' => 'required|string',
        'nomor_pokok_wajib_pajak'
             
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
            </li>
          </ul>
        </div>
      </div>
    </nav>


    <div class="relative w-full mx-auto pt-0 ">

    </div>

    <div class="w-full p-6 mx-auto">
      <div class="flex flex-wrap -mx-3">
        <div class="w-full px-4 md:w-full">
          <div
            class="relative z-20 flex flex-col min-w-0 break-words bg-white border-0 shadow-2xl shadow-black/20 dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
              <div class="flex items-center">
                <!--  <p class="mb-0 dark:text-white/80">Edit Profil</p>-->
                <button type="button" id="editBtn"
                  class="inline-block px-8 py-2 mb-4 ml-auto font-bold leading-normal text-center text-white align-middle transition-all ease-in bg-blue-500 border-0 rounded-lg shadow-md cursor-pointer text-m tracking-tight-rem hover:shadow-m hover:-translate-y-px active:opacity-85">Edit Profil</button>
              </div>
            </div>
            @php
            $alertType = session('success') ? 'success' : (session('warning') ? 'warning' : null);
            $message = session('success') ?? session('warning');
            @endphp

            @if($alertType)
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

            <div id="alert" class="floating-alert {{ $alertType }}">
              {{ $message }}
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

            @php
            // Jika sudah ada data identitas, maka field form di-readonly
            $disabled = isset($identitas) ? 'readonly' : '';
            @endphp

            <form id="profileForm" action="{{ route('profile.simpan') }}" method="POST" class="w-full px-4 py-6 bg-white rounded-xl shadow-md  dark:bg-slate-800">
              @csrf
              <div class="max-w-6xl mx-auto">
                <!-- Bagian: Data Akun -->
                <div class="mb-6">
                  <p class="text-lg font-bold uppercase dark:text-white dark:opacity-60 mb-4">DATA AKUN</p>
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                      <label for="username" class="block mb-2 text-m font-bold text-slate-700 dark:text-white/80">Nama Pengguna</label>
                      <input type="text" name="nama" id="nama" required
                        class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg placeholder:text-gray-500 focus:outline-none focus:border-blue-500 dark:bg-slate-850 dark:text-white"
                        value="{{ old('username', $identitas->nama ?? Auth::user()->name ?? '') }}" {{$disabled}} />
                    </div>
                    <div>
                      <label for="email" class="block mb-2 text-m font-bold text-slate-700 dark:text-white/80">Email Pengguna</label>
                      <input
                        type="email"
                        name="email"
                        id="emailakun"
                        required
                        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                        title="Masukkan email yang valid, contoh: nama@email.com"
                        class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg placeholder:text-gray-500 focus:outline-none focus:border-blue-500 dark:bg-slate-850 dark:text-white"
                        placeholder="nama@email.com"
                        value="{{ old('email', $identitas->email ?? Auth::user()->email ?? '') }}" {{$disabled}} />
                    </div>
                    @if (session('error'))
                    <div class="p-3 mb-4 bg-red-100 text-red-700 rounded">
                      {{ session('error') }}
                    </div>
                    @endif

                  </div>

                  <div class="mt-2">
                    <button type="button" onclick="toggleModal()"
                      class="px-2 py-2 text-xs font-semibold text-white bg-red-400 rounded-lg hover:bg-red-500 transition-colors duration-200">
                      Ganti Kata Sandi
                    </button>
                  </div>
                </div>
              </div>

              <!-- Separator -->


              <hr class="h-px mb-2 bg-transparent border-0 opacity-25 bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent" />


              <!-- Bagian: Profil Perusahaan -->


              <div class="mb-6">
                <p class="text-lg font-bold uppercase dark:text-white dark:opacity-60 mb-4">DATA PEMILIK</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                  <div>
                    <label for="namabadanusaha" class="block mb-2 text-m font-bold text-slate-700 dark:text-white/80">Nama Badan Usaha</label>
                    <input type="text" name="namabadanusaha" id="namabadanusaha" required
                      class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg placeholder:text-gray-500 focus:outline-none focus:border-blue-500 dark:bg-slate-850 dark:text-white"
                      value="{{ old('namabadanusaha', $identitas->namabadanusaha ?? '') }}" {{$disabled}} />
                  </div>

                

                  <div>
                    <label for="nib" class="block mb-2 text-m font-bold text-slate-700 dark:text-white/80">NIB</label>
                    <input
                      type="text"
                      name="nib"
                      id="nib"
                      required
                      pattern="[0-9]{13}"
                      minlength="13"
                      maxlength="13"
                      title="NIB harus terdiri dari 13 digit angka"
                      value="{{ old('nib', $identitas->nib ?? '') }}" {{$disabled}}
                      class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg placeholder:text-gray-500 focus:outline-none focus:border-blue-500 dark:bg-slate-850 dark:text-white" />
                  </div>


                  <div>
                    <label for="email_perusahaan" class="block mb-2 text-m font-bold text-slate-700 dark:text-white/80">Email Perusahaan</label>
                    <input type="email" name="email_perusahaan" id="email_perusahaan" required
                      value="{{ old('email_perusahaan', $identitas->email_perusahaan ?? '') }}" {{$disabled}}
                      class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg placeholder:text-gray-500 focus:outline-none focus:border-blue-500 dark:bg-slate-850 dark:text-white" />
                  </div>
                  <div>
                    <label for="notelpkantorpusat" class="block mb-2 text-m font-bold text-slate-700 dark:text-white/80">No. Telepon Kantor Pusat</label>
                    <input type="text" name="notelpkantorpusat" id="notelpkantorpusat" required
                      value="{{ old('notelpkantorpusat', $identitas->notelpkantorpusat ?? '') }}" {{$disabled}}
                      class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg placeholder:text-gray-500 focus:outline-none focus:border-blue-500 dark:bg-slate-850 dark:text-white" />
                  </div>

                </div>
                <div>
                  <label for="alamatkantorpusat" class="block my-4 text-m font-bold text-slate-700 dark:text-white/80">Alamat Kantor Pusat</label>
                  <input type="text" name="alamatkantorpusat" id="alamatkantorpusat" required
                    value="{{ old('alamatkantorpusat', $identitas->alamatkantorpusat ?? '') }}" {{$disabled}}
                    class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg placeholder:text-gray-500 focus:outline-none focus:border-blue-500 dark:bg-slate-850 dark:text-white" />
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div>
                    <label for="alamatkantorcabang" class="block my-4 text-m font-bold text-slate-700 dark:text-white/80">Alamat Kantor Cabang (jika ada)</label>
                    <input type="text" name="alamatkantorcabang" id="alamatkantorcabang"
                      value="{{ old('alamatkantorcabang', $identitas->alamatkantorcabang ?? '') }}" {{$disabled}}
                      class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg placeholder:text-gray-500 focus:outline-none focus:border-blue-500 dark:bg-slate-850 dark:text-white" />
                  </div>

                  <div>
                    <label for="notelpkantorcabang" class="block my-4 text-m font-bold text-slate-700 dark:text-white/80">No. Telepon Kantor Cabang (jika ada)</label>
                    <input type="text" name="notelpkantorcabang" id="notelpkantorcabang"
                      value="{{ old('notelpkantorcabang', $identitas->notelpkantorcabang ?? '') }}" {{$disabled}}
                      class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg placeholder:text-gray-500 focus:outline-none focus:border-blue-500 dark:bg-slate-850 dark:text-white" />
                  </div>
                </div>
              </div>

              <div>
                <p class="text-lg font-bold uppercase dark:text-white dark:opacity-60 mb-4">Kontak Person</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div>
                    <label for="contact_person_nama" class="block mb-2 text-m font-bold text-slate-700 dark:text-white/80">Nama</label>
                    <input type="text" name="contact_person_nama" id="contact_person_nama" required
                      value="{{ old('contact_person_nama', $identitas->contact_person_nama ?? '') }}" {{$disabled}}
                      class="w-full px-3 py-2 mb-4 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg placeholder:text-gray-500 focus:outline-none focus:border-blue-500 dark:bg-slate-850 dark:text-white" />
                  </div>
                  <div>
                    <label for="contact_person_jabatan" class="block mb-2 text-m font-bold text-slate-700 dark:text-white/80">Jabatan</label>
                    <input type="text" name="contact_person_jabatan" id="contact_person_jabatan" required
                      value="{{ old('contact_person_jabatan', $identitas->contact_person_jabatan ?? '') }}" {{$disabled}}
                      class="w-full px-3 py-2 mb-4 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg placeholder:text-gray-500 focus:outline-none focus:border-blue-500 dark:bg-slate-850 dark:text-white" />
                  </div>
                  <div>
                    <label for="contact_person_email" class="block mb-2 text-m font-bold text-slate-700 dark:text-white/80">Email</label>
                    <input type="email" name="contact_person_email" id="contact_person_email" required
                      value="{{ old('contact_person_email', $identitas->contact_person_email ?? '') }}" {{$disabled}}
                      class="w-full px-3 py-2 mb-4 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg placeholder:text-gray-500 focus:outline-none focus:border-blue-500 dark:bg-slate-850 dark:text-white" />
                  </div>
                  <div>
                    <label for="contact_person_no_telp" class="block mb-2 text-m font-bold text-slate-700 dark:text-white/80">No. Telepon</label>
                    <input type="text" name="contact_person_no_telp" id="contact_person_no_telp" required
                      value="{{ old('contact_person_no_telp', $identitas->contact_person_no_telp ?? '') }}" {{$disabled}}
                      class="w-full px-3 py-2 mb-4 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg placeholder:text-gray-500 focus:outline-none focus:border-blue-500 dark:bg-slate-850 dark:text-white" />
                  </div>
                </div>
                <div class="mt-6">
                  <button type="submit" id="saveBtn"
                    class="w-full md:w-auto px-6 py-3 text-sm font-bold text-white bg-blue-500 rounded-lg hover:bg-blue-600 transition-all">
                    Simpan
                  </button>
                </div>
            </form>


            <div id="resetModal" class="hidden fixed inset-0 z-[9999] bg-black/60 flex items-center justify-center">
              <div class="bg-white p-6 rounded-lg shadow-lg w-80 text-center">
                <h2 class="text-lg font-semibold mb-4">Kirim Link Reset menggunakan?</h2>
                <button onclick="sendReset('personal')" class="w-full mb-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                  Email Personal
                </button>
                <button onclick="sendReset('perusahaan')" class="w-full mb-4 px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                  Email Perusahaan
                </button>
                <button onclick="toggleModal()" class="text-gray-500 text-sm hover:underline">Batal</button>
              </div>
</body>


<script>
  document.addEventListener('DOMContentLoaded', function() {
    const editBtn = document.getElementById('editBtn');
    const saveBtn = document.getElementById('saveBtn');
    const form = document.getElementById('profileForm');
    const inputs = form.querySelectorAll('input, select, textarea');

    editBtn.addEventListener('click', function() {
      inputs.forEach(input => {
        if (input.id !== 'emailakun') {
          input.removeAttribute('readonly');
        }
      });
      editBtn.classList.add('hidden');
      saveBtn.classList.remove('hidden');
    });
  });

  function toggleModal() {
    const modal = document.getElementById('resetModal');
    modal.classList.toggle('hidden');
  }

  function sendReset(type) {
    toggleModal(); // Tutup modal dulu
    if (type === 'personal') {
      alert('Link reset dikirim ke email personal!');
      // TODO: Panggil route atau AJAX ke backend (jika pakai Laravel, misalnya pakai fetch())
    } else if (type === 'perusahaan') {
      alert('Link reset dikirim ke email perusahaan!');
      // TODO: Panggil route atau AJAX ke backend juga
    }
  }
</script>
<!-- plugin for scrollbar  -->
<script src="../assets/js/plugins/perfect-scrollbar.min.js" async></script>
<!-- main script file  -->
<script src="../assets/js/argon-dashboard-tailwind.js?v=1.0.1" async></script>

</html>