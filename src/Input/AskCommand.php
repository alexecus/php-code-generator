<?php

namespace Alexecus\Spawner\Input;

use Symfony\Component\Console\Question\Question;

use Alexecus\Spawner\Input\Validators\EmptyValidator;

class AskCommand
{
    /**
     * Defines the available validators
     *
     * @var array
     */
    const VALIDATORS = [
        'empty' => EmptyValidator::class,
    ];

    public function __construct($style)
    {
        $this->style = $style;
    }

    public function ask($message, $default, $validators = [], $normalizers = [])
    {
        $question = new Question($message, $default);

        foreach ($validators as $key => $validator) {
            if (isset(self::VALIDATORS[$key]) && isset($validator['message'])) {
                $class = self::VALIDATORS[$key];
                $instance = new $class($validator['message']);

                $options = $validator['options'] ?? [];

                $question->setValidator(function ($answer) use ($instance, $options) {
                    $valid = $instance->validate($answer, $options);
                    $message = $instance->getMessage();

                    if (!$valid) {
                        throw new \RuntimeException($message);
                    }

                    return $answer;
                });
            }
        }

        return $this->style->askQuestion($question);
    }
}
