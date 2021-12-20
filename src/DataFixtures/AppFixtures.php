<?php

namespace App\DataFixtures;

use App\Identifier\Domain\Type\Uuid;
use App\Money\Domain\Entity\Money;
use App\Money\Domain\Type\Amount;
use App\Money\Domain\Type\Currency;
use App\Pizza\Domain\Entity\Ingredient;
use App\Pizza\Domain\Service\PizzaService;
use App\Pizza\Domain\Type\Name;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function __construct(
        private PizzaService $pizzaService
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $defaultCurrency = new Currency('EUR');

        $tomato = new Ingredient(new Uuid(), new Name('Tomato'), new Money(new Amount(50), $defaultCurrency));
        $manager->persist($tomato);

        $slicedMushrooms = new Ingredient(new Uuid(), new Name('Sliced Mushrooms'), new Money(new Amount(50), $defaultCurrency));
        $manager->persist($slicedMushrooms);

        $fetaCheese = new Ingredient(new Uuid(), new Name('Feta Cheese'), new Money(new Amount(100), $defaultCurrency));
        $manager->persist($fetaCheese);

        $sausages = new Ingredient(new Uuid(), new Name('Sausages'), new Money(new Amount(100), $defaultCurrency));
        $manager->persist($sausages);

        $slicedOnion = new Ingredient(new Uuid(), new Name('Sliced Onion'), new Money(new Amount(50), $defaultCurrency));
        $manager->persist($slicedOnion);

        $mozzarellaCheese = new Ingredient(new Uuid(), new Name('Mozzarella Cheese'), new Money(new Amount(30), $defaultCurrency));
        $manager->persist($mozzarellaCheese);

        $oregano = new Ingredient(new Uuid(), new Name('Oregano'), new Money(new Amount(200), $defaultCurrency));
        $manager->persist($oregano);

        $bacon = new Ingredient(new Uuid(), new Name('Bacon'), new Money(new Amount(100), $defaultCurrency));
        $manager->persist($bacon);

        $macDacIngredientList = new ArrayCollection([
            $tomato,
            $slicedMushrooms,
            $fetaCheese,
            $sausages,
            $slicedOnion,
            $mozzarellaCheese,
            $oregano
        ]);

        $lovelyMushroomIngredientList = new ArrayCollection([
            $tomato,
            $bacon,
            $mozzarellaCheese,
            $slicedMushrooms,
            $oregano
        ]);

        $macDac = $this->pizzaService->initialize(new Name('MacDac Pizza'), $macDacIngredientList);
        $manager->persist($macDac);

        $mushroom = $this->pizzaService->initialize(new Name('Lovely Mushroom Pizza'), $lovelyMushroomIngredientList);
        $manager->persist($mushroom);

        $custom = $this->pizzaService->initialize(new Name('Custom'), new ArrayCollection());
        $manager->persist($custom);

        $manager->flush();
    }
}
