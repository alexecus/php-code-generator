<?php

namespace Alexecus\Spawner\App;

use Alexecus\Spawner\Operations\Append;
use Alexecus\Spawner\Operations\Copy;
use Alexecus\Spawner\Operations\Template;

/**
 *
 */
trait OperationsTrait
{
    /**
     * Defines the available operations
     *
     * @var array
     */
    private $operations = [
        'copy' => Copy::class,
        'append' => Append::class,
        'template' => Template::class,
    ];

    /**
     * Adds a new operation class
     *
     * @param string $id The ID of this operation
     * @param string $class The fully qualified class namespace
     */
    public function setOperation($id, $class)
    {
        $this->operations[$id] = $class;
    }

    /**
     * Gets all registered operations
     *
     * @return array
     */
    public function getOperations()
    {
        return $this->operations;
    }
}
