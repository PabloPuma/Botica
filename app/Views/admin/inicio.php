<?php
$pageTitle = 'Dashboard | Administrador';
require __DIR__ . '/../layouts/header.php';
require __DIR__ . '/../layouts/navbar_admin.php';

use App\Config\Database;

$nombre_admin = $_SESSION['nombre'] ?? 'Administrador';

// Direct queries for dashboard stats
$db = Database::getInstance()->getConnection();

$total_productos = $db->query("SELECT COUNT(*) as total FROM productos")->fetch_assoc()['total'];
$total_usuarios = $db->query("SELECT COUNT(*) as total FROM usuarios")->fetch_assoc()['total'];
$total_ventas_hoy = $db->query("SELECT COUNT(*) as total FROM ventas WHERE DATE(fecha) = CURDATE()")->fetch_assoc()['total'];
$ingresos_hoy = $db->query("SELECT COALESCE(SUM(total), 0) as total FROM ventas WHERE DATE(fecha) = CURDATE()")->fetch_assoc()['total'];

?>

<div class="container-fluid px-4 py-4">
    <!-- Welcome Section -->
    <!-- Welcome Section -->
    <div class="pharmacy-card mb-4 p-4 text-white" style="background: var(--gradient-primary); border-radius: var(--radius-lg);">
        <div class="d-flex align-items-center">
            <div class="rounded-circle bg-white bg-opacity-25 p-3 me-3">
                <i class="bi bi-shield-lock-fill fs-2"></i>
            </div>
            <div>
                <h1 class="display-6 fw-bold mb-1">Bienvenido, <?php echo htmlspecialchars($nombre_admin); ?></h1>
                <p class="lead mb-0 fs-6 opacity-75">
                    <i class="bi bi-calendar-event me-2"></i>Panel de Administración - <?php echo date('d/m/Y'); ?>
                </p>
            </div>
        </div>
    </div>

    <!-- Estadísticas principales -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card bg-white h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-shrink-0 me-3">
                        <i class="bi bi-people-fill stat-icon text-primary"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="text-muted mb-1 text-uppercase" style="font-size: 0.75rem;">Total Usuarios</h6>
                        <h2 class="mb-0 fw-bold"><?php echo $total_usuarios; ?></h2>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card bg-white h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-shrink-0 me-3">
                        <i class="bi bi-box-seam stat-icon text-success"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="text-muted mb-1 text-uppercase" style="font-size: 0.75rem;">Total Productos</h6>
                        <h2 class="mb-0 fw-bold text-success"><?php echo $total_productos; ?></h2>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card bg-white h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-shrink-0 me-3">
                        <i class="bi bi-cart-check stat-icon text-warning"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="text-muted mb-1 text-uppercase" style="font-size: 0.75rem;">Ventas Hoy</h6>
                        <h2 class="mb-0 fw-bold text-warning"><?php echo $total_ventas_hoy; ?></h2>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card bg-white h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-shrink-0 me-3">
                        <i class="bi bi-cash-stack stat-icon text-info"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="text-muted mb-1 text-uppercase" style="font-size: 0.75rem;">Ingresos Hoy</h6>
                        <h2 class="mb-0 fw-bold text-info">S/ <?php echo number_format($ingresos_hoy, 2); ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Accesos rápidos -->
    <div class="row g-4">
        <div class="col-lg-12">
            <div class="card content-card h-100">
                <div class="card-header bg-white border-0 pt-4 pb-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-lightning-charge text-primary"></i> Gestión Administrativa
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <a href="index.php?route=admin/usuarios" class="btn btn-outline-primary w-100 p-3 d-flex flex-column align-items-center">
                                <i class="bi bi-person-plus-fill fs-1 mb-2"></i>
                                <span class="fw-bold">Gestionar Usuarios</span>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="index.php?route=admin/productos" class="btn btn-outline-success w-100 p-3 d-flex flex-column align-items-center">
                                <i class="bi bi-box-seam fs-1 mb-2"></i>
                                <span class="fw-bold">Inventario Global</span>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="index.php?route=admin/ventas" class="btn btn-outline-info w-100 p-3 d-flex flex-column align-items-center">
                                <i class="bi bi-file-earmark-bar-graph fs-1 mb-2"></i>
                                <span class="fw-bold">Reportes de Ventas</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
