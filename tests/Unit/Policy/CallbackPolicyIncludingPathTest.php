<?php

declare(strict_types=1);

namespace Chubbyphp\Tests\Deserialization\Unit\Policy;

use Chubbyphp\Deserialization\Denormalizer\DenormalizerContextInterface;
use Chubbyphp\Deserialization\DeserializerLogicException;
use Chubbyphp\Deserialization\Policy\CallbackPolicyIncludingPath;
use Chubbyphp\Mock\MockByCallsTrait;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Chubbyphp\Deserialization\Policy\CallbackPolicyIncludingPath
 *
 * @internal
 */
final class CallbackPolicyIncludingPathTest extends TestCase
{
    use MockByCallsTrait;

    public function testIsCompliantThrowsException(): void
    {
        $this->expectException(DeserializerLogicException::class);
        $this->expectExceptionMessage(
            sprintf(
                'Method(s) "isCompliant", are deprecated within class: "%s"',
                CallbackPolicyIncludingPath::class
            )
        );

        $object = new \stdClass();

        /** @var DenormalizerContextInterface|MockObject $context */
        $context = $this->getMockByCalls(DenormalizerContextInterface::class, []);

        $policy = new CallbackPolicyIncludingPath(function ($contextParameter, $objectParameter) use ($context, $object) {
            self::assertSame($context, $contextParameter);
            self::assertSame($object, $objectParameter);

            return true;
        });

        $policy->isCompliant($context, $object);
    }

    public function testIsCompliantIncludingPathReturnsTrueIfCallbackReturnsTrue(): void
    {
        $object = new \stdClass();

        $path = '';

        /** @var DenormalizerContextInterface|MockObject $context */
        $context = $this->getMockByCalls(DenormalizerContextInterface::class, []);

        $policy = new CallbackPolicyIncludingPath(
            function ($pathParameter, $objectParameter, $contextParameter) use ($path, $object, $context) {
                self::assertSame($context, $contextParameter);
                self::assertSame($object, $objectParameter);
                self::assertSame($path, $pathParameter);

                return true;
            }
        );

        self::assertTrue($policy->isCompliantIncludingPath($path, $object, $context));
    }

    public function testIsCompliantIncludingPathReturnsFalseIfCallbackReturnsFalse(): void
    {
        $object = new \stdClass();

        $path = '';

        /** @var DenormalizerContextInterface|MockObject $context */
        $context = $this->getMockByCalls(DenormalizerContextInterface::class, []);

        $policy = new CallbackPolicyIncludingPath(
            function ($pathParameter, $objectParameter, $contextParameter) use ($path, $object, $context) {
                self::assertSame($context, $contextParameter);
                self::assertSame($object, $objectParameter);
                self::assertSame($path, $pathParameter);

                return false;
            }
        );

        self::assertFalse($policy->isCompliantIncludingPath($path, $object, $context));
    }
}
