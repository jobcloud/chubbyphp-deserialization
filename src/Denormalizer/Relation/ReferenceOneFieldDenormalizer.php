<?php

declare(strict_types=1);

namespace Jobcloud\Deserialization\Denormalizer\Relation;

use Jobcloud\Deserialization\Accessor\AccessorInterface;
use Jobcloud\Deserialization\Denormalizer\DenormalizerContextInterface;
use Jobcloud\Deserialization\Denormalizer\DenormalizerInterface;
use Jobcloud\Deserialization\Denormalizer\FieldDenormalizerInterface;
use Jobcloud\Deserialization\DeserializerRuntimeException;

final class ReferenceOneFieldDenormalizer implements FieldDenormalizerInterface
{
    /**
     * @var callable
     */
    private $repository;

    public function __construct(
        callable $repository,
        private AccessorInterface $accessor,
        private bool $emptyToNull = false
    ) {
        $this->repository = $repository;
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
        if ('' === $value && $this->emptyToNull) {
            $this->accessor->setValue($object, null);

            return;
        }

        if (null === $value) {
            $this->accessor->setValue($object, null);

            return;
        }

        if (!\is_string($value)) {
            throw DeserializerRuntimeException::createInvalidDataType($path, \gettype($value), 'string');
        }

        $this->accessor->setValue($object, ($this->repository)($value) ?? $value);
    }
}
