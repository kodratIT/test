{{-- Form Edit Pengajuan - Struktur Nested Array yang Benar --}}
<form action="{{ route('pengajuan.update', $pengajuan->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    {{-- SKTTK Section --}}
    <div class="mb-6">
        <h3 class="text-lg font-bold mb-4">SKTTK (Sertifikat Kompetensi Tenaga Teknik Ketenagalistrikan)</h3>
        
        <div id="skttk-container">
            @php
                $skttkData = $pengajuan->skttk ?? [];
                $skttkCount = max(1, count($skttkData));
            @endphp
            
            @for($i = 0; $i < $skttkCount; $i++)
                <div class="skttk-item border rounded p-4 mb-4" data-index="{{ $i }}">
                    <h4 class="font-semibold mb-3">SKTTK {{ $i + 1 }}</h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Nomor Sertifikat</label>
                            <input 
                                type="text" 
                                name="skttk[{{ $i }}][nomor_sertifikat]" 
                                value="{{ old('skttk.'.$i.'.nomor_sertifikat', $skttkData[$i]['nomor_sertifikat_skttk'] ?? '') }}"
                                class="w-full border p-2 rounded @error('skttk.'.$i.'.nomor_sertifikat') border-red-500 @enderror"
                            >
                            @error('skttk.'.$i.'.nomor_sertifikat')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium mb-1">Nama</label>
                            <input 
                                type="text" 
                                name="skttk[{{ $i }}][nama]" 
                                value="{{ old('skttk.'.$i.'.nama', $skttkData[$i]['nama_skttk'] ?? '') }}"
                                class="w-full border p-2 rounded @error('skttk.'.$i.'.nama') border-red-500 @enderror"
                            >
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium mb-1">Tanggal Terbit</label>
                            <input 
                                type="date" 
                                name="skttk[{{ $i }}][tanggal_terbit]" 
                                value="{{ old('skttk.'.$i.'.tanggal_terbit', $skttkData[$i]['tanggal_terbit_skttk'] ?? '') }}"
                                class="w-full border p-2 rounded @error('skttk.'.$i.'.tanggal_terbit') border-red-500 @enderror"
                            >
                            @error('skttk.'.$i.'.tanggal_terbit')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium mb-1">Tanggal Masa Berlaku</label>
                            <input 
                                type="date" 
                                name="skttk[{{ $i }}][tanggal_masa_berlaku]" 
                                value="{{ old('skttk.'.$i.'.tanggal_masa_berlaku', $skttkData[$i]['tanggal_masa_berlaku_skttk'] ?? '') }}"
                                class="w-full border p-2 rounded @error('skttk.'.$i.'.tanggal_masa_berlaku') border-red-500 @enderror"
                            >
                            @error('skttk.'.$i.'.tanggal_masa_berlaku')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            @endfor
        </div>
        
        <div class="flex gap-2">
            <button type="button" onclick="addSKTTK()" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Tambah SKTTK</button>
            <button type="button" onclick="removeSKTTK()" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Hapus SKTTK</button>
        </div>
    </div>

    {{-- Data Mesin Section --}}
    <div class="mb-6">
        <h3 class="text-lg font-bold mb-4">Data Mesin</h3>
        
        <div id="mesin-container">
            @php
                $mesinData = $pengajuan->mesin ?? [];
                $mesinCount = max(1, count($mesinData));
            @endphp
            
            @for($i = 0; $i < $mesinCount; $i++)
                <div class="mesin-item border rounded p-4 mb-4" data-index="{{ $i }}">
                    <h4 class="font-semibold mb-3">Mesin {{ $i + 1 }}</h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Jenis Penggerak</label>
                            <input 
                                type="text" 
                                name="mesin[{{ $i }}][jenis_penggerak]" 
                                value="{{ old('mesin.'.$i.'.jenis_penggerak', $mesinData[$i]['jenis_penggerak'] ?? '') }}"
                                class="w-full border p-2 rounded @error('mesin.'.$i.'.jenis_penggerak') border-red-500 @enderror"
                            >
                            @error('mesin.'.$i.'.jenis_penggerak')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium mb-1">Jenis Pembangkit</label>
                            <select 
                                name="mesin[{{ $i }}][jenis_pembangkit]" 
                                class="w-full border p-2 rounded @error('mesin.'.$i.'.jenis_pembangkit') border-red-500 @enderror"
                            >
                                <option value="">Pilih Jenis Pembangkit</option>
                                @php 
                                    $selectedPembangkit = old('mesin.'.$i.'.jenis_pembangkit', $mesinData[$i]['jenis_pembangkit'] ?? '');
                                    $options = ['PLTD', 'PLTBm', 'PLTMH', 'PLTU', 'PLTBg', 'PLTMG'];
                                @endphp
                                @foreach($options as $option)
                                    <option value="{{ $option }}" {{ $selectedPembangkit == $option ? 'selected' : '' }}>{{ $option }}</option>
                                @endforeach
                            </select>
                            @error('mesin.'.$i.'.jenis_pembangkit')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium mb-1">Merk/Tipe</label>
                            <input 
                                type="text" 
                                name="mesin[{{ $i }}][merk_tipe]" 
                                value="{{ old('mesin.'.$i.'.merk_tipe', $mesinData[$i]['mesin_merk_tipe'] ?? '') }}"
                                class="w-full border p-2 rounded"
                            >
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium mb-1">Kapasitas (kW)</label>
                            <input 
                                type="number" 
                                step="0.01"
                                name="mesin[{{ $i }}][kapasitas]" 
                                value="{{ old('mesin.'.$i.'.kapasitas', $mesinData[$i]['mesin_kapasitas'] ?? '') }}"
                                class="w-full border p-2 rounded"
                            >
                        </div>
                    </div>
                </div>
            @endfor
        </div>
        
        <div class="flex gap-2">
            <button type="button" onclick="addMesin()" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Tambah Mesin</button>
            <button type="button" onclick="removeMesin()" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Hapus Mesin</button>
        </div>
    </div>

    {{-- Generator Section --}}
    <div class="mb-6">
        <h3 class="text-lg font-bold mb-4">Data Generator</h3>
        
        <div id="generator-container">
            @php
                $generatorData = $pengajuan->generator ?? [];
                $generatorCount = max(1, count($generatorData));
            @endphp
            
            @for($i = 0; $i < $generatorCount; $i++)
                <div class="generator-item border rounded p-4 mb-4" data-index="{{ $i }}">
                    <h4 class="font-semibold mb-3">Generator {{ $i + 1 }}</h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Merk/Tipe</label>
                            <input 
                                type="text" 
                                name="generator[{{ $i }}][merk_tipe]" 
                                value="{{ old('generator.'.$i.'.merk_tipe', $generatorData[$i]['generator_merk_tipe'] ?? '') }}"
                                class="w-full border p-2 rounded"
                            >
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium mb-1">Kapasitas (kVA)</label>
                            <input 
                                type="number" 
                                step="0.01"
                                name="generator[{{ $i }}][kapasitas]" 
                                value="{{ old('generator.'.$i.'.kapasitas', $generatorData[$i]['generator_kapasitas'] ?? '') }}"
                                class="w-full border p-2 rounded"
                            >
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium mb-1">Lokasi (Kab/Kota)</label>
                            <select 
                                name="generator[{{ $i }}][lokasi]" 
                                class="w-full border p-2 rounded"
                            >
                                <option value="">Pilih Lokasi</option>
                                @php $selectedLokasi = old('generator.'.$i.'.lokasi', $generatorData[$i]['generator_lokasi'] ?? ''); @endphp
                                <option value="Kota Jambi" {{ $selectedLokasi == 'Kota Jambi' ? 'selected' : '' }}>Kota Jambi</option>
                                <option value="Kabupaten Muaro Jambi" {{ $selectedLokasi == 'Kabupaten Muaro Jambi' ? 'selected' : '' }}>Kabupaten Muaro Jambi</option>
                                <option value="Kabupaten Batanghari" {{ $selectedLokasi == 'Kabupaten Batanghari' ? 'selected' : '' }}>Kabupaten Batanghari</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium mb-1">Latitude</label>
                            <input 
                                type="number" 
                                step="any"
                                name="generator[{{ $i }}][latitude]" 
                                value="{{ old('generator.'.$i.'.latitude', $generatorData[$i]['generator_latitude'] ?? '') }}"
                                class="w-full border p-2 rounded"
                                placeholder="-1.234567"
                            >
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium mb-1">Longitude</label>
                            <input 
                                type="number" 
                                step="any"
                                name="generator[{{ $i }}][longitude]" 
                                value="{{ old('generator.'.$i.'.longitude', $generatorData[$i]['generator_longitude'] ?? '') }}"
                                class="w-full border p-2 rounded"
                                placeholder="103.456789"
                            >
                        </div>
                    </div>
                </div>
            @endfor
        </div>
        
        <div class="flex gap-2">
            <button type="button" onclick="addGenerator()" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Tambah Generator</button>
            <button type="button" onclick="removeGenerator()" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Hapus Generator</button>
        </div>
    </div>

    {{-- Jaringan Distribusi Section --}}
    <div class="mb-6">
        <h3 class="text-lg font-bold mb-4">Jaringan Distribusi</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Kabupaten/Kota</label>
                <select 
                    name="distribusi[kabupaten_kota]" 
                    class="w-full border p-2 rounded"
                >
                    <option value="">Pilih Kabupaten/Kota</option>
                    @php $selectedDistribusi = old('distribusi.kabupaten_kota', $pengajuan->distribusi['jaringan_distribusi'][0]['kabupaten_kota_distribusi'] ?? ''); @endphp
                    <option value="Kota Jambi" {{ $selectedDistribusi == 'Kota Jambi' ? 'selected' : '' }}>Kota Jambi</option>
                    <option value="Kabupaten Muaro Jambi" {{ $selectedDistribusi == 'Kabupaten Muaro Jambi' ? 'selected' : '' }}>Kabupaten Muaro Jambi</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1">Tegangan (kV)</label>
                <input 
                    type="number" 
                    step="0.01"
                    name="distribusi[tegangan]" 
                    value="{{ old('distribusi.tegangan', $pengajuan->distribusi['jaringan_distribusi'][0]['tegangan_distribusi'] ?? '') }}"
                    class="w-full border p-2 rounded"
                >
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1">Latitude</label>
                <input 
                    type="number" 
                    step="any"
                    name="distribusi[latitude]" 
                    value="{{ old('distribusi.latitude', $pengajuan->distribusi['jaringan_distribusi'][0]['latitude_distribusi'] ?? '') }}"
                    class="w-full border p-2 rounded"
                    placeholder="-1.234567"
                >
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1">Longitude</label>
                <input 
                    type="number" 
                    step="any"
                    name="distribusi[longitude]" 
                    value="{{ old('distribusi.longitude', $pengajuan->distribusi['jaringan_distribusi'][0]['longitude_distribusi'] ?? '') }}"
                    class="w-full border p-2 rounded"
                    placeholder="103.456789"
                >
            </div>
        </div>
    </div>

    {{-- Trafo Section --}}
    <div class="mb-6">
        <h3 class="text-lg font-bold mb-4">Data Trafo</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Kabupaten/Kota</label>
                <select 
                    name="trafo[kabupaten_kota]" 
                    class="w-full border p-2 rounded"
                >
                    <option value="">Pilih Kabupaten/Kota</option>
                    @php $selectedTrafo = old('trafo.kabupaten_kota', $pengajuan->distribusi['trafo']['kabupaten_kota_trafo'] ?? ''); @endphp
                    <option value="Kota Jambi" {{ $selectedTrafo == 'Kota Jambi' ? 'selected' : '' }}>Kota Jambi</option>
                    <option value="Kabupaten Muaro Jambi" {{ $selectedTrafo == 'Kabupaten Muaro Jambi' ? 'selected' : '' }}>Kabupaten Muaro Jambi</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1">Kapasitas (kVA)</label>
                <input 
                    type="number" 
                    step="0.01"
                    name="trafo[kapasitas]" 
                    value="{{ old('trafo.kapasitas', $pengajuan->distribusi['trafo']['kapasitas_daya_trafo'] ?? '') }}"
                    class="w-full border p-2 rounded"
                >
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1">Latitude</label>
                <input 
                    type="number" 
                    step="any"
                    name="trafo[latitude]" 
                    value="{{ old('trafo.latitude', $pengajuan->distribusi['trafo']['latitude_trafo'] ?? '') }}"
                    class="w-full border p-2 rounded"
                    placeholder="-1.234567"
                >
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1">Longitude</label>
                <input 
                    type="number" 
                    step="any"
                    name="trafo[longitude]" 
                    value="{{ old('trafo.longitude', $pengajuan->distribusi['trafo']['longitude_trafo'] ?? '') }}"
                    class="w-full border p-2 rounded"
                    placeholder="103.456789"
                >
            </div>
        </div>
    </div>

    <div class="flex justify-end gap-2">
        <a href="{{ route('daftarpengajuanpengguna') }}" class="px-6 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Batal</a>
        <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Update Pengajuan</button>
    </div>
