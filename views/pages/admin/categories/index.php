<?php
// views/pages/admin/categories/index.php
?>
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Administrar categorías</h4>
    <a href="<?= BASE_URL ?>/?page=admin-categories&action=create" class="btn btn-primary btn-sm">
      + Nueva categoría
    </a>
  </div>

  <?php if (empty($categorias)): ?>
    <div class="alert alert-info">No hay categorías registradas.</div>
  <?php else: ?>
    <div class="table-responsive">
      <table class="table table-striped align-middle">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th width="150">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($categorias as $cat): ?>
            <tr>
              <td><?= $cat['id'] ?></td>
              <td><?= htmlspecialchars($cat['nombre']) ?></td>
              <td>
                <a href="<?= BASE_URL ?>/?page=admin-categories&action=edit&id=<?= $cat['id'] ?>"
                   class="btn btn-sm btn-outline-secondary">Editar</a>

                <form action="<?= BASE_URL ?>/?page=admin-categories&action=delete"
                      method="post" class="d-inline"
                      onsubmit="return confirm('¿Eliminar esta categoría?');">
                  <input type="hidden" name="id" value="<?= $cat['id'] ?>">
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
