<?php
// views/components/product-card.php
// Espera $producto
$img = $producto['imagen_url'] ?? (BASE_URL . '/assets/img/logo.png');
?>
<div class="col-6 col-md-4 col-lg-3 mb-4">
  <div class="card h-100 shadow-sm">
    <a href="<?= BASE_URL ?>/?page=product&id=<?= $producto['id'] ?>" class="text-decoration-none text-dark">
      <div class="card-img-top product-card-img-wrapper">
        <img src="<?= htmlspecialchars($img) ?>"
             class="w-100 h-100"
             alt="<?= htmlspecialchars($producto['nombre']) ?>">
      </div>
    </a>
    <div class="card-body d-flex flex-column">
      <a href="<?= BASE_URL ?>/?page=product&id=<?= $producto['id'] ?>" class="text-decoration-none text-dark">
        <h6 class="card-title mb-1"><?= htmlspecialchars($producto['nombre']) ?></h6>
      </a>
      <small class="text-muted mb-2"><?= htmlspecialchars($producto['categoria_nombre'] ?? '') ?></small>
      <p class="fw-bold text-success mb-2">S/ <?= number_format($producto['precio'], 2) ?></p>

      <form action="<?= BASE_URL ?>/?page=cart&action=add" method="post" class="mt-auto">
        <input type="hidden" name="product_id" value="<?= $producto['id'] ?>">

        <div class="input-group input-group-sm mb-2">
          <label class="input-group-text">Cant</label>
          <input type="number" name="qty" min="1" value="1" class="form-control">
        </div>

        <div class="d-grid gap-1">
          <button type="submit" class="btn btn-primary btn-sm">
            Añadir al carrito
          </button>
          <a href="<?= BASE_URL ?>/?page=product&id=<?= $producto['id'] ?>"
             class="btn btn-outline-secondary btn-sm">
            Ver
          </a>
        </div>
      </form>
    </div>
  </div>
</div>
