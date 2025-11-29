<?php
$pageTitle = 'Ventas | Vendedor';
require __DIR__ . '/../layouts/header.php';
require __DIR__ . '/../layouts/navbar_vendedor.php';

use App\Controllers\SaleController;
use App\Controllers\ProductController;

$saleController = new SaleController();
$productController = new ProductController();

$id_usuario = $_SESSION['usuario_id'];
$success = '';
$error = '';
$msg = '';

// Handle Checkout
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout'])) {
    $res = $saleController->checkout($id_usuario);
    if (is_numeric($res)) {
        $success = "Venta registrada con éxito! ID Venta: " . $res;
    } else {
        $error = $res;
    }
}

// Handle Remove Item
if (isset($_GET['remove'])) {
    $id_prod = $_GET['remove'];
    $saleController->removeFromCart($id_usuario, $id_prod);
    header("Location: index.php?route=vendedor/ventas");
    exit();
}

// Handle Update Quantity
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_quantity'])) {
    $id_producto = $_POST['id_producto'];
    $nueva_cantidad = (int)$_POST['nueva_cantidad'];
    $saleController->updateCartItem($id_usuario, $id_producto, $nueva_cantidad);
    header("Location: index.php?route=vendedor/ventas");
    exit();
}

// Handle Add to Cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $id_producto = $_POST['id_producto'];
    $cantidad = (int)$_POST['cantidad'];
    if ($saleController->addToCart($id_usuario, $id_producto, $cantidad)) {
        $msg = "Producto agregado al carrito";
    } else {
        $error = "Error al agregar al carrito";
    }
}

$carrito = $saleController->getCart($id_usuario);
$productos = $productController->index();
$total = 0;
?>

<div class="container mt-4">
    <div class="row">
        <!-- Carrito (lado izquierdo) -->
        <div class="col-md-4">
            <h3>Carrito de Venta</h3>
            <div id="cart-message" class="alert alert-info" style="display: none;"></div>
            <?php if ($success): ?><div class="alert alert-success"><?php echo $success; ?></div><?php endif; ?>
            <?php if ($error): ?><div class="alert alert-danger"><?php echo $error; ?></div><?php endif; ?>
            <?php if ($msg): ?><div class="alert alert-info"><?php echo $msg; ?></div><?php endif; ?>
            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cant.</th>
                        <th>Subtotal</th>
                        <th>Acción</th>
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
                        <td><?php echo htmlspecialchars($item['nombre']); ?></td>
                        <td>S/ <?php echo number_format($item['precio'], 2); ?></td>
                        <td>
                            <form method="POST" class="d-inline" id="form-<?php echo $item['id_producto']; ?>">
                                <input type="hidden" name="id_producto" value="<?php echo $item['id_producto']; ?>">
                                <input type="hidden" name="update_quantity" value="1">
                                <input type="number" name="nueva_cantidad" value="<?php echo $item['cantidad']; ?>" min="1" class="form-control form-control-sm" style="width:60px;" onchange="this.form.submit()">
                            </form>
                        </td>
                        <td>S/ <?php echo number_format($subtotal, 2); ?></td>
                        <td><a href="index.php?route=vendedor/ventas&remove=<?php echo $item['id_producto']; ?>" class="btn btn-sm btn-danger">X</a></td>
                    </tr>
                    <?php endwhile; 
                    else: ?>
                    <tr><td colspan="5" class="text-center">Carrito vacío</td></tr>
                    <?php endif; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-end">Total:</th>
                        <th>S/ <?php echo number_format($total, 2); ?></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
            
            <?php if ($total > 0): ?>
            <form method="POST">
                <button type="submit" name="checkout" class="btn btn-success w-100 btn-lg">Registrar Venta</button>
            </form>
            <?php endif; ?>
        </div>
        
        <!-- Catálogo de productos (lado derecho) -->
        <div class="col-md-8">
            <h2>Catálogo de Productos</h2>
            <div class="mb-3">
                <input type="text" id="searchInput" class="form-control" placeholder="🔍 Buscar producto..." onkeyup="filterProducts()">
            </div>
            <div class="row" id="productList">
                <?php while($prod = $productos->fetch_assoc()): ?>
                <div class="col-md-4 mb-4 product-card" data-name="<?php echo strtolower(htmlspecialchars($prod['nombre'])); ?>" data-category="<?php echo strtolower(htmlspecialchars($prod['categoria'])); ?>">
                    <div class="card h-100">
                        <img src="assets/img/<?php echo htmlspecialchars($prod['imagen']); ?>" class="card-img-top" alt="..." style="height:150px;object-fit:contain;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?php echo htmlspecialchars($prod['nombre']); ?></h5>
                            <p class="card-text text-muted small"><?php echo htmlspecialchars($prod['categoria']); ?></p>
                            <div class="mt-auto">
                                <h5 class="text-success">S/ <?php echo number_format($prod['precio'],2); ?></h5>
                                <p class="small">Stock: <?php echo $prod['cantidad']; ?></p>
                                <?php if ($prod['cantidad'] > 0): ?>
                                <form class="add-to-cart-form" data-product-id="<?php echo $prod['id']; ?>">
                                    <input type="hidden" name="id_producto" value="<?php echo $prod['id']; ?>" />
                                    <div class="input-group input-group-sm">
                                        <input type="number" name="cantidad" class="form-control" value="1" min="1" max="<?php echo $prod['cantidad']; ?>" />
                                        <button type="submit" class="btn btn-primary">+</button>
                                    </div>
                                </form>
                                <?php else: ?>
                                    <button class="btn btn-secondary btn-sm w-100" disabled>Agotado</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</div>

<script>
// AJAX for add to cart - prevents page reload and scroll
document.querySelectorAll('.add-to-cart-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const messageDiv = document.getElementById('cart-message');
        
        fetch('api/add_to_cart.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            messageDiv.textContent = data.message;
            messageDiv.className = data.success ? 'alert alert-success' : 'alert alert-danger';
            messageDiv.style.display = 'block';
            
            // Reload page after 1 second to update cart display
            if (data.success) {
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});
</script>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
