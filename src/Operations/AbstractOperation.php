<?php

namespace Alexecus\Spawner\Operations;

use Symfony\Component\Console\Style\StyleInterface;

abstract class AbstractOperation
{
    protected $output;

    public function setOutput(StyleInterface $output)
    {
        $this->output = $output;
    }
}
