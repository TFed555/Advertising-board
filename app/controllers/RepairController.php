<?php
// require __DIR__.'/../models/User.php';
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


        require __DIR__.'/../views/reset.php';
    }

}