<?php
// controllers/OrderController.php
class OrderController {
    public function myOrders() {
        $user = currentUser();
        $compras = Order::byUser($user['id']);
        include __DIR__ . '/../views/pages/my-orders.php';
    }
}
