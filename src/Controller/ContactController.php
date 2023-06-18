<?php

namespace App\Controller;

use App\Entity\ClientInformations;
use App\Entity\ContactMail;
use App\Entity\OpeningHours;
use App\Form\ContactMailType;
use App\Services\ContactMailService;
use App\Services\ContactService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function contact(
        Request $request,
        EntityManagerInterface $em,
        ContactService $contactService,
        ContactMailService $contactMailService,
    ): Response
    {

        $contactMail = new ContactMail();

        $contactMailForm = $this->createForm(ContactMailType::class, $contactMail);

        $contactMailForm->handleRequest($request);

        if ($contactMailForm->isSubmitted() && $contactMailForm->isValid()) {

            $contactMailService->sendEmail($contactMail, false);

            unset($contactMail);
            unset($contactMailForm);
            $contactMail = new ContactMail();
            $contactMailForm = $this->createForm(ContactMailType::class, $contactMail);
        }

        $openingHours = $em->getRepository(OpeningHours::class)->findAll();

        $clientInformations = $em->getRepository(ClientInformations::class)->findAll()[0];

        return $this->render('contact/contact.html.twig', [
            'contactMailForm' => $contactMailForm,
            'openingHours' => $openingHours,
            'clientsInformations' => $clientInformations
        ]);
    }
}
