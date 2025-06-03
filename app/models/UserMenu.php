<?php

class UserMenu {
    public static function createUserMenu($userId) {
        $query = Database::query('Insert into usermenus (user_id) values (?)', [$userId]);
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

    public static function updateVisibility($userId, $itemId, $isVisible) {
        Database::query('Update users_menus set menu_config = JSON_SET(menu_config, "$.items[?(@.id == ?].is_visible", ?)
         where user_id = ?', [$itemId, $isVisible, $userId]);
    }
}