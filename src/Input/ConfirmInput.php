<?php

namespace Alexecus\Spawner\Input;

use RuntimeException;

use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;

use Alexecus\Spawner\Managers\ValidatorsManager;

class ConfirmInput extends AbstractInput
{
    public function perform($message)
    {
        return $this->output->confirm($message);
    }
}
