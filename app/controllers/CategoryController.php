<?php
require __DIR__.'/../models/Adverts.php';

class CategoryController {
        public function show() {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $slug = basename($path);

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 5;

        $sort = $_GET['sort'] ?? 'created_at_desc';

        $validSorts = [
            'created_at_desc', 'created_at_asc',
            'price_desc', 'price_asc',
            'title_asc', 'title_desc'
        ];

        if (!in_array($sort, $validSorts)) {
            $sort = 'created_at_desc';
        }

        $ads = Adverts::findByCategory($slug, $page, $perPage, $sort);
        $totalAds = Adverts::countByCategory($slug);
        $category = Adverts::getCategory($slug);

        $totalPages = ceil($totalAds / $perPage);

        require_once __DIR__ . '/../views/category.php';
    }
}