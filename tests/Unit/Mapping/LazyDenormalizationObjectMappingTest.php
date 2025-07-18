<?php

declare(strict_types=1);

namespace Jobcloud\Tests\Deserialization\Unit\Mapping;

use Jobcloud\Deserialization\Mapping\DenormalizationFieldMappingInterface;
use Jobcloud\Deserialization\Mapping\DenormalizationObjectMappingInterface;
use Jobcloud\Deserialization\Mapping\LazyDenormalizationObjectMapping;
use Chubbyphp\Mock\MockMethod\WithReturn;
use Chubbyphp\Mock\MockObjectBuilder;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

/**
 * @covers \Jobcloud\Deserialization\Mapping\LazyDenormalizationObjectMapping
 *
 * @internal
 */
final class LazyDenormalizationObjectMappingTest extends TestCase
{
    public function testInvoke(): void
    {
        $builder = new MockObjectBuilder();

        /** @var DenormalizationFieldMappingInterface[] $denormalizationFieldMappings */
        $denormalizationFieldMappings = [$builder->create(DenormalizationFieldMappingInterface::class, [])];

        $factory = static function (): void {};

        /** @var DenormalizationObjectMappingInterface $denormalizationObjectMapping */
        $denormalizationObjectMapping = $builder->create(DenormalizationObjectMappingInterface::class, [
            new WithReturn('getDenormalizationFactory', ['path', 'type'], $factory),
            new WithReturn('getDenormalizationFieldMappings', ['path', 'type'], $denormalizationFieldMappings),
        ]);

        /** @var ContainerInterface $container */
        $container = $builder->create(ContainerInterface::class, [
            new WithReturn('get', ['service'], $denormalizationObjectMapping),
            new WithReturn('get', ['service'], $denormalizationObjectMapping),
        ]);

        $objectMapping = new LazyDenormalizationObjectMapping($container, 'service', \stdClass::class);

        self::assertEquals(\stdClass::class, $objectMapping->getClass());
        self::assertSame($factory, $objectMapping->getDenormalizationFactory('path', 'type'));
        self::assertSame($denormalizationFieldMappings, $objectMapping->getDenormalizationFieldMappings('path', 'type'));
    }
}
