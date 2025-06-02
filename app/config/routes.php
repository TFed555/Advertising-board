<?php
$router->add('GET', '/', 'HomeController@index');
$router->add('GET', '/login', 'AuthController@login');
$router->add('GET', '/register', 'AuthController@register');
$router->add('GET', '/logout', 'AuthController@logout');

$router->add('GET', '/reset', 'RepairController@reset');
$router->add('GET', '/categories/:slug', 'CategoryController@show');

$router->add('POST', '/login', 'AuthController@login');
$router->add('POST', '/register', 'AuthController@register');
$router->add('POST', '/repair', 'RepairController@repair');
$router->add('POST', '/reset', 'RepairController@reset');

//для api запросов
$router->add('POST', '/api/category', 'ApiController@handleCategory');
