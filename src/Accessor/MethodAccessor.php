<?php

declare(strict_types=1);

namespace Jobcloud\Deserialization\Accessor;

use Jobcloud\Deserialization\DeserializerLogicException;

final class MethodAccessor implements AccessorInterface
{
    public function __construct(private string $property) {}

    /**
     * @throws DeserializerLogicException
     */
    public function setValue(object $object, mixed $value): void
    {
        $set = 'set'.ucfirst($this->property);
        if (!method_exists($object, $set)) {
            throw DeserializerLogicException::createMissingMethod($object::class, [$set]);
        }

        $object->{$set}($value);
    }

    /**
     * @return mixed
     *
     * @throws DeserializerLogicException
     */
    public function getValue(object $object)
    {
        $get = 'get'.ucfirst($this->property);
        $has = 'has'.ucfirst($this->property);
        $is = 'is'.ucfirst($this->property);

        if (method_exists($object, $get)) {
            return $object->{$get}();
        }

        if (method_exists($object, $has)) {
            return $object->{$has}();
        }

        if (method_exists($object, $is)) {
            return $object->{$is}();
        }

        throw DeserializerLogicException::createMissingMethod($object::class, [$get, $has, $is]);
    }
}
