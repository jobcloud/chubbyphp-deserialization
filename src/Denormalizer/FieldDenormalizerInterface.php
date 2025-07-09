<?php

declare(strict_types=1);

namespace Jobcloud\Deserialization\Denormalizer;

use Jobcloud\Deserialization\DeserializerLogicException;
use Jobcloud\Deserialization\DeserializerRuntimeException;

interface FieldDenormalizerInterface
{
    /**
     * @throws DeserializerLogicException
     * @throws DeserializerRuntimeException
     */
    public function denormalizeField(
        string $path,
        object $object,
        mixed $value,
        DenormalizerContextInterface $context,
        ?DenormalizerInterface $denormalizer = null
    ): void;
}
