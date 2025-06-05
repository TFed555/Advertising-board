<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>
        <?= htmlspecialchars($category['title']) ?>
    </title>
    <style>
        body {
            display: flex;
    flex-direction: column;
    min-height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background: url('/assets/bg_main.png') no-repeat center center fixed;
            background-size: cover;
            color: #000;
        }

        .container {
            flex:1;
            display: flex;
    flex-direction: column;
            min-height: 100%;
            max-width: 1200px;
            margin: 0 auto;
            background-color: rgba(255, 255, 255, 0.95);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background: linear-gradient(180deg, #fff 0%, #999 100%);
        }

        .header {
            display: flex;
            background: url('/assets/header_main.png') no-repeat center;
            background-size: cover;
            padding: 20px;
            color: white;
            font-size: 20px;
            font-weight: bold;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            margin-bottom: 20px;
        }

        .header-text {
            margin-left: 150px;
        }

       .footer {
            background: url('/assets/footer_main.png') no-repeat center;
            background-size: cover;
            padding: 20px;
            text-align: center;
            font-size: 14px;
            color: white;
            box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.15);
            margin-top:auto;
            /* position: relative;
            bottom:0;
            width: -webkit-fill-available; */
        }

        .ad-card {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 10px;
        }

        .search-section {
            text-align: center;
            padding-bottom: 20px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .search-input {
            width: 500px;
            padding: 10px;
            border-radius: 15px;
            border: 2px solid red;
            font-size: 16px;
            box-shadow: 5px 5px 4px 0 rgba(0, 0, 0, 0.25);
        }

        .search-button {
            padding: 10px 20px;
            margin-left: 10px;
            background-color: red;
            color: white;
            border: none;
            border-radius: 15px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 5px 5px 4px 0 rgba(0, 0, 0, 0.25);
            width: 130px;
        }

        .search-button:hover {
            transform: scale(1.05);
        }

        .listings {
            padding: 20px;
        }

        .listing-grid {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            justify-content: center;

        }

        .listing-card {
            flex: 0 0 200px;
            background: white;
            border-radius: 10px;
            padding: 10px;
            box-shadow: 5px 5px 4px 0 rgba(0, 0, 0, 0.25);
            text-align: center;
        }

        .listing-card:hover {
            transform: scale(1.02);
        }

        .listing-card img {
            width: 100%;
            height: 120px;
            object-fit: cover;
            border-radius: 5px;
        }

        .side-menu {
            position: absolute;
            top: -50px;
            right: 0px;
            width: 220px;
            background-color: #fff;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
            transform: translateX(10%);
            z-index: 10;
            padding: 20px 15px;
            border-radius: 10px;
            pointer-events: none;
            opacity: 0;
        }

        .side-menu.open {
            transform: translateX(0%);
            pointer-events: auto;
            opacity: 1;
        }

        .side-menu-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .side-menu-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .side-menu-list li {
            margin-bottom: 12px;
        }

        .side-menu-list a {
            text-decoration: none;
            color: red;
            font-weight: bold;
        }

        .pred-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            text-align: center;
        }

        .overlay {
            flex:1;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.6);
            display: flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
        }

        .side-menu {
            position: absolute;
            top: -50px;
            right: 0px;
            width: 220px;
            background-color: #fff;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
            transform: translateX(10%);
            z-index: 10;
            padding: 20px 15px;
            border-radius: 10px;
            pointer-events: none;
            opacity: 0;
        }

        .side-menu.open {
            transform: translateX(0%);
            pointer-events: auto;
            opacity: 1;
        }

        .side-menu-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .side-menu-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .side-menu-list li {
            margin-bottom: 12px;
        }

        .side-menu-list a {
            text-decoration: none;
            color: red;
            font-weight: bold;
        }

        .logo {
            padding-bottom: 7px;
        }

        .menu-toggle {
            background: white;
            color: red;
            border: none;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            font-size: 18px;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            flex-shrink: 0;
            margin-left: 460px;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 10px;
            gap:30px;
            margin:20px;
        }
        .pag {
            background: #d00;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 10px;
            cursor: pointer;
            width: 20%;
            gap: 10px;
        }
        a {
            text-decoration: none;
            color:white;
        }
    </style>
</head>

