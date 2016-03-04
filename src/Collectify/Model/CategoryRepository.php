<?php

namespace Collectify\Model;


class CategoryRepository extends BaseRepository
{
    const TYPE = 'category';

    public function getType(){
        return self::TYPE;
    }

}