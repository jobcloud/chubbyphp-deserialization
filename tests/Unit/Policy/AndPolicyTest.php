<?php

declare(strict_types=1);

namespace Jobcloud\Tests\Deserialization\Unit\Policy;

use Jobcloud\Deserialization\Denormalizer\DenormalizerContextInterface;
use Jobcloud\Deserialization\Policy\AndPolicy;
use Jobcloud\Deserialization\Policy\PolicyInterface;
use Chubbyphp\Mock\MockMethod\WithReturn;
use Chubbyphp\Mock\MockObjectBuilder;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Jobcloud\Deserialization\Policy\AndPolicy
 *
 * @internal
 */
final class AndPolicyTest extends TestCase
{
    public function testIsCompliantIncludingPathReturnsTrueWithMultipleCompliantPolicies(): void
    {
        $object = new \stdClass();

        $path = '';

        $builder = new MockObjectBuilder();

        /** @var DenormalizerContextInterface $context */
        $context = $builder->create(DenormalizerContextInterface::class, []);

        /** @var PolicyInterface $compliantPolicy1 */
        $compliantPolicy1 = $builder->create(PolicyInterface::class, [
            new WithReturn('isCompliant', [$path, $object, $context], true),
        ]);

        /** @var PolicyInterface $compliantPolicy2 */
        $compliantPolicy2 = $builder->create(PolicyInterface::class, [
            new WithReturn('isCompliant', [$path, $object, $context], true),
        ]);

        $policy = new AndPolicy([$compliantPolicy1, $compliantPolicy2]);

        self::assertTrue($policy->isCompliant($path, $object, $context));
    }

    public function testIsCompliantIncludingPathReturnsFalseWithNonCompliantIncludingPathPolicy(): void
    {
        $object = new \stdClass();

        $path = '';

        $builder = new MockObjectBuilder();

        /** @var DenormalizerContextInterface $context */
        $context = $builder->create(DenormalizerContextInterface::class, []);

        /** @var PolicyInterface $compliantPolicy */
        $compliantPolicy = $builder->create(PolicyInterface::class, [
            new WithReturn('isCompliant', [$path, $object, $context], true),
        ]);

        /** @var PolicyInterface $nonCompliantPolicy */
        $nonCompliantPolicy = $builder->create(PolicyInterface::class, [
            new WithReturn('isCompliant', [$path, $object, $context], false),
        ]);

        $notExpectedToBeCalledPolicy = $builder->create(PolicyInterface::class, []);

        $policy = new AndPolicy([$compliantPolicy, $nonCompliantPolicy, $notExpectedToBeCalledPolicy]);

        self::assertFalse($policy->isCompliant($path, $object, $context));
    }
}
