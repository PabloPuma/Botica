<?php
$pageTitle = 'Dashboard | Vendedor';
require __DIR__ . '/../layouts/header.php';
require __DIR__ . '/../layouts/navbar_vendedor.php';

use App\Config\Database;

$nombre_vendedor = $_SESSION['nombre'] ?? 'Vendedor';

// Direct queries for dashboard stats
$db = Database::getInstance()->getConnection();

$total_productos = $db->query("SELECT COUNT(*) as total FROM productos")->fetch_assoc()['total'];
$productos_bajo_stock = $db->query("SELECT COUNT(*) as total FROM productos WHERE cantidad < 10")->fetch_assoc()['total'];
$total_ventas_hoy = $db->query("SELECT COUNT(*) as total FROM ventas WHERE DATE(fecha) = CURDATE()")->fetch_assoc()['total'];
$ingresos_hoy = $db->query("SELECT COALESCE(SUM(total), 0) as total FROM ventas WHERE DATE(fecha) = CURDATE()")->fetch_assoc()['total'];

$productos_criticos = $db->query("SELECT nombre, cantidad FROM productos WHERE cantidad < 10 ORDER BY cantidad ASC LIMIT 5");
?>

<div class="container-fluid px-4 py-4">
    <!-- Welcome Section -->
    <!-- Welcome Section -->
    <div class="pharmacy-card mb-4 p-4 text-white" style="background: var(--gradient-primary); border-radius: var(--radius-lg);">
        <div class="d-flex align-items-center">
            <div class="rounded-circle bg-white bg-opacity-25 p-3 me-3">
                <i class="bi bi-person-badge-fill fs-2"></i>
            </div>
            <div>
                <h1 class="display-6 fw-bold mb-1">Bienvenido, <?php echo htmlspecialchars($nombre_vendedor); ?></h1>
                <p class="lead mb-0 fs-6 opacity-75">
                    <i class="bi bi-calendar-check me-2"></i>Panel de Control - <?php echo date('d/m/Y'); ?>
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
                        <i class="bi bi-box-seam stat-icon text-primary"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="text-muted mb-1 text-uppercase" style="font-size: 0.75rem;">Total Productos</h6>
                        <h2 class="mb-0 fw-bold"><?php echo $total_productos; ?></h2>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card bg-white h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-shrink-0 me-3">
                        <i class="bi bi-exclamation-triangle stat-icon text-warning"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="text-muted mb-1 text-uppercase" style="font-size: 0.75rem;">Bajo Stock</h6>
                        <h2 class="mb-0 fw-bold text-warning"><?php echo $productos_bajo_stock; ?></h2>
                        <small class="text-muted">Menos de 10 unidades</small>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card bg-white h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-shrink-0 me-3">
                        <i class="bi bi-cart-check stat-icon text-success"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="text-muted mb-1 text-uppercase" style="font-size: 0.75rem;">Ventas Hoy</h6>
                        <h2 class="mb-0 fw-bold text-success"><?php echo $total_ventas_hoy; ?></h2>
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

    <!-- Contenido principal -->
    <div class="row g-4">
        <!-- Productos con bajo stock -->
        <div class="col-lg-7">
            <div class="card content-card h-100">
                <div class="card-header bg-white border-0 pt-4 pb-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-exclamation-circle text-warning"></i> Productos con Bajo Stock
                    </h5>
                </div>
                <div class="card-body">
                    <?php if ($productos_criticos && $productos_criticos->num_rows > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-0">Producto</th>
                                    <th class="border-0 text-center">Stock Actual</th>
                                    <th class="border-0 text-center">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($prod = $productos_criticos->fetch_assoc()): ?>
                                <tr>
                                    <td class="fw-medium"><?php echo htmlspecialchars($prod['nombre']); ?></td>
                                    <td class="text-center">
                                        <span class="badge badge-stock <?php echo $prod['cantidad'] < 5 ? 'bg-danger' : 'bg-warning text-dark'; ?>">
                                            <?php echo $prod['cantidad']; ?> unidades
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($prod['cantidad'] < 5): ?>
                                            <span class="badge bg-danger"><i class="bi bi-exclamation-triangle"></i> Crítico</span>
                                        <?php else: ?>
                                            <span class="badge bg-warning text-dark"><i class="bi bi-exclamation-circle"></i> Bajo</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        <a href="index.php?route=vendedor/productos" class="btn btn-outline-primary">
                            <i class="bi bi-box-seam"></i> Ver todos los productos
                        </a>
                    </div>
                    <?php else: ?>
                    <div class="text-center py-5">
                        <i class="bi bi-check-circle text-success" style="font-size: 3rem;"></i>
                        <p class="text-muted mt-3 mb-0">Todos los productos tienen stock suficiente</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <!-- Accesos rápidos -->
        <div class="col-lg-5">
            <div class="card content-card h-100">
                <div class="card-header bg-white border-0 pt-4 pb-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-lightning-charge text-primary"></i> Accesos Rápidos
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-3">
                        <a href="index.php?route=vendedor/ventas" class="btn btn-success quick-action-btn d-flex align-items-center justify-content-between">
                            <span><i class="bi bi-cart-plus me-2"></i> Registrar Nueva Venta</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                        <a href="index.php?route=vendedor/productos" class="btn btn-primary quick-action-btn d-flex align-items-center justify-content-between">
                            <span><i class="bi bi-box-seam me-2"></i> Gestionar Productos</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                        <a href="index.php?route=vendedor/historial" class="btn btn-info quick-action-btn d-flex align-items-center justify-content-between">
                            <span><i class="bi bi-clock-history me-2"></i> Ver Historial de Ventas</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                    
                    <hr class="my-4">
                    
                    <div class="alert alert-light border mb-0" role="alert">
                        <h6 class="alert-heading fw-bold mb-2">
                            <i class="bi bi-info-circle text-primary"></i> Consejo del día
                        </h6>
                        <p class="mb-0 small">Revisa regularmente los productos con bajo stock para evitar quedarte sin inventario.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
