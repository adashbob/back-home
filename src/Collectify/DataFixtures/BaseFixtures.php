<?php


namespace Collectify\DataFixtures;

use RedBeanPHP\Facade as R;

abstract class BaseFixtures
{
    public function loadFixtures()
    {
        $type = $this->getType();
        $fixtures = $this->getFixtures();

        foreach ($fixtures as $fixture) {
            $object = R::dispense($type);
            foreach ($fixture as $property => $value) {
                $object->$property = $value;
            }
            R::store($object);
        }
    }
}