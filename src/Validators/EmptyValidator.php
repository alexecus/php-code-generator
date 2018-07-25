<?php

namespace Alexecus\Spawner\Validators;

/**
 * Validates if the user input is not empty
 */
class EmptyValidator extends AbstractValidator
{
    /**
     * @{inheritdoc}
     */
    public function validate($value, $options = [])
    {
        $value = trim($value);

        return $value !== '';
    }
}
