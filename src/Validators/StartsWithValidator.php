<?php

namespace Alexecus\Spawner\Validators;

/**
 * Validate that the user input starts with a certain string
 */
class StartsWithValidator extends AbstractValidator
{
    /**
     * @{inheritdoc}
     */
    public function validate($value, $options = [])
    {
        $needle = $options[0];
        $length = strlen($needle);

        return substr($value, 0, $length) === $needle;
    }
}
