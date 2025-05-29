<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>
</head>
<body>
    <h1><?= htmlspecialchars($welcomeMessage) ?></h1>

    <section>
        <h2>Наши преимущества:</h2>
        <ul>
            <?php foreach ($features as $feature): ?>
                <li><?= htmlspecialchars($feature) ?></li>
            <?php endforeach; ?>
        </ul>
    </section>
    <a href= '/#'>Войти в личный кабинет</a>

    <?php if (isset($_SESSION['user_id'])): ?>
    <div class="logout-section">
        <a href="/logout" class="logout-btn">Выйти</a>
     </div>
    <?php endif; ?>

    <footer>
        <p>© <?= date('Y') ?> Все права защищены</p>
    </footer>
</body>
</html>