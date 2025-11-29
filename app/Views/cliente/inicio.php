<?php
$pageTitle = 'Inicio | Cliente';
require __DIR__ . '/../layouts/header.php';
require __DIR__ . '/../layouts/navbar_cliente.php';

use App\Controllers\ProductController;
use App\Controllers\SaleController;

$productController = new ProductController();
$saleController = new SaleController();
$id_usuario = $_SESSION['usuario_id'];
$msg = '';

// Handle Add to Cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $id_producto = $_POST['id_producto'];
    $cantidad = (int)$_POST['cantidad'];
    if ($saleController->addToCart($id_usuario, $id_producto, $cantidad)) {
        $msg = "Producto agregado al carrito";
    } else {
        $msg = "Error al agregar al carrito";
    }
}

$productos = $productController->index();
?>

<div class="container mt-4">
    <div class="welcome-section mb-4" style="background: linear-gradient(135deg, #ff9966 0%, #ff5e62 100%);">
        <h1 class="display-5 fw-bold text-white">¡Bienvenido a Botica La Esquinita!</h1>
        <p class="lead text-white">Encuentra todo lo que necesitas para tu salud.</p>
    </div>

    <div id="cart-message" class="alert alert-info" style="display: none;"></div>
    <?php if ($msg): ?><div class="alert alert-info"><?php echo $msg; ?></div><?php endif; ?>

    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="🔍 Buscar productos..." onkeyup="filterProducts()">
    </div>

    <div class="row" id="productList">
        <?php while($prod = $productos->fetch_assoc()): ?>
        <div class="col-md-3 mb-4 product-card" data-name="<?php echo strtolower(htmlspecialchars($prod['nombre'])); ?>" data-category="<?php echo strtolower(htmlspecialchars($prod['categoria'])); ?>">
            <div class="card h-100 shadow-sm border-0">
                <img src="assets/img/<?php echo htmlspecialchars($prod['imagen']); ?>" class="card-img-top" alt="..." style="height:200px;object-fit:contain;padding:10px;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title"><?php echo htmlspecialchars($prod['nombre']); ?></h5>
                    <p class="card-text text-muted small"><?php echo htmlspecialchars($prod['categoria']); ?></p>
                    <div class="mt-auto">
                        <h4 class="text-primary fw-bold">S/ <?php echo number_format($prod['precio'],2); ?></h4>
                        <?php if ($prod['cantidad'] > 0): ?>
                        <form class="add-to-cart-form mt-2" data-product-id="<?php echo $prod['id']; ?>">
                            <input type="hidden" name="id_producto" value="<?php echo $prod['id']; ?>" />
                            <div class="d-grid gap-2">
                                <input type="hidden" name="cantidad" value="1" />
                                <button type="submit" class="btn btn-outline-primary">
                                    <i class="bi bi-cart-plus"></i> Agregar
                                </button>
                            </div>
                        </form>
                        <?php else: ?>
                            <button class="btn btn-secondary w-100 mt-2" disabled>Agotado</button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
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
            
            setTimeout(() => {
                messageDiv.style.display = 'none';
            }, 3000);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});
</script>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
