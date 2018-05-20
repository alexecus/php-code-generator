<?php

namespace Alexecus\Spawner\Resolver;

use Webmozart\PathUtil\Path;

/**
 * Handles generation of paths
 */
class PathResource
{
    private $path;
    private $relativeTo;

    public function __construct($path, $relativeTo = null)
    {
        $this->path = $path;
        $this->relativeTo = $relativeTo;
    }

    public static function fromAbsolute($path)
    {
        return new static($path);
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getAbsolute()
    {
        return Path::makeAbsolute($this->path, $this->relativeTo);
    }
}
