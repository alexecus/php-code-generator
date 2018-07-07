<?php

namespace Alexecus\Spawner\Command;

use Alexecus\Spawner\Managers\NormalizerManager;

trait CommandNormalizers
{
    /**
     * @var NormalizerManager
     */
    protected $normalizers;

    /**
     *
     */
    public function setNormalizers(NormalizerManager $normalizers)
    {
        $this->normalizers = $normalizers;
    }

    /**
     *
     */
    public function normalize($id, $value)
    {
        return $this->normalizers->getNormalizer($id)->normalize($value);
    }
}
