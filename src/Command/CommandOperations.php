<?php

namespace Alexecus\Spawner\Command;

trait CommandOperations
{
    private $operations = [];

    public function setOperations($operations)
    {
        $this->operations = $operations;
    }

    public function hasOperation($operation)
    {
        return isset($this->operations[$operation]);
    }

    public function operation($operation)
    {
        if (isset($this->operations[$operation])) {
            $instance = $this->operations[$operation];
            $instance->setOutput($this->style);

            return $instance;
        }
    }
}
