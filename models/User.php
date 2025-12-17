<?php
// models/User.php
class User {
    public static function findByEmail(string $email) {
        $pdo = getPDO();
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public static function findById(int $id) {
        $pdo = getPDO();
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public static function create(array $data) {
        $pdo = getPDO();
        $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, email, password_hash, rol, created_at) VALUES (?,?,?,?,NOW())");
        return $stmt->execute([
            $data['nombre'],
            $data['email'],
            password_hash($data['password'], PASSWORD_BCRYPT),
            'cliente'
        ]);
    }

    public static function updateProfile(int $id, array $data) {
        $pdo = getPDO();
        $sql = "UPDATE usuarios SET nombre = ?, email = ? WHERE id = ?";
        $params = [$data['nombre'], $data['email'], $id];

        if (!empty($data['password'])) {
            $sql = "UPDATE usuarios SET nombre = ?, email = ?, password_hash = ? WHERE id = ?";
            $params = [$data['nombre'], $data['email'], password_hash($data['password'], PASSWORD_BCRYPT), $id];
        }

        $stmt = $pdo->prepare($sql);
        return $stmt->execute($params);
    }
}
