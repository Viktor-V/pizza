<?php

declare(strict_types=1);

namespace App\Pizza\Presentation\Controller;

use App\Money\Domain\Entity\Money;
use App\Money\Domain\Type\Amount;
use App\Money\Domain\Type\Currency;
use App\Pizza\Domain\Entity\Ingredient;
use App\Pizza\Domain\Service\PizzaService;
use App\Pizza\Domain\Type\Name;
use ArrayIterator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PizzaController extends AbstractController
{
    #[Route(path: '/pizza/product', name: 'pizza.product', methods: ['GET'])]
    public function __invoke(): Response
    {
        $defaultCurrency = new Currency('EUR');

        $tomato = new Ingredient(new Name('Tomato'), new Money(new Amount(50), $defaultCurrency));
        $slicedMushrooms = new Ingredient(new Name('Sliced Mushrooms'), new Money(new Amount(50), $defaultCurrency));
        $fetaCheese = new Ingredient(new Name('Feta Cheese'), new Money(new Amount(100), $defaultCurrency));
        $sausages = new Ingredient(new Name('Sausages'), new Money(new Amount(100), $defaultCurrency));
        $slicedOnion = new Ingredient(new Name('Sliced Onion'), new Money(new Amount(50), $defaultCurrency));
        $mozzarellaCheese = new Ingredient(new Name('Mozzarella Cheese'), new Money(new Amount(30), $defaultCurrency));
        $oregano = new Ingredient(new Name('Oregano'), new Money(new Amount(200), $defaultCurrency));

        $macDacIngredientList = new ArrayIterator([
            $tomato,
            $slicedMushrooms,
            $fetaCheese,
            $sausages,
            $slicedOnion,
            $mozzarellaCheese,
            $oregano
        ]);

        $pizzaService = new PizzaService($defaultCurrency, 50);
        $pizza = $pizzaService->initialize(new Name('MacDac Pizza'), $macDacIngredientList);

        return $this->render('pizza/product.html.twig', ['pizza' => $pizza]);
    }
}
