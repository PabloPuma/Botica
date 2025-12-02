<?php
$pageTitle = 'Productos | Administrador';
require __DIR__ . '/../layouts/header.php';
require __DIR__ . '/../layouts/navbar_admin.php';

use App\Controllers\ProductController;

$productController = new ProductController();
$msg = '';

// Handle Add Stock
if (isset($_POST['add_stock'])) {
    $id = $_POST['id_producto'];
    $cant = $_POST['cantidad'];
    $res = $productController->addStock($id, $cant);
    if ($res === true) {
        $msg = "Stock actualizado.";
    } else {
        $msg = $res;
    }
}

// Handle Create Product
if (isset($_POST['create_product'])) {
    $res = $productController->create($_POST);
    if ($res === true) {
        $msg = "Producto creado.";
    } else {
        $msg = $res;
    }
}

$productos = $productController->index();
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Gestión de Inventario (Admin)</h2>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#newProductModal">
            <i class="bi bi-plus-circle"></i> Nuevo Producto
        </button>
    </div>

    <?php if (!empty($msg)): ?><div class="alert alert-info"><?php echo $msg; ?></div><?php endif; ?>

    <!-- Buscador -->
    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="🔍 Buscar producto por nombre o categoría..." onkeyup="filterProducts()">
    </div>

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="productTableBody">
            <?php while($p = $productos->fetch_assoc()): ?>
            <tr class="product-row" data-name="<?php echo strtolower(htmlspecialchars($p['nombre'])); ?>" data-category="<?php echo strtolower(htmlspecialchars($p['categoria'])); ?>">
                <td><?php echo $p['id']; ?></td>
                <td><?php echo htmlspecialchars($p['nombre']); ?></td>
                <td><?php echo htmlspecialchars($p['categoria']); ?></td>
                <td>S/ <?php echo number_format($p['precio'], 2); ?></td>
                <td class="<?php echo $p['cantidad'] < 5 ? 'text-danger fw-bold' : ''; ?>">
                    <?php echo $p['cantidad']; ?>
                </td>
                <td>
                    <form method="POST" class="d-flex gap-2">
                        <input type="hidden" name="id_producto" value="<?php echo $p['id']; ?>">
                        <input type="number" name="cantidad" class="form-control form-control-sm" style="width: 70px;" placeholder="Cant" min="1" required>
                        <button type="submit" name="add_stock" class="btn btn-sm btn-primary">➕ Stock</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- Modal Nuevo Producto -->
<div class="modal fade" id="newProductModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Nuevo Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nombre</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Categoría</label>
                        <select name="categoria" class="form-select">
                            <option value="Analgésicos">Analgésicos</option>
                            <option value="Antiinflamatorios">Antiinflamatorios</option>
                            <option value="Antibióticos">Antibióticos</option>
                            <option value="Antialérgicos">Antialérgicos</option>
                            <option value="Gastrointestinal">Gastrointestinal</option>
                            <option value="Respiratorio">Respiratorio</option>
                            <option value="Vitaminas y Suplementos">Vitaminas y Suplementos</option>
                            <option value="Antisépticos">Antisépticos</option>
                            <option value="Material de Curación">Material de Curación</option>
                            <option value="Hidratantes">Hidratantes</option>
                            <option value="Dermatológicos">Dermatológicos</option>
                            <option value="Pediátricos">Pediátricos</option>
                            <option value="Equipos Médicos">Equipos Médicos</option>
                            <option value="Higiene Personal">Higiene Personal</option>
                            <option value="Primeros Auxilios">Primeros Auxilios</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Precio</label>
                        <input type="number" step="0.01" name="precio" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Stock Inicial</label>
                        <input type="number" name="cantidad" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="create_product" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
