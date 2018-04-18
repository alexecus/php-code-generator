<?php

namespace Alexecus\Spawner;

use Symfony\Component\Console\Application as Console;
use DI\Container;

/**
 * Class that bootstraps the generator application
 */
class Application
{
    public function __construct($name = 'Spawner', $version = '1.0')
    {
        $this->console = new Console($name, $version);
        $this->container = new Container();
    }

    /**
     * Inserts a new console command
     *
     * @param string $command The fully qualified namespace of the command
     */
    public function add($command)
    {
        $this->console->add(
            $this->container->get($command)
        );
    }

    /**
     * Runs the application kernel
     */
    public function run()
    {
        $this->console->run();
    }
}
