<?php
require_once __DIR__.'/../models/Adverts.php';

class HomeController {
    public function index() {
        $ads = Adverts::findLastAds();
        require_once __DIR__ .'/../views/main.php';
    }
}