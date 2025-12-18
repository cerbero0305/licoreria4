<?php
// views/pages/admin/users/form.php
$isEdit = !empty($usuario);
?>
<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="card shadow-sm">
        <div class="card-body">
          <h4 class="mb-3 text-center">
            <?= $isEdit ? 'Editar usuario' : 'Nuevo usuario' ?>
          </h4>

          <form method="post"
                action="<?= BASE_URL ?>/?page=admin-users&action=<?= $isEdit ? 'edit' : 'create' ?>">
            <?php if ($isEdit): ?>
              <input type="hidden" name="id" value="<?= $usuario['id'] ?>">
            <?php endif; ?>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Nombre completo *</label>
                <input type="text" name="nombre" class="form-control" required
                       value="<?= $isEdit ? htmlspecialchars($usuario['nombre']) : '' ?>">
              </div>
              <div class="col-md-3 mb-3">
                <label class="form-label">DNI</label>
                <input type="text" name="dni" class="form-control" maxlength="8"
                       value="<?= $isEdit ? htmlspecialchars($usuario['dni'] ?? '') : '' ?>">
              </div>
              <div class="col-md-3 mb-3">
                <label class="form-label">Teléfono</label>
                <input type="text" name="telefono" class="form-control"
                       value="<?= $isEdit ? htmlspecialchars($usuario['telefono'] ?? '') : '' ?>">
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label">Correo electrónico *</label>
              <input type="email" name="email" class="form-control" required
                     value="<?= $isEdit ? htmlspecialchars($usuario['email']) : '' ?>">
            </div>

            <div class="row">
              <div class="col-md-4 mb-3">
                <label class="form-label">Departamento</label>
                <input type="text" name="departamento" class="form-control"
                       value="<?= $isEdit ? htmlspecialchars($usuario['departamento'] ?? '') : '' ?>">
              </div>
              <div class="col-md-4 mb-3">
                <label class="form-label">Provincia</label>
                <input type="text" name="provincia" class="form-control"
                       value="<?= $isEdit ? htmlspecialchars($usuario['provincia'] ?? '') : '' ?>">
              </div>
              <div class="col-md-4 mb-3">
                <label class="form-label">Distrito</label>
                <input type="text" name="distrito" class="form-control"
                       value="<?= $isEdit ? htmlspecialchars($usuario['distrito'] ?? '') : '' ?>">
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label">Dirección</label>
              <input type="text" name="direccion" class="form-control"
                     value="<?= $isEdit ? htmlspecialchars($usuario['direccion'] ?? '') : '' ?>">
            </div>

            <div class="row">
              <div class="col-md-4 mb-3">
                <label class="form-label">Rol *</label>
                <select name="rol" class="form-select" required>
                  <?php
                  $rolValue = $isEdit ? $usuario['rol'] : 'cliente';
                  ?>
                  <option value="cliente" <?= $rolValue === 'cliente' ? 'selected' : '' ?>>Cliente</option>
                  <option value="admin" <?= $rolValue === 'admin' ? 'selected' : '' ?>>Administrador</option>
                  <option value="proveedor" <?= $rolValue === 'proveedor' ? 'selected' : '' ?>>Proveedor</option>
                </select>
              </div>
              <div class="col-md-4 mb-3">
                <label class="form-label">Estado *</label>
                <?php $estadoValue = $isEdit ? ($usuario['estado'] ?? 'activo') : 'activo'; ?>
                <select name="estado" class="form-select" required>
                  <option value="activo" <?= $estadoValue === 'activo' ? 'selected' : '' ?>>Activo</option>
                  <option value="inactivo" <?= $estadoValue === 'inactivo' ? 'selected' : '' ?>>Inactivo</option>
                </select>
              </div>
            </div>

            <hr>
            <p class="mb-1">
              <?= $isEdit ? 'Cambiar contraseña (opcional)' : 'Definir contraseña *' ?>
            </p>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Contraseña <?= $isEdit ? '' : '*' ?></label>
                <input type="password" name="password" class="form-control" <?= $isEdit ? '' : 'required' ?>>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Repetir contraseña <?= $isEdit ? '' : '*' ?></label>
                <input type="password" name="password2" class="form-control" <?= $isEdit ? '' : 'required' ?>>
              </div>
            </div>

            <div class="d-flex justify-content-between">
              <a href="<?= BASE_URL ?>/?page=admin-users" class="btn btn-secondary">
                Volver
              </a>
              <button type="submit" class="btn btn-primary">
                <?= $isEdit ? 'Guardar cambios' : 'Guardar usuario' ?>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>