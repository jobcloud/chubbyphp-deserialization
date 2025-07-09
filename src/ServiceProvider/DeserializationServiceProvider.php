<?php

declare(strict_types=1);

namespace Jobcloud\Deserialization\ServiceProvider;

use Chubbyphp\DecodeEncode\Decoder\Decoder;
use Jobcloud\Deserialization\Denormalizer\Denormalizer;
use Jobcloud\Deserialization\Denormalizer\DenormalizerObjectMappingRegistry;
use Jobcloud\Deserialization\Deserializer;
use Jobcloud\Deserialization\Mapping\DenormalizationFieldMappingFactory;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

final class DeserializationServiceProvider implements ServiceProviderInterface
{
    public function register(Container $container): void
    {
        $container['deserializer'] = static fn () => new Deserializer($container['deserializer.decoder'], $container['deserializer.denormalizer']);

        $container['deserializer.decoder'] = static fn () => new Decoder($container['deserializer.decodertypes']);

        $container['deserializer.decodertypes'] = static fn () => [];

        $container['deserializer.denormalizer'] = static fn () => new Denormalizer(
            $container['deserializer.denormalizer.objectmappingregistry'],
            $container['logger'] ?? null
        );

        $container['deserializer.denormalizer.fieldmappingfactory'] = static fn () => new DenormalizationFieldMappingFactory();

        $container['deserializer.denormalizer.objectmappingregistry'] = static fn () => new DenormalizerObjectMappingRegistry($container['deserializer.denormalizer.objectmappings']);

        $container['deserializer.denormalizer.objectmappings'] = static fn () => [];
    }
}
