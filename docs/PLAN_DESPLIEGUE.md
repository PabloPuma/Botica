# Plan de Despliegue - Botica Dashboard

## 1. Estrategia de Despliegue

Se utilizará una estrategia de **Blue-Green Deployment** (simulada en este entorno local) o **Rolling Update** dependiendo de la infraestructura final. Para este entorno XAMPP, utilizaremos un despliegue basado en Git con scripts de automatización.

## 2. Entornos

- **Desarrollo (Local):** `c:\xampp\htdocs\dashboard\Botica`
- **Staging (Pruebas):** `c:\xampp\htdocs\dashboard\Botica_Staging` (Simulado)
- **Producción:** Servidor Web (Simulado)

## 3. Proceso de Despliegue

1. **Pre-Despliegue:**
   - Ejecutar pruebas unitarias: `php tests/AuthTest.php`
   - Verificar sintaxis PHP: `php -l ...`
   - Realizar backup de base de datos.

2. **Despliegue:**
   - Pull de cambios desde repositorio (Git).
   - Actualización de dependencias (si hubiera Composer).
   - Migraciones de base de datos (si hubiera cambios de esquema).
   - Limpieza de caché.

3. **Post-Despliegue:**
   - Verificación de salud (Health Check).
   - Monitoreo de logs de errores.

## 4. Rollback

En caso de fallo crítico:

1. Restaurar backup de base de datos.
2. Revertir cambios de código (`git revert` o checkout a tag anterior).

## 5. Script de Automatización

Se ha creado el script `scripts/deploy.bat` para automatizar este proceso en Windows.
