<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Доска объявлений</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: url('/assets/bg_main.png') no-repeat center center fixed;
            background-size: cover;
            color: #000;
        }

        .container {
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

        .header-buttons {
            position: absolute;
            top: 20px;
            right: 180px;
        }

        .header-text {
            margin-left: 150px;
        }

        .header-buttons button {
            margin-left: 10px;
            padding: 8px 16px;
            border-radius: 15px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            background-color: white;
            color: red;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s;
        }

        .header-buttons button:hover {
            transform: scale(1.05);
        }

        .search-input {
            width: 60%;
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

        .category-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            padding: 20px;
            padding-left: 100px;
            padding-right: 100px;
        }

        .category-card {
            box-shadow: 5px 5px 4px 0 rgba(0, 0, 0, 0.25);
            background: linear-gradient(45deg, #e92525 0%, #920f0f 73.56%);
            border-radius: 20px;
            color: white;
            text-align: justify;
            position: relative;
            overflow: hidden;
            cursor: pointer;
            width: 270px;
            height: 170px;
            display: flex;
        }

        .category-card:hover {
            transform: scale(1.05);
        }

        .category-text {
            width: 50%;
            height: 100%;
            align-items: center;
            margin-top: 20%;
            margin-left: 20px;
            font-size: large;
        }

        .category-png {
            width: 50%;
            height: 100%;
        }

        .category-card img {
            position: absolute;
            bottom: 0px;
            right: 0px;
            width: 150px;
            height: 150px;
            object-fit: cover;
            pointer-events: none;
        }

        .listings {
            padding: 20px;
        }

        .pred-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            text-align: center;
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

        .footer {
            background: url('/assets/footer_main.png') no-repeat center;
            background-size: cover;
            padding: 20px;
            text-align: center;
            font-size: 14px;
            color: white;
            box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.15);
        }

        .category-card p {
            font-size: 20px;
            font-size: 20px;
            margin-bottom: -10px;
            margin-top: 0px;
            margin-left: -20px;
            height: 80px;
            width: 50px;
        }

        .overlay {
            inset: 0;
            background-color: rgba(0, 0, 0, 0.6);
            display: flex;
            justify-content: center;
            align-items: center;
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

        .side-menu {
            position: absolute;
            top: 60px;
            right: 160px;
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
    </style>
</head>

<body>

    <input type="checkbox" id="nav-toggle" hidden>

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

            <div class="pred-title">Все категории</div>
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
            <div class="category-grid">
                <div class="category-card" data-category="1">
                    <div class="category-text">
                        Автомобили<br>и<br>запчасти
                    </div>
                    <div class="category-png"><img src="/assets/car.png" alt="Машины" width="90" height="90" /></div>
                </div>
                <div class="category-card" data-category="2">
                    <div class="category-text">
                        Квартиры<br> и <br>дачи
                    </div>
                    <div class="category-png"><img src="/assets/kottedzh.png" alt="Квартиры" /></div>
                </div>
                <div class="category-card" data-category="3">
                    <div class="category-text">
                        Одежда<br> и <br>обувь
                    </div>
                    <div class="category-png"><img src="/assets/odezhda.png" alt="Одежда" /></div>
                </div>
                <div class="category-card" data-category="4">
                    <div class="category-text" style="margin-left: 20%;">
                        Всё<br> для<br> дома
                    </div>
                    <div class="category-png">
                        <img src="/assets/divan.png" alt="Дом" />
                    </div>
                </div>
                <div class="category-card" data-category="5">
                    <div class="category-text">
                        Красота<br> и<br> здоровье
                    </div>
                    <div class="category-png">
                        <img src="/assets/beauty.png" alt="Красота" />
                    </div>
                </div>
                <div class="category-card" data-category="6">
                    <div class="category-text" style="margin-left: 15px;">
                        Электроника<br> и<br> техника
                    </div>
                    <div class="category-png"><img src="/assets/compik.png" alt="Техника" /></div>
                </div>
            </div>

            <?php if (count($ads) === 0): ?>
            <p>Объявлений пока нет.</p>
            <?php else: ?>
                <div class="listings">
                <div class="pred-title">Свежие объявления</div>
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
            <?php endif; ?>

            <div class="footer">
                &copy; 2025. Все права защищены.
            </div>
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
            const cards = document.querySelectorAll(".category-card");

            cards.forEach(card => {
                card.addEventListener("click", async function () {
                    const category = this.getAttribute("data-category");

                    try {
                        const response = await fetch("/api/category", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "Accept": "application/json"
                            },
                            body: JSON.stringify({ category })
                        });

                        const contentType = response.headers.get('content-type');
                        if (!contentType || !contentType.includes('application/json')) {
                            const text = await response.text();
                            console.error('Ожидался JSON, но получено:', text);
                            throw new Error('Сервер вернул не JSON');
                        }

                        const data = await response.json();

                        if (!response.ok) {
                            throw new Error(data.error || 'Ошибка сервера');
                        }

                        if (data.redirect_url) {
                            window.location.href = data.redirect_url;
                        }

                    } catch (error) {
                        console.error('Ошибка:', error);
                        // alert('Произошла ошибка при переходе в категорию');
                    }
                });
            });
        });

        document.getElementById("menuToggle").addEventListener("click", function () {
            document.getElementById("sideMenu").classList.toggle("open");
        });


    </script>

</body>

</html>