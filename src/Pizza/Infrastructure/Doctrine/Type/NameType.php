<?php

declare(strict_types=1);

namespace App\Pizza\Infrastructure\Doctrine\Type;

use App\Pizza\Domain\Type\Name;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class NameType extends StringType
{
    public const NAME = 'name';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof Name ? (string) $value : $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?Name
    {
        return $value ? new Name($value) : null;
    }

    public function getName(): string
    {
        return self::NAME;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
