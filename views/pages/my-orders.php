<?php
// views/pages/my-orders.php
?>
<div class="container py-4">
  <h4 class="mb-3">Mis compras</h4>

  <?php if (empty($compras)): ?>
    <div class="alert alert-info">Aún no has realizado compras.</div>
  <?php else: ?>
    <div class="table-responsive">
      <table class="table table-striped align-middle">
        <thead>
          <tr>
            <th>#</th>
            <th>Fecha</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($compras as $compra): ?>
          <tr>
            <td><?= $compra['id'] ?></td>
            <td><?= $compra['fecha'] ?></td>
            <td>S/ <?= number_format($compra['total'], 2) ?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</div>
