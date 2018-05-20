<?php

namespace Alexecus\Spawner\App;

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
    public function definition($source, $root)
    {
        $this->commands[] = new DefinitionCommand($source, $root);
    }
}
