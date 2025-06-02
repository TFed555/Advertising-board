<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class RepairController {
    public function repair() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $email = $_POST['email'];
                $user = User::findByEmail($email);
                if ($user) {
                    $token = bin2hex(random_bytes(50));
                    User::updateResetToken($token, $user['id']);
                    $mail = new PHPMailer(true);

                    try {
                        $mail->isSMTP();

                        $mail->Host = 'smtp.gmail.com';
                        $mail->SMTPAuth = true;

                        $mail->Username = 'thedgeofwave@gmail.com';

                        $mail->Password = $_ENV['MAIL_PASS'];

                        $mail->SMTPSecure = 'ssl';

                        $mail->Port = 465;

                        $mail->setFrom('thedgeofwave@gmail.com', 'Resell');

                        $mail->addAddress($email);

                        $mail->isHTML(true);

                        $mail->Subject = 'Восстановление пароля';

                        $mail->Body = "Нажмите на ссылку для сброса пароля: <a href='http://localhost/reset?token=$token'>Сбросить пароль</a>";

                        $mail->send();

                        echo "Инструкции по восстановлению пароля отправлены на вашу почту!";
                    }
                    catch(Exception $e) {
                        echo "Ошибка отправки письма: {$mail->ErrorInfo}";
                    }
                }
                else {
                    echo "Пользователь с таким email не найден!";
                }
        }
}

    public function reset() {
        ob_start();
        $address = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $query_str = parse_url($address, PHP_URL_QUERY);
        parse_str($query_str, $query_params);
        $token = $query_params['token'];
        $expiredTime = User::getExpiredTime($token);
        $currentTime = date("y-m-d h:i:s");
        // echo $token;
        // echo $expiredTime['expires_at'];
        // echo "\n";
        // echo $currentTime;
        // echo "\n";
        $expiredTime = DateTime::createFromFormat('Y-m-d H:i:s', $expiredTime['expires_at'])->format('Y-m-d H:i:s');
        $currentTime = DateTime::createFromFormat('y-m-d H:i:s', $currentTime)->format('Y-m-d H:i:s');
        // echo $expiredTime;
        // echo "\n";
        // echo $currentTime;

        if ($expiredTime > $currentTime) {
            User::deleteResetToken($token);
            die('Время ссылки истекло');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $newPassword = $_POST['new_password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';
            $oldPassword = User::changePassword($token, $newPassword);

            if ($newPassword !== $confirmPassword) {
                $error = 'Пароли не совпадают';
                require __DIR__.'/../views/reset.php';
                return;
            }

            $success = User::changePassword($token, $newPassword);

            if ($success) {
                User::deleteResetToken($token);
                ob_clean();
                header('Location: /login');
                exit;
            }
            else {
                $error = 'Пароль не должен совпадать с предыдущим';
            }
    }

        require __DIR__.'/../views/reset.php';
    }

}