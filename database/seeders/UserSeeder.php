<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Kadis (Kepala Dinas)
        User::create([
            'name' => 'Dr. Budi Santoso',
            'email' => 'kadis@esdm.go.id',
            'password' => Hash::make('password123'),
            'role_pengguna' => 'kadis',
            'pangkat' => 'Pembina Utama Muda'
        ]);

        // 2. Kabid (Kepala Bidang)
        User::create([
            'name' => 'Ir. Siti Nurhaliza, M.T.',
            'email' => 'kabid@esdm.go.id',
            'password' => Hash::make('password123'),
            'role_pengguna' => 'kabid',
            'pangkat' => 'Pembina Tk. I'
        ]);

        // 3. Evaluator 1
        User::create([
            'name' => 'Ahmad Fauzi, S.T.',
            'email' => 'evaluator1@esdm.go.id',
            'password' => Hash::make('password123'),
            'role_pengguna' => 'evaluator',
            'pangkat' => 'Penata Muda Tk. I'
        ]);

        // 4. Evaluator 2
        User::create([
            'name' => 'Dewi Kartika, S.T., M.T.',
            'email' => 'evaluator2@esdm.go.id',
            'password' => Hash::make('password123'),
            'role_pengguna' => 'evaluator',
            'pangkat' => 'Penata'
        ]);

        // 5. Pengguna (Badan Usaha) 1
        User::create([
            'name' => 'PT Energi Nusantara',
            'email' => 'admin@energinusantara.co.id',
            'password' => Hash::make('password123'),
            'role_pengguna' => 'pengguna',
            'pangkat' => null
        ]);

        // 6. Pengguna (Badan Usaha) 2
        User::create([
            'name' => 'PT Listrik Mandiri',
            'email' => 'admin@listrikmandiri.co.id',
            'password' => Hash::make('password123'),
            'role_pengguna' => 'pengguna',
            'pangkat' => null
        ]);

        // 7. Pengguna (Badan Usaha) 3
        User::create([
            'name' => 'CV Solar Power Indonesia',
            'email' => 'admin@solarpowerid.co.id',
            'password' => Hash::make('password123'),
            'role_pengguna' => 'pengguna',
            'pangkat' => null
        ]);

        // 8. User untuk testing
        User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'role_pengguna' => 'pengguna',
            'pangkat' => null
        ]);
    }
}
