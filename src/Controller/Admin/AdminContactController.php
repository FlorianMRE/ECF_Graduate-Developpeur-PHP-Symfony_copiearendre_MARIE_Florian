<?php

namespace App\Controller\Admin;

use App\Entity\OpeningHours;
use App\Form\HoursType;
use App\Services\ContactService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminContactController extends AbstractController
{
    #[Route('/admin/admin/contact', name: 'app_admin_admin_contact')]
    public function setHours(EntityManagerInterface $em, ContactService $contactService): Response
    {

        $hours = $em->getRepository(OpeningHours::class)->findAll();

        $form = $this->createForm(HoursType::class);

        $openingHoursArray = $contactService->openingHours($hours);

        return $this->render('admin/contact/adminContact.html.twig', [
            'formView' => $form->createView(),
            'hours' => $openingHoursArray
        ]);
    }
}
