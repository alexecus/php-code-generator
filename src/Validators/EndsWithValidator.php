<?php

namespace Alexecus\Spawner\Validators;

/**
 * Validate that the user input ends in a certain string
 */
class EndsWithValidator extends AbstractValidator
{
    /**
     * @{inheritdoc}
     */
    public function validate($value, $options = [])
    {
        $needle = $options[0];
        $length = strlen($needle);

        return $length === 0 || substr($value, -$length) === $needle;
    }
}
