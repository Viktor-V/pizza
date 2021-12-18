<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route(path: '/product', name: 'product')]
    public function __invoke(): Response
    {
        return $this->render('pizza/product.html.twig');
    }
}
