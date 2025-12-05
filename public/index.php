<?php
session_start();

require_once __DIR__ . '/../app/autoload.php';

use App\Controllers\AuthController;
use App\Controllers\ProductController;
use App\Controllers\SaleController;
use App\Controllers\AdminController;
use App\Controllers\ExportController;

// Simple Router
$route = $_GET['route'] ?? 'login';

// Security & CSRF Check
require_once __DIR__ . '/../app/Helpers/Security.php';
use App\Helpers\Security;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['csrf_token'] ?? '';
    if (!Security::verifyCsrfToken($token)) {
        error_log("CSRF Token Missing or Invalid for route: $route");
    }
}

// Auth Check Helper
function requireAuth($allowed_roles = []) {
    if (!isset($_SESSION['usuario_id'])) {
        header("Location: index.php?route=login");
        exit();
    }
    
    // If roles are specified, check if user has one of them
    if (!empty($allowed_roles)) {
        if (!in_array($_SESSION['rol'], $allowed_roles)) {
            die("Acceso denegado. Rol requerido: " . implode(' o ', $allowed_roles));
        }
    }
}

switch ($route) {
    case 'login':
        if (isset($_SESSION['usuario_id'])) {
            if ($_SESSION['rol'] === 'admin') {
                header("Location: index.php?route=admin/dashboard");
            } elseif ($_SESSION['rol'] === 'vendedor') {
                header("Location: index.php?route=vendedor/dashboard");
            } else {
                header("Location: index.php?route=cliente/dashboard");
            }
            exit();
        }
        require __DIR__ . '/../app/Views/auth/login.php';
        break;

    case 'logout':
        $auth = new AuthController();
        $auth->logout();
        break;

    // --- VENDEDOR ROUTES ---
    case 'vendedor/dashboard':
        requireAuth(['vendedor']);
        require __DIR__ . '/../app/Views/vendedor/inicio.php';
        break;
    case 'vendedor/productos':
        requireAuth(['vendedor']);
        require __DIR__ . '/../app/Views/vendedor/productos.php';
        break;
    case 'vendedor/ventas':
        requireAuth(['vendedor']);
        require __DIR__ . '/../app/Views/vendedor/ventas.php';
        break;
    case 'vendedor/historial':
        requireAuth(['vendedor']);
        require __DIR__ . '/../app/Views/vendedor/historial_ventas.php';
        break;

    // --- ADMIN ROUTES ---
    case 'admin/dashboard':
        requireAuth(['admin']);
        require __DIR__ . '/../app/Views/admin/inicio.php';
        break;
    case 'admin/usuarios':
        requireAuth(['admin']);
        require __DIR__ . '/../app/Views/admin/usuarios.php';
        break;
    case 'admin/productos':
        requireAuth(['admin']);
        require __DIR__ . '/../app/Views/admin/productos.php';
        break;
    case 'admin/ventas':
        requireAuth(['admin']);
        require __DIR__ . '/../app/Views/admin/ventas.php';
        break;
    case 'admin/logs':
        requireAuth(['admin']);
        require __DIR__ . '/../app/Views/admin/logs.php';
        break;
    case 'admin/historial':
        requireAuth(['admin']);
        require __DIR__ . '/../app/Views/admin/historial_ventas.php';
        break;

    // --- EXPORT ROUTES ---
    case 'export/history':
        requireAuth(['admin', 'vendedor', 'cliente']);
        $exporter = new ExportController();
        $exporter->exportHistory();
        break;

    // --- CLIENTE ROUTES ---
    case 'cliente/dashboard':
        requireAuth(['cliente']);
        require __DIR__ . '/../app/Views/cliente/inicio.php';
        break;
    case 'cliente/carrito':
        requireAuth(['cliente']);
        require __DIR__ . '/../app/Views/cliente/carrito.php';
        break;
    case 'cliente/pedidos':
        requireAuth(['cliente']);
        require __DIR__ . '/../app/Views/cliente/pedidos.php';
        break;

    default:
        echo "404 Not Found";
        break;
}
