<?php
// views/pages/account.php
$user = currentUser();
?>
<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-lg-7">
      <div class="card shadow-sm mb-3">
        <div class="card-body">
          <h4 class="mb-3 text-center">Mi cuenta</h4>

          <form method="post" action="<?= BASE_URL ?>/?page=account">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Nombre *</label>
                <input type="text" name="nombre" class="form-control"
                       value="<?= htmlspecialchars($user['nombre']) ?>" required>
              </div>
              <div class="col-md-3 mb-3">
                <label class="form-label">DNI</label>
                <input type="text" name="dni" class="form-control"
                       value="<?= htmlspecialchars($user['dni'] ?? '') ?>">
              </div>
              <div class="col-md-3 mb-3">
                <label class="form-label">Teléfono</label>
                <input type="text" name="telefono" class="form-control"
                       value="<?= htmlspecialchars($user['telefono'] ?? '') ?>">
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label">Correo electrónico *</label>
              <input type="email" name="email" class="form-control"
                     value="<?= htmlspecialchars($user['email']) ?>" required>
            </div>

            <div class="row">
              <div class="col-md-4 mb-3">
                <label class="form-label">Departamento</label>
                <input type="text" name="departamento" class="form-control"
                       value="<?= htmlspecialchars($user['departamento'] ?? '') ?>">
              </div>
              <div class="col-md-4 mb-3">
                <label class="form-label">Provincia</label>
                <input type="text" name="provincia" class="form-control"
                       value="<?= htmlspecialchars($user['provincia'] ?? '') ?>">
              </div>
              <div class="col-md-4 mb-3">
                <label class="form-label">Distrito</label>
                <input type="text" name="distrito" class="form-control"
                       value="<?= htmlspecialchars($user['distrito'] ?? '') ?>">
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label">Dirección</label>
              <input type="text" name="direccion" class="form-control"
                     value="<?= htmlspecialchars($user['direccion'] ?? '') ?>">
            </div>

            <hr>
            <p class="mb-1">Cambiar contraseña (opcional)</p>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Nueva contraseña</label>
                <input type="password" name="password" class="form-control">
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Repetir nueva contraseña</label>
                <input type="password" name="password2" class="form-control">
              </div>
            </div>

            <button type="submit" class="btn btn-primary w-100">Guardar cambios</button>
          </form>
        </div>
      </div>

      <div class="card shadow-sm">
        <div class="card-body d-flex justify-content-between">
          <div>
            <p class="mb-1">
              Rol:
              <span class="badge bg-secondary">
                <?= htmlspecialchars($user['rol']) ?>
              </span>
            </p>
            <p class="mb-0">
              Estado:
              <span class="badge <?= ($user['estado'] ?? 'activo') === 'activo' ? 'bg-success' : 'bg-danger' ?>">
                <?= htmlspecialchars($user['estado'] ?? 'activo') ?>
              </span>
            </p>
          </div>
          <div class="text-end">
            <small class="text-muted">
              Fecha de registro:<br>
              <?= htmlspecialchars($user['created_at'] ?? '') ?>
            </small>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
