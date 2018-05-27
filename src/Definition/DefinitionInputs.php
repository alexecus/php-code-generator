<?php

namespace Alexecus\Spawner\Definition;

use ReflectionMethod;
use RuntimeException;

trait DefinitionInputs
{
    public function handleInput($name, $options)
    {
        if (method_exists($this, $name)) {
            $arguments = [];

            $params = (new ReflectionMethod(self::class, $name))->getParameters();

            foreach ($params as $param) {
                $key = $param->getName();

                if (isset($options[$key])) {
                    $arguments[] = $options[$key];
                } else {
                    if ($param->isDefaultValueAvailable()) {
                        $arguments[] = $param->getDefaultValue();
                        continue;
                    }

                    new RuntimeException("Missing argument `$key` for definition `$name`");
                }
            }

            d($arguments);

            $return = $this->$name(...$arguments);

            // terminate directive
            if (!empty($options['terminate']) && !$return) {
                exit;
            } 

            return $return;
        }
    }
}
