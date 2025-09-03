<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/png" href=" {{ asset('assets/img/logo-esdm.svg') }} " />
  <title>Beranda Pengguna</title>
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
  <div class="absolute w-full dark:hidden min-h-75" style="background-color: #08A04B;"></div>
  @include('components.sidebar')
 <main id="main-content" class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
 <!-- Navbar -->
    <nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all ease-in shadow-none duration-250 rounded-2xl lg:flex-nowrap lg:justify-start" navbar-main navbar-scroll="false">
      <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
        <nav>
          <!-- breadcrumb -->
          <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
            <li class="text-sm leading-normal">
              <a class="text-white opacity-50" href="javascript:;">Halaman</a>
            </li>
            <li class="text-sm pl-2 capitalize leading-normal text-white before:float-left before:pr-2 before:text-white before:content-['/']" aria-current="page">Beranda</li>
          </ol>
          <h6 class="mb-0 font-bold text-white capitalize">Selamat Datang Pengguna</h6>
        </nav>

        <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
          <div class="flex items-center md:ml-auto md:pr-4">
            <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
              <span class="text-sm ease leading-5.6 absolute z-50 -ml-px flex h-full items-center whitespace-nowrap rounded-lg rounded-tr-none rounded-br-none border border-r-0 border-transparent bg-transparent py-2 px-2.5 text-center font-normal text-slate-500 transition-all">
                
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
            <!-- notifications -->

            <li class="relative flex items-center pr-2">
              <p class="hidden transform-dropdown-show"></p>
              <a href="javascript:;" class="block p-0 text-sm text-white transition-all ease-nav-brand" dropdown-trigger aria-expanded="false">
               
              </a>

              <ul dropdown-menu class="text-sm transform-dropdown before:font-awesome before:leading-default before:duration-350 before:ease lg:shadow-3xl duration-250 min-w-44 before:sm:right-8 before:text-5.5 pointer-events-none absolute right-0 top-0 z-50 origin-top list-none rounded-lg border-0 border-solid border-transparent dark:shadow-dark-xl dark:bg-slate-850 bg-white bg-clip-padding px-2 py-4 text-left text-slate-500 opacity-0 transition-all before:absolute before:right-2 before:left-auto before:top-0 before:z-50 before:inline-block before:font-normal before:text-white before:antialiased before:transition-all before:content-['\f0d8'] sm:-mr-6 lg:absolute lg:right-0 lg:left-auto lg:mt-2 lg:block lg:cursor-pointer">
                <!-- add show class on dropdown open js -->
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- end Navbar -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const toggleButton = document.querySelector('[sidenav-trigger]');
    const sidebar = document.getElementById('sidenav-main');
    const mainContent = document.getElementById('main-content');

    toggleButton.addEventListener('click', function () {
      // Toggle sembunyikan sidebar
      sidebar.classList.toggle('-translate-x-full');
      sidebar.classList.toggle('translate-x-0');

      // Toggle kontainer utama (main-content)
      if (mainContent.classList.contains('xl:ml-68')) {
        mainContent.classList.remove('xl:ml-68');
        mainContent.classList.add('ml-0');
      } else {
        mainContent.classList.remove('ml-0');
        mainContent.classList.add('xl:ml-68');
      }
    });
  });
