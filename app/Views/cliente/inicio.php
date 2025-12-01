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
                    </span>
                    <span class="badge bg-white text-primary px-4 py-2">
                        <i class="bi bi-cash-coin"></i> Mejores Precios
                    </span>
                </div>
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
        <div class="col-lg-3 col-md-4 col-sm-6 product-card fade-in" data-name="<?php echo strtolower(htmlspecialchars($prod['nombre'])); ?>" data-category="<?php echo strtolower(htmlspecialchars($prod['categoria'])); ?>">
            <div class="product-card h-100">
                <div style="position: relative; overflow: hidden; border-radius: var(--radius-lg) var(--radius-lg) 0 0; background: white;">
                    <?php if ($prod['oferta'] === 'Si'): ?>
                    <span class="badge bg-danger position-absolute top-0 end-0 m-3">
                        <i class="bi bi-lightning-fill"></i> OFERTA
                    </span>
                    <?php endif; ?>
                    <img src="assets/<?php echo htmlspecialchars($prod['imagen']); ?>" class="card-img-top p-3" alt="<?php echo htmlspecialchars($prod['nombre']); ?>" style="height:220px;object-fit:contain;">
                </div>
                <div class="card-body d-flex flex-column p-4">
                    <span class="badge badge-pharmacy mb-2 align-self-start">
                        <?php echo htmlspecialchars($prod['categoria']); ?>
                    </span>
                    <h5 class="card-title mb-2" style="min-height: 2.5rem;">
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
