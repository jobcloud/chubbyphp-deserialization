# EmbedOneFieldDenormalizer

```php
<?php

use Jobcloud\Deserialization\Accessor\PropertyAccessor;
use Jobcloud\Deserialization\Denormalizer\Relation\EmbedOneFieldDenormalizer;
use MyProject\Model\Model;
use MyProject\Model\ReferenceModel;

$model = new Model;
$context = ...;
$denormalizer = ...;

$fieldDenormalizer = new EmbedOneFieldDenormalizer(
    ReferenceModel::class,
    new PropertyAccessor('children')
);

$fieldDenormalizer->denormalizeField(
    'reference',
    $model,
    ['name' => 'php'],
    $context,
    $denormalizer
);

echo $model
    ->getReference()
    ->getName();
// 'php'
```
