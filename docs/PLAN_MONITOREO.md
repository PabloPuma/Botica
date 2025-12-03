# Plan de Monitoreo - Botica Dashboard

## 1. Objetivos

Asegurar la disponibilidad, rendimiento y seguridad de la aplicación mediante la recolección y análisis de métricas y logs.

## 2. Componentes de Monitoreo

### 2.1. Logs de Aplicación

- **Herramienta:** `App\Models\Logger` (Custom Implementation)
- **Almacenamiento:** Base de Datos MySQL (tabla `logs`).
- **Eventos Monitoreados:**
  - Inicios de sesión (Exitosos/Fallidos).
  - Errores críticos (Exceptions).
  - Operaciones sensibles (Ventas, Modificación de usuarios).
- **Rotación:** Script de limpieza mensual (`scripts/cleanup_logs.php`).

### 2.2. Salud del Sistema (Health Check)

- **Endpoint:** `/health.php`
- **Verificaciones:**
  - Conectividad a Base de Datos.
  - Espacio en disco (opcional).
  - Estado de sesión.
- **Frecuencia:** Ping cada 5 minutos (usando servicio externo o cron local).

### 2.3. Rendimiento

- **Métricas:**
  - Tiempo de respuesta de endpoints críticos.
  - Uso de memoria PHP.
- **Herramienta:** Logs de servidor web (Apache Access Logs) y Slow Query Log de MySQL.

## 3. Alertas

- **Críticas:** Caída de base de datos, Errores 500 recurrentes.
- **Advertencias:** Intentos de login fallidos masivos (posible fuerza bruta).

## 4. Tablero de Control

- Se utilizará la vista de Admin `admin/logs` para visualizar los eventos en tiempo real.
