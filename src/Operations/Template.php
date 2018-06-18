<?php

namespace Alexecus\Spawner\Operations;

use Symfony\Component\Filesystem\Filesystem;

use Alexecus\Spawner\Render\Twig;
use Alexecus\Spawner\Resolver\PathResource;

class Template extends AbstractOperation
{
    /**
     * @var Twig
     */
    private $twig;

    /**
     * @var Filesystem
     */
    private $filesystem;

    public function __construct(Twig $twig, Filesystem $filesystem)
    {
        $this->twig = $twig;
        $this->filesystem = $filesystem;
    }
 
    /**
     * Performs the copy operation
     *
     * @param string $source The file path
     * @param string $target The path to copy this file into
     * @param array $replacements Replacement data for twig
     */
    public function perform(PathResource $source, PathResource $target, $replacements = [])
    {
        $body = $this->twig->fromFile($source->getAbsolute(), $replacements);

        $this->filesystem->dumpFile($target->getAbsolute(), $body);
    }
}
