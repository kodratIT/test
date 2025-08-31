<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link rel="icon" type="image/png" href=" {{ asset('assets/img/logo-esdm.svg') }} " />
  <title>Edit Pengajuan - {{ $pengajuan->no_pengajuan }}</title>
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
            <li class="text-sm pl-2 capitalize leading-normal text-white before:float-left before:pr-2 before:text-white before:content-['/']" aria-current="page">Edit Pengajuan</li>
          </ol>
          <h6 class="mb-0 font-bold text-white capitalize">Edit Pengajuan</h6>
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

      <!-- Main Content -->
      <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-full max-w-full px-3">
          <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border border-gray-200 shadow-xl rounded-2xl">
            
            <!-- Header -->
            <div class="p-6 pb-0 mb-0 border-b border-gray-200 rounded-t-2xl">
              <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4">
                <div>
                  <h6 class="leading-normal text-xl font-bold text-gray-700 uppercase mb-2">
                    Edit Pengajuan
                  </h6>
                  <p class="text-sm text-gray-600">Nomor Pengajuan: {{ $pengajuan->no_pengajuan }}</p>
                </div>
                <div class="flex gap-2">
                  <a href="{{ route('pengajuan.detail', $pengajuan->id) }}" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm rounded-lg transition-colors duration-200 flex items-center">
                    <i class="fas fa-eye mr-2"></i>
                    Lihat Detail
                  </a>
                  <a href="{{ route('daftarpengajuanpengguna') }}" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm rounded-lg transition-colors duration-200 flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                  </a>
                </div>
              </div>
            </div>

            <!-- Form Content -->
            <div class="flex-auto p-6">
              
              <!-- Status Info -->
              <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                @php
                  $status = strtolower(trim($pengajuan->status));
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
                
                <div class="flex items-center justify-between">
                  <div>
                    <p class="text-blue-800 font-medium">Status Saat Ini:</p>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $badgeClass }}">
                      <i class="fas fa-circle mr-2 text-xs"></i>
                      {{ $statusLabel }}
                    </span>
                  </div>
                  <div class="text-right text-sm text-blue-600">
                    <p>Dibuat: {{ $pengajuan->created_at->format('d M Y H:i') }}</p>
                    @if($pengajuan->updated_at && $pengajuan->updated_at != $pengajuan->created_at)
                      <p>Diperbarui: {{ $pengajuan->updated_at->format('d M Y H:i') }}</p>
                    @endif
                  </div>
                </div>
              </div>

              <!-- Edit Form -->
              <form id="editPengajuanForm" method="POST" action="{{ route('pengajuan.update', $pengajuan->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                  
                  <!-- Izin Usaha Section -->
                  <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                      <i class="fas fa-building mr-2 text-blue-600"></i>
                      Data Izin Usaha
                    </h3>
                    
                    <div class="space-y-4">
                      <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                          Nomor Izin Usaha <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="nomor_izin_usaha" 
                               value="{{ old('nomor_izin_usaha', $pengajuan->nomor_izin_usaha) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               required>
                        <div class="error-message text-red-500 text-sm mt-1 hidden"></div>
                      </div>

                      <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                          Tanggal Izin Usaha <span class="text-red-500">*</span>
                        </label>
                        <input type="date" 
                               name="tanggal_izin_usaha" 
                               value="{{ old('tanggal_izin_usaha', $pengajuan->tanggal_izin_usaha ? $pengajuan->tanggal_izin_usaha->format('Y-m-d') : '') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               required>
                        <div class="error-message text-red-500 text-sm mt-1 hidden"></div>
                      </div>

                      <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                          Masa Berlaku Izin Usaha <span class="text-red-500">*</span>
                        </label>
                        <input type="date" 
                               name="masa_berlaku_izin_usaha" 
                               value="{{ old('masa_berlaku_izin_usaha', $pengajuan->masa_berlaku_izin_usaha ? $pengajuan->masa_berlaku_izin_usaha->format('Y-m-d') : '') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               required>
                        <div class="error-message text-red-500 text-sm mt-1 hidden"></div>
                      </div>

                      <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                          Lampiran Izin Usaha
                        </label>
                        <input type="file" 
                               name="lampiran_izin_usaha" 
                               accept=".pdf,.jpg,.jpeg,.png"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @if($pengajuan->lampiran_izin_usaha)
                          <p class="text-sm text-gray-600 mt-1">
                            File saat ini: 
                            <a href="{{ route('lampiran.show', $pengajuan->lampiran_izin_usaha) }}" 
                               class="text-blue-600 hover:text-blue-800" target="_blank">
                              {{ $pengajuan->lampiran_izin_usaha }}
                            </a>
                          </p>
                        @endif
                        <div class="error-message text-red-500 text-sm mt-1 hidden"></div>
                      </div>
                    </div>
                  </div>

                  <!-- Izin Lingkungan Section -->
                  <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                      <i class="fas fa-leaf mr-2 text-green-600"></i>
                      Data Izin Lingkungan
                    </h3>
                    
                    <div class="space-y-4">
                      <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                          Jenis Izin Lingkungan
                        </label>
                        <select name="jenis_izin_lingkungan" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                          <option value="">Pilih Jenis Izin</option>
                          <option value="AMDAL" {{ old('jenis_izin_lingkungan', $pengajuan->jenis_izin_lingkungan) == 'AMDAL' ? 'selected' : '' }}>AMDAL</option>
                          <option value="UKL-UPL" {{ old('jenis_izin_lingkungan', $pengajuan->jenis_izin_lingkungan) == 'UKL-UPL' ? 'selected' : '' }}>UKL-UPL</option>
                          <option value="SPPL" {{ old('jenis_izin_lingkungan', $pengajuan->jenis_izin_lingkungan) == 'SPPL' ? 'selected' : '' }}>SPPL</option>
                        </select>
                        <div class="error-message text-red-500 text-sm mt-1 hidden"></div>
                      </div>

                      <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                          Nomor Izin Lingkungan
                        </label>
                        <input type="text" 
                               name="nomor_izin_lingkungan" 
                               value="{{ old('nomor_izin_lingkungan', $pengajuan->nomor_izin_lingkungan) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <div class="error-message text-red-500 text-sm mt-1 hidden"></div>
                      </div>

                      <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                          Tanggal Izin Lingkungan
                        </label>
                        <input type="date" 
                               name="tanggal_izin_lingkungan" 
                               value="{{ old('tanggal_izin_lingkungan', $pengajuan->tanggal_izin_lingkungan ? $pengajuan->tanggal_izin_lingkungan->format('Y-m-d') : '') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <div class="error-message text-red-500 text-sm mt-1 hidden"></div>
                      </div>

                      <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                          Masa Berlaku Izin Lingkungan
                        </label>
                        <input type="date" 
                               name="masa_berlaku_izin_lingkungan" 
                               value="{{ old('masa_berlaku_izin_lingkungan', $pengajuan->masa_berlaku_izin_lingkungan ? $pengajuan->masa_berlaku_izin_lingkungan->format('Y-m-d') : '') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <div class="error-message text-red-500 text-sm mt-1 hidden"></div>
                      </div>

                      <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                          Lampiran Izin Lingkungan
                        </label>
                        <input type="file" 
                               name="lampiran_izin_lingkungan" 
                               accept=".pdf,.jpg,.jpeg,.png"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @if($pengajuan->lampiran_izin_lingkungan)
                          <p class="text-sm text-gray-600 mt-1">
                            File saat ini: 
                            <a href="{{ route('lampiran.show', $pengajuan->lampiran_izin_lingkungan) }}" 
                               class="text-blue-600 hover:text-blue-800" target="_blank">
                              {{ $pengajuan->lampiran_izin_lingkungan }}
                            </a>
                          </p>
                        @endif
                        <div class="error-message text-red-500 text-sm mt-1 hidden"></div>
                      </div>
                    </div>
                  </div>

                  <!-- Kapasitas Listrik Section -->
                  <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                      <i class="fas fa-bolt mr-2 text-yellow-600"></i>
                      Data Kapasitas Listrik
                    </h3>
                    
                    <div class="space-y-4">
                      <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                          Kelebihan Listrik (MW) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" 
                               name="kelebihan_listrik" 
                               value="{{ old('kelebihan_listrik', $pengajuan->kelebihan_listrik) }}"
                               step="0.01"
                               min="0"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               required>
                        <div class="error-message text-red-500 text-sm mt-1 hidden"></div>
                      </div>

                      <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                          Sambungan Listrik
                        </label>
                        <input type="text" 
                               name="sambunganListrik" 
                               value="{{ old('sambunganListrik', $pengajuan->sambunganListrik) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Contoh: TM 20kV, TT 500kV">
                        <div class="error-message text-red-500 text-sm mt-1 hidden"></div>
                      </div>

                      <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                          Lampiran Tagihan Listrik
                        </label>
                        <input type="file" 
                               name="lampiran_tagihan_listrik" 
                               accept=".pdf,.jpg,.jpeg,.png"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @if($pengajuan->lampiran_tagihan_listrik)
                          <p class="text-sm text-gray-600 mt-1">
                            File saat ini: 
                            <a href="{{ route('lampiran.show', $pengajuan->lampiran_tagihan_listrik) }}" 
                               class="text-blue-600 hover:text-blue-800" target="_blank">
                              {{ $pengajuan->lampiran_tagihan_listrik }}
                            </a>
                          </p>
                        @endif
                        <div class="error-message text-red-500 text-sm mt-1 hidden"></div>
                      </div>
                    </div>
                  </div>

                  <!-- Checkbox & Notes Section -->
                  <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                      <i class="fas fa-check-square mr-2 text-purple-600"></i>
                      Opsi & Catatan
                    </h3>
                    
                    <div class="space-y-4">
                      <div class="flex items-center">
                        <input type="checkbox" 
                               name="checkbox" 
                               id="checkbox_agreement"
                               value="1"
                               {{ old('checkbox', $pengajuan->checkbox) ? 'checked' : '' }}
                               class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-2 focus:ring-blue-500">
                        <label for="checkbox_agreement" class="ml-2 text-sm text-gray-700">
                          Saya menyetujui syarat dan ketentuan yang berlaku
                        </label>
                      </div>

                      <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                          Catatan Tambahan
                        </label>
                        <textarea name="catatan" 
                                  rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                  placeholder="Masukkan catatan tambahan jika diperlukan...">{{ old('catatan', $pengajuan->catatan) }}</textarea>
                        <div class="error-message text-red-500 text-sm mt-1 hidden"></div>
                      </div>
                    </div>
                  </div>

                </div>

                <!-- Submit Buttons -->
                <div class="mt-8 flex flex-col sm:flex-row justify-end gap-3">
                  <a href="{{ route('pengajuan.detail', $pengajuan->id) }}" 
                     class="px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white text-sm rounded-lg transition-colors duration-200 flex items-center justify-center">
                    <i class="fas fa-times mr-2"></i>
                    Batal
                  </a>
                  <button type="submit" 
                          id="submitBtn"
                          class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-lg transition-colors duration-200 flex items-center justify-center">
                    <i class="fas fa-save mr-2"></i>
                    <span id="submitText">Simpan Perubahan</span>
                    <div id="submitLoader" class="hidden ml-2">
                      <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                      </svg>
                    </div>
                  </button>
                </div>

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
  // CSRF Token Setup
  const csrfToken = $('meta[name="csrf-token"]').attr('content');
  if (csrfToken) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': csrfToken
      }
    });
  }

  // Form Submission
  $('#editPengajuanForm').on('submit', function(e) {
    e.preventDefault();
    
    const $submitBtn = $('#submitBtn');
    const $submitText = $('#submitText');
    const $submitLoader = $('#submitLoader');
    
    // Show loading state
    $submitBtn.prop('disabled', true);
    $submitText.text('Menyimpan...');
    $submitLoader.removeClass('hidden');
    
    // Clear previous errors
    $('.error-message').addClass('hidden').text('');
    $('input, select, textarea').removeClass('border-red-500');
    
    // Prepare form data
    const formData = new FormData(this);
    
    $.ajax({
      url: $(this).attr('action'),
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: function(response) {
        if (response.success) {
          Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: response.message,
            confirmButtonColor: '#059669'
          }).then((result) => {
            if (response.redirect) {
              window.location.href = response.redirect;
            } else {
              window.location.reload();
            }
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: response.message || 'Terjadi kesalahan saat menyimpan data.',
            confirmButtonColor: '#dc2626'
          });
        }
      },
      error: function(xhr) {
        if (xhr.status === 422) {
          // Validation errors
          const errors = xhr.responseJSON.errors;
          if (errors) {
            Object.keys(errors).forEach(function(key) {
              const $field = $(`[name="${key}"]`);
              const $errorDiv = $field.closest('div').find('.error-message');
              
              $field.addClass('border-red-500');
              $errorDiv.text(errors[key][0]).removeClass('hidden');
            });
            
            Swal.fire({
              icon: 'warning',
              title: 'Data tidak valid!',
              text: 'Silakan periksa kembali data yang Anda masukkan.',
              confirmButtonColor: '#f59e0b'
            });
          }
        } else {
          const message = xhr.responseJSON?.message || 'Terjadi kesalahan saat menyimpan data.';
          Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: message,
            confirmButtonColor: '#dc2626'
          });
        }
      },
      complete: function() {
        // Reset loading state
        $submitBtn.prop('disabled', false);
        $submitText.text('Simpan Perubahan');
        $submitLoader.addClass('hidden');
      }
    });
  });

  // File input change event for validation
  $('input[type="file"]').on('change', function() {
    const file = this.files[0];
    const $errorDiv = $(this).closest('div').find('.error-message');
    
    if (file) {
      // Check file size (max 5MB)
      if (file.size > 5 * 1024 * 1024) {
        $(this).addClass('border-red-500');
        $errorDiv.text('Ukuran file maksimal 5MB').removeClass('hidden');
        $(this).val('');
        return;
      }
      
      // Check file type
      const allowedTypes = ['application/pdf', 'image/jpeg', 'image/jpg', 'image/png'];
      if (!allowedTypes.includes(file.type)) {
        $(this).addClass('border-red-500');
        $errorDiv.text('Format file harus PDF, JPG, JPEG, atau PNG').removeClass('hidden');
        $(this).val('');
        return;
      }
      
      // Clear error if validation passes
      $(this).removeClass('border-red-500');
      $errorDiv.addClass('hidden');
    }
  });

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
