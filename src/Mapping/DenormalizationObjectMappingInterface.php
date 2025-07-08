<?php

declare(strict_types=1);

namespace Jobcloud\Deserialization\Mapping;

use Jobcloud\Deserialization\DeserializerRuntimeException;

interface DenormalizationObjectMappingInterface
{
    public function getClass(): string;

    /**
     * @throws DeserializerRuntimeException
     */
    public function getDenormalizationFactory(string $path, ?string $type = null): callable;

    /**
     * @return array<int, DenormalizationFieldMappingInterface>
     *
     * @throws DeserializerRuntimeException
     */
    public function getDenormalizationFieldMappings(string $path, ?string $type = null): array;
}
