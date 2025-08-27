<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdentitasTimAdmin extends Model
{
    use HasFactory;

    protected $table = 'identitas_tim_admin';

    protected $fillable = [
        'pengguna_id',
        'nip',
        'pangkat',
        'foto',
    ];

    // Relasi ke users
    public function user()
    {
        return $this->belongsTo(User::class, 'pengguna_id');
    }
}
