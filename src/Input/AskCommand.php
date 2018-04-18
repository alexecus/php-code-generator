<?php

namespace Alexecus\Spawner\Input;

use Symfony\Component\Console\Question\Question;

use Alexecus\SpawnerInput\Validators\EmptyValidator;

class AskCommand
{
    public function __construct($style)
    {
        $this->style = $style;
    }

    public function ask($message, $default, $validators = [], $normalizers = [])
    {
        $question = new Question($message, $default);

        foreach ($validators as $validator) {
            $question->setValidator(function ($answer) use ($validator) {
                $valid = $validator->validate($answer);
                $message = $validator->getMessage();

                if (!$valid) {
                    throw new \RuntimeException($message);
                }

                return $answer;
            });
        }

        return $this->style->askQuestion($question);
    }
}
