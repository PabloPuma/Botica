<?php
$current_route = $_GET['route'] ?? '';
?>
<nav class="navbar navbar-expand-lg navbar-pharmacy shadow">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold d-flex align-items-center text-white" href="index.php?route=cliente/dashboard">
            <i class="bi bi-capsule-pill me-2" style="font-size: 1.5rem;"></i>
            <span>Botica JhireFarma</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_route === 'cliente/dashboard' ? 'active' : ''; ?>" href="index.php?route=cliente/dashboard">
                        <i class="bi bi-house-door-fill me-1"></i> Tienda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_route === 'cliente/carrito' ? 'active' : ''; ?>" href="index.php?route=cliente/carrito">
                        <i class="bi bi-cart-fill me-1"></i> Carrito
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_route === 'cliente/pedidos' ? 'active' : ''; ?>" href="index.php?route=cliente/pedidos">
                        <i class="bi bi-bag-check-fill me-1"></i> Mis Pedidos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_route === 'cliente/perfil' ? 'active' : ''; ?>" href="index.php?route=cliente/perfil">
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
