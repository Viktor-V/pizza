<?php

declare(strict_types=1);

namespace App\Pizza\Domain\Entity;

use App\Identifier\Domain\Type\Uuid;
use App\Identifier\Infrastructure\Doctrine\Type\UuidType;
use App\Money\Domain\Entity\Money;
use App\Pizza\Domain\Type\Name;
use App\Pizza\Infrastructure\Doctrine\Type\NameType;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Pizza
{
    #[ORM\ManyToMany(targetEntity: Ingredient::class)]
    #[ORM\JoinTable(name: 'pizza_ingredients')]
    #[ORM\JoinColumn(name: "pizza_uuid", referencedColumnName: "uuid")]
    #[ORM\InverseJoinColumn(name: "ingredient_uuid", referencedColumnName: "uuid")]
    private Collection $ingredientList;

    public function __construct(
        #[ORM\Id]
        #[ORM\Column(type: UuidType::NAME, unique: true)]
        private Uuid $uuid,
        #[ORM\Column(type: NameType::NAME, length: 255)]
        private Name $name,
        #[ORM\Embedded(class: Money::class)]
        private Money $price,
    ) {
        $this->ingredientList = new ArrayCollection();
    }

    public function uuid(): Uuid
    {
        return $this->uuid;
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function price(): Money
    {
        return $this->price;
    }

    public function addIngredient(Ingredient $ingredient): void
    {
        $this->ingredientList->add($ingredient);
    }

    public function ingredientList(): ArrayCollection
    {
        return $this->ingredientList;
    }
}
