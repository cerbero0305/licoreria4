<?php
// models/Order.php
class Order {
    public static function create(int $user_id, array $cart) {
        $pdo = getPDO();
        $pdo->beginTransaction();
        try {
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['precio'] * $item['cantidad'];
            }

            $stmt = $pdo->prepare("INSERT INTO compras (usuario_id, total, fecha) VALUES (?,?,NOW())");
            $stmt->execute([$user_id, $total]);
            $compra_id = (int)$pdo->lastInsertId();

            $stmtDet = $pdo->prepare("INSERT INTO detalle_compra (compra_id, producto_id, cantidad, precio) VALUES (?,?,?,?)");
            foreach ($cart as $item) {
                $stmtDet->execute([
                    $compra_id,
                    $item['id'],
                    $item['cantidad'],
                    $item['precio']
                ]);
            }

            $pdo->commit();
            return $compra_id;
        } catch (Exception $e) {
            $pdo->rollBack();
            throw $e;
        }
    }

    public static function byUser(int $user_id) {
        $pdo = getPDO();
        $sql = "SELECT * FROM compras WHERE usuario_id = ? ORDER BY fecha DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$user_id]);
        return $stmt->fetchAll();
    }

    public static function details(int $compra_id) {
        $pdo = getPDO();
        $sql = "SELECT d.*, p.nombre 
                FROM detalle_compra d
                JOIN productos p ON p.id = d.producto_id
                WHERE d.compra_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$compra_id]);
        return $stmt->fetchAll();
    }
}
