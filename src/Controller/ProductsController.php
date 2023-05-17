<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductsController extends AbstractController
{
    #[Route('/buy', name: 'app_products_buying')]
    public function buying(): Response
    {
        return $this->render('products/adminProducts.html.twig', [
            'controller_name' => 'ProductsController',
        ]);
    }

    #[Route('/sell', name: 'app_products_selling')]
    public function selling(): Response
    {
        return $this->render('products/adminProducts.html.twig', [
            'controller_name' => 'ProductsController',
        ]);
    }
}
