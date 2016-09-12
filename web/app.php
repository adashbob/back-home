<?php
session_start();
require_once __DIR__.'/../config/bootstrap.php';



$dispatcher = new \Core\Services\Router(__ROUTES__);
$dispatcher->dispatch();


    
