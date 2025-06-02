<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сброс пароля</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .password-reset-container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .password-reset-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="password"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .error-message {
            color: red;
            font-size: 0.8em;
            margin-top: 5px;
            display: none;
        }
        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        button[type="submit"]:hover {
            background-color: #45a049;
        }
        .login-link {
            text-align: center;
            margin-top: 15px;
        }
        #error-message {
            color: red;
            margin: 10px 0;
            padding: 10px;
            background-color: #ffeeee;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="password-reset-container">
        <div class="password-reset-header">
            <h1>Сброс пароля</h1>
            <p>Введите новый пароль для вашего аккаунта</p>
        </div>

        <form id="passwordResetForm" method="POST" action="/reset?token=<?= htmlspecialchars($_GET['token'] ?? '') ?>">
            <div class="form-group">
                <label for="new_password">Новый пароль</label>
                <input type="password" id="new_password" name="new_password" required minlength="4">
                <div class="error-message" id="passwordError">Пароль должен содержать минимум 4 символа</div>
            </div>

            <div class="form-group">
                <label for="confirm_password">Подтвердите пароль</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
                <div class="error-message" id="confirmError">Пароли не совпадают</div>
            </div>

            <?php if (isset($error)): ?>
                <p id="error-message"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <button type="submit">Сохранить новый пароль</button>
        </form>

        <div class="login-link">
            Вспомнили пароль? <a href="/login">Войдите в аккаунт</a>
        </div>
    </div>

    <script>

        const newPassword = document.getElementById('new_password');
        const confirmPassword = document.getElementById('confirm_password');
        const passwordError = document.getElementById('passwordError');
        const confirmError = document.getElementById('confirmError');


        confirmPassword.addEventListener('input', function() {
            if (this.value === newPassword.value) {
                confirmError.style.display = 'none';
            }
        });


        document.getElementById('passwordResetForm').addEventListener('submit', function(e) {
            let isValid = true;

            if (newPassword.value.length < 4) {
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