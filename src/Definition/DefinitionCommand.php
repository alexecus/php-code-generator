<?php

namespace Alexecus\Spawner\Definition;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Yaml;

use Alexecus\Spawner\Command\Command;

class DefinitionCommand extends Command
{
    use DefinitionInputs;
    use DefinitionOperations;

    private $root;
    private $yaml;

    public function __construct($source, $root)
    {
        $this->yaml = Yaml::parse(file_get_contents($source));
        $this->root = $root;

        parent::__construct();
    }

    public function configure()
    {
        ['command' => $command, 'description' => $description] = $this->yaml;

        $this
            ->setName($command)
            ->setDescription($description);
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $vars = [];
        $inputs = $this->yaml['inputs'] ?? [];

        foreach ($inputs as $key => $input) {
            if (isset($input['input'])) {
                $action = $input['input'];

                $vars[$key] = $this->handleInput($action, $input);
            }
        }

        // d($this->root);
        // d($vars);
        // exit;

        $operations = $this->yaml['actions'] ?? [];

        foreach ($operations as $key => $operation) {
            if (isset($operation['action'])) {
                $action = $operation['action'];

                $this->handleOperation($action, $operation, $vars);
            }
        }
    }
}
