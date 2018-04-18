<?php

namespace Alexecus\Spawner\Input\Validators;

abstract class AbstractValidator
{
    /**
     * Validate against a value
     *
     * @param string $value
     * @return boolean
     */
    abstract public function validate($value);

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function getMessage()
    {
        return $this->message;
    }
}
