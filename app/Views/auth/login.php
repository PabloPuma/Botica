<?php
$pageTitle = 'Login - Botica JhireFarma';
$bodyClass = 'auth-page';
require __DIR__ . '/../layouts/header.php';

use App\Controllers\AuthController;

$auth = new AuthController();
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $clave = $_POST['clave'] ?? '';

    if ($auth->login($usuario, $clave)) {
        if ($_SESSION['rol'] === 'admin') {
            header("Location: index.php?route=admin/dashboard");
        } elseif ($_SESSION['rol'] === 'vendedor') {
            header("Location: index.php?route=vendedor/dashboard");
        } else {
            header("Location: index.php?route=cliente/dashboard");
        }
        exit();
    } else {
        $error = 'Usuario o contraseña incorrectos';
    }
}
?>



<div class="login-container">
    <div class="login-card fade-in">
        <div class="brand-header">
            <div class="brand-icon">
                <i class="bi bi-capsule"></i>
            </div>
            <h1 class="brand-title">Botica JhireFarma</h1>
            <p class="brand-subtitle">Tu farmacia de confianza</p>
        </div>

        <form class="login-form" method="POST">
            <?php if (!empty($error)): ?>
                <div class="alert-login">
                    <i class="bi bi-exclamation-circle me-2"></i>
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <div class="form-group">
                <label for="usuario">
                    <i class="bi bi-person-circle me-2"></i>Usuario
                </label>
                <div class="input-icon">
                    <i class="bi bi-person"></i>
                    <input 
                        type="text" 
                        id="usuario" 
                        name="usuario" 
                        class="form-control" 
                        placeholder="Ingresa tu usuario"
                        required 
                        autocomplete="username"
                    />
                </div>
            </div>

            <div class="form-group">
                <label for="clave">
                    <i class="bi bi-shield-lock me-2"></i>Contraseña
                </label>
                <div class="input-icon">
                    <i class="bi bi-lock"></i>
                    <input 
                        type="password" 
                        id="clave" 
                        name="clave" 
                        class="form-control" 
                        placeholder="Ingresa tu contraseña"
                        required 
                        autocomplete="current-password"
                    />
                </div>
            </div>

            <button type="submit" class="btn-login">
                <i class="bi bi-box-arrow-in-right me-2"></i>
                Ingresar
            </button>

            <div class="register-link">
                ¿No tienes cuenta?
                <a href="registro.php">Regístrate aquí</a>
            </div>
        </form>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
