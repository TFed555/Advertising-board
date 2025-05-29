<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Авторизация</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html,
    body {
      height: 100%;
      font-family: Arial, sans-serif;
    }

    body {
      background: url('/assets/bgs.png') center/cover no-repeat;
      position: relative;
    }

    .overlay-text {
      position: absolute;
      left: 180px;
      top: 50%;
      transform: translateY(-60%);
      color: white;
      font-size: 3.5rem;
      font-weight: bold;
      line-height: 1.4;
      text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.6);
    }

    .form-container {
      position: absolute;
      right: 40px;
      top: 70px;
      width: 400px;
      background-color: white;
      border-radius: 20px;
      padding: 20px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
      overflow: hidden;
    }

    .site-name {
      color: red;
      font-weight: bold;
      text-align: center;
      margin-bottom: 40px;
    }

    h2 {
      text-align: center;
      margin-bottom: 10px;
    }

    p {
      text-align: center;
      margin-bottom: 30px;
      color: #333;
    }

    input {
      width: 100%;
      padding: 12px;
      margin-bottom: 25px;
      background-color: #fbdada;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
    }

    button {
      margin-left: 55px;
      width: 65%;
      padding: 12px;
      background-color: #d10000;
      color: white;
      border: none;
      border-radius: 12px;
      font-size: 1rem;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    button:hover {
      background-color: #b80000;
    }

    .register {
      text-align: center;
      margin-top: 15px;
      font-size: 0.9rem;
    }

    .register a {
      color: black;
      text-decoration: underline;
    }

    .overlay {
      position: absolute;
      inset: 0;
      background-color: rgba(0, 0, 0, 0.6);
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .form-wrapper {
      display: flex;
      transition: transform 0.5s ease;
    }

    .form-box {
      width: 100%;
      padding: 20px;
      flex-shrink: 0;
    }

  </style>
</head>

<body>
  <div class="overlay">
    <div class="overlay-text">
      Войдите,<br>чтобы <br>увидеть<br>тысячи <br>объявлений
    </div>

    <div class="form-container">
      <div class="form-wrapper" id="form-wrapper">

        <div class="form-box login-form">
          <div class="site-name">SITE_NAME.COM</div>
          <h2>Добро пожаловать!</h2>
          <p>Войдите или зарегистрируйтесь<br>чтобы продолжить!</p>
          <?php if (isset($error)): ?>
             <p id="error-message" style="color: red;"><?= htmlspecialchars($error) ?></p>
               <!-- <script>
                  setTimeout(() => {
                    document.getElementById('error-message').style.display = 'none';
                  }, 5000);
              </script> -->
          <?php endif; ?>
          <form action="/login" method="POST">
            <input type="email" name="email" placeholder="Введите email.." required>
            <input type="password" name="password" placeholder="Введите пароль.." required>
            <!-- вот тут выровнять -->
            <div class="form-group">
              <input type="checkbox" name="remember_me" id="remember_me">
              <label for="remember_me">Запомнить меня</label>
            </div>

            <button type="submit">ВОЙТИ</button>
          </form>
          <div class="register">
            <b><a href="#">Забыли пароль?</a></b>
            <br>Нет аккаунта? <b><a href="#" id="show-register">Зарегистрироваться</a></b>
          </div>
        </div>

        <div class="form-box register-form">
        <div class="site-name">SITE_NAME.COM</div>
        <h2>Создайте аккаунт</h2>
        <p>Заполните форму, чтобы зарегистрироваться</p>
        <form action="/register" method="POST">
          <input type="username" name="username" placeholder="Имя пользователя.." />
          <input type="email" name="email" placeholder="Введите email.." required>
          <input type="password" name="password" placeholder="Введите пароль.." required>
          <input type="phone"  name = "phone" placeholder="Номер телефона.." />
          <button type="submit">Зарегистрироваться</button>
        </form>
        <div class="register">
          Уже есть аккаунт? <b><a  href="#" id="show-login">Войти</a></b>
        </div>
      </div>
      </div>
    </div>
  </div>


</body>

<script>
    const formWrapper = document.getElementById('form-wrapper');
    const showRegister = document.getElementById('show-register');
    const showLogin = document.getElementById('show-login');
    showRegister.onclick = () => {
      formWrapper.style.transform = 'translateX(-100%)';
    };

    showLogin.onclick = () => {
      formWrapper.style.transform = 'translateX(0)';
    };
  </script>
</html>