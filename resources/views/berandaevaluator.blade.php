<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/png" href=" {{ asset('assets/img/logo-esdm.svg') }} " />
  <title>Dashboard Admin</title>
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
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!-- Main Styling -->
  <link href="{{ asset('assets/css/argon-dashboard-tailwind.css?v=1.0.1') }}" rel="stylesheet" />

</head>

<body class="m-0 font-sans text-base antialiased font-normal dark:bg-slate-900 leading-default bg-gray-50 text-slate-500">
  <div class="absolute w-full bg-yellow-500 dark:hidden min-h-75"></div>
  @include('components.sidebarevaluatorberkala')

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
            <li class="text-sm pl-2 capitalize leading-normal text-white before:float-left before:pr-2 before:text-white before:content-['/']" aria-current="page">Beranda</li>
          </ol>
          <h6 class="mb-0 font-bold text-white capitalize">Selamat Datang Evaluator</h6>
        </nav>

        <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
          <div class="flex items-center md:ml-auto md:pr-4">
            <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
              <span class="text-sm ease leading-5.6 absolute z-50 -ml-px flex h-full items-center whitespace-nowrap rounded-lg rounded-tr-none rounded-br-none border border-r-0 border-transparent bg-transparent py-2 px-2.5 text-center font-normal text-slate-500 transition-all">
                
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
    <!-- Beranda - Semua Aktivitas -->
    <div class="w-full px-4 sm:px-6 lg:px-10 py-5 mx-auto">
      <!-- Grid Cards -->
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

        <!-- Card 1 -->
        <div class="bg-white rounded-3xl shadow-xl p-5 flex justify-between items-start">
          <div>
            <p class="text-m font-semibold uppercase text-gray-600">Laporan Masuk</p>
            <h5 class="text-xl font-bold text-gray-900 mb-1">{{ $stats['laporan_masuk'] }}</h5>
            <p class="text-xs text-gray-500">
              Menunggu: {{ $stats['menunggu_evaluasi'] }} | Dalam Proses: {{ $stats['dalam_evaluasi'] }}
            </p>
           </div>
          <div class="w-14 h-14 flex items-center justify-center rounded-full bg-gradient-to-tl from-blue-500 to-violet-500">
            <i class="ni ni-money-coins text-white text-lg"></i>
          </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white rounded-3xl shadow-xl p-5 flex justify-between items-start">
          <div>
            <p class="text-m font-semibold uppercase text-gray-600">Laporan Selesai</p>
            <h5 class="text-xl font-bold text-gray-900 mb-1">{{ $stats['selesai_evaluasi'] }}</h5>
            <p class="text-xs text-gray-500">
              Sudah diteruskan ke Kabid untuk validasi
            </p>
            </div>
          <div class="w-14 h-14 flex items-center justify-center rounded-full bg-gradient-to-tl from-green-500 to-green-600">
            <i class="ni ni-check-bold text-white text-lg"></i>
          </div>
        </div>
        </div>
        </div>
        </div>

    <!-- Row 2: Grafik Ringkasan dan Daftar Evaluator -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6"></div>
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Row 2: Grafik Ringkasan -->
    <div class="grid grid-cols-1 gap-6">
      <!-- Ringkasan Jumlah Surat Masuk & Selesai -->
      <div class="w-full px-4 sm:px-6 lg:px-10 mb-2 mx-auto">
        <div class="flex flex-col h-full bg-white dark:bg-slate-850 shadow-xl dark:shadow-dark-xl rounded-2xl">
          <div class="p-6 pb-0">
            <h6 class="text-lg font-bold mb-4 text-gray-800 dark:text-white uppercase">Ringkasan Laporan Evaluasi</h6>
            <p class="text-m dark:text-white dark:opacity-60">2025</p>
          </div>
          <div class="p-4 grow flex items-center">
            <canvas id="chart-line-1" height="450" style="width: 100%;"></canvas>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Recent Pengajuan untuk Evaluator -->
    <!-- @if(isset($recentPengajuan) && $recentPengajuan->count() > 0)
    <div class="w-full px-4 sm:px-6 lg:px-10 mb-2 mx-auto">
      <div class="bg-white dark:bg-slate-850 shadow-xl rounded-2xl border border-gray-200 dark:border-gray-700">
        <div class="p-6 pb-0">
          <h6 class="text-lg font-bold mb-4 text-gray-800 dark:text-white uppercase">Pengajuan Terbaru</h6>
        </div>
        <div class="p-4 overflow-x-auto">
          <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-100 dark:bg-slate-700 text-gray-700 dark:text-white/90">
              <tr>
                <th class="px-4 py-2 border-b dark:border-gray-600">No. Pengajuan</th>
                <th class="px-4 py-2 border-b dark:border-gray-600">Perusahaan</th>
                <th class="px-4 py-2 border-b dark:border-gray-600">Tanggal Masuk</th>
                <th class="px-4 py-2 border-b dark:border-gray-600">Status</th>
                <th class="px-4 py-2 border-b dark:border-gray-600">Aksi</th>
              </tr>
            </thead>
            <tbody class="text-gray-700 dark:text-white/80">
              @foreach($recentPengajuan as $pengajuan)
                <tr class="hover:bg-gray-50 dark:hover:bg-slate-700">
                  <td class="px-4 py-2 border-b dark:border-gray-600">{{ $pengajuan->no_pengajuan ?? 'N/A' }}</td>
                  <td class="px-4 py-2 border-b dark:border-gray-600">
                    {{ $pengajuan->pengguna->identitas->namabadanusaha ?? 'N/A' }}
                  </td>
                  <td class="px-4 py-2 border-b dark:border-gray-600">
                    @if($pengajuan->assigned_at)
                      {{ \Carbon\Carbon::parse($pengajuan->assigned_at)->format('d M Y') }}
                    @elseif($pengajuan->created_at)
                      {{ \Carbon\Carbon::parse($pengajuan->created_at)->format('d M Y') }}
                    @else
                      N/A
                    @endif
                  </td>
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
                          bg-green-100 text-green-800
                          @break
                        @case('pengesahan')
                          bg-green-100 text-green-800
                          @break
                        @case('disetujui kadis')
                          bg-green-200 text-green-900
                          @break
                        @default
                          bg-gray-100 text-gray-800
                      @endswitch">
                      {{ ucfirst(str_replace('_', ' ', $pengajuan->status)) }}
                    </span>
                  </td>
                  <td class="px-4 py-2 border-b dark:border-gray-600">
                    @if(in_array($pengajuan->status, ['proses evaluasi', 'evaluasi']))
                      <a href="{{ route('laporan.evaluator.show', $pengajuan->id) }}" 
                         class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                        Evaluasi
                      </a>
                    @else
                      <span class="text-gray-400 text-sm">Selesai</span>
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    @endif -->
    
    <script>
  const ctxLine1 = document.getElementById('chart-line-1').getContext('2d');

  new Chart(ctxLine1, {
    type: 'line',
    data: {
      labels: {!! json_encode($months) !!},
      datasets: [
        {
          label: 'Jumlah Laporan Masuk',
          data: {!! json_encode($chartData['laporan_masuk']) !!},
          borderColor: 'rgba(99, 102, 241, 1)',
          backgroundColor: 'rgba(99, 102, 241, 0.1)',
          fill: true,
          tension: 0.4,
          pointBackgroundColor: 'rgba(99, 102, 241, 1)',
          pointRadius: 4,
        },
        {
          label: 'Jumlah Laporan Selesai',
          data: {!! json_encode($chartData['laporan_selesai']) !!},
          borderColor: 'rgba(34,197,94,1)',
          backgroundColor: 'rgba(34,197,94,0.1)',
          fill: true,
          tension: 0.4,
          pointBackgroundColor: 'rgba(34,197,94,1)',
          pointRadius: 4,
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      animation: false, // Nonaktifkan animasi
      plugins: {
        legend: {
          position: 'top',
          labels: {
            color: '#374151'
          }
        },
        tooltip: {
          mode: 'index',
          intersect: false
        }
      },
      interaction: {
        mode: 'nearest',
        axis: 'x',
        intersect: false
      },
      scales: {
        x: {
          ticks: {
            color: '#6B7280'
          }
        },
        y: {
          beginAtZero: true,
          ticks: {
            color: '#6B7280',
            stepSize: 25
          }
        }
      }
    }
  });
</script>


    <!-- Control buttons -->
    <button btn-next class="absolute z-10 w-10 h-10 p-2 text-lg text-white border-none opacity-50 cursor-pointer hover:opacity-100 far fa-chevron-right active:scale-110 top-6 right-4"></button>
    <button btn-prev class="absolute z-10 w-10 h-10 p-2 text-lg text-white border-none opacity-50 cursor-pointer hover:opacity-100 far fa-chevron-left active:scale-110 top-6 right-16"></button>
    </div>
    </div>
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
<!-- plugin for charts  -->
<script src="../assets/js/plugins/chartjs.min.js" async></script>
<!-- plugin for scrollbar  -->
<script src="../assets/js/plugins/perfect-scrollbar.min.js" async></script>
<!-- main script file  -->
<script src="../assets/js/argon-dashboard-tailwind.js?v=1.0.1" async></script>

</html>