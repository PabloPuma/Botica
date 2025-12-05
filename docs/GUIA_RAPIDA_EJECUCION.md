# GUÍA RÁPIDA - CAPÍTULO 5: CÓMO EJECUTAR EL CÓDIGO

## 📋 RESUMEN EJECUTIVO

Este documento te muestra **exactamente cómo ejecutar cada script y verificar cada componente** del sistema.

---

## 🧪 5.1 PRUEBAS Y SEGURIDAD

### Ejecutar Pruebas Unitarias

**PowerShell/CMD:**

```powershell
cd c:\xampp\htdocs\dashboard\Botica
c:\xampp\php\php.exe tests\AuthTest.php
```

**Salida esperada:**

```
Running AuthController Tests...
✓ Register should fail with empty fields
✓ Password verification should work
Results: 2 passed, 0 failed
```

### Ver Reporte de Seguridad

**Abrir archivo:**

```
c:\xampp\htdocs\dashboard\Botica\docs\REPORTE_SEGURIDAD.md
```

**O desde navegador:**

```
file:///c:/xampp/htdocs/dashboard/Botica/docs/REPORTE_SEGURIDAD.md
```

---

## 🚀 5.2 DESPLIEGUE

### Despliegue Automático (RECOMENDADO)

**CMD:**

```cmd
cd c:\xampp\htdocs\dashboard\Botica
scripts\deploy.bat
```

**Qué hace:**

1. ✅ Ejecuta pruebas
2. 📦 Crea backup
3. 🔄 Actualiza código desde Git
4. ✅ Verifica que todo está funcionando

### Despliegue Manual (Paso a Paso)

**1. Ejecutar pruebas:**

```cmd
c:\xampp\php\php.exe tests\AuthTest.php
```

**2. Crear backup:**

```cmd
scripts\backup_db.bat
```

**3. Actualizar código:**

```cmd
git pull origin main
```

**4. Verificar aplicación:**

```
http://localhost/dashboard/Botica
```

---

## 📊 5.3 MONITOREO

### Health Check (Verificación de Salud)

**Desde navegador:**

```
http://localhost/dashboard/Botica/public/health.php
```

**Desde PowerShell:**

```powershell
Invoke-WebRequest -Uri "http://localhost/dashboard/Botica/public/health.php" | Select-Object -Expand Content
```

**Respuesta esperada:**

```json
{
    "status": "UP",
    "timestamp": "2025-12-03 19:45:00",
    "checks": {
        "database": {
            "status": "OK",
            "message": "Conexión exitosa"
        },
        "disk_space": {
            "status": "OK",
            "message": "45.3 GB libres (23.5% libre)"
        },
        "backups": {
            "status": "OK",
            "message": "Último backup hace 2.3 horas",
            "total_backups": 7
        },
        "logs": {
            "status": "OK",
            "message": "0 errores en la última hora"
        },
        "file_permissions": {
            "status": "OK",
            "message": "Permisos de escritura correctos"
        }
    },
    "info": {
        "php_version": "8.0.30",
        "server": "Apache/2.4.54 (Win64)"
    }
}
```

### Ver Logs en Dashboard

**1. Iniciar sesión como administrador:**

```
http://localhost/dashboard/Botica/?route=login
```

**2. Ir a Logs:**

```
http://localhost/dashboard/Botica/?route=admin/logs
```

**3. Aplicar filtros según necesites**

### Ver Logs de Apache

**Error Log (Desde PowerShell):**

```powershell
# Ver últimas 20 líneas
Get-Content c:\xampp\apache\logs\error.log -Tail 20

# Monitorear en tiempo real
Get-Content c:\xampp\apache\logs\error.log -Wait -Tail 10
```

---

## 🔧 5.4 MANTENIMIENTO

### Backup Manual de Base de Datos

**CMD:**

```cmd
cd c:\xampp\htdocs\dashboard\Botica
scripts\backup_db.bat
```

**Verificar backups creados:**

```cmd
dir c:\xampp\htdocs\dashboard\Botica\backups
```

### Limpieza Manual de Logs

**CMD:**

```cmd
cd c:\xampp\htdocs\dashboard\Botica
c:\xampp\php\php.exe scripts\cleanup_logs.php
```

**Salida esperada:**

```
[INFO] Iniciando limpieza de logs...
[SUCCESS] Se eliminaron 234 registros de logs antiguos.
```

### Restaurar Base de Datos desde Backup

**1. Identificar backup:**

```cmd
dir c:\xampp\htdocs\dashboard\Botica\backups
```

**2. Restaurar:**

```cmd
c:\xampp\mysql\bin\mysql -u root botica < c:\xampp\htdocs\dashboard\Botica\backups\backup_botica_20251204_202856.sql
```

**3. Verificar:**

```cmd
c:\xampp\mysql\bin\mysql -u root botica -e "SELECT COUNT(*) FROM usuarios;"
```

---

## ⏰ PROGRAMAR TAREAS AUTOMÁTICAS (Cron Jobs)

### Crear Tarea de Backup Diario

**1. Abrir Programador de Tareas:**

```
Win + R → taskschd.msc → Enter
```

**2. Crear tarea básica:**

