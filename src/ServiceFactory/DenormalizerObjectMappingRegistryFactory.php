<?php

declare(strict_types=1);

namespace Jobcloud\Deserialization\ServiceFactory;

use Jobcloud\Deserialization\Denormalizer\DenormalizerObjectMappingRegistry;
use Jobcloud\Deserialization\Denormalizer\DenormalizerObjectMappingRegistryInterface;
use Jobcloud\Deserialization\Mapping\DenormalizationObjectMappingInterface;
use Chubbyphp\Laminas\Config\Factory\AbstractFactory;
use Psr\Container\ContainerInterface;

final class DenormalizerObjectMappingRegistryFactory extends AbstractFactory
{
    public function __invoke(ContainerInterface $container): DenormalizerObjectMappingRegistryInterface
    {
        return new DenormalizerObjectMappingRegistry(
            $container->get(DenormalizationObjectMappingInterface::class.'[]'.$this->name)
        );
    }
}
