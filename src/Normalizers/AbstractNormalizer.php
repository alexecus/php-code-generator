<?php

namespace Alexecus\Spawner\Normalizers;

abstract class AbstractNormalizer
{
    /**
     * Normalizes a given string
     *
     * @param string $value
     * @return string
     */
    abstract public function normalize($value);
}
