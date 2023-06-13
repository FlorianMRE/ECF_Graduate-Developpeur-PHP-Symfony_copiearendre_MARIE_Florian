<?php

namespace App\Controller;

use App\Entity\Comments;
use App\Entity\Images;
use App\Entity\Products;
use App\Entity\Type;
use App\Entity\User;
use App\Form\CommentType;
use App\Form\FilterType;
use App\Form\ProductType;
use App\Services\CommentService;
use App\Services\ImageService;
use App\Services\ProductService;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Null_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\JsonResponse;
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
    public function buying(
        Request $request,
        EntityManagerInterface $em
    ): Response
    {
        $options = $request->query->all();

        if ($request->isXmlHttpRequest()) {

            $products = $em->getRepository(Products::class)->getProductsLinstingByFilters($options);


            return new Response($this->renderView('_components/_product-card.html.twig', [
                'products' => $products])
            );
        }


        $products = $em->getRepository(Products::class)->getProductsLinstingByFilters($options);

        $types = $em->getRepository(Type::class)->findAll();

        return $this->render('products/productsBuy.html.twig', [
            'products' => $products,
            'types' => $types,
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
                    $img->setOriginalName($image->getClientOriginalName());
                    $img->setName($fichier);
                    $product->addImage($img);

//dd($image->getClientOriginalName());
//                    dd($form->get('images')->getData()[0]->getClientOriginalName());
//                    dd('la', $images[0]->getClientOriginalName());
//                    dd($images[0]->getClientOriginalName() === $img->getOriginalName());
//                    dd($images);

                    if ($images[0]->getClientOriginalName() === $img->getOriginalName()){
                        $img->setFirstView(true);
                    } else {
                        $img->setFirstView(false);
                    }
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

    #[Route('/buy/product/{slug}', name: 'app_product_buy_show')]
    public function productShow(
        Products $product,
        Request $request,
        CommentService $commentService
    ): Response
    {

        /** @var $user User */
        $user = $this->getUser();

        $comment = new Comments();

        $commentForm = $this->createForm(CommentType::class, $comment);

        $commentForm->handleRequest($request);

        if ($user) {
            if ($commentForm->isSubmitted() && $commentForm->isSubmitted()) {
                $commentService->commentFormSubmit($comment, $user, $product);
                return $this->redirect($request->getUri());
            }
        }

//        $allComments = $this->em->getRepository(Comments::class)->findBy(['product' => $product, 'published_at' => null]);

        $allComments = $this->em->getRepository(Comments::class)->getCommentByProductAndPushied($product->getId());

//        dd($allComments);

        return $this->render('products/productShow.html.twig', [
            'commentForm' => $commentForm,
            'allComments' => $allComments,
            'product' => $product
        ]);
    }
}
