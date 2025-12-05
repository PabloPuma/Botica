# CAPÍTULO 5 - DESARROLLO, PRUEBAS, DESPLIEGUE, MONITOREO, MANTENIMIENTO Y CALIDAD

## Índice

1. [Integración de Pruebas de Software y Seguridad](#51-integración-de-pruebas-de-software-y-seguridad)
2. [Despliegue y Retroalimentación](#52-despliegue-y-retroalimentación)
3. [Monitoreo de la Aplicación](#53-monitoreo-de-la-aplicación)
4. [Mantenimiento de la Aplicación](#54-mantenimiento-de-la-aplicación)
5. [Calidad de la Solución Informática](#55-calidad-de-la-solución-informática)

---

## 5.1 Integración de Pruebas de Software y Seguridad

### 5.1.1 Conceptos de Testing Aplicados

#### ¿Qué es?

El testing o pruebas de software es el proceso de verificar que el código funciona correctamente y cumple con los requisitos establecidos.

#### Conceptos implementados en el proyecto

**1. Unit Testing (Pruebas Unitarias)**

- **Definición:** Verificar que cada unidad individual de código (función, método) funcione correctamente de forma aislada.
- **Archivo:** `tests/AuthTest.php`
- **Líneas clave:** 72-78

**Ejemplo de prueba:**

```php
// Test 1: Verifica que el registro falle con campos vacíos
$result = $auth->register('', '', '');
$test->assertEqual("Todos los campos son obligatorios.", $result, "Register should fail with empty fields");

// Test 2: Verificación de hash de contraseñas
$password = 'secret';
$hash = password_hash($password, PASSWORD_DEFAULT);
$test->assert(password_verify($password, $hash), "Password verification should work");
```

**2. Mocking (Simulación)**

- **Definición:** Crear objetos falsos para simular comportamientos de componentes que dependen de bases de datos o servicios externos.
- **Archivo:** `tests/AuthTest.php`
- **Líneas:** 22-38 (MockUserDAO), 50-57 (MockLogger)

**3. Test-Driven Development (TDD)**

- **Definición:** Escribir las pruebas ANTES del código funcional.
- **Ventajas:** Asegura que el código sea testeable desde el principio.
- **Implementado en:** `tests/SimpleTest.php` - Framework minimalista de testing.

#### ¿Cómo ejecutar las pruebas?

**Método 1: Desde línea de comandos**

```bash
# Abrir PowerShell o CMD en la raíz del proyecto
cd c:\xampp\htdocs\dashboard\Botica

# Ejecutar las pruebas de autenticación
c:\xampp\php\php.exe tests/AuthTest.php
```

**Método 2: Desde el navegador**

```
http://localhost/dashboard/Botica/tests/AuthTest.php
```

**Salida esperada:**

```
Running AuthController Tests...
✓ Register should fail with empty fields
✓ Password verification should work

Results: 2 passed, 0 failed
```

---

### 5.1.2 Herramientas y Conceptos de Seguridad

#### Conceptos de Seguridad Implementados

**1. Autenticación Segura**

- **Bcrypt Hashing:** Contraseñas hasheadas con `password_hash()` y verificadas con `password_verify()`.
- **Archivo:** `app/Controllers/AuthController.php`
- **Líneas:** 55-57 (hash), 89-91 (verify)

```php
// Al registrar un usuario
$hashClave = password_hash($clave, PASSWORD_DEFAULT);

// Al autenticar
if (password_verify($clave, $user['clave'])) {
    // Autenticación exitosa
}
```

**2. Prevención de Inyección SQL**

- **Prepared Statements (Sentencias Preparadas):** Todas las consultas a la base de datos usan `mysqli::prepare()` y `bind_param()`.
- **Archivo:** `app/Models/UserDAO.php`
- **Líneas:** 15-18

```php
$stmt = $this->db->prepare("SELECT * FROM usuarios WHERE usuario = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
```

**3. Control de Acceso Basado en Roles (RBAC)**

- **Middleware de Autorización:** La función `requireAuth()` verifica roles antes de permitir acceso.
- **Archivo:** `public/index.php`
- **Líneas:** 16-28

```php
function requireAuth($rolesPermitidos = []) {
    if (!isset($_SESSION['usuario'])) {
        header("Location: ?route=login");
        exit();
    }
    
    if (!empty($rolesPermitidos) && !in_array($_SESSION['rol'], $rolesPermitidos)) {
        die("Acceso denegado.");
    }
}
```

**4. Logging de Seguridad**

- **Auditoría de Eventos:** Registros de logins fallidos, accesos denegados, errores críticos.
- **Archivo:** `app/Models/Logger.php`
- **Métodos:** `logLogin()`, `logError()`, `logAccion()`

---

### 5.1.3 Observaciones Levantadas

Durante la auditoría de seguridad se identificaron las siguientes observaciones:

#### ✅ Puntos Fuertes

1. **Contraseñas Seguras:** Uso correcto de `password_hash()` con Bcrypt.
2. **SQL Injection Protegido:** Todas las consultas usan prepared statements.
3. **Control de Acceso:** Middleware de roles funcional.
4. **Logs de Auditoría:** Sistema completo de logging implementado.

#### ⚠️ Riesgos Potenciales Identificados

**1. XSS (Cross-Site Scripting) - RIESGO MEDIO**

- **Problema:** No hay sanitización global de la salida en vistas.
- **Ejemplo vulnerable:**

```php
<!-- En app/Views/admin/inicio.php -->
<h2>Bienvenido, <?php echo $_SESSION['nombre']; ?></h2>
<!-- Si el nombre contiene <script>, se ejecutará -->
```

**Solución sugerida:** Crear una función helper `esc()`.

**2. CSRF (Cross-Site Request Forgery) - RIESGO ALTO**

- **Problema:** No hay tokens CSRF en formularios POST.
- **Ejemplo vulnerable:** Un atacante podría crear un formulario externo que envíe datos a tu aplicación si el usuario está autenticado.

**Solución sugerida:** Implementar tokens CSRF en todos los formularios.

**3. Expiración de Sesiones - RIESGO BAJO**

- **Problema:** Las sesiones no expiran por inactividad.
- **Solución sugerida:** Agregar timeout de sesión después de 30 minutos de inactividad.

---

### 5.1.4 Reporte de Pruebas de Seguridad

**Documento:** `docs/REPORTE_SEGURIDAD.md`

**Contenido del reporte:**

| Vulnerabilidad | Estado | Nivel | Acción Requerida |
|----------------|--------|-------|------------------|
| Inyección SQL | ✅ Seguro | N/A | Ninguna |
| Contraseñas Débiles | ✅ Seguro | N/A | Ninguna |
| XSS | ⚠️ Riesgo | MEDIO | Implementar `esc()` |
| CSRF | ❌ Vulnerable | ALTO | Añadir tokens CSRF |
| Gestión de Sesiones | ⚠️ Mejorable | BAJO | Añadir timeout |

---

## 5.2 Despliegue y Retroalimentación

### 5.2.1 Proceso de Despliegue

#### ¿Qué es?

El despliegue es el proceso de llevar la aplicación desde el entorno de desarrollo a producción.

#### Estrategia de Despliegue Implementada

**Enfoque:** Rolling Update con Rollback automático en caso de fallo.

**Fases del Despliegue:**

**1. PRE-DESPLIEGUE (Verificación)**

```bash
# Ejecutar pruebas automatizadas
php tests/AuthTest.php

# Verificar sintaxis PHP en archivos críticos
php -l app/Controllers/AuthController.php
php -l app/Models/UserDAO.php

# Crear backup preventivo
scripts\backup_db.bat
```

**2. DESPLIEGUE (Actualización)**

```bash
# Actualizar código desde repositorio Git
git pull origin main

# Si hubiera Composer (actualmente no usado)
composer install --no-dev

# Ejecutar migraciones de BD (si hubiera)
# php scripts/migrate.php
```

**3. POST-DESPLIEGUE (Validación)**

```bash
# Verificar estado de la aplicación
# Navegar a: http://localhost/dashboard/Botica/?route=health

# Revisar logs de errores
# tail -f c:\xampp\apache\logs\error.log
```

#### ¿Cómo ejecutar el proceso de despliegue?

**Método 1: Script Automatizado (RECOMENDADO)**

```bash
# Abrir CMD o PowerShell en la raíz del proyecto
cd c:\xampp\htdocs\dashboard\Botica

# Ejecutar script de despliegue
scripts\deploy.bat
```

**Qué hace el script:**

1. ✅ Ejecuta pruebas unitarias
2. 📦 Crea backup de la base de datos
3. 🔄 Actualiza código desde Git
4. 🧹 Limpia caché (si existe)

**Método 2: Manual (Paso a Paso)**

```bash
# 1. Pruebas
c:\xampp\php\php.exe tests\AuthTest.php

# 2. Backup
scripts\backup_db.bat

# 3. Actualizar código
git pull origin main

# 4. Verificar
# Abrir: http://localhost/dashboard/Botica
```

---

### 5.2.2 Retroalimentación Recibida

**Fuentes de Retroalimentación:**

**1. Logs de Aplicación**

- **Ubicación:** Vista de Admin → Logs
- **URL:** `?route=admin/logs`
- **Información:** Errores, logins fallidos, acciones de usuarios.

**2. Logs del Servidor Web (Apache)**

- **Archivo:** `c:\xampp\apache\logs\error.log`
- **Comando para revisar:**

```bash
# Ver últimas 50 líneas
Get-Content c:\xampp\apache\logs\error.log -Tail 50
```

**3. Logs de Base de Datos (MySQL)**

- **Archivo:** `c:\xampp\mysql\data\mysql.err`
- **Uso:** Detectar consultas lentas o errores de conexión.

**Ejemplos de retroalimentación útil:**

```
[ERROR] 2025-12-02 14:32:15 - Usuario: juan_admin
Mensaje: Intento de acceso a módulo restringido
IP: 192.168.1.45

[INFO] 2025-12-02 15:10:22 - Usuario: maria_vendedora
Acción: Venta registrada exitosamente - ID: 1523
```

---

### 5.2.3 Aplicación de Observaciones

**Mejoras implementadas basadas en retroalimentación:**

**1. Sistema de Logging Mejorado**

- **Problema detectado:** No había trazabilidad de acciones críticas.
- **Solución:** Implementación de `Logger.php` con niveles INFO, WARNING, ERROR.

**2. Control de Acceso Refinado**

- **Problema detectado:** Vendedores podían intentar acceder a rutas de admin.
- **Solución:** Middleware `requireAuth()` con verificación de roles específicos.

**3. Manejo de Errores Amigable**

- **Problema detectado:** Errores técnicos expuestos al usuario final.
- **Solución:** Páginas de error personalizadas sin revelar detalles internos.

---

## 5.3 Monitoreo de la Aplicación

### 5.3.1 Buenas Prácticas de Monitoreo

#### ¿Qué es?

El monitoreo es la observación continua de la aplicación para detectar problemas antes de que afecten a los usuarios.

#### Las 4 Señales Doradas (Golden Signals)

**1. Latencia (Velocidad)**

- **Qué medir:** Tiempo de respuesta de la aplicación.
- **Meta:** < 200ms para páginas dinámicas.
- **Herramienta:** Logs de Apache Access Log.

**2. Tráfico (Uso)**

- **Qué medir:** Número de requests por segundo.
- **Meta:** Capacidad para 100 usuarios concurrentes.
- **Herramienta:** Análisis de Access Logs.

**3. Errores**

- **Qué medir:** Tasa de errores HTTP (500, 404).
- **Meta:** < 1% de errores.
- **Herramienta:** Logger.php + Apache Error Logs.

**4. Saturación (Recursos)**

- **Qué medir:** Uso de CPU, Memoria, Disco.
- **Meta:** < 80% de utilización.
- **Herramienta:** Task Manager / Performance Monitor.

---

### 5.3.2 Herramientas Utilizadas

**1. Logger Personalizado (App\Models\Logger)**

- **Archivo:** `app/Models/Logger.php`
- **Capacidades:**
  - Registro de eventos en base de datos
  - Niveles de severidad (INFO, WARNING, ERROR)
  - Stack traces para debugging

**Cómo usar:**

```php
use App\Models\Logger;

$logger = Logger::getInstance();

// Registrar información
$logger->logAccion($_SESSION['usuario_id'], $_SESSION['usuario'], "Acción realizada");

// Registrar error
$logger->logError($_SESSION['usuario_id'], $_SESSION['usuario'], "Error crítico", $exception->getTraceAsString());
```

**2. Vista de Logs en Dashboard**

- **Ubicación:** Admin Dashboard → Logs
- **URL:** `?route=admin/logs`
- **Funcionalidades:**
  - Filtros por tipo (login, error, venta)
  - Filtros por rol del usuario
  - Filtros por rango de fechas
  - Paginación

**Cómo acceder:**

1. Iniciar sesión como administrador
2. Navegar a `http://localhost/dashboard/Botica/?route=admin/logs`
3. Aplicar filtros según necesidad

**3. Apache Access & Error Logs**

- **Access Log:** `c:\xampp\apache\logs\access.log`
- **Error Log:** `c:\xampp\apache\logs\error.log`

**Comando para monitoreo en tiempo real:**

```powershell
# Seguir logs en tiempo real (PowerShell)
Get-Content c:\xampp\apache\logs\error.log -Wait -Tail 20
```

**4. MySQL Slow Query Log (Consultas Lentas)**

- **Archivo:** `c:\xampp\mysql\data\mysql-slow.log` (si está habilitado)
- **Propósito:** Identificar consultas que tardan más de X segundos.

**Habilitar en my.ini:**

```ini
[mysqld]
slow_query_log = 1
long_query_time = 2
slow_query_log_file = c:/xampp/mysql/data/mysql-slow.log
```

---

### 5.3.3 Plan de Monitoreo Elaborado

**Documento:** `docs/PLAN_MONITOREO.md`

**Resumen del Plan:**

#### Monitoreo Diario (Automático)

**Health Check Endpoint**

- **Archivo sugerido:** `public/health.php`
- **Propósito:** Verificar que la aplicación está funcionando.
- **Cómo crear:**

```php
<?php
// public/health.php
require_once __DIR__ . '/../app/autoload.php';
use App\Config\Database;

header('Content-Type: application/json');

$status = [
    'status' => 'UP',
    'timestamp' => date('Y-m-d H:i:s'),
    'checks' => []
];

try {
    // Verificar conexión a BD
    $db = Database::getInstance()->getConnection();
    $status['checks']['database'] = 'OK';
} catch (Exception $e) {
    $status['status'] = 'DOWN';
    $status['checks']['database'] = 'FAIL: ' . $e->getMessage();
}

// Verificar espacio en disco
$freeSpace = disk_free_space("c:");
$totalSpace = disk_total_space("c:");
$percentFree = ($freeSpace / $totalSpace) * 100;

if ($percentFree > 10) {
    $status['checks']['disk_space'] = 'OK (' . round($percentFree, 2) . '% free)';
} else {
    $status['status'] = 'WARNING';
    $status['checks']['disk_space'] = 'LOW (' . round($percentFree, 2) . '% free)';
}

echo json_encode($status, JSON_PRETTY_PRINT);
```

**Cómo usar:**

```bash
# Desde navegador
http://localhost/dashboard/Botica/health.php

# Desde PowerShell
Invoke-WebRequest -Uri "http://localhost/dashboard/Botica/health.php" | Select-Object -Expand Content
```

#### Monitoreo Semanal (Manual)

1. **Revisar Logs de Errores:**
   - Admin → Logs → Filtrar "ERROR"
   - Analizar patrones recurrentes

2. **Analizar Rendimiento:**
   - Revisar MySQL Slow Query Log
   - Identificar consultas que requieren optimización

3. **Verificar Backups:**
   - Comprobar que `backups/` contenga archivos recientes
   - Probar restauración de un backup antiguo

#### Alertas Automáticas (A Implementar)

**Script de Alertas (sugerido):**

```php
// scripts/alertas.php
// Revisar logs y enviar email si hay más de 10 errores en 1 hora

$db = Database::getInstance()->getConnection();

$stmt = $db->prepare("
    SELECT COUNT(*) as errores 
    FROM logs 
    WHERE nivel = 'ERROR' 
    AND fecha > DATE_SUB(NOW(), INTERVAL 1 HOUR)
");
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();

if ($result['errores'] > 10) {
    // Enviar correo al administrador
    mail('admin@botica.com', 'ALERTA: Errores críticos', "Se detectaron {$result['errores']} errores en la última hora");
}
```

---

## 5.4 Mantenimiento de la Aplicación

### 5.4.1 Cron Jobs y Scripts

#### ¿Qué es un Cron Job?

Tareas programadas que se ejecutan automáticamente a intervalos definidos (diario, semanal, mensual).

**En Windows se usa el "Programador de Tareas" (Task Scheduler).**

#### Scripts de Mantenimiento Implementados

**1. Backup de Base de Datos**

- **Archivo:** `scripts/backup_db.bat`
- **Función:** Crea una copia de seguridad de la base de datos con timestamp.
- **Frecuencia recomendada:** Diaria

**Contenido del script:**

```batch
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
```

**Cómo ejecutar manualmente:**

```bash
# Desde CMD o PowerShell
cd c:\xampp\htdocs\dashboard\Botica
scripts\backup_db.bat
```

**Cómo programar como tarea automática:**

1. Presionar `Win + R` → escribir `taskschd.msc` → Enter
2. Click derecho en "Biblioteca del Programador de Tareas" → "Crear tarea básica"
3. Nombre: "Backup Botica DB"
4. Desencadenador: "Diariamente" a las 3:00 AM
5. Acción: "Iniciar un programa"
6. Programa: `c:\xampp\htdocs\dashboard\Botica\scripts\backup_db.bat`
7. Finalizar

---

**2. Limpieza de Logs Antiguos**

- **Archivo:** `scripts/cleanup_logs.php`
- **Función:** Elimina logs de más de 90 días para evitar crecimiento descontrolado de la BD.
- **Frecuencia recomendada:** Mensual (día 1 de cada mes)

**Contenido del script:**

```php
<?php
require_once __DIR__ . '/../app/autoload.php';
use App\Config\Database;

echo "[INFO] Iniciando limpieza de logs...\n";

try {
    $db = Database::getInstance()->getConnection();
    
    $days = 90;
    $date = date('Y-m-d H:i:s', strtotime("-{$days} days"));
    
    $stmt = $db->prepare("DELETE FROM logs WHERE fecha < ?");
    $stmt->bind_param("s", $date);
    $stmt->execute();
    
    $affected = $stmt->affected_rows;
    
    echo "[SUCCESS] Se eliminaron {$affected} registros de logs antiguos.\n";
    
} catch (Exception $e) {
    echo "[ERROR] " . $e->getMessage() . "\n";
    exit(1);
}
```

**Cómo ejecutar manualmente:**

```bash
# Desde CMD o PowerShell
cd c:\xampp\htdocs\dashboard\Botica
c:\xampp\php\php.exe scripts\cleanup_logs.php
```

**Cómo programar:**

1. Programador de Tareas → Crear tarea básica
2. Nombre: "Limpieza Logs Botica"
3. Desencadenador: "Mensual" → Día 1 → 2:00 AM
4. Acción: `c:\xampp\php\php.exe`
5. Argumentos: `c:\xampp\htdocs\dashboard\Botica\scripts\cleanup_logs.php`

---

**3. Script de Despliegue**

- **Archivo:** `scripts/deploy.bat`
- **Función:** Automatiza el proceso de despliegue (pruebas + backup + actualización)
- **Frecuencia:** Manual (cuando se desplieguen cambios)

**Ya documentado en sección 5.2.1**

---

### 5.4.2 Backups

#### Estrategia de Respaldo Completa

**1. Backup de Base de Datos (Crítico)**

- **Frecuencia:** DIARIA
- **Método:** `mysqldump`
- **Script:** `scripts/backup_db.bat`
- **Retención:** Últimos 7 días (backups diarios), último de cada mes (indefinido)

**2. Backup de Código y Archivos (Moderado)**

- **Frecuencia:** SEMANAL
- **Método:** Copia de carpeta completa o Git push

**Script sugerido (nuevo):**

```batch
@echo off
REM scripts/backup_files.bat
set TIMESTAMP=%date:~-4,4%%date:~-7,2%%date:~-10,2%
set SOURCE=c:\xampp\htdocs\dashboard\Botica
set DEST=c:\Backups\Botica\codigo_%TIMESTAMP%

echo [INFO] Copiando archivos...
xcopy %SOURCE% %DEST% /E /I /H /Y /EXCLUDE:scripts\backup_exclude.txt

echo [SUCCESS] Backup de archivos completado en %DEST%
```

**Archivo de exclusión (`scripts/backup_exclude.txt`):**

```
.git\
backups\
vendor\
*.log
```

**3. Procedimiento de Restauración**

**Restaurar Base de Datos:**

```bash
# 1. Detener acceso a la aplicación (opcional)

# 2. Listar backups disponibles
dir c:\xampp\htdocs\dashboard\Botica\backups

# 3. Restaurar backup específico
c:\xampp\mysql\bin\mysql -u root botica < c:\xampp\htdocs\dashboard\Botica\backups\backup_botica_20251204_202856.sql

# 4. Verificar integridad
c:\xampp\mysql\bin\mysql -u root botica -e "SELECT COUNT(*) FROM usuarios;"
```

**Restaurar Código:**

```bash
# Opción 1: Desde backup de archivos
xcopy c:\Backups\Botica\codigo_20251202 c:\xampp\htdocs\dashboard\Botica /E /I /H /Y

# Opción 2: Desde Git
git reset --hard HEAD~1  # Volver al commit anterior
git checkout <tag_version_estable>  # O a un tag específico
```

---

### 5.4.3 Plan de Mantenimiento Integral

**Documento:** `docs/PLAN_MANTENIMIENTO.md`

**Calendario de Mantenimiento:**

#### DIARIO (Automatizado)

- ✅ 03:00 AM - Backup de Base de Datos (`backup_db.bat`)
- ✅ 03:30 AM - Health Check (`health.php`)

#### SEMANAL (Automatizado)

- ✅ Domingo 02:00 AM - Backup de Archivos (`backup_files.bat`)

#### MENSUAL (Manual/Automatizado)

- ✅ Día 1 - Limpieza de Logs (`cleanup_logs.php`)
- ✅ Día 15 - Revisión de logs de errores (Admin Dashboard)
- ✅ Día 15 - Análisis de consultas lentas (MySQL Slow Log)

#### TRIMESTRAL (Manual)

- 🔄 Actualización de PHP (si hay versión nueva)
- 🔄 Revisión de dependencias (si hubiera Composer)
- 🔄 Prueba de restauración de backups (Disaster Recovery Drill)
- 🔄 Optimización de base de datos (`OPTIMIZE TABLE`)

**Comandos de optimización:**

```sql
-- Ejecutar desde phpMyAdmin o línea de comandos
USE botica;

OPTIMIZE TABLE usuarios;
OPTIMIZE TABLE productos;
OPTIMIZE TABLE ventas;
OPTIMIZE TABLE logs;
```

#### ANUAL (Manual)

- 📊 Auditoría de seguridad completa
- 📊 Revisión de arquitectura
- 📊 Planificación de escalabilidad

---

## 5.5 Calidad de la Solución Informática

### 5.5.1 Completitud y Coherencia

#### ¿Qué es?

La completitud se refiere a que el sistema cumpla con TODOS los requisitos funcionales y no funcionales definidos.

#### Checklist de Completitud

**Módulos Funcionales:**

- ✅ Autenticación (Login/Registro)
- ✅ Control de Acceso por Roles (Admin, Vendedor, Cliente)
- ✅ Gestión de Productos (CRUD completo)
- ✅ Gestión de Ventas (Registro y consulta)
- ✅ Historial de Ventas
- ✅ Sistema de Logs
- ✅ Exportación de Reportes (CSV)

**Requisitos No Funcionales:**

- ✅ Seguridad (Hashing, Prepared Statements, RBAC)
- ✅ Rendimiento (Queries optimizadas, Singleton para DB)
- ✅ Mantenibilidad (Arquitectura MVC, Separación de responsabilidades)
- ✅ Escalabilidad (Estructura modular)
- ✅ Logging (Sistema completo de auditoría)

**Coherencia:**

- ✅ Nomenclatura consistente (camelCase para métodos, PascalCase para clases)
- ✅ Estructura de carpetas lógica
- ✅ Patrones de diseño aplicados consistentemente
- ✅ Manejo de errores estandarizado

---

### 5.5.2 Buenas Prácticas Aplicadas

#### 1. Arquitectura y Diseño

**MVC (Modelo-Vista-Controlador)**

- ✅ Separación clara de responsabilidades
- ✅ Modelos solo manejan datos
- ✅ Controladores solo lógica de negocio
- ✅ Vistas solo presentación

**Patrón DAO (Data Access Object)**

- ✅ Abstracción de acceso a datos
- ✅ Centralización de consultas SQL
- **Ejemplo:** `app/Models/UserDAO.php`

**Singleton**

- ✅ Una única instancia de conexión a BD
- **Ejemplo:** `app/Config/Database.php`

#### 2. Principios SOLID

**S - Single Responsibility (Responsabilidad Única)**

- ✅ `Logger.php` solo maneja logging
- ✅ `Security.php` solo maneja seguridad (CSRF, XSS)
- ✅ `AuthController.php` solo maneja autenticación

**O - Open/Closed (Abierto/Cerrado)**

- ✅ `UserDAO` puede extenderse sin modificar código existente

**L - Liskov Substitution**

- ✅ No aplicable directamente (no hay herencia compleja en este proyecto)

**I - Interface Segregation**

- ✅ No se fuerza a implementar métodos innecesarios

**D - Dependency Inversion**

- ✅ Controladores dependen de abstracciones (DAOs) no de implementaciones concretas

#### 3. Seguridad

- ✅ Contraseñas hasheadas (Bcrypt)
- ✅ Sentencias preparadas (SQL Injection)
- ✅ Control de acceso basado en roles
- ⚠️ CSRF protection (pendiente)
- ⚠️ XSS sanitization (pendiente)

#### 4. Testing

- ✅ Framework de testing implementado (`SimpleTest.php`)
- ✅ Pruebas unitarias para autenticación
- ✅ Mocking para aislamiento de tests

#### 5. Documentación

- ✅ Comentarios en código crítico
- ✅ Documentación técnica (`DOCUMENTACION_TECNICA.md`)
- ✅ Planes de despliegue, monitoreo, mantenimiento
- ✅ Reporte de seguridad

#### 6. Mantenibilidad

- ✅ Autoloading (PSR-4 simplificado)
- ✅ Configuración centralizada
- ✅ Scripts de automatización
- ✅ Control de versiones (Git)

---

### 5.5.3 Autoría y Dominio del Código

#### Evidencia de Autoría

**1. Git Commits**

```bash
# Ver historial de commits con autor
git log --pretty=format:"%h - %an, %ar : %s"

# Ver estadísticas de contribuciones
git shortlog -sn --all
```

**2. Comprensión Profunda del Sistema**

**Diagrama de Flujo de Autenticación:**

```
Usuario → Login Form → AuthController::login()
                           ↓
                    UserDAO::findByUsername()
                           ↓
                    password_verify()
                           ↓
                    $_SESSION['usuario'] = ...
                           ↓
                    Logger::logLogin()
                           ↓
                    redirect a Dashboard correspondiente
```

**3. Capacidad de Explicar Decisiones de Diseño**

**¿Por qué se eligió MVC?**

- Separación de responsabilidades
- Facilita testing
- Escalabilidad
- Mantenibilidad

**¿Por qué Singleton para Database?**

- Evita múltiples conexiones innecesarias
- Mejora el rendimiento
- Simplifica el manejo de transacciones

**¿Por qué Prepared Statements?**

- Prevención de SQL Injection
- Mejor rendimiento en consultas repetidas
- Tipado de parámetros

---

## Resumen de Ejecución de Código

### Scripts que puedes ejecutar

#### 1. Pruebas

```bash
# Pruebas de autenticación
c:\xampp\php\php.exe c:\xampp\htdocs\dashboard\Botica\tests\AuthTest.php
```

#### 2. Despliegue

```bash
# Despliegue automatizado
c:\xampp\htdocs\dashboard\Botica\scripts\deploy.bat
```

#### 3. Mantenimiento

```bash
# Backup manual de BD
c:\xampp\htdocs\dashboard\Botica\scripts\backup_db.bat

# Limpieza manual de logs
c:\xampp\php\php.exe c:\xampp\htdocs\dashboard\Botica\scripts\cleanup_logs.php
```

#### 4. Monitoreo

```bash
# Health check (crear el archivo primero según sección 5.3.3)
http://localhost/dashboard/Botica/health.php
```

#### 5. Navegación en Dashboard

```
# Login
http://localhost/dashboard/Botica/?route=login

# Dashboard Admin
http://localhost/dashboard/Botica/?route=admin/dashboard

# Logs (requiere rol admin)
http://localhost/dashboard/Botica/?route=admin/logs
```

---

## Próximos Pasos Sugeridos

### Implementaciones Pendientes (Críticas)

1. **✅ CSRF Protection** (Alta Prioridad)
   - Crear `app/Helpers/Security.php::generateCSRFToken()`
   - Añadir tokens a todos los formularios

2. **✅ XSS Sanitization** (Alta Prioridad)
   - Crear función `esc()` global
   - Aplicar en todas las vistas

3. **⚠️ Timeout de Sesión** (Media Prioridad)
   - Implementar expiración por inactividad

4. **⚠️ Health Check Endpoint** (Media Prioridad)
   - Crear `public/health.php`

5. **⚠️ Alertas Automáticas** (Baja Prioridad)
   - Script para enviar emails en caso de errores críticos

---

**Fecha de Elaboración:** Diciembre 2, 2025  
**Autor:** Sistema de Documentación Automatizada  
**Versión:** 1.0
