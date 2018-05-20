<?php

namespace Alexecus\Spawner\Operations;

use Symfony\Component\Filesystem\Filesystem;

use Alexecus\Spawner\Resolver\PathResource;

class Copy extends AbstractOperation
{
    /**
     * @var Filesystem
     */
    private $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * Performs the copy operation
     *
     * @param string $source The file path
     * @param string $target The path to copy this file into
     */
    public function perform(PathResource $source, PathResource $target)
    {
        $this->filesystem->copy($source->getAbsolute(), $target->getAbsolute());
    }
}
