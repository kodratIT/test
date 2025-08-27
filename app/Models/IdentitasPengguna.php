<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IdentitasPengguna extends Model
{
    use HasFactory;

    protected $table = 'identitas_pengguna';

    protected $fillable = [
        'pengguna_id',
        'nama',
        'email',
        'namabadanusaha',
        'nib',
        'email_perusahaan',
        'alamatkantorpusat',
        'notelpkantorpusat',
        'alamatkantorcabang',
        'notelpkantorcabang',
        'contact_person_nama',
        'contact_person_jabatan',
        'contact_person_email',
        'contact_person_no_telp'
    ];

    // Relasi ke User
    public function pengguna()
    {
        return $this->belongsTo(User::class, 'pengguna_id');
    }
}
