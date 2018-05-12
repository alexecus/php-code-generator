<?php

namespace Alexecus\Spawner\App;

use Symfony\Component\Yaml\Yaml;
use Alexecus\Spawner\Definition\DefinitionCommand;


/**
 *
 */
trait DefinitionsTrait
{
    private $definitions = [];

    /**
     * Inserts a definition file
     */
    public function definition($source)
    {
        $file = Yaml::parse(
            file_get_contents($this->path->absolute($source))
        );

        $this->commands[] = new DefinitionCommand($file);
    }
}
