#!/bin/bash

# Debug Monitor untuk Data Corruption Issue
# Usage: ./debug-monitor.sh

echo "🔍 DEBUGGING DATA CORRUPTION ISSUE"
echo "=================================="
echo ""

# Function untuk monitoring logs
monitor_logs() {
    echo "📊 Starting real-time log monitoring..."
    echo "Press Ctrl+C to stop monitoring"
    echo ""
    
    tail -f storage/logs/laravel.log | grep -E "(BEFORE UPDATE|PROCESSING|will be updated|preserved|AFTER UPDATE|Data integrity issues)" --color=always
}

# Function untuk cek data specific pengajuan
check_pengajuan_data() {
    local pengajuan_id=$1
    if [ -z "$pengajuan_id" ]; then
        echo "❌ Usage: check_pengajuan_data <pengajuan_id>"
        return 1
    fi
    
    echo "🔍 Checking data for Pengajuan ID: $pengajuan_id"
    echo "============================================="
    
    php artisan tinker --execute="
    \$p = App\Models\Pengajuan::find($pengajuan_id);
    if (!\$p) {
        echo 'Pengajuan not found';
        exit;
    }
    
    echo '=== SKTTK DATA ===' . PHP_EOL;
    if (is_array(\$p->skttk) && !empty(\$p->skttk)) {
        foreach (\$p->skttk as \$i => \$skttk) {
            echo \"SKTTK \$i:\" . PHP_EOL;
            echo '  - Nomor: ' . (\$skttk['nomor_sertifikat_skttk'] ?? 'NULL') . PHP_EOL;
            echo '  - Tanggal Terbit: ' . (\$skttk['tanggal_terbit_skttk'] ?? 'NULL') . PHP_EOL;
            echo '  - Masa Berlaku: ' . (\$skttk['tanggal_masa_berlaku_skttk'] ?? 'NULL') . PHP_EOL;
        }
    } else {
        echo 'SKTTK: NULL or empty' . PHP_EOL;
    }
    
    echo PHP_EOL . '=== MESIN DATA ===' . PHP_EOL;
    if (is_array(\$p->mesin) && !empty(\$p->mesin)) {
        foreach (\$p->mesin as \$i => \$mesin) {
            echo \"Mesin \$i:\" . PHP_EOL;
            echo '  - Jenis Penggerak: ' . (\$mesin['jenis_penggerak'] ?? 'NULL') . PHP_EOL;
            echo '  - Jenis Pembangkit: ' . (\$mesin['jenis_pembangkit'] ?? 'NULL') . PHP_EOL;
        }
    } else {
        echo 'MESIN: NULL or empty' . PHP_EOL;
    }
    
    echo PHP_EOL . '=== GENERATOR DATA ===' . PHP_EOL;
    if (is_array(\$p->generator) && !empty(\$p->generator)) {
        foreach (\$p->generator as \$i => \$gen) {
            echo \"Generator \$i:\" . PHP_EOL;
            echo '  - Merk/Tipe: ' . (\$gen['generator_merk_tipe'] ?? 'NULL') . PHP_EOL;
            echo '  - Lokasi: ' . (\$gen['generator_lokasi'] ?? 'NULL') . PHP_EOL;
            echo '  - Latitude: ' . (\$gen['generator_latitude'] ?? 'NULL') . PHP_EOL;
            echo '  - Longitude: ' . (\$gen['generator_longitude'] ?? 'NULL') . PHP_EOL;
        }
    } else {
        echo 'GENERATOR: NULL or empty' . PHP_EOL;
    }
    
    echo PHP_EOL . '=== DISTRIBUSI DATA ===' . PHP_EOL;
    if (\$p->distribusi) {
        echo 'Jaringan Distribusi: ' . (isset(\$p->distribusi['jaringan_distribusi']) ? 'EXISTS' : 'NULL') . PHP_EOL;
        if (isset(\$p->distribusi['trafo'])) {
            echo 'Trafo Data:' . PHP_EOL;
            echo '  - Kabupaten/Kota: ' . (\$p->distribusi['trafo']['kabupaten_kota_trafo'] ?? 'NULL') . PHP_EOL;
            echo '  - Latitude: ' . (\$p->distribusi['trafo']['latitude_trafo'] ?? 'NULL') . PHP_EOL;
            echo '  - Longitude: ' . (\$p->distribusi['trafo']['longitude_trafo'] ?? 'NULL') . PHP_EOL;
        } else {
            echo 'Trafo: NULL' . PHP_EOL;
        }
    } else {
        echo 'DISTRIBUSI: NULL' . PHP_EOL;
    }
    "
}

