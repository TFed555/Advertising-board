<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\App;
use App\Core\Database;

// Загрузка переменных окружения
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

// Старт сессии
session_start();

// Инициализация приложения
App::bind('config', require '../app/config/database.php');
App::bind('database', new Database());

// Вспомогательные функции
function view($name, $data = [])
{
    extract($data);
    return require "../app/views/{$name}.view.php";
}

function redirect($path)
{
    header("Location: /{$path}");
    exit();
}

// Маршрутизация
$router = new \App\Core\Router();

$router->get('', 'HomeController@index');
$router->get('home', 'HomeController@index');
$router->get('login', 'AuthController@showLogin');
$router->post('login', 'AuthController@login');
$router->get('register', 'AuthController@showRegister');
$router->post('register', 'AuthController@register');
$router->get('logout', 'AuthController@logout');

$router->dispatch($_SERVER['REQUEST_URI']);