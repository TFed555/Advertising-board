<?php

class User {
    public static function findByEmail($email) {
        $query = Database::query(
            "Select * From users where email = ? Limit 1", [$email]
        );
        return $query -> fetch();
    }

    public static function create($name, $email, $phone, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        Database::query('INSERT INTO users (name, email, phone, password) VALUES (?, ?, ?, ?)', [$name, $email, $phone, $hashedPassword]);
        return Database::lastInsertId();
    }

     public static function findById($id) {
        $stmt = Database::query(
            "SELECT * FROM users WHERE id = ? LIMIT 1",
            [$id]
        );
        return $stmt->fetch();
    }
}