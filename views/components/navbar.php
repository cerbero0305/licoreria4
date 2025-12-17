<?php
// views/components/navbar.php
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
  <div class="container">
    <!-- BOTÓN MENÚ LATERAL (OFFCANVAS) -->
    <button class="btn btn-outline-light me-2"
        type="button"
        data-bs-toggle="offcanvas"
        data-bs-target="#mainOffcanvas"
        aria-controls="mainOffcanvas">
  ☰
</button>


    <!-- IZQUIERDA: LOGO -->
    <a class="navbar-brand d-flex align-items-center" href="<?= BASE_URL ?>/?page=home">
      <img src="<?= BASE_URL ?>/assets/img/logo.png" alt="Licorería" width="40" height="40" class="me-2">
      <span>24 HORAS</span>
    </a>

    <!-- BOTÓN RESPONSIVE NAVBAR (el de siempre) -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNavbar">
      <!-- CATEGORÍAS -->
      <ul class="navbar-nav me-3">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="categoriasDropdown" role="button" data-bs-toggle="dropdown">
            Categorías
          </a>
          <ul class="dropdown-menu" aria-labelledby="categoriasDropdown">
            <?php foreach ($categoriasHeader as $cat): ?>
              <li>
                <a class="dropdown-item" href="<?= BASE_URL ?>/?page=category&id=<?= $cat['id'] ?>">
                  <?= htmlspecialchars($cat['nombre']) ?>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </li>
      </ul>

      <!-- CENTRO: BUSCADOR -->
      <form class="d-flex flex-grow-1 me-3" action="<?= BASE_URL ?>/" method="get">
        <input type="hidden" name="page" value="search">
        <input class="form-control me-2" type="search" name="q" placeholder="Buscar por nombre o categoría...">
        <button class="btn btn-outline-light" type="submit">Buscar</button>
      </form>

      <!-- DERECHA: USUARIO, MIS COMPRAS, ADMIN, CARRITO -->
      <ul class="navbar-nav ms-auto align-items-center">

        <!-- Admin (solo rol admin) -->
        <?php if (isAdmin()): ?>
          <li class="nav-item dropdown me-3">
            <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown">
              Admin
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminDropdown">
              <li><a class="dropdown-item" href="<?= BASE_URL ?>/?page=admin-categories">Categorías</a></li>
              <li><a class="dropdown-item" href="<?= BASE_URL ?>/?page=admin-products">Productos</a></li>
            </ul>
          </li>
        <?php endif; ?>

        <!-- Mis compras (solo con sesión activa) -->
        <?php if (isLoggedIn()): ?>
          <li class="nav-item me-2">
            <a class="nav-link" href="<?= BASE_URL ?>/?page=my-orders">Mis compras</a>
          </li>
        <?php endif; ?>

        <!-- Usuario -->
        <li class="nav-item dropdown me-3">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
            <?php if ($user): ?>
              Hola, <?= htmlspecialchars($user['nombre']) ?>
            <?php else: ?>
              Hola, Inicia sesión
            <?php endif; ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            <?php if ($user): ?>
              <li><a class="dropdown-item" href="<?= BASE_URL ?>/?page=account">Mi cuenta</a></li>
              <li><a class="dropdown-item" href="<?= BASE_URL ?>/?page=logout">Cerrar sesión</a></li>
            <?php else: ?>
              <li><a class="dropdown-item" href="<?= BASE_URL ?>/?page=register">Registrarse</a></li>
              <li><a class="dropdown-item" href="<?= BASE_URL ?>/?page=login">Iniciar sesión</a></li>
            <?php endif; ?>
          </ul>
        </li>

        <!-- Carrito -->
        <li class="nav-item">
          <a class="nav-link position-relative" href="<?= BASE_URL ?>/?page=cart">
            🛒
            <?php if ($cartCount > 0): ?>
              <span class="badge bg-danger position-absolute top-0 start-100 translate-middle">
                <?= $cartCount ?>
              </span>
            <?php endif; ?>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- OFFCANVAS LATERAL IZQUIERDO -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="mainOffcanvas" aria-labelledby="mainOffcanvasLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="mainOffcanvasLabel">Menú</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
  </div>
  <div class="offcanvas-body">
    <div class="mb-3">
      <?php if ($user): ?>
        <p class="mb-0">Hola, <strong><?= htmlspecialchars($user['nombre']) ?></strong></p>
      <?php else: ?>
        <p class="mb-0">Hola, invitado 👋</p>
      <?php endif; ?>
    </div>

    <ul class="list-unstyled">
      <li class="mb-2">
        <a href="<?= BASE_URL ?>/?page=home" class="text-decoration-none">
          🏠 Inicio
        </a>
      </li>
      
      <li class="mb-2">
        <a href="<?= BASE_URL ?>/?page=home" class="text-decoration-none">
          🏠 Usuario
        </a>
      </li>

      <li class="mb-2">
        <a href="<?= BASE_URL ?>/?page=user" class="text-decoration-none">
          🏠 Productos
        </a>
      </li>

      <li class="mb-2 fw-semibold">📂 Categorías</li>
      <?php foreach ($categoriasHeader as $cat): ?>
        <li class="mb-1 ms-3">
          <a href="<?= BASE_URL ?>/?page=category&id=<?= $cat['id'] ?>" class="text-decoration-none">
            <?= htmlspecialchars($cat['nombre']) ?>
          </a>
        </li>
      <?php endforeach; ?>

      <li class="mb-2">
        <a href="<?= BASE_URL ?>/?page=home" class="text-decoration-none">
          🏠 Clientes
        </a>
      </li>

      <li class="mb-2">
        <a href="<?= BASE_URL ?>/?page=home" class="text-decoration-none">
          🏠 Proveedores
        </a>
      </li>

      <hr>

      <?php if (isLoggedIn()): ?>
        <li class="mb-2">
          <a href="<?= BASE_URL ?>/?page=account" class="text-decoration-none">
            👤 Mi cuenta
          </a>
        </li>
        <li class="mb-2">
          <a href="<?= BASE_URL ?>/?page=my-orders" class="text-decoration-none">
            🧾 Mis compras
          </a>
        </li>
        <li class="mb-2">
          <a href="<?= BASE_URL ?>/?page=cart" class="text-decoration-none">
            🛒 Carrito (<?= $cartCount ?>)
          </a>
        </li>
        <li class="mb-2">
          <a href="<?= BASE_URL ?>/?page=logout" class="text-decoration-none text-danger">
            🚪 Cerrar sesión
          </a>
        </li>
      <?php else: ?>
        <li class="mb-2">
          <a href="<?= BASE_URL ?>/?page=login" class="text-decoration-none">
            🔐 Iniciar sesión
          </a>
        </li>
        <li class="mb-2">
          <a href="<?= BASE_URL ?>/?page=register" class="text-decoration-none">
            ✍️ Registrarse
          </a>
        </li>
      <?php endif; ?>

      <?php if (isAdmin()): ?>
        <hr>
        <li class="mb-2 fw-semibold">⚙️ Administración</li>
        <li class="mb-1 ms-3">
          <a href="<?= BASE_URL ?>/?page=admin-categories" class="text-decoration-none">
            Categorías
          </a>
        </li>
        <li class="mb-1 ms-3">
          <a href="<?= BASE_URL ?>/?page=admin-products" class="text-decoration-none">
            Productos
          </a>
        </li>
      <?php endif; ?>
    </ul>
  </div>
</div>
