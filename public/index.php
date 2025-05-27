<?php
require __DIR__.'/../app/core/bootstrap.php';

$router = new Router();
require __DIR__.'/../app/config/routes.php';

$router->dispatch($_SERVER['REQUEST_URI']);