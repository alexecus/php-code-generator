<?php

namespace Alexecus\Spawner\Managers;

use Alexecus\Spawner\Dependencies\Container;
use Alexecus\Spawner\Operations\AbstractOperation;

/**
 * Handles registration of operation classes
 */
class OperationsManager
{
    /**
     * Defines the available operations
     *
     * @var array
     */
    private $operations = [];

    /**
     * Adds a new operation class
     *
     * @param string $id The ID of this operation
     * @param string $instance The operation class instance
     */
    public function setOperation($id, AbstractOperation $instance)
    {
        $this->operations[$id] = $instance;
    }

    /**
     * Checks if the operation exists
     *
     * @param string $id The operation ID
     *
     * @return boolean
     */
    public function hasOperation($id)
    {
        return isset($this->operations[$id]);
    }

    /**
     * Gets a single operation
     * 
     * @param string $id The operation ID
     *
     * @return AbstractOperation
     */
    public function getOperation($id)
    {
        return $this->operations[$id] ?? null;
    }

    /**
     * Gets all registered operations
     *
     * @return array
     */
    public function getOperations()
    {
        return $this->operations;
    }
}
