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

        foreach($fixtures as $fixture) {
            $repositoryClass = sprintf('\\Collectify\\Model\\%sRepository', ucfirst($type));
            $repository = new $repositoryClass();
            $repository->create($fixture);
        }

    }
}