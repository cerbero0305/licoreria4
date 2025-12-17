<?php
// controllers/CartController.php
class CartController {
    private function &getCartRef() {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        return $_SESSION['cart'];
    }

    public function view() {
        $cart = $this->getCartRef();
        include __DIR__ . '/../views/pages/cart.php';
    }

    public function add() {
        $product_id = (int)($_POST['product_id'] ?? 0);
        $qty        = max(1, (int)($_POST['qty'] ?? 1));

        $product = Product::find($product_id);
        if (!$product) {
            $_SESSION['flash_error'] = "Producto no encontrado.";
            redirect('/?page=home');
        }

        $cart = &$this->getCartRef();
        if (isset($cart[$product_id])) {
            $cart[$product_id]['cantidad'] += $qty;
        } else {
            $cart[$product_id] = [
                'id'       => $product['id'],
                'nombre'   => $product['nombre'],
                'precio'   => (float)$product['precio'],
                'cantidad' => $qty,
            ];
        }

        $_SESSION['flash_success'] = "Producto añadido al carrito.";
        redirect('/?page=cart');
    }

    public function update() {
        $cart = &$this->getCartRef();
        $cantidades = $_POST['cantidad'] ?? [];

        foreach ($cantidades as $id => $qty) {
            $id  = (int)$id;
            $qty = max(0, (int)$qty);
            if ($qty === 0) {
                unset($cart[$id]);
            } elseif (isset($cart[$id])) {
                $cart[$id]['cantidad'] = $qty;
            }
        }
        $_SESSION['flash_success'] = "Carrito actualizado.";
        redirect('/?page=cart');
    }

    public function remove() {
        $product_id = (int)($_GET['id'] ?? 0);
        $cart = &$this->getCartRef();
        unset($cart[$product_id]);
        $_SESSION['flash_success'] = "Producto eliminado del carrito.";
        redirect('/?page=cart');
    }

    public function checkout() {
        $cart = &$this->getCartRef();
        if (empty($cart)) {
            $_SESSION['flash_error'] = "Tu carrito está vacío.";
            redirect('/?page=cart');
        }

        $user = currentUser();
        $compra_id = Order::create($user['id'], $cart);

        // limpiar carrito
        $_SESSION['cart'] = [];
        $_SESSION['flash_success'] = "Compra realizada con éxito. N° de compra: {$compra_id}";
        redirect('/?page=my-orders');
    }
}
