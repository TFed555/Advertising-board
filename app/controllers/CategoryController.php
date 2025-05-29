<?php
require __DIR__.'/../models/Adverts.php';

class CategoryController {
        public function show() {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $slug = basename($path);

        $ads = Adverts::findByCategory($slug);
        $category = Adverts::getCategory($slug);

        require_once __DIR__ . '/../views/category.php';
    }
}