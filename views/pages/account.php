<?php
// views/pages/account.php
$user = currentUser();
?>
<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-sm">
        <div class="card-body">
          <h4 class="mb-3 text-center">Mi cuenta</h4>
          <form method="post" action="<?= BASE_URL ?>/?page=account">
            <div class="mb-3">
              <label class="form-label">Nombre</label>
              <input type="text" name="nombre" class="form-control"
                     value="<?= htmlspecialchars($user['nombre']) ?>" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Correo electrónico</label>
              <input type="email" name="email" class="form-control"
                     value="<?= htmlspecialchars($user['email']) ?>" required>
            </div>
            <hr>
            <p class="mb-1">Cambiar contraseña (opcional)</p>
            <div class="mb-3">
              <label class="form-label">Nueva contraseña</label>
              <input type="password" name="password" class="form-control">
            </div>
            <div class="mb-3">
              <label class="form-label">Repetir nueva contraseña</label>
              <input type="password" name="password2" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary w-100">Guardar cambios</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
