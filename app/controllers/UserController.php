<?php
// require __DIR__.'/../models/User.php';

class UserController {
    public static function show() {
        try {
            $userData = $_SESSION['user'];
            if (!$userData) {
                throw new Exception('Пользователь не найден');
            }
        }
        catch (Exception $e) {
            $error = 'Не удалось загрузить данные профиля';
        }

        require __DIR__.'/../views/profile.php';
    }

    public static function updateProfile() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                $name = $_POST['name'] ?? '';
                $email = $_POST['email'] ?? '';
                $phone = $_POST['phone'] ?? '';
                if(empty($name) || empty($email) || empty($phone)) {
                    throw new Exception('Обязательно для заполнения');
                }
                $user = User::updateProfile($name, $email, $phone, $_SESSION['user_id']);
                $_SESSION['user'] = [
                        'id' => $user['id'],
                        'name' => $user['name'],
                        'email' => $user['email'],
                        'phone' => $user['phone']
                    ];
                header('Location: /profile');
                exit;
            }
            catch (Exception $e) {
                error_log('Ошибка обновления профиля: ' . $e->getMessage());
                $error = $e->getMessage();
                $this->show();
            }
        }
        // require __DIR__.'/../views/profile.php';
    }
}