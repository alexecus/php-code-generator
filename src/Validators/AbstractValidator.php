<?php

namespace Alexecus\Spawner\Validators;

abstract class AbstractValidator
{
    /**
     * Validate against a value
     *
     * @param string $value
     * @return boolean
     */
    abstract public function validate($value, $options = []);
}
