<?php

declare(strict_types=1);

namespace Jobcloud\Tests\Deserialization\Unit\Mapping;

use Jobcloud\Deserialization\Mapping\CallableDenormalizationObjectMapping;
use Jobcloud\Deserialization\Mapping\DenormalizationFieldMappingInterface;
use Jobcloud\Deserialization\Mapping\DenormalizationObjectMappingInterface;
use Chubbyphp\Mock\MockMethod\WithReturn;
use Chubbyphp\Mock\MockObjectBuilder;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Jobcloud\Deserialization\Mapping\CallableDenormalizationObjectMapping
 *
 * @internal
 */
final class CallableDenormalizationObjectMappingTest extends TestCase
{
    public function testGetClass(): void
    {
        $mapping = new CallableDenormalizationObjectMapping(\stdClass::class, static function (): void {});

        self::assertSame(\stdClass::class, $mapping->getClass());
    }

    public function testGetDenormalizationFactory(): void
    {
        $object = new \stdClass();
        $builder = new MockObjectBuilder();

        $mapping = new CallableDenormalizationObjectMapping(
            \stdClass::class,
            static fn () => $builder->create(DenormalizationObjectMappingInterface::class, [
                new WithReturn('getDenormalizationFactory', ['path', null], static fn () => $object),
            ])
        );

        $factory = $mapping->getDenormalizationFactory('path');

        self::assertInstanceOf(\Closure::class, $factory);

        self::assertSame($object, $factory());
    }

    public function testGetDenormalizationFieldMappings(): void
    {
        $builder = new MockObjectBuilder();

        /** @var DenormalizationFieldMappingInterface $fieldMapping */
        $fieldMapping = $builder->create(DenormalizationFieldMappingInterface::class, []);

        $mapping = new CallableDenormalizationObjectMapping(
            \stdClass::class,
            static fn () => $builder->create(DenormalizationObjectMappingInterface::class, [
                new WithReturn('getDenormalizationFieldMappings', ['path', null], [$fieldMapping]),
            ])
        );

        self::assertSame($fieldMapping, $mapping->getDenormalizationFieldMappings('path')[0]);
    }
}
