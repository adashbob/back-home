<?php
$routes = array();
$routesCategory = array(
    'module' => 'Collectify',
    'basePath' => '/category',
    '/add' => 'Category:add',
    '/list' => 'Category:list'
);
$routesItem = array(
    'module' => 'Collectify',
    'basePath' => '/item',
    '/add' => 'Item:add',
    '/list' => 'Item:list'
);

$routesUser = array(
    'module' => 'BackOffice',
    'basePath' => '/user',
    '/add' => 'User:add',
    '/list' => 'User:list'
);

$routes['category'] = $routesCategory;
$routes['item'] = $routesItem;
$routes['user'] = $routesUser;
define('__ROUTES__', $routes);
