<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command as Base;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

abstract class Command extends Base
{
    use CommandTrait;

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
