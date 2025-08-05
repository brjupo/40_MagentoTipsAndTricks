# Logs Backup And Rotation

Server is configured with America/Mexico_City TimeZone
Logs are compressed and saved daily
The script runs everyday ay 00:00:00
Compressed logs are deleted after 60 days

## Configure timezone at server

Listing all valid Timezones

> timedatectl list-timezones

Set Timezone as America/Mexico_City

> sudo timedatectl set-timezone America/Mexico_City

## Crontab -e

````bash
## Logs Backup a midnight 00:00:00
0 0 * * * /home/mag247/20_scripts/logs-backup.sh
# >> /home/mag247/20_scripts/cron_logs/logs-compress-delete.log 2>&1
````

## Script to compress and save logs. + Delete 60+ days logs

Directory changes for each server

````bash
#!/bin/bash

# === Configuration ===
LOG_DIR="/home/mag247/app/var/log"
ROTATION_DIR="$LOG_DIR/logs_rotation"
BACKUP_DIR="/shared/backups/logs_server01"
LOGFILE="/home/mag247/20_scripts/cron_logs/logs-compress-delete.log"
TIMESTAMP=$(date -d "yesterday" +%F)
ARCHIVE_NAME="logs_${TIMESTAMP}.tar.gz"

# Ensure directories exist
mkdir -p "$ROTATION_DIR"
mkdir -p "$BACKUP_DIR"
mkdir -p "$(dirname "$LOGFILE")"

  echo "==== Log rotation started: $(date) ===="

  # Move all *.log files to rotation directory
  echo "Moving logs to $ROTATION_DIR..."
  find "$LOG_DIR" -maxdepth 1 -type f -name "*.log" -exec mv {} "$ROTATION_DIR" \;

  # Compress rotated logs if any exist
  if [ "$(ls -A "$ROTATION_DIR")" ]; then
    echo "Compressing rotated logs..."
    tar -czf "$BACKUP_DIR/$ARCHIVE_NAME" -C "$ROTATION_DIR" .
    TAR_STATUS=$?

    if [ $TAR_STATUS -eq 0 ]; then
      echo "Compression successful: $ARCHIVE_NAME"

      # Delete logs from rotation directory
      echo "Deleting rotated log files..."
      rm -f "$ROTATION_DIR"/*
    else
      echo "Compression failed. Logs not deleted."
    fi
  else
    echo "No logs to rotate."
  fi

  # Cleanup old backups older than 60 days
  echo "Cleaning up compressed backups older than 60 days..."
  find "$BACKUP_DIR" -type f -name "logs_*.tar.gz" -mtime +60 -delete
  echo "Old backups cleaned up."

  echo "==== Log rotation finished: $(date) ===="
  echo ""
````

