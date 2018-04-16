<?php

namespace App\Command;

use Symfony\Component\Console\Question\Question;

use App\Input\AskCommand;

trait CommandTrait
{
    /**
     *
     */
    public function ask($message, $default, $validators = [], $normalizers = [])
    {
        $command = new AskCommand($this->style);

        return $command->ask($message, $default, $validators, $normalizers);
    }

    /**
     *
     */
    public function confirm($message)
    {
        return $this->style->confirm($message);
    }

    /**
     *
     */
    public function success($message)
    {
        return $this->style->success($message);
    }

    /**
     *
     */
    public function warning($message)
    {
        return $this->style->warning($message);
    }

    /**
     *
     */
    public function error($message)
    {
        return $this->style->error($message);
    }
}
