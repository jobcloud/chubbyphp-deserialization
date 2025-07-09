<?php

declare(strict_types=1);

namespace Jobcloud\Tests\Deserialization\Resources\Mapping;

use Jobcloud\Deserialization\DeserializerRuntimeException;
use Jobcloud\Deserialization\Mapping\DenormalizationFieldMappingFactory;
use Jobcloud\Deserialization\Mapping\DenormalizationFieldMappingInterface;
use Jobcloud\Deserialization\Mapping\DenormalizationObjectMappingInterface;
use Jobcloud\Tests\Deserialization\Resources\Model\OneModel;

final class OneModelMapping implements DenormalizationObjectMappingInterface
{
    public function getClass(): string
    {
        return OneModel::class;
    }

    /**
     * @throws DeserializerRuntimeException
     */
    public function getDenormalizationFactory(string $path, ?string $type = null): callable
    {
        return static fn () => new OneModel();
    }

    /**
     * @return array<int, DenormalizationFieldMappingInterface>
     *
     * @throws DeserializerRuntimeException
     */
    public function getDenormalizationFieldMappings(string $path, ?string $type = null): array
    {
        $denormalizationFieldMappingFactory = new DenormalizationFieldMappingFactory();

        return [
            $denormalizationFieldMappingFactory->create('name'),
            $denormalizationFieldMappingFactory->create('value'),
        ];
    }
}
