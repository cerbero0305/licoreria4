<?php
// views/components/cart-summary.php
$total = 0;
foreach ($cart as $item) {
    $total += $item['precio'] * $item['cantidad'];
}
?>
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Resumen de compra</h5>
    <p class="card-text">Total: <strong>S/ <?= number_format($total, 2) ?></strong></p>
    <?php if (!empty($cart)): ?>
      <form action="<?= BASE_URL ?>/?page=cart&action=checkout" method="post">
        <button type="submit" class="btn btn-success w-100">Finalizar compra</button>
      </form>
    <?php else: ?>
      <button class="btn btn-secondary w-100" disabled>Carrito vacío</button>
    <?php endif; ?>
  </div>
</div>
