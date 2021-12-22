<?php

declare(strict_types=1);

namespace App\Pizza\Api\V1\Controller\Ingredient;

use App\Identifier\Domain\Type\Uuid;
use App\Pizza\Domain\Repository\Contract\IngredientRepositoryInterface;
use App\Pizza\Domain\Repository\Contract\PizzaRepositoryInterface;
use App\Pizza\Infrastructure\Service\PizzaUpdaterService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class AddController extends AbstractController
{
    public function __construct(
        private PizzaRepositoryInterface $pizzaRepository,
        private IngredientRepositoryInterface $ingredientRepository,
        private PizzaUpdaterService $pizzaUpdaterService
    ) {
    }

    #[Route(path: '/api/v1/pizza/{pizzaUuid}/ingredient/{ingredientUuid}/add', name: 'api.v1.pizza.ingredient.add', methods: ['POST'])]
    public function __invoke(Request $request, string $pizzaUuid, string $ingredientUuid): JsonResponse
    {
        $pizza = $this->pizzaRepository->find(new Uuid($pizzaUuid));
        if (!$pizza) {
            throw new NotFoundHttpException();
        }

        $ingredient = $this->ingredientRepository->find(new Uuid($ingredientUuid));
        if (!$ingredient) {
            throw new NotFoundHttpException();
        }
        
        return new JsonResponse([
            'ingredient' => $this->render('pizza/partial/ingredient.html.twig', ['pizza' => $pizza, 'ingredient' => $ingredient])->getContent(),
            'price' => (string)  $this->pizzaUpdaterService->addIngredient($pizza, $ingredient)->price()
        ]);
    }
}
