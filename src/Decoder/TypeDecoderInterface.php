<?php

declare(strict_types=1);

namespace Chubbyphp\Deserialization\Decoder;

use Chubbyphp\Deserialization\DeserializerRuntimeException;

interface TypeDecoderInterface
{
    public function getContentType(): string;

    /**
     * @throws DeserializerRuntimeException
     *
     * @return array<mixed>
     */
    public function decode(string $data): array;
}
