<?php
session_start();
require_once __DIR__.'/../config/bootstrap.php';


Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('../src/Collectify/Views/Category');
$twig = new Twig_Environment($loader, array(
    'cache' => false
));
$template = $twig->loadTemplate('list.twig');

echo $template->render(array(

    'moteur_name' => 'Twig'

));
$dispatcher = new \Core\Services\Router(__ROUTES__);
$dispatcher->dispatch();


    
