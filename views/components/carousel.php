<?php
// views/components/carousel.php
?>
<div id="licorCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#licorCarousel" data-bs-slide-to="0" class="active"></button>
    <button type="button" data-bs-target="#licorCarousel" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#licorCarousel" data-bs-slide-to="2"></button>
  </div>

  <div class="carousel-inner">
    <!-- Ofertas -->
    <div class="carousel-item active">
      <a href="<?= BASE_URL ?>/?page=search&q=oferta">
        <img src="<?= BASE_URL ?>/assets/img/banner_oferta.png" class="d-block w-100" alt="Licores en descuento">
        <div class="carousel-caption d-none d-md-block">
          <h5>Licores en descuento</h5>
          <p>Aprovecha nuestras mejores promociones.</p>
        </div>
      </a>
    </div>
    <!-- Combos -->
    <div class="carousel-item">
      <a href="<?= BASE_URL ?>/?page=search&q=combo">
        <img src="<?= BASE_URL ?>/assets/img/banner_combos.png" class="d-block w-100" alt="Combos">
        <div class="carousel-caption d-none d-md-block">
          <h5>Combos especiales</h5>
          <p>Arma la fiesta con combos listos para ti.</p>
        </div>
      </a>
    </div>
    <!-- Nuevos -->
    <div class="carousel-item">
      <a href="<?= BASE_URL ?>/?page=search&q=nuevo">
        <img src="<?= BASE_URL ?>/assets/img/banner_nuevos.png" class="d-block w-100" alt="Nuevos ingresos">
        <div class="carousel-caption d-none d-md-block">
          <h5>Nuevos ingresos</h5>
          <p>Descubre los últimos licores agregados.</p>
        </div>
      </a>
    </div>
  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#licorCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#licorCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>
