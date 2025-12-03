# Plan de Mantenimiento - Botica Dashboard

## 1. Estrategia de Mantenimiento

El mantenimiento preventivo y correctivo es crucial para la longevidad del software. Este plan define las tareas rutinarias automatizadas y manuales.

## 2. Tareas Rutinarias

### 2.1. Backups (Copias de Seguridad)

- **Frecuencia:** Diaria (Base de Datos), Semanal (Código/Archivos).
- **Herramienta:** `mysqldump` para BD, copia de archivos para código.
- **Retención:** Mantener los últimos 7 días de backups diarios y 4 semanas de backups semanales.
- **Script:** `scripts/backup_db.bat`

### 2.2. Limpieza de Logs

- **Objetivo:** Evitar que la tabla `logs` crezca indefinidamente afectando el rendimiento.
- **Frecuencia:** Mensual.
- **Acción:** Eliminar logs con antigüedad mayor a 90 días.
- **Script:** `scripts/cleanup_logs.php`

### 2.3. Actualización de Dependencias

- **Frecuencia:** Trimestral.
- **Acción:** Revisar versiones de PHP y librerías utilizadas.

## 3. Procedimientos de Recuperación (Disaster Recovery)

1. **Fallo de Base de Datos:**
   - Detener servicio web.
   - Restaurar último backup válido usando `mysql < backup.sql`.
   - Verificar integridad.
   - Reiniciar servicio.

## 4. Cron Jobs (Tareas Programadas)

En Windows, utilizar el **Programador de Tareas** para ejecutar:

- `scripts/backup_db.bat` todos los días a las 03:00 AM.
- `php scripts/cleanup_logs.php` el día 1 de cada mes.
