<?php

require __DIR__."/../controllers/AuthController.php";

class AuthMiddleware { public function handle() {
        if (!isset($_SESSION['user_id'])) {
            if (isset($_COOKIE['remember_token'])) {
                $user = User::findByRememberToken($_COOKIE['remember_token']);
                if ($user && User::expiresToken($user['id']) > time()) {
                    $_SESSION['user_id'] = $user['id'];
                    return; //Авторизация успешна
                }
            }

            if ($this->isProtectedRoute()) {
                header('Location: /login');
                exit;
            }
        }
    }
    private function isProtectedRoute() {
        $protectedRoutes = ['/', '/profile', '/settings'];
        return in_array($_SERVER['REQUEST_URI'], $protectedRoutes);
    }
}