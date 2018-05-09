<?php

namespace Alexecus\Spawner\Input\Validators;

class StartsWithValidator extends AbstractValidator
{
    /**
     * @{inheritdoc}
     */
    public function validate($value, $options)
    {
        list($needle) = $options;

        $length = strlen($needle);

        return substr($value, 0, $length) === $needle;
    }
}
