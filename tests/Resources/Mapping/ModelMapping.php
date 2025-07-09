<?php

declare(strict_types=1);

namespace Jobcloud\Tests\Deserialization\Resources\Mapping;

use Jobcloud\Deserialization\DeserializerRuntimeException;
use Jobcloud\Deserialization\Mapping\DenormalizationFieldMappingFactory;
use Jobcloud\Deserialization\Mapping\DenormalizationFieldMappingInterface;
use Jobcloud\Deserialization\Mapping\DenormalizationObjectMappingInterface;
use Jobcloud\Tests\Deserialization\Resources\Model\AbstractManyModel;
use Jobcloud\Tests\Deserialization\Resources\Model\Model;
use Jobcloud\Tests\Deserialization\Resources\Model\OneModel;

final class ModelMapping implements DenormalizationObjectMappingInterface
{
    public function getClass(): string
    {
        return Model::class;
    }

    /**
     * @throws DeserializerRuntimeException
     */
    public function getDenormalizationFactory(string $path, ?string $type = null): callable
    {
        return static fn () => new Model();
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
            $denormalizationFieldMappingFactory->createEmbedOne('one', OneModel::class),
            $denormalizationFieldMappingFactory->createEmbedMany('manies', AbstractManyModel::class),
        ];
    }
}
