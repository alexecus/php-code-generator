<?php

namespace Alexecus\Spawner\Resolver;

/**
 * Handles generation of paths
 */
class PathResolver
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
        $this->root = rtrim($root, '/');
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
        return rtrim($this->getRoot(), '/') . '/' . trim($path, '/');
    }
}
