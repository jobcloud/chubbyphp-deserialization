<?php

declare(strict_types=1);

namespace Jobcloud\Tests\Deserialization\Unit\ServiceFactory;

use Jobcloud\Deserialization\Denormalizer\DenormalizerObjectMappingRegistryInterface;
use Jobcloud\Deserialization\Mapping\DenormalizationObjectMappingInterface;
use Jobcloud\Deserialization\ServiceFactory\DenormalizerObjectMappingRegistryFactory;
use Chubbyphp\Mock\MockMethod\WithReturn;
use Chubbyphp\Mock\MockObjectBuilder;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

/**
 * @covers \Jobcloud\Deserialization\ServiceFactory\DenormalizerObjectMappingRegistryFactory
 *
 * @internal
 */
final class DenormalizerObjectMappingRegistryFactoryTest extends TestCase
{
    public function testInvoke(): void
    {
        $builder = new MockObjectBuilder();

        /** @var ContainerInterface $container */
        $container = $builder->create(ContainerInterface::class, [
            new WithReturn('get', [DenormalizationObjectMappingInterface::class.'[]'], []),
        ]);

        $factory = new DenormalizerObjectMappingRegistryFactory();

        $service = $factory($container);

        self::assertInstanceOf(DenormalizerObjectMappingRegistryInterface::class, $service);
    }

    public function testCallStatic(): void
    {
        $builder = new MockObjectBuilder();

        /** @var ContainerInterface $container */
        $container = $builder->create(ContainerInterface::class, [
            new WithReturn('get', [DenormalizationObjectMappingInterface::class.'[]default'], []),
        ]);

        $factory = [DenormalizerObjectMappingRegistryFactory::class, 'default'];

        $service = $factory($container);

        self::assertInstanceOf(DenormalizerObjectMappingRegistryInterface::class, $service);
    }
}
