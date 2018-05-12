<?php

namespace Alexecus\Spawner\Definition;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Alexecus\Spawner\Command\Command;

class DefinitionCommand extends Command
{
    use DefinitionCommandInputs;

    private $yaml;

    public function __construct($yaml)
    {
        $this->yaml = $yaml;

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
            if (isset($input['input']) && isset($input['var'])) {
                $id = $input['var'];
                $action = $input['input'];

                $vars[$id] = $this->handleInput($action, $input);
            }
        }

        d($vars);
    }
}
