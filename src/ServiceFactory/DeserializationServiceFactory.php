<?php

declare(strict_types=1);

namespace Jobcloud\Deserialization\ServiceFactory;

use Chubbyphp\DecodeEncode\Decoder\Decoder;
use Jobcloud\Deserialization\Denormalizer\Denormalizer;
use Jobcloud\Deserialization\Denormalizer\DenormalizerObjectMappingRegistry;
use Jobcloud\Deserialization\Deserializer;
use Jobcloud\Deserialization\Mapping\DenormalizationFieldMappingFactory;
use Psr\Container\ContainerInterface;

final class DeserializationServiceFactory
{
    /**
     * @return array<string, callable>
     */
    public function __invoke(): array
    {
        return [
            'deserializer' => static fn (ContainerInterface $container) => new Deserializer(
                $container->get('deserializer.decoder'),
                $container->get('deserializer.denormalizer')
            ),
            'deserializer.decoder' => static fn (ContainerInterface $container) => new Decoder($container->get('deserializer.decodertypes')),
            'deserializer.decodertypes' => static fn () => [],
            'deserializer.denormalizer' => static fn (ContainerInterface $container) => new Denormalizer(
                $container->get('deserializer.denormalizer.objectmappingregistry'),
                $container->has('logger') ? $container->get('logger') : null
            ),
            'deserializer.denormalizer.fieldmappingfactory' => static fn () => new DenormalizationFieldMappingFactory(),
            'deserializer.denormalizer.objectmappingregistry' => static fn (ContainerInterface $container) => new DenormalizerObjectMappingRegistry(
                $container->get('deserializer.denormalizer.objectmappings')
            ),
            'deserializer.denormalizer.objectmappings' => static fn () => [],
        ];
    }
}
