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
        $query = Database::query(
            "SELECT * FROM users WHERE id = ? LIMIT 1",
            [$id]
        );
        return $query->fetch();
    }

    //Методы для работы с cookies

    public static function findByRememberToken($token) {
        $query = Database::query("
            SELECT u.* FROM users u
            JOIN remember_tokens rt ON u.id = rt.user_id
            WHERE rt.token = ? AND rt.expires_at > NOW()
        ", [$token]);
        return $query->fetch();
    }

    public static function expiresToken($user_id) {
         $query = Database::query("
            SELECT expires_at FROM remember_tokens
            WHERE remember_tokens.user_id = ?
        ", [$user_id]);
        return $query->fetch();
    }

    public static function updateRememberToken($userId, $token, $expires) {
        Database::query("DELETE FROM remember_tokens WHERE user_id = ?", [$userId]);

        //Добавляем новый токен
        $query = Database::query("
            INSERT INTO remember_tokens (user_id, token, expires_at)
            VALUES (?, ?, ?)
        ", [$userId, $token, date('Y-m-d H:i:s', $expires)]);
    }

    public static function clearRememberToken($userId) {
        Database::query("DELETE FROM remember_tokens WHERE user_id = ?", [$userId]);
    }
}