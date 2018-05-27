<?php

namespace Alexecus\Spawner\Input;

use RuntimeException;

use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;

use Alexecus\Spawner\Managers\ValidatorsManager;

class AskCommand
{
    /**
     * @var SymfonyStyle
     */
    private $style;

    /**
     * @var ValidatorsManager
     */
    private $validators;
    
    public function __construct(SymfonyStyle $style, ValidatorsManager $validators)
    {
        $this->style = $style;
        $this->validators = $validators;
    }

    public function ask($message, $default, $validations = [])
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

        return $this->style->askQuestion($question);
    }
}
