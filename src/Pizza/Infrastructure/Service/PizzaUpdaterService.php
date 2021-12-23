<?php

declare(strict_types=1);

namespace App\Pizza\Infrastructure\Service;

use App\Pizza\Domain\Entity\Ingredient;
use App\Pizza\Domain\Entity\Pizza;
use App\Pizza\Domain\Service\PizzaService;
use Doctrine\Common\Collections\ArrayCollection;

class PizzaUpdaterService
{
    public function __construct(
        private PizzaService $pizzaService,
        private PizzaStorageService $pizzaStorageService
    ) {
    }

    public function addIngredient(Pizza $pizza, Ingredient $ingredient): Pizza
    {
        $pizza = $this->pizzaStorageService->get($pizza);

        $ingredients = $pizza->ingredientList()->getValues();
        $ingredients[] = $ingredient;

        $pizza = $this->pizzaService->reinitialize(
            $pizza,
            new ArrayCollection($ingredients)
        );

        return $this->pizzaStorageService->set($pizza);
    }

    public function removeIngredient(Pizza $pizza, Ingredient $ingredient): Pizza
    {
        $pizza = $this->pizzaStorageService->get($pizza);

        $ingredients = $pizza->ingredientList()->getValues();
        /** @var Ingredient $item */
        foreach ($ingredients as $key => $item) {
            if ((string) $ingredient->uuid() === (string) $item->uuid()) {
                unset($ingredients[$key]);
            }
        }

        $pizza = $this->pizzaService->reinitialize(
            $pizza,
            new ArrayCollection($ingredients)
        );

        return $this->pizzaStorageService->set($pizza);
    }
}
