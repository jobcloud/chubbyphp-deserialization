<?php

declare(strict_types=1);

namespace Jobcloud\Deserialization\Denormalizer;

use Jobcloud\Deserialization\DeserializerRuntimeException;

final class CallbackFieldDenormalizer implements FieldDenormalizerInterface
{
    /**
     * @var callable
     */
    private $callback;

    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

    /**
     * @throws DeserializerRuntimeException
     */
    public function denormalizeField(
        string $path,
        object $object,
        mixed $value,
        DenormalizerContextInterface $context,
        ?DenormalizerInterface $denormalizer = null
    ): void {
        ($this->callback)($path, $object, $value, $context, $denormalizer);
    }
}
