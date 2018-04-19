<?php

namespace Alexecus\Spawner;

/**
 * Handles generation of paths
 */
class Path
{
    /**
     * @var string
     */
    private $root;

    /**
     * Set the root path
     *
     * @param string $root The absolute root path
     * 
     * @return
     */
    public function setRoot($root)
    {
        $this->root = $root;
    }

    /**
     * Gets the root path
     *
     * @return string
     */
    public function getRoot()
    {
        return $this->root ?? getcwd();
    }

    /**
     * Generate an absolute path relative to the root
     * 
     * @param string $path The relative path to generate from
     * 
     * @return string
     */
    public function absolute($path)
    {
        return $this->getRoot() . '/' . ltrim($path, '/');
    }
}
