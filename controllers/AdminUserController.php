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

    public function create() {
        requireAdmin();
        $usuario = null; // modo crear
        include __DIR__ . '/../views/pages/admin/users/form.php';
    }

    public function store() {
        requireAdmin();

        $nombre       = trim($_POST['nombre'] ?? '');
        $dni          = trim($_POST['dni'] ?? '');
        $telefono     = trim($_POST['telefono'] ?? '');
        $departamento = trim($_POST['departamento'] ?? '');
        $provincia    = trim($_POST['provincia'] ?? '');
        $distrito     = trim($_POST['distrito'] ?? '');
        $direccion    = trim($_POST['direccion'] ?? '');
        $email        = trim($_POST['email'] ?? '');
        $rol          = $_POST['rol'] ?? 'cliente';
        $estado       = $_POST['estado'] ?? 'activo';
        $password     = $_POST['password'] ?? '';
        $password2    = $_POST['password2'] ?? '';

        if ($nombre === '' || $email === '' || $password === '' || $password2 === '') {
            $_SESSION['flash_error'] = "Nombre, correo y contraseña son obligatorios.";
            redirect('/?page=admin-users&action=create');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['flash_error'] = "Correo electrónico no válido.";
            redirect('/?page=admin-users&action=create');
        }

        if ($password !== $password2) {
            $_SESSION['flash_error'] = "Las contraseñas no coinciden.";
            redirect('/?page=admin-users&action=create');
        }

        if (User::findByEmail($email)) {
            $_SESSION['flash_error'] = "Ya existe un usuario con ese correo.";
            redirect('/?page=admin-users&action=create');
        }

        if (!in_array($rol, ['cliente', 'admin', 'proveedor'], true)) {
            $rol = 'cliente';
        }

        if (!in_array($estado, ['activo', 'inactivo'], true)) {
            $estado = 'activo';
        }

        User::create([
            'nombre'       => $nombre,
            'dni'          => $dni,
            'telefono'     => $telefono,
            'departamento' => $departamento,
            'provincia'    => $provincia,
            'distrito'     => $distrito,
            'direccion'    => $direccion,
            'email'        => $email,
            'password'     => $password,
            'rol'          => $rol,
            'estado'       => $estado,
        ]);

        $_SESSION['flash_success'] = "Usuario creado correctamente.";
        redirect('/?page=admin-users');
    }

    public function edit() {
        requireAdmin();
        $id = (int)($_GET['id'] ?? 0);
        $usuario = User::findById($id);
        if (!$usuario) {
            $_SESSION['flash_error'] = "Usuario no encontrado.";
            redirect('/?page=admin-users');
        }
        include __DIR__ . '/../views/pages/admin/users/form.php';
    }

    public function update() {
        requireAdmin();

        $id           = (int)($_POST['id'] ?? 0);
        $usuarioActual = User::findById($id);
        if (!$usuarioActual) {
            $_SESSION['flash_error'] = "Usuario no encontrado.";
            redirect('/?page=admin-users');
        }

        $nombre       = trim($_POST['nombre'] ?? '');
        $dni          = trim($_POST['dni'] ?? '');
        $telefono     = trim($_POST['telefono'] ?? '');
        $departamento = trim($_POST['departamento'] ?? '');
        $provincia    = trim($_POST['provincia'] ?? '');
        $distrito     = trim($_POST['distrito'] ?? '');
        $direccion    = trim($_POST['direccion'] ?? '');
        $email        = trim($_POST['email'] ?? '');
        $rol          = $_POST['rol'] ?? 'cliente';
        $estado       = $_POST['estado'] ?? 'activo';
        $password     = $_POST['password'] ?? '';
        $password2    = $_POST['password2'] ?? '';

        if ($nombre === '' || $email === '') {
            $_SESSION['flash_error'] = "Nombre y correo son obligatorios.";
            redirect('/?page=admin-users&action=edit&id=' . $id);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['flash_error'] = "Correo electrónico no válido.";
            redirect('/?page=admin-users&action=edit&id=' . $id);
        }

        if ($password !== '' && $password !== $password2) {
            $_SESSION['flash_error'] = "Las contraseñas no coinciden.";
            redirect('/?page=admin-users&action=edit&id=' . $id);
        }

        // comprobar correo duplicado en otro usuario
        $userByEmail = User::findByEmail($email);
        if ($userByEmail && (int)$userByEmail['id'] !== $id) {
            $_SESSION['flash_error'] = "Ya existe otro usuario con ese correo.";
            redirect('/?page=admin-users&action=edit&id=' . $id);
        }

        if (!in_array($rol, ['cliente', 'admin', 'proveedor'], true)) {
            $rol = 'cliente';
        }

        if (!in_array($estado, ['activo', 'inactivo'], true)) {
            $estado = 'activo';
        }

        User::adminUpdate($id, [
            'nombre'       => $nombre,
            'dni'          => $dni,
            'telefono'     => $telefono,
            'departamento' => $departamento,
            'provincia'    => $provincia,
            'distrito'     => $distrito,
            'direccion'    => $direccion,
            'email'        => $email,
            'rol'          => $rol,
            'estado'       => $estado,
            'password'     => $password,
        ]);

        $_SESSION['flash_success'] = "Usuario actualizado correctamente.";
        redirect('/?page=admin-users');
    }
}