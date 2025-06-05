<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Личный кабинет</title>
  <style>
    /* ОБЩИЙ СТИЛЬ */

    body {
      margin: 0;
      font-family: Arial, sans-serif;
      /* background: url('../../public/assets/bg_main.png') no-repeat center center fixed; */
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
      /* background: url('../../public/assets/header_main.png') no-repeat center; */
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

    .pred-title {
      font-size: 20px;
      font-weight: bold;
      margin-bottom: 10px;
      text-align: center;
    }


    /*  БЛОК ДАННЫХ ПОЛЬЗОВАТЕЛЯ */

    .user-info {
      display: flex;
      align-items: center;
      /* margin-bottom: 40px;
      margin-left: 30px;
      margin-right: 30px; */
      margin: 20px 30px 40px 30px;
    }

    .user-photo {
      width: 180px;
      height: 180px;
      border-radius: 20px;
      overflow: hidden;
      margin-right: 30px;
      background: #b12c2c;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
    }

    .user-photo img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .user-fields {
      flex: 1;
    }

    .user-field {
      display: flex;
      align-items: center;
      margin-bottom: 20px;
    }

    .user-field label {
      width: 140px;
    }

    .user-field input {
      flex: 1;
      padding: 10px 15px;
      border: none;
      background: #ffc6cc;
      border-radius: 12px;
      font-size: 16px;
      margin-right: 15px;
    }

    .edit-btn {
      background: red;
      color: white;
      border: none;
      padding: 8px 16px;
      border-radius: 12px;
      cursor: pointer;
      font-weight: bold;
      transition: background 0.3s;
    }

    .edit-btn:hover {
      background: #d16969;
    }

    /*  ЧЕКБОКСЫ И ПОРЯДОК */

    .menu-settings {
      display: flex;
      justify-content: space-between;
      margin-top: 20px;
      gap: 40px;
      margin-left: 30px;
      margin-right: 30px;
    }

    .menu-view,
    .menu-order {
      flex: 1;
    }

    .menu-view h3,
    .menu-order h3 {
      text-align: center;
      margin-bottom: 15px;
    }

    .checkbox-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin: 10px 0;
    }

    .checkbox-row label {
      font-size: 16px;
    }

    .checkbox-row input[type="checkbox"] {
      transform: scale(1.4);
    }

    .order-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin: 10px 0;
    }

    .order-name {
      flex: 1;
    }

    .order-buttons button {
      background: red;
      color: white;
      border: none;
      padding: 5px 10px;
      margin: 0 2px;
      border-radius: 10px;
      cursor: pointer;
      transition: background 0.3s;
    }

    .order-buttons button:hover {
      background: #d16969;
    }

    /*  КНОПКА СОХРАНИТЬ */

    .save-btn,
    .add-btn {
      display: block;
      margin: 30px auto 10px;
      padding: 12px 30px;
      font-size: 18px;
      border: none;
      border-radius: 16px;
      background: red;
      color: white;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s;
    }

    .save-btn:disabled {
      background: #aaa;
      cursor: not-allowed;
    }

    .save-btn:hover:not(:disabled) {
      background: #d16969;
    }

    .message {
      text-align: center;
      color: green;
      font-weight: bold;
      display: none;
      margin-top: 10px;
    }

    .footer {
      /* background: url('../../public/assets/footer_main.png') no-repeat center; */
      background: url('/assets/footer_main.png') no-repeat center;
      background-size: cover;
      padding: 20px;
      text-align: center;
      font-size: 14px;
      color: white;
      box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.15);
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
      background: red;
      color: white;
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
      right: 160px;
      top: 60px;
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
      height: 150px;
      object-fit: cover;
      border-radius: 5px;
    }
  </style>
</head>

