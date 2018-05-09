<?php

namespace Alexecus\Spawner;

use Symfony\Component\Console\Application as Console;
use DI\Container;

use Alexecus\Spawner\Operations\Append;
use Alexecus\Spawner\Operations\Copy;
use Alexecus\Spawner\Operations\Template;

/**
 * Class that bootstraps the generator application
 */
class Application
{
    /**
     * Defines the available operations
     *
     * @var array
     */
    const OPERATIONS = [
        'copy'      => Copy::class,
        'append'    => Append::class,
        'template'  => Template::class,
    ];

    /**
     * Stores the command
     *
     * @var array
     */
    private $commands = [];

    public function __construct($name = 'Spawner', $version = '1.0')
    {
        $this->console = new Console($name, $version);
        $this->container = new Container();
        $this->path = new Path();
    }

    /**
     * Gets the symfony console object
     *
     * @return Symfony\Component\Console\Application
     */
    public function getConsole()
    {
        return $this->console;
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

        $operations = [];

        foreach (self::OPERATIONS as $key => $value) {
            $operations[$key] = $this->container->get($value);
        }

        foreach ($this->commands as $command) {
            $instance = $this->container->get($command);
            $instance->setOperations($operations);

            $this->console->add($instance);
        }

        $this->console->run();
    }

    /**
     * Gets all registered commands
     *
     * @return array
     */
    public function getCommands()
    {
        return $this->commands;
    }
}
