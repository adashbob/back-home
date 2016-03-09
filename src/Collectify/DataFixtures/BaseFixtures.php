<?php

namespace Collectify\DataFixtures;


/**
 * Class BaseFixtures
 * @package Collectify\DataFixtures
 */
abstract class BaseFixtures
{
    public abstract function getType();

    /**
     * Load the model's fixtures.
     * Call a create's member function of the appropriate repository
     */
    public function loadFixtures()
    {
        $type = $this->getType();
        $fixtures = $this->getFixtures();

        $repositoryClass = sprintf('\\Collectify\\Model\\%sRepository', ucfirst($type));
        $repository = new $repositoryClass();
        foreach($fixtures as $fixture) {
            $repository->create($fixture);
        }

    }
}