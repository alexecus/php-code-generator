<?php

namespace Alexecus\Spawner\Operations;

use Symfony\Component\Console\Style\StyleInterface;

abstract class AbstractOperation
{
    protected $output;
    protected $validators;

    public function setOutput(StyleInterface $output)
    {
        $this->output = $output;
    }

    public function setValidators($validators)
    {
        $this->validators = $validators;
    }
}
