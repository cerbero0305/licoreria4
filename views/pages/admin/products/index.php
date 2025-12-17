<?php
// views/pages/admin/products/index.php
?>
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Administrar productos</h4>
    <a href="<?= BASE_URL ?>/?page=admin-products&action=create" class="btn btn-primary btn-sm">
      + Nuevo producto
    </a>
  </div>

  <?php if (empty($productos)): ?>
    <div class="alert alert-info">No hay productos registrados.</div>
  <?php else: ?>
    <div class="table-responsive">
      <table class="table table-striped align-middle">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Precio</th>
            <th>Activo</th>
            <th width="200">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($productos as $prod): ?>
            <tr>
              <td><?= $prod['id'] ?></td>
              <td><?= htmlspecialchars($prod['nombre']) ?></td>
              <td><?= htmlspecialchars($prod['categoria_nombre']) ?></td>
              <td>S/ <?= number_format($prod['precio'], 2) ?></td>
              <td>
                <?php if ($prod['activo']): ?>
                  <span class="badge bg-success">Sí</span>
                <?php else: ?>
                  <span class="badge bg-secondary">No</span>
                <?php endif; ?>
              </td>
              <td>
                <a href="<?= BASE_URL ?>/?page=admin-products&action=edit&id=<?= $prod['id'] ?>"
                   class="btn btn-sm btn-outline-secondary">Editar</a>

                <form action="<?= BASE_URL ?>/?page=admin-products&action=delete"
                      method="post" class="d-inline"
                      onsubmit="return confirm('¿Eliminar este producto?');">
                  <input type="hidden" name="id" value="<?= $prod['id'] ?>">
                  <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</div>
