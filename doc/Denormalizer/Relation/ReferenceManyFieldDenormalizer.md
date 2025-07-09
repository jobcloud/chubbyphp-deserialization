# ReferenceManyFieldDenormalizer

```php
<?php

use Jobcloud\Deserialization\Accessor\PropertyAccessor;
use Jobcloud\Deserialization\Denormalizer\Relation\ReferenceManyFieldDenormalizer;
use MyProject\Model\ParentModel;
use MyProject\Model\ChildModel;

$parentModel = new ParentModel;
$context = ...;
$denormalizer = ...;

$fieldDenormalizer = new ReferenceManyFieldDenormalizer(
    function (string $id) {
        return;
    },
    new PropertyAccessor('children')
);

$fieldDenormalizer->denormalizeField(
    'children',
    $parentModel,
    ['60a9ee14-64d6-4992-8042-8d1528ac02d6'],
    $context,
    $denormalizer
);

echo $parentModel
    ->getChildren()[0]
    ->getName();
// 'php'
```
