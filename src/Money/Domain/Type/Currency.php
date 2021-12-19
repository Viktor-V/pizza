<?php

declare(strict_types=1);

namespace App\Money\Domain\Type;

class Currency
{
    public function __construct(
        private string $currency
    ) {
    }

    public function currency(): string
    {
        return $this->currency;
    }
}
