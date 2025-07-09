<?php

declare(strict_types=1);

namespace Jobcloud\Deserialization;

use Chubbyphp\DecodeEncode\Decoder\DecoderInterface;
use Jobcloud\Deserialization\Denormalizer\DenormalizerContextInterface;
use Jobcloud\Deserialization\Denormalizer\DenormalizerInterface;

interface DeserializerInterface extends DecoderInterface, DenormalizerInterface
{
    public function deserialize(
        object|string $object,
        string $data,
        string $contentType,
        ?DenormalizerContextInterface $context = null,
        string $path = ''
    ): object;
}
