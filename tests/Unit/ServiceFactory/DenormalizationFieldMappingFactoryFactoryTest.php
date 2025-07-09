<?php

declare(strict_types=1);

namespace Jobcloud\Tests\Deserialization\Unit\ServiceFactory;

use Jobcloud\Deserialization\Mapping\DenormalizationFieldMappingFactoryInterface;
use Jobcloud\Deserialization\ServiceFactory\DenormalizationFieldMappingFactoryFactory;
use Chubbyphp\Mock\MockObjectBuilder;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

/**
 * @covers \Jobcloud\Deserialization\ServiceFactory\DenormalizationFieldMappingFactoryFactory
 *
 * @internal
 */
final class DenormalizationFieldMappingFactoryFactoryTest extends TestCase
{
    public function testInvoke(): void
    {
        $builder = new MockObjectBuilder();

        /** @var ContainerInterface $container */
        $container = $builder->create(ContainerInterface::class, []);

        $factory = new DenormalizationFieldMappingFactoryFactory();

        $service = $factory($container);

        self::assertInstanceOf(DenormalizationFieldMappingFactoryInterface::class, $service);
    }

    public function testCallStatic(): void
    {
        $builder = new MockObjectBuilder();

        /** @var ContainerInterface $container */
        $container = $builder->create(ContainerInterface::class, []);

        $factory = [DenormalizationFieldMappingFactoryFactory::class, 'default'];

        $service = $factory($container);

        self::assertInstanceOf(DenormalizationFieldMappingFactoryInterface::class, $service);
    }
}