<body>
    <div class="overlay">
        <div class="container">
            <div class="header">
                <div class="logo"><a href="/"><img src="/assets/Logo.png" style="width: 80px; height: 30px;"></a></div>
                <div class="header-text">
                    Всё что нужно - ты найдёшь у нас! <br />
                    Тысячи продавцов и тысячи покупателей!
                </div>
                <button id="menuToggle" class="menu-toggle">☰</button>
            </div>
            <div class="search-section">
                <form method="POST" style="display:flex" action="/search">
                    <input class="search-input" type="text" name="findString" placeholder="Поиск.." />
                    <input type="hidden" name="category_id" value="<?= htmlspecialchars($slug) ?>">
                    <input type="submit" class="search-button" value="Найти">
                </form>
                <!-- Ничего не найдено: -->
                <?php if (isset($error)): ?>
                    <p id="error-message" style="color: red;"><?= htmlspecialchars($error) ?></p>
                <?php endif; ?>
                <div id="sideMenu" class="side-menu">
                    <div class="side-menu-header">
                        <img src="/assets/Logo.png" alt="Логотип" width="50" height="20">
                        <span>Resell.ru</span>
                    </div>
                    <ul class="side-menu-list">
                        <li><a href="#">Подать объявление</a></li>
                        <li><a href="/profile">Личный кабинет</a></li>
                        <?php if (isset($_SESSION['user_id'])): ?>
                        <li><a href="/logout">Выйти</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <?php if (!empty($isSearch) && $isSearch): ?>
                    Результаты поиска по запросу: "<?= htmlspecialchars($find) ?>"
            <?php else: ?>
                <div class="pred-title">Категория:
                    <?= htmlspecialchars($category['title']) ?>
                </div>
            <?php endif; ?>

            <div class="sort-controls">
                 <?php if (isset($find)): ?>
                       <h2>Результаты поиска по запросу: <?= htmlspecialchars($find) ?></h2>
                <?php endif; ?>
                <form method="get">
                    <input type="hidden" name="page" value="1">
                    <label for="sort">Сортировать по:</label>
                    <select name="sort" id="sort" onchange="this.form.submit()">
                        <option value="created_at_desc" <?=$sort==='created_at_desc' ? 'selected' : '' ?>>Новые сначала
                        </option>
                        <option value="created_at_asc" <?=$sort==='created_at_asc' ? 'selected' : '' ?>>Старые сначала
                        </option>
                        <option value="price_desc" <?=$sort==='price_desc' ? 'selected' : '' ?>>Дорогие сначала</option>
                        <option value="price_asc" <?=$sort==='price_asc' ? 'selected' : '' ?>>Дешевые сначала</option>
                        <option value="title_asc" <?=$sort==='title_asc' ? 'selected' : '' ?>>По названию (А-Я)</option>
                        <option value="title_desc" <?=$sort==='title_desc' ? 'selected' : '' ?>>По названию (Я-А)
                        </option>
                    </select>
                </form>
            </div>


            <?php if (count($ads) === 0): ?>
            <p>Объявлений пока нет.</p>
            <?php else: ?>
                <div class="listings">
                <div class="listing-grid">
            <?php foreach ($ads as $ad): ?>
                    <div class="listing-card">
                         <?php
                            $imagePath = $ad['img_path_preview'] ?? '/assets/no-image.jpg';
                            $imagePath = ltrim($imagePath, '.');
                            ?>
                        <img src="<?= htmlspecialchars($imagePath) ?>" alt="<?= htmlspecialchars($ad['title'] ?? '') ?>">
                        <h2>
                            <?= htmlspecialchars($ad['title']) ?>
                        </h2>
                        <p>
                            <?= nl2br(htmlspecialchars($ad['description'])) ?>
                        </p>
                        <p><strong>Цена:</strong>
                            <?= htmlspecialchars($ad['price']) ?> ₽
                        </p>
                        <p>
                            <?= htmlspecialchars($ad['created_at']) ?>
                        <p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="pagination">
                <?php if ($page>1): ?>
                <button class="pag"><a href="?page=<?= $page - 1 ?>">Назад</a></button>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a style="display: flex; flex-direction: column; margin-top:1%;margin-bottom:1%;" href="?page=<?= $i ?>" <?=$i===$page ? 'class="active"' : '' ?>>
                    <?= $i ?>
                </a>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                <button class="pag"><a href="?page=<?= $page + 1 ?>">Вперед</a></button>
                <?php endif; ?>
            </div>
            <?php endif; ?>
                <footer class="footer">&copy; 2025. Все права защищены.</footer>
        </div>
    </div>
    <script>
        const sideMenuList = document.querySelector(".side-menu-list");
        const menuItems = ["Подать объявление", "Личный кабинет", "Выйти"];
        let currentOrder = [];

        function updateSideMenu() {
            sideMenuList.innerHTML = '';

            currentOrder.filter(item => item.is_visible)
                .forEach(item => {
                    const li = document.createElement('li');
                    const a = document.createElement('a');
                    a.href = item['url'];
                    a.textContent = item['title'];
                    li.appendChild(a);
                    sideMenuList.appendChild(li);
                });
        }
        document.addEventListener("DOMContentLoaded", async function () {
           const response = await fetch('/api/menu-settings');
            const data = await response.json();
            list_items = JSON.parse(data.menu_config);
            list_items = list_items['items'];
            list_items.forEach(item => {
                switch (item['title']) {
                    case 'Create':
                        item['title'] = menuItems[0];
                        break;
                    case 'Profile':
                        item['title'] = menuItems[1];
                        break;
                    default:
                        item['title'] = menuItems[2];
                        break;
                }
            });

            currentOrder = list_items || [];

            updateSideMenu();
        });

        document.getElementById("menuToggle").addEventListener("click", function () {
            document.getElementById("sideMenu").classList.toggle("open");
        });
    </script>
</body>

</html>