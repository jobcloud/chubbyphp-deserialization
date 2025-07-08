<?php

declare(strict_types=1);

namespace Jobcloud\Tests\Deserialization\Resources\Mapping;

use Jobcloud\Deserialization\DeserializerRuntimeException;
use Jobcloud\Deserialization\Mapping\DenormalizationFieldMappingInterface;
use Jobcloud\Deserialization\Mapping\DenormalizationObjectMappingInterface;
use Jobcloud\Tests\Deserialization\Resources\Model\AbstractManyModel;

final class BaseManyModelMapping implements DenormalizationObjectMappingInterface
{
    public function __construct(private ManyModelMapping $modelMapping, private array $supportedTypes) {}

    public function getClass(): string
    {
        return AbstractManyModel::class;
    }

    /**
     * @throws DeserializerRuntimeException
     */
    public function getDenormalizationFactory(string $path, ?string $type = null): callable
    {
        if (null === $type) {
            throw DeserializerRuntimeException::createMissingObjectType($path, $this->supportedTypes);
        }

        if ('many-model' === $type) {
            return $this->modelMapping->getDenormalizationFactory($path);
        }

        throw DeserializerRuntimeException::createInvalidObjectType($path, $type, $this->supportedTypes);
    }

    /**
     * @return array<int, DenormalizationFieldMappingInterface>
     *
     * @throws DeserializerRuntimeException
     */
    public function getDenormalizationFieldMappings(string $path, ?string $type = null): array
    {
        if (null === $type) {
            throw DeserializerRuntimeException::createMissingObjectType($path, $this->supportedTypes);
        }

        if ('many-model' === $type) {
            return $this->modelMapping->getDenormalizationFieldMappings($path);
        }

        throw DeserializerRuntimeException::createInvalidObjectType($path, $type, $this->supportedTypes);
    }
}
