<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link rel="icon" type="image/png" href=" {{ asset('assets/img/logo-esdm.svg') }} " />
  <title>Daftar Laporan Berkala Pengguna</title>
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
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="w-full px-6 py-6 mx-auto">
      <!-- table 1 -->

      <div class="flex flex-wrap -mx-3">
  <div class="flex-none w-full max-w-full px-3">
    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border border-gray-200 shadow-xl rounded-2xl">
      
      <!-- Header -->
      <div class="p-4 pb-0 mb-0 border-b border-gray-200 rounded-t-2xl">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4">
          <h6 class="leading-normal text-lg font-bold text-gray-700 uppercase mb-2 sm:mb-0">
            Daftar Laporan Berkala
          </h6>
          <div class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
            <button id="refresh-btn" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-lg transition-colors duration-200 flex items-center">
              <i class="fas fa-sync-alt mr-2" id="refresh-icon"></i>
              Refresh
            </button>
            <a href="{{ route('laporanberkala') }}" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm rounded-lg transition-colors duration-200 flex items-center">
              <i class="fas fa-plus mr-2"></i>
              Buat Baru
            </a>
          </div>
        </div>
        
        <!-- Search and Filter Controls -->
        <div class="flex flex-col md:flex-row gap-3 mb-4">
          <!-- Search Input -->
          <div class="relative flex-1">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <i class="fas fa-search text-gray-400"></i>
            </div>
            <input type="text" id="search-input" 
                   class="block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                   placeholder="Cari berdasarkan nomor pengajuan...">
          </div>
          
          <!-- Status Filter -->
          <div class="w-full md:w-48">
            <select id="status-filter" 
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
              <option value="">Semua Status</option>
              <option value="proses evaluasi">Proses Evaluasi</option>
              <option value="perbaikan">Perlu Perbaikan</option>
              <option value="ditolak">Ditolak</option>
              <option value="disetujui">Disetujui</option>
            </select>
          </div>
          
          <!-- Date Range Filter -->
          <div class="w-full md:w-48">
            <select id="date-filter" 
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
              <option value="">Semua Tanggal</option>
              <option value="today">Hari Ini</option>
              <option value="week">Minggu Ini</option>
              <option value="month">Bulan Ini</option>
              <option value="year">Tahun Ini</option>
            </select>
          </div>
        </div>
        
        <!-- Results Info -->
        <div id="results-info" class="text-sm text-gray-600 mb-2">
          <span id="showing-text">Menampilkan data...</span>
        </div>
      </div>

      <!-- Table -->
      <div class="flex-auto pt-0 pb-2 overflow-x-auto">
        <table class="min-w-full text-sm text-left text-slate-600 border-separate border-spacing-0">
          <thead class="bg-green-600 text-white uppercase text-xs tracking-wider">
            <tr>
              <th class="px-4 py-3 font-semibold">No</th>
              <th class="px-4 py-3 font-semibold text-center">Tanggal</th>
              <th class="px-4 py-3 font-semibold text-center">Catatan</th>
              <th class="px-4 py-3 font-semibold text-center">Status</th>
              <th class="px-4 py-3 font-semibold text-center">Aksi</th>
            </tr>
          </thead>
          <tbody id="pengajuan-table" class="bg-white"></tbody>
        </table>
      </div>
      
      <!-- Pagination -->
      <div id="pagination-container" class="px-4 py-3 border-t border-gray-200 bg-gray-50 rounded-b-2xl hidden">
        <div class="flex flex-col sm:flex-row justify-between items-center">
          <div class="text-sm text-gray-700 mb-2 sm:mb-0">
            <span id="pagination-info">Menampilkan 1 - 10 dari 0 data</span>
          </div>
          <div class="flex space-x-1" id="pagination-buttons">
            <!-- Pagination buttons will be inserted here -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $(function () {
    // Global variables
    let currentPage = 1;
    let totalPages = 1;
    let totalRecords = 0;
    let isLoading = false;
    let searchTimeout;
    
    // CSRF Token
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    if (csrfToken) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': csrfToken
        }
      });
    }

    // Show loading state
    function showLoading() {
      isLoading = true;
      $('#refresh-icon').addClass('fa-spin');
      $('#pengajuan-table').html(`
        <tr>
          <td colspan="5" class="text-center py-8">
            <div class="flex justify-center items-center">
              <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
              <span class="text-gray-600">Memuat data...</span>
            </div>
          </td>
        </tr>
      `);
    }

    // Hide loading state
    function hideLoading() {
      isLoading = false;
      $('#refresh-icon').removeClass('fa-spin');
    }

    // Show empty state
    function showEmpty() {
      $('#pengajuan-table').html(`
        <tr>
          <td colspan="5" class="text-center py-12">
            <div class="flex flex-col items-center">
              <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
              </svg>
              <p class="text-gray-500 text-lg font-medium mb-1">Belum ada data pengajuan</p>
              <p class="text-gray-400 text-sm mb-4">Data pengajuan laporan berkala akan muncul di sini</p>
              <a href="{{ route('laporanberkala') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm transition-colors duration-200">
                <i class="fas fa-plus mr-2"></i>Buat Pengajuan Baru
              </a>
            </div>
          </td>
        </tr>
      `);
      $('#pagination-container').addClass('hidden');
    }

    // Create enhanced action buttons
    function createActionButtons(item) {
      const status = (item.status || '').trim().toLowerCase();
      
      // Logic berdasarkan status
      if (status === 'perbaikan' || status === 'perlu perbaikan') {
        // Status Perbaikan: Link Edit Pengajuan
        return `
          <a href="/pengajuan/${item.id}/edit" class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-orange-600 bg-orange-50 rounded-lg hover:bg-orange-100 hover:text-orange-700 transition-colors duration-200">
            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
            Edit Pengajuan
          </a>
        `;
      } else if (status === 'disetujui' || status === 'disetujui kadis') {
        // Status Disetujui: Link Lihat
        return `
          <a href="/pengajuan/${item.id}/detail" class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 hover:text-blue-700 transition-colors duration-200">
            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
            Lihat
          </a>
        `;
      } else if (status === 'proses evaluasi') {
        // Status Proses Evaluasi: Tidak tampilkan apa-apa
        return `<span class="text-gray-400 text-sm">-</span>`;
      } else {
        // Status lainnya: Tidak tampilkan apa-apa
        return `<span class="text-gray-400 text-sm">-</span>`;
      }
    }

    // Toggle action menu
    window.toggleActionMenu = function(event, itemId) {
      event.stopPropagation();
      
      // Close all other menus
      $('[id^="action-menu-"]').addClass('hidden');
      
      // Toggle current menu
      $(`#action-menu-${itemId}`).toggleClass('hidden');
    };

    // Close menus when clicking outside
    $(document).on('click', function() {
      $('[id^="action-menu-"]').addClass('hidden');
    });

    // Delete draft function
    window.deleteDraft = function(itemId) {
      Swal.fire({
        title: 'Hapus Draft?',
        text: 'Draft yang dihapus tidak dapat dikembalikan!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: `/pengajuan/${itemId}/delete`,
            type: 'DELETE',
            success: function(response) {
              Swal.fire('Berhasil!', 'Draft berhasil dihapus.', 'success');
              loadPengajuan();
            },
            error: function(xhr) {
              Swal.fire('Error!', 'Gagal menghapus draft.', 'error');
            }
          });
        }
      });
    };

    // Load pengajuan with enhanced functionality
    function loadPengajuan(page = 1, search = '', status = '', dateFilter = '') {
      if (isLoading) return;
      
      showLoading();
      currentPage = page;
      
      const params = {
        page: page,
        per_page: 10
      };
      
      if (search) params.search = search;
      if (status) params.status = status;
      if (dateFilter) params.date_filter = dateFilter;
      
      $.ajax({
        url: "/daftar-pengajuan/list",
        type: "GET",
        data: params,
        dataType: "json",
        success: function (response) {
          hideLoading();
          
          const data = response.data || response;
          const pagination = response.pagination || {};
          
          totalRecords = pagination.total || data.length || 0;
          totalPages = pagination.last_page || 1;
          currentPage = pagination.current_page || page;
          
          if (totalRecords === 0) {
            showEmpty();
            updateResultsInfo(0, 0, 0);
            return;
          }
          
          let tbody = '';
          $.each(data, function (index, item) {
            const createdAt = new Date(item.created_at);
            const tanggal = createdAt.getDate().toString().padStart(2, '0') + "-" +
              (createdAt.getMonth() + 1).toString().padStart(2, '0') + "-" +
              createdAt.getFullYear();

            // status badge - 4 status dengan warna yang ditentukan
            const statusText = (item.status || '').toLowerCase();
            let badgeClass = '';
            let statusLabel = '';
            
            // Mapping 4 status utama
            if (statusText === 'proses evaluasi') {
              // Proses Evaluasi = Kuning
              badgeClass = 'bg-yellow-500';
              statusLabel = 'PROSES EVALUASI';
            } else if (statusText === 'proses verifikasi' || statusText === 'evaluasi') {
              // Proses Verifikasi = Biru  
              badgeClass = 'bg-blue-500';
              statusLabel = 'PROSES VERIFIKASI';
            } else if (statusText === 'proses pengesahan' || statusText === 'menunggu persetujuan kadis' || statusText === 'validasi') {
              // Proses Pengesahan = Hijau
              badgeClass = 'bg-green-500';
              statusLabel = 'PROSES PENGESAHAN';
            } else if (statusText === 'disetujui' || statusText === 'disetujui kadis') {
              // Disetujui = Hijau Pekat
              badgeClass = 'bg-green-600';
              statusLabel = 'DISETUJUI';
            } else {
              // Default case untuk status lain
              badgeClass = 'bg-gray-400';
              statusLabel = statusText.toUpperCase();
            }

            const rowClass = index % 2 === 0 ? "bg-white" : "bg-gray-50";
            const isLast = index === data.length - 1;
            const firstTdRound = isLast ? ' rounded-bl-2xl' : '';
            const lastTdRound = isLast ? ' rounded-br-2xl' : '';

            tbody += `
              <tr class="${rowClass} hover:bg-gray-100 transition-colors duration-200 border-b last:border-b-0">
                <td class="px-4 py-3 text-xs font-medium text-gray-900${firstTdRound}">
                  <div class="font-mono text-blue-600">${item.no_pengajuan}</div>
                </td>
                <td class="px-4 py-3 text-center text-sm text-gray-600">${tanggal}</td>
                <td class="px-4 py-3 text-center text-xs text-gray-600 max-w-xs truncate" title="${item.catatan || '-'}">
                  ${item.catatan || '-'}
                </td>
                <td class="px-4 py-3 text-center">
                  <span class="inline-flex items-center justify-center w-40 h-8 text-xs font-semibold text-white rounded-full ${badgeClass}">
                    ${statusLabel}
                  </span>
                </td>
                <td class="px-4 py-3 text-center${lastTdRound}">
                  ${createActionButtons(item)}
                </td>
              </tr>
            `;
          });
          
          $('#pengajuan-table').html(tbody);
          
          // Update pagination
          updatePagination();
          
          // Update results info
          const startRecord = ((currentPage - 1) * 10) + 1;
          const endRecord = Math.min(currentPage * 10, totalRecords);
          updateResultsInfo(startRecord, endRecord, totalRecords);
          
        },
        error: function (xhr, status, error) {
          hideLoading();
          
          let errorMessage = 'Terjadi kesalahan saat memuat data';
          
          if (xhr.responseJSON && xhr.responseJSON.message) {
            errorMessage = xhr.responseJSON.message;
          } else if (xhr.status === 404) {
            errorMessage = 'Data tidak ditemukan';
          } else if (xhr.status === 500) {
            errorMessage = 'Kesalahan server internal';
          } else if (xhr.status === 0) {
            errorMessage = 'Tidak dapat terhubung ke server';
          }
          
          Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: errorMessage,
            confirmButtonColor: '#dc2626'
          });
          
          console.error('AJAX Error:', {
            status: xhr.status,
            error: error,
            response: xhr.responseText
          });
        }
      });
    }

    // Update results info
    function updateResultsInfo(start, end, total) {
      $('#showing-text').text(`Menampilkan ${start}-${end} dari ${total} data`);
    }

    // Update pagination
    function updatePagination() {
      if (totalPages <= 1) {
        $('#pagination-container').addClass('hidden');
        return;
      }
      
      $('#pagination-container').removeClass('hidden');
      
      let paginationHtml = '';
      
      // Previous button
      if (currentPage > 1) {
        paginationHtml += `
          <button onclick="changePage(${currentPage - 1})" 
                  class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md hover:bg-gray-50 hover:text-gray-700">
            <i class="fas fa-chevron-left"></i>
          </button>
        `;
      } else {
        paginationHtml += `
          <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-300 bg-gray-100 border border-gray-300 rounded-l-md cursor-not-allowed">
            <i class="fas fa-chevron-left"></i>
          </span>
        `;
      }
      
      // Page numbers
      const startPage = Math.max(1, currentPage - 2);
      const endPage = Math.min(totalPages, currentPage + 2);
      
      for (let i = startPage; i <= endPage; i++) {
        if (i === currentPage) {
          paginationHtml += `
            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-blue-600 bg-blue-50 border border-blue-300">
              ${i}
            </span>
          `;
        } else {
          paginationHtml += `
            <button onclick="changePage(${i})" 
                    class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 hover:bg-gray-50 hover:text-gray-700">
              ${i}
            </button>
          `;
        }
      }
      
      // Next button
      if (currentPage < totalPages) {
        paginationHtml += `
          <button onclick="changePage(${currentPage + 1})" 
                  class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md hover:bg-gray-50 hover:text-gray-700">
            <i class="fas fa-chevron-right"></i>
          </button>
        `;
      } else {
        paginationHtml += `
          <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-300 bg-gray-100 border border-gray-300 rounded-r-md cursor-not-allowed">
            <i class="fas fa-chevron-right"></i>
          </span>
        `;
      }
      
      $('#pagination-buttons').html(paginationHtml);
      $('#pagination-info').text(`Menampilkan ${((currentPage - 1) * 10) + 1} - ${Math.min(currentPage * 10, totalRecords)} dari ${totalRecords} data`);
    }

    // Change page function
    window.changePage = function(page) {
      if (page !== currentPage && page >= 1 && page <= totalPages) {
        loadPengajuan(page, $('#search-input').val(), $('#status-filter').val(), $('#date-filter').val());
      }
    };

    // Search functionality
    $('#search-input').on('input', function() {
      const searchValue = $(this).val();
      
      clearTimeout(searchTimeout);
      searchTimeout = setTimeout(function() {
        loadPengajuan(1, searchValue, $('#status-filter').val(), $('#date-filter').val());
      }, 500);
    });

    // Filter functionality
    $('#status-filter, #date-filter').on('change', function() {
      loadPengajuan(1, $('#search-input').val(), $('#status-filter').val(), $('#date-filter').val());
    });

    // Refresh functionality
    $('#refresh-btn').on('click', function() {
      $('#search-input').val('');
      $('#status-filter').val('');
      $('#date-filter').val('');
      loadPengajuan(1);
    });

    // Sidebar toggle functionality
    document.addEventListener('DOMContentLoaded', function () {
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

    // Initial load
    loadPengajuan();
  });
