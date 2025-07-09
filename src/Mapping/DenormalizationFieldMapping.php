<?php

declare(strict_types=1);

namespace Jobcloud\Deserialization\Mapping;

use Jobcloud\Deserialization\Denormalizer\FieldDenormalizerInterface;
use Jobcloud\Deserialization\Policy\NullPolicy;
use Jobcloud\Deserialization\Policy\PolicyInterface;

final class DenormalizationFieldMapping implements DenormalizationFieldMappingInterface
{
    private PolicyInterface $policy;

    public function __construct(
        private string $name,
        private FieldDenormalizerInterface $fieldDenormalizer,
        ?PolicyInterface $policy = null
    ) {
        $this->policy = $policy ?? new NullPolicy();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getFieldDenormalizer(): FieldDenormalizerInterface
    {
        return $this->fieldDenormalizer;
    }

    public function getPolicy(): PolicyInterface
    {
        return $this->policy;
    }
}
