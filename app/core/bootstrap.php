<?php
session_start();
require __DIR__.'/../../vendor/autoload.php';
require __DIR__.'/Database.php';
require __DIR__.'/Router.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../../');
$dotenv->load();

Database::init([
    'host' => $_ENV['DB_HOST'],
    'dbname' => $_ENV['DB_NAME'],
    'user' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASSWORD']
]);