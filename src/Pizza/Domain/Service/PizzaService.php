<?php

declare(strict_types=1);

namespace App\Pizza\Domain\Service;

use App\Money\Domain\Entity\Money;
use App\Money\Domain\Type\Amount;
use App\Money\Domain\Type\Currency;
use App\Pizza\Domain\Entity\Ingredient;
use App\Pizza\Domain\Entity\Pizza;
use App\Pizza\Domain\Type\Name;

class PizzaService
{
    public function __construct(
        private Currency $currency,
        private int $percentageToPrice
    ) {
    }

    /**
     * @param iterable<Ingredient> $ingredientList
     *
     * @return Pizza
     */
    public function initialize(
        Name $name,
        iterable $ingredientList
    ): Pizza {
        $price = 0;
        foreach ($ingredientList as $ingredient) {
            $price += $ingredient->price()->amount()->value();
        }
        $price += ($price * $this->percentageToPrice / 100);

        return new Pizza($name, new Money(new Amount($price), $this->currency), $ingredientList);
    }
}
