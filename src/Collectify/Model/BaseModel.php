<?php

namespace Collectify\Model;

use RedBeanPHP\SimpleModel;

abstract class BaseModel extends \RedBean_SimpleModel
{
    protected $slug;
    protected $createdAt;
    protected $updatedAt;

}