<?php
// views/pages/cart.php
$cart = $_SESSION['cart'] ?? [];
?>
<div class="container py-4">
  <h4 class="mb-3">Carrito de compras</h4>

  <div class="row">
    <div class="col-lg-8 mb-3">
      <?php if (empty($cart)): ?>
        <div class="alert alert-info">Tu carrito está vacío.</div>
      <?php else: ?>
        <form action="<?= BASE_URL ?>/?page=cart&action=update" method="post">
          <div class="table-responsive">
            <table class="table align-middle">
              <thead>
              <tr>
                <th>Producto</th>
                <th width="120">Cantidad</th>
                <th>Precio</th>
                <th>Subtotal</th>
                <th></th>
              </tr>
              </thead>
              <tbody>
              <?php foreach ($cart as $id => $item): ?>
                <?php $subtotal = $item['precio'] * $item['cantidad']; ?>
                <tr>
                  <td><?= htmlspecialchars($item['nombre']) ?></td>
                  <td>
                    <input type="number" name="cantidad[<?= $id ?>]" class="form-control form-control-sm"
                           min="0" value="<?= $item['cantidad'] ?>">
                  </td>
                  <td>S/ <?= number_format($item['precio'], 2) ?></td>
                  <td>S/ <?= number_format($subtotal, 2) ?></td>
                  <td>
                    <a href="<?= BASE_URL ?>/?page=cart&action=remove&id=<?= $id ?>"
                       class="btn btn-sm btn-outline-danger">X</a>
                  </td>
                </tr>
              <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <button type="submit" class="btn btn-outline-primary">Actualizar cantidades</button>
        </form>
      <?php endif; ?>
    </div>

    <div class="col-lg-4">
      <?php include __DIR__ . '/../components/cart-summary.php'; ?>
    </div>
  </div>
</div>
