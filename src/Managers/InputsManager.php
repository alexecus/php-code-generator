<?php

namespace Alexecus\Spawner\Managers;

use Alexecus\Spawner\Dependencies\Container;
use Alexecus\Spawner\Input\AbstractInput;

/**
 * Handles registration of input classes
 */
class InputsManager
{
    /**
     * Defines the available inputs
     *
     * @var array
     */
    private $inputs = [];

    /**
     * Adds a new input class
     *
     * @param string $id The ID of the input
     * @param string $instance The input class instance
     */
    public function setInput($id, AbstractInput $instance)
    {
        $this->inputs[$id] = $instance;
    }

    /**
     * Checks if the input exists
     *
     * @param string $id The input ID
     *
     * @return boolean
     */
    public function hasInput($id)
    {
        return isset($this->inputs[$id]);
    }

    /**
     * Gets a single input
     * 
     * @param string $id The input ID
     *
     * @return AbstractInput
     */
    public function getInput($id)
    {
        return $this->inputs[$id] ?? null;
    }

    /**
     * Gets all registered inputs
     *
     * @return array
     */
    public function getInputs()
    {
        return $this->inputs;
    }
}
