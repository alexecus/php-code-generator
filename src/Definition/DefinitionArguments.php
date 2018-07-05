<?php

namespace Alexecus\Spawner\Definition;

use ReflectionMethod;
use RuntimeException;

trait DefinitionArguments
{
    private function resolveArguments($options, $vars)
    {
        $result = [];

        foreach ($options as $key => $value) {
            $key = $this->doReplaceArguments($key, $vars);

            if (is_array($value)) {
                $result[$key] = $this->resolveArguments($value, $vars);
            } elseif (is_string($value)) {
                $result[$key] = $this->doReplaceArguments($value, $vars);
            }
        }

        return $result;
    }

    private function doReplaceArguments($value, $vars)
    {
        return preg_replace_callback('/\$\{(.*?)\}/', function ($matches) use ($vars) {
            list($string, $match) = $matches;

            return isset($vars[$match]) ? $vars[$match] : $string;
        }, $value);
    }
}