# Function untuk filter logs specific pengajuan
filter_pengajuan_logs() {
    local pengajuan_id=$1
    if [ -z "$pengajuan_id" ]; then
        echo "❌ Usage: filter_pengajuan_logs <pengajuan_id>"
        return 1
    fi
    
    echo "📋 Filtering logs for Pengajuan ID: $pengajuan_id"
    echo "============================================="
    
    grep "pengajuan $pengajuan_id" storage/logs/laravel.log | tail -50
}

# Function untuk test data integrity
test_data_integrity() {
    echo "🧪 Testing data integrity for recent updates..."
    echo "============================================="
    
    php artisan tinker --execute="
    \$recent = App\Models\Pengajuan::where('updated_at', '>=', now()->subHours(2))->get();
    echo 'Found ' . \$recent->count() . ' recently updated pengajuan' . PHP_EOL;
    
    foreach (\$recent as \$p) {
        echo PHP_EOL . '--- Pengajuan ID: ' . \$p->id . ' (Status: ' . \$p->status . ') ---' . PHP_EOL;
        
        // Check SKTTK
        if (is_array(\$p->skttk) && !empty(\$p->skttk)) {
            \$empty_skttk = 0;
            foreach (\$p->skttk as \$skttk) {
                if (empty(\$skttk['tanggal_terbit_skttk']) || empty(\$skttk['tanggal_masa_berlaku_skttk'])) {
                    \$empty_skttk++;
                }
            }
            echo 'SKTTK: ' . count(\$p->skttk) . ' items, ' . \$empty_skttk . ' with missing dates' . PHP_EOL;
        } else {
            echo 'SKTTK: NULL/Empty ❌' . PHP_EOL;
        }
        
        // Check Mesin
        if (is_array(\$p->mesin) && !empty(\$p->mesin)) {
            \$empty_mesin = 0;
            foreach (\$p->mesin as \$mesin) {
                if (empty(\$mesin['jenis_pembangkit'])) {
                    \$empty_mesin++;
                }
            }
            echo 'MESIN: ' . count(\$p->mesin) . ' items, ' . \$empty_mesin . ' with missing jenis_pembangkit' . PHP_EOL;
        } else {
            echo 'MESIN: NULL/Empty ❌' . PHP_EOL;
        }
        
        // Check Generator
        if (is_array(\$p->generator) && !empty(\$p->generator)) {
            \$empty_generator = 0;
            foreach (\$p->generator as \$gen) {
                if (empty(\$gen['generator_lokasi']) || empty(\$gen['generator_latitude']) || empty(\$gen['generator_longitude'])) {
                    \$empty_generator++;
                }
            }
            echo 'GENERATOR: ' . count(\$p->generator) . ' items, ' . \$empty_generator . ' with missing location data' . PHP_EOL;
        } else {
            echo 'GENERATOR: NULL/Empty ❌' . PHP_EOL;
        }
        
        // Check Distribusi
        if (\$p->distribusi && isset(\$p->distribusi['trafo'])) {
            \$trafo = \$p->distribusi['trafo'];
            if (empty(\$trafo['kabupaten_kota_trafo']) || empty(\$trafo['latitude_trafo']) || empty(\$trafo['longitude_trafo'])) {
                echo 'TRAFO: Missing location data ❌' . PHP_EOL;
            } else {
                echo 'TRAFO: Location data OK ✅' . PHP_EOL;
            }
        } else {
            echo 'DISTRIBUSI/TRAFO: NULL ❌' . PHP_EOL;
        }
    }
    "
}

# Main menu
case "$1" in
    "monitor")
        monitor_logs
        ;;
    "check")
        check_pengajuan_data $2
        ;;
    "logs")
        filter_pengajuan_logs $2
        ;;
    "test")
        test_data_integrity
        ;;
    *)
        echo "🛠️  DEBUG COMMANDS:"
        echo "=================="
        echo "  ./debug-monitor.sh monitor          # Monitor logs real-time"
        echo "  ./debug-monitor.sh check <ID>       # Check specific pengajuan data"
        echo "  ./debug-monitor.sh logs <ID>        # Show logs for specific pengajuan"
        echo "  ./debug-monitor.sh test             # Test data integrity"
        echo ""
        echo "📋 EXAMPLE USAGE:"
        echo "  ./debug-monitor.sh check 16         # Check pengajuan ID 16"
        echo "  ./debug-monitor.sh monitor          # Start real-time monitoring"
        echo ""
        exit 1
        ;;
esac
