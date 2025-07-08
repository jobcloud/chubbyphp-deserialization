<?php

declare(strict_types=1);

namespace Jobcloud\Deserialization\Mapping;

use Jobcloud\Deserialization\Denormalizer\FieldDenormalizerInterface;
use Jobcloud\Deserialization\Policy\PolicyInterface;

interface DenormalizationFieldMappingInterface
{
    public function getName(): string;

    public function getFieldDenormalizer(): FieldDenormalizerInterface;

    public function getPolicy(): PolicyInterface;
}
