<?php

declare(strict_types=1);

namespace Jobcloud\Deserialization\Mapping;

use Jobcloud\Deserialization\Accessor\PropertyAccessor;
use Jobcloud\Deserialization\Denormalizer\CallbackFieldDenormalizer;
use Jobcloud\Deserialization\Denormalizer\ConvertTypeFieldDenormalizer;
use Jobcloud\Deserialization\Denormalizer\DateTimeImmutableFieldDenormalizer;
use Jobcloud\Deserialization\Denormalizer\FieldDenormalizer;
use Jobcloud\Deserialization\Denormalizer\FieldDenormalizerInterface;
use Jobcloud\Deserialization\Denormalizer\Relation\EmbedManyFieldDenormalizer;
use Jobcloud\Deserialization\Denormalizer\Relation\EmbedOneFieldDenormalizer;
use Jobcloud\Deserialization\Denormalizer\Relation\ReferenceManyFieldDenormalizer;
use Jobcloud\Deserialization\Denormalizer\Relation\ReferenceOneFieldDenormalizer;
use Jobcloud\Deserialization\Policy\NullPolicy;
use Jobcloud\Deserialization\Policy\PolicyInterface;

final class DenormalizationFieldMappingFactory implements DenormalizationFieldMappingFactoryInterface
{
    public function create(
        string $name,
        bool $emptyToNull = false,
        ?FieldDenormalizerInterface $fieldDenormalizer = null,
        ?PolicyInterface $policy = null
    ): DenormalizationFieldMappingInterface {
        if (!$fieldDenormalizer instanceof FieldDenormalizerInterface) {
            $fieldDenormalizer = new FieldDenormalizer(new PropertyAccessor($name), $emptyToNull);
        }

        return $this->getMapping($fieldDenormalizer, $name, $policy);
    }

    public function createCallback(
        string $name,
        callable $callback,
        ?PolicyInterface $policy = null
    ): DenormalizationFieldMappingInterface {
        $fieldDenormalizer = new CallbackFieldDenormalizer($callback);

        return $this->getMapping($fieldDenormalizer, $name, $policy);
    }

    public function createConvertType(
        string $name,
        string $type,
        bool $emptyToNull = false,
        ?PolicyInterface $policy = null
    ): DenormalizationFieldMappingInterface {
        $fieldDenormalizer = new ConvertTypeFieldDenormalizer(new PropertyAccessor($name), $type, $emptyToNull);

        return $this->getMapping($fieldDenormalizer, $name, $policy);
    }

    public function createDateTimeImmutable(
        string $name,
        bool $emptyToNull = false,
        ?\DateTimeZone $dateTimeZone = null,
        ?PolicyInterface $policy = null
    ): DenormalizationFieldMappingInterface {
        $fieldDenormalizer = new DateTimeImmutableFieldDenormalizer(
            new PropertyAccessor($name),
            $emptyToNull,
            $dateTimeZone
        );

        return $this->getMapping($fieldDenormalizer, $name, $policy);
    }

    public function createEmbedMany(
        string $name,
        string $class,
        ?PolicyInterface $policy = null
    ): DenormalizationFieldMappingInterface {
        $fieldDenormalizer = new EmbedManyFieldDenormalizer($class, new PropertyAccessor($name));

        return $this->getMapping($fieldDenormalizer, $name, $policy);
    }

    public function createEmbedOne(
        string $name,
        string $class,
        ?PolicyInterface $policy = null
    ): DenormalizationFieldMappingInterface {
        $fieldDenormalizer = new EmbedOneFieldDenormalizer($class, new PropertyAccessor($name));

        return $this->getMapping($fieldDenormalizer, $name, $policy);
    }

    public function createReferenceMany(
        string $name,
        callable $repository,
        ?PolicyInterface $policy = null
    ): DenormalizationFieldMappingInterface {
        $fieldDenormalizer = new ReferenceManyFieldDenormalizer($repository, new PropertyAccessor($name));

        return $this->getMapping($fieldDenormalizer, $name, $policy);
    }

    public function createReferenceOne(
        string $name,
        callable $repository,
        bool $emptyToNull = false,
        ?PolicyInterface $policy = null
    ): DenormalizationFieldMappingInterface {
        $fieldDenormalizer = new ReferenceOneFieldDenormalizer(
            $repository,
            new PropertyAccessor($name),
            $emptyToNull
        );

        return $this->getMapping($fieldDenormalizer, $name, $policy);
    }

    private function getMapping(
        FieldDenormalizerInterface $fieldDenormalizer,
        string $name,
        ?PolicyInterface $policy = null
    ): DenormalizationFieldMappingInterface {
        return new DenormalizationFieldMapping(
            $name,
            $fieldDenormalizer,
            $policy ?? new NullPolicy()
        );
    }
}
