<?php

declare(strict_types=1);

namespace App\Money\Infrastructure\Doctrine\Type;

use App\Money\Domain\Type\Amount;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\IntegerType;

class AmountType extends IntegerType
{
    public const NAME = 'amount';

    public function convertToDatabaseValue($value, AbstractPlatform $platform): mixed
    {
        return $value instanceof Amount ? $value->value() : $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?Amount
    {
        return new Amount($value);
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
