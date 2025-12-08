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

if (isset($_GET['error'])) {
    $error = htmlspecialchars($_GET['error']);
}
// Handle Checkout
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout'])) {
    $res = $saleController->checkout($id_usuario);
    if (is_numeric($res)) {
        // Redirect to Boleta
        header("Location: index.php?route=comprobante&id=" . $res);
        exit();
    } else {
        $error = $res;
    }
}

// Manejar eliminación de ítem
if (isset($_GET['remove'])) {
    $id_prod = $_GET['remove'];
    $saleController->removeFromCart($id_usuario, $id_prod);
    header("Location: index.php?route=vendedor/ventas");
    exit();
}

// Manejar actualización de cantidad
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_quantity'])) {
    $id_producto = $_POST['id_producto'];
    $nueva_cantidad = (int)$_POST['nueva_cantidad'];
    $res = $saleController->updateCartItem($id_usuario, $id_producto, $nueva_cantidad);
    
    if ($res === true) {
        header("Location: index.php?route=vendedor/ventas");
    } else {
        header("Location: index.php?route=vendedor/ventas&error=" . urlencode($res));
    }
    exit();
}

// Manejar agregar al carrito
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $id_producto = $_POST['id_producto'];
    $cantidad = (int)$_POST['cantidad'];
    $res = $saleController->addToCart($id_usuario, $id_producto, $cantidad);

    if ($res === true) {
        $msg = "Producto agregado al carrito";
    } elseif (is_string($res)) {
        $error = $res;
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
            <!-- Client Identification Section -->
            <div class="card mb-3">
                <div class="card-body p-2">
                    <h6 class="card-title">Datos del Cliente</h6>
                    <div class="input-group mb-2">
                        <input type="text" id="clientDni" class="form-control form-control-sm" placeholder="DNI" maxlength="8">
                        <button class="btn btn-sm btn-info" type="button" onclick="searchClient()">Buscar</button>
                    </div>
                    <div id="clientInfo" class="small mb-2 fw-bold text-primary"></div>
                    <button id="btnRegisterClient" class="btn btn-sm btn-warning w-100 mb-2" style="display:none;" data-bs-toggle="modal" data-bs-target="#registerClientModal">Registrar Nuevo Cliente</button>
                    <input type="text" id="clientNameDisplay" class="form-control form-control-sm mb-2" placeholder="Nombre del Cliente (o buscar por DNI)">
                </div>
            </div>

            <form method="POST" id="checkoutForm">
                <input type="hidden" name="client_id" id="checkoutClientId">
                <input type="hidden" name="checkout" value="1">
                <button type="button" onclick="handleCheckout()" class="btn btn-success w-100 btn-lg">Registrar Venta</button>
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
                        <img src="assets/<?php echo htmlspecialchars($prod['imagen']); ?>" class="card-img-top" alt="..." style="height:150px;object-fit:contain;">
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



<!-- Modal Register Client -->
<div class="modal fade" id="registerClientModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registrar Nuevo Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-2">
                    <label>DNI</label>
                    <input type="text" id="regDni" class="form-control" maxlength="8">
                </div>
                <div class="mb-2">
                    <label>Nombre Completo</label>
                    <input type="text" id="regNombre" class="form-control">
                </div>
                <div class="mb-2">
                    <label>Dirección</label>
                    <input type="text" id="regDireccion" class="form-control">
                </div>
                <div class="mb-2">
                    <label>Teléfono</label>
                    <input type="text" id="regTelefono" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="registerClient()">Guardar</button>
            </div>
        </div>
    </div>
</div>

<script>
function searchClient() {
    const dni = document.getElementById('clientDni').value;
    if (dni.length < 8) { alert("Ingrese DNI de 8 dígitos"); return; }
    
    fetch('api/search_client.php?dni=' + dni)
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            document.getElementById('clientInfo').innerText = "Cliente Encontrado";
            document.getElementById('clientNameDisplay').value = data.data.nombre;
            document.getElementById('checkoutClientId').value = data.data.id;
            document.getElementById('btnRegisterClient').style.display = 'none';
        } else {
            document.getElementById('clientInfo').innerText = "Cliente no encontrado";
            document.getElementById('clientNameDisplay').value = "";
            document.getElementById('checkoutClientId').value = "";
            document.getElementById('btnRegisterClient').style.display = 'block';
            
            // Pre-fill modal DNI
            document.getElementById('regDni').value = dni;
        }
    });
}

function registerClient() {
    const dni = document.getElementById('regDni').value;
    const nombre = document.getElementById('regNombre').value;
    const direccion = document.getElementById('regDireccion').value;
    const telefono = document.getElementById('regTelefono').value;

    const formData = new FormData();
    formData.append('dni', dni);
    formData.append('nombre', nombre);
    formData.append('direccion', direccion);
    formData.append('telefono', telefono);

    fetch('api/register_client.php', { method: 'POST', body: formData })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            // Auto Select
            document.getElementById('clientDni').value = dni;
            document.getElementById('clientNameDisplay').value = nombre;
            document.getElementById('checkoutClientId').value = data.id;
            
            // Close modal
            var modalEl = document.getElementById('registerClientModal');
            var modal = bootstrap.Modal.getInstance(modalEl);
            modal.hide();
            
            document.getElementById('btnRegisterClient').style.display = 'none';
        } else {
            alert(data.message);
        }
    });

}

function handleCheckout() {
    const clientId = document.getElementById('checkoutClientId').value;
    const dni = document.getElementById('clientDni').value.trim();
    const nombre = document.getElementById('clientNameDisplay').value.trim();
    
    // If client selected (ID exists), or fields empty (Anonymous), submit directly
    if (clientId || (!dni && !nombre)) {
        document.getElementById('checkoutForm').submit();
        return;
    }
    
    // If DNI and Name provided but no ID (Manual Entry), try to register/find
    if (dni && nombre) {
        if (dni.length !== 8) {
            alert("El DNI debe tener 8 dígitos.");
            return;
        }
        
        // Auto-register "Quick Client"
        const formData = new FormData();
        formData.append('dni', dni);
        formData.append('nombre', nombre);
        formData.append('direccion', '-'); // Default
        formData.append('telefono', '-'); // Default
        
        fetch('api/register_client.php', { method: 'POST', body: formData })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                document.getElementById('checkoutClientId').value = data.id;
                document.getElementById('checkoutForm').submit();
            } else {
                // If error (e.g. DNI exists), try search first or alert
                // Loose check for "existe", "duplicado", or "registrado"
                const msg = data.message.toLowerCase();
                if (msg.includes('exist') || msg.includes('duplic') || msg.includes('registrado')) {
                    // Try to search to get ID
                    fetch('api/search_client.php?dni=' + dni)
                    .then(r => r.json())
                    .then(d => {
                        if (d.success) {
                            document.getElementById('checkoutClientId').value = d.data.id;
                            document.getElementById('checkoutForm').submit();
                        } else {
                            alert("Error: El cliente ya existe pero no se pudo recuperar. Busquele por DNI. " + data.message);
                        }
                    });
                } else {
                     alert("Error al registrar: " + data.message);
                }
            }
        })
        .catch(err => {
            console.error(err);
            alert("Error de conexión: " + err.message);
        });
    } else {
        // Partial info
        alert("Para registrar un cliente rápido, ingrese DNI y Nombre.");
    }
}

// AJAX para agregar al carrito - previene recarga de página y desplazamiento
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
