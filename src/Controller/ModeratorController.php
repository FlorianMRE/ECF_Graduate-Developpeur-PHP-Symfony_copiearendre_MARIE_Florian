<?php

namespace App\Controller;

use App\Entity\Comments;
use App\Repository\CommentsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModeratorController extends AbstractController
{
    #[Route('/moderator', name: 'app_moderator')]
    public function index(EntityManagerInterface $em): Response
    {

        $products = $em->getRepository(Comments::class)->getProductWithNoPublishedComment();

        return $this->render('moderator/moderator.html.twig', [
            'controller_name' => 'ModeratorController',
            'products' => $products,
        ]);
    }
}
