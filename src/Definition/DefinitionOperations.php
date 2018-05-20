<?php

namespace Alexecus\Spawner\Definition;

use Alexecus\Spawner\Resolver\PathResource;
use \ReflectionMethod;
use SebastianBergmann\CodeCoverage\RuntimeException;

trait DefinitionOperations
{
    public function handleOperation($name, $options, $vars)
    {
        if ($this->hasOperation($name)) {
            $arguments = [];

            // Code for the IF directive
            if (isset($options['if'])) {
                $condition = $options['if'];

                if (isset($vars[$condition]) && !$vars[$condition]) {
                    return;
                }
            }

            $instance = $this->operation($name);
            $options = $this->handleReplacements($options, $vars);

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

                    new \RuntimeException("Missing argument `$key` for definition `$name`");
                }
            }

            $instance->perform(...$arguments);
        }
    }

    private function handleReplacements($options, $vars)
    {
        $result = [];

        foreach ($options as $key => $value) {
            if (is_array($value)) {
                $result[$key] = $this->handleReplacements($value, $vars);
            } elseif (is_string($value)) {
                $result[$key] = preg_replace_callback('/\$\{(.*?)\}/', function ($matches) use ($vars) {
                    list($string, $match) = $matches;

                    return isset($vars[$match]) ? $vars[$match] : $string;
                }, $value);
            }
        }

        return $result;
    }
}
