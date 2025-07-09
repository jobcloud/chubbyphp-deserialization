# Denormalizer

```php
<?php

use Jobcloud\Deserialization\Denormalizer\Denormalizer;
use Jobcloud\Deserialization\Denormalizer\DenormalizerObjectMappingRegistry;
use MyProject\Deserialization\ModelMapping;
use MyProject\Model\Model;

$logger = ...;

$denormalizer = new Denormalizer(
    new DenormalizerObjectMappingRegistry([
        new ModelMapping()
    ]),
    $logger
);

$model = $denormalizer->denormalize(
    Model::class,
    ['name' => 'php']
);

echo $model->getName();
// 'php'
```
