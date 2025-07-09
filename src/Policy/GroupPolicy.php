<?php

declare(strict_types=1);

namespace Jobcloud\Deserialization\Policy;

use Jobcloud\Deserialization\Denormalizer\DenormalizerContextInterface;

final class GroupPolicy implements PolicyInterface
{
    public const ATTRIBUTE_GROUPS = 'groups';

    public const GROUP_DEFAULT = 'default';

    /**
     * @param array<int, string> $groups
     */
    public function __construct(private array $groups = [self::GROUP_DEFAULT]) {}

    public function isCompliant(string $path, object $object, DenormalizerContextInterface $context): bool
    {
        if ([] === $this->groups) {
            return true;
        }

        $contextGroups = $context->getAttribute(self::ATTRIBUTE_GROUPS, [self::GROUP_DEFAULT]);

        foreach ($this->groups as $group) {
            if (\in_array($group, $contextGroups, true)) {
                return true;
            }
        }

        return false;
    }
}
