<?php
$router->add('GET', '/', 'HomeController@index');
$router->add('GET', '/login', 'AuthController@login');
$router->add('GET', '/register', 'AuthController@register');

$router->add('POST', '/login', 'AuthController@login');
$router->add('POST', '/register', 'AuthController@register');

