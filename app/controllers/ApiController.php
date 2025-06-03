<?php
require __DIR__.'/../models/Adverts.php';
require __DIR__.'/../models/UserMenu.php';

class ApiController {
    public function handleCategory() {
        if (ob_get_length()) ob_clean();

        header('Content-Type: application/json; charset=utf-8');

        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['category'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Категория не указана']);
            return;
        }

        $category = trim($data['category']);

        $slug = strtolower(preg_replace('/[^a-zA-Zа-яА-Я0-9]+/u', '-', $category));
        $slug = trim($slug, '-');

        echo json_encode([
            'success' => true,
            'category' => $category,
            'redirect_url' => "/categories/$slug"
        ]);
        exit;
    }

    public static function getMenuSettings() {
        if (ob_get_length()) ob_clean();
        $settings = UserMenu::getMenuSettings($_SESSION['user_id']);
        header('Content-Type: application/json; charset=utf-8');

        if (is_string($settings)) {
            exit($settings);
        }
        else {
            exit(json_encode($settings));
        }
    }

    public static function saveMenuSettings() {
        while (ob_get_level()) ob_end_clean();
        header('Content-Type: application/json');
       try {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);
        // $data = $data['items'];
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception('Invalid JSON input');
        }

        if (!isset($data)) {
            throw new Exception('Missing items data');
        }

        $menuItems = [];
        foreach ($data['items'] as $item) {
            $title = match ($item['title']) {
                'Подать объявление' => 'Create',
                'Выйти' => 'Logout',
                'Личный кабинет' => 'Profile',
                default => $item['title']
            };

            $menuItems[] = [
                'id' => $item['id'],
                'title' => $title,
                'url' => $item['url'],
                'is_visible' => $item['is_visible']
            ];
        }

        $success = UserMenu::saveMenuSettings(
            $_SESSION['user_id'],
            json_encode($menuItems)
        );

        if (!$success) {
            throw new Exception('Db error occurred');
        }

        echo json_encode([
            'success' => $success,
            'message' => $success ? 'Settings saved' : 'Save failed'
        ]);

    }
    catch (Exception $e) {
        http_response_code($e->getCode() ?: 500);
        echo json_encode([
            'success' => false,
            'error' => $e->getMessage()
        ]);
    }
    exit;
    }
}
