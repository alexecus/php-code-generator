<?php

namespace Alexecus\Spawner\Operations;

use Symfony\Component\Filesystem\Filesystem;

use Alexecus\Spawner\Render\Twig;
use Alexecus\Spawner\Resolver\PathResolver;

class Template
{
    /**
     * @var Twig
     */
    private $twig;

    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * @var PathResolver
     */
    private $path;

    public function __construct(Twig $twig, Filesystem $filesystem, PathResolver $path)
    {
        $this->twig = $twig;
        $this->filesystem = $filesystem;
        $this->path = $path;
    }
 
    /**
     * Performs the copy operation
     *
     * @param string $source The file path
     * @param string $target The path to copy this file into
     * @param array $replacements Replacement data for twig
     */
    public function perform($source, $target, $replacements = [])
    {
        $body = $this->twig->fromFile($source, $replacements);
        $destination = $this->path->absolute($target);

        $this->filesystem->dumpFile($destination, $body);   
    }
}
