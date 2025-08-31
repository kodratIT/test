<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link rel="icon" type="image/png" href=" {{ asset('assets/img/logo-esdm.svg') }} " />
  <title>Detail Pengajuan - {{ $pengajuan->no_pengajuan }}</title>
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
  <div class="absolute w-full bg-blue-500 dark:hidden min-h-75" style="background-color: #08A04B"></div>
  @include('components.sidebar')
  <main id="main-content" class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
    <!-- Navbar -->
    <nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all ease-in shadow-none duration-250 rounded-2xl lg:flex-nowrap lg:justify-start" navbar-main navbar-scroll="false">
      <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
        <nav>
          <!-- breadcrumb -->
          <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
            <li class="text-sm leading-normal">
              <a class="text-white opacity-50" href="{{ route('daftarpengajuanpengguna') }}">Daftar Pengajuan</a>
            </li>
            <li class="text-sm pl-2 capitalize leading-normal text-white before:float-left before:pr-2 before:text-white before:content-['/']" aria-current="page">Detail Pengajuan</li>
          </ol>
          <h6 class="mb-0 font-bold text-white capitalize">Detail Pengajuan</h6>
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
          </ul>
        </div>
      </div>
    </nav>

    <div class="w-full px-6 py-6 mx-auto">
      @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
          {{ session('error') }}
        </div>
      @endif
      
      @if(session('info'))
        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded mb-4">
          {{ session('info') }}
        </div>
      @endif

      <!-- Main Content -->
      <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-full max-w-full px-3">
          <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border border-gray-200 shadow-xl rounded-2xl">
            
            <!-- Header -->
            <div class="p-6 pb-0 mb-0 border-b border-gray-200 rounded-t-2xl">
              <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4">
                <div>
                  <h6 class="leading-normal text-xl font-bold text-gray-700 uppercase mb-2">
                    Detail Pengajuan
                  </h6>
                  <p class="text-sm text-gray-600">Nomor Pengajuan: {{ $pengajuan->no_pengajuan }}</p>
                </div>
                <div class="flex gap-2">
                  @php
                    $status = strtolower(trim($pengajuan->status));
                    $canEdit = !in_array($status, ['disetujui', 'ditolak']);
                  @endphp
                  
                  @if($canEdit)
                    <a href="{{ route('pengajuan.edit', $pengajuan->id) }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-lg transition-colors duration-200 flex items-center">
                      <i class="fas fa-edit mr-2"></i>
                      Edit
                    </a>
                  @endif
                  
                  <a href="{{ route('pengajuan.download', $pengajuan->id) }}" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm rounded-lg transition-colors duration-200 flex items-center">
                    <i class="fas fa-download mr-2"></i>
                    Download
                  </a>
                  
                  <a href="{{ route('daftarpengajuanpengguna') }}" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm rounded-lg transition-colors duration-200 flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                  </a>
                </div>
              </div>
            </div>

            <!-- Content -->
            <div class="flex-auto p-6">
              
              <!-- Status Badge -->
              <div class="mb-6">
                @php
                  $statusMap = [
                    'proses evaluasi' => 'bg-orange-100 text-orange-800 border border-orange-200',
                    'perbaikan' => 'bg-red-100 text-red-800 border border-red-200',
                    'ditolak' => 'bg-red-100 text-red-800 border border-red-200',
                    'disetujui' => 'bg-green-100 text-green-800 border border-green-200',
                    'draft' => 'bg-gray-100 text-gray-800 border border-gray-200'
                  ];
                  $badgeClass = $statusMap[$status] ?? 'bg-gray-100 text-gray-800 border border-gray-200';
                  $statusLabel = ucwords($status);
                @endphp
                
                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium {{ $badgeClass }}">
                  <i class="fas fa-circle mr-2 text-xs"></i>
                  {{ $statusLabel }}
                </span>
                <span class="ml-4 text-gray-500 text-sm">
                  Dibuat: {{ $pengajuan->created_at->format('d M Y H:i') }}
                </span>
                @if($pengajuan->updated_at && $pengajuan->updated_at != $pengajuan->created_at)
                  <span class="ml-4 text-gray-500 text-sm">
                    Diperbarui: {{ $pengajuan->updated_at->format('d M Y H:i') }}
                  </span>
                @endif
              </div>

              <!-- Information Grid -->
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Izin Usaha -->
                <div class="bg-gray-50 p-4 rounded-lg">
                  <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                    <i class="fas fa-building mr-2 text-blue-600"></i>
                    Izin Usaha
                  </h3>
                  <div class="space-y-2">
                    <div class="flex justify-between">
                      <span class="text-gray-600">Nomor:</span>
                      <span class="font-medium">{{ $pengajuan->nomor_izin_usaha ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between">
                      <span class="text-gray-600">Tanggal:</span>
                      <span class="font-medium">
                        {{ $pengajuan->tanggal_izin_usaha ? $pengajuan->tanggal_izin_usaha->format('d M Y') : '-' }}
                      </span>
                    </div>
                    <div class="flex justify-between">
                      <span class="text-gray-600">Masa Berlaku:</span>
                      <span class="font-medium">
                        {{ $pengajuan->masa_berlaku_izin_usaha ? $pengajuan->masa_berlaku_izin_usaha->format('d M Y') : '-' }}
                      </span>
                    </div>
                    @if($pengajuan->lampiran_izin_usaha)
                      <div class="mt-2">
                        <a href="{{ route('lampiran.show', $pengajuan->lampiran_izin_usaha) }}" 
                           class="text-blue-600 hover:text-blue-800 text-sm flex items-center">
                          <i class="fas fa-file-pdf mr-1"></i> Lihat Lampiran
                        </a>
                      </div>
                    @endif
                  </div>
                </div>

                <!-- Izin Lingkungan -->
                <div class="bg-gray-50 p-4 rounded-lg">
                  <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                    <i class="fas fa-leaf mr-2 text-green-600"></i>
                    Izin Lingkungan
                  </h3>
                  <div class="space-y-2">
                    <div class="flex justify-between">
                      <span class="text-gray-600">Jenis:</span>
                      <span class="font-medium">{{ $pengajuan->jenis_izin_lingkungan ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between">
                      <span class="text-gray-600">Nomor:</span>
                      <span class="font-medium">{{ $pengajuan->nomor_izin_lingkungan ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between">
                      <span class="text-gray-600">Tanggal:</span>
                      <span class="font-medium">
                        {{ $pengajuan->tanggal_izin_lingkungan ? $pengajuan->tanggal_izin_lingkungan->format('d M Y') : '-' }}
                      </span>
                    </div>
                    <div class="flex justify-between">
                      <span class="text-gray-600">Masa Berlaku:</span>
                      <span class="font-medium">
                        {{ $pengajuan->masa_berlaku_izin_lingkungan ? $pengajuan->masa_berlaku_izin_lingkungan->format('d M Y') : '-' }}
                      </span>
                    </div>
                    @if($pengajuan->lampiran_izin_lingkungan)
                      <div class="mt-2">
                        <a href="{{ route('lampiran.show', $pengajuan->lampiran_izin_lingkungan) }}" 
                           class="text-blue-600 hover:text-blue-800 text-sm flex items-center">
                          <i class="fas fa-file-pdf mr-1"></i> Lihat Lampiran
                        </a>
                      </div>
                    @endif
                  </div>
                </div>

                <!-- Kapasitas Listrik -->
                <div class="bg-gray-50 p-4 rounded-lg">
                  <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                    <i class="fas fa-bolt mr-2 text-yellow-600"></i>
                    Kapasitas Listrik
                  </h3>
                  <div class="space-y-2">
                    <div class="flex justify-between">
                      <span class="text-gray-600">Kelebihan Listrik:</span>
                      <span class="font-medium">{{ number_format((float)($pengajuan->kelebihan_listrik ?? 0), 2) }} MW</span>
                    </div>
                    <div class="flex justify-between">
                      <span class="text-gray-600">Sambungan:</span>
                      <span class="font-medium">{{ $pengajuan->sambunganListrik ?? '-' }}</span>
                    </div>
                    @if($pengajuan->lampiran_tagihan_listrik)
                      <div class="mt-2">
                        <a href="{{ route('lampiran.show', $pengajuan->lampiran_tagihan_listrik) }}" 
                           class="text-blue-600 hover:text-blue-800 text-sm flex items-center">
                          <i class="fas fa-file-pdf mr-1"></i> Lihat Tagihan Listrik
                        </a>
                      </div>
                    @endif
                  </div>
                </div>

                <!-- Data Teknis -->
                <div class="bg-gray-50 p-4 rounded-lg">
                  <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                    <i class="fas fa-cogs mr-2 text-purple-600"></i>
                    Data Teknis
                  </h3>
                  <div class="space-y-2">
                    @if($pengajuan->slo && is_array($pengajuan->slo) && count($pengajuan->slo) > 0)
                      <div>
                        <span class="text-gray-600 block">SLO:</span>
                        <div class="ml-4 space-y-1">
                          @foreach($pengajuan->slo as $key => $value)
                            <div class="text-sm">
                              <span class="font-medium">{{ ucwords(str_replace('_', ' ', $key)) }}:</span> 
                              @if(is_array($value))
                                {{ implode(', ', $value) }}
                              @else
                                {{ $value ?? '-' }}
                              @endif
                            </div>
                          @endforeach
                        </div>
                      </div>
                    @endif
                    
                    @if($pengajuan->skttk && is_array($pengajuan->skttk) && count($pengajuan->skttk) > 0)
                      <div>
                        <span class="text-gray-600 block">SKTTK:</span>
                        <div class="ml-4 space-y-1">
                          @foreach($pengajuan->skttk as $key => $value)
                            <div class="text-sm">
                              <span class="font-medium">{{ ucwords(str_replace('_', ' ', $key)) }}:</span> 
                              @if(is_array($value))
                                {{ implode(', ', $value) }}
                              @else
                                {{ $value ?? '-' }}
                              @endif
                            </div>
                          @endforeach
                        </div>
                      </div>
                    @endif
                    
                    @if($pengajuan->mesin && is_array($pengajuan->mesin) && count($pengajuan->mesin) > 0)
                      <div>
                        <span class="text-gray-600 block">Data Mesin:</span>
                        <div class="ml-4 space-y-1">
                          @foreach($pengajuan->mesin as $key => $value)
                            <div class="text-sm">
                              <span class="font-medium">{{ ucwords(str_replace('_', ' ', $key)) }}:</span> 
                              @if(is_array($value))
                                {{ implode(', ', $value) }}
                              @else
                                {{ $value ?? '-' }}
                              @endif
                            </div>
                          @endforeach
                        </div>
                      </div>
                    @endif
                    
                    @if($pengajuan->generator && is_array($pengajuan->generator) && count($pengajuan->generator) > 0)
                      <div>
                        <span class="text-gray-600 block">Data Generator:</span>
                        <div class="ml-4 space-y-1">
                          @foreach($pengajuan->generator as $key => $value)
                            <div class="text-sm">
                              <span class="font-medium">{{ ucwords(str_replace('_', ' ', $key)) }}:</span> 
                              @if(is_array($value))
                                {{ implode(', ', $value) }}
                              @else
                                {{ $value ?? '-' }}
                              @endif
                            </div>
                          @endforeach
                        </div>
                      </div>
                    @endif
                  </div>
                </div>

              </div>

              <!-- Lampiran Section -->
              @if($pengajuan->lampiran_slo || $pengajuan->lampiran_skttk || $pengajuan->lampiran_nameplate_mesin || $pengajuan->lampiran_nameplate_generator)
                <div class="mt-6 bg-gray-50 p-4 rounded-lg">
                  <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                    <i class="fas fa-paperclip mr-2 text-gray-600"></i>
                    Lampiran Dokumen
                  </h3>
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    @if($pengajuan->lampiran_slo)
                      <a href="{{ route('lampiran.show', $pengajuan->lampiran_slo) }}" 
                         class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-white transition-colors">
                        <i class="fas fa-file-pdf mr-3 text-red-500"></i>
                        <span class="text-sm">Lampiran SLO</span>
                      </a>
                    @endif
                    
                    @if($pengajuan->lampiran_skttk)
                      <a href="{{ route('lampiran.show', $pengajuan->lampiran_skttk) }}" 
                         class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-white transition-colors">
                        <i class="fas fa-file-pdf mr-3 text-red-500"></i>
                        <span class="text-sm">Lampiran SKTTK</span>
                      </a>
                    @endif
                    
                    @if($pengajuan->lampiran_nameplate_mesin)
                      <a href="{{ route('lampiran.show', $pengajuan->lampiran_nameplate_mesin) }}" 
                         class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-white transition-colors">
                        <i class="fas fa-file-pdf mr-3 text-red-500"></i>
                        <span class="text-sm">Nameplate Mesin</span>
                      </a>
                    @endif
                    
                    @if($pengajuan->lampiran_nameplate_generator)
                      <a href="{{ route('lampiran.show', $pengajuan->lampiran_nameplate_generator) }}" 
                         class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-white transition-colors">
                        <i class="fas fa-file-pdf mr-3 text-red-500"></i>
                        <span class="text-sm">Nameplate Generator</span>
                      </a>
                    @endif
                  </div>
                </div>
              @endif

              <!-- Catatan jika ada -->
              @if($pengajuan->catatan)
                <div class="mt-6 bg-yellow-50 p-4 rounded-lg border border-yellow-200">
                  <h3 class="text-lg font-semibold text-yellow-800 mb-2 flex items-center">
                    <i class="fas fa-sticky-note mr-2"></i>
                    Catatan
                  </h3>
                  <p class="text-yellow-700">{{ $pengajuan->catatan }}</p>
                </div>
              @endif

            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    // Sidebar toggle functionality
    const toggleButton = document.querySelector('[sidenav-trigger]');
    const sidebar = document.getElementById('sidenav-main');
    const mainContent = document.getElementById('main-content');

    if (toggleButton && sidebar && mainContent) {
      toggleButton.addEventListener('click', function () {
        sidebar.classList.toggle('-translate-x-full');
        sidebar.classList.toggle('translate-x-0');

        if (mainContent.classList.contains('xl:ml-68')) {
          mainContent.classList.remove('xl:ml-68');
          mainContent.classList.add('ml-0');
        } else {
          mainContent.classList.remove('ml-0');
          mainContent.classList.add('xl:ml-68');
        }
      });
    }
  });
</script>

</body>
</html>
