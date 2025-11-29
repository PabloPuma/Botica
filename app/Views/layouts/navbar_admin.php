<?php
$current_route = $_GET['route'] ?? '';
?>
<nav class="navbar navbar-expand-lg navbar-dark shadow-sm navbar-custom" style="background: linear-gradient(135deg, #2c3e50 0%, #4ca1af 100%);">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="index.php?route=admin/dashboard">
            <i class="bi bi-shield-lock-fill me-2" style="font-size: 1.5rem;"></i>
            <span>Administrador</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_route === 'admin/dashboard' ? 'active' : ''; ?>" href="index.php?route=admin/dashboard">
                        <i class="bi bi-speedometer2 me-1"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_route === 'admin/usuarios' ? 'active' : ''; ?>" href="index.php?route=admin/usuarios">
                        <i class="bi bi-people-fill me-1"></i> Usuarios
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_route === 'admin/productos' ? 'active' : ''; ?>" href="index.php?route=admin/productos">
                        <i class="bi bi-box-seam-fill me-1"></i> Productos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_route === 'admin/ventas' ? 'active' : ''; ?>" href="index.php?route=admin/ventas">
                        <i class="bi bi-cart-check-fill me-1"></i> Ventas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_route === 'admin/logs' ? 'active' : ''; ?>" href="index.php?route=admin/logs">
                        <i class="bi bi-file-text-fill me-1"></i> Logs
                    </a>
                </li>
                <li class="nav-item ms-lg-3">
                    <a class="nav-link btn btn-outline-warning btn-sm text-white border-warning" href="index.php?route=logout">
                        <i class="bi bi-box-arrow-right me-1"></i> Salir
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
