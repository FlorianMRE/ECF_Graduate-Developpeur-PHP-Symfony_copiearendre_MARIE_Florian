<?php

namespace App\Controller;

use App\Entity\ClientInformations;
use App\Entity\OpeningHours;
use App\Repository\OpeningHoursRepository;
use App\Services\ContactService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function PHPUnit\Framework\isEmpty;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function contact(
        EntityManagerInterface $em,
        ContactService $contactService,
    ): Response
    {
        $openingHours = $em->getRepository(OpeningHours::class)->findAll();

        $clientInformations = $em->getRepository(ClientInformations::class)->findAll()[0];

//        $openingHoursArray = $contactService->openingHours($openingHours);

        return $this->render('contact/contact.html.twig', [
            'controller_name' => 'ContactController',
            'openingHours' => $openingHours,
            'clientsInformations' => $clientInformations
        ]);
    }
}
