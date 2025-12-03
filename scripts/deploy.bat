@echo off
echo [INFO] Iniciando despliegue...

REM 1. Ejecutar Pruebas
echo [INFO] Ejecutando pruebas...
c:\xampp\php\php.exe tests/AuthTest.php
IF %ERRORLEVEL% NEQ 0 (
    echo [ERROR] Las pruebas fallaron. Cancelando despliegue.
    exit /b 1
)

REM 2. Backup (Simulado)
echo [INFO] Realizando backup preventivo...
call scripts\backup_db.bat

REM 3. Actualizar Código (Simulado - asumiendo git pull)
echo [INFO] Actualizando codigo...
git pull origin main

REM 4. Limpieza (Simulado)
echo [INFO] Limpiando cache...
REM del /q tmp\*.*

echo [SUCCESS] Despliegue completado exitosamente.
pause