</script>



      <!-- card 2 -->

      <!-- <div class="flex flex-wrap -mx-3">
          <div class="flex-none w-full max-w-full px-3">
            <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
              <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="dark:text-white">Projects table</h6>
              </div>
              <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                  <table class="items-center justify-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                    <thead class="align-bottom">
                      <tr>
                        <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Project</th>
                        <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Budget</th>
                        <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Status</th>
                        <th class="px-6 py-3 pl-2 font-bold text-center uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Completion</th>
                        <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-solid shadow-none dark:border-white/40 dark:text-white tracking-none whitespace-nowrap"></th>
                      </tr>
                    </thead>
                    <tbody class="border-t">
                      <tr>
                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                          <div class="flex px-2">
                            <div>
                              <img src="../assets/img/small-logos/logo-spotify.svg" class="inline-flex items-center justify-center mr-2 text-sm text-white transition-all duration-200 ease-in-out rounded-full h-9 w-9" alt="spotify" />
                            </div>
                            <div class="my-auto">
                              <h6 class="mb-0 text-sm leading-normal dark:text-white">Spotify</h6>
                            </div>
                          </div>
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                          <p class="mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60">$2,500</p>
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                          <span class="text-xs font-semibold leading-tight dark:text-white dark:opacity-60">working</span>
                        </td>
                        <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                          <div class="flex items-center justify-center">
                            <span class="mr-2 text-xs font-semibold leading-tight dark:text-white dark:opacity-60">60%</span>
                            <div>
                              <div class="text-xs h-0.75 w-30 m-0 flex overflow-visible rounded-lg bg-gray-200">
                                <div class="flex flex-col justify-center w-3/5 h-auto overflow-hidden text-center text-white transition-all bg-blue-500 rounded duration-600 ease bg-gradient-to-tl from-blue-700 to-cyan-500 whitespace-nowrap" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                          <button class="inline-block px-5 py-2.5 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none leading-normal text-sm ease-in bg-150 tracking-tight-rem bg-x-25 text-slate-400">
                            <i class="text-xs leading-tight fa fa-ellipsis-v dark:text-white dark:opacity-60"></i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                          <div class="flex px-2">
                            <div>
                              <img src="../assets/img/small-logos/logo-invision.svg" class="inline-flex items-center justify-center mr-2 text-sm text-white transition-all duration-200 ease-in-out rounded-full h-9 w-9" alt="invision" />
                            </div>
                            <div class="my-auto">
                              <h6 class="mb-0 text-sm leading-normal dark:text-white">Invision</h6>
                            </div>
                          </div>
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                          <p class="mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60">$5,000</p>
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                          <span class="text-xs font-semibold leading-tight dark:text-white dark:opacity-60">done</span>
                        </td>
                        <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                          <div class="flex items-center justify-center">
                            <span class="mr-2 text-xs font-semibold leading-tight dark:text-white dark:opacity-60">100%</span>
                            <div>
                              <div class="text-xs h-0.75 w-30 m-0 flex overflow-visible rounded-lg bg-gray-200">
                                <div class="flex flex-col justify-center w-full h-auto overflow-hidden text-center text-white transition-all bg-blue-500 rounded duration-600 ease bg-gradient-to-tl from-emerald-500 to-teal-400 whitespace-nowrap" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                          <button class="inline-block px-5 py-2.5 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none leading-normal text-sm ease-in bg-150 tracking-tight-rem bg-x-25 text-slate-400" aria-haspopup="true" aria-expanded="false">
                            <i class="text-xs leading-tight fa fa-ellipsis-v dark:text-white dark:opacity-60"></i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                          <div class="flex px-2">
                            <div>
                              <img src="../assets/img/small-logos/logo-jira.svg" class="inline-flex items-center justify-center mr-2 text-sm text-white transition-all duration-200 ease-in-out rounded-full h-9 w-9" alt="jira" />
                            </div>
                            <div class="my-auto">
                              <h6 class="mb-0 text-sm leading-normal dark:text-white">Jira</h6>
                            </div>
                          </div>
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                          <p class="mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60">$3,400</p>
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                          <span class="text-xs font-semibold leading-tight dark:text-white dark:opacity-60">canceled</span>
                        </td>
                        <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                          <div class="flex items-center justify-center">
                            <span class="mr-2 text-xs font-semibold leading-tight dark:text-white dark:opacity-60">30%</span>
                            <div>
                              <div class="text-xs h-0.75 w-30 m-0 flex overflow-visible rounded-lg bg-gray-200">
                                <div class="flex flex-col justify-center h-auto overflow-hidden text-center text-white transition-all bg-blue-500 rounded duration-600 ease bg-gradient-to-tl from-red-600 to-orange-600 w-3/10 whitespace-nowrap" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="30"></div>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                          <button class="inline-block px-5 py-2.5 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none leading-normal text-sm ease-in bg-150 tracking-tight-rem bg-x-25 text-slate-400" aria-haspopup="true" aria-expanded="false">
                            <i class="text-xs leading-tight fa fa-ellipsis-v dark:text-white dark:opacity-60"></i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                          <div class="flex px-2">
                            <div>
                              <img src="../assets/img/small-logos/logo-slack.svg" class="inline-flex items-center justify-center mr-2 text-sm text-white transition-all duration-200 ease-in-out rounded-full h-9 w-9" alt="slack" />
                            </div>
                            <div class="my-auto">
                              <h6 class="mb-0 text-sm leading-normal dark:text-white">Slack</h6>
                            </div>
                          </div>
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                          <p class="mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60">$1,000</p>
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                          <span class="text-xs font-semibold leading-tight dark:text-white dark:opacity-60">canceled</span>
                        </td>
                        <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                          <div class="flex items-center justify-center">
                            <span class="mr-2 text-xs font-semibold leading-tight dark:text-white dark:opacity-60">0%</span>
                            <div>
                              <div class="text-xs h-0.75 w-30 m-0 flex overflow-visible rounded-lg bg-gray-200">
                                <div class="flex flex-col justify-center w-0 h-auto overflow-hidden text-center text-white transition-all bg-blue-500 rounded duration-600 ease bg-gradient-to-tl from-emerald-500 to-teal-400 whitespace-nowrap" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="0"></div>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                          <button class="inline-block px-5 py-2.5 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none leading-normal text-sm ease-in bg-150 tracking-tight-rem bg-x-25 text-slate-400" aria-haspopup="true" aria-expanded="false">
                            <i class="text-xs leading-tight fa fa-ellipsis-v dark:text-white dark:opacity-60"></i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                          <div class="flex px-2">
                            <div>
                              <img src="../assets/img/small-logos/logo-webdev.svg" class="inline-flex items-center justify-center mr-2 text-sm text-white transition-all duration-200 ease-in-out rounded-full h-9 w-9" alt="webdev" />
                            </div>
                            <div class="my-auto">
                              <h6 class="mb-0 text-sm leading-normal dark:text-white">Webdev</h6>
                            </div>
                          </div>
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                          <p class="mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60">$14,000</p>
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                          <span class="text-xs font-semibold leading-tight dark:text-white dark:opacity-60">working</span>
                        </td>
                        <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                          <div class="flex items-center justify-center">
                            <span class="mr-2 text-xs font-semibold leading-tight dark:text-white dark:opacity-60">80%</span>
                            <div>
                              <div class="text-xs h-0.75 w-30 m-0 flex overflow-visible rounded-lg bg-gray-200">
                                <div class="flex flex-col justify-center w-4/5 h-auto overflow-hidden text-center text-white transition-all bg-blue-500 rounded duration-600 ease bg-gradient-to-tl from-blue-700 to-cyan-500 whitespace-nowrap" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="80"></div>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                          <button class="inline-block px-5 py-2.5 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none leading-normal text-sm ease-in bg-150 tracking-tight-rem bg-x-25 text-slate-400" aria-haspopup="true" aria-expanded="false">
                            <i class="text-xs leading-tight fa fa-ellipsis-v dark:text-white dark:opacity-60"></i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td class="p-2 align-middle bg-transparent border-b-0 whitespace-nowrap shadow-transparent">
                          <div class="flex px-2">
                            <div>
                              <img src="../assets/img/small-logos/logo-xd.svg" class="inline-flex items-center justify-center mr-2 text-sm text-white transition-all duration-200 ease-in-out rounded-full h-9 w-9" alt="xd" />
                            </div>
                            <div class="my-auto">
                              <h6 class="mb-0 text-sm leading-normal dark:text-white">Adobe XD</h6>
                            </div>
                          </div>
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b-0 whitespace-nowrap shadow-transparent">
                          <p class="mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60">$2,300</p>
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b-0 whitespace-nowrap shadow-transparent">
                          <span class="text-xs font-semibold leading-tight dark:text-white dark:opacity-60">done</span>
                        </td>
                        <td class="p-2 text-center align-middle bg-transparent border-b-0 whitespace-nowrap shadow-transparent">
                          <div class="flex items-center justify-center">
                            <span class="mr-2 text-xs font-semibold leading-tight dark:text-white dark:opacity-60">100%</span>
                            <div>
                              <div class="text-xs h-0.75 w-30 m-0 flex overflow-visible rounded-lg bg-gray-200">
                                <div class="flex flex-col justify-center w-full h-auto overflow-hidden text-center text-white transition-all bg-blue-500 rounded duration-600 ease bg-gradient-to-tl from-green-600 to-lime-400 whitespace-nowrap" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b-0 whitespace-nowrap shadow-transparent">
                          <button class="inline-block px-5 py-2.5 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none leading-normal text-sm ease-in bg-150 tracking-tight-rem bg-x-25 text-slate-400" aria-haspopup="true" aria-expanded="false">
                            <i class="text-xs leading-tight fa fa-ellipsis-v dark:text-white dark:opacity-60"></i>
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <footer class="pt-4">
          <div class="w-full px-6 mx-auto">
            <div class="flex flex-wrap items-center -mx-3 lg:justify-between">
              <div class="w-full max-w-full px-3 mt-0 mb-6 shrink-0 lg:mb-0 lg:w-1/2 lg:flex-none">
                <div class="text-sm leading-normal text-center text-slate-500 lg:text-left">
                  ©
                  <script>
                    document.write(new Date().getFullYear() + ",");
                  </script>
                  made with <i class="fa fa-heart"></i> by
                  <a href="https://www.creative-tim.com" class="font-semibold dark:text-white text-slate-700" target="_blank">Creative Tim</a>
                  .
                </div>
              </div> -->
      <!-- <div class="w-full max-w-full px-3 mt-0 shrink-0 lg:w-1/2 lg:flex-none">
                <ul class="flex flex-wrap justify-center pl-0 mb-0 list-none lg:justify-end">
                  <li class="nav-item">
                    <a href="https://www.creative-tim.com" class="block px-4 pt-0 pb-1 text-sm font-normal transition-colors ease-in-out text-slate-500" target="_blank">Creative Tim</a>
                  </li>
                  <li class="nav-item">
                    <a href="https://www.creative-tim.com/presentation" class="block px-4 pt-0 pb-1 text-sm font-normal transition-colors ease-in-out text-slate-500" target="_blank">About Us</a>
                  </li>
                  <li class="nav-item">
                    <a href="https://creative-tim.com/blog" class="block px-4 pt-0 pb-1 text-sm font-normal transition-colors ease-in-out text-slate-500" target="_blank">Blog</a>
                  </li>
                  <li class="nav-item">
                    <a href="https://www.creative-tim.com/license" class="block px-4 pt-0 pb-1 pr-0 text-sm font-normal transition-colors ease-in-out text-slate-500" target="_blank">License</a>
                  </li>
                </ul>  <!-->
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