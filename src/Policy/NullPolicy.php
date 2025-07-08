<?php

declare(strict_types=1);

namespace Jobcloud\Deserialization\Policy;

use Jobcloud\Deserialization\Denormalizer\DenormalizerContextInterface;

final class NullPolicy implements PolicyInterface
{
    public function isCompliant(string $path, object $object, DenormalizerContextInterface $context): bool
    {
        return true;
    }
}
