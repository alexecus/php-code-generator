<?php

namespace Alexecus\Spawner\App;

use Symfony\Component\Console\Application as Console;
use DI\Container;

use Alexecus\Spawner\Resolver\PathResolver;

/**
 * Class that bootstraps the generator application
 */
class Application
{
    use DefinitionsTrait;
    use OperationsTrait;

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
        $this->path = new PathResolver();
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
        $this->container->set(PathResolver::class, $this->path);
    }

    /**
     * Inserts a new console command
     *
     * @param string $command The fully qualified namespace of the command
     */
    public function add($command)
    {
        $this->commands[] = $this->container->get($command);
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

    /**
     * Runs the application kernel
     */
    public function run()
    {
        $operations = [];

        foreach ($this->operations as $key => $value) {
            $operations[$key] = $this->container->get($value);
        }

        foreach ($this->commands as $command) {
            $command->setOperations($operations);

            $this->console->add($command);
        }

        $this->console->run();
    }
}
