<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\IdentitasPengguna;
use App\Models\User;

class IdentitasPenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil users dengan role pengguna
        $penggunaUsers = User::where('role_pengguna', 'pengguna')->get();

        foreach ($penggunaUsers as $index => $user) {
            $companies = [
                [
                    'nama' => 'Direktur Utama PT Energi Nusantara',
                    'namabadanusaha' => 'PT Energi Nusantara',
                    'nib' => '1234567890123456',
                    'email_perusahaan' => 'corporate@energinusantara.co.id',
                    'alamatkantorpusat' => 'Jl. Sudirman No. 123, Jakarta Pusat, DKI Jakarta 10220',
                    'notelpkantorpusat' => '021-12345678',
                    'alamatkantorcabang' => 'Jl. Diponegoro No. 456, Surabaya, Jawa Timur 60241',
                    'notelpkantorcabang' => '031-87654321',
                    'contact_person_nama' => 'Budi Prasetyo',
                    'contact_person_jabatan' => 'General Manager Operations',
                    'contact_person_email' => 'budi.prasetyo@energinusantara.co.id',
                    'contact_person_no_telp' => '08123456789'
                ],
                [
                    'nama' => 'Direktur PT Listrik Mandiri',
                    'namabadanusaha' => 'PT Listrik Mandiri',
                    'nib' => '2345678901234567',
                    'email_perusahaan' => 'info@listrikmandiri.co.id',
                    'alamatkantorpusat' => 'Jl. Gatot Subroto No. 789, Bandung, Jawa Barat 40263',
                    'notelpkantorpusat' => '022-98765432',
                    'alamatkantorcabang' => 'Jl. Malioboro No. 321, Yogyakarta, DIY 55213',
                    'notelpkantorcabang' => '0274-56789012',
                    'contact_person_nama' => 'Sari Indrawati',
                    'contact_person_jabatan' => 'Manager Engineering',
                    'contact_person_email' => 'sari.indrawati@listrikmandiri.co.id',
                    'contact_person_no_telp' => '08567890123'
                ],
                [
                    'nama' => 'Owner CV Solar Power Indonesia',
                    'namabadanusaha' => 'CV Solar Power Indonesia',
                    'nib' => '3456789012345678',
                    'email_perusahaan' => 'contact@solarpowerid.co.id',
                    'alamatkantorpusat' => 'Jl. Imam Bonjol No. 567, Medan, Sumatera Utara 20112',
                    'notelpkantorpusat' => '061-45678901',
                    'alamatkantorcabang' => 'Jl. Hayam Wuruk No. 234, Denpasar, Bali 80235',
                    'notelpkantorcabang' => '0361-23456789',
                    'contact_person_nama' => 'Agus Setiawan',
                    'contact_person_jabatan' => 'Technical Director',
                    'contact_person_email' => 'agus.setiawan@solarpowerid.co.id',
                    'contact_person_no_telp' => '08234567890'
                ],
                [
                    'nama' => 'Test User Company',
                    'namabadanusaha' => 'PT Test Berkala',
                    'nib' => '4567890123456789',
                    'email_perusahaan' => 'admin@testberkala.com',
                    'alamatkantorpusat' => 'Jl. Test No. 999, Jakarta Selatan, DKI Jakarta 12345',
                    'notelpkantorpusat' => '021-99999999',
                    'alamatkantorcabang' => 'Jl. Testing No. 888, Tangerang, Banten 15111',
                    'notelpkantorcabang' => '021-88888888',
                    'contact_person_nama' => 'Test Person',
                    'contact_person_jabatan' => 'Test Manager',
                    'contact_person_email' => 'test.person@testberkala.com',
                    'contact_person_no_telp' => '08999999999'
                ]
            ];

            if (isset($companies[$index])) {
                IdentitasPengguna::create(array_merge(
                    ['pengguna_id' => $user->id],
                    $companies[$index]
                ));
            }
        }
    }
}
