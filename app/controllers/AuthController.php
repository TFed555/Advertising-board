<?php
require __DIR__.'/../models/User.php';
require __DIR__.'/../models/UserMenu.php';

class AuthController {
    public function login() {
        //??

    if (isset($_SESSION['user_id'])) {
        header('Location: /');
        exit;
    }

    $this->tryLoginByCookies();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $isAuth = $this -> tryLogin();
        if (!$isAuth) {
            $error = "Неверные данные";
        }
    }

        require __DIR__.'/../views/login.php';
    }

    private function tryLoginByCookies() {
         if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_token'])) {
            $token = $_COOKIE['remember_token'];
            $user = User::findByRememberToken($token);
            if ($user==false) {
                return;
            }
            $token_expires = User::expiresToken($user['id']);
            if ($user && $token_expires > time()) {
                $this->createUserSession($user);
                header('Location: /');
                exit;
            }
        }
    }

    private function tryLogin() {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $rememberMe = isset($_POST['remember_me']);

            $user = User::findByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                $this->createUserSession($user);

                 if ($rememberMe) {
                    $this->setRememberCookie($user['id']);
                }
                header('Location: /');
                exit;
            }
            else {
                return false;
            }

    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['username'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $password = $_POST['password'];

            try {
                $userId = User::create($name, $email, $phone, $password);
                UserMenu::createMenuConfig($userId);
                $_SESSION['user_id'] = $userId;
                header('Location: /login');
                exit;
            } catch (PDOException $e) {
                $error = "Registration failed" . $e->getMessage();
            }
        }

        require __DIR__.'/../views/login.php';
    }

    private function createUserSession($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user'] = [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email']
        ];
    }


    private function setRememberCookie($userId) {
        $token = bin2hex(random_bytes(32));
        $expires = time() + 30 * 24 * 60 * 60;

        //сохраняем токен в бд
        User::updateRememberToken($userId, $token, $expires);

        try {
                setcookie('remember_token', $token, [
                'expires' => $expires,
                'path' => '/',
                'domain' => $_SERVER['HTTP_HOST'],
                'secure' => true,
                'httponly' => true,
                'samesite' => 'Strict'
            ]);
        } catch (PDOException $e) {
            error_log("Remember token error: ". $e->getMessage());
        }
    }


     public function logout() {
        //удаление сессии
       if (isset($_COOKIE['remember_token'])) {
            User::clearRememberToken($_SESSION['user_id']);
            setcookie('remember_token', '', [
                'expires' => time() - 3600,
                'path' => '/'
            ]);
        }

        //очищение сессии
        $_SESSION = [];
        session_destroy();

        header('Location: /login');
        exit;

        require __DIR__.'/../views/login.php';
    }

}