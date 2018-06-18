<?php

namespace Alexecus\Spawner\Operations;

class Notify extends AbstractOperation
{
    /**
     * Performs a notify operation
     */
    public function perform($message, $type = 'success')
    {
        if (method_exists($this->output, $type)) {
            return $this->output->$type($message);
        }
    }
}
