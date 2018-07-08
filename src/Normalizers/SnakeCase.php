<?php

namespace Alexecus\Spawner\Normalizers;

class SnakeCase extends AbstractNormalizer
{
    /**
     * {@inheritdoc}
     */
    public function normalize($value)
    {
        return preg_replace(['/([a-z\d])([A-Z])/', '/([^_])([A-Z][a-z])/'], '$1_$2', $value);
    }
}
