<?php

require __DIR__."../models/UserMenu.php";

class MenuController {
    public function updateVisibility($itemId, $isVisible) {
        $userId = $_SESSION['user_id'];
        UserMenu::updateVisibility($userId, $itemId, $isVisible);
    }
}