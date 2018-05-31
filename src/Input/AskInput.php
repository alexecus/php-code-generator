<?php

namespace Alexecus\Spawner\Input;

use RuntimeException;

use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;

use Alexecus\Spawner\Managers\ValidatorsManager;

class AskInput extends AbstractInput
{
    public function perform($message, $default, $validations = [])
    {
        $question = new Question($message, $default);

        foreach ($validations as $key => $validation) {
            $validator = $this->validators->getValidator($key);

            if ($validator) {
                $question->setValidator(function ($answer) use ($validator, $validation) {
                    $message = $validation['message'] ?? "Failed $key validation for value $answer";
                    $options = $validation['options'] ?? [];

                    $valid = $validator->validate($answer, $options);

                    if ($validator->validate($answer, $options)) {
                        return $answer;
                    }

                    throw new RuntimeException($message);
                });
            }
        }

        return $this->output->askQuestion($question);
    }
}
