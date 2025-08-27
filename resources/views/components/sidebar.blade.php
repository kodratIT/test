@php
$user = auth()->user();
$isProfileComplete = $user && $user->isProfileComplete();
@endphp

<aside id="sidebar" class="fixed inset-y-0 flex-wrap items-center justify-between block w-full p-0 my-4 overflow-y-auto antialiased transition-transform duration-200 lg:translate-x-0 -translate-x-full bg-white border-0 shadow-xl dark:shadow-none dark:bg-slate-850 max-w-64 ease-nav-brand z-990 lg:ml-6 rounded-2xl lg:left-0" aria-expanded="false">

  <!-- Header Sidebar -->
  <div class="sticky top-0 z-50 bg-white h-19 px-4 flex items-center justify-between shadow-sm">
    <a class="flex items-center py-4 text-lg whitespace-nowrap dark:text-white text-slate-700" href="#">
      <img src="../assets/img/logo-esdm.svg" class="h-8 w-8 max-w-full transition-all duration-200 ease-nav-brand" alt="main_logo" />
      <span class="ml-2 font-semibold leading-tight transition-all duration-200 ease-nav-brand">
        Energi dan Sumber <br> Daya Mineral
      </span>
    </a>
  </div>


  <!-- Tombol close -->
  <i class="xl:hidden fas fa-times absolute top-4 right-4 p-2 text-slate-400 dark:text-white opacity-70 cursor-pointer" sidenav-close></i>

  <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent" />

  <!-- Menu -->
  <div class="items-center block h-auto w-auto max-h-screen overflow-auto h-sidenav grow basis-full">
    <ul class="flex flex-col pl-0 mb-0">

      {{-- Beranda --}}
      <li class="mt-0.5 w-full">
        <a href="{{ $isProfileComplete ? route('berandapengguna') : route('profileidentitas') }}"
          class="py-2.7 text-lg ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors
                  {{ request()->is('berandapengguna') ? 'bg-blue-500/13 rounded-lg font-semibold text-slate-700' : 'dark:text-white dark:opacity-80' }}
                  {{ !$isProfileComplete ? 'pointer-events-none opacity-50 cursor-not-allowed' : '' }}">
          <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
            <i class="relative top-0 text-lg leading-normal ni ni-tv-2 text-blue-500"></i>
          </div>
          <span class="ml-1">Beranda</span>
        </a>
      </li>

      {{-- Buat Laporan Berkala --}}
      <li class="mt-0.5 w-full">
        <a href="{{ $isProfileComplete ? route('laporanberkala') : route('profileidentitas') }}"
          class="py-2.7 text-lg ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors
                  {{ request()->is('laporanberkala') ? 'bg-blue-500/13 rounded-lg font-semibold text-slate-700' : 'dark:text-white dark:opacity-80' }}
                  {{ !$isProfileComplete ? 'pointer-events-none opacity-50 cursor-not-allowed' : '' }}">
          <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
            <i class="relative top-0 text-2xl leading-normal ni ni-fat-add text-cyan-500"></i>
          </div>
          <span class="ml-1">Buat Laporan Berkala</span>
        </a>
      </li>

      {{-- Daftar Laporan Berkala --}}
      <li class="mt-0.5 w-full">
        <a href="{{ $isProfileComplete ? route('daftarpengajuanpengguna') : route('profileidentitas') }}"
          class="py-2.7 text-lg ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors
                  {{ request()->is('daftarpengajuanpengguna') ? 'bg-blue-500/13 rounded-lg font-semibold text-slate-700' : 'dark:text-white dark:opacity-80' }}
                  {{ !$isProfileComplete ? 'pointer-events-none opacity-50 cursor-not-allowed' : '' }}">
          <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
            <i class="relative top-0 text-lg leading-normal ni ni-bullet-list-67 text-orange-500"></i>
          </div>
          <span class="ml-1">Daftar Laporan Berkala</span>
        </a>
      </li>

      {{-- Header Pengaturan --}}
      <li class="w-full mt-4">
        <h6 class="pl-6 ml-2 text-lg font-bold leading-tight uppercase dark:text-white opacity-60">Pengaturan Akun</h6>
      </li>

      {{-- Profil --}}
      <li class="mt-0.5 w-full">
        <a href="{{ route('profileidentitas') }}"
          class="py-2.7 text-lg ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors
           {{ request()->is('profileidentitas') ? 'bg-blue-500/13 rounded-lg font-semibold text-slate-700' : 'dark:text-white dark:opacity-80'}}">
          <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
            <i class="ni ni-single-02 text-sm opacity-75"></i>
          </div>
          <span class="ml-1">Profil</span>
        </a>
      </li>

      {{-- Logout --}}
      <li class="mt-0.5 w-full">
        <a href="{{ route('logout') }}"
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
          class="block w-full text-left py-2.5 text-lg ease-nav-brand flex items-center whitespace-nowrap px-4 transition-colors
            dark:text-white dark:opacity-80 hover:bg-red-50 dark:hover:bg-red-600 rounded-lg">
          <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
            <i class="relative top-0 text-lg leading-normal ni ni-bold-left text-red-500"></i>
          </div>
          <span class="ml-1">Keluar</span>
        </a>
      </li>

      {{-- Form logout tersembunyi, letakkan di luar semua <form> lain (misalnya di paling bawah layout) --}}
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </form>




    </ul>
  </div>
</aside>