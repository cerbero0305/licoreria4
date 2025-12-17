<?php
// controllers/UserController.php
class UserController {
    public function account() {
        $user = currentUser();
        include __DIR__ . '/../views/pages/account.php';
    }

    public function updateProfile() {
        $user = currentUser();

        $nombre = trim($_POST['nombre'] ?? '');
        $email  = trim($_POST['email'] ?? '');
        $password  = $_POST['password'] ?? '';
        $password2 = $_POST['password2'] ?? '';

        if ($nombre === '' || $email === '') {
            $_SESSION['flash_error'] = "Nombre y email son obligatorios.";
            redirect('/?page=account');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['flash_error'] = "Email no válido.";
            redirect('/?page=account');
        }

        if ($password !== '' && $password !== $password2) {
            $_SESSION['flash_error'] = "Las contraseñas no coinciden.";
            redirect('/?page=account');
        }

        User::updateProfile($user['id'], [
            'nombre'   => $nombre,
            'email'    => $email,
            'password' => $password,
        ]);

        // refrescar datos en sesión
        $updated = User::findById($user['id']);
        $_SESSION['user'] = [
            'id'     => $updated['id'],
            'nombre' => $updated['nombre'],
            'email'  => $updated['email'],
            'rol'    => $updated['rol'],
        ];

        $_SESSION['flash_success'] = "Datos actualizados.";
        redirect('/?page=account');
    }
}
