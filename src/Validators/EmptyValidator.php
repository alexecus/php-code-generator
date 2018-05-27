<?php

namespace Alexecus\Spawner\Validators;

class EmptyValidator extends AbstractValidator
{
    /**
     * @{inheritdoc}
     */
    public function validate($value, $options = [])
    {
        return !empty($value);
    }
}
