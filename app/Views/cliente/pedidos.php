<?php
$pageTitle = 'Mis Pedidos | Cliente';
require __DIR__ . '/../layouts/header.php';
require __DIR__ . '/../layouts/navbar_cliente.php';

use App\Config\Database;

$id_usuario = $_SESSION['usuario_id'];
$db = Database::getInstance()->getConnection();

// Fetch user's orders
$stmt = $db->prepare("SELECT * FROM ventas WHERE id_usuario = ? ORDER BY fecha DESC");
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$pedidos = $stmt->get_result();
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-bag-check-fill me-2"></i>Mis Pedidos</h2>
        <a href="index.php?route=cliente/dashboard" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="index.php" class="row g-3 align-items-end">
                <input type="hidden" name="route" value="cliente/pedidos">
                
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

    <div class="row">
        <?php 
        $salesDAO = new \App\Models\SalesDAO();
        $filters = [
            'user_id' => $_SESSION['usuario_id'],
            'start_date' => $_GET['start_date'] ?? null,
            'end_date' => $_GET['end_date'] ?? null
        ];
        $pedidos = $salesDAO->getSalesHistory($filters);

        if ($pedidos && $pedidos->num_rows > 0): 
            while($p = $pedidos->fetch_assoc()): 
        ?>
            <div class="col-md-6 mb-3">
                <div class="card shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <span class="fw-bold">Pedido #<?php echo $p['id']; ?></span>
                        <span class="text-muted small"><?php echo $p['fecha']; ?></span>
                    </div>
                    <div class="card-body">
                        <h3 class="text-success mb-0">S/ <?php echo number_format($p['total'], 2); ?></h3>
                        <p class="mb-0 text-muted">Total pagado</p>
                    </div>
                    <div class="card-footer bg-light">
                        <span class="badge bg-success">Completado</span>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12 text-center py-5">
                <i class="bi bi-bag-x text-muted" style="font-size: 3rem;"></i>
                <p class="mt-3">No se encontraron pedidos en este periodo.</p>
                <a href="index.php?route=cliente/dashboard" class="btn btn-primary">Ir a comprar</a>
            </div>
        <?php endif; ?>
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
