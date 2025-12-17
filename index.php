<?php
// index.php
require_once __DIR__ . '/config.php';

// Cargar modelos
require_once __DIR__ . '/models/User.php';
require_once __DIR__ . '/models/Product.php';
require_once __DIR__ . '/models/Category.php';
require_once __DIR__ . '/models/Order.php';
require_once __DIR__ . '/models/OrderItem.php';

// Cargar controladores
require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/ProductController.php';
require_once __DIR__ . '/controllers/CartController.php';
require_once __DIR__ . '/controllers/UserController.php';
require_once __DIR__ . '/controllers/OrderController.php';
require_once __DIR__ . '/controllers/AdminCategoryController.php';
require_once __DIR__ . '/controllers/AdminProductController.php';

$page   = $_GET['page'] ?? 'home';
$action = $_GET['action'] ?? 'index';

$authController    = new AuthController();
$productController = new ProductController();
$cartController    = new CartController();
$userController    = new UserController();
$orderController   = new OrderController();
$adminCategoryController = new AdminCategoryController();
$adminProductController  = new AdminProductController();

ob_start();

switch ($page) {
    case 'home':
        $productController->home();
        break;

        case 'user':
        $productController->user();
        break;

    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $authController->loginPost();
        } else {
            $authController->login();
        }
        break;

    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $authController->registerPost();
        } else {
            $authController->register();
        }
        break;

    case 'logout':
        $authController->logout();
        break;

    case 'account':
        requireLogin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userController->updateProfile();
        } else {
            $userController->account();
        }
        break;

    case 'my-orders':
        requireLogin();
        $orderController->myOrders();
        break;

    case 'cart':
        if ($action === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $cartController->add();
        } elseif ($action === 'update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $cartController->update();
        } elseif ($action === 'remove') {
            $cartController->remove();
        } elseif ($action === 'checkout' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            requireLogin();
            $cartController->checkout();
        } else {
            $cartController->view();
        }
        break;

    case 'category':
        $productController->byCategory();
        break;

    case 'search':
        $productController->search();
        break;

        case 'admin-categories':
        requireAdmin();
        $action = $_GET['action'] ?? 'index';
        if ($action === 'create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $adminCategoryController->store();
        } elseif ($action === 'create') {
            $adminCategoryController->create();
        } elseif ($action === 'edit' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $adminCategoryController->update();
        } elseif ($action === 'edit') {
            $adminCategoryController->edit();
        } elseif ($action === 'delete' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $adminCategoryController->delete();
        } else {
            $adminCategoryController->index();
        }
        break;

    case 'admin-products':
        requireAdmin();
        $action = $_GET['action'] ?? 'index';
        if ($action === 'create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $adminProductController->store();
        } elseif ($action === 'create') {
            $adminProductController->create();
        } elseif ($action === 'edit' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $adminProductController->update();
        } elseif ($action === 'edit') {
            $adminProductController->edit();
        } elseif ($action === 'delete' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $adminProductController->delete();
        } else {
            $adminProductController->index();
        }
        break;

            case 'product':
        $productController->show();
        break;



    // Aquí podrías agregar rutas admin para CRUD de productos
    default:
        http_response_code(404);
        echo "<div class='container py-5'><h1>404 - Página no encontrada</h1></div>";
        break;
}

$content = ob_get_clean();

// Layout principal
include __DIR__ . '/views/layouts/header.php';
echo $content;
include __DIR__ . '/views/layouts/footer.php';
