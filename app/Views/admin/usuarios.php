<?php
$pageTitle = 'Gestión de Usuarios | Administrador';
require __DIR__ . '/../layouts/header.php';
require __DIR__ . '/../layouts/navbar_admin.php';

use App\Controllers\AdminController;

$adminController = new AdminController();
$msg = '';
$error = '';

// Handle Create User
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_user'])) {
    $res = $adminController->createUser($_POST);
    if ($res === true) {
        $msg = "Usuario creado exitosamente.";
    } else {
        $error = $res;
    }
}

// Handle Delete User
if (isset($_GET['delete'])) {
    $res = $adminController->deleteUser($_GET['delete']);
    if ($res === true) {
        $msg = "Usuario eliminado.";
    } else {
        $error = $res;
    }
}

$usuarios = $adminController->getAllUsers();
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>👥 Gestión de Usuarios</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newUserModal">
            <i class="bi bi-person-plus"></i> Nuevo Usuario
        </button>
    </div>

    <?php if ($msg): ?><div class="alert alert-success"><?php echo $msg; ?></div><?php endif; ?>
    <?php if ($error): ?><div class="alert alert-danger"><?php echo $error; ?></div><?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($u = $usuarios->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $u['id']; ?></td>
                        <td><?php echo htmlspecialchars($u['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($u['usuario']); ?></td>
                        <td>
                            <span class="badge <?php 
                                echo $u['rol'] === 'admin' ? 'bg-danger' : 
                                    ($u['rol'] === 'vendedor' ? 'bg-success' : 'bg-info'); 
                            ?>">
                                <?php echo strtoupper($u['rol']); ?>
                            </span>
                        </td>
                        <td>
                            <?php if ($u['id'] != $_SESSION['usuario_id']): ?>
                            <a href="index.php?route=admin/usuarios&delete=<?php echo $u['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Estás seguro de eliminar este usuario?');">
                                <i class="bi bi-trash"></i> Eliminar
                            </a>
                            <?php else: ?>
                            <span class="text-muted small">Tu cuenta</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Nuevo Usuario -->
<div class="modal fade" id="newUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Nuevo Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nombre Completo</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Usuario (Login)</label>
                        <input type="text" name="usuario" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Contraseña</label>
                        <input type="password" name="clave" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Rol</label>
                        <select name="rol" class="form-select" required>
                            <option value="vendedor">Vendedor</option>
                            <option value="admin">Administrador</option>
                            <option value="cliente">Cliente</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="create_user" class="btn btn-success">Crear Usuario</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
