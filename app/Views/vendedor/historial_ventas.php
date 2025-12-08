<?php
$pageTitle = 'Historial de Ventas | Vendedor';
require __DIR__ . '/../layouts/header.php';
require __DIR__ . '/../layouts/navbar_vendedor.php';

use App\Config\Database;

// Direct query for now
$db = Database::getInstance()->getConnection();
$ventas = $db->query("
    SELECT v.*, u.nombre AS vendedor 
    FROM ventas v 
    JOIN usuarios u ON v.id_usuario = u.id 
    ORDER BY v.fecha DESC 
    LIMIT 100
");
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Historial de Ventas</h2>
        <a href="index.php?route=vendedor/dashboard" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <form id="filterForm" method="GET" action="index.php" class="row g-3 align-items-end">
                <input type="hidden" name="route" value="vendedor/historial">
                
                <div class="col-md-4">
                    <label class="form-label">Fecha Inicio</label>
                    <input type="date" id="startDate" name="start_date" class="form-control" value="<?php echo $_GET['start_date'] ?? ''; ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Fecha Fin</label>
                    <input type="date" id="endDate" name="end_date" class="form-control" value="<?php echo $_GET['end_date'] ?? ''; ?>">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="bi bi-filter"></i> Filtrar
                    </button>
                    <button type="button" onclick="exportToExcel()" class="btn btn-success">
                        <i class="bi bi-file-earmark-excel"></i> Exportar Excel
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID Venta</th>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Total (S/)</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // Use SalesDAO instead of direct query
                $salesDAO = new \App\Models\SalesDAO();
                $filters = [
                    'user_id' => $_SESSION['usuario_id'], // Restrict to own sales
                    'start_date' => $_GET['start_date'] ?? null,
                    'end_date' => $_GET['end_date'] ?? null
                ];
                $ventas = $salesDAO->getSalesHistory($filters);

                if ($ventas && $ventas->num_rows > 0): 
                    while($v = $ventas->fetch_assoc()): 
                ?>
                <tr>
                    <td><?php echo $v['id']; ?></td>
                    <td><?php echo htmlspecialchars($v['cliente_nombre']); ?></td>
                    <td><?php echo $v['fecha']; ?></td>
                    <td>S/ <?php echo number_format($v['total'], 2); ?></td>
                </tr>
                <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="4" class="text-center">No hay ventas registradas en este periodo</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function exportToExcel() {
    const startDate = document.getElementById('startDate').value;
    const endDate = document.getElementById('endDate').value;
    
    let url = 'index.php?route=export/history';
    if (startDate) url += '&start_date=' + startDate;
    if (endDate) url += '&end_date=' + endDate;
    
    window.open(url, '_blank');
}
</script>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
