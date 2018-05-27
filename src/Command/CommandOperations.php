<?php

namespace Alexecus\Spawner\Command;

use Alexecus\Spawner\Managers\OperationsManager;

trait CommandOperations
{
    /**
     * @var OperationsManager
     */
    protected $operations;

    /**
     *
     */
    public function setOperations(OperationsManager $operations)
    {
        $this->operations = $operations;
    }

    /**
     * Get the specific operation instance
     *
     * @param string $id The operation ID
     * @return void
     */
    public function operation($id)
    {
        $operation = $this->operations->getOperation($id);

        $operation->setOutput($this->style);

        return $operation;
    }
}
