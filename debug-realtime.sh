#!/bin/bash

LOG_FILE="/Users/kodrat/Downloads/test - Copy/storage/logs/laravel.log"

echo "🔍 Monitoring bug field hilang di controller update - Real Time..."
echo "📂 Log file: $LOG_FILE"
echo "🕒 Started at: $(date)"
echo ""

# Monitor specific patterns related to field loss
tail -f "$LOG_FILE" | while read line; do
    # Color coding for different log types
    if [[ $line == *"📥 RAW REQUEST DATA"* ]]; then
        echo -e "\033[1;34m$line\033[0m"  # Blue for raw request
    elif [[ $line == *"🎯 SPECIFIC FIELD DEBUG"* ]]; then
        echo -e "\033[1;33m$line\033[0m"  # Yellow for field debug
    elif [[ $line == *"🔧 PROCESSING"* ]] || [[ $line == *"⚙️ PROCESSING"* ]] || [[ $line == *"⚡ PROCESSING"* ]] || [[ $line == *"🔌 PROCESSING"* ]]; then
        echo -e "\033[1;36m$line\033[0m"  # Cyan for processing
    elif [[ $line == *"✅"* ]] || [[ $line == *"will be updated"* ]]; then
        echo -e "\033[1;32m$line\033[0m"  # Green for success
    elif [[ $line == *"⚠️"* ]] || [[ $line == *"empty after processing"* ]] || [[ $line == *"preserved"* ]]; then
        echo -e "\033[1;31m$line\033[0m"  # Red for warnings
    elif [[ $line == *"AFTER UPDATE"* ]] || [[ $line == *"Verifying data"* ]]; then
        echo -e "\033[1;35m$line\033[0m"  # Magenta for after update
    elif [[ $line == *"tanggal_terbit"* ]] || [[ $line == *"tanggal_masa_berlaku"* ]] || [[ $line == *"jenis_pembangkit_value"* ]] || [[ $line == *"lokasi_value"* ]] || [[ $line == *"latitude_value"* ]] || [[ $line == *"longitude_value"* ]]; then
        echo -e "\033[1;37;41m$line\033[0m"  # White on red background for problematic fields
    elif [[ $line == *"pengajuan"* ]] && ([[ $line == *"update"* ]] || [[ $line == *"UPDATE"* ]]); then
        echo -e "\033[1;37m$line\033[0m"  # White for general updates
    else
        echo "$line"  # Normal color for other logs
    fi
done
