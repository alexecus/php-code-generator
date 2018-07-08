<?php

namespace Alexecus\Spawner\Validators;

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
