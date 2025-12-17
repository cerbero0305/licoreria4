<?php
// views/layouts/header.php
$user = currentUser();
$cart = $_SESSION['cart'] ?? [];
$cartCount = array_sum(array_column($cart, 'cantidad'));
$categoriasHeader = Category::all();
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>24 HORAS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/styles.css">
</head>
<body>
<?php include __DIR__ . '/../components/navbar.php'; ?>
<main class="bg-light min-vh-100">
<?php include __DIR__ . '/../components/alerts.php'; ?>
