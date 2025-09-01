<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluasiPengajuan extends Model
{
    protected $table = 'evaluasi_pengajuan';
    protected $fillable = [
        'pengajuan_id', 
        'evaluator_id', 
        'status', 
        'catatan',
        'assigned_at',
        'assigned_by',
        'completed_at',
        'catatan_penugasan',
        'evaluation_days',
        'rating',
        'metadata'
    ];
    
    protected $casts = [
        'assigned_at' => 'datetime',
        'completed_at' => 'datetime',
        'metadata' => 'array',
        'rating' => 'decimal:1',
        'evaluation_days' => 'integer'
    ];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'pengajuan_id');
    }

    public function evaluator()
    {
        return $this->belongsTo(User::class, 'evaluator_id');
    }
}
