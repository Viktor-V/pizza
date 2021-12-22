<?php

declare(strict_types=1);

namespace App\Pizza\Presentation\Controller;

use App\Pizza\Domain\Repository\Contract\PizzaRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AlbumController extends AbstractController
{
    public function __construct(
        private PizzaRepositoryInterface $pizzaRepository
    ) {
    }

    #[Route(path: '/pizza', name: 'pizza.album', methods: ['GET'])]
    public function __invoke(Request $request): Response
    {
        return $this->render('pizza/list.html.twig', ['pizzas' => $this->pizzaRepository->all()]);
    }
}
