<?php

declare(strict_types=1);

namespace App\Money\Domain\Entity;

use App\Money\Domain\Type\Amount;
use App\Money\Domain\Type\Currency;

class Money
{
    public const PRECISION = 100;

    public function __construct(
        private Amount $amount,
        private Currency $currency
    ) {
    }

    public function amount(): Amount
    {
        return $this->amount;
    }

    public function currency(): Currency
    {
        return $this->currency;
    }

    public function __toString()
    {
        return sprintf('%.2f%s', ($this->amount->value() / self::PRECISION), $this->currency->currency());
    }
}
