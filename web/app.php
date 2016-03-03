<?php

require_once __DIR__.'/../core/bootstrap.php';


use RedBeanPHP\Facade as R;


$item = R::dispense('item');

$item->author = 'Bobo Diallo';
echo sprintf('La ligne est ajoutée evec la clé %s', R::store($item));


    
