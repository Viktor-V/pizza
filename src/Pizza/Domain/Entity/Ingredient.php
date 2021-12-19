<?php

declare(strict_types=1);

namespace App\Pizza\Domain\Entity;

use App\Money\Domain\Entity\Money;
use App\Pizza\Domain\Type\Name;

class Ingredient
{
    public function __construct(
        private Name $name,
        private Money $price
    ) {
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function price(): Money
    {
        return $this->price;
    }
}
