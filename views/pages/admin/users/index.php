<?php
// views/pages/admin/users/index.php
?>
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Usuarios registrados</h4>
    <div class="btn-group btn-group-sm" role="group">
      <a href="<?= BASE_URL ?>/?page=admin-users&tipo=todos"
         class="btn btn-outline-secondary <?= (!isset($_GET['tipo']) || $_GET['tipo'] === 'todos') ? 'active' : '' ?>">
        Todos
      </a>
      <a href="<?= BASE_URL ?>/?page=admin-users&tipo=clientes"
         class="btn btn-outline-secondary <?= (($_GET['tipo'] ?? '') === 'clientes') ? 'active' : '' ?>">
        Clientes
      </a>
      <a href="<?= BASE_URL ?>/?page=admin-users&tipo=administradores"
         class="btn btn-outline-secondary <?= (($_GET['tipo'] ?? '') === 'administradores') ? 'active' : '' ?>">
        Administradores
      </a>
      <a href="<?= BASE_URL ?>/?page=admin-users&tipo=proveedores"
         class="btn btn-outline-secondary <?= (($_GET['tipo'] ?? '') === 'proveedores') ? 'active' : '' ?>">
        Proveedores
      </a>
    </div>
  </div>

  <?php if (empty($usuarios)): ?>
    <div class="alert alert-info">No se encontraron proveedores.</div>
  <?php else: ?>
    <div class="table-responsive">
      <table class="table table-striped align-middle table-sm">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre / DNI</th>
            <th>Teléfono</th>
            <th>Correo</th>
            <th>Ubicación</th>
            <th>Rol</th>
            <th>Estado</th>
            <th>Registro</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($usuarios as $u): ?>
          <tr>
            <td><?= $u['id'] ?></td>
            <td>
              <?= htmlspecialchars($u['nombre']) ?><br>
              <small class="text-muted">DNI: <?= htmlspecialchars($u['dni'] ?? '-') ?></small>
            </td>
            <td><?= htmlspecialchars($u['telefono'] ?? '-') ?></td>
            <td><?= htmlspecialchars($u['email']) ?></td>
            <td>
              <small>
                <?= htmlspecialchars($u['departamento'] ?? '') ?>
                <?= $u['departamento'] ? ' - ' : '' ?>
                <?= htmlspecialchars($u['provincia'] ?? '') ?>
                <?= $u['provincia'] ? ' - ' : '' ?>
                <?= htmlspecialchars($u['distrito'] ?? '') ?>
              </small>
            </td>
            <td>
              <span class="badge bg-secondary"><?= htmlspecialchars($u['rol']) ?></span>
            </td>
            <td>
              <span class="badge <?= ($u['estado'] ?? 'activo') === 'activo' ? 'bg-success' : 'bg-danger' ?>">
                <?= htmlspecialchars($u['estado'] ?? 'activo') ?>
              </span>
            </td>
            <td>
              <small class="text-muted"><?= htmlspecialchars($u['created_at'] ?? '') ?></small>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</div>
