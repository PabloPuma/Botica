<?php
$pageTitle = 'Logs del Sistema | Administrador';
require __DIR__ . '/../layouts/header.php';
require __DIR__ . '/../layouts/navbar_admin.php';

use App\Models\LogDAO;

$logDAO = new LogDAO();

// Obtener filtros
$filters = [];
if (isset($_GET['tipo_evento']) && !empty($_GET['tipo_evento'])) {
    $filters['tipo_evento'] = $_GET['tipo_evento'];
}
if (isset($_GET['rol']) && !empty($_GET['rol'])) {
    $filters['rol'] = $_GET['rol'];
}
if (isset($_GET['nivel']) && !empty($_GET['nivel'])) {
    $filters['nivel'] = $_GET['nivel'];
}
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $filters['search'] = $_GET['search'];
}
if (isset($_GET['fecha_inicio']) && !empty($_GET['fecha_inicio']) && 
    isset($_GET['fecha_fin']) && !empty($_GET['fecha_fin'])) {
    $filters['fecha_inicio'] = $_GET['fecha_inicio'] . ' 00:00:00';
    $filters['fecha_fin'] = $_GET['fecha_fin'] . ' 23:59:59';
}

// Paginación
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 50;
$offset = ($page - 1) * $limit;

// Obtener logs y total
$logs = $logDAO->getLogsWithFilters($filters, $limit, $offset);
$total_logs = $logDAO->getTotalCount($filters);
$total_pages = ceil($total_logs / $limit);
?>

