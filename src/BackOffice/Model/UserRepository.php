<?php

namespace BackOffice\Model;


use Core\Model\BaseRepository;

class UserRepository extends BaseRepository
{
    const TYPE = 'user';

    public function getType(){
        return self::TYPE;
    }

}