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

    public static function updateProfile($name, $email, $phone, $Id) {
        Database::query('Update users set name = ?, email = ?, phone = ? where id = ?',
                [$name, $email, $phone, $Id]);
        return self::findById($Id);
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

        //добавляем новый токен
        $query = Database::query("
            INSERT INTO remember_tokens (user_id, token, expires_at)
            VALUES (?, ?, ?)
        ", [$userId, $token, date('Y-m-d H:i:s', $expires)]);
    }

    public static function clearRememberToken($userId) {
        Database::query("DELETE FROM remember_tokens WHERE user_id = ?", [$userId]);
    }


    //для восстановления пароля
    public static function updateResetToken($token, $user_id) {
        Database::query('Replace into reset_tokens (token, user_id, expires_at) values(?, ?, ?)',[$token, $user_id,
         date('Y-m-d H:i:s', time() + 10 * 60)]);
    }

    public static function changePassword($token, $newPassword) {
        $user_id = Database::query('Select user_id from reset_tokens where token = ?', [$token])->fetch(PDO::FETCH_ASSOC);
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $oldPassword = Database::query('Select password from users where id = ?', [$user_id['user_id']])->fetch(PDO::FETCH_ASSOC)['password'];
        if (password_verify($newPassword, $oldPassword)) {
            return false;
        }
        Database::query('Update users set password = ? where id = ?', [$hashedPassword, $user_id['user_id']]);
        return true;
    }

    public static function getExpiredTime($token) {
        $value = Database::query('Select expires_at from reset_tokens where token = ?', [$token])->fetch();
        return $value ? $value : null;
    }

    public static function deleteResetToken($token) {
        Database::query('Delete from reset_tokens where token = ?', [$token]);
    }
}