<?php

namespace App\Controller;

use App\Entity\Images;
use App\Entity\Products;
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

class ProductsController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $em,
    )
    {
    }

    #[Route('/buy', name: 'app_products_buying')]
    public function buying(): Response
    {

        $products = $this->em->getRepository(Products::class)->findAll();

        return $this->render('products/productsBuy.html.twig', [
            'controller_name' => 'ProductsController',
            'products' => $products
        ]);
    }


    #[Route('/sell', name: 'app_products_selling')]
    public function create(
        Request $request,
        ProductService $productService,
        ImageService $imageService
    ): Response
    {

        $product = new Products();

        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $product->setCreatedAt(new \DateTimeImmutable());

            $product->setSlug($productService->generateRandomString(25));

            if (!empty($form->get('images')->getData())){
                $images = $form->get('images')->getData();
                foreach ($images as $image){
                    $folder = 'products';

                    $fichier = $imageService->add($image, $folder, 300, 300);

                    $img = new Images();
                    $img->setOriginalName($form->get('images')->getData()[0]->getClientOriginalName());
                    $img->setName($fichier);
                    $product->addImage($img);
                }
            } else {
                throw new BadRequestException('Pas d\'image sélectionnées');
            }

            $this->em->persist($product);
            $this->em->flush();

            return $this->redirectToRoute('app_home', [
                'slug' => $product->getSlug()
            ]);
        }

        return $this->render('products/product_create_edit.html.twig', [
            'formView' => $form
        ]);
    }

    /**
     * @param Request $request
     * @param ImageService $imageService
     * @param SluggerInterface $slugger
     * @return Response
     */
    #[Route('/admin/product/create', name: 'app_admin_product_create')]
    public function productCreate(
        Request $request,
        ProductService $productService
    ): Response
    {

    }
}
