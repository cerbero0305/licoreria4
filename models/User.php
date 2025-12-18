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
        $stmt = $pdo->prepare("
            INSERT INTO usuarios
              (nombre, dni, telefono, departamento, provincia, distrito, direccion, email, password_hash, rol, estado, created_at)
            VALUES (?,?,?,?,?,?,?,?,?,?,?,NOW())
        ");

        return $stmt->execute([
            $data['nombre'],
            $data['dni'] ?? null,
            $data['telefono'] ?? null,
            $data['departamento'] ?? null,
            $data['provincia'] ?? null,
            $data['distrito'] ?? null,
            $data['direccion'] ?? null,
            $data['email'],
            password_hash($data['password'], PASSWORD_BCRYPT),
            $data['rol'] ?? 'cliente',
            $data['estado'] ?? 'activo',
        ]);
    }

    public static function updateProfile(int $id, array $data) {
        $pdo = getPDO();

        $baseSql = "
            UPDATE usuarios
            SET nombre = ?,
                dni = ?,
                telefono = ?,
                departamento = ?,
                provincia = ?,
                distrito = ?,
                direccion = ?,
                email = ?
        ";
        $params = [
            $data['nombre'],
            $data['dni'] ?? null,
            $data['telefono'] ?? null,
            $data['departamento'] ?? null,
            $data['provincia'] ?? null,
            $data['distrito'] ?? null,
            $data['direccion'] ?? null,
            $data['email'],
        ];

        // si hay password nueva
        if (!empty($data['password'])) {
            $baseSql .= ", password_hash = ?";
            $params[] = password_hash($data['password'], PASSWORD_BCRYPT);
        }

        $baseSql .= " WHERE id = ?";
        $params[] = $id;

        $stmt = $pdo->prepare($baseSql);
        return $stmt->execute($params);
    }

    // Para el admin: listar usuarios con filtros
    public static function all(?string $rolFilter = null, ?string $estadoFilter = null) {
        $pdo = getPDO();
        $sql = "SELECT * FROM usuarios WHERE 1=1";
        $params = [];

        if ($rolFilter) {
            $sql .= " AND rol = ?";
            $params[] = $rolFilter;
        }

        if ($estadoFilter) {
            $sql .= " AND estado = ?";
            $params[] = $estadoFilter;
        }

        $sql .= " ORDER BY created_at DESC";

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
}
