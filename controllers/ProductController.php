<?php
// controllers/ProductController.php
class ProductController {
        public function home() {
        $categorias = Category::all();
        $productos  = Product::allActive(); // antes: Product::all()
        $section    = 'todos';
        include __DIR__ . '/../views/pages/home.php';
    }

    public function byCategory() {
        $categorias = Category::all();
        $categoria_id = (int)($_GET['id'] ?? 0);
        $productos = $categoria_id ? Product::byCategory($categoria_id) : [];
        $section   = 'categoria';
        include __DIR__ . '/../views/pages/home.php';
    }

    public function search() {
        $categorias = Category::all();
        $q = trim($_GET['q'] ?? '');
        $productos = $q !== '' ? Product::search($q) : [];
        $section   = 'busqueda';
        include __DIR__ . '/../views/pages/home.php';
    }

    public function show() {
    $id = (int)($_GET['id'] ?? 0);
    $producto = Product::find($id);

    if (!$producto) {
        http_response_code(404);
        echo "<div class='container py-5'><h1>Producto no encontrado</h1></div>";
        return;
    }

    include __DIR__ . '/../views/pages/product-detail.php';
}

}
