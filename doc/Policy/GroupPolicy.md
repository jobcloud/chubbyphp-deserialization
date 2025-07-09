# GroupPolicy

```php
<?php

use Jobcloud\Deserialization\Denormalizer\DenormalizerContextInterface;
use Jobcloud\Deserialization\Policy\GroupPolicy;
use MyProject\Model\Model;

$model = new Model();

/** @var DenormalizerContextInterface $context */
$context = ...;
$context = $context->withAttribute('groups', ['group1']);

$policy = new GroupPolicy(['group1']);

echo $policy->isCompliant('path', $model, $context);
// 1
```
