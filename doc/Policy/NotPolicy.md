# NotPolicy

```php
<?php

use Jobcloud\Deserialization\Denormalizer\DenormalizerContextInterface;
use Jobcloud\Deserialization\Policy\NotPolicy;
use MyProject\Model\Model;
use MyProject\Policy\SomePolicy;

$model = new Model();

/** @var DenormalizerContextInterface $context */
$context = ...;

$policy = new NotPolicy(new SomePolicy());

echo $policy->isCompliant('path', $model, $context);
// 1
```
