<?php

declare(strict_types=1);

namespace Jobcloud\Tests\Deserialization\Unit\Policy;

use Jobcloud\Deserialization\Denormalizer\DenormalizerContextInterface;
use Jobcloud\Deserialization\Policy\NullPolicy;
use Chubbyphp\Mock\MockObjectBuilder;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Jobcloud\Deserialization\Policy\NullPolicy
 *
 * @internal
 */
final class NullPolicyTest extends TestCase
{
    public function testIsCompliantIncludingReturnsTrue(): void
    {
        $object = new \stdClass();

        $path = '';

        $builder = new MockObjectBuilder();

        /** @var DenormalizerContextInterface $context */
        $context = $builder->create(DenormalizerContextInterface::class, []);

        $policy = new NullPolicy();

        self::assertTrue($policy->isCompliant($path, $object, $context));
    }
}
