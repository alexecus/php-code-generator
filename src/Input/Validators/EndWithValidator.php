<?php

namespace Alexecus\Spawner\Input\Validators;

class EndsWithValidator extends AbstractValidator
{
    /**
     * @{inheritdoc}
     */
    public function validate($value, $options)
    {
        list($needle) = $options;

        $length = strlen($needle);

        return $length === 0 || substr($value, -$length) === $needle;
    }
}
