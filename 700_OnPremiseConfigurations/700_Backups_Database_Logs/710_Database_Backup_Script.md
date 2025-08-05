# Database Backup

A script is executed in server 1, using ubuntu cron

## Database Backup Script

Located at:
> nano /shared/backups/database/backup_db.sh

```bash
#!/bin/bash

# === CONFIGURACIÓN ===
BACKUP_DIR="/shared/backups/database/"
DB_USER="myuser"
DB_HOST="0.0.0.3"
DB_NAME="my_db_name"
DB_P="my_db_pass"

# Crear carpeta si no existe
mkdir -p "$BACKUP_DIR"

# Ejecutar el backup con timestamp
mysqldump -u "$DB_USER" -p"$DB_P" -h "$DB_HOST" "$DB_NAME" | gzip > "$BACKUP_DIR/db_backup_$(date +%F.%H%M%S).sql.gz" 
```

## Crontab configuration

> crontab -e

```bash
## Database Backup at 3:00 am
0 3 * * * /mnt/shared/backups/database/backup_db.sh
```

