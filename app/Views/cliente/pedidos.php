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
    <h2>📦 Mis Pedidos</h2>
    <p class="text-muted">Historial de tus compras realizadas.</p>

    <div class="row">
        <?php if ($pedidos && $pedidos->num_rows > 0): ?>
            <?php while($p = $pedidos->fetch_assoc()): ?>
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
                <p class="mt-3">Aún no has realizado ningún pedido.</p>
                <a href="index.php?route=cliente/dashboard" class="btn btn-primary">Ir a comprar</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
