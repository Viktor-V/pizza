<?php

declare(strict_types=1);

namespace App\Pizza\Domain\Repository;

use App\Identifier\Domain\Type\Uuid;
use App\Pizza\Domain\Entity\Ingredient;
use App\Pizza\Domain\Repository\Contract\IngredientRepositoryInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class IngredientRepository implements IngredientRepositoryInterface
{
    private EntityRepository $repository;

    public function __construct(
        private EntityManagerInterface $entityManager
    ) {
        $this->repository = $this->entityManager->getRepository(Ingredient::class);
    }

    public function all(): ArrayCollection
    {
        return new ArrayCollection($this->repository->findAll());
    }

    public function find(Uuid $uuid): ?Ingredient
    {
        return $this->repository->find((string) $uuid);
    }
}
