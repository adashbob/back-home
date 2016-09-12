<?php

namespace Core\Model;

use Nibble\NibbleForms\Useful;
use RedBeanPHP\SimpleModel;

abstract class BaseModel extends SimpleModel
{
    public $slug;
    public $createdAt;
    public $updatedAt;
    protected $now;
    private $unBoxObject;

    /**
     * LifeCycle: preupdate
     */
    public function update()
    {
        $this->unBoxObject =  $this->unbox();
        $this->now = new \DateTime(null, new \DateTimeZone('Africa/Dakar'));
        $this->setSlug();
        $this->setCreatedAt();
        $this->setUpdatedAt();

    }

    private function setSlug()
    {
        $text = $this->unBoxObject->name ?: $this->unBoxObject->title;
        if(!$text){
            return;
        }
        $text = Useful::slugify($text);
        $this->unBoxObject->slug = $text;
    }

    private function setCreatedAt()
    {
        if(!$this->unBoxObject->createdAt){
            $this->unBoxObject->createdAt = $this->now;
        }
    }

    private function setUpdatedAt()
    {
        $this->unBoxObject->updatedAt = $this->now;
    }

    public function getAttributes()
    {
        $attributes = get_object_vars($this);
        unset($attributes['unBoxObject']);
        unset($attributes['now']);
        unset($attributes['bean']);
        return $attributes;
    }
}