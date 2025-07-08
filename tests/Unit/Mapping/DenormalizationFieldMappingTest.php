<?php

declare(strict_types=1);

namespace Jobcloud\Tests\Deserialization\Unit\Mapping;

use Jobcloud\Deserialization\Denormalizer\FieldDenormalizerInterface;
use Jobcloud\Deserialization\Mapping\DenormalizationFieldMapping;
use Jobcloud\Deserialization\Policy\PolicyInterface;
use Chubbyphp\Mock\MockObjectBuilder;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Jobcloud\Deserialization\Mapping\DenormalizationFieldMapping
 *
 * @internal
 */
final class DenormalizationFieldMappingTest extends TestCase
{
    public function testGetName(): void
    {
        $builder = new MockObjectBuilder();

        /** @var FieldDenormalizerInterface $fieldDenormalizer */
        $fieldDenormalizer = $builder->create(FieldDenormalizerInterface::class, []);

        $fieldMapping = new DenormalizationFieldMapping('name', $fieldDenormalizer);

        self::assertSame('name', $fieldMapping->getName());
    }

    public function testGetFieldDenormalizer(): void
    {
        $builder = new MockObjectBuilder();

        /** @var FieldDenormalizerInterface $fieldDenormalizer */
        $fieldDenormalizer = $builder->create(FieldDenormalizerInterface::class, []);

        $fieldMapping = new DenormalizationFieldMapping('name', $fieldDenormalizer);

        self::assertSame($fieldDenormalizer, $fieldMapping->getFieldDenormalizer());
    }

    public function testGetPolicy(): void
    {
        $builder = new MockObjectBuilder();

        /** @var FieldDenormalizerInterface $fieldDenormalizer */
        $fieldDenormalizer = $builder->create(FieldDenormalizerInterface::class, []);

        /** @var PolicyInterface $policy */
        $policy = $builder->create(PolicyInterface::class, []);

        $fieldMapping = new DenormalizationFieldMapping('name', $fieldDenormalizer, $policy);

        self::assertSame($policy, $fieldMapping->getPolicy());
    }
}
