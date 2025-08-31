<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\KepalaBidang;
use App\Models\User;

class KepalaBidangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kabidUser = User::where('role_pengguna', 'kabid')->first();
        
        if ($kabidUser) {
            KepalaBidang::create([
                'nama' => $kabidUser->name,
                'pangkat' => $kabidUser->pangkat,
                'email' => $kabidUser->email,
                'password' => Hash::make('password123'),
                'peran' => 'Kepala Bidang Ketenagalistrikan'
            ]);
        }

        // Tambahan kepala bidang lain jika diperlukan
        KepalaBidang::create([
            'nama' => 'Ir. Bambang Sutrisno, M.T.',
            'pangkat' => 'Pembina',
            'email' => 'bambang.sutrisno@esdm.go.id',
            'password' => Hash::make('password123'),
            'peran' => 'Kepala Bidang Energi Baru Terbarukan'
        ]);
    }
}