<body>
  <div class="overlay">
    <div class="container">
      <div class="header">
        <!-- <div class="logo"><img src="../../public/assets/Logo.png" style="width: 80px; height: 30px;"></div> -->
        <div class="logo"><img src="/assets/Logo.png" style="width: 80px; height: 30px;"></div>
        <div class="header-text">
          Всё что нужно - ты найдёшь у нас! <br />
          Тысячи продавцов и тысячи покупателей!
        </div>
        <button id="menuToggle" class="menu-toggle">☰</button>
        <!-- <div class="header-buttons">
                    <button>Подать объявление</button>
                    <button>Личный кабинет</button>
                    <?php if (isset($_SESSION['user_id'])): ?>
                    <button class="logout-btn"><a href="/logout"
                            style="color:red;text-decoration: none;">Выйти</a></button>
                    <?php endif; ?>
                </div> -->
      </div>
      <div class="pred-title">Личный кабинет</div>
      <div class="user-info">
        <div class="user-photo">
          <img src="/assets/compik.png" alt="User Photo" />
        </div>
      <form method="POST" action="/profile">
        <div class="user-fields">
          <div class="user-field">
            <label>Email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($userData['email'] ?? '') ?>" />
          </div>
          <div class="user-field">
            <label>Имя</label>
            <input type="text" name="name" value="<?= htmlspecialchars($userData['name'] ?? '') ?>" />
          </div>
          <div class="user-field">
            <label>Номер телефона</label>
            <input type="text" name="phone" value="<?= htmlspecialchars($userData['phone'] ?? '') ?>" />
          </div>
        </div>
        <button type="submit">Сохранить изменения</button>
        </form>
        <!-- Боковое меню -->
        <div id="sideMenu" class="side-menu">
          <div class="side-menu-header">
            <img src="/assets/Logo.png" alt="Логотип" width="50" height="20">
            <span>Resell.ru</span>
          </div>
          <ul class="side-menu-list">
            <li><a href="/">Главная</a></li>
            <li><a href="/createAdv">Подать объявление</a></li>
            <li><a href="/profile">Личный кабинет</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
            <li><a href="/logout">Выйти</a></li>
            <?php endif; ?>
          </ul>
        </div>
      </div>

      <div class="menu-settings">
        <div class="menu-view">
          <div class="pred-title">Вид меню</div>
          <!-- <div class="checkbox-row">
            <label>Главная</label>
            <input type="checkbox" data-name="Главная" />
          </div> -->
          <div class="checkbox-row">
            <label>Подать объявление</label>
            <input type="checkbox" data-name="Подать объявление" />
          </div>
          <div class="checkbox-row">
            <label>Выйти</label>
            <input type="checkbox" data-name="Выйти" />
          </div>
        </div>
        <div class="menu-order">
          <div class="pred-title">Порядок в меню</div>
          <div id="order-list">
            <!-- Элементы будут сгенерированы JS -->
          </div>
        </div>
      </div>

      <button class="save-btn" id="saveBtn" disabled>Сохранить</button>
      <div class="message" id="message">Настройки сохранены</div>
      <button class="add-btn" id="addBtn" disabled><a href="/createAdv">Добавить объявление</a></button>
      <div class="listings">
    <div class="pred-title" style="margin-bottom: 20px;">Ваши объявления</div>
    <form method="get">
        <div class="listing-grid">
            <?php if (!empty($userAds)): ?>
                <?php foreach ($userAds as $ad): ?>
                    <div class="listing-card">
                        <img src="<?= htmlspecialchars($ad['img_path_preview'] ?? '/assets/no-image.jpg') ?>" alt="<?= htmlspecialchars($ad['title']) ?>">
                        <h3><?= htmlspecialchars($ad['title']) ?></h3>
                        <p><?= htmlspecialchars($ad['price']) ?> ₽</p>
                        <p><?= date('d.m.Y', strtotime($ad['created_at'])) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>У вас пока нет объявлений</p>
            <?php endif; ?>
        </div>
    </form>
    </div>

      <div class="footer">
        &copy; 2025. Все права защищены.
      </div>
    </div>
  </div>
  <script>
    const orderList = document.getElementById("order-list");
    const checkboxes = document.querySelectorAll(".menu-view input[type='checkbox']");
    const saveBtn = document.getElementById("saveBtn");
    const message = document.getElementById("message");
    const sideMenuList = document.querySelector(".side-menu-list");
    const menuItems = ["Подать объявление", "Личный кабинет", "Выйти"];
    let currentOrder = [];
    let visibleItems = [];

    async function loadMenuSettings() {
      try {
        const response = await fetch('/api/menu-settings');
        const data = await response.json();
        console.log(data['menu_config']);
        // console.log(data['menu_config']);
        // console.log(typeof(JSON.parse(data.menu_config)));
        // console.log(JSON.parse(data.menu_config)[0]);
        if (!data.menu_config) {
            throw new Error('Missing menu_config in response');
        }

        // let list_items = JSON.parse(data.menu_config);
        try {
            list_items = JSON.parse(data.menu_config);
            list_items = list_items['items'];
        } catch (e) {
            throw new Error('Invalid JSON in menu_config');
        }
        // console.log('List_items', list_items);
        // console.log(typeof(list_items));

        // console.log('Parsed items:', list_items);
        list_items.forEach(item => {
          switch(item['title']){
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
        visibleItems = currentOrder.filter(item => item.is_visible).map(item => item.title);
      console.log('visible', visibleItems);
      console.log('current', currentOrder);

      checkboxes.forEach(cb => {
        cb.checked = visibleItems.includes(cb.dataset.name);
        cb.addEventListener("change", () => {
          if (cb.checked) {
            visibleItems.push(cb.dataset.name);
          } else {
            visibleItems = visibleItems.filter(item => item !== cb.dataset.name);
          }
          setChanged(true);
        });
      });

        renderOrderList();
        updateSideMenu();

      } catch (error) {
        console.error('Ошибка загрузки настроек:', error);
     }
    }

    function renderOrderList() {
      orderList.innerHTML = "";
      currentOrder.forEach((item, index) => {
        const row = document.createElement("div");
        row.className = "order-row";
        row.innerHTML = `
          <div class="order-name">${item['title']}</div>
          <div class="order-buttons">
            <button onclick="moveItem(${index}, -1)">Вверх</button>
            <button onclick="moveItem(${index}, 1)">Вниз</button>
          </div>`;
        orderList.appendChild(row);
      });
    }

    function moveItem(index, direction) {
      const newIndex = index + direction;
      if (newIndex < 0 || newIndex >= currentOrder.length) return;
      [currentOrder[index], currentOrder[newIndex]] = [currentOrder[newIndex], currentOrder[index]];
      renderOrderList();
      setChanged(true);
    }

    let hasChanges = false;

    function setChanged(state) {
      hasChanges = state;
      saveBtn.disabled = !state;
    }



  function updateSideMenu() {
    sideMenuList.innerHTML = '';

    currentOrder.filter(item=>item.is_visible)
        .forEach(item => {
        const li = document.createElement('li');
        const a = document.createElement('a');
        a.href = item['url'];
        a.textContent = item['title'];
        li.appendChild(a);
        sideMenuList.appendChild(li);
    });
}

  saveBtn.addEventListener("click", async () => {
      const visible = [];
      checkboxes.forEach(cb => {
        if (cb.checked) visible.push(cb.dataset.name);
      });

      console.log('Visible',visible);
      // currentOrder = currentOrder.filter(item=>visibleItems.includes(item.title));
      currentOrder = currentOrder.map(item => ({
        ...item,
        is_visible: item.title === 'Личный кабинет' || visible.includes(item.title)
     }));
      console.log('CurrentOrder',currentOrder);
      const payload = {
            items: currentOrder.map(item => ({
                id: item.id,
                url: item.url,
                title: item.title,
                is_visible: item.is_visible
            }))
        };
      console.log('Отправляемые данные', JSON.stringify(payload));

      try {
        const response = await fetch('/api/save-menu-settings', {
          method: "POST",
          headers: {'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'},
          body: JSON.stringify(payload)
        });
        if (!response.ok) {
            const errorData = await response.json().catch(() => null);
            throw new Error(errorData?.error || `HTTP error! Status: ${response.status}`);
        }
        const data = await response.json();
                    console.log(data);
        if (data.success) {
          updateSideMenu();
          showMessage();
          setChanged(false);
        }
        else {
          alert('Ошибка настройки');
        }
      } catch(error){
           console.log('client',error);
        alert('Ошибка настройки');
      }
    });

    function showMessage() {
      message.style.display = "block";
      setTimeout(() => {
        message.style.display = "none";
      }, 2000);
    }

    window.onload = function () {
      loadMenuSettings();
    };

    document.getElementById("menuToggle").addEventListener("click", function () {
      document.getElementById("sideMenu").classList.toggle("open");
    });
  </script>
</body>

</html>