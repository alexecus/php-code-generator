<?php

namespace Alexecus\Spawner\Command;

use Alexecus\Spawner\Managers\ValidatorsManager;

trait CommandValidators
{
    /**
     * @var ValidatorsManager
     */
    protected $validators;

    /**
     *
     */
    public function setValidators(ValidatorsManager $validators)
    {
        $this->validators = $validators;
    }

    /**
     *
     */
    public function validate($id, $value, $options = [])
    {
        $validator = $this->validators->getValidator($id);

        return $validator->validate($value, $options);
    }
}
