<?php

declare(strict_types=1);

namespace Jobcloud\Deserialization\Policy;

use Jobcloud\Deserialization\Denormalizer\DenormalizerContextInterface;

final class CallbackPolicy implements PolicyInterface
{
    /**
     * @var callable
     */
    private $callback;

    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

    public function isCompliant(string $path, object $object, DenormalizerContextInterface $context): bool
    {
        return ($this->callback)($path, $object, $context);
    }
}
