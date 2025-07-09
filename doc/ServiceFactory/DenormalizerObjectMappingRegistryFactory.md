# DenormalizerObjectMappingRegistryFactory

## without name (default)

```php
<?php

use Jobcloud\Deserialization\Mapping\DenormalizationObjectMappingInterface;
use Jobcloud\Deserialization\ServiceFactory\DenormalizerObjectMappingRegistryFactory;
use Psr\Container\ContainerInterface;

/** @var ContainerInterface $container */
$container = ...;

// $container->get(DenormalizationObjectMappingInterface::class.'[]')

$factory = new DenormalizerObjectMappingRegistryFactory();

$denormalizerObjectMappingRegistry = $factory($container);
```

## with name `default`

```php
<?php

use Jobcloud\Deserialization\Mapping\DenormalizationObjectMappingInterface;
use Jobcloud\Deserialization\ServiceFactory\DenormalizerObjectMappingRegistryFactory;
use Psr\Container\ContainerInterface;

/** @var ContainerInterface $container */
$container = ...;

// $container->get(DenormalizationObjectMappingInterface::class.'[]default')

$factory = [DenormalizerObjectMappingRegistryFactory::class, 'default'];

$denormalizerObjectMappingRegistry = $factory($container);
```
