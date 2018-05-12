<?php

namespace Alexecus\Spawner\Definition;

use \ReflectionMethod;

trait DefinitionCommandInputs
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
                    }

                    // throw an exception here
                }
            }

            return $this->$name(...$arguments);
        }
    }
}
