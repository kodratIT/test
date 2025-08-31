<!-- Page 2: MESIN & GENERATOR -->
<div id="page2" class="page hidden">

  <!-- DATA MESIN PENGGERAK MULA -->
  <h3 class="text-lg font-bold uppercase mt-6 pb-2 text-gray-700 dark:text-white">
    DATA MESIN PENGGERAK MULA
  </h3>

  <div class="flex justify-end gap-2 mb-4">
    <button type="button" onclick="addMesinColumn()" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Tambah</button>
    <button type="button" onclick="removeMesinColumn()" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Kurang</button>
  </div>

  <div class="overflow-x-auto">
    <table id="mesinTable" class="min-w-full border border-gray-300 text-sm">
      <thead>
        <tr>
          <th class="border border-gray-300 p-2 bg-gray-100 text-left sticky left-0 min-w-[150px] max-w-[150px] w-[150px]">Data Mesin</th>
          <th class="border border-gray-300 p-2 bg-gray-100 min-w-[220px]">Unit 1</th>
        </tr>
      </thead>
      <tbody>
        @php
          $mesinData = is_array($pengajuan->mesin) ? $pengajuan->mesin : [];
        @endphp
        <tr>
          <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Jenis Penggerak</td>
          <td class="border p-2">
            <input id="mesin_jenis_penggerak_1" name="jenis_penggerak[]" type="text" class="w-full border p-1 rounded" 
                   value="{{ old('jenis_penggerak.0', $mesinData['jenis_penggerak'][0] ?? '') }}" required>
          </td>
        </tr>
        <tr>
          <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Jenis Pembangkit</td>
          <td class="border p-2">
            <select id="mesin_jenis_pembangkit_1" name="jenis_pembangkit[]" class="w-full border p-1 rounded" required>
              <option value="">Pilih</option>
              @php 
                $currentPembangkit = old('jenis_pembangkit.0', $mesinData['jenis_pembangkit'][0] ?? '');
                $pembangkitOptions = ['PLTD', 'PLTBm', 'PLTMH', 'PLTU', 'PLTBg', 'PLTMG'];
              @endphp
              @foreach($pembangkitOptions as $option)
                <option value="{{ $option }}" {{ $currentPembangkit == $option ? 'selected' : '' }}>{{ $option }}</option>
              @endforeach
            </select>
          </td>
        </tr>
        <tr>
          <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Energi Primer / Utama</td>
          <td class="border p-2">
            <input id="mesin_energi_primer_1" name="energi_primer[]" type="text" class="w-full border p-1 rounded" 
                   value="{{ old('energi_primer.0', $mesinData['energi_primer'][0] ?? '') }}" required>
          </td>
        </tr>
        <tr>
          <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Merk / Tipe / Seri</td>
          <td class="border p-2">
            <input id="mesin_merk_tipe_1" name="mesin_merk_tipe[]" type="text" class="w-full border p-1 rounded" 
                   value="{{ old('mesin_merk_tipe.0', $mesinData['mesin_merk_tipe'][0] ?? '') }}" required>
          </td>
        </tr>
        <tr>
          <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Pabrikan / Tahun</td>
          <td class="border p-2">
            <input id="mesin_pabrikan_1" name="mesin_pabrikan[]" type="text" class="w-full border p-1 rounded" 
                   value="{{ old('mesin_pabrikan.0', $mesinData['mesin_pabrikan'][0] ?? '') }}" required>
          </td>
        </tr>
        <tr>
          <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Kapasitas (kW / kVA)</td>
          <td class="border p-2">
            <input id="mesin_kapasitas_1" name="mesin_kapasitas[]" type="text" class="w-full border p-1 rounded" 
                   value="{{ old('mesin_kapasitas.0', $mesinData['mesin_kapasitas'][0] ?? '') }}" required>
          </td>
        </tr>
        <tr>
          <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Putaran (rpm)</td>
          <td class="border p-2">
            <input id="mesin_putaran_1" name="mesin_putaran[]" type="text" class="w-full border p-1 rounded" 
                   value="{{ old('mesin_putaran.0', $mesinData['mesin_putaran'][0] ?? '') }}" required>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="mt-6">
    <label>Upload foto Unit, Nameplate Mesin, Tata Letak</label>
    <input id="lampiran_nameplate_mesin" name="lampiran_nameplate_mesin" type="file" accept=".pdf" class="w-full border p-2 rounded-lg" onchange="previewFile(this)">
    <small class="text-gray-500">Format PDF Maks 5MB</small>
    @if($pengajuan->lampiran_nameplate_mesin)
      <p class="text-sm text-gray-600 mt-2">
        File saat ini: 
        <a href="{{ route('lampiran.show', $pengajuan->lampiran_nameplate_mesin) }}" 
           class="text-blue-600 hover:text-blue-800" target="_blank">
          {{ $pengajuan->lampiran_nameplate_mesin }}
        </a>
      </p>
    @endif
  </div>
  <div id="preview_lampiran_nameplate_mesin"></div>

  <!-- DATA GENERATOR -->
  <h3 class="text-lg font-bold uppercase mt-6 pb-2 text-gray-700 dark:text-white">
    DATA GENERATOR
  </h3>

  <div class="flex justify-end gap-2 mb-4">
    <button type="button" onclick="addGeneratorColumn()" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Tambah</button>
    <button type="button" onclick="removeGeneratorColumn()" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Kurang</button>
  </div>

  <div class="overflow-x-auto">
    <table id="generatorTable" class="min-w-full border border-gray-300 text-sm">
      <thead>
        <tr>
          <th class="border border-gray-300 p-2 bg-gray-100 text-left sticky left-0 min-w-[150px] max-w-[150px] w-[150px]">Data Generator</th>
          <th class="border border-gray-300 p-2 bg-gray-100 min-w-[220px]">Unit 1</th>
        </tr>
      </thead>
      <tbody>
        @php
          $generatorData = is_array($pengajuan->generator) ? $pengajuan->generator : [];
        @endphp
        <tr>
          <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Merk / Tipe / Seri</td>
          <td class="border p-2">
            <input id="generator_merk_tipe_1" name="generator_merk_tipe[]" type="text" class="w-full border p-1 rounded" 
                   value="{{ old('generator_merk_tipe.0', $generatorData['generator_merk_tipe'][0] ?? '') }}" required>
          </td>
        </tr>
        <tr>
          <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Pabrikan / Tahun</td>
          <td class="border p-2">
            <input id="generator_pabrikan_1" name="generator_pabrikan[]" type="text" class="w-full border p-1 rounded" 
                   value="{{ old('generator_pabrikan.0', $generatorData['generator_pabrikan'][0] ?? '') }}" required>
          </td>
        </tr>
        <tr>
          <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Kapasitas (kW / kVA)</td>
          <td class="border p-2">
            <input id="generator_kapasitas_1" name="generator_kapasitas[]" type="text" class="w-full border p-1 rounded" 
                   value="{{ old('generator_kapasitas.0', $generatorData['generator_kapasitas'][0] ?? '') }}" required>
          </td>
        </tr>
        <tr>
          <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Tegangan (V)</td>
          <td class="border p-2">
            <input id="generator_tegangan_1" name="generator_tegangan[]" type="text" class="w-full border p-1 rounded" 
                   value="{{ old('generator_tegangan.0', $generatorData['generator_tegangan'][0] ?? '') }}" required>
          </td>
        </tr>
        <tr>
          <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Arus (A)</td>
          <td class="border p-2">
            <input id="generator_arus_1" name="generator_arus[]" type="text" class="w-full border p-1 rounded" 
                   value="{{ old('generator_arus.0', $generatorData['generator_arus'][0] ?? '') }}" required>
          </td>
        </tr>
        <tr>
          <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Faktor Daya</td>
          <td class="border p-2">
            <input id="generator_faktor_daya_1" name="generator_faktor_daya[]" type="text" class="w-full border p-1 rounded" 
                   value="{{ old('generator_faktor_daya.0', $generatorData['generator_faktor_daya'][0] ?? '') }}" required>
          </td>
        </tr>
        <tr>
          <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Fasa</td>
          <td class="border p-2">
            <input id="generator_fasa_1" name="generator_fasa[]" type="text" class="w-full border p-1 rounded" 
                   value="{{ old('generator_fasa.0', $generatorData['generator_fasa'][0] ?? '') }}" required>
          </td>
        </tr>
        <tr>
          <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Frekuensi (Hz)</td>
          <td class="border p-2">
            <input id="generator_frekuensi_1" name="generator_frekuensi[]" type="text" class="w-full border p-1 rounded" 
                   value="{{ old('generator_frekuensi.0', $generatorData['generator_frekuensi'][0] ?? '') }}" required>
          </td>
        </tr>
        <tr>
          <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Putaran (rpm)</td>
          <td class="border p-2">
            <input id="generator_putaran_1" name="generator_putaran[]" type="text" class="w-full border p-1 rounded" 
                   value="{{ old('generator_putaran.0', $generatorData['generator_putaran'][0] ?? '') }}" required>
          </td>
        </tr>
        <tr>
          <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Lokasi Unit (Kab / Kota)</td>
          <td class="border p-2">
            <select id="generator_lokasi_1" name="generator_lokasi[]" class="w-full border p-1 rounded" required>
              <option value="">Pilih Lokasi</option>
              @php 
                $currentLokasi = old('generator_lokasi.0', $generatorData['generator_lokasi'][0] ?? '');
                $lokasiOptions = [
                  'Kota Jambi', 'Kabupaten Muaro Jambi', 'Kabupaten Batanghari',
                  'Kabupaten Tanjung Jabung Barat', 'Kabupaten Tanjung Jabung Timur',
                  'Kabupaten Bungo', 'Kabupaten Tebo', 'Kabupaten Merangin',
                  'Kabupaten Sarolangun', 'Kabupaten Kerinci', 'Kota Sungai Penuh'
                ];
              @endphp
              @foreach($lokasiOptions as $lokasi)
                <option value="{{ $lokasi }}" {{ $currentLokasi == $lokasi ? 'selected' : '' }}>{{ $lokasi }}</option>
              @endforeach
            </select>
          </td>
        </tr>
        <tr>
          <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Koordinat</td>
          <td class="border p-2 space-y-1">
            <input id="generator_latitude_1" name="generator_latitude[]" type="number" step="any"
              placeholder="Latitude (cth: -1.234567)" class="w-full border p-1 rounded mb-1" 
              value="{{ old('generator_latitude.0', $generatorData['generator_latitude'][0] ?? '') }}" required>
            <input id="generator_longitude_1" name="generator_longitude[]" type="number" step="any"
              placeholder="Longitude (cth: 103.456789)" class="w-full border p-1 rounded" 
              value="{{ old('generator_longitude.0', $generatorData['generator_longitude'][0] ?? '') }}" required>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="mt-6">
    <label>Upload foto Unit, Nameplate Generator, Tata Letak</label>
    <input id="lampiran_nameplate_generator" name="lampiran_nameplate_generator" type="file" accept=".pdf" class="w-full border p-2 rounded-lg" onchange="previewFile(this)">
    <small class="text-gray-500">Format PDF Maks 5MB</small>
    @if($pengajuan->lampiran_nameplate_generator)
      <p class="text-sm text-gray-600 mt-2">
        File saat ini: 
        <a href="{{ route('lampiran.show', $pengajuan->lampiran_nameplate_generator) }}" 
           class="text-blue-600 hover:text-blue-800" target="_blank">
          {{ $pengajuan->lampiran_nameplate_generator }}
        </a>
      </p>
    @endif
  </div>
  <div id="preview_lampiran_nameplate_generator"></div>

  <!-- Dropdown Sambungan Listrik -->
  <div class="mt-6">
    <label for="sambunganListrik" class="block text-sm font-medium text-gray-700">Apakah ada sambungan listrik dari pihak lain?</label>
    <select id="sambunganListrik" name="sambunganListrik" class="mt-1 block w-full p-2 border rounded-md" onchange="toggleSambunganListrikTable()" required>
      <option value="" disabled hidden>Pilih</option>
      @php $currentSambungan = old('sambunganListrik', $pengajuan->sambunganListrik); @endphp
      <option value="ada" {{ $currentSambungan == 'ada' ? 'selected' : '' }}>Ada</option>
      <option value="tidak" {{ $currentSambungan == 'tidak' ? 'selected' : '' }}>Tidak</option>
    </select>
  </div>

  <!-- Container Sambungan Listrik -->
  <div id="sambunganListrikTable" class="mt-6 {{ $currentSambungan != 'ada' ? 'hidden' : '' }}">

    <h3 class="text-lg font-bold uppercase mt-6 pb-2 text-gray-700 dark:text-white">Jaringan / Saluran Distribusi</h3>

    <div class="flex justify-end gap-2 mb-4">
      <button type="button" onclick="addDistribusiColumn(event)" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Tambah</button>
      <button type="button" onclick="removeDistribusiColumn(event)" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Kurang</button>
    </div>

    <div class="overflow-x-auto">
      <table class="min-w-full border border-gray-300" id="distribusiTable">
        <thead class="bg-gray-200 text-center">
          <tr>
            <th class="border border-gray-300 p-2 bg-gray-100 text-left sticky left-0 z-10 w-[200px] min-w-[200px] max-w-[200px]">Field</th>
            <th class="border border-gray-300 p-2 min-w-[220px]">Saluran Distribusi-1</th>
          </tr>
        </thead>
        <tbody>
          @php
            $distribusiData = is_array($pengajuan->distribusi) ? $pengajuan->distribusi : [];
          @endphp
          <tr id="row-pemilik_instalasi_distribusi">
            <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Pemilik Instalasi</td>
            <td><input id="pemilik_instalasi_distribusi-0" name="pemilik_instalasi_distribusi[]" type="text" class="w-full border p-1 rounded" 
                       value="{{ old('pemilik_instalasi_distribusi.0', $distribusiData['pemilik_instalasi_distribusi'][0] ?? '') }}"></td>
          </tr>
          <tr id="row-tegangan_distribusi">
            <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Tegangan (V)</td>
            <td><input id="tegangan_distribusi-0" name="tegangan_distribusi[]" type="text" class="w-full border p-1 rounded" 
                       value="{{ old('tegangan_distribusi.0', $distribusiData['tegangan_distribusi'][0] ?? '') }}"></td>
          </tr>
          <tr id="row-kapasitas_panjang_distribusi">
            <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Panjang (kms)</td>
            <td><input id="kapasitas_panjang_distribusi-0" name="kapasitas_panjang_distribusi[]" type="text" class="w-full border p-1 rounded" 
                       value="{{ old('kapasitas_panjang_distribusi.0', $distribusiData['kapasitas_panjang_distribusi'][0] ?? '') }}"></td>
          </tr>
          <tr id="row-kabupaten_kota_distribusi">
            <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Kabupaten/Kota</td>
            <td>
              <select id="kabupaten_kota_distribusi-0" name="kabupaten_kota_distribusi[]" class="w-full border p-1 rounded">
                <option disabled>Pilih Kabupaten/Kota</option>
                @php 
                  $currentKabDist = old('kabupaten_kota_distribusi.0', $distribusiData['kabupaten_kota_distribusi'][0] ?? '');
                  $kabupatenOptions = [
                    'Batanghari', 'Bungo', 'Kerinci', 'Merangin', 'Muaro Jambi', 
                    'Sarolangun', 'Tanjung Jabung Barat', 'Tanjung Jabung Timur', 
                    'Tebo', 'Kota Jambi', 'Kota Sungai Penuh'
                  ];
                @endphp
                @foreach($kabupatenOptions as $kabupaten)
                  <option value="{{ $kabupaten }}" {{ $currentKabDist == $kabupaten ? 'selected' : '' }}>{{ $kabupaten }}</option>
                @endforeach
              </select>
            </td>
          </tr>
          <tr id="row-provinsi_distribusi">
            <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Provinsi</td>
            <td><input id="provinsi_distribusi-0" name="provinsi_distribusi[]" type="text" class="w-full border p-1 rounded bg-gray-100" readonly value="Jambi"></td>
          </tr>
          <tr id="row-koordinat_distribusi">
            <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Koordinat</td>
            <td>
              <input id="latitude_distribusi-0" name="latitude_distribusi[]" type="number" step="any" placeholder="Latitude (cth: -1.234567)" class="w-full border p-1 rounded mb-1" 
                     value="{{ old('latitude_distribusi.0', $distribusiData['latitude_distribusi'][0] ?? '') }}">
              <input id="longitude_distribusi-0" name="longitude_distribusi[]" type="number" step="any" placeholder="Longitude (cth: 103.456789)" class="w-full border p-1 rounded" 
                     value="{{ old('longitude_distribusi.0', $distribusiData['longitude_distribusi'][0] ?? '') }}">
            </td>
          </tr>
          <tr id="row-tahun_operasi_distribusi">
            <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Tahun Operasi</td>
            <td><input id="tahun_operasi_distribusi-0" name="tahun_operasi_distribusi[]" type="text" class="w-full border p-1 rounded" 
                       value="{{ old('tahun_operasi_distribusi.0', $distribusiData['tahun_operasi_distribusi'][0] ?? '') }}"></td>
          </tr>
        </tbody>
      </table>
    </div>

    <h3 class="text-lg font-bold uppercase mt-6 pb-2 text-gray-700 dark:text-white">Transformator</h3>

    <div class="overflow-x-auto">
      <table class="min-w-full border border-gray-300 table-fixed" id="trafoTable">
        <thead class="bg-gray-200 text-center">
          <tr>
            <th class="border border-gray-300 p-2 bg-gray-100 text-left sticky left-0 z-10 w-[200px] min-w-[200px] max-w-[200px]">Field</th>
            <th class="border border-gray-300 p-2 min-w-[220px]">Transformator</th>
          </tr>
        </thead>
        <tbody>
          @php
            $trafoData = is_array($pengajuan->transformator) ? $pengajuan->transformator : [];
          @endphp
          <tr>
            <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Pemilik</td>
            <td class="border p-2">
              <input id="pemilik_trafo" name="pemilik_trafo" type="text" class="w-full border p-1 rounded" 
                     value="{{ old('pemilik_trafo', $trafoData['pemilik_trafo'] ?? '') }}">
            </td>
          </tr>
          <tr>
            <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Tegangan Primer (V)</td>
            <td class="border p-2">
              <input id="tegangan_primer_trafo" name="tegangan_primer_trafo" type="text" class="w-full border p-1 rounded" 
                     value="{{ old('tegangan_primer_trafo', $trafoData['tegangan_primer_trafo'] ?? '') }}">
            </td>
          </tr>
          <tr>
            <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Tegangan Sekunder (V)</td>
            <td class="border p-2">
              <input id="tegangan_sekunder_trafo" name="tegangan_sekunder_trafo" type="text" class="w-full border p-1 rounded" 
                     value="{{ old('tegangan_sekunder_trafo', $trafoData['tegangan_sekunder_trafo'] ?? '') }}">
            </td>
          </tr>
          <tr>
            <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Kapasitas Daya (kVA)</td>
            <td class="border p-2">
              <input id="kapasitas_daya_trafo" name="kapasitas_daya_trafo" type="text" class="w-full border p-1 rounded" 
                     value="{{ old('kapasitas_daya_trafo', $trafoData['kapasitas_daya_trafo'] ?? '') }}">
            </td>
          </tr>
          <tr>
            <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Kabupaten/Kota</td>
            <td class="border p-2">
              <select id="kabupaten_kota_trafo" name="kabupaten_kota_trafo" class="w-full border p-1 rounded">
                <option disabled>Pilih Kabupaten/Kota</option>
                @php $currentKabTrafo = old('kabupaten_kota_trafo', $trafoData['kabupaten_kota_trafo'] ?? ''); @endphp
                @foreach($kabupatenOptions as $kabupaten)
                  <option value="{{ $kabupaten }}" {{ $currentKabTrafo == $kabupaten ? 'selected' : '' }}>{{ $kabupaten }}</option>
                @endforeach
              </select>
            </td>
          </tr>
          <tr>
            <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Provinsi</td>
            <td class="border p-2">
              <input id="provinsi_trafo" type="text" name="provinsi_trafo" value="Jambi" readonly class="w-full border p-1 rounded bg-gray-100">
            </td>
          </tr>
          <tr>
            <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Koordinat</td>
            <td class="border p-2">
              <input id="latitude_trafo" name="latitude_trafo" type="number" step="any" placeholder="Latitude (cth: -1.234567)" class="w-full border p-1 rounded mb-1" 
                     value="{{ old('latitude_trafo', $trafoData['latitude_trafo'] ?? '') }}">
              <input id="longitude_trafo" name="longitude_trafo" type="number" step="any" placeholder="Longitude (cth: 103.456789)" class="w-full border p-1 rounded" 
                     value="{{ old('longitude_trafo', $trafoData['longitude_trafo'] ?? '') }}">
            </td>
          </tr>
          <tr>
            <td class="border p-2 font-semibold bg-gray-50 sticky left-0">Tahun Operasi</td>
            <td class="border p-2">
              <input id="tahun_operasi_trafo" name="tahun_operasi_trafo" type="text" class="w-full border p-1 rounded" 
                     value="{{ old('tahun_operasi_trafo', $trafoData['tahun_operasi_trafo'] ?? '') }}">
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Upload Lampiran -->
    <div class="mt-6">
      <label class="block text-sm font-medium text-gray-700 dark:text-white mb-1">Upload Lampiran Tagihan Listrik</label>
      <input id="lampiran_tagihan_listrik" name="lampiran_tagihan_listrik" type="file" accept=".pdf" class="border border-gray-300 p-2 rounded w-full" onchange="previewFile(this)">
      <small class="text-gray-500">Format PDF Maks 5MB</small>
      @if($pengajuan->lampiran_tagihan_listrik)
        <p class="text-sm text-gray-600 mt-2">
          File saat ini: 
          <a href="{{ route('lampiran.show', $pengajuan->lampiran_tagihan_listrik) }}" 
             class="text-blue-600 hover:text-blue-800" target="_blank">
            {{ $pengajuan->lampiran_tagihan_listrik }}
          </a>
        </p>
      @endif
    </div>
    <div id="preview_lampiran_tagihan_listrik"></div>
  </div>

  <div class="flex justify-between mt-4">
    <button type="button" onclick="goToPrevPage()" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-green-500">Kembali</button>
    <button type="button" onclick="goToNextPage()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Selanjutnya</button>
  </div>
