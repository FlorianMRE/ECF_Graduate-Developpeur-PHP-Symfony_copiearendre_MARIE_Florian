<?php

namespace App\Controller;

use App\Entity\Prestations;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GarageServicesController extends AbstractController
{
    #[Route('/services', name: 'app_services')]
    public function index(
        EntityManagerInterface $em
    ): Response
    {
        $allPrestations = $em->getRepository(Prestations::class)->findAll();

        return $this->render('garage_services/garageServices.html.twig', [
            'allPrestations' => $allPrestations,
        ]);
    }
}
