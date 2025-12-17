<?php
// controllers/AuthController.php
class AuthController {
    public function login() {
        include __DIR__ . '/../views/pages/login.php';
    }

    public function loginPost() {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($email === '' || $password === '') {
            $_SESSION['flash_error'] = "Completa todos los campos.";
            redirect('/?page=login');
        }

        $user = User::findByEmail($email);
        if (!$user || !password_verify($password, $user['password_hash'])) {
            $_SESSION['flash_error'] = "Credenciales incorrectas.";
            redirect('/?page=login');
        }

        $_SESSION['user'] = [
            'id'     => $user['id'],
            'nombre' => $user['nombre'],
            'email'  => $user['email'],
            'rol'    => $user['rol'],
        ];

        $_SESSION['flash_success'] = "Bienvenido, {$user['nombre']}!";
        redirect('/?page=home');
    }

    public function register() {
        include __DIR__ . '/../views/pages/register.php';
    }

    public function registerPost() {
        $nombre   = trim($_POST['nombre'] ?? '');
        $email    = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $password2 = $_POST['password2'] ?? '';

        if ($nombre === '' || $email === '' || $password === '' || $password2 === '') {
            $_SESSION['flash_error'] = "Todos los campos son obligatorios.";
            redirect('/?page=register');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['flash_error'] = "Email no válido.";
            redirect('/?page=register');
        }

        if ($password !== $password2) {
            $_SESSION['flash_error'] = "Las contraseñas no coinciden.";
            redirect('/?page=register');
        }

        if (User::findByEmail($email)) {
            $_SESSION['flash_error'] = "Ya existe un usuario con ese email.";
            redirect('/?page=register');
        }

        User::create([
            'nombre'   => $nombre,
            'email'    => $email,
            'password' => $password,
        ]);

        $_SESSION['flash_success'] = "Registro exitoso. Ahora puedes iniciar sesión.";
        redirect('/?page=login');
    }

    public function logout() {
        session_destroy();
        session_start();
        $_SESSION['flash_success'] = "Sesión cerrada.";
        redirect('/?page=home');
    }
}
