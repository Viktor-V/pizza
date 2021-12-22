<?php

declare(strict_types=1);

namespace App\Money\Domain\Entity;

use App\Money\Domain\Type\Amount;
use App\Money\Domain\Type\Currency;
use App\Money\Infrastructure\Doctrine\Type\AmountType;
use App\Money\Infrastructure\Doctrine\Type\CurrencyType;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
class Money
{
    public const PRECISION = 100;

    public function __construct(
        #[ORM\Column(type: AmountType::NAME)]
        private ?Amount $amount = null,
        #[ORM\Column(type: CurrencyType::NAME, length: 3)]
        private Currency $currency
    ) {
    }

    public function amount(): ?Amount
    {
        return $this->amount;
    }

    public function currency(): Currency
    {
        return $this->currency;
    }

    public function __toString()
    {
        $amount = $this->amount ? $this->amount->value() : 0;

        return sprintf('%.2f%s', ($amount / self::PRECISION), $this->currency->currency());
    }
}
