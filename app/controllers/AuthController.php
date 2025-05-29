<?php
require __DIR__.'/../models/User.php';

class AuthController {
    public function login() {
        //??
    $this->tryLoginByCookies();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $isAuth = $this -> tryLogin();
        if (!$isAuth) {
            $error = "Неверные данные";
        }
    }

    // if (isset($_COOKIE['remember_user']) && !isset($_SESSION['user_id'])) {
    //         $userData = json_decode($_COOKIE['remember_user'], true);
    //         $user = User::findById($userData['id']);

    //         if ($user && password_verify($userData['token'], $user['password'])) {
    //             $_SESSION['user_id'] = $user['id'];
    //             $_SESSION['user'] = $user;
    //             header('Location: /');
    //             exit;
    //         }
    //     }

    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $email = $_POST['email'];
    //         $password = $_POST['password'];
    //         $rememberMe = isset($_POST['remember_me']);

    //         $user = User::findByEmail($email);
    //         //далее нужен password_verify($password, $user['password'])
    //         if ($user && password_verify($password, $user['password'])) {
    //             $_SESSION['user_id'] = $user['id'];
    //             $currentUser = User::findById($user['id']);
    //             $_SESSION['user'] = $currentUser;

    //              if ($rememberMe) {
    //                 $cookieValue = json_encode([
    //                     'id' => $user['id'],
    //                     'token' => $user['password'] // Используем хеш пароля как токен
    //                 ]);
    //                 setcookie('remember_user', $cookieValue, time() + 30 * 24 * 60 * 60, '/', '', false, true); // 30 дней
    //             }

    //             header('Location: /');
    //             exit;
    //         }
    //         error_log("Email: $email, Password: $password");
    //         error_log("User from DB: " . print_r($user, true));
    //         error_log("Password verify result: " . password_verify($password, $user['password']));
    //         $error = "Неверные данные";
    //         die("Неверный пароль. Хеш " . password_hash($password, PASSWORD_DEFAULT));
    //     }

        require __DIR__.'/../views/login.php';
    }

    private function tryLoginByCookies() {
         if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_token'])) {
            $token = $_COOKIE['remember_token'];
            $user = User::findByRememberToken($token);

            if ($user && $user['token_expires'] > time()) {
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

        // Сохраняем токен в БД
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
        // Удаление сессии
       if (isset($_COOKIE['remember_token'])) {
            User::clearRememberToken($_SESSION['user_id']);
            setcookie('remember_token', '', [
                'expires' => time() - 3600,
                'path' => '/'
            ]);
        }

        // Очищаем сессию
        $_SESSION = [];
        session_destroy();

        header('Location: /login');
        exit;
    }
}