<?php

declare(strict_types=1);

namespace Jobcloud\Deserialization\Denormalizer;

use Jobcloud\Deserialization\DeserializerLogicException;
use Jobcloud\Deserialization\DeserializerRuntimeException;

interface DenormalizerInterface
{
    /**
     * @param array<string, null|array|bool|float|int|string> $data
     *
     * @throws DeserializerLogicException
     * @throws DeserializerRuntimeException
     */
    public function denormalize(
        object|string $object,
        array $data,
        ?DenormalizerContextInterface $context = null,
        string $path = ''
    ): object;
}
