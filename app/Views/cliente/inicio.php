<?php
$pageTitle = 'Inicio | Cliente';
require __DIR__ . '/../layouts/header.php';
require __DIR__ . '/../layouts/navbar_cliente.php';

use App\Controllers\ProductController;
use App\Controllers\SaleController;

$productController = new ProductController();
$saleController = new SaleController();
$productos = $productController->index();
$id_usuario = $_SESSION['usuario_id'];
$nombre_usuario = $_SESSION['nombre'] ?? 'Cliente';
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
?>

<div class="container-fluid px-4 py-4">
    <!-- Welcome Section -->
    <div class="pharmacy-card mb-4 p-4 text-white text-center" style="background: var(--gradient-primary); border-radius: var(--radius-lg);">
        <div class="d-flex flex-column align-items-center justify-content-center">
            <div class="rounded-circle bg-white bg-opacity-25 p-3 mb-3">
                <i class="bi bi-person-circle fs-1"></i>
            </div>
            <div>
                <h1 class="display-5 fw-bold mb-2">Bienvenido a Botica JhireFarma</h1>
                <p class="lead mb-0 fs-5 opacity-90">
                    Cuidamos de ti y tu familia con los mejores productos.
                </p>
            </div>
        </div>
    </div>

    <div id="cart-message" class="alert" style="display: none;"></div>
    <?php if ($msg): ?><div class="alert alert-pharmacy fade-in"><?php echo $msg; ?></div><?php endif; ?>

    <!-- Search Section -->
    <div class="pharmacy-card mb-4 p-4 fade-in">
        <div class="row align-items-center">
            <div class="col-md-8 mx-auto">
                <div class="input-group input-group-lg">
                    <span class="input-group-text bg-white">
                        <i class="bi bi-search text-primary"></i>
                    </span>
                    <input type="text" id="searchInput" class="form-control form-control-lg" placeholder="¿Qué medicamento necesitas hoy?" onkeyup="filterProducts()">
                </div>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="row g-4" id="productList">
        <?php while($prod = $productos->fetch_assoc()): ?>
        <div class="col-lg-3 col-md-4 col-sm-6 fade-in" data-name="<?php echo strtolower(htmlspecialchars($prod['nombre'])); ?>" data-category="<?php echo strtolower(htmlspecialchars($prod['categoria'])); ?>">
            <div class="product-card h-100">
                <div class="product-card-header">
                    <img src="assets/<?php echo htmlspecialchars($prod['imagen']); ?>" class="card-img-top product-card-img" alt="<?php echo htmlspecialchars($prod['nombre']); ?>">
                </div>
                <div class="card-body d-flex flex-column p-4">
                    <span class="badge badge-pharmacy mb-2 align-self-start">
                        <?php echo htmlspecialchars($prod['categoria']); ?>
                    </span>
                    <h5 class="card-title mb-2 product-card-title">
                        <?php echo htmlspecialchars($prod['nombre']); ?>
                    </h5>
                    <div class="mt-auto">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="price-tag">
                                S/ <?php echo number_format($prod['precio'],2); ?>
                            </div>
                            <small class="text-muted">
                                <i class="bi bi-box-seam"></i> Stock: <?php echo $prod['cantidad']; ?>
                            </small>
                        </div>
                        <?php if ($prod['cantidad'] > 0): ?>
                        <form class="add-to-cart-form" data-product-id="<?php echo $prod['id']; ?>">
                            <input type="hidden" name="id_producto" value="<?php echo $prod['id']; ?>" />
                            <input type="hidden" name="cantidad" value="1" />
                            <button type="submit" class="btn-pharmacy-primary w-100">
                                <i class="bi bi-cart-plus me-2"></i>Agregar al Carrito
                            </button>
                        </form>
                        <?php else: ?>
                        <button class="btn btn-secondary w-100" disabled>
                            <i class="bi bi-x-circle me-2"></i>Agotado
                        </button>
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
