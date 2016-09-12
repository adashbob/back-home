<?php
$routes = array();
$routesCategory = array(
    'basePath' => '/category',
    '/add' => 'Category:add',
    '/list' => 'Category:list'
);
$routesItem = array(
    'basePath' => '/item',
    '/add' => 'Item:add',
    '/list' => 'Item:list'
);

$routes['category'] = $routesCategory;
$routes['item'] = $routesItem;
define('__ROUTES__', $routes);
