<?php

declare(strict_types=1);

namespace Jobcloud\Tests\Deserialization\Unit;

use Chubbyphp\DecodeEncode\Decoder\DecoderInterface;
use Jobcloud\Deserialization\Denormalizer\DenormalizerContextInterface;
use Jobcloud\Deserialization\Denormalizer\DenormalizerInterface;
use Jobcloud\Deserialization\Deserializer;
use Chubbyphp\Mock\MockMethod\WithReturn;
use Chubbyphp\Mock\MockObjectBuilder;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Jobcloud\Deserialization\Deserializer
 *
 * @internal
 */
final class DeserializerTest extends TestCase
{
    public function testDeserialize(): void
    {
        $object = new \stdClass();

        $builder = new MockObjectBuilder();

        /** @var DenormalizerContextInterface $context */
        $context = $builder->create(DenormalizerContextInterface::class, []);

        /** @var DecoderInterface $decoder */
        $decoder = $builder->create(DecoderInterface::class, [
            new WithReturn('decode', ['{"name": "php"}', 'application/json'], ['name' => 'php']),
        ]);

        /** @var DenormalizerInterface $denormalizer */
        $denormalizer = $builder->create(DenormalizerInterface::class, [
            new WithReturn(
                'denormalize',
                [$object, ['name' => 'php'], $context, ''],
                $object
            ),
        ]);

        $deserializer = new Deserializer($decoder, $denormalizer);

        self::assertSame($object, $deserializer->deserialize($object, '{"name": "php"}', 'application/json', $context));
    }

    public function testDecode(): void
    {
        $builder = new MockObjectBuilder();

        /** @var DecoderInterface $decoder */
        $decoder = $builder->create(DecoderInterface::class, [
            new WithReturn('decode', ['{"name": "php"}', 'application/json'], ['name' => 'php']),
        ]);

        /** @var DenormalizerInterface $denormalizer */
        $denormalizer = $builder->create(DenormalizerInterface::class, []);

        $deserializer = new Deserializer($decoder, $denormalizer);

        self::assertEquals(['name' => 'php'], $deserializer->decode('{"name": "php"}', 'application/json'));
    }

    public function testGetContentTypes(): void
    {
        $builder = new MockObjectBuilder();

        /** @var DecoderInterface $decoder */
        $decoder = $builder->create(DecoderInterface::class, [
            new WithReturn('getContentTypes', [], ['application/json']),
        ]);

        /** @var DenormalizerInterface $denormalizer */
        $denormalizer = $builder->create(DenormalizerInterface::class, []);

        $deserializer = new Deserializer($decoder, $denormalizer);

        self::assertEquals(['application/json'], $deserializer->getContentTypes());
    }

    public function testDenormalize(): void
    {
        $object = new \stdClass();

        $builder = new MockObjectBuilder();

        /** @var DenormalizerContextInterface $context */
        $context = $builder->create(DenormalizerContextInterface::class, []);

        /** @var DecoderInterface $decoder */
        $decoder = $builder->create(DecoderInterface::class, []);

        /** @var DenormalizerInterface $denormalizer */
        $denormalizer = $builder->create(DenormalizerInterface::class, [
            new WithReturn('denormalize', [$object, ['name' => 'php'], $context, ''], $object),
        ]);

        $deserializer = new Deserializer($decoder, $denormalizer);

        self::assertSame($object, $deserializer->denormalize($object, ['name' => 'php'], $context));
    }
}
