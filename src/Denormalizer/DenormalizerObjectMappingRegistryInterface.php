<?php

declare(strict_types=1);

namespace Jobcloud\Deserialization\Denormalizer;

use Jobcloud\Deserialization\DeserializerLogicException;
use Jobcloud\Deserialization\Mapping\DenormalizationObjectMappingInterface;

interface DenormalizerObjectMappingRegistryInterface
{
    /**
     * @throws DeserializerLogicException
     */
    public function getObjectMapping(string $class): DenormalizationObjectMappingInterface;
}
