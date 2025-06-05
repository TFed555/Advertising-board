<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8" />
  <title>Добавление объявления</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: url('/assets/bg_main.png') no-repeat center center fixed;
      background-size: cover;
      color: #000;
    }

    .container {
      position: absolute;
      top: 0;
      bottom: 0;
      max-width: 1200px;
      width: 1126px;
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
      margin-left: 100px;
    }

    h1 {
      text-align: center;
      margin-bottom: 30px;
    }

    .photo-upload {
      background: #a00;
      width: 280px;
      height: 280px;
      border-radius: 20px;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
    }

    .photo-upload img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .photo-controls {
      display: flex;
      justify-content: space-between;
      margin-top: 10px;
    }

    .photo-controls button {
      background: #d00;
      color: white;
      border: none;
      border-radius: 10px;
      padding: 6px 10px;
      cursor: pointer;
      width: 60%;
      gap: 10px;
    }


    .form-group {
      margin-bottom: 15px;
    }

    input[type="text"],
    textarea,
    select {
      width: 100%;
      padding: 10px;
      border: none;
      background: #ee9999;
      border-radius: 10px;
      font-size: 16px;
    }

    textarea {
      resize: none;
      height: 100px;
    }


    .btn {
      background: #c00;
      color: white;
      border: none;
      padding: 10px 20px;
      margin: 10px auto;
      border-radius: 10px;
      cursor: pointer;
      font-weight: bold;
    }

    .btn:disabled {
      background: gray;
      cursor: not-allowed;
    }


    .form-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      align-items: center;
      margin-left: 40px;
      margin-right: 60px;
    }

    .form-fields {
      flex-grow: 1;
      margin-left: 30px;
    }

    .submit-controls {
      text-align: center;
    }


    .notification {
      text-align: center;
      background: green;
      color: white;
      padding: 10px;
      margin: 10px 0;
      border-radius: 10px;
      display: none;
    }

    .footer {
      background: url('/assets/footer_main.png') no-repeat center;
      background-size: cover;
      padding: 20px;
      text-align: center;
      font-size: 14px;
      color: white;
      box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.15);
      position: absolute;
      bottom: 0;
      width: -webkit-fill-available;
    }

    .overlay {
      inset: 0;
      background-color: rgba(0, 0, 0, 0.6);
      display: flex;
      width: 100vw;
      height: 100vh;
      justify-content: center;
      align-items: center;
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
      margin-left: 440px;
    }

    .side-menu {
      position: absolute;
      right: 0px;
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

    .feedback__text {
      margin-bottom: 7px;
      font-family: Montserrat;
      font-size: 16px;
      font-weight: 600;
      color: #282828;
    }

    .feedback__label {
      display: flex;
      justify-content: center;
      align-items: center;
      width: 132px;
      height: 32px;
      border-radius: 5px;
      font-size: 12px;
      text-align: center;
      background-color: #c00;
      color: white;
      cursor: pointer;
      margin-top: 10px;
      margin-left: 25%;
    }

    .feedback__file {
      display: none;
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
      <h1>Добавление объявления</h1>

      <form class="form-container" action="/create" method="POST" enctype="multipart/form-data">
        <!-- Фото -->
        <div>
          <div class="photo-upload" id="photoPreview">Фотография</div>
          <label class="feedback__label">
            Загрузить файл
            <input type="file" name='photos[]' id="photoInput" class="feedback__file" multiple
              style="margin-top:10px" />
          </label>
          <div class="photo-controls">
            <button style="margin-right:20px;" onclick="prevPhoto()">←</button>
            <button onclick="nextPhoto()">→</button>
          </div>
        </div>

        <!-- Поля -->
        <div class="form-fields">
          <div class="form-group">
            <label>Название</label>
            <input type="text" name="title" id="title" required />
          </div>
          <div class="form-group">
            <label>Описание</label>
            <textarea name="description" id="description" required></textarea>
          </div>
          <div class="form-group">
            <label>Цена</label>
            <input type="text" name="price" id="price" pattern="[0-9]*" required />
          </div>
          <div class="form-group">
            <label>Категория</label>
            <select name="category" id="category">
              <option value="">Выберите категорию</option>
              <option value="1">Автомобили и запчасти</option>
              <option value="2">Квартиры и дачи</option>
              <option value="3">Одежда и обувь</option>
              <option value="4">Всё для дома</option>
              <option value="5">Красота и здоровье</option>
              <option value="6">Электроника и техника</option>
            </select>
          </div>
        </div>

        <!-- Кнопки -->
        <div class="submit-controls" style="width: 100%; height: 0%;">
          <input class="btn" type="submit" value="Опубликовать" />
          <button class="btn" type="reset">Отмена</button>
        </div>
      </form>

      <!-- Боковое меню -->
      <div id="sideMenu" class="side-menu">
        <div class="side-menu-header">
          <img src="/assets/Logo.png" alt="Логотип" width="50" height="20">
          <span>Resell.ru</span>
        </div>
        <ul class="side-menu-list">
          <li><a href="#">Подать объявление</a></li>
          <li><a href="#">Личный кабинет</a></li>
          <?php if (isset($_SESSION['user_id'])): ?>
          <li><a href="/logout">Выйти</a></li>
          <?php endif; ?>
        </ul>
      </div>
    </div>

    <!-- Уведомление -->
    <div class="notification" id="successMessage">Объявление успешно опубликовано!</div>

    <div class="footer">
      &copy; 2025. Все права защищены.
    </div>
  </div>
  </div>

  <script>
    const titleInput = document.getElementById('title');
    const descInput = document.getElementById('description');
    const priceInput = document.getElementById('price');
    const categoryInput = document.getElementById('category');
    const photoInput = document.getElementById('photoInput');
    const submitBtn = document.getElementById('btn');

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

    let photos = [];
    let currentPhotoIndex = 0;

    // Проверка заполненности формы
    function validateForm() {
      if (
        titleInput.value.trim() &&
        descInput.value.trim() &&
        priceInput.value.trim() &&
        categoryInput.value
      ) {
        submitBtn.disabled = false;
      } else {
        submitBtn.disabled = true;
      }
    }

    titleInput.oninput = descInput.oninput = priceInput.oninput = categoryInput.onchange = validateForm;

    // Работа с фото
    photoInput.addEventListener('change', (e) => {
      photos = Array.from(e.target.files);
      currentPhotoIndex = 0;
      showPhoto();
    });

    function showPhoto() {
      const photoPreview = document.getElementById('photoPreview');
      if (photos.length > 0) {
        const file = photos[currentPhotoIndex];
        const reader = new FileReader();
        reader.onload = () => {
          photoPreview.innerHTML = `<img src="${reader.result}" alt="Фото">`;
        };
        reader.readAsDataURL(file);
      } else {
        photoPreview.textContent = 'Фотография';
      }
    }

    function prevPhoto() {
      if (currentPhotoIndex > 0) {
        currentPhotoIndex--;
        showPhoto();
      }
    }

    function nextPhoto() {
      if (currentPhotoIndex < photos.length - 1) {
        currentPhotoIndex++;
        showPhoto();
      }
    }

    document.getElementById("menuToggle").addEventListener("click", function () {
      document.getElementById("sideMenu").classList.toggle("open");
    });

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
  </script>
</body>

</html>