# FieldDenormalizer

```php
<?php

use Jobcloud\Deserialization\Accessor\PropertyAccessor;
use Jobcloud\Deserialization\Denormalizer\FieldDenormalizer;
use MyProject\Model\Model;

$model = new Model;
$context = ...;

$fieldDenormalizer = new FieldDenormalizer(
    new PropertyAccessor('name')
);

$fieldDenormalizer->denormalizeField(
    'name',
    $model,
    'php',
    $context
);

echo $model->getName();
// 'php'

// empty to null
$fieldDenormalizer = new FieldDenormalizer(
    new PropertyAccessor('name'),
    true
);

$fieldDenormalizer->denormalizeField(
    'name',
    $model,
    '',
    $context
);

echo $model->getName();
// null
```
