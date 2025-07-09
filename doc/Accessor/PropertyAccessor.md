# PropertyAccessor

```php
<?php

use Jobcloud\Deserialization\Accessor\PropertyAccessor;
use MyProject\Model\Model;

$model = new Model;

$accessor = new PropertyAccessor('name');
$accessor->setValue($model, 'php');

echo $accessor->getValue($model);
// 'php'
```
