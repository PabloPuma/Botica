<?php
$pageTitle = 'Mi Carrito | Cliente';
require __DIR__ . '/../layouts/header.php';
require __DIR__ . '/../layouts/navbar_cliente.php';

use App\Controllers\SaleController;

$saleController = new SaleController();
$id_usuario = $_SESSION['usuario_id'];
$success = '';
$error = '';

// Handle Checkout
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout'])) {
    $res = $saleController->checkout($id_usuario);
    if (is_numeric($res)) {
        $success = "¡Pedido realizado con éxito! ID: " . $res;
    } else {
        $error = $res;
    }
}

// Handle Remove
if (isset($_GET['remove'])) {
    $saleController->removeFromCart($id_usuario, $_GET['remove']);
    header("Location: index.php?route=cliente/carrito");
    exit();
}

$carrito = $saleController->getCart($id_usuario);
$total = 0;
?>

<div class="container mt-4">
    <h2>🛒 Mi Carrito de Compras</h2>
    
    <?php if ($success): ?><div class="alert alert-success"><?php echo $success; ?></div><?php endif; ?>
    <?php if ($error): ?><div class="alert alert-danger"><?php echo $error; ?></div><?php endif; ?>

    <div class="card shadow-sm mt-3">
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Producto</th>
                        <th>Precio Unitario</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if ($carrito && $carrito->num_rows > 0):
                        while($item = $carrito->fetch_assoc()): 
                            $subtotal = $item['precio'] * $item['cantidad'];
                            $total += $subtotal;
                    ?>
                    <tr>
                        <td class="fw-medium"><?php echo htmlspecialchars($item['nombre']); ?></td>
                        <td>S/ <?php echo number_format($item['precio'], 2); ?></td>
                        <td><?php echo $item['cantidad']; ?></td>
                        <td class="fw-bold text-primary">S/ <?php echo number_format($subtotal, 2); ?></td>
                        <td>
                            <a href="index.php?route=cliente/carrito&remove=<?php echo $item['id_producto']; ?>" class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i> Eliminar
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; 
                    else: ?>
                    <tr><td colspan="5" class="text-center py-4">Tu carrito está vacío. <a href="index.php?route=cliente/dashboard">Ir a comprar</a></td></tr>
                    <?php endif; ?>
                </tbody>
                <?php if ($total > 0): ?>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-end fw-bold fs-5">Total a Pagar:</td>
                        <td class="fw-bold fs-5 text-success">S/ <?php echo number_format($total, 2); ?></td>
                        <td></td>
                    </tr>
                </tfoot>
                <?php endif; ?>
            </table>
        </div>
    </div>

    <?php if ($total > 0): ?>
    <div class="d-flex justify-content-end mt-4">
        <form method="POST">
            <button type="submit" name="checkout" class="btn btn-success btn-lg px-5">
                <i class="bi bi-credit-card"></i> Pagar Ahora
            </button>
        </form>
    </div>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
