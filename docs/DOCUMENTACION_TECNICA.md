# DESARROLLO E IMPLEMENTACIÓN DEL SISTEMA

## 4.1 Arquitectura Inicial del Proyecto JhireFarma

### 4.1.1 Enfoque de arquitectura

El proyecto adopta una arquitectura **MVC (Modelo-Vista-Controlador)** personalizada. Este enfoque se seleccionó para garantizar la escalabilidad y mantenibilidad del código, permitiendo una clara separación entre la lógica de negocio (Controladores), la presentación de datos (Vistas) y la gestión de la información (Modelos).

- **Archivo:** `app/autoload.php`
- **Descripción:** Implementa un sistema de carga automática de clases basado en el estándar PSR-4 simplificado, lo que permite instanciar clases sin necesidad de múltiples `require_once`, mejorando la organización del código.

### 4.1.2 Tecnologías utilizadas

- **Lenguaje:** PHP 8.x (Backend robusto y tipado).
- **Base de Datos:** MySQL / MariaDB (Almacenamiento relacional).
- **Frontend:** HTML5, CSS3, JavaScript Vanilla (Interfaz ligera sin dependencias pesadas).
- **Servidor Web:** Apache (Entorno XAMPP para desarrollo local).

### 4.1.3 Aplicación de MVC, DAO, TDD y SOLID

- **MVC:** La estructura de carpetas divide estrictamente las responsabilidades: `app/Models` para datos, `app/Views` para HTML, y `app/Controllers` para la lógica.
- **DAO (Data Access Object):** Se implementa en clases como `UserDAO` para abstraer las consultas SQL complejas del resto de la aplicación.
- **TDD (Test Driven Development):** Se ha integrado un entorno de pruebas en `tests/` para validar funcionalidades críticas antes del despliegue.
- **SOLID:** Se aplican principios como Responsabilidad Única (SRP) en `Security.php` y Singleton en `Database.php` para una gestión eficiente de recursos.

### 4.1.4 Integración de módulos del sistema

La integración se centraliza mediante un **Enrutador Frontal** que intercepta todas las solicitudes HTTP y las dirige al controlador adecuado.

- **Archivo:** `public/index.php`
- **Líneas:** 30-118
- **Descripción:** Utiliza una estructura `switch` para manejar rutas amigables (ej. `?route=admin/dashboard`), verificando permisos antes de cargar cualquier vista o controlador.

## 4.2 Componentes del Sistema

### 4.1.5 Componentes del lado del servidor

El backend se compone de Controladores que orquestan el flujo de datos y Modelos que interactúan con la base de datos.

- **Archivos:** `app/Controllers/AuthController.php`, `app/Controllers/AdminController.php`.
- **Descripción:** `AuthController` gestiona el ciclo de vida de la sesión (login/logout), mientras que `AdminController` prepara los datos para el panel de administración.

### 4.1.6 Componentes del lado del cliente

El frontend utiliza vistas PHP que generan HTML dinámico, apoyadas por archivos estáticos para estilos y scripts.

- **Archivos:** `app/Views/layouts/header.php`, `public/assets/css/styles.css`.
- **Descripción:** Las vistas utilizan plantillas base (`header.php`, `footer.php`) para mantener una consistencia visual en toda la aplicación.

### 4.1.7 Componentes de base de datos

La capa de persistencia se maneja a través de una clase de configuración centralizada.

- **Archivo:** `app/Config/Database.php`
- **Descripción:** Implementa el patrón Singleton para asegurar que solo exista una conexión activa a la base de datos por petición, optimizando el rendimiento.

## 4.2 Principios de Diseño Aplicados

### 4.2.1 Aplicación del patrón MVC

- **Modelo:** `app/Models/UserDAO.php` - Gestiona consultas CRUD para usuarios.
- **Vista:** `app/Views/auth/login.php` - Presenta el formulario de acceso al usuario.
- **Controlador:** `app/Controllers/AuthController.php` - Procesa las credenciales y decide si otorgar acceso.

### 4.2.2 Implementación del patrón DAO

- **Archivo:** `app/Models/UserDAO.php`
- **Líneas:** 13-19 (Método `findByUsername`)
- **Descripción:** Este método encapsula la consulta SQL `SELECT` con parámetros vinculados, devolviendo un array asociativo limpio al controlador, desacoplando la lógica SQL del negocio.

### 4.2.3 Uso del enfoque TDD

- **Archivo:** `tests/AuthTest.php`
- **Descripción:** Contiene pruebas automatizadas que verifican casos de éxito y fallo en el registro y login, asegurando que los cambios futuros no rompan la funcionalidad existente.

### 4.2.4 Aplicación de principios SOLID

- **Single Responsibility (SRP):** La clase `app/Helpers/Security.php` tiene la única responsabilidad de manejar funciones de seguridad (CSRF, XSS), sin mezclarse con lógica de negocio.
- **Singleton:** La clase `app/Config/Database.php` garantiza una instancia única de conexión a la base de datos.

## 4.3 Consideraciones de Seguridad

### 4.3.1 Validación de datos

- **Archivo:** `app/Controllers/AuthController.php`
- **Líneas:** 63-65
- **Descripción:** Se validan estrictamente los datos de entrada (usuario, contraseña) para asegurar que no estén vacíos ni contengan formatos inválidos antes de procesarlos.

### 4.3.2 Control de acceso y roles

- **Archivo:** `public/index.php`
- **Líneas:** 16-28 (Función `requireAuth`)
- **Descripción:** Implementa un middleware de autorización que verifica la variable de sesión `$_SESSION['rol']`. Si el usuario no tiene el rol requerido, se deniega el acceso y se redirige al login.

