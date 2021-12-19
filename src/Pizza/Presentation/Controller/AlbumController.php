<?php

declare(strict_types=1);

namespace App\Pizza\Presentation\Controller;

use App\Money\Domain\Entity\Money;
use App\Money\Domain\Type\Amount;
use App\Money\Domain\Type\Currency;
use App\Pizza\Domain\Entity\Ingredient;
use App\Pizza\Domain\Service\PizzaService;
use App\Pizza\Domain\Type\Name;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use ArrayIterator;

class AlbumController extends AbstractController
{
    #[Route(path: '/pizza', name: 'pizza.album', methods: ['GET'])]
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
        $bacon = new Ingredient(new Name('Bacon'), new Money(new Amount(100), $defaultCurrency));

        $macDacIngredientList = new ArrayIterator([
            $tomato,
            $slicedMushrooms,
            $fetaCheese,
            $sausages,
            $slicedOnion,
            $mozzarellaCheese,
            $oregano
        ]);

        $lovelyMushroomIngredientList = new ArrayIterator([
            $tomato,
            $bacon,
            $mozzarellaCheese,
            $slicedMushrooms,
            $oregano
        ]);

        $pizzaService = new PizzaService($defaultCurrency, 50);
        $pizzaList = new ArrayIterator([
            $pizzaService->initialize(new Name('MacDac Pizza'), $macDacIngredientList),
            $pizzaService->initialize(new Name('Lovely Mushroom Pizza'), $lovelyMushroomIngredientList),
            $pizzaService->initialize(new Name('Custom'), new ArrayIterator())
        ]);


        return $this->render('pizza/list.html.twig', ['pizzas' => $pizzaList]);
    }
}
