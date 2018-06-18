<?php

namespace Alexecus\Spawner\Dependencies;

use DI\ContainerBuilder;

class Container
{
    private static $container;

    /**
     * Get the service container instance
     *
     * @return \DI\Container
     */
    public static function get()
    {
        if (!static::$container) {
            $builder = new ContainerBuilder();
            $builder->useAnnotations(true);

            static::$container = $builder->build();
        }

        return static::$container;
    }

    /**
     * Resolve a service from the active container
     *
     * @param string $id The service ID
     *
     * @return any
     */
    public static function resolve($id)
    {
        return static::get()->get($id);
    }

    /**
     * Set a new container
     *
     * @param object $container
     */
    public static function set($container)
    {
        static::$container = $container;
    }
}
