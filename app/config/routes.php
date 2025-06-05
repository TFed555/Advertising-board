<?php
$router->add('GET', '/', 'HomeController@index');
$router->add('GET', '/login', 'AuthController@login');
$router->add('GET', '/register', 'AuthController@register');
$router->add('GET', '/logout', 'AuthController@logout');
$router->add('GET', '/profile', 'UserController@show');
$router->add('GET', '/createAdv', 'AdController@handleAd');
$router->add('GET', '/reset', 'RepairController@reset');
$router->add('GET', '/categories/:slug', 'CategoryController@show');
$router->add('GET', '/upload-xml', 'ImportController@show');

$router->add('POST', '/login', 'AuthController@login');
$router->add('POST', '/register', 'AuthController@register');
$router->add('POST', '/repair', 'RepairController@repair');
$router->add('POST', '/reset', 'RepairController@reset');
$router->add('POST', '/profile', 'UserController@updateProfile');
$router->add('POST', '/create', 'AdController@create');
$router->add('POST', '/search', 'CategoryController@search');
$router->add('POST', '/uploadxml', 'ImportController@uploadXml');

//для api запросов
$router->add('POST', '/api/category', 'ApiController@handleCategory');
$router->add('GET', '/api/menu-settings', 'ApiController@getMenuSettings');
$router->add('POST', '/api/save-menu-settings', 'ApiController@saveMenuSettings');
