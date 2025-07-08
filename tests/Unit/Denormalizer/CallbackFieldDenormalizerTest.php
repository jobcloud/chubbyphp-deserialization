<?php

declare(strict_types=1);

namespace Jobcloud\Tests\Deserialization\Unit\Denormalizer;

use Jobcloud\Deserialization\Denormalizer\CallbackFieldDenormalizer;
use Jobcloud\Deserialization\Denormalizer\DenormalizerContextInterface;
use Jobcloud\Deserialization\Denormalizer\DenormalizerInterface;
use Chubbyphp\Mock\MockObjectBuilder;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Jobcloud\Deserialization\Denormalizer\CallbackFieldDenormalizer
 *
 * @internal
 */
final class CallbackFieldDenormalizerTest extends TestCase
{
    public function testDenormalizeField(): void
    {
        $object = new class {
            private ?string $name = null;

            public function getName(): string
            {
                return $this->name;
            }

            public function setName(string $name): self
            {
                $this->name = $name;

                return $this;
            }
        };

        $builder = new MockObjectBuilder();

        /** @var DenormalizerContextInterface $context */
        $context = $builder->create(DenormalizerContextInterface::class, []);

        $fieldDenormalizer = new CallbackFieldDenormalizer(
            static function (
                string $path,
                $object,
                $value,
                DenormalizerContextInterface $context,
                ?DenormalizerInterface $denormalizer = null
            ): void {
                $object->setName($value);
            }
        );

        $fieldDenormalizer->denormalizeField('name', $object, 'name', $context);

        self::assertSame('name', $object->getName());
    }
}
