<?php

declare(strict_types=1);

namespace Jobcloud\Tests\Deserialization\Unit\ServiceProvider;

use Chubbyphp\DecodeEncode\Decoder\Decoder;
use Jobcloud\Deserialization\Denormalizer\Denormalizer;
use Jobcloud\Deserialization\Denormalizer\DenormalizerObjectMappingRegistry;
use Jobcloud\Deserialization\Deserializer;
use Jobcloud\Deserialization\Mapping\DenormalizationFieldMappingFactory;
use Jobcloud\Deserialization\ServiceProvider\DeserializationServiceProvider;
use Chubbyphp\Mock\MockObjectBuilder;
use PHPUnit\Framework\TestCase;
use Pimple\Container;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

/**
 * @covers \Jobcloud\Deserialization\ServiceProvider\DeserializationServiceProvider
 *
 * @internal
 */
final class DeserializationServiceProviderTest extends TestCase
{
    public function testRegister(): void
    {
        $container = new Container();
        $container->register(new DeserializationServiceProvider());

        self::assertTrue(isset($container['deserializer']));

        self::assertTrue(isset($container['deserializer.decoder']));
        self::assertTrue(isset($container['deserializer.decodertypes']));

        self::assertTrue(isset($container['deserializer.denormalizer']));
        self::assertTrue(isset($container['deserializer.denormalizer.fieldmappingfactory']));
        self::assertTrue(isset($container['deserializer.denormalizer.objectmappingregistry']));
        self::assertTrue(isset($container['deserializer.denormalizer.objectmappings']));

        self::assertInstanceOf(Deserializer::class, $container['deserializer']);

        self::assertInstanceOf(Decoder::class, $container['deserializer.decoder']);
        self::assertIsArray($container['deserializer.decodertypes']);

        self::assertInstanceOf(
            DenormalizationFieldMappingFactory::class,
            $container['deserializer.denormalizer.fieldmappingfactory']
        );

        self::assertInstanceOf(
            DenormalizerObjectMappingRegistry::class,
            $container['deserializer.denormalizer.objectmappingregistry']
        );

        self::assertIsArray($container['deserializer.denormalizer.objectmappings']);

        /** @var Denormalizer $denormalizer */
        $denormalizer = $container['deserializer.denormalizer'];

        self::assertInstanceOf(Denormalizer::class, $denormalizer);

        $reflectionProperty = new \ReflectionProperty($denormalizer, 'logger');
        $reflectionProperty->setAccessible(true);

        self::assertInstanceOf(NullLogger::class, $reflectionProperty->getValue($denormalizer));
    }

    public function testRegisterWithDefinedLogger(): void
    {
        $builder = new MockObjectBuilder();

        /** @var LoggerInterface $logger */
        $logger = $builder->create(LoggerInterface::class, []);

        $container = new Container([
            'logger' => $logger,
        ]);

        $container->register(new DeserializationServiceProvider());

        /** @var Denormalizer $denormalizer */
        $denormalizer = $container['deserializer.denormalizer'];

        self::assertInstanceOf(Denormalizer::class, $denormalizer);

        $reflectionProperty = new \ReflectionProperty($denormalizer, 'logger');
        $reflectionProperty->setAccessible(true);

        self::assertSame($logger, $reflectionProperty->getValue($denormalizer));
    }
}
