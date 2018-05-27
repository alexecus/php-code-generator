<?php

namespace Alexecus\Spawner\Command;

use Symfony\Component\Console\Command\Command as Base;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

abstract class Command extends Base
{
    use CommandInputs;
    use CommandOperations;
    use CommandValidators;

    /**
     * @var SymfonyStyle
     */
    protected $style;

    /**
     * {@inheritdoc}
     */
    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->style = new SymfonyStyle($input, $output);
    }
}
