<?php

declare(strict_types=1);

namespace App\Pizza\Presentation\Controller;

use App\Identifier\Domain\Type\Uuid;
use App\Pizza\Domain\Repository\Contract\IngredientRepositoryInterface;
use App\Pizza\Domain\Repository\Contract\PizzaRepositoryInterface;
use App\Pizza\Infrastructure\Service\PizzaStorageService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class PizzaController extends AbstractController
{
    public function __construct(
        private PizzaRepositoryInterface $pizzaRepository,
        private IngredientRepositoryInterface $ingredientRepository,
        private PizzaStorageService $pizzaStorageService
    ) {
    }

    #[Route(path: '/pizza/product/{uuid}', name: 'pizza.product', methods: ['GET'])]
    public function __invoke(string $uuid): Response
    {
        $pizza = $this->pizzaRepository->find(new Uuid($uuid));
        if (!$pizza) {
            throw new NotFoundHttpException();
        }

        return $this->render('pizza/product.html.twig', [
            'pizza' => $this->pizzaStorageService->get($pizza),
            'ingredients' => $this->ingredientRepository->all()
        ]);
    }
}
