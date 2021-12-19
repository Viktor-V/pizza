<?php

declare(strict_types=1);

namespace App\Pizza\Api\V1\Controller\Ingredient;

use App\Money\Domain\Entity\Money;
use App\Money\Domain\Type\Amount;
use App\Money\Domain\Type\Currency;
use App\Pizza\Domain\Entity\Ingredient;
use App\Pizza\Domain\Service\PizzaService;
use App\Pizza\Domain\Type\Name;
use ArrayIterator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class AddController extends AbstractController
{
    #[Route(path: '/api/v1/pizza/ingredient/add', name: 'api.v1.pizza.ingredient.add', methods: ['POST'])]
    public function __invoke(): JsonResponse
    {
        $defaultCurrency = new Currency('EUR');

        $tomato = new Ingredient(new Name('Tomato'), new Money(new Amount(50), $defaultCurrency));
        $slicedMushrooms = new Ingredient(new Name('Sliced Mushrooms'), new Money(new Amount(50), $defaultCurrency));
        $fetaCheese = new Ingredient(new Name('Feta Cheese'), new Money(new Amount(100), $defaultCurrency));
        $sausages = new Ingredient(new Name('Sausages'), new Money(new Amount(100), $defaultCurrency));
        $slicedOnion = new Ingredient(new Name('Sliced Onion'), new Money(new Amount(50), $defaultCurrency));
        $mozzarellaCheese = new Ingredient(new Name('Mozzarella Cheese'), new Money(new Amount(30), $defaultCurrency));
        $oregano = new Ingredient(new Name('Oregano'), new Money(new Amount(200), $defaultCurrency));
        $bacon = new Ingredient(new Name('Bacon'), new Money(new Amount(100), $defaultCurrency));

        $macDacIngredientList = new ArrayIterator([
            $tomato,
            $slicedMushrooms,
            $fetaCheese,
            $sausages,
            $slicedOnion,
            $mozzarellaCheese,
            $oregano,
            $bacon
        ]);

        $pizzaService = new PizzaService($defaultCurrency, 50);
        $pizza = $pizzaService->initialize(new Name('MacDac Pizza'), $macDacIngredientList);

        return new JsonResponse([
            'ingredient' => $this->render('pizza/partial/ingredient.html.twig', ['ingredient' => $bacon])->getContent(),
            'price' => (string) $pizza->price()
        ]);
    }
}
