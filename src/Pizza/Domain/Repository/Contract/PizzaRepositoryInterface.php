<?php

declare(strict_types=1);

namespace App\Pizza\Domain\Repository\Contract;

use App\Identifier\Domain\Type\Uuid;
use App\Pizza\Domain\Entity\Pizza;
use Doctrine\Common\Collections\ArrayCollection;

interface PizzaRepositoryInterface
{
    public function all(): ArrayCollection;

    public function find(Uuid $uuid): ?Pizza;
}
