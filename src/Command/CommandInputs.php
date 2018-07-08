<?php

namespace Alexecus\Spawner\Command;

use Alexecus\Spawner\Managers\InputsManager;

trait CommandInputs
{
    /**
     * @var InputsManager
     */
    protected $inputs;

    /**
     *
     */
    public function setInputs(InputsManager $inputs)
    {
        $this->inputs = $inputs;
    }

    /**
     * Get the specific input instance
     *
     * @param string $id The input ID
     * @return void
     */
    public function input($id)
    {
        $input = $this->inputs->getInput($id);

        $input->setOutput($this->style);
        $input->setValidators($this->validators);

        return $input;
    }
}
