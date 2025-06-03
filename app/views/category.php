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
<div class="sort-controls">
        <form method="get">
            <input type="hidden" name="page" value="1">
            <label for="sort">Сортировать по:</label>
            <select name="sort" id="sort" onchange="this.form.submit()">
                <option value="created_at_desc" <?= $sort === 'created_at_desc' ? 'selected' : '' ?>>Новые сначала</option>
                <option value="created_at_asc" <?= $sort === 'created_at_asc' ? 'selected' : '' ?>>Старые сначала</option>
                <option value="price_desc" <?= $sort === 'price_desc' ? 'selected' : '' ?>>Дорогие сначала</option>
                <option value="price_asc" <?= $sort === 'price_asc' ? 'selected' : '' ?>>Дешевые сначала</option>
                <option value="title_asc" <?= $sort === 'title_asc' ? 'selected' : '' ?>>По названию (А-Я)</option>
                <option value="title_desc" <?= $sort === 'title_desc' ? 'selected' : '' ?>>По названию (Я-А)</option>
            </select>
        </form>
    </div>

    <?php if (count($ads) === 0): ?>
        <p>Объявлений пока нет.</p>
    <?php else: ?>
        <?php foreach ($ads as $ad): ?>
            <div class="ad-card">
                <h2><?= htmlspecialchars($ad['title']) ?></h2>
                <p><?= nl2br(htmlspecialchars($ad['description'])) ?></p>
                <p><strong>Цена:</strong> <?= htmlspecialchars($ad['price']) ?> ₽</p>
                <p> <?= htmlspecialchars($ad['created_at']) ?><p>
            </div>
        <?php endforeach; ?>

        <div class="pagination">
            <?php if ($page>1): ?>
                <a href="?page=<?= $page - 1 ?>">Назад</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?= $i ?>" <?= $i === $page ? 'class="active"' : '' ?>>
                    <?= $i ?>
                </a>
            <?php endfor; ?>

            <?php if ($page < $totalPages): ?>
                <a href="?page=<?= $page + 1 ?>">Вперед</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</body>
</html>
