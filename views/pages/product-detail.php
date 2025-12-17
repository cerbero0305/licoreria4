<?php
// views/pages/product-detail.php
$img = $producto['imagen_url'] ?? (BASE_URL . '/assets/img/logo.png');
?>
<div class="container py-4">
  <div class="row">
    <!-- Columna imagen -->
    <div class="col-md-5 mb-3">
      <div class="product-detail-img-wrapper border bg-white rounded shadow-sm">
        <img src="<?= htmlspecialchars($img) ?>"
             alt="<?= htmlspecialchars($producto['nombre']) ?>"
             class="product-detail-img">
      </div>
    </div>

    <!-- Columna info -->
    <div class="col-md-7 mb-3">
      <p class="text-muted mb-1">
        Categoría:
        <span class="fw-semibold"><?= htmlspecialchars($producto['categoria_nombre']) ?></span>
      </p>
      <h2 class="h3 mb-2"><?= htmlspecialchars($producto['nombre']) ?></h2>

      <?php if (!empty($producto['descripcion'])): ?>
        <p class="mb-3"><?= nl2br(htmlspecialchars($producto['descripcion'])) ?></p>
      <?php else: ?>
        <p class="text-muted">Este producto aún no tiene una descripción detallada.</p>
      <?php endif; ?>

      <p class="h4 text-success mb-4">
        S/ <?= number_format($producto['precio'], 2) ?>
      </p>

      <form action="<?= BASE_URL ?>/?page=cart&action=add" method="post" class="mb-3">
        <input type="hidden" name="product_id" value="<?= $producto['id'] ?>">
        <div class="row g-2 align-items-end">
          <div class="col-4 col-sm-3">
            <label class="form-label">Cantidad</label>
            <input type="number" name="qty" min="1" value="1" class="form-control">
          </div>
          <div class="col-8 col-sm-5">
            <button type="submit" class="btn btn-primary w-100">
              Añadir al carrito 🛒
            </button>
          </div>
        </div>
      </form>

      <a href="javascript:history.back()" class="btn btn-outline-secondary btn-sm me-2">Volver</a>
      <a href="<?= BASE_URL ?>/?page=home" class="btn btn-outline-secondary btn-sm">Ir a inicio</a>
    </div>
  </div>
</div>
