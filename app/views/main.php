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
    <a href= '/login'>Войти в личный кабинет</a>
    <footer>
        <p>© <?= date('Y') ?> Все права защищены</p>
    </footer>
</body>
</html>