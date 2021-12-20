<?php

declare(strict_types=1);

namespace App\Money\Infrastructure\Doctrine\Type;

use App\Money\Domain\Type\Currency;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class CurrencyType extends StringType
{
    public const NAME = 'currency';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof Currency ? $value->currency() : $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?Currency
    {
        return $value ? new Currency($value) : null;
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
