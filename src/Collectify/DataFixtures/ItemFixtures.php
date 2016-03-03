<?php

namespace Collectify\DataFixtures;

class ItemFixtures extends BaseFixtures
{
    public function getType()
    {
        return 'item';
    }

    public function getFixtures()
    {
        return array(
            array(
                'title' => 'Plume de mer',
                'author' => 'Azo Dieng',
                'editor' => null,
                'releasedAt' => '10/02/2016',
                'gender' => 'ROCK',
                'support' => 'CD',
            ),
            array(
                'title' => 'Boul Bayekou',
                'author' => 'Youssou Ndour',
                'editor' => 'Maison Ndouta Seck',
                'releasedAt' => '20/03/2015',
                'gender' => 'Mbalakh',
                'support' => 'CD',
            ),
            array(
                'title' => 'Femme nue',
                'author' => 'Senghor',
                'editor' => null,
                'releasedAt' => '11/02/2016',
                'gender' => 'ROMAN',
                'support' => 'Livre',
            ),
        );
    }
}