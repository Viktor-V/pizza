<?php

declare(strict_types=1);

namespace App\Pizza\Domain\Repository\Contract;

use App\Identifier\Domain\Type\Uuid;
use App\Pizza\Domain\Entity\Ingredient;
use Doctrine\Common\Collections\ArrayCollection;

interface IngredientRepositoryInterface
{
    public function all(): ArrayCollection;
    public function find(Uuid $uuid): ?Ingredient;
}
