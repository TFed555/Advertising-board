<?php
require __DIR__.'/../models/User.php';

class AuthController {
    public function login() {
        //??
    $registrationSuccess = false;
    if (isset($_SESSION['registration_success']) && $_SESSION['registration_success']) {
        $registrationSuccess = true;
        unset($_SESSION['registration_success']);
    }
    if (isset($_COOKIE['remember_user']) && !isset($_SESSION['user_id'])) {
            $userData = json_decode($_COOKIE['remember_user'], true);
            $user = User::findById($userData['id']);

            if ($user && password_verify($userData['token'], $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user'] = $user;
                header('Location: /');
                exit;
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $rememberMe = isset($_POST['remember_me']);

            $user = User::findByEmail($email);
            //далее нужен password_verify($password, $user['password'])
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $currentUser = User::findById($user['id']);
                $_SESSION['user'] = $currentUser;

                 if ($rememberMe) {
                    $cookieValue = json_encode([
                        'id' => $user['id'],
                        'token' => $user['password'] // Используем хеш пароля как токен
                    ]);
                    setcookie('remember_user', $cookieValue, time() + 30 * 24 * 60 * 60, '/', '', false, true); // 30 дней
                }

                header('Location: /');
                exit;
            }
            error_log("Email: $email, Password: $password");
            error_log("User from DB: " . print_r($user, true));
            error_log("Password verify result: " . password_verify($password, $user['password']));
            $error = "Неверные данные";
            die("Неверный пароль. Хеш " . password_hash($password, PASSWORD_DEFAULT));
        }

        require __DIR__.'/../views/login.php';
    }

    //переделать регистрацию
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

     public function logout() {
        // Удаление сессии
        session_unset();
        session_destroy();

        if (isset($_COOKIE['remember_user'])) {
            setcookie('remember_user', '', time() - 3600, '/');
        }

        header('Location: /login');
        exit;
    }
}