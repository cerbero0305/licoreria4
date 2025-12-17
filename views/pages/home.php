<?php
// views/pages/home.php
?>
<div class="container py-3">
  <?php include __DIR__ . '/../components/carousel.php'; ?>

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">
      <?php
      if ($section === 'categoria') {
          echo 'Productos por categoría';
      } elseif ($section === 'busqueda') {
          echo 'Resultados de búsqueda';
      } else {
          echo 'Todos los productos';
      }
      ?>
    </h4>
  </div>

  <div class="row">
    <?php if (!empty($productos)): ?>
      <?php foreach ($productos as $producto): ?>
        <?php include __DIR__ . '/../components/product-card.php'; ?>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="col-12">
        <div class="alert alert-info">
          No se encontraron productos para esta sección.
        </div>
      </div>
    <?php endif; ?>
  </div>
</div>
