<?php
// models/Category.php
class Category {
    public static function all() {
        $pdo = getPDO();
        return $pdo->query("SELECT * FROM categorias ORDER BY nombre")->fetchAll();
    }

    public static function find(int $id) {
        $pdo = getPDO();
        $stmt = $pdo->prepare("SELECT * FROM categorias WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public static function create(string $nombre) {
        $pdo = getPDO();
        $stmt = $pdo->prepare("INSERT INTO categorias (nombre) VALUES (?)");
        return $stmt->execute([$nombre]);
    }

    public static function update(int $id, string $nombre) {
        $pdo = getPDO();
        $stmt = $pdo->prepare("UPDATE categorias SET nombre = ? WHERE id = ?");
        return $stmt->execute([$nombre, $id]);
    }

    public static function delete(int $id) {
        $pdo = getPDO();
        // Opcional: comprobar productos asociados antes de borrar
        $stmt = $pdo->prepare("DELETE FROM categorias WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
