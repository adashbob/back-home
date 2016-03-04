<?php

namespace Collectify\DataFixtures;

use Collectify\Model\UserRepository;

class UserFixtures extends BaseFixtures
{
    public function getType()
    {
        return UserRepository::TYPE;
    }

    public function getFixtures()
    {
        return array(
            array(
                'firstname' => 'Assane',
                'lastname' => 'Dieng',
                'username' => 'azo',
                'password' => 'dieng'
            ),
            array(
                'firstname' => 'Youssou',
                'lastname' => 'Ndour',
                'username' => 'you',
                'password' => 'ndour'
            ),
            array(
                'firstname' => 'Aliou',
                'lastname' => 'Ba',
                'username' => 'aliou',
                'password' => 'ba'
            ),
        );
    }
}