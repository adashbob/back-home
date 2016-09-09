<?php
/**
 * Charge les fichiers de configuration de l'app
 * Charge l'autoload
 */
require_once __DIR__.'/config.inc.php';
require_once __DIR__.'/../vendor/autoload.php';

/**
 * RedBeam: Interaction avec la base de donnés
 */
use RedBeanPHP\Facade as R;

// Create the database
if(empty(R::$currentDB)){
    $dsn = sprintf('%s:host=%s;dbname=%s', DB_TYPE, DB_HOST, DB_NAME);
    R::setup($dsn, DB_USER, DB_PASSWORD);
}
R::close();