<?php

declare(strict_types=1);

namespace App\Pizza\Domain\Service;

use App\Identifier\Domain\Type\Uuid;
use App\Money\Domain\Entity\Money;
use App\Money\Domain\Type\Amount;
use App\Money\Domain\Type\Currency;
use App\Pizza\Domain\Entity\Ingredient;
use App\Pizza\Domain\Entity\Pizza;
use App\Pizza\Domain\Type\Name;
use Doctrine\Common\Collections\Collection;

class PizzaService
{
    public function __construct(
        private Currency $currency,
        private int $percentageToPrice
    ) {
    }

    public function initialize(
        Name $name,
        Collection $ingredientList
    ): Pizza {
        return new Pizza(new Uuid(), $name, $this->calculatePrice($ingredientList), $ingredientList);
    }

    public function reinitialize(
        Pizza $pizza,
        Collection $ingredientList
    ): Pizza {
        return new Pizza($pizza->uuid(), $pizza->name(), $this->calculatePrice($ingredientList), $ingredientList);
    }

    private function calculatePrice(Collection $ingredients): Money
    {
        $price = 0;
        /** @var Ingredient $ingredient */
        foreach ($ingredients as $ingredient) {
            $price += $ingredient->price()->amount()->value();
        }
        $price += ($price * $this->percentageToPrice / 100);

        return new Money(new Amount($price), $this->currency);
    }
}
