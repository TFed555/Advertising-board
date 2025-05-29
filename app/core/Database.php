<?php
class Database {
    private static $pdo;

    public static function init(array $config) {
        try {
            self::$pdo = new PDO(
                "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8mb4",
                $config['user'],
                $config['password'],
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        } catch (PDOException $e) {
            die("Database error: " . $e->getMessage());
        }
    }

    public static function query(string $sql, array $params = []) {
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public static function getPdo(): PDO {
        return self::$pdo;
    }

    public static function lastInsertId() {
        return self::$pdo->lastInsertId();
    }
}