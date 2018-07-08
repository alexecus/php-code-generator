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
        $normalizer = $this->normalizers->getNormalizer($id);

        // check if we have a registered normalizer with the specified ID
        // if not just check if the a php method of that name exists and use
        // that instead
        if ($normalizer) {
            $value = $normalizer->normalize($value);
        } elseif (function_exists($id)) {
            $value = $id($value);
        }

        return $value;
    }
}
