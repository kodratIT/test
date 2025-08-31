<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Jalankan seeders dalam urutan yang benar
        $this->call([
            UserSeeder::class,
            IdentitasPenggunaSeeder::class,
            IdentitasTimAdminSeeder::class,
            KepalaBidangSeeder::class,
            PengajuanSeeder::class,
            EvaluasiPengajuanSeeder::class,
        ]);
        
        $this->command->info('🎉 Database seeding completed successfully!');
        $this->command->info('📧 Login credentials:');
        $this->command->info('👨‍💼 Kadis: kadis@esdm.go.id / password123');
        $this->command->info('👩‍💼 Kabid: kabid@esdm.go.id / password123');
        $this->command->info('🔍 Evaluator 1: evaluator1@esdm.go.id / password123');
        $this->command->info('🔍 Evaluator 2: evaluator2@esdm.go.id / password123');
        $this->command->info('🏢 PT Energi Nusantara: admin@energinusantara.co.id / password123');
        $this->command->info('🏭 PT Listrik Mandiri: admin@listrikmandiri.co.id / password123');
        $this->command->info('☀️ CV Solar Power: admin@solarpowerid.co.id / password123');
        $this->command->info('🧪 Test User: test@example.com / password');
    }
}
