<?php

declare(strict_types=1);

namespace App\Pizza\Presentation\Controller;

use App\Identifier\Domain\Type\Uuid;
use App\Pizza\Domain\Repository\Contract\IngredientRepositoryInterface;
use App\Pizza\Domain\Repository\Contract\PizzaRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class PizzaController extends AbstractController
{
    public function __construct(
        private PizzaRepositoryInterface $pizzaRepository,
        private IngredientRepositoryInterface $ingredientRepository
    ) {
    }

    #[Route(path: '/pizza/product/{uuid}', name: 'pizza.product', methods: ['GET'])]
    public function __invoke(string $uuid): Response
    {
        $pizza = $this->pizzaRepository->find(new Uuid($uuid));
        $ingredients = $this->ingredientRepository->all();

        if (!$pizza) {
            throw new NotFoundHttpException();
        }

        return $this->render('pizza/product.html.twig', ['pizza' => $pizza, 'ingredients' => $ingredients]);
    }
}
