<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($category['title']) ?></title>
    <style>
        body { font-family: sans-serif; }
        .ad-card {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>Категория: <?= htmlspecialchars($category['title']) ?></h1>

    <?php if (count($ads) === 0): ?>
        <p>Объявлений пока нет.</p>
    <?php else: ?>
        <?php foreach ($ads as $ad): ?>
            <div class="ad-card">
                <h2><?= htmlspecialchars($ad['title']) ?></h2>
                <p><?= nl2br(htmlspecialchars($ad['description'])) ?></p>
                <p><strong>Цена:</strong> <?= htmlspecialchars($ad['price']) ?> ₽</p>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
