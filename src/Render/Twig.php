<?php

namespace App\Render;

use Twig\Environment;
use Twig\Loader\ArrayLoader;

class Twig
{
    /**
     * @var ArrayLoader
     */
    private $loader;

    /**
     * @var Environment
     */
    private $environment;

    public function __construct()
    {
        $this->loader = new ArrayLoader([]);
        $this->environment = new Environment($this->loader);
    }

    /**
     * Render a template from file
     *
     * @param string $file The file path
     * @param array $data
     */
    public function fromFile($file, $data)
    {
        $contents = file_get_contents($file);

        return $this->environment->createTemplate($contents)->render($data);
    }
}
