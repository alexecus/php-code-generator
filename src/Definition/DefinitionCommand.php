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
    use DefinitionArguments;

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
        $command = $this->yaml['command'];
        $description = $this->yaml['description'];

        $this
            ->setName($command)
            ->setDescription($description);
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $vars = [];
        $inputs = $this->yaml['inputs'] ?? [];

        foreach ($inputs as $key => $options) {
            if (isset($options['input'])) {
                $action = $options['input'];
                $options = $this->resolveArguments($options, $vars);

                $vars[$key] = $this->handleInput($action, $options);
            }
        }

        $operations = $this->yaml['actions'] ?? [];

        foreach ($operations as $key => $options) {
            if (isset($options['action'])) {
                $action = $options['action'];

                $options = $this->resolveArguments($options, $vars);

                // Code for the IF directive
                // don't execute an operation if an `if` condition is present
                if (isset($options['if'])) {
                    $condition = $options['if'];

                    if (isset($vars[$condition]) && !$vars[$condition]) {
                        continue;
                    }
                }

                $this->handleOperation($action, $options, $vars);
            }
        }
    }
}
