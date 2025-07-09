# NullPolicy

```php
<?php

use Jobcloud\Deserialization\Denormalizer\DenormalizerContextInterface;
use Jobcloud\Deserialization\Policy\NullPolicy;
use MyProject\Model\Model;

$model = new Model();

/** @var DenormalizerContextInterface $context */
$context = ...;

$policy = new NullPolicy();

echo $policy->isCompliant('path', $model, $context);
// 1
```
