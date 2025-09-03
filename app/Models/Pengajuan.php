<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengajuan extends Model
{
    use HasFactory;

    protected $table = 'pengajuan';

    protected $fillable = [
        // Field baru
        'pengguna_id',
        'no_pengajuan',
        'status',
        'evaluator_id',

        // Field statis
        'nomor_izin_usaha',
        'tanggal_izin_usaha',
        'masa_berlaku_izin_usaha',
        'kelebihan_listrik',
        'lampiran_izin_usaha',

        'jenis_izin_lingkungan',
        'nomor_izin_lingkungan',
        'tanggal_izin_lingkungan',
        'masa_berlaku_izin_lingkungan',
        'lampiran_izin_lingkungan',

        'sambunganListrik',
        'lampiran_tagihan_listrik',

        // JSON dinamis (TANPA lampiran lagi)
        'slo',
        'skttk',
        'mesin',
        'generator',
        'distribusi',

        // Checkbox
        'pemakaian_sendiri',
        'checkbox',   // <── tambahkan di sini

        // Lampiran baru (keluar dari JSON)
        'lampiran_slo',
        'lampiran_skttk',
        'lampiran_nameplate_mesin',
        'lampiran_nameplate_generator',

        // Dropdown / opsional
        'penjualan_listrik',
        
        // Kabid approval fields
        'approved_by_kabid_at',
        'approved_by_kabid_id',
        'catatan_kabid',
        'rejected_by_kabid_at',
        'rejected_by_kabid_id',
        'alasan_penolakan',
        
        // Assignment tracking
        'assigned_at',
        'assigned_by',
        'reassigned_at',
        'reassigned_by',
        
        // Evaluation tracking
        'evaluated_at',
        'evaluator_recommendation',
        'evaluator_notes',
        
        // Section-specific revision notes
        'catatan_perbaikan_data_pemilik',
        'catatan_perbaikan_izin_usaha',
        'catatan_perbaikan_izin_lingkungan', 
        'catatan_perbaikan_slo',
        'catatan_perbaikan_skttk',
        'catatan_perbaikan_data_mesin',
        'catatan_perbaikan_data_generator',
        'catatan_perbaikan_sambungan_listrik',
        'catatan_perbaikan_kapasitas_produksi',
        'catatan_perbaikan_excess_power',
        
        // Document management
        'lembar_pengesahan_pdf',
        'nomor_pengesahan',
    ];


    protected $casts = [
        'tanggal_izin_usaha'           => 'date',
        'masa_berlaku_izin_usaha'      => 'date',
        'tanggal_izin_lingkungan'      => 'date',
        'masa_berlaku_izin_lingkungan' => 'date',

        'slo'           => 'array',
        'skttk'         => 'array',
        'mesin'         => 'array',
        'generator'     => 'array',
        'pemakaian_sendiri' => 'array',
        'distribusi'    => 'array',
        'penjualan_listrik' => 'array',

        // Field baru
        'pengguna_id'   => 'integer',
        'no_pengajuan'  => 'string',
        'status'        => 'string',

        // Checkbox (boolean)
        'checkbox'      => 'boolean',
        
        // Datetime fields untuk tracking assignment dan evaluation
        'assigned_at'   => 'datetime',
        'reassigned_at' => 'datetime',
        'evaluated_at'  => 'datetime',
        'approved_by_kabid_at' => 'datetime',
        'rejected_by_kabid_at' => 'datetime',
    ];

    // Helper untuk akses sub JSON
    public function getJaringanDistribusiAttribute()
    {
        $distribusi = is_array($this->distribusi) ? $this->distribusi : [];
        return $distribusi['jaringan_distribusi'] ?? [];
    }

    public function getTrafoAttribute()
    {
        $distribusi = is_array($this->distribusi) ? $this->distribusi : [];
        return $distribusi['trafo'] ?? null;
    }

    // Relasi ke User
    public function pengguna()
    {
        return $this->belongsTo(User::class, 'pengguna_id');
    }

    // app/Models/Pengajuan.php
    public function evaluator()
    {
        return $this->belongsTo(User::class, 'evaluator_id');
    }

    // Relasi ke EvaluasiPengajuan
    public function evaluasiPengajuan()
    {
        return $this->hasMany(EvaluasiPengajuan::class, 'pengajuan_id');
    }

    // Get current active evaluation
    public function currentEvaluation()
    {
        return $this->hasOne(EvaluasiPengajuan::class, 'pengajuan_id')
                    ->where('status', 'menunggu evaluasi')
                    ->latest();
    }
}
