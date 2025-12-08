<?php
$pageTitle = 'Mi Perfil | Administrador';
require __DIR__ . '/../layouts/header.php';
require __DIR__ . '/../layouts/navbar_admin.php';

// Reutilizar el mismo contenido que cliente/perfil.php
$userDAO = new App\Models\UserDAO();
$user = $userDAO->getUserById($_SESSION['usuario_id']);

use App\Controllers\ProfileController;

$profileController = new ProfileController();
$msg = '';
$error = '';

// Handle Profile Update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_profile'])) {
        $res = $profileController->update($_POST);
        if ($res === true) {
            $msg = "Perfil actualizado exitosamente.";
            $user = $userDAO->getUserById($_SESSION['usuario_id']);
        } else {
            $error = $res;
        }
    } elseif (isset($_POST['change_password'])) {
        $currentPassword = $_POST['current_password'] ?? '';
        $newPassword = $_POST['new_password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';
        
        if ($newPassword !== $confirmPassword) {
            $error = "Las contraseñas nuevas no coinciden.";
        } else {
            $res = $profileController->changePassword($currentPassword, $newPassword);
            if ($res === true) {
                $msg = "Contraseña cambiada exitosamente.";
            } else {
                $error = $res;
            }
        }
    }
}
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2><i class="bi bi-person-circle me-2"></i>Mi Perfil</h2>
            </div>

            <?php if ($msg): ?><div class="alert alert-success"><?php echo $msg; ?></div><?php endif; ?>
            <?php if ($error): ?><div class="alert alert-danger"><?php echo $error; ?></div><?php endif; ?>

            <div class="row g-4">
                <!-- Datos Personales -->
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="bi bi-person-vcard me-2"></i>Datos Personales</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST">
                                <div class="mb-3">
                                    <label class="form-label">Nombre Completo</label>
                                    <input type="text" name="nombre" class="form-control" value="<?php echo htmlspecialchars($user['nombre']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">DNI</label>
                                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($user['dni'] ?? 'No registrado'); ?>" readonly disabled>
                                    <small class="text-muted">El DNI no puede ser modificado</small>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Usuario</label>
                                    <?php if ($user['usuario'] === $user['dni']): ?>
                                        <input type="text" name="usuario" class="form-control" value="<?php echo htmlspecialchars($user['usuario']); ?>" required>
                                        <small class="text-muted">Puede personalizar su nombre de usuario</small>
                                    <?php else: ?>
                                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($user['usuario']); ?>" readonly disabled>
                                        <small class="text-muted">El usuario no puede ser modificado</small>
                                    <?php endif; ?>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Correo Electrónico</label>
                                    <input type="email" name="correo" class="form-control" value="<?php echo htmlspecialchars($user['correo'] ?? ''); ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Teléfono</label>
                                    <input type="tel" name="telefono" class="form-control" value="<?php echo htmlspecialchars($user['telefono'] ?? ''); ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Dirección</label>
                                    <input type="text" name="direccion" class="form-control" value="<?php echo htmlspecialchars($user['direccion'] ?? ''); ?>">
                                </div>
                                <button type="submit" name="update_profile" class="btn btn-primary w-100">
                                    <i class="bi bi-save me-2"></i>Guardar Cambios
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Cambiar Contraseña -->
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-header bg-warning text-dark">
                            <h5 class="mb-0"><i class="bi bi-shield-lock me-2"></i>Cambiar Contraseña</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST">
                                <div class="mb-3">
                                    <label class="form-label">Contraseña Actual</label>
                                    <input type="password" name="current_password" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nueva Contraseña</label>
                                    <input type="password" name="new_password" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Confirmar Nueva Contraseña</label>
                                    <input type="password" name="confirm_password" class="form-control" required>
                                </div>
                                <button type="submit" name="change_password" class="btn btn-warning w-100">
                                    <i class="bi bi-key me-2"></i>Cambiar Contraseña
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Información de Cuenta -->
                    <div class="card shadow-sm mt-4">
                        <div class="card-header bg-danger text-white">
                            <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Información de Cuenta</h5>
                        </div>
                        <div class="card-body">
                            <p class="mb-2"><strong>Rol:</strong> <span class="badge bg-danger"><?php echo strtoupper($user['rol']); ?></span></p>
                            <p class="mb-2"><strong>ID de Usuario:</strong> <?php echo $user['id']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
