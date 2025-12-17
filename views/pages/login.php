<?php
// views/pages/login.php
?>
<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card shadow-sm">
        <div class="card-body">
          <h4 class="mb-3 text-center">Iniciar sesión</h4>
          <form method="post" action="<?= BASE_URL ?>/?page=login">
            <div class="mb-3">
              <label for="email" class="form-label">Correo electrónico</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Contraseña</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Entrar</button>
          </form>
          <p class="mt-3 text-center">
            ¿No tienes cuenta?
            <a href="<?= BASE_URL ?>/?page=register">Regístrate aquí</a>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
