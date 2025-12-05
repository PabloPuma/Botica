@echo off
set TIMESTAMP=%date:~-4,4%%date:~-7,2%%date:~-10,2%_%time:~0,2%%time:~3,2%%time:~6,2%
set TIMESTAMP=%TIMESTAMP: =0%
set BACKUP_DIR=c:\xampp\htdocs\dashboard\Botica\backups
set DB_USER=root
set DB_PASS=
set DB_NAME=botica

if not exist %BACKUP_DIR% mkdir %BACKUP_DIR%

echo [INFO] Realizando backup de base de datos %DB_NAME%...
c:\xampp\mysql\bin\mysqldump -u %DB_USER% %DB_NAME% > %BACKUP_DIR%\backup_%DB_NAME%_%TIMESTAMP%.sql

if %ERRORLEVEL% EQU 0 (
    echo [SUCCESS] Backup creado en %BACKUP_DIR%\backup_%DB_NAME%_%TIMESTAMP%.sql
) else (
    echo [ERROR] Fallo al crear backup.
)
