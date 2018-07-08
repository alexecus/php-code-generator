<?php

namespace Alexecus\Spawner\Definition;

use ReflectionMethod;
use RuntimeException;

use Alexecus\Spawner\Resolver\PathResource;

trait DefinitionOperations
{
    public function handleOperation($name, $options, $vars)
    {
        $instance = $this->operation($name);

        if ($instance) {
            $arguments = [];

            $instance = $this->operation($name);
            $params = (new ReflectionMethod($instance, 'perform'))->getParameters();

            foreach ($params as $param) {
                $key = $param->getName();

                if (isset($options[$key])) {
                    if ($param->getClass() && $param->getClass()->name === PathResource::class) {
                        $arguments[] = new PathResource($options[$key], $this->root);
                        continue;
                    }

                    $arguments[] = $options[$key];
                } else {
                    if ($param->isDefaultValueAvailable()) {
                        $arguments[] = $param->getDefaultValue();
                        continue;
                    }

                    new RuntimeException("Missing argument `$key` for definition `$name`");
                }
            }

            $instance->perform(...$arguments);
        }
    }
}
