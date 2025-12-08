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

// Handle Edit User
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_user'])) {
    $res = $adminController->editUser($_POST['edit_user_id'], $_POST);
    if ($res === true) {
        $msg = "Usuario actualizado exitosamente.";
    } else {
        $error = $res;
    }
}

// Handle Activate User
if (isset($_GET['activate'])) {
    $res = $adminController->activateUser($_GET['activate']);
    if ($res === true) {
        $msg = "Usuario activado.";
    } else {
        $error = $res;
    }
}

// Handle Deactivate User
if (isset($_GET['deactivate'])) {
    $res = $adminController->deactivateUser($_GET['deactivate']);
    if ($res === true) {
        $msg = "Usuario desactivado.";
    } else {
        $error = $res;
    }
}

$usuarios = $adminController->getAllUsers();
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Gestión de Usuarios</h2>
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
                        <th>DNI</th>
                        <th>Usuario</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $userDAO = new \App\Models\UserDAO();
                    while($u = $usuarios->fetch_assoc()): 
                        $hasSales = $userDAO->hasSales($u['id']);
                    ?>
                    <tr>
                        <td><?php echo $u['id']; ?></td>
                        <td><?php echo htmlspecialchars($u['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($u['dni'] ?? 'N/A'); ?></td>
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
                            <?php if (isset($u['activo']) && $u['activo'] == 1): ?>
                                <span class="badge bg-success">Activo</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Inactivo</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($u['id'] != $_SESSION['usuario_id']): ?>
                                <!-- Botón Editar -->
                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editUserModal<?php echo $u['id']; ?>" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                
                                <!-- Botón Activar/Desactivar -->
                                <?php if (isset($u['activo']) && $u['activo'] == 1): ?>
                                    <a href="index.php?route=admin/usuarios&deactivate=<?php echo $u['id']; ?>" 
                                       class="btn btn-sm btn-outline-warning"
                                       onclick="return confirm('¿Desactivar este usuario?');" title="Desactivar">
                                        <i class="bi bi-lock"></i>
                                    </a>
                                <?php else: ?>
                                    <a href="index.php?route=admin/usuarios&activate=<?php echo $u['id']; ?>" 
                                       class="btn btn-sm btn-outline-success"
                                       onclick="return confirm('¿Activar este usuario?');" title="Activar">
                                        <i class="bi bi-unlock"></i>
                                    </a>
                                <?php endif; ?>
                                
                                <!-- Botón Eliminar (solo si NO tiene ventas) -->
                                <?php if (!$hasSales): ?>
                                    <a href="index.php?route=admin/usuarios&delete=<?php echo $u['id']; ?>" 
                                       class="btn btn-sm btn-outline-danger"
                                       onclick="return confirm('¿Eliminar permanentemente?');" title="Eliminar">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted small" title="No se puede eliminar: tiene ventas">🔒</span>
                                <?php endif; ?>
                            <?php else: ?>
                                <span class="text-muted small">Tu cuenta</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    
                    <!-- Modal Editar Usuario -->
                    <div class="modal fade" id="editUserModal<?php echo $u['id']; ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST">
                                    <input type="hidden" name="edit_user_id" value="<?php echo $u['id']; ?>">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Editar Usuario</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label>Nombre Completo</label>
                                            <input type="text" name="nombre" class="form-control" value="<?php echo htmlspecialchars($u['nombre']); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label>Correo</label>
                                            <input type="email" name="correo" class="form-control" value="<?php echo htmlspecialchars($u['correo'] ?? ''); ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label>Teléfono</label>
                                            <input type="tel" name="telefono" class="form-control" value="<?php echo htmlspecialchars($u['telefono'] ?? ''); ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label>Rol</label>
                                            <select name="rol" class="form-select" required>
                                                <option value="cliente" <?php echo $u['rol'] === 'cliente' ? 'selected' : ''; ?>>Cliente</option>
                                                <option value="vendedor" <?php echo $u['rol'] === 'vendedor' ? 'selected' : ''; ?>>Vendedor</option>
                                                <option value="admin" <?php echo $u['rol'] === 'admin' ? 'selected' : ''; ?>>Administrador</option>
                                            </select>
                                        </div>
                                        <small class="text-muted">No se puede cambiar: DNI, Usuario</small>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="edit_user" class="btn btn-primary">Guardar Cambios</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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
                        <label>DNI</label>
                        <input type="text" name="dni" class="form-control" pattern="[0-9]{8}" maxlength="8" placeholder="8 dígitos" required>
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
