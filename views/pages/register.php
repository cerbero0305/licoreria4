<?php
// views/pages/register.php
?>
<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-sm">
        <div class="card-body">
          <h4 class="mb-3 text-center">Registrarse</h4>
          <form method="post" action="<?= BASE_URL ?>/?page=register">
            <div class="mb-3">
              <label class="form-label">Nombre completo</label>
              <input type="text" name="nombre" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Correo electrónico</label>
              <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Contraseña</label>
              <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Repetir contraseña</label>
              <input type="password" name="password2" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Crear cuenta</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
