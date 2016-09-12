<?php
session_start();
require_once __DIR__.'/../core/bootstrap.php';


//$dispatcher = new \Collectify\Services\Dispatcher(__ROUTES__);
$dispatcher = new \Collectify\Services\Router(__ROUTES__);
$dispatcher->dispatch();


    
