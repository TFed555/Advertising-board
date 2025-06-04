<?php

class UserMenu {
    public static function createUserMenu($userId) {
         $defaultMenu = json_encode([
        'items' => [
            ['id' => 0, 'title' => 'Profile', 'url' => '/profile', 'is_visible' => true],
            ['id' => 1, 'title' => 'Create', 'url' => '/createAdv', 'is_visible' => true],
            ['id' => 2, 'title' => 'Logout', 'url' => '/logout', 'is_visible' => true],
        ]
    ]);

        $query = Database::query('Insert into user_menus (user_id, menu_config) values (?, ?)', [$userId, $defaultMenu]);
    }
    public static function getMenuSettings($userId) {
        $query = Database::query('Select menu_config from user_menus where user_id = ?', [$userId]);
        return $query->fetch();
    }

    public static function saveMenuSettings($userId, $menuConfig) {
        if (!is_numeric($userId) || $userId < 1) {
            throw new Exception('Неверный ID пользователя');
        }

        if (!is_string($menuConfig) || json_decode($menuConfig) === null) {
            throw new Exception('Неверный формат конфигурации меню');
        }

            try {
                $query = Database::query(
                    'UPDATE user_menus SET menu_config = ? WHERE user_id = ?',
                    [$menuConfig, $userId]
                );

                return $query->rowCount() > 0;

            } catch (Exception $e) {
                error_log('DB Error: ' . $e->getMessage());
                return false;
            }
    }

    // public static function updateVisibility($userId, $itemId, $isVisible) {
    //     Database::query('Update users_menus set menu_config = JSON_SET(menu_config, "$.items[?(@.id == ?].is_visible", ?)
    //      where user_id = ?', [$itemId, $isVisible, $userId]);
    // }
}