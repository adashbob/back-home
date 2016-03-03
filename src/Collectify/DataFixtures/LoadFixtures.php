<?php


// Class executed in CLI
require_once __DIR__.'/../../../core/bootstrap.php';


$className = $argv[1];

$classFixtures = sprintf('\\Collectify\\DataFixtures\\%sFixtures', ucfirst($className));
$objectFixtures = new $classFixtures();
$objectFixtures->loadFixtures();


echo sprintf('Load %s\'s data seccessful', $objectFixtures->getType());
