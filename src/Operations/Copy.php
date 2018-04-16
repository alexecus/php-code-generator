<?php

namespace App\Operations;

use Symfony\Component\Filesystem\Filesystem;

use App\Path;
use App\Render\Twig;

class Copy
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
     * @var Path
     */
    private $path;

    public function __construct(Twig $twig, Filesystem $filesystem, Path $path)
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
    public function perform($source, $target, $replacements)
    {
        $root = $this->path->root();
        $body = $this->twig->fromFile($source, $replacements);
        $destination = $root . '/' . $target;

        $this->filesystem->dumpFile($destination, $body);   
    }
}
