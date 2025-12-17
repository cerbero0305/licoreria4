<?php
// controllers/AdminCategoryController.php
class AdminCategoryController {
    public function index() {
        requireAdmin();
        $categorias = Category::all();
        include __DIR__ . '/../views/pages/admin/categories/index.php';
    }

    public function create() {
        requireAdmin();
        $categoria = null;
        include __DIR__ . '/../views/pages/admin/categories/form.php';
    }

    public function store() {
        requireAdmin();
        $nombre = trim($_POST['nombre'] ?? '');

        if ($nombre === '') {
            $_SESSION['flash_error'] = "El nombre de la categoría es obligatorio.";
            redirect('/?page=admin-categories&action=create');
        }

        Category::create($nombre);
        $_SESSION['flash_success'] = "Categoría creada correctamente.";
        redirect('/?page=admin-categories');
    }

    public function edit() {
        requireAdmin();
        $id = (int)($_GET['id'] ?? 0);
        $categoria = Category::find($id);
        if (!$categoria) {
            $_SESSION['flash_error'] = "Categoría no encontrada.";
            redirect('/?page=admin-categories');
        }
        include __DIR__ . '/../views/pages/admin/categories/form.php';
    }

    public function update() {
        requireAdmin();
        $id = (int)($_POST['id'] ?? 0);
        $nombre = trim($_POST['nombre'] ?? '');

        if ($nombre === '') {
            $_SESSION['flash_error'] = "El nombre es obligatorio.";
            redirect('/?page=admin-categories&action=edit&id=' . $id);
        }

        Category::update($id, $nombre);
        $_SESSION['flash_success'] = "Categoría actualizada.";
        redirect('/?page=admin-categories');
    }

    public function delete() {
        requireAdmin();
        $id = (int)($_POST['id'] ?? 0);
        if ($id > 0) {
            Category::delete($id);
            $_SESSION['flash_success'] = "Categoría eliminada.";
        }
        redirect('/?page=admin-categories');
    }
}
