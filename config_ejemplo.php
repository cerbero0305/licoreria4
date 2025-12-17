<?php
// config.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('BASE_URL', ''); // ajusta a tu ruta
define('DB_HOST', '');
define('DB_NAME', '');
define('DB_USER', '');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

function getPDO(): PDO {
    static $pdo = null;
    if ($pdo === null) {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
        $pdo = new PDO($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }
    return $pdo;
}

function isLoggedIn(): bool {
    return !empty($_SESSION['user']);
}

function currentUser() {
    return $_SESSION['user'] ?? null;
}

function redirect(string $path) {
    header('Location: ' . BASE_URL . $path);
    exit;
}

function requireLogin() {
    if (!isLoggedIn()) {
        $_SESSION['flash_error'] = "Debes iniciar sesión para acceder a esta sección.";
        redirect('/?page=login');
    }
}

function isAdmin(): bool {
    $user = currentUser();
    return $user && ($user['rol'] ?? '') === 'admin';
}

function requireAdmin() {
    if (!isAdmin()) {
        $_SESSION['flash_error'] = "No tienes permisos para acceder a esta sección.";
        redirect('/?page=home');
    }
}
