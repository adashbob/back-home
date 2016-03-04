<?php


namespace Collectify\Model;

use RedBeanPHP\Facade as R;

abstract class BaseRepository
{
    public abstract function getType();

    public function create($data)
    {
        $object = R::dispense($this->getType());
        foreach ($data as $property => $value) {
            $object->$property = $value;
        }
        R::store($object);
    }

}