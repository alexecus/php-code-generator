<?php

namespace Alexecus\Spawner;

use Symfony\Component\Console\Application as Console;
use DI\Container;

/**
 * Class that bootstraps the generator application
 */
class Application
{
    private $commands = [];

    public function __construct($name = 'Spawner', $version = '1.0')
    {
        $this->console = new Console($name, $version);
        $this->container = new Container();
        $this->path = new Path();
    }

    /**
     * Sets the root path for generation
     *
     * @param string $path
     */
    public function setRoot($path)
    {
        $this->path->setRoot($path);
    }

    /**
     * Inserts a new console command
     *
     * @param string $command The fully qualified namespace of the command
     */
    public function add($command)
    {
       $this->commands[] = $command;
    }

    /**
     * Runs the application kernel
     */
    public function run()
    {
        $this->container->set(Path::class, $this->path);

        foreach ($this->commands as $command) {
            $this->console->add(
                $this->container->get($command)
            );
        }

        $this->console->run();
    }
}
