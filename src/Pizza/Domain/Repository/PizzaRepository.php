<?php

declare(strict_types=1);

namespace App\Pizza\Domain\Repository;

use App\Identifier\Domain\Type\Uuid;
use App\Pizza\Domain\Entity\Pizza;
use App\Pizza\Domain\Repository\Contract\PizzaRepositoryInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class PizzaRepository implements PizzaRepositoryInterface
{
    private EntityRepository $repository;

    public function __construct(
        private EntityManagerInterface $entityManager
    ) {
        $this->repository = $this->entityManager->getRepository(Pizza::class);
    }

    public function all(): ArrayCollection
    {
        return new ArrayCollection($this->repository->findAll());
    }

    public function find(Uuid $uuid): ?Pizza
    {
        return $this->repository->find((string) $uuid);
    }
}
