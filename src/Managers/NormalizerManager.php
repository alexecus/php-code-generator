<?php

namespace Alexecus\Spawner\Managers;

use Alexecus\Spawner\Dependencies\Container;
use Alexecus\Spawner\Normalizers\AbstractNormalizer;

/**
 * Handles registration of normalizer classes
 */
class NormalizerManager
{
    /**
     * Defines the available normalizers
     *
     * @var array
     */
    private $normalizers = [];

    /**
     * Adds a new normalizer class
     *
     * @param string $id The ID of this normalizer
     * @param string $instance The normalizer class instance
     */
    public function setNormalizer($id, AbstractNormalizer $instance)
    {
        $this->normalizers[$id] = $instance;
    }

    /**
     * Checks if the normalizer exists
     *
     * @param string $id The normalizer ID
     *
     * @return boolean
     */
    public function hasNormalizer($id)
    {
        return isset($this->normalizers[$id]);
    }

    /**
     * Gets a single normalizer
     * 
     * @param string $id The normalizer ID
     *
     * @return AbstractNormalizer
     */
    public function getNormalizer($id)
    {
        return $this->normalizers[$id] ?? null;
    }

    /**
     * Gets all registered normalizers
     *
     * @return array
     */
    public function getnormalizers()
    {
        return $this->normalizers;
    }
}
