<?php
$pageTitle = 'Historial de Ventas | Administrador';
require __DIR__ . '/../layouts/header.php';
require __DIR__ . '/../layouts/navbar_admin.php';

use App\Models\SalesDAO;
use App\Models\UserDAO;

// Fetch users for the filter dropdown
$db = \App\Config\Database::getInstance()->getConnection();
$users = $db->query("SELECT id, nombre, usuario, rol FROM usuarios ORDER BY nombre ASC");

// Get History
$salesDAO = new SalesDAO();
$filters = [
    'start_date' => $_GET['start_date'] ?? null,
    'end_date' => $_GET['end_date'] ?? null,
    'role' => $_GET['role'] ?? null,
    'user_id' => $_GET['user_id'] ?? null
];
$ventas = $salesDAO->getSalesHistory($filters);
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Historial General de Ventas</h2>
        <a href="index.php?route=admin/dashboard" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-white">
            <h5 class="mb-0"><i class="bi bi-funnel"></i> Filtros de Búsqueda</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="index.php" class="row g-3">
                <input type="hidden" name="route" value="admin/historial">
                
                <div class="col-md-3">
                    <label class="form-label">Fecha Inicio</label>
                    <input type="date" id="startDate" name="start_date" class="form-control" value="<?php echo $_GET['start_date'] ?? ''; ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Fecha Fin</label>
                    <input type="date" id="endDate" name="end_date" class="form-control" value="<?php echo $_GET['end_date'] ?? ''; ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Rol</label>
                    <select id="roleSelect" name="role" class="form-select">
                        <option value="">Todos</option>
                        <option value="cliente" <?php echo (isset($_GET['role']) && $_GET['role'] === 'cliente') ? 'selected' : ''; ?>>Cliente</option>
                        <option value="vendedor" <?php echo (isset($_GET['role']) && $_GET['role'] === 'vendedor') ? 'selected' : ''; ?>>Vendedor</option>
                        <option value="admin" <?php echo (isset($_GET['role']) && $_GET['role'] === 'admin') ? 'selected' : ''; ?>>Admin</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Usuario</label>
                    <select id="userSelect" name="user_id" class="form-select">
                        <option value="">Todos</option>
                        <?php 
                        if ($users) {
                            $users->data_seek(0); // Reset pointer
                            while($u = $users->fetch_assoc()): 
                        ?>
                            <option value="<?php echo $u['id']; ?>" <?php echo (isset($_GET['user_id']) && $_GET['user_id'] == $u['id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($u['nombre'] . ' (' . $u['usuario'] . ')'); ?>
                            </option>
                        <?php endwhile; } ?>
                    </select>
                </div>
                
                <div class="col-12 d-flex justify-content-end gap-2">
                    <a href="index.php?route=admin/historial" class="btn btn-outline-secondary">Limpiar</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search"></i> Buscar
                    </button>
                    <button type="button" onclick="exportToExcel()" class="btn btn-success">
                        <i class="bi bi-file-earmark-excel"></i> Exportar Excel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Vendedor</th>
                    <th>Cliente</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($ventas && $ventas->num_rows > 0): ?>
                    <?php while($v = $ventas->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $v['id']; ?></td>
                        <td><?php echo $v['fecha']; ?></td>
                        <td>
                            <?php if ($v['vendedor_nombre']): ?>
                                <div class="fw-bold"><?php echo htmlspecialchars($v['vendedor_nombre']); ?></div>
                                <small class="text-muted"><?php echo htmlspecialchars($v['vendedor_usuario']); ?></small>
                                <br><span class="badge bg-success"><?php echo ucfirst($v['vendedor_rol']); ?></span>
                            <?php else: ?>
                                <span class="text-muted">Auto-registro</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="fw-bold"><?php echo htmlspecialchars($v['cliente_nombre']); ?></div>
                            <small class="text-muted"><?php echo htmlspecialchars($v['cliente_usuario']); ?></small>
                            <br><span class="badge bg-info"><?php echo ucfirst($v['cliente_rol']); ?></span>
                        </td>
                        <td class="fw-bold text-success">S/ <?php echo number_format($v['total'], 2); ?></td>
                        <td>
                            <!-- Future: View Details -->
                            <button class="btn btn-sm btn-outline-info" title="Ver Detalles (Próximamente)">
                                <i class="bi bi-eye"></i>
                            </button>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="6" class="text-center py-4">No se encontraron registros con los filtros seleccionados.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function exportToExcel() {
    const startDate = document.getElementById('startDate').value;
    const endDate = document.getElementById('endDate').value;
    const role = document.getElementById('roleSelect').value;
    const userId = document.getElementById('userSelect').value;
    
    let url = 'index.php?route=export/history';
    if (startDate) url += '&start_date=' + startDate;
    if (endDate) url += '&end_date=' + endDate;
    if (role) url += '&role=' + role;
    if (userId) url += '&user_id=' + userId;
    
    window.open(url, '_blank');
}
</script>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