</script>






    <div class="w-full px-6 py-6 mx-auto">

      <!-- Tempatkan dalam halaman Laravel kamu -->

      <div class="flex flex-wrap mt-0 -mx-3">
        <div class="w-full max-w-full px-3 mt-0 lg:w-full lg:flex-none">
          <div class="border-black/12.5 dark:bg-slate-850 dark:shadow-dark-xl shadow-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">

            <!-- Header -->
            <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid p-6 pt-4 pb-0">
              <h1 class="text-lg mb-4 font-bold text-black capitalize dark:text-white">PROGRES PENGAJUAN</h1>
              <p class="mb-0 text-lg leading-normal dark:text dark:opacity-60">
               
                <!-- <span class="font-semibold">2025</span> -->
              </p>
            </div>

            <!-- STEP PROGRESS -->
            <div class="w-full px-4 py-3">
              <div class="grid grid-cols-2 lg:grid-cols-5 gap-2 text-center text-xs font-medium text-gray-600">

                <!-- Step 1 -->
                <div class="cursor-pointer" onclick="showStep(1)">
                  <div class="relative mb-2 w-10 h-10 mx-auto {{ $currentStep >= 1 ? 'bg-green-500' : 'bg-gray-300' }} text-white rounded-full flex items-center justify-center">
                    {{ $stats['menunggu_evaluasi'] ?? 0 }}
                  </div>
                  <div class="text-xs {{ $currentStep >= 1 ? 'text-green-600' : 'text-gray-500' }} font-semibold mt-1">Laporan Berkala</div>
                </div>

                <!-- Step 2 -->
                <div class="cursor-pointer" onclick="showStep(2)">
                  <div class="relative mb-2 w-10 h-10 mx-auto {{ $currentStep >= 2 ? 'bg-green-500' : 'bg-gray-300' }} text-white rounded-full flex items-center justify-center">
                    {{ $stats['sedang_evaluasi'] ?? 0 }}
                  </div>
                  <div class="text-xs {{ $currentStep >= 2 ? 'text-green-600' : 'text-gray-500' }} font-semibold mt-1">Dievaluasi</div>
                </div>

                <!-- Step 3 -->
                <div class="cursor-pointer" onclick="showStep(3)">
                  <div class="relative mb-2 w-10 h-10 mx-auto {{ $currentStep >= 3 ? 'bg-green-500' : 'bg-gray-300' }} text-white rounded-full flex items-center justify-center">
                    {{ $stats['siap_validasi'] ?? 0 }}
                  </div>
                  <div class="text-xs {{ $currentStep >= 3 ? 'text-green-600' : 'text-gray-500' }} font-semibold mt-1">Diverifikasi</div>
                </div>

                <!-- Step 4 -->
                <div class="cursor-pointer" onclick="showStep(4)">
                  <div class="relative mb-2 w-10 h-10 mx-auto {{ $currentStep >= 4 ? 'bg-green-500' : 'bg-gray-300' }} text-white rounded-full flex items-center justify-center">
                    {{ $stats['dalam_pengesahan'] ?? 0 }}
                  </div>
                  <div class="text-xs {{ $currentStep >= 4 ? 'text-green-600' : 'text-gray-500' }} font-semibold mt-1">Pengesahan</div>
                </div>

                <!-- Step 5 -->
                <div class="cursor-pointer" onclick="showStep(5)">
                  <div class="relative mb-2 w-10 h-10 mx-auto {{ $currentStep >= 5 ? 'bg-green-600' : 'bg-gray-300' }} text-white rounded-full flex items-center justify-center">
                    {{ $stats['selesai'] ?? 0 }}
                  </div>
                  <div class="text-xs {{ $currentStep >= 5 ? 'text-green-600' : 'text-gray-500' }} font-semibold mt-1">Selesai</div>
                </div>
              </div>

              <!-- Konten Surat -->
              <div id="suratContent" class="mt-6 p-4 bg-gray-100 rounded-xl border border-gray-300 text-sm text-gray-700">
                @if($latestPengajuan)
                  <strong>Status Terbaru:</strong> 
                  @switch($latestPengajuan->status)
                    @case('proses evaluasi')
                      Pengajuan Anda sedang menunggu evaluasi. Diajukan pada {{ $latestPengajuan->created_at->format('d M Y') }}.
                      @break
                    @case('evaluasi')
                      Pengajuan Anda sedang dievaluasi oleh {{ $latestPengajuan->evaluator->name ?? 'evaluator' }}.
                      @break
                    @case('validasi')
                      Pengajuan Anda sedang diverifikasi oleh kepala bidang.
                      @break
                    @case('pengesahan')
                      Pengajuan Anda sedang menunggu pengesahan oleh kepala dinas.
                      @break
                    @case('disetujui kadis')
                      Selamat! Pengajuan Anda telah disetujui oleh kepala dinas dan lembar pengesahan siap diunduh.
                      @break
                    @default
                      Status pengajuan Anda: {{ ucfirst($latestPengajuan->status) }}.
                  @endswitch
                @else
                  Anda belum memiliki pengajuan. Silakan buat pengajuan baru.
                @endif
              </div>
            </div>
            
            <!-- Dashboard Cards -->
            <div class="w-full px-6 py-4">
              <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Total Pengajuan -->
                <div class="bg-white dark:bg-slate-850 shadow-xl rounded-2xl p-4 border border-gray-200 dark:border-gray-700">
                  <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 dark:bg-green-900/20">
                      <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                      </svg>
                    </div>
                    <div class="ml-4">
                      <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Pengajuan</p>
                      <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['total_pengajuan'] }}</p>
                    </div>
                  </div>
                </div>
                
                <!-- Dalam Proses -->
                <div class="bg-white dark:bg-slate-850 shadow-xl rounded-2xl p-4 border border-gray-200 dark:border-gray-700">
                  <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 dark:bg-yellow-900/20">
                      <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                      </svg>
                    </div>
                    <div class="ml-4">
                      <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Dalam Proses</p>
                      <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['menunggu_evaluasi'] + $stats['sedang_evaluasi'] + $stats['siap_validasi'] }}</p>
                    </div>
                  </div>
                </div>
                
                <!-- Perlu Perbaikan -->
                <div class="bg-white dark:bg-slate-850 shadow-xl rounded-2xl p-4 border border-gray-200 dark:border-gray-700">
                  <div class="flex items-center">
                    <div class="p-3 rounded-full bg-red-100 dark:bg-red-900/20">
                      <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                      </svg>
                    </div>
                    <div class="ml-4">
                      <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Perlu Perbaikan</p>
                      <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['perlu_perbaikan'] }}</p>
                    </div>
                  </div>
                </div>
                
                <!-- Selesai -->
                <div class="bg-white dark:bg-slate-850 shadow-xl rounded-2xl p-4 border border-gray-200 dark:border-gray-700">
                  <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 dark:bg-green-900/20">
                      <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                      </svg>
                    </div>
                    <div class="ml-4">
                      <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Selesai</p>
                      <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['selesai'] }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Recent Pengajuan -->
            @if($recentPengajuan && $recentPengajuan->count() > 0)
            <div class="w-full px-6 py-4">
              <div class="bg-white dark:bg-slate-850 shadow-xl rounded-2xl border border-gray-200 dark:border-gray-700">
                <div class="p-6 pb-0">
                  <h6 class="text-lg font-bold mb-4 text-gray-800 dark:text-white uppercase">Pengajuan Terbaru</h6>
                </div>
                <div class="p-4 overflow-x-auto">
                  <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-100 dark:bg-slate-700 text-gray-700 dark:text-white/90">
                      <tr>
                        <th class="px-4 py-2 border-b dark:border-gray-600">No. Pengajuan</th>
                        <th class="px-4 py-2 border-b dark:border-gray-600">Tanggal</th>
                        <th class="px-4 py-2 border-b dark:border-gray-600">Status</th>
                        <th class="px-4 py-2 border-b dark:border-gray-600">Evaluator</th>
                      </tr>
                    </thead>
                    <tbody class="text-gray-700 dark:text-white/80">
                      @foreach($recentPengajuan as $pengajuan)
                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-700">
                          <td class="px-4 py-2 border-b dark:border-gray-600">{{ $pengajuan->no_pengajuan ?? 'N/A' }}</td>
                          <td class="px-4 py-2 border-b dark:border-gray-600">{{ $pengajuan->created_at->format('d M Y') }}</td>
                          <td class="px-4 py-2 border-b dark:border-gray-600">
                            <span class="px-2 py-1 text-xs rounded-full
                              @switch($pengajuan->status)
                                @case('proses evaluasi')
                                  bg-yellow-100 text-yellow-800
                                  @break
                                @case('evaluasi')
                                  bg-blue-100 text-blue-800
                                  @break
                                @case('validasi')
                                  bg-purple-100 text-purple-800
                                  @break
                                @case('pengesahan')
                                  bg-green-100 text-green-800
                                  @break
                                @case('disetujui kadis')
                                  bg-green-200 text-green-900
                                  @break
                                @case('perbaikan')
                                  bg-red-100 text-red-800
                                  @break
                                @default
                                  bg-gray-100 text-gray-800
                              @endswitch">
                              {{ ucfirst(str_replace('_', ' ', $pengajuan->status)) }}
                            </span>
                          </td>
                          <td class="px-4 py-2 border-b dark:border-gray-600">{{ $pengajuan->evaluator->name ?? 'Belum ditugaskan' }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            @endif


            <script>
              function showStep(step) {

                const content = document.getElementById('suratContent');

                switch (step) {
                  case 1:
                    content.innerHTML = `<strong>Telah Diajukan:</strong> Laporan berkala telah diajukan. Menunggu dievaluasi.`;
                    break;
                  case 2:
                    content.innerHTML = `<strong>Dievaluasi:</strong> Laporan dalam proses evaluasi oleh petugas evaluator.`;
                    break;
                  case 3:
                    content.innerHTML = `<strong>Diverifikasi:</strong> Laporan dalam proses verifikasi oleh kepala bidang.`;
                    break;
                  case 4:
                    content.innerHTML = `<strong>Pengesahan:</strong> Laporan menunggu pengesahan oleh kepala dinas.`;
                    break;
                  case 5:
                    content.innerHTML = `<strong>Selesai:</strong> Laporan telah disetujui dan lembar pengesahan siap diunduh.`;
                    break;
                  default:
                    content.innerHTML = `Klik salah satu langkah untuk melihat informasi surat.`;
                }
              }

              document.addEventListener("DOMContentLoaded", function() {
                showStep(1);
              });
            </script>

            <div class="w-full max-w-full px-3 lg:w-5/12 lg:flex-none">
              <div slider class="relative w-full h-full overflow-hidden rounded-2xl">
                <!-- Control buttons -->
                <button btn-next class="absolute z-10 w-10 h-10 p-2 text-lg text-white border-none opacity-50 cursor-pointer hover:opacity-100 far fa-chevron-right active:scale-110 top-6 right-4"></button>
                <button btn-prev class="absolute z-10 w-10 h-10 p-2 text-lg text-white border-none opacity-50 cursor-pointer hover:opacity-100 far fa-chevron-left active:scale-110 top-6 right-16"></button>
              </div>
            </div>
          </div>

          <!-- -right-90 in loc de 0-->
          <div fixed-plugin-card class="z-sticky backdrop-blur-2xl backdrop-saturate-200 dark:bg-slate-850/80 shadow-3xl w-90 ease -right-90 fixed top-0 left-auto flex h-full min-w-0 flex-col break-words rounded-none border-0 bg-white/80 bg-clip-border px-2.5 duration-200">
            <div class="px-6 pt-4 pb-0 mb-0 border-b-0 rounded-t-2xl">
       
       
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
<!-- plugin for charts  -->
<script src="../assets/js/plugins/chartjs.min.js" async></script>
<!-- plugin for scrollbar  -->
<script src="../assets/js/plugins/perfect-scrollbar.min.js" async></script>
<!-- main script file  -->
<script src="../assets/js/argon-dashboard-tailwind.js?v=1.0.1" async></script>

</html>