<?php
// controllers/AdminUserController.php
class AdminUserController {
    public function index() {
        requireAdmin();

        $tipo = $_GET['tipo'] ?? 'todos';
        $rolFilter = null;

        if ($tipo === 'clientes') {
            $rolFilter = 'cliente';
        } elseif ($tipo === 'administradores') {
            $rolFilter = 'admin';
        } elseif ($tipo === 'proveedores') {
            $rolFilter = 'proveedor';
        }

        $usuarios = User::all($rolFilter, null);

        include __DIR__ . '/../views/pages/admin/users/index.php';
    }
}
