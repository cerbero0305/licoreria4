<?php
// views/pages/admin/products/form.php
$isEdit = !empty($producto);
?>
<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="card shadow-sm">
        <div class="card-body">
          <h4 class="mb-3 text-center">
            <?= $isEdit ? 'Editar producto' : 'Nuevo producto' ?>
          </h4>

          <form method="post"
                action="<?= BASE_URL ?>/?page=admin-products&action=<?= $isEdit ? 'edit' : 'create' ?>">

            <?php if ($isEdit): ?>
              <input type="hidden" name="id" value="<?= $producto['id'] ?>">
            <?php endif; ?>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" required
                       value="<?= $isEdit ? htmlspecialchars($producto['nombre']) : '' ?>">
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label">Categoría</label>
                <select name="categoria_id" class="form-select" required>
                  <option value="">Seleccionar...</option>
                  <?php foreach ($categorias as $cat): ?>
                    <option value="<?= $cat['id'] ?>"
                      <?= $isEdit && $producto['categoria_id'] == $cat['id'] ? 'selected' : '' ?>>
                      <?= htmlspecialchars($cat['nombre']) ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label">Descripción</label>
              <textarea name="descripcion" class="form-control" rows="3"><?= $isEdit ? htmlspecialchars($producto['descripcion']) : '' ?></textarea>
            </div>

            <div class="row">
              <div class="col-md-4 mb-3">
                <label class="form-label">Precio (S/)</label>
                <input type="number" step="0.01" min="0" name="precio" class="form-control" required
                       value="<?= $isEdit ? htmlspecialchars($producto['precio']) : '' ?>">
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label">URL de imagen</label>
                <input type="text" name="imagen_url" class="form-control"
                       value="<?= $isEdit ? htmlspecialchars($producto['imagen_url']) : '' ?>">
                <div class="form-text">Puede ser una ruta interna o URL externa.</div>
              </div>

              <div class="col-md-2 mb-3 d-flex align-items-end">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="activo" name="activo"
                    <?= $isEdit ? ($producto['activo'] ? 'checked' : '') : 'checked' ?>>
                  <label class="form-check-label" for="activo">
                    Activo
                  </label>
                </div>
              </div>
            </div>

            <?php if ($isEdit && !empty($producto['imagen_url'])): ?>
              <div class="mb-3">
                <label class="form-label">Vista previa:</label><br>
                <img src="<?= htmlspecialchars($producto['imagen_url']) ?>" alt="Vista previa"
                     class="img-thumbnail" style="max-height: 150px;">
              </div>
            <?php endif; ?>

            <div class="d-flex justify-content-between">
              <a href="<?= BASE_URL ?>/?page=admin-products" class="btn btn-secondary">
                Volver
              </a>
              <button type="submit" class="btn btn-primary">
                <?= $isEdit ? 'Guardar cambios' : 'Crear producto' ?>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
