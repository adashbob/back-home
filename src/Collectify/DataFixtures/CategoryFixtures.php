<?php

namespace Collectify\DataFixtures;

use Collectify\Model\CategoryRepository;

class CategoryFixtures extends BaseFixtures
{
    public function getType()
    {
        return CategoryRepository::TYPE;
    }

    public function getFixtures()
    {
        return array(
            array(
                'name' => 'Mbalakh'
            ),
            array(
                'name' => 'Slow'
            ),
            array(
                'name' => 'Rnb'
            ),
            array(
                'name' => 'Pop'
            ),
        );
    }
}