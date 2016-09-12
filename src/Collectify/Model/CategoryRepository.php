<?php

namespace Collectify\Model;


use Core\Model\BaseRepository;

class CategoryRepository extends BaseRepository
{
    const TYPE = 'category';

    public function getType(){
        return self::TYPE;
    }

}