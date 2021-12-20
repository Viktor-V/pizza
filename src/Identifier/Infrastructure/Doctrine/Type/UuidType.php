<?php

declare(strict_types=1);

namespace App\Identifier\Infrastructure\Doctrine\Type;

use App\Identifier\Domain\Type\Uuid;
use Doctrine\DBAL\Types\GuidType;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class UuidType extends GuidType
{
    public const NAME = 'uuid';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof Uuid ? (string) $value : $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?Uuid
    {
        return $value ? new Uuid($value) : null;
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
