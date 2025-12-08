<?php
$current_route = $_GET['route'] ?? '';
?>
<nav class="navbar navbar-expand-lg navbar-pharmacy shadow">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold d-flex align-items-center text-white" href="index.php?route=admin/dashboard">
            <i class="bi bi-capsule-pill me-2" style="font-size: 1.5rem;"></i>
            <span>Botica JhireFarma - Admin</span>
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
                    <a class="nav-link <?php echo $current_route === 'admin/historial' ? 'active' : ''; ?>" href="index.php?route=admin/historial">
                        <i class="bi bi-clock-history me-1"></i> Historial
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_route === 'admin/logs' ? 'active' : ''; ?>" href="index.php?route=admin/logs">
                        <i class="bi bi-file-text-fill me-1"></i> Logs
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_route === 'admin/perfil' ? 'active' : ''; ?>" href="index.php?route=admin/perfil">
                        <i class="bi bi-person-circle me-1"></i> Mi Perfil
                    </a>
                </li>
                <li class="nav-item ms-lg-3">
                    <a class="nav-link btn btn-outline-light btn-sm" href="index.php?route=logout" style="border: 2px solid white;">
                        <i class="bi bi-box-arrow-right me-1"></i> Salir
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
