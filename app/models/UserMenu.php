<?php

class UserMenu {
    public static function createMenuConfig($userId) {
        DataBase::query('Insert Into user_menus (user_id) values (?)', [$userId]);
    }
    public static function updateVisibility($userId, $itemId, $isVisible) {
        Database::query('Update users_menus set menu_config = JSON_SET(menu_config, "$.items[?(@.id == ?].is_visible", ?)
         where user_id = ?', [$itemId, $isVisible, $userId]);
    }
}