<?php
$current_route = $_GET['route'] ?? '';
?>
<nav class="navbar navbar-expand-lg navbar-dark shadow-sm navbar-custom">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="index.php?route=vendedor/dashboard">
            <i class="bi bi-shop me-2" style="font-size: 1.5rem;"></i>
            <span>Bodega La Esquinita (Vendedor)</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_route === 'vendedor/dashboard' ? 'active' : ''; ?>" href="index.php?route=vendedor/dashboard">
                        <i class="bi bi-house-door-fill me-1"></i> Inicio
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_route === 'vendedor/productos' ? 'active' : ''; ?>" href="index.php?route=vendedor/productos">
                        <i class="bi bi-box-seam-fill me-1"></i> Productos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_route === 'vendedor/ventas' ? 'active' : ''; ?>" href="index.php?route=vendedor/ventas">
                        <i class="bi bi-cart-check-fill me-1"></i> Ventas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_route === 'vendedor/historial' ? 'active' : ''; ?>" href="index.php?route=vendedor/historial">
                        <i class="bi bi-clock-history me-1"></i> Historial
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
