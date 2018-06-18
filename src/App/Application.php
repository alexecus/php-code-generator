<?php

namespace Alexecus\Spawner\App;

use Symfony\Component\Console\Application as Console;

use Alexecus\Spawner\Dependencies\Container;
use Alexecus\Spawner\Definition\DefinitionCommand;
use Alexecus\Spawner\Command\Command;

use Alexecus\Spawner\Managers\OperationsManager;
use Alexecus\Spawner\Managers\ValidatorsManager;
use Alexecus\Spawner\Managers\InputsManager;

use Alexecus\Spawner\Operations;
use Alexecus\Spawner\Validators;
use Alexecus\Spawner\Input;

/**
 * Class that bootstraps the generator application
 */
class Application
{
    /**
     * @var OperationsManager
     */
    private $operations;

    /**
     * @var ValidatorsManager
     */
    private $validators;

    /**
     * @var InputsManager
     */
    private $inputs;

    /**
     * Stores the command
     *
     * @var array
     */
    private $commands = [];

    /**
     * Public constuctor
     */
    public function __construct($name = 'Spawner', $version = '1.0')
    {
        $this->console = new Console($name, $version);

        $this->operations = Container::resolve(OperationsManager::class);
        $this->validators = Container::resolve(ValidatorsManager::class);
        $this->inputs = Container::resolve(InputsManager::class);

        $this->init();
    }

    /**
     * Initializes the application
     * Populates default operations and validators
     *
     * @return void
     */
    public function init()
    {
        $this->addOperation('append', Operations\Append::class);
        $this->addOperation('copy', Operations\Copy::class);
        $this->addOperation('notify', Operations\Notify::class);
        $this->addOperation('template', Operations\Template::class);

        $this->addValidator('empty', Validators\EmptyValidator::class);
        $this->addValidator('starts_with', Validators\StartsWithValidator::class);
        $this->addValidator('ends_with', Validators\EndsWithValidator::class);

        $this->addInput('ask', Input\AskInput::class);
        $this->addInput('confirm', Input\ConfirmInput::class);
    }

    /**
     * Commands
     *
     */

    /**
     * Inserts a new console command
     *
     * @param string $command The fully qualified namespace of the command
     */
    public function addCommand(Command $command)
    {
        $this->commands[] = Container::resolve($command);
    }

    /**
     * Inserts a definition file
     */
    public function addDefinition($source, $root)
    {
        $this->commands[] = new DefinitionCommand($source, $root);
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
     * Console Related
     *
     */

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
     * Runs the application kernel
     */
    public function run()
    {
        foreach ($this->commands as $command) {
            $command->setOperations($this->operations);
            $command->setValidators($this->validators);
            $command->setInputs($this->inputs);

            $this->console->add($command);
        }

        $this->console->run();
    }

    /**
     * Add plugins
     *
     */

    /**
     * Adds a new operation class
     *
     * @param string $id The instances ID
     * @param string $class The fully qualified class name
     */
    public function addOperation($id, $class)
    {
        $this->operations->setOperation($id, Container::resolve($class));
    }

    /**
     * Adds a new validator class
     *
     * @param string $id The instances ID
     * @param string $class The fully qualified class name
     */
    public function addValidator($id, $class)
    {
        $this->validators->setValidator($id, Container::resolve($class));
    }

    /**
     * Adds a new input class
     *
     * @param string $id The instances ID
     * @param string $class The fully qualified class name
     */
    public function addInput($id, $class)
    {
        $this->inputs->setInput($id, Container::resolve($class));
    }
}
