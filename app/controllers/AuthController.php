<?php
class AuthController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = Database::query('SELECT * FROM users WHERE email = ?', [$email])->fetch();

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                header('Location: /dashboard');
                exit;
            }

            $error = "Invalid credentials";
        }

        require __DIR__.'/../views/login.php';
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            try {
                Database::query('INSERT INTO users (email, password) VALUES (?, ?)', [$email, $password]);
                header('Location: /login');
                exit;
            } catch (PDOException $e) {
                $error = "Registration failed";
            }
        }

        require __DIR__.'/../views/register.php';
    }
}