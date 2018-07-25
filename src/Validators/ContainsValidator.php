<?php

namespace Alexecus\Spawner\Validators;

/**
 * Validates if the user input contains the desired string
 */
class ContainsValidator extends AbstractValidator
{
    /**
     * @{inheritdoc}
     */
    public function validate($value, $options = [])
    {
        $needle = $options[0];

        return strpos($value, $needle) !== false;
    }
}
