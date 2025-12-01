<?php
session_start();
require_once __DIR__ . '/../app/autoload.php';

use App\Controllers\AuthController;
use App\Models\UserDAO;

$auth = new AuthController();
$userDAO = new UserDAO();
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $usuario = $_POST['usuario'] ?? '';
    $clave = $_POST['clave'] ?? '';
    $clave_confirm = $_POST['clave_confirm'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $direccion = $_POST['direccion'] ?? '';

    if ($clave !== $clave_confirm) {
        $error = 'Las contraseñas no coinciden';
    } elseif ($userDAO->findByUsername($usuario)) {
        $error = 'El usuario ya existe';
    } else {
        if ($userDAO->create($nombre, $usuario, $clave, 'cliente')) {
            $success = '¡Registro exitoso! Redirigiendo...';
            header("refresh:2;url=index.php?route=login");
        } else {
            $error = 'Error al crear la cuenta. Inténtalo de nuevo.';
        }
    }
}

$pageTitle = 'Registro - Botica JhireFarma';
$bodyClass = 'auth-page';
require __DIR__ . '/../app/Views/layouts/header.php';
?>



<div class="login-container">
    <div class="login-card fade-in">
        <div class="brand-header">
            <div class="brand-icon">
                <i class="bi bi-capsule"></i>
            </div>
            <h1 class="brand-title">Botica JhireFarma</h1>
            <p class="brand-subtitle">Crea tu cuenta</p>
        </div>

        <form class="login-form" method="POST">
            <?php if (!empty($error)): ?>
                <div class="alert-login">
                    <i class="bi bi-exclamation-circle me-2"></i>
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <div class="alert-success-login">
                    <i class="bi bi-check-circle me-2"></i>
                    <?php echo $success; ?>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="nombre">
                        <i class="bi bi-person-badge me-2"></i>Nombre Completo
                    </label>
                    <input 
                        type="text" 
                        id="nombre" 
                        name="nombre" 
                        class="form-control" 
                        placeholder="Nombre Completo"
                        required 
                    />
                </div>

                <div class="col-md-6 form-group">
                    <label for="usuario">
                        <i class="bi bi-person-circle me-2"></i>Usuario
                    </label>
                    <input 
                        type="text" 
                        id="usuario" 
                        name="usuario" 
                        class="form-control" 
                        placeholder="Usuario"
                        required 
                    />
                </div>
            </div>

            <div class="form-group">
                <label for="correo">
                    <i class="bi bi-envelope me-2"></i>Correo Electrónico
                </label>
                <input 
                    type="email" 
                    id="correo" 
                    name="correo" 
                    class="form-control" 
                    placeholder="correo@ejemplo.com"
                    required 
                />
            </div>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="telefono">
                        <i class="bi bi-telephone me-2"></i>Teléfono
                    </label>
                    <input 
                        type="tel" 
                        id="telefono" 
                        name="telefono" 
                        class="form-control" 
                        placeholder="Teléfono"
                        required 
                    />
                </div>

                <div class="col-md-6 form-group">
                    <label for="direccion">
                        <i class="bi bi-geo-alt me-2"></i>Dirección
                    </label>
                    <input 
                        type="text" 
                        id="direccion" 
                        name="direccion" 
                        class="form-control" 
                        placeholder="Dirección"
                        required 
                    />
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="clave">
                        <i class="bi bi-shield-lock me-2"></i>Contraseña
                    </label>
                    <input 
                        type="password" 
                        id="clave" 
                        name="clave" 
                        class="form-control" 
                        placeholder="Contraseña"
                        required 
                    />
                </div>

                <div class="col-md-6 form-group">
                    <label for="clave_confirm">
                        <i class="bi bi-shield-check me-2"></i>Confirmar
                    </label>
                    <input 
                        type="password" 
                        id="clave_confirm" 
                        name="clave_confirm" 
                        class="form-control" 
                        placeholder="Confirmar"
                        required 
                    />
                </div>
            </div>

            <button type="submit" class="btn-login">
                <i class="bi bi-person-plus me-2"></i>
                Crear Cuenta
            </button>

            <div class="register-link">
                ¿Ya tienes cuenta?
                <a href="index.php?route=login">Inicia sesión aquí</a>
            </div>
        </form>
    </div>
</div>

<?php require __DIR__ . '/../app/Views/layouts/footer.php'; ?>
