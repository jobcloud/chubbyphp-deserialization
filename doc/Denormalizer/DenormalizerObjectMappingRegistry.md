# DenormalizerObjectMappingRegistry

```php
<?php

use Jobcloud\Deserialization\Denormalizer\DenormalizerObjectMappingRegistry;

$registry = new DenormalizerObjectMappingRegistry([]);

echo $registry->getObjectMapping('class')->getClass();
// 'class'
```
