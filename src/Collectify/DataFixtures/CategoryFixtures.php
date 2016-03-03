<?php

namespace Collectify\DataFixtures;

class CategoryFixtures extends BaseFixtures
{
    public function getType()
    {
        return 'category';
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