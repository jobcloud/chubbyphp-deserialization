# DenormalizationFieldMappingFactory

```php
<?php

use Jobcloud\Deserialization\Accessor\PropertyAccessor;
use Jobcloud\Deserialization\Denormalizer\FieldDenormalizer;
use Jobcloud\Deserialization\Mapping\DenormalizationFieldMappingFactory;

$factory = new DenormalizationFieldMappingFactory();

$fieldMapping = $factory->create(
    'name',
    false,
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
