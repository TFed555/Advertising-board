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

            $val = $ads[0]['img_path_preview'];

            $totalPages = ceil($totalAds / $perPage);

            $isSearch = false;
            require_once __DIR__ . '/../views/category.php';
    }

    public static function search() {
            $slug = $_POST['category_id'];
            $category = Adverts::getCategory($slug);
            if (!isset($_POST['findString']) || trim($_POST['findString']) === '') {
                    $error = 'Ничего не найдено';
                    $isSearch = false;
                    // exit;
            }
            $find = trim($_POST['findString']);
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $perPage = 5;
            $offset = ($page - 1) * $perPage;

            $sort = $_GET['sort'] ?? 'created_at_desc';

            $ads = Adverts::search($slug, $find, $perPage, $offset);
            $totalAds = Adverts::countSearchResults($slug, $find);
            $totalPages = ceil($totalAds / $perPage);

            $isSearch = true;
            require_once __DIR__ . '/../views/category.php';
    }
}