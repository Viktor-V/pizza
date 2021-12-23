<?php

declare(strict_types=1);

namespace App\Pizza\Presentation\Controller;

use App\Identifier\Domain\Type\Uuid;
use App\Pizza\Domain\Repository\Contract\PizzaRepositoryInterface;
use App\Pizza\Infrastructure\Service\PizzaStorageService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class ResetController extends AbstractController
{
    public function __construct(
        private PizzaRepositoryInterface $pizzaRepository,
        private PizzaStorageService $pizzaStorageService
    ) {
    }

    #[Route(path: '/pizza/{uuid}/reset', name: 'pizza.reset', methods: ['GET'])]
    public function __invoke(string $uuid): Response
    {
        $pizza = $this->pizzaRepository->find(new Uuid($uuid));
        if (!$pizza) {
            throw new NotFoundHttpException();
        }

        $this->pizzaStorageService->reset($pizza);

        return $this->redirectToRoute('pizza.product', ['uuid' => $uuid]);
    }
}
