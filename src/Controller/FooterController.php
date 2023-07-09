<?php

namespace App\Controller;

use App\Entity\OpeningHours;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FooterController extends AbstractController
{
    #[Route('/footer', name: 'app_footer')]
    public function index(EntityManagerInterface $em): Response
    {
        $openingHours = $em->getRepository(OpeningHours::class)->findAll();


        return $this->render('_components/_footer.html.twig', [
            'openingHours' => $openingHours,
        ]);
    }
}
