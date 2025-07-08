<?php

declare(strict_types=1);

namespace Jobcloud\Deserialization\ServiceFactory;

use Jobcloud\Deserialization\Mapping\DenormalizationFieldMappingFactory;
use Jobcloud\Deserialization\Mapping\DenormalizationFieldMappingFactoryInterface;
use Chubbyphp\Laminas\Config\Factory\AbstractFactory;
use Psr\Container\ContainerInterface;

final class DenormalizationFieldMappingFactoryFactory extends AbstractFactory
{
    public function __invoke(ContainerInterface $container): DenormalizationFieldMappingFactoryInterface
    {
        return new DenormalizationFieldMappingFactory();
    }
}
