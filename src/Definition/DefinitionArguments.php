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
            $rules = [];
            list($string, $match) = $matches;

            $definition = explode(':', $match);

            if (count($definition) === 2) {
                list($match, $rules) = $definition;
            }

            $value = isset($vars[$match]) ? $vars[$match] : $string;

            if (!empty($rules)) {
                $ruleset = $this->doExtractRules($rules);

                foreach ($ruleset as $rule) {
                    $value = $this->normalize($rule, $value);
                }
            }

            return $value;
        }, $value);
    }

    private function doExtractRules($rules)
    {
        $rules = trim($rules, '()');
        $ruleset = explode(',', $rules);

        return array_map('trim', $ruleset);
    }
}
