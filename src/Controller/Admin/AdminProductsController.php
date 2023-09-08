<?php

namespace App\Controller\Admin;

use App\Entity\Images;
use App\Entity\Products;
use App\Entity\Type;
use App\Form\ProductType;
use App\Services\ImageService;
use App\Services\ProductService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class AdminProductsController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $em,
    )
    {
    }

    /**
     * @param Products $products
     * @return void
     */
    #[Route('/admin/delete/product/{slug}', name: 'app_admin_product_delete')]
    public function deleteProduct(
        Products $products
    ) : Response
    {
        $this->em->getRepository(Products::class)->remove($products, true);

        $this->addFlash('success', 'Produit supprimer avec succès');

        return $this->redirectToRoute('app_home');
    }
}
