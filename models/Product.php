<?php
// models/Product.php
class Product {
    public static function all() {
        $pdo = getPDO();
        $sql = "SELECT p.*, c.nombre AS categoria_nombre 
                FROM productos p
                JOIN categorias c ON c.id = p.categoria_id
                ORDER BY p.nombre";
        return $pdo->query($sql)->fetchAll();
    }

    public static function allActive() {
        $pdo = getPDO();
        $sql = "SELECT p.*, c.nombre AS categoria_nombre 
                FROM productos p
                JOIN categorias c ON c.id = p.categoria_id
                WHERE p.activo = 1
                ORDER BY p.nombre";
        return $pdo->query($sql)->fetchAll();
    }

    public static function byCategory(int $categoria_id) {
        $pdo = getPDO();
        $stmt = $pdo->prepare("SELECT * FROM productos WHERE categoria_id = ? AND activo = 1");
        $stmt->execute([$categoria_id]);
        return $stmt->fetchAll();
    }

    public static function search(string $term) {
        $pdo = getPDO();
        $like = "%$term%";
        $sql = "SELECT p.*, c.nombre AS categoria_nombre
                FROM productos p
                JOIN categorias c ON c.id = p.categoria_id
                WHERE p.activo = 1
                  AND (p.nombre LIKE ? OR c.nombre LIKE ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$like, $like]);
        return $stmt->fetchAll();
    }

    public static function find(int $id) {
    $pdo = getPDO();
    $sql = "SELECT p.*, c.nombre AS categoria_nombre
            FROM productos p
            JOIN categorias c ON c.id = p.categoria_id
            WHERE p.id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch();
}


    public static function create(array $data) {
        $pdo = getPDO();
        $stmt = $pdo->prepare("
            INSERT INTO productos (categoria_id, nombre, descripcion, precio, imagen_url, activo)
            VALUES (?,?,?,?,?,?)
        ");
        return $stmt->execute([
            $data['categoria_id'],
            $data['nombre'],
            $data['descripcion'],
            $data['precio'],
            $data['imagen_url'],
            $data['activo']
        ]);
    }

    public static function update(int $id, array $data) {
        $pdo = getPDO();
        $stmt = $pdo->prepare("
            UPDATE productos
            SET categoria_id = ?, nombre = ?, descripcion = ?, precio = ?, imagen_url = ?, activo = ?
            WHERE id = ?
        ");
        return $stmt->execute([
            $data['categoria_id'],
            $data['nombre'],
            $data['descripcion'],
            $data['precio'],
            $data['imagen_url'],
            $data['activo'],
            $id
        ]);
    }

    public static function delete(int $id) {
        $pdo = getPDO();
        $stmt = $pdo->prepare("DELETE FROM productos WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
