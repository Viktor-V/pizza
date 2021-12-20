<?php

declare(strict_types=1);

namespace App\Pizza\Domain\Entity;

use App\Identifier\Domain\Type\Uuid;
use App\Identifier\Infrastructure\Doctrine\Type\UuidType;
use App\Money\Domain\Entity\Money;
use App\Pizza\Domain\Type\Name;
use App\Pizza\Infrastructure\Doctrine\Type\NameType;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Ingredient
{
    public function __construct(
        #[ORM\Id]
        #[ORM\Column(type: UuidType::NAME, unique: true)]
        private Uuid $uuid,
        #[ORM\Column(type: NameType::NAME, length: 255)]
        private Name $name,
        #[ORM\Embedded(class: Money::class)]
        private Money $price
    ) {
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
}
