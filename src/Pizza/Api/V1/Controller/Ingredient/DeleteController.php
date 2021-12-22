<?php

declare(strict_types=1);

namespace App\Pizza\Api\V1\Controller\Ingredient;

use App\Identifier\Domain\Type\Uuid;
use App\Money\Domain\Entity\Money;
use App\Money\Domain\Type\Amount;
use App\Money\Domain\Type\Currency;
use App\Pizza\Domain\Entity\Ingredient;
use App\Pizza\Domain\Repository\Contract\IngredientRepositoryInterface;
use App\Pizza\Domain\Repository\Contract\PizzaRepositoryInterface;
use App\Pizza\Domain\Service\PizzaService;
use App\Pizza\Domain\Type\Name;
use App\Pizza\Infrastructure\Service\PizzaUpdaterService;
use ArrayIterator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class DeleteController extends AbstractController
{
    public function __construct(
        private PizzaRepositoryInterface $pizzaRepository,
        private IngredientRepositoryInterface $ingredientRepository,
        private PizzaUpdaterService $pizzaUpdaterService
    ) {
    }

    #[Route(path: '/api/v1/pizza/{pizzaUuid}/ingredient/{ingredientUuid}/delete', name: 'api.v1.pizza.ingredient.delete', methods: ['POST'])]
    public function __invoke(string $pizzaUuid, string $ingredientUuid): JsonResponse
    {
        $pizza = $this->pizzaRepository->find(new Uuid($pizzaUuid));
        if (!$pizza) {
            throw new NotFoundHttpException();
        }

        $ingredient = $this->ingredientRepository->find(new Uuid($ingredientUuid));
        if (!$ingredient) {
            throw new NotFoundHttpException();
        }

        $pizza = $this->pizzaUpdaterService->removeIngredient($pizza, $ingredient);

        return new JsonResponse([
            'price' => (string) $pizza->price()
        ]);
    }
}
