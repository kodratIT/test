<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class KepalaBidang extends Model
{
    use HasFactory;

    protected $table = 'kepala_bidang';

    protected $fillable = [
        'nama',
        'pangkat',
        'email',
        'password',
        'peran',
    ];

    protected $hidden = [
        'password',
    ];
}