<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>📋 Logs del Sistema</h2>
        <div class="text-muted">
            Total de registros: <strong><?php echo $total_logs; ?></strong>
        </div>
    </div>

    <!-- Filtros -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="bi bi-funnel"></i> Filtros</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="" class="row g-3">
                <input type="hidden" name="route" value="admin/logs">
                
                <div class="col-md-3">
                    <label class="form-label">Tipo de Evento</label>
                    <select name="tipo_evento" class="form-select">
                        <option value="">Todos</option>
                        <option value="login" <?php echo (isset($_GET['tipo_evento']) && $_GET['tipo_evento'] === 'login') ? 'selected' : ''; ?>>Login</option>
                        <option value="logout" <?php echo (isset($_GET['tipo_evento']) && $_GET['tipo_evento'] === 'logout') ? 'selected' : ''; ?>>Logout</option>
                        <option value="registro" <?php echo (isset($_GET['tipo_evento']) && $_GET['tipo_evento'] === 'registro') ? 'selected' : ''; ?>>Registro</option>
                        <option value="venta" <?php echo (isset($_GET['tipo_evento']) && $_GET['tipo_evento'] === 'venta') ? 'selected' : ''; ?>>Venta</option>
                        <option value="carrito" <?php echo (isset($_GET['tipo_evento']) && $_GET['tipo_evento'] === 'carrito') ? 'selected' : ''; ?>>Carrito</option>
                        <option value="producto" <?php echo (isset($_GET['tipo_evento']) && $_GET['tipo_evento'] === 'producto') ? 'selected' : ''; ?>>Producto</option>
                        <option value="usuario" <?php echo (isset($_GET['tipo_evento']) && $_GET['tipo_evento'] === 'usuario') ? 'selected' : ''; ?>>Usuario</option>
                        <option value="error" <?php echo (isset($_GET['tipo_evento']) && $_GET['tipo_evento'] === 'error') ? 'selected' : ''; ?>>Error</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label">Rol de Usuario</label>
                    <select name="rol" class="form-select">
                        <option value="">Todos</option>
                        <option value="cliente" <?php echo (isset($_GET['rol']) && $_GET['rol'] === 'cliente') ? 'selected' : ''; ?>>Cliente</option>
                        <option value="vendedor" <?php echo (isset($_GET['rol']) && $_GET['rol'] === 'vendedor') ? 'selected' : ''; ?>>Vendedor</option>
                        <option value="admin" <?php echo (isset($_GET['rol']) && $_GET['rol'] === 'admin') ? 'selected' : ''; ?>>Admin</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label">Nivel</label>
                    <select name="nivel" class="form-select">
                        <option value="">Todos</option>
                        <option value="info" <?php echo (isset($_GET['nivel']) && $_GET['nivel'] === 'info') ? 'selected' : ''; ?>>Info</option>
                        <option value="warning" <?php echo (isset($_GET['nivel']) && $_GET['nivel'] === 'warning') ? 'selected' : ''; ?>>Warning</option>
                        <option value="error" <?php echo (isset($_GET['nivel']) && $_GET['nivel'] === 'error') ? 'selected' : ''; ?>>Error</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label">Fecha Inicio</label>
                    <input type="date" name="fecha_inicio" class="form-control" value="<?php echo isset($_GET['fecha_inicio']) ? $_GET['fecha_inicio'] : ''; ?>">
                </div>

                <div class="col-md-2">
                    <label class="form-label">Fecha Fin</label>
                    <input type="date" name="fecha_fin" class="form-control" value="<?php echo isset($_GET['fecha_fin']) ? $_GET['fecha_fin'] : ''; ?>">
                </div>

                <div class="col-md-8">
                    <label class="form-label">Buscar en Descripción</label>
                    <input type="text" name="search" class="form-control" placeholder="Buscar..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                </div>

                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="bi bi-search"></i> Filtrar
                    </button>
                    <a href="index.php?route=admin/logs" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Limpiar
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabla de Logs -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-sm mb-0">
                    <thead class="table-dark sticky-top">
                        <tr>
                            <th style="width: 50px;">ID</th>
                            <th style="width: 150px;">Fecha/Hora</th>
                            <th style="width: 120px;">Usuario</th>
                            <th style="width: 80px;">Rol</th>
                            <th style="width: 100px;">Tipo</th>
                            <th>Descripción</th>
                            <th style="width: 120px;">IP</th>
                            <th style="width: 70px;">Nivel</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($logs->num_rows > 0): ?>
                            <?php while($log = $logs->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $log['id']; ?></td>
                                <td>
                                    <small><?php echo date('d/m/Y H:i:s', strtotime($log['fecha'])); ?></small>
                                </td>
                                <td>
                                    <?php if ($log['usuario_nombre']): ?>
                                        <small><?php echo htmlspecialchars($log['usuario_nombre']); ?></small>
                                    <?php else: ?>
                                        <small class="text-muted">Sistema</small>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($log['usuario_rol']): ?>
                                        <span class="badge <?php 
                                            echo $log['usuario_rol'] === 'admin' ? 'bg-danger' : 
                                                ($log['usuario_rol'] === 'vendedor' ? 'bg-success' : 'bg-info'); 
                                        ?>">
                                            <?php echo strtoupper($log['usuario_rol']); ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">N/A</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="badge bg-dark">
                                        <?php 
                                        $icons = [
                                            'login' => '🔓',
                                            'logout' => '🔒',
                                            'registro' => '📝',
                                            'venta' => '💰',
                                            'carrito' => '🛒',
                                            'producto' => '📦',
                                            'usuario' => '👤',
                                            'error' => '❌'
                                        ];
                                        echo ($icons[$log['tipo_evento']] ?? '') . ' ' . ucfirst($log['tipo_evento']); 
                                        ?>
                                    </span>
                                </td>
                                <td>
                                    <small><?php echo htmlspecialchars($log['descripcion']); ?></small>
                                </td>
                                <td>
                                    <small class="text-muted"><?php echo htmlspecialchars($log['ip_address']); ?></small>
                                </td>
                                <td>
                                    <span class="badge <?php 
                                        echo $log['nivel'] === 'error' ? 'bg-danger' : 
                                            ($log['nivel'] === 'warning' ? 'bg-warning text-dark' : 'bg-primary'); 
                                    ?>">
                                        <?php echo strtoupper($log['nivel']); ?>
                                    </span>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">
                                    No se encontraron logs con los filtros aplicados.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Paginación -->
    <?php if ($total_pages > 1): ?>
    <nav class="mt-4">
        <ul class="pagination justify-content-center">
            <?php if ($page > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="?route=admin/logs&page=<?php echo $page - 1; ?><?php echo http_build_query(array_diff_key($_GET, ['route' => '', 'page' => ''])) ? '&' . http_build_query(array_diff_key($_GET, ['route' => '', 'page' => ''])) : ''; ?>">
                        Anterior
                    </a>
                </li>
            <?php endif; ?>

            <?php 
            $start_page = max(1, $page - 2);
            $end_page = min($total_pages, $page + 2);
            
            for ($i = $start_page; $i <= $end_page; $i++): 
            ?>
                <li class="page-item <?php echo $i === $page ? 'active' : ''; ?>">
                    <a class="page-link" href="?route=admin/logs&page=<?php echo $i; ?><?php echo http_build_query(array_diff_key($_GET, ['route' => '', 'page' => ''])) ? '&' . http_build_query(array_diff_key($_GET, ['route' => '', 'page' => ''])) : ''; ?>">
                        <?php echo $i; ?>
                    </a>
                </li>
            <?php endfor; ?>

            <?php if ($page < $total_pages): ?>
                <li class="page-item">
                    <a class="page-link" href="?route=admin/logs&page=<?php echo $page + 1; ?><?php echo http_build_query(array_diff_key($_GET, ['route' => '', 'page' => ''])) ? '&' . http_build_query(array_diff_key($_GET, ['route' => '', 'page' => ''])) : ''; ?>">
                        Siguiente
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
    <?php endif; ?>
</div>

<style>
.table-responsive {
    max-height: 600px;
    overflow-y: auto;
}

.sticky-top {
    position: sticky;
    top: 0;
    z-index: 10;
}

.table-sm td, .table-sm th {
    padding: 0.5rem;
    vertical-align: middle;
}
</style>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
