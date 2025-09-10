<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Pengajuan;

class PengajuanControllerFixed extends Controller
{
    /**
     * Update pengajuan dengan handling nested array yang benar
     */
    public function update(Request $request, $id)
    {
        try {
            $userId = Auth::id();
            $pengajuan = Pengajuan::where('id', $id)
                                ->where('pengguna_id', $userId)
                                ->firstOrFail();

            // Cek apakah pengajuan bisa diupdate
            $status = strtolower(trim($pengajuan->status));
            if (in_array($status, ['disetujui', 'ditolak'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pengajuan dengan status "' . ucfirst($status) . '" tidak dapat diubah.'
                ], 403);
            }

            // Validasi dengan struktur nested array yang benar
            $rules = [
                // Field statis
                'nomor_izin_usaha' => 'nullable|string|max:255',
                'kelebihan_listrik' => 'nullable|string|max:255',
                
                // SKTTK validasi
                'skttk' => 'nullable|array',
                'skttk.*.nomor_sertifikat' => 'nullable|string|max:255',
                'skttk.*.nama' => 'nullable|string|max:255',
                'skttk.*.tanggal_terbit' => 'nullable|date',
                'skttk.*.tanggal_masa_berlaku' => 'nullable|date|after_or_equal:skttk.*.tanggal_terbit',
                
                // Mesin validasi
                'mesin' => 'nullable|array',
                'mesin.*.jenis_penggerak' => 'nullable|string|max:255',
                'mesin.*.jenis_pembangkit' => 'nullable|string|in:PLTD,PLTBm,PLTMH,PLTU,PLTBg,PLTMG',
                'mesin.*.merk_tipe' => 'nullable|string|max:255',
                'mesin.*.kapasitas' => 'nullable|numeric|min:0',
                
                // Generator validasi
                'generator' => 'nullable|array',
                'generator.*.merk_tipe' => 'nullable|string|max:255',
                'generator.*.kapasitas' => 'nullable|numeric|min:0',
                'generator.*.lokasi' => 'nullable|string|max:255',
                'generator.*.latitude' => 'nullable|numeric|between:-90,90',
                'generator.*.longitude' => 'nullable|numeric|between:-180,180',
                
                // Distribusi validasi
                'distribusi' => 'nullable|array',
                'distribusi.kabupaten_kota' => 'nullable|string|max:255',
                'distribusi.tegangan' => 'nullable|numeric|min:0',
                'distribusi.latitude' => 'nullable|numeric|between:-90,90',
                'distribusi.longitude' => 'nullable|numeric|between:-180,180',
                
                // Trafo validasi
                'trafo' => 'nullable|array',
                'trafo.kabupaten_kota' => 'nullable|string|max:255',
                'trafo.kapasitas' => 'nullable|numeric|min:0',
                'trafo.latitude' => 'nullable|numeric|between:-90,90',
                'trafo.longitude' => 'nullable|numeric|between:-180,180',
                
                // File uploads
                'lampiran_skttk' => 'nullable|file|mimes:pdf|max:5120',
                'lampiran_nameplate_mesin' => 'nullable|file|mimes:pdf|max:5120',
                'lampiran_nameplate_generator' => 'nullable|file|mimes:pdf|max:5120',
            ];

            $request->validate($rules);

            // Log request data untuk debugging
            Log::info('UPDATE REQUEST DATA', [
                'pengajuan_id' => $id,
                'user_id' => $userId,
                'request_data' => $request->all()
            ]);

            // Mulai build data untuk update
            $updateData = [];

            // Field statis - hanya update jika ada data
            $staticFields = ['nomor_izin_usaha', 'kelebihan_listrik'];
            foreach ($staticFields as $field) {
                if ($request->filled($field)) {
                    $updateData[$field] = $request->input($field);
                }
            }

            // Handle SKTTK data
            if ($request->has('skttk') && is_array($request->skttk)) {
                $skttkData = $this->processNestedArrayData($request->skttk, [
                    'nomor_sertifikat' => 'nomor_sertifikat_skttk',
                    'nama' => 'nama_skttk',
                    'tanggal_terbit' => 'tanggal_terbit_skttk',
                    'tanggal_masa_berlaku' => 'tanggal_masa_berlaku_skttk'
                ]);
                
                if (!empty($skttkData)) {
                    $updateData['skttk'] = $skttkData;
                    Log::info('SKTTK data will be updated', ['data' => $skttkData]);
                }
            }

            // Handle Mesin data
            if ($request->has('mesin') && is_array($request->mesin)) {
                $mesinData = $this->processNestedArrayData($request->mesin, [
                    'jenis_penggerak' => 'jenis_penggerak',
                    'jenis_pembangkit' => 'jenis_pembangkit',
                    'merk_tipe' => 'mesin_merk_tipe',
                    'kapasitas' => 'mesin_kapasitas'
                ]);
                
                if (!empty($mesinData)) {
                    $updateData['mesin'] = $mesinData;
                    Log::info('Mesin data will be updated', ['data' => $mesinData]);
                }
            }

            // Handle Generator data
            if ($request->has('generator') && is_array($request->generator)) {
                $generatorData = $this->processNestedArrayData($request->generator, [
                    'merk_tipe' => 'generator_merk_tipe',
                    'kapasitas' => 'generator_kapasitas',
                    'lokasi' => 'generator_lokasi',
                    'latitude' => 'generator_latitude',
                    'longitude' => 'generator_longitude'
                ]);
                
                if (!empty($generatorData)) {
                    $updateData['generator'] = $generatorData;
                    Log::info('Generator data will be updated', ['data' => $generatorData]);
                }
            }

            // Handle Distribusi data
            if ($request->has('distribusi') && is_array($request->distribusi)) {
                $distribusiInput = $request->distribusi;
                if ($this->hasValidData($distribusiInput)) {
                    $updateData['distribusi'] = [
                        'jaringan_distribusi' => [[
                            'kabupaten_kota_distribusi' => $distribusiInput['kabupaten_kota'] ?? null,
                            'tegangan_distribusi' => $distribusiInput['tegangan'] ?? null,
                            'latitude_distribusi' => $distribusiInput['latitude'] ?? null,
                            'longitude_distribusi' => $distribusiInput['longitude'] ?? null,
                        ]],
                        'trafo' => $pengajuan->distribusi['trafo'] ?? [] // Preserve existing trafo data
                    ];
                    Log::info('Distribusi data will be updated', ['data' => $updateData['distribusi']]);
                }
            }

            // Handle Trafo data
            if ($request->has('trafo') && is_array($request->trafo)) {
                $trafoInput = $request->trafo;
                if ($this->hasValidData($trafoInput)) {
                    // Get existing distribusi or create empty structure
                    $existingDistribusi = $updateData['distribusi'] ?? $pengajuan->distribusi ?? ['jaringan_distribusi' => []];
                    
                    $existingDistribusi['trafo'] = [
                        'kabupaten_kota_trafo' => $trafoInput['kabupaten_kota'] ?? null,
                        'kapasitas_daya_trafo' => $trafoInput['kapasitas'] ?? null,
                        'latitude_trafo' => $trafoInput['latitude'] ?? null,
                        'longitude_trafo' => $trafoInput['longitude'] ?? null,
                    ];
                    
                    $updateData['distribusi'] = $existingDistribusi;
                    Log::info('Trafo data will be updated', ['data' => $existingDistribusi['trafo']]);
                }
            }

            // Handle file uploads
            $fileFields = [
                'lampiran_skttk' => 'lampiran_skttk',
                'lampiran_nameplate_mesin' => 'lampiran_nameplate_mesin',
                'lampiran_nameplate_generator' => 'lampiran_nameplate_generator',
            ];

            foreach ($fileFields as $requestField => $dbField) {
                if ($request->hasFile($requestField)) {
                    // Delete old file if exists
                    if ($pengajuan->$dbField) {
                        \Storage::delete($pengajuan->$dbField);
                    }
                    $updateData[$dbField] = $request->file($requestField)->store('uploads');
                    Log::info("File $requestField uploaded", ['path' => $updateData[$dbField]]);
                }
            }

            // Update status jika diperlukan
            if ($pengajuan->status === 'perbaikan') {
                $updateData['status'] = 'proses evaluasi';
            }

            // Log final update data
            Log::info('FINAL UPDATE DATA', [
                'pengajuan_id' => $id,
                'update_data_keys' => array_keys($updateData),
                'data_counts' => [
                    'skttk' => isset($updateData['skttk']) ? count($updateData['skttk']) : 'not_updated',
                    'mesin' => isset($updateData['mesin']) ? count($updateData['mesin']) : 'not_updated',
                    'generator' => isset($updateData['generator']) ? count($updateData['generator']) : 'not_updated',
                ]
            ]);

            // Perform update - hanya field yang ada di $updateData yang akan diupdate
            if (!empty($updateData)) {
                $pengajuan->update($updateData);
            }

            return response()->json([
                'success' => true,
                'message' => 'Pengajuan berhasil diperbarui.',
                'redirect' => route('daftarpengajuanpengguna')
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed', ['errors' => $e->errors()]);
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Update pengajuan failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui pengajuan.'
            ], 500);
        }
    }

    /**
     * Process nested array data dengan field mapping
     * 
     * @param array $inputData
     * @param array $fieldMap - mapping dari form field ke database field
     * @return array
     */
    private function processNestedArrayData(array $inputData, array $fieldMap): array
    {
        $processedData = [];
        
        foreach ($inputData as $index => $item) {
            if (!is_array($item)) continue;
            
            $processedItem = [];
            $hasValidData = false;
            
            foreach ($fieldMap as $inputField => $dbField) {
                $value = $item[$inputField] ?? null;
                
                // Convert empty strings to null
                if (is_string($value) && trim($value) === '') {
                    $value = null;
                }
                
                $processedItem[$dbField] = $value;
                
                // Check if this item has any valid data
                if (!is_null($value)) {
                    $hasValidData = true;
                }
            }
            
            // Only add item if it has valid data
            if ($hasValidData) {
                $processedData[] = $processedItem;
            }
        }
        
        return $processedData;
    }

    /**
     * Check if array has any valid (non-null, non-empty) data
     */
    private function hasValidData(array $data): bool
    {
        foreach ($data as $value) {
            if (!is_null($value) && (!is_string($value) || trim($value) !== '')) {
                return true;
            }
        }
        return false;
    }
}
