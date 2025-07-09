# DenormalizationFieldMapping

```php
<?php

use Jobcloud\Deserialization\Accessor\PropertyAccessor;
use Jobcloud\Deserialization\Denormalizer\FieldDenormalizer;
use Jobcloud\Deserialization\Mapping\DenormalizationFieldMapping;

$fieldMapping = new DenormalizationFieldMapping(
    'name',
    ['group1'],
    new FieldDenormalizer(
        new PropertyAccessor('name')
    )
);

echo $fieldMapping->getName();
// 'name'

print_r($fieldMapping->getGroups());
// ['group1']

$fieldMapping
    ->getFieldDenormalizer()
    ->denormalizeField(...);
```
