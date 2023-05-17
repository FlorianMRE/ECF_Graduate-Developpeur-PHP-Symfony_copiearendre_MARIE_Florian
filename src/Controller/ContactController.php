<?php

namespace App\Controller;

use App\Repository\OpeningHoursRepository;
use App\Services\ContactService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function PHPUnit\Framework\isEmpty;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function contact(
        OpeningHoursRepository $openingHoursRepository,
        ContactService $contactService,
    ): Response
    {
        $openingHours = $openingHoursRepository->findAll();

        $openingHoursArray = $contactService->openingHours($openingHours);

        return $this->render('contact/adminProducts.html.twig', [
            'controller_name' => 'ContactController',
            'openingHours' => $openingHoursArray
        ]);
    }
}
