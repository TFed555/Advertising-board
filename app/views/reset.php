<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сброс пароля</title>
</head>
<body>
    <div class="password-reset-container">
        <div class="password-reset-header">
            <h1>Сброс пароля</h1>
            <p>Введите новый пароль для вашего аккаунта</p>
        </div>

        <form id="passwordResetForm" method="POST" action="/reset-password">
            <!-- Скрытое поле для токена сброса -->
            <input type="hidden" name="token" value="<?= htmlspecialchars($_GET['token'] ?? '') ?>">

            <div class="form-group">
                <label for="new_password">Новый пароль</label>
                <input type="password" id="new_password" name="new_password" required minlength="8">
                <div class="password-strength">
                    <div class="password-strength-bar" id="passwordStrengthBar"></div>
                </div>
                <div class="error-message" id="passwordError">Пароль должен содержать минимум 8 символов</div>
            </div>

            <div class="form-group">
                <label for="confirm_password">Подтвердите пароль</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
                <div class="error-message" id="confirmError">Пароли не совпадают</div>
            </div>

            <button type="submit">Сохранить новый пароль</button>
        </form>

        <div class="login-link">
            Вспомнили пароль? <a href="/login">Войдите в аккаунт</a>
        </div>
    </div>

    <script>
        // Валидация пароля в реальном времени
        const newPassword = document.getElementById('new_password');
        const confirmPassword = document.getElementById('confirm_password');
        const passwordError = document.getElementById('passwordError');
        const confirmError = document.getElementById('confirmError');
        const strengthBar = document.getElementById('passwordStrengthBar');

        newPassword.addEventListener('input', function() {
            // Проверка сложности пароля
            const password = this.value;
            let strength = 0;

            if (password.length >= 8) strength += 1;
            if (password.match(/[a-z]/)) strength += 1;
            if (password.match(/[A-Z]/)) strength += 1;
            if (password.match(/[0-9]/)) strength += 1;
            if (password.match(/[^a-zA-Z0-9]/)) strength += 1;

            // Обновление индикатора сложности
            const width = (strength / 5) * 100;
            strengthBar.style.width = width + '%';

            if (strength < 3) {
                strengthBar.style.backgroundColor = '#e74c3c';
            } else if (strength < 5) {
                strengthBar.style.backgroundColor = '#f39c12';
            } else {
                strengthBar.style.backgroundColor = '#2ecc71';
            }

            // Скрытие ошибки если пароль валиден
            if (password.length >= 8) {
                passwordError.style.display = 'none';
            }
        });

        confirmPassword.addEventListener('input', function() {
            // Проверка совпадения паролей
            if (this.value === newPassword.value) {
                confirmError.style.display = 'none';
            }
        });

        // Валидация при отправке формы
        document.getElementById('passwordResetForm').addEventListener('submit', function(e) {
            let isValid = true;

            if (newPassword.value.length < 8) {
                passwordError.style.display = 'block';
                isValid = false;
            }

            if (newPassword.value !== confirmPassword.value) {
                confirmError.style.display = 'block';
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>