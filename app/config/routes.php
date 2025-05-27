<?php
$router->add('GET', '/', 'HomeController@index');
$router->add('GET', '/login', 'AuthController@login');
$router->add('GET', '/register', 'AuthController@register');