</form>

<script>
let skttkIndex = {{ $skttkCount }};
let mesinIndex = {{ $mesinCount }};
let generatorIndex = {{ $generatorCount }};

function addSKTTK() {
    const container = document.getElementById('skttk-container');
    const template = `
        <div class="skttk-item border rounded p-4 mb-4" data-index="${skttkIndex}">
            <h4 class="font-semibold mb-3">SKTTK ${skttkIndex + 1}</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Nomor Sertifikat</label>
                    <input type="text" name="skttk[${skttkIndex}][nomor_sertifikat]" class="w-full border p-2 rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Nama</label>
                    <input type="text" name="skttk[${skttkIndex}][nama]" class="w-full border p-2 rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Tanggal Terbit</label>
                    <input type="date" name="skttk[${skttkIndex}][tanggal_terbit]" class="w-full border p-2 rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Tanggal Masa Berlaku</label>
                    <input type="date" name="skttk[${skttkIndex}][tanggal_masa_berlaku]" class="w-full border p-2 rounded">
                </div>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', template);
    skttkIndex++;
}

function removeSKTTK() {
    const container = document.getElementById('skttk-container');
    const items = container.querySelectorAll('.skttk-item');
    if (items.length > 1) {
        items[items.length - 1].remove();
        skttkIndex--;
    }
}

function addMesin() {
    const container = document.getElementById('mesin-container');
    const template = `
        <div class="mesin-item border rounded p-4 mb-4" data-index="${mesinIndex}">
            <h4 class="font-semibold mb-3">Mesin ${mesinIndex + 1}</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Jenis Penggerak</label>
                    <input type="text" name="mesin[${mesinIndex}][jenis_penggerak]" class="w-full border p-2 rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Jenis Pembangkit</label>
                    <select name="mesin[${mesinIndex}][jenis_pembangkit]" class="w-full border p-2 rounded">
                        <option value="">Pilih Jenis Pembangkit</option>
                        <option value="PLTD">PLTD</option>
                        <option value="PLTBm">PLTBm</option>
                        <option value="PLTMH">PLTMH</option>
                        <option value="PLTU">PLTU</option>
                        <option value="PLTBg">PLTBg</option>
                        <option value="PLTMG">PLTMG</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Merk/Tipe</label>
                    <input type="text" name="mesin[${mesinIndex}][merk_tipe]" class="w-full border p-2 rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Kapasitas (kW)</label>
                    <input type="number" step="0.01" name="mesin[${mesinIndex}][kapasitas]" class="w-full border p-2 rounded">
                </div>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', template);
    mesinIndex++;
}

