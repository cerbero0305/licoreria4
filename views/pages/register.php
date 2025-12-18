<?php
// views/pages/register.php
?>
<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-7">
      <div class="card shadow-sm">
        <div class="card-body">
          <h4 class="mb-3 text-center">Registrarse</h4>
          <form method="post" action="<?= BASE_URL ?>/?page=register">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Nombre completo *</label>
                <input type="text" name="nombre" class="form-control" required>
              </div>
              <div class="col-md-3 mb-3">
                <label class="form-label">DNI *</label>
                <input type="text" name="dni" class="form-control" maxlength="8" required>
              </div>
              <div class="col-md-3 mb-3">
                <label class="form-label">Teléfono *</label>
                <input type="text" name="telefono" class="form-control" required>
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label">Correo electrónico *</label>
              <input type="email" name="email" class="form-control" required>
            </div>

            <div class="row">
              <div class="col-md-4 mb-3">
                <label class="form-label">Departamento</label>
                <input type="text" name="departamento" class="form-control">
              </div>
              <div class="col-md-4 mb-3">
                <label class="form-label">Provincia</label>
                <input type="text" name="provincia" class="form-control">
              </div>
              <div class="col-md-4 mb-3">
                <label class="form-label">Distrito</label>
                <input type="text" name="distrito" class="form-control">
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label">Dirección *</label>
              <input type="text" name="direccion" class="form-control" required>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Contraseña *</label>
                <input type="password" name="password" class="form-control" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Repetir contraseña *</label>
                <input type="password" name="password2" class="form-control" required>
              </div>
            </div>

            <button type="submit" class="btn btn-success w-100">Crear cuenta</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