### 4.3.3 Gestión y manejo de errores

- **Archivo:** `app/Models/Logger.php`
- **Líneas:** 127-132 (`logError`)
- **Descripción:** Captura excepciones y errores críticos, registrándolos en la base de datos con detalles técnicos (stack trace) para su posterior análisis, sin exponer información sensible al usuario final.

### 4.3.4 Registro y seguimiento de eventos

- **Archivo:** `app/Models/Logger.php`
- **Descripción:** Un sistema de auditoría completo que registra quién hizo qué y cuándo (ej. "Usuario X registró una venta Y"), permitiendo trazabilidad total de las acciones en el sistema.

### 4.3.5 Protección del cliente y del entorno web

- **Archivo:** `app/Helpers/Security.php`
- **Descripción:**
  - **CSRF:** Genera y valida tokens únicos por sesión para prevenir ataques de falsificación de peticiones en sitios cruzados.
  - **XSS:** Provee el método `esc()` para sanitizar cualquier salida HTML, previniendo la inyección de scripts maliciosos.

## 4.4 Librerías de Apoyo Utilizadas

### 4.4.1 Google Guava

*No hay información.* (Esta librería es específica de Java. En este proyecto PHP se utilizan funciones nativas de arrays y colecciones).

### 4.4.2 Apache POI

*No hay información.* (Librería Java para manejo de documentos Office).

- **Alternativa Implementada:** `app/Controllers/ExportController.php`
- **Descripción:** Se utiliza la función nativa `fputcsv` de PHP para generar reportes de ventas en formato CSV, compatible con Excel.

### 4.4.3 Apache Commons

*No hay información.* (Librería de utilidades Java).

### 4.4.4 Logback (SLF4J)

*No hay información.* (Framework de logging para Java).

- **Alternativa Implementada:** `app/Models/Logger.php`
- **Descripción:** Se desarrolló un sistema de logging personalizado que escribe directamente en la base de datos MySQL, adaptado a las necesidades específicas del proyecto.

## 4.5 Uso de Git y GitHub

### 4.5.1 Repositorio y estructura

- **Directorio:** `.git/`
- **Descripción:** Contiene la base de datos de objetos de Git, referencias y configuración del repositorio local, permitiendo el control de versiones distribuido.

### 4.5.2 Control de versiones y ramas

- **Ramas:** `main`
- **Descripción:** Se utiliza la rama principal para el código estable y listo para producción. El desarrollo de nuevas características se realiza localmente antes de integrarse.

### 4.5.3 Historial de commits

- **Comando:** `git log`
- **Descripción:** Mantiene un registro inmutable de todos los cambios, permitiendo auditar quién modificó qué archivo y revertir cambios si es necesario.

### 4.5.4 Colaboración y flujo de trabajo

*No hay información.* (El proyecto se ha desarrollado en un entorno local simulado, sin interacción remota activa en esta fase).

## 4.6 Desarrollo de Interfaces UI/UX

### 4.6.1 Pantalla de inicio

- **Archivo:** `app/Views/cliente/inicio.php`
- **Descripción:** Diseñada como punto de entrada atractivo, muestra carruseles de productos destacados y ofertas para captar la atención del cliente inmediatamente.

### 4.6.2 Login y registro de usuarios

- **Archivo:** `app/Views/auth/login.php`
- **Descripción:** Interfaz limpia y centrada en el usuario. Incluye validación visual de campos y mensajes de error claros. Implementa protección CSRF oculta para seguridad transparente.

### 4.6.3 Panel de administrador

- **Archivo:** `app/Views/admin/inicio.php`
- **Descripción:** Dashboard centralizado que presenta tarjetas con métricas clave (Ventas del día, Usuarios registrados) y una barra lateral de navegación intuitiva para acceder a todas las funciones de gestión.

### 4.6.4 Módulo de ventas

- **Archivo:** `app/Views/vendedor/ventas.php`
- **Descripción:** Interfaz tipo POS (Punto de Venta) optimizada para la velocidad. Permite buscar productos, añadirlos al carrito y procesar la venta en pocos clics.

### 4.6.5 Módulo de inventario

- **Archivo:** `app/Views/admin/productos.php`
- **Descripción:** Tabla interactiva para la gestión de productos. Permite acciones CRUD completas con modales para edición y creación, mejorando la experiencia de usuario al no recargar la página innecesariamente.

### 4.6.6 Módulo de reportes

- **Archivo:** `app/Views/admin/historial_ventas.php`
- **Descripción:** Vista detallada de transacciones pasadas. Incluye filtros por fecha y usuario, y un botón directo para exportar la data a CSV mediante el `ExportController`.

## 4.7 Link del Repositorio Git (Código)

### 4.7.1 URL del repositorio

*No hay información.* (El código reside actualmente en el entorno local: `c:\xampp\htdocs\dashboard\Botica`).

### 4.7.2 Descripción del contenido del repositorio

El repositorio alberga la totalidad del proyecto "Botica JhireFarma", estructurado de la siguiente manera:

- **app/**: Núcleo de la lógica de negocio (Controladores, Modelos, Vistas).
- **public/**: Punto de entrada web y recursos estáticos (CSS, JS, Imágenes).
- **tests/**: Suite de pruebas unitarias automatizadas.
- **docs/**: Documentación técnica, de seguridad y manuales de despliegue.
- **scripts/**: Herramientas de automatización para mantenimiento y despliegue.
