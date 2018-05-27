<?php

namespace Alexecus\Spawner\Validators;

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
