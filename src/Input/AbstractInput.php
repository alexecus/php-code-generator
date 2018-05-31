<?php

namespace Alexecus\Spawner\Input;

use Symfony\Component\Console\Style\StyleInterface;

abstract class AbstractInput
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
