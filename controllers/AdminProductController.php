<?php
// controllers/AdminProductController.php
class AdminProductController {
    public function index() {
        requireAdmin();
        $productos  = Product::all();
        $categorias = Category::all();
        include __DIR__ . '/../views/pages/admin/products/index.php';
    }

    public function create() {
        requireAdmin();
        $producto   = null;
        $categorias = Category::all();
        include __DIR__ . '/../views/pages/admin/products/form.php';
    }

    public function store() {
        requireAdmin();
        $nombre       = trim($_POST['nombre'] ?? '');
        $categoria_id = (int)($_POST['categoria_id'] ?? 0);
        $descripcion  = trim($_POST['descripcion'] ?? '');
        $precio       = (float)($_POST['precio'] ?? 0);
        $imagen_url   = trim($_POST['imagen_url'] ?? '');
        $activo       = isset($_POST['activo']) ? 1 : 0;

        if ($nombre === '' || $categoria_id <= 0 || $precio <= 0) {
            $_SESSION['flash_error'] = "Nombre, categoría y precio son obligatorios y válidos.";
            redirect('/?page=admin-products&action=create');
        }

        Product::create([
            'categoria_id' => $categoria_id,
            'nombre'       => $nombre,
            'descripcion'  => $descripcion,
            'precio'       => $precio,
            'imagen_url'   => $imagen_url,
            'activo'       => $activo
        ]);

        $_SESSION['flash_success'] = "Producto creado correctamente.";
        redirect('/?page=admin-products');
    }

    public function edit() {
        requireAdmin();
        $id = (int)($_GET['id'] ?? 0);
        $producto = Product::find($id);
        if (!$producto) {
            $_SESSION['flash_error'] = "Producto no encontrado.";
            redirect('/?page=admin-products');
        }
        $categorias = Category::all();
        include __DIR__ . '/../views/pages/admin/products/form.php';
    }

    public function update() {
        requireAdmin();
        $id           = (int)($_POST['id'] ?? 0);
        $nombre       = trim($_POST['nombre'] ?? '');
        $categoria_id = (int)($_POST['categoria_id'] ?? 0);
        $descripcion  = trim($_POST['descripcion'] ?? '');
        $precio       = (float)($_POST['precio'] ?? 0);
        $imagen_url   = trim($_POST['imagen_url'] ?? '');
        $activo       = isset($_POST['activo']) ? 1 : 0;

        if ($nombre === '' || $categoria_id <= 0 || $precio <= 0) {
            $_SESSION['flash_error'] = "Nombre, categoría y precio son obligatorios.";
            redirect('/?page=admin-products&action=edit&id=' . $id);
        }

        Product::update($id, [
            'categoria_id' => $categoria_id,
            'nombre'       => $nombre,
            'descripcion'  => $descripcion,
            'precio'       => $precio,
            'imagen_url'   => $imagen_url,
            'activo'       => $activo
        ]);

        $_SESSION['flash_success'] = "Producto actualizado.";
        redirect('/?page=admin-products');
    }

    public function delete() {
        requireAdmin();
        $id = (int)($_POST['id'] ?? 0);
        if ($id > 0) {
            Product::delete($id);
            $_SESSION['flash_success'] = "Producto eliminado.";
        }
        redirect('/?page=admin-products');
    }
}
