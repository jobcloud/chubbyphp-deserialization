<?php

declare(strict_types=1);

namespace Jobcloud\Deserialization\Policy;

use Jobcloud\Deserialization\Denormalizer\DenormalizerContextInterface;

final class NotPolicy implements PolicyInterface
{
    public function __construct(private PolicyInterface $policy) {}

    public function isCompliant(string $path, object $object, DenormalizerContextInterface $context): bool
    {
        return !$this->policy->isCompliant($path, $object, $context);
    }
}
