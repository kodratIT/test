<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluasiPengajuan extends Model
{
    protected $table = 'evaluasi_pengajuan';
    protected $fillable = ['pengajuan_id', 'evaluator_id', 'status', 'catatan'];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'pengajuan_id');
    }

    public function evaluator()
    {
        return $this->belongsTo(User::class, 'evaluator_id');
    }
}
