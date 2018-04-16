<?php

namespace App;

use Symfony\Component\Console\Application;
use DI\Container;

use Components\Form\FormGenerator;

/**
 * Class that bootstraps the generator application
 */
class Kernel
{
    const COMMANDS = [
        FormGenerator::class,
    ];

    public function __construct()
    {
        $this->console = new Application();
        $this->container = new Container();
    }

    /**
     * Runs the application kernel
     */
    public function run()
    {
        foreach (self::COMMANDS as $instance) {
            $this->console->add(
                $this->container->get($instance)
            );
        }
    
        $this->console->run();
    }
}
