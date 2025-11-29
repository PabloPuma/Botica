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
    <h2>📊 Historial de Ventas</h2>
    <p class="text-muted">Últimas 100 ventas registradas</p>
    
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID Venta</th>
                <th>Vendedor</th>
                <th>Fecha</th>
                <th>Total (S/)</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($ventas && $ventas->num_rows > 0): ?>
                <?php while($v = $ventas->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $v['id']; ?></td>
                    <td><?php echo htmlspecialchars($v['vendedor']); ?></td>
                    <td><?php echo $v['fecha']; ?></td>
                    <td>S/ <?php echo number_format($v['total'], 2); ?></td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="4" class="text-center">No hay ventas registradas</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
