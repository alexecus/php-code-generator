<?php

namespace Alexecus\Spawner\Operations;

use Symfony\Component\Filesystem\Filesystem;

use Alexecus\Spawner\Resolver\PathResolver;

class Copy
{
    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * @var PathResolver
     */
    private $path;

    public function __construct(Filesystem $filesystem, PathResolver $path)
    {
        $this->filesystem = $filesystem;
        $this->path = $path;
    }
 
    /**
     * Performs the copy operation
     *
     * @param string $source The file path
     * @param string $target The path to copy this file into
     */
    public function perform($source, $target)
    {
        $destination = $this->path->absolute($target);

        $this->filesystem->copy($source, $destination);
    }
}