- Nombre: `Backup Botica DB`
- Desencadenador: `Diariamente` a las `03:00 AM`
- Acción: `Iniciar un programa`
- Programa: `c:\xampp\htdocs\dashboard\Botica\scripts\backup_db.bat`

### Crear Tarea de Limpieza Mensual de Logs

**1. Crear tarea básica:**

- Nombre: `Limpieza Logs Botica`
- Desencadenador: `Mensualmente` → Día `1` → `02:00 AM`
- Acción: `Iniciar un programa`
- Programa: `c:\xampp\php\php.exe`
- Argumentos: `c:\xampp\htdocs\dashboard\Botica\scripts\cleanup_logs.php`

---

## ✅ 5.5 VERIFICACIÓN DE CALIDAD

### Checklist de Funcionalidades

**Ejecutar cada una desde el navegador:**

```
✅ Login:
http://localhost/dashboard/Botica/public/?route=login

✅ Dashboard Admin:
http://localhost/dashboard/Botica/public/?route=admin/dashboard

✅ Gestión de Productos:
http://localhost/dashboard/Botica/public/?route=admin/productos

✅ Historial de Ventas:
http://localhost/dashboard/Botica/public/?route=admin/historial

✅ Logs del Sistema:
http://localhost/dashboard/Botica/public/?route=admin/logs

✅ Ventas (Vendedor):
http://localhost/dashboard/Botica/public/?route=vendedor/ventas

✅ Inicio (Cliente):
http://localhost/dashboard/Botica/public/?route=cliente/dashboard
```

### Verificar Seguridad

**1. Contraseñas Hasheadas:**

```sql
-- Desde phpMyAdmin
SELECT id, usuario, clave FROM usuarios LIMIT 5;
-- Las contraseñas deben verse como: $2y$10$...
```

**2. SQL Injection Protection:**

```
Intentar login con: admin' OR '1'='1
Resultado esperado: Login fallido (protegido ✅)
```

**3. Control de Acceso:**

```
Intentar acceder a admin sin permisos:
http://localhost/dashboard/Botica/public/?route=admin/dashboard
(Sin sesión de admin)
Resultado esperado: Redirigir a login o "Acceso denegado"
```

---

## 📁 UBICACIÓN DE ARCHIVOS CLAVE

```
Botica/
├── tests/
│   ├── AuthTest.php         → Ejecutar: php tests/AuthTest.php
│   └── SimpleTest.php
│
├── scripts/
│   ├── backup_db.bat        → Ejecutar: scripts\backup_db.bat
│   ├── cleanup_logs.php     → Ejecutar: php scripts/cleanup_logs.php
│   └── deploy.bat           → Ejecutar: scripts\deploy.bat
│
├── docs/
│   ├── CAPITULO_5_GUIA_COMPLETA.md     → ESTE CAPÍTULO (completo)
│   ├── GUIA_RAPIDA_EJECUCION.md        → ESTA GUÍA (resumen)
│   ├── REPORTE_SEGURIDAD.md
│   ├── PLAN_DESPLIEGUE.md
│   ├── PLAN_MONITOREO.md
│   └── PLAN_MANTENIMIENTO.md
│
├── public/
│   ├── health.php           → Visitar: /health.php
│   └── index.php
│
└── backups/                 → Backups de BD
    └── backup_*.sql
```

---

## 🆘 RESOLUCIÓN DE PROBLEMAS COMUNES

### Problema: Las pruebas no se ejecutan

**Solución:**

```cmd
# Verificar que PHP funciona
c:\xampp\php\php.exe -v

# Verificar ruta correcta
cd c:\xampp\htdocs\dashboard\Botica
c:\xampp\php\php.exe tests\AuthTest.php
```

### Problema: El backup falla

**Solución:**

```cmd
# Crear directorio si no existe
mkdir c:\xampp\htdocs\dashboard\Botica\backups

# Ejecutar manualmente
c:\xampp\mysql\bin\mysqldump -u root botica > c:\xampp\htdocs\dashboard\Botica\backups\test.sql

# Verificar
dir c:\xampp\htdocs\dashboard\Botica\backups
```

### Problema: Health check muestra errores

**Solución:**

**1. Database FAIL:**

```cmd
# Verificar que MySQL está corriendo
c:\xampp\mysql\bin\mysql -u root -e "SELECT 1;"
```

**2. Backups WARNING:**

```cmd
# Ejecutar backup manual
scripts\backup_db.bat
```

**3. Logs WARNING:**

```cmd
# Ver qué errores hay
# Ir a: http://localhost/dashboard/Botica/?route=admin/logs
# Filtrar por nivel: ERROR
```

---

## 📞 COMANDOS DE REFERENCIA RÁPIDA

### Pruebas

```cmd
c:\xampp\php\php.exe tests\AuthTest.php
```

### Despliegue

```cmd
scripts\deploy.bat
```

### Mantenimiento

```cmd
scripts\backup_db.bat
c:\xampp\php\php.exe scripts\cleanup_logs.php
```

### Monitoreo

```
http://localhost/dashboard/Botica/public/health.php
http://localhost/dashboard/Botica/?route=admin/logs
```

### Ver Logs de Sistema

```powershell
Get-Content c:\xampp\apache\logs\error.log -Tail 20
```

---

**Última Actualización:** Diciembre 3, 2025  
**Versión:** 1.0
