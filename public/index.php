<?php
require __DIR__.'/../app/core/bootstrap.php';
require_once __DIR__.'/../app/middleware/AuthMiddleware.php';

$authMiddleware = new AuthMiddleware();

$authMiddleware->handle();

$router = new Router();
require __DIR__.'/../app/config/routes.php';


$router->dispatch($_SERVER['REQUEST_URI']);
