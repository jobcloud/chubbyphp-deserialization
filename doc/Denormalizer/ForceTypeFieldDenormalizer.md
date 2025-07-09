# ConvertTypeFieldDenormalizer

```php
<?php

use Jobcloud\Deserialization\Accessor\PropertyAccessor;
use Jobcloud\Deserialization\Denormalizer\ConvertTypeFieldDenormalizer;
use MyProject\Model\Model;

$model = new Model;
$context = ...;

$fieldDenormalizer = new ConvertTypeFieldDenormalizer(
    new PropertyAccessor('value'),
    ConvertTypeFieldDenormalizer::TYPE_FLOAT
);

$fieldDenormalizer->denormalizeField(
    'value',
    $model,
    '5.5',
    $context
);

echo $model->getValue();
// 5.5
```
