<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pengajuan;

class GenerateSeederFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seeder:generate-files {--force : Force regenerate existing files}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate missing seeder files for lampiran PDFs';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Generating seeder files for lampiran PDFs...');
        
        // Get all available PDF files to use as source
        $availableFiles = glob(storage_path('app/private/uploads/*.pdf'));
        $fileCount = count($availableFiles);
        
        if ($fileCount === 0) {
            $this->error('No source PDF files found in storage/app/private/uploads/');
            return 1;
        }
        
        $this->info("Found {$fileCount} source PDF files");
        
        // Create required directories
        $directories = [
            'izin_usaha',
            'izin_lingkungan', 
            'slo',
            'skttk',
            'nameplate_mesin',
            'nameplate_generator',
            'tagihan_listrik'
        ];
        
        foreach ($directories as $dir) {
            $path = storage_path("app/private/uploads/{$dir}");
            if (!is_dir($path)) {
                mkdir($path, 0755, true);
                $this->info("Created directory: {$dir}");
            }
        }
        
        // Get all pengajuan with lampiran fields
        $pengajuans = Pengajuan::whereNotNull('lampiran_izin_usaha')
            ->orWhereNotNull('lampiran_nameplate_generator')
            ->orWhereNotNull('lampiran_nameplate_mesin')
            ->orWhereNotNull('lampiran_slo')
            ->orWhereNotNull('lampiran_skttk')
            ->orWhereNotNull('lampiran_izin_lingkungan')
            ->orWhereNotNull('lampiran_tagihan_listrik')
            ->get();
        
        $lampiranFields = [
            'lampiran_izin_usaha',
            'lampiran_izin_lingkungan', 
            'lampiran_slo',
            'lampiran_skttk',
            'lampiran_nameplate_mesin',
            'lampiran_nameplate_generator',
            'lampiran_tagihan_listrik'
        ];
        
        $fileIndex = 0;
        $created = 0;
        $skipped = 0;
        
        foreach ($pengajuans as $pengajuan) {
            foreach ($lampiranFields as $field) {
                if ($pengajuan->$field) {
                    $targetPath = storage_path('app/private/' . $pengajuan->$field);
                    
                    if (!file_exists($targetPath) || $this->option('force')) {
                        $sourceFile = $availableFiles[$fileIndex % $fileCount];
                        
                        // Ensure target directory exists
                        $targetDir = dirname($targetPath);
                        if (!is_dir($targetDir)) {
                            mkdir($targetDir, 0755, true);
                        }
                        
                        if (copy($sourceFile, $targetPath)) {
                            $this->line("✅ Created: {$pengajuan->$field}");
                            $created++;
                        } else {
                            $this->error("❌ Failed to create: {$pengajuan->$field}");
                        }
                        
                        $fileIndex++;
                    } else {
                        $this->line("⏭️  Skipped: {$pengajuan->$field} (already exists)");
                        $skipped++;
                    }
                }
            }
        }
        
        $this->info("\nCompleted!");
        $this->table(
            ['Status', 'Count'],
            [
                ['Files Created', $created],
                ['Files Skipped', $skipped],
                ['Total Processed', $created + $skipped]
            ]
        );
        
        return 0;
    }
}
