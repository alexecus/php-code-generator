<?php

namespace Alexecus\Spawner\Definition;

use ReflectionMethod;
use RuntimeException;

trait DefinitionInputs
{
    public function handleInput($name, $options)
    {
        $instance = $this->input($name);

        if ($instance) {
            $arguments = [];

            $params = (new ReflectionMethod($instance, 'perform'))->getParameters();

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

            $return = $instance->perform(...$arguments);

            // terminate directive
            // if a terminate directive is present then stop script execution
            if (!empty($options['terminate']) && !$return) {
                exit;
            }

            return $return;
        }
    }
}
