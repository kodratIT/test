<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\IdentitasPengguna;
use App\Models\IdentitasTimAdmin;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_pengguna',
        'pangkat'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ✅ Relasi ke IdentitasPengguna (dipakai di controller)
    public function identitas()
    {
        return $this->hasOne(IdentitasPengguna::class, 'pengguna_id', 'id');
    }

    public function identitasPengguna()
    {
        return $this->hasOne(IdentitasPengguna::class, 'pengguna_id');
    }

    // ✅ Relasi ke IdentitasTimAdmin
    public function identitasTimAdmin()
    {
        return $this->hasOne(IdentitasTimAdmin::class, 'pengguna_id', 'id');
    }

    

    // ✅ Cek apakah profil pengguna lengkap
    public function isProfileComplete(): bool
    {
        $identitas = $this->identitas;

        return $identitas
            && !empty($identitas->nama)
            && !empty($identitas->email)
            && !empty($identitas->namabadanusaha)
            && !empty($identitas->nib)
            && !empty($identitas->email_perusahaan)
            && !empty($identitas->alamatkantorpusat)
            && !empty($identitas->notelpkantorpusat)
            && !empty($identitas->alamatkantorcabang)
            && !empty($identitas->notelpkantorcabang)
            && !empty($identitas->contact_person_nama)
            && !empty($identitas->contact_person_jabatan)
            && !empty($identitas->contact_person_email)
            && !empty($identitas->contact_person_no_telp);
    }
}