</div>

<!-- Page 3: CAPACITY TABLES & EXCESS POWER -->
<div id="page3" class="page hidden">

  <!-- Container Tabel Kapasitas -->
  <div id="kapasitasContainer" class="mt-6">
    @php
      $pemakaianSendiri = is_array($pengajuan->pemakaian_sendiri) ? $pengajuan->pemakaian_sendiri : [];
    @endphp
    @if(!empty($pemakaianSendiri))
      @foreach($pemakaianSendiri as $jenisKey => $jenisData)
        @php
          $jenis = str_replace('_', ' ', $jenisKey);
          $jenis = ucwords($jenis);
        @endphp
        <div class="mb-6">
          <h3 class="text-lg font-bold uppercase mt-6 pb-2 text-gray-700 dark:text-white">
            Kapasitas Produksi Tenaga Listrik Pemakaian Sendiri ({{ $jenis }})
          </h3>
          <div class="overflow-x-auto">
            <table id="energiTable_{{ $jenisKey }}" class="min-w-full border border-gray-300 text-sm">
              <thead>
                <tr>
                  <th class="border border-gray-300 p-2 bg-gray-100">Bulan</th>
                  <th class="border border-gray-300 p-2 bg-gray-100">Total Kapasitas Pembangkit (kW)</th>
                  <th class="border border-gray-300 p-2 bg-gray-100">Faktor Daya (Cos φ)</th>
                  <th class="border border-gray-300 p-2 bg-gray-100">Jam Nyala (Jam)</th>
                  <th class="border border-gray-300 p-2 bg-gray-100">Daya Terpakai (kWh)</th>
                </tr>
              </thead>
              <tbody id="body_energiTable_{{ $jenisKey }}">
                @php
                  $bulanList = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                               'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                @endphp
                @foreach($bulanList as $bulan)
                  <tr>
                    <td class="border p-2">{{ $bulan }}</td>
                    <td class="border p-2">
                      <input type="text" name="pemakaian_sendiri[{{ $jenisKey }}][{{ $bulan }}][kapasitas]" class="w-full border p-1 rounded" 
                             value="{{ old("pemakaian_sendiri.$jenisKey.$bulan.kapasitas", $jenisData[$bulan]['kapasitas'] ?? '') }}" required>
                    </td>
                    <td class="border p-2">
                      <input type="text" name="pemakaian_sendiri[{{ $jenisKey }}][{{ $bulan }}][faktor_daya]" class="w-full border p-1 rounded" 
                             value="{{ old("pemakaian_sendiri.$jenisKey.$bulan.faktor_daya", $jenisData[$bulan]['faktor_daya'] ?? '') }}" required>
                    </td>
                    <td class="border p-2">
                      <input type="text" name="pemakaian_sendiri[{{ $jenisKey }}][{{ $bulan }}][jam_nyala]" class="w-full border p-1 rounded" 
                             value="{{ old("pemakaian_sendiri.$jenisKey.$bulan.jam_nyala", $jenisData[$bulan]['jam_nyala'] ?? '') }}" required>
                    </td>
                    <td class="border p-2">
                      <input type="text" name="pemakaian_sendiri[{{ $jenisKey }}][{{ $bulan }}][daya_terpakai]" class="w-full border p-1 rounded" 
                             value="{{ old("pemakaian_sendiri.$jenisKey.$bulan.daya_terpakai", $jenisData[$bulan]['daya_terpakai'] ?? '') }}" required>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      @endforeach
    @endif
  </div>

  <div class="mt-6">
    <label for="excessPowerDropdown" class="block text-sm font-medium text-gray-700">
      Apakah ada penjualan kelebihan tenaga listrik?
    </label>
    <select name="penjualan_listrik" id="excessPowerDropdown" class="mt-1 block w-full p-2 border rounded-md" onchange="toggleExcessPowerTable()" required>
      <option value="" disabled hidden>Pilih</option>
      @php $currentPenjualan = old('penjualan_listrik', $pengajuan->penjualan_listrik); @endphp
      <option value="yes" {{ $currentPenjualan == 'yes' ? 'selected' : '' }}>Ada</option>
      <option value="no" {{ $currentPenjualan == 'no' ? 'selected' : '' }}>Tidak</option>
    </select>
  </div>

  <!-- Section Tabel -->
  <div class="mt-6 {{ $currentPenjualan != 'yes' ? 'hidden' : '' }}" id="excessPowerSection">
    <h3 class="text-lg font-bold uppercase mt-6 pb-2 text-gray-700 dark:text-white">
      Penjualan Kelebihan Tenaga Listrik (Excess Power)
    </h3>
    <div class="overflow-x-auto">
      <table id="excessPowerTable" name="data_penjualan" class="min-w-full border border-gray-300 text-sm">
        <thead>
          <tr class="bg-gray-100">
            <th class="border p-2">Bulan</th>
            <th class="border p-2">DMN/NDC</th>
            <th class="border p-2">Beban Tertinggi (MW)</th>
            <th class="border p-2">Capacity Factor (%)</th>
            <th class="border p-2">AFpm (%)</th>
            <th class="border p-2">AFa (%)</th>
            <th class="border p-2">Pembelian (MWh)</th>
            <th class="border p-2">Produksi Bruto (MWh)</th>
            <th class="border p-2">Pemakaian Sendiri (MWh)</th>
            <th class="border p-2">Produksi Netto (MWh)</th>
          </tr>
        </thead>
        <tbody id="excessPowerTableBody">
          @if($currentPenjualan == 'yes' && !empty($pengajuan->excess_power))
            @php
              $excessPowerData = is_array($pengajuan->excess_power) ? $pengajuan->excess_power : [];
              $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            @endphp
            @foreach($months as $index => $month)
              <tr>
                <td class="border p-1">{{ $month }}</td>
                <td class="border p-1"><input type="text" name="excess_power[{{ $index }}][dmn_ndc]" class="w-full border rounded px-1 py-0.5" 
                                             value="{{ old("excess_power.$index.dmn_ndc", $excessPowerData[$index]['dmn_ndc'] ?? '') }}" /></td>
                <td class="border p-1"><input type="text" name="excess_power[{{ $index }}][beban_tertinggi]" class="w-full border rounded px-1 py-0.5" 
                                             value="{{ old("excess_power.$index.beban_tertinggi", $excessPowerData[$index]['beban_tertinggi'] ?? '') }}" /></td>
                <td class="border p-1"><input type="text" name="excess_power[{{ $index }}][capacity_factor]" class="w-full border rounded px-1 py-0.5" 
                                             value="{{ old("excess_power.$index.capacity_factor", $excessPowerData[$index]['capacity_factor'] ?? '') }}" /></td>
                <td class="border p-1"><input type="text" name="excess_power[{{ $index }}][afpm]" class="w-full border rounded px-1 py-0.5" 
                                             value="{{ old("excess_power.$index.afpm", $excessPowerData[$index]['afpm'] ?? '') }}" /></td>
                <td class="border p-1"><input type="text" name="excess_power[{{ $index }}][afa]" class="w-full border rounded px-1 py-0.5" 
                                             value="{{ old("excess_power.$index.afa", $excessPowerData[$index]['afa'] ?? '') }}" /></td>
                <td class="border p-1"><input type="text" name="excess_power[{{ $index }}][pembelian]" class="w-full border rounded px-1 py-0.5" 
                                             value="{{ old("excess_power.$index.pembelian", $excessPowerData[$index]['pembelian'] ?? '') }}" /></td>
                <td class="border p-1"><input type="text" name="excess_power[{{ $index }}][produksi_bruto]" class="w-full border rounded px-1 py-0.5" 
                                             value="{{ old("excess_power.$index.produksi_bruto", $excessPowerData[$index]['produksi_bruto'] ?? '') }}" /></td>
                <td class="border p-1"><input type="text" name="excess_power[{{ $index }}][pemakaian_sendiri]" class="w-full border rounded px-1 py-0.5" 
                                             value="{{ old("excess_power.$index.pemakaian_sendiri", $excessPowerData[$index]['pemakaian_sendiri'] ?? '') }}" /></td>
                <td class="border p-1"><input type="text" name="excess_power[{{ $index }}][produksi_netto]" class="w-full border rounded px-1 py-0.5" 
                                             value="{{ old("excess_power.$index.produksi_netto", $excessPowerData[$index]['produksi_netto'] ?? '') }}" /></td>
              </tr>
            @endforeach
          @endif
        </tbody>
      </table>
    </div>
    <p class="text-xs mt-2 text-gray-600">
      *) Hanya diisi jika terdapat penjualan kelebihan daya listrik.
    </p>
  </div>

  <!-- CHECKBOX -->
  <label class="inline-block my-4 font-bold text-m text-slate-700 dark:text-white">
    <input type="checkbox" class="form-checkbox" id="checkbox_akhir" name="checkbox" value="1" 
           {{ old('checkbox', $pengajuan->checkbox) ? 'checked' : '' }}>
    <span class="ml-2 text-m">Dengan ini menyatakan bahwa saya bertanggung jawab sepenuhnya atas data yang telah disampaikan.
      Apabila dikemudian hari ditemukan bahwa data tersebut tidak benar dan mengakibatkan konsekuensi hukum,
      maka saya atau Badan Usaha / Instansi yang saya wakili bersedia menerima segala bentuk sanksi sesuai dengan ketentuan peraturan perundang-undangan yang berlaku.
    </span>
  </label>

  <div class="flex justify-between mt-4">
    <button type="button" onclick="goToPrevPage()" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">Kembali</button>
    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Update Pengajuan</button>
  </div>
</div>
