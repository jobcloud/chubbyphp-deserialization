# ReferenceOneFieldDenormalizer

```php
<?php

use Jobcloud\Deserialization\Accessor\PropertyAccessor;
use Jobcloud\Deserialization\Denormalizer\Relation\ReferenceOneFieldDenormalizer;
use MyProject\Model\Model;
use MyProject\Model\ReferenceModel;

$model = new Model;
$context = ...;
$denormalizer = ...;

$fieldDenormalizer = new ReferenceOneFieldDenormalizer(
    function (string $id) {
        return;
    },
    new PropertyAccessor('children')
);

$fieldDenormalizer->denormalizeField(
    'reference',
    $model,
    '60a9ee14-64d6-4992-8042-8d1528ac02d6',
    $context,
    $denormalizer
);

echo $model
    ->getReference()
    ->getName();
// 'php'

// empty to null
$fieldDenormalizer = new ReferenceOneFieldDenormalizer(
    function (string $id) {
        return;
    },
    new PropertyAccessor('children'),
    true
);

$fieldDenormalizer->denormalizeField(
    'reference',
    $model,
    '',
    $context,
    $denormalizer
);

echo $model->getReference();
// null
```
