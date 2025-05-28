<?php
class HomeController {
    public function index() {
        $title = "Главная страница";

        $welcomeMessage = "Добро пожаловать на наш сайт!";
        $features = [
            'Быстрая работа',
            'Удобный интерфейс',
            'Безопасность данных'
        ];

        require_once __DIR__ .'/../views/main.php';
    }
}