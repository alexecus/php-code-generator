<?php

namespace Alexecus\Spawner\Managers;

use Alexecus\Spawner\Dependencies\Container;
use Alexecus\Spawner\Validators\AbstractValidator;

/**
 * Handles registration of operation classes
 */
class ValidatorsManager
{
    /**
     * Defines the available validators
     *
     * @var array
     */
    private $validators = [];

    /**
     * Adds a new operation class
     *
     * @param string $id The ID of this validator
     * @param string $instance The validator class instance
     */
    public function setValidator($id, AbstractValidator $instance)
    {
        $this->validators[$id] = $instance;
    }

    /**
     * Checks if the validator exists
     *
     * @param string $id The validator ID
     *
     * @return boolean
     */
    public function hasValidator($id)
    {
        return isset($this->validators[$id]);
    }

    /**
     * Gets a single validator
     * 
     * @param string $id The validator ID
     *
     * @return AbstractValidator
     */
    public function getValidator($id)
    {
        return $this->validators[$id] ?? null;
    }

    /**
     * Gets all registered validators
     *
     * @return array
     */
    public function getValidators()
    {
        return $this->validators;
    }
}
