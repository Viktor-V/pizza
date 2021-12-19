<?php

declare(strict_types=1);

namespace App\Pizza\Presentation\Controller;

use App\Money\Domain\Entity\Money;
use App\Money\Domain\Type\Amount;
use App\Money\Domain\Type\Currency;
use App\Pizza\Domain\Entity\Ingredient;
use App\Pizza\Domain\Service\PizzaService;
use App\Pizza\Domain\Type\Name;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use ArrayIterator;

class ResetController extends AbstractController
{
    #[Route(path: '/pizza/reset', name: 'pizza.reset', methods: ['GET'])]
    public function __invoke(): Response
    {
        return $this->redirectToRoute('pizza.product');
    }
}
