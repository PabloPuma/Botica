<?php
$pageTitle = 'Login - Bodega La Esquinita';
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
<div class="login-body">
  <div class="left-side"></div>
  <div class="right-side">
    <form class="login-box" method="POST">
      <h2>Iniciar sesión</h2>

      <?php if (!empty($error)): ?>
        <div class="error-msg"><?php echo $error; ?></div>
      <?php endif; ?>

      <label for="usuario">Usuario</label>
      <input type="text" id="usuario" name="usuario" required />

      <label for="clave">Contraseña</label>
      <input type="password" id="clave" name="clave" required />

      <button type="submit" class="login-btn">Ingresar</button>

      <div class="register-link">
        ¿No tienes cuenta?
        <a href="registro.php">Regístrate aquí</a>
      </div>
    </form>
  </div>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
