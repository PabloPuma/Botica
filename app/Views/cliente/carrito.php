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
    $deliveryMethod = $_POST['delivery_method'] ?? 'tienda';
    $res = $saleController->checkout($id_usuario, $deliveryMethod);
    if (is_numeric($res)) {
        $success = "¡Pedido realizado con éxito! ID: " . $res;
    } else {
        $error = $res;
    }
}

// Handle Update Quantity
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_quantity'])) {
    $id_producto = $_POST['id_producto'];
    $nueva_cantidad = (int)$_POST['nueva_cantidad'];
    $saleController->updateCartItem($id_usuario, $id_producto, $nueva_cantidad);
    header("Location: index.php?route=cliente/carrito");
    exit();
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
    <h2><i class="bi bi-cart-fill me-2"></i>Mi Carrito de Compras</h2>
    
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
                        <td class="fw-medium">
                            <div class="d-flex align-items-center">
                                <img src="assets/<?php echo htmlspecialchars($item['imagen']); ?>" alt="" style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px;" class="rounded">
                                <div>
                                    <?php echo htmlspecialchars($item['nombre']); ?>
                                </div>
                            </div>
                        </td>
                        <td>S/ <?php echo number_format($item['precio'], 2); ?></td>
                        <td style="width: 150px;">
                            <form method="POST" class="d-flex">
                                <input type="hidden" name="id_producto" value="<?php echo $item['id_producto']; ?>">
                                <input type="hidden" name="update_quantity" value="1">
                                <input type="number" name="nueva_cantidad" value="<?php echo $item['cantidad']; ?>" min="1" class="form-control form-control-sm me-2" onchange="this.form.submit()">
                            </form>
                        </td>
                        <td class="fw-bold text-primary">S/ <?php echo number_format($subtotal, 2); ?></td>
                        <td>
                            <a href="index.php?route=cliente/carrito&remove=<?php echo $item['id_producto']; ?>" class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i>
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
    <div class="row mt-4">
        <div class="col-md-6 offset-md-6">
            <div class="card">
                <div class="card-header bg-white fw-bold">
                    <i class="bi bi-truck"></i> Método de Entrega
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="delivery_method" id="deliveryTienda" value="tienda" checked>
                                <label class="form-check-label" for="deliveryTienda">
                                    <i class="bi bi-shop"></i> Recoger en Tienda (Gratis)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="delivery_method" id="deliveryHome" value="delivery">
                                <label class="form-check-label" for="deliveryHome">
                                    <i class="bi bi-bicycle"></i> Delivery a Domicilio
                                </label>
                            </div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" name="checkout" class="btn btn-success btn-lg">
                                <i class="bi bi-credit-card"></i> Pagar Ahora
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
