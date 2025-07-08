<?php

declare(strict_types=1);

namespace Jobcloud\Tests\Deserialization\Unit\Policy;

use Jobcloud\Deserialization\Denormalizer\DenormalizerContextInterface;
use Jobcloud\Deserialization\Policy\NotPolicy;
use Jobcloud\Deserialization\Policy\PolicyInterface;
use Chubbyphp\Mock\MockMethod\WithReturn;
use Chubbyphp\Mock\MockObjectBuilder;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Jobcloud\Deserialization\Policy\NotPolicy
 *
 * @internal
 */
final class NotPolicyTest extends TestCase
{
    public function testIsCompliantIncludingPathReturnsTrueIfGivenPolicyIncludingPathReturnsFalse(): void
    {
        $object = new \stdClass();

        $path = '';

        $builder = new MockObjectBuilder();

        /** @var DenormalizerContextInterface $context */
        $context = $builder->create(DenormalizerContextInterface::class, []);

        /** @var PolicyInterface $nonCompliantPolicy */
        $nonCompliantPolicy = $builder->create(PolicyInterface::class, [
            new WithReturn('isCompliant', [$path, $object, $context], false),
        ]);

        $policy = new NotPolicy($nonCompliantPolicy);

        self::assertTrue($policy->isCompliant($path, $object, $context));
    }

    public function testIsCompliantIncludingPathReturnsFalseIfGivenPolicyIncludingPathReturnsTrue(): void
    {
        $object = new \stdClass();

        $path = '';

        $builder = new MockObjectBuilder();

        /** @var DenormalizerContextInterface $context */
        $context = $builder->create(DenormalizerContextInterface::class, []);

        /** @var PolicyInterface $compliantPolicy */
        $nonCompliantPolicy = $builder->create(PolicyInterface::class, [
            new WithReturn('isCompliant', [$path, $object, $context], true),
        ]);

        $policy = new NotPolicy($nonCompliantPolicy);

        self::assertFalse($policy->isCompliant($path, $object, $context));
    }
}