function removeMesin() {
    const container = document.getElementById('mesin-container');
    const items = container.querySelectorAll('.mesin-item');
    if (items.length > 1) {
        items[items.length - 1].remove();
        mesinIndex--;
    }
}

function addGenerator() {
    const container = document.getElementById('generator-container');
    const template = `
        <div class="generator-item border rounded p-4 mb-4" data-index="${generatorIndex}">
            <h4 class="font-semibold mb-3">Generator ${generatorIndex + 1}</h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Merk/Tipe</label>
                    <input type="text" name="generator[${generatorIndex}][merk_tipe]" class="w-full border p-2 rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Kapasitas (kVA)</label>
                    <input type="number" step="0.01" name="generator[${generatorIndex}][kapasitas]" class="w-full border p-2 rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Lokasi (Kab/Kota)</label>
                    <select name="generator[${generatorIndex}][lokasi]" class="w-full border p-2 rounded">
                        <option value="">Pilih Lokasi</option>
                        <option value="Kota Jambi">Kota Jambi</option>
                        <option value="Kabupaten Muaro Jambi">Kabupaten Muaro Jambi</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Latitude</label>
                    <input type="number" step="any" name="generator[${generatorIndex}][latitude]" class="w-full border p-2 rounded" placeholder="-1.234567">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Longitude</label>
                    <input type="number" step="any" name="generator[${generatorIndex}][longitude]" class="w-full border p-2 rounded" placeholder="103.456789">
                </div>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', template);
    generatorIndex++;
}

function removeGenerator() {
    const container = document.getElementById('generator-container');
    const items = container.querySelectorAll('.generator-item');
    if (items.length > 1) {
        items[items.length - 1].remove();
        generatorIndex--;
    }
}
</script>
