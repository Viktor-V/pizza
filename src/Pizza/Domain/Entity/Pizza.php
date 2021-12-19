<?php

declare(strict_types=1);

namespace App\Pizza\Domain\Entity;

use App\Money\Domain\Entity\Money;
use App\Pizza\Domain\Type\Name;

class Pizza
{
    public function __construct(
        private Name $name,
        private Money $price,
        private iterable $ingredientList
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

    public function ingredientList(): iterable
    {
        return $this->ingredientList;
    }
}
