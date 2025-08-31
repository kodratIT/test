<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\IdentitasTimAdmin;
use App\Models\User;

class IdentitasTimAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data untuk admin users (evaluator, kabid, kadis)
        $adminUsers = User::whereIn('role_pengguna', ['evaluator', 'kabid', 'kadis'])->get();

        $adminProfiles = [
            // Kadis
            [
                'nip' => '196512251990031001',
                'pangkat' => 'Pembina Utama Muda',
                'foto' => null
            ],
            // Kabid
            [
                'nip' => '197203151995032002',
                'pangkat' => 'Pembina Tk. I',
                'foto' => null
            ],
            // Evaluator 1
            [
                'nip' => '198405102008121001',
                'pangkat' => 'Penata Muda Tk. I',
                'foto' => null
            ],
            // Evaluator 2
            [
                'nip' => '198910152012032001',
                'pangkat' => 'Penata',
                'foto' => null
            ]
        ];

        foreach ($adminUsers as $index => $user) {
            if (isset($adminProfiles[$index])) {
                IdentitasTimAdmin::create(array_merge(
                    ['pengguna_id' => $user->id],
                    $adminProfiles[$index]
                ));
            }
        }
    }
}
