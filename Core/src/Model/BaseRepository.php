<?php


namespace Core\Model;

use RedBeanPHP\Facade as R;

abstract class BaseRepository
{
    public abstract function getType();

    public function load($id)
    {
        return R::load($this->getType(), $id);
    }

    /**
     * Add data in database
     * @param $data
     */
    public function create($data)
    {
        $object = R::dispense($this->getType());
        $this->setData($data, $object);
        $this->save($object);
    }

    /**
     * Updata data in database
     * @param $data
     * @param $object
     */
    public function update($data, $object)
    {
        $this->setData($data, $object);
        $this->save($object);
    }

    private function setData($data, $object)
    {
        foreach ($data as $property => $value) {
            $object->$property = $value;
        }
    }


    private function save($object)
    {
        return R::store($object);
    }

    public function getAll()
    {
        return R::findAll($this->getType());
    }

    public function remove($id)
    {
        R::trash($this->load($id));
    }

}