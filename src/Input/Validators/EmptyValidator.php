<?php

namespace App\Input\Validators;

class EmptyValidator extends AbstractValidator
{
    /**
     * @{inheritdoc}
     */
    public function validate($value)
    {
        return !empty($value);
    }
}
