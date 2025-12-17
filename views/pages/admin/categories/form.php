<?php
// views/pages/admin/categories/form.php
$isEdit = !empty($categoria);
?>
<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-sm">
        <div class="card-body">
          <h4 class="mb-3 text-center">
            <?= $isEdit ? 'Editar categoría' : 'Nueva categoría' ?>
          </h4>

          <form method="post"
                action="<?= BASE_URL ?>/?page=admin-categories&action=<?= $isEdit ? 'edit' : 'create' ?>">
            <?php if ($isEdit): ?>
              <input type="hidden" name="id" value="<?= $categoria['id'] ?>">
            <?php endif; ?>

            <div class="mb-3">
              <label class="form-label">Nombre</label>
              <input type="text" name="nombre" class="form-control" required
                     value="<?= $isEdit ? htmlspecialchars($categoria['nombre']) : '' ?>">
            </div>

            <div class="d-flex justify-content-between">
              <a href="<?= BASE_URL ?>/?page=admin-categories" class="btn btn-secondary">
                Volver
              </a>
              <button type="submit" class="btn btn-primary">
                <?= $isEdit ? 'Guardar cambios' : 'Crear categoría' ?>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
