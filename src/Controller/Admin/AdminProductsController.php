<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminProductsController extends AbstractController
{
    #[Route('/admin/admin/products', name: 'app_admin_admin_products')]
    public function index(): Response
    {
        return $this->render('admin/products/adminProducts.html.twig', [
            'controller_name' => 'AdminProductsController',
        ]);
    }
}
