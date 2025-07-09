# CallbackFieldDenormalizer

```php
<?php

use Jobcloud\Deserialization\Denormalizer\CallbackFieldDenormalizer;
use MyProject\Model\Model;

$model = new Model;
$context = ...;

$fieldDenormalizer = new CallbackFieldDenormalizer(
    function (
        string $path,
        object $object,
        $value,
        DenormalizerContextInterface $context,
        DenormalizerInterface $denormalizer = null
    ) {
        $object->setName($value);
    }
);

$fieldDenormalizer->denormalizeField(
    'name',
    $model,
    'php',
    $context
);

echo $model->getName();
// 'php'
```
