<?php

namespace App\Controller\Admin;

use App\Entity\ClientInformations;
use App\Entity\OpeningHours;
use App\Form\HoursType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminContactController extends AbstractController
{
    #[Route('/admin/contact/edit/{week_day}', name: 'app_admin_contact_edit')]
    public function setHours(
        OpeningHours $openingHour,
        Request $request,
        EntityManagerInterface $em,): Response
    {

        $openingHours = $em->getRepository(OpeningHours::class)->findAll();

        $clientInformations = $em->getRepository(ClientInformations::class)->findAll()[0];

        $form = $this->createForm(HoursType::class, $openingHour);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!is_null($openingHour->getAmOpen()) && !empty($openingHour->getAmOpen())) {
                $openingHour->setAmOpen($openingHour->getAmOpen());
            }
            if (!is_null($openingHour->getAmClose()) && !empty($openingHour->getAmClose())) {
                $openingHour->setAmClose($openingHour->getAmClose());
            }
            if (!is_null($openingHour->getPmOpen()) && !empty($openingHour->getPmOpen())) {
                $openingHour->setPmOpen($openingHour->getPmOpen());
            }
            if (!is_null($openingHour->getPmClose()) && !empty($openingHour->getPmClose())) {
                $openingHour->setPmClose($openingHour->getPmClose());
            }
            if ($openingHour->isCloseDay() !== true || $openingHour->isCloseDay() !== false) {
                $openingHour->setPmClose($openingHour->getPmClose());
            }

            $em->persist($openingHour);
            $em->flush();

            return $this->redirectToRoute('app_contact', [
                'openingHours' => $openingHours,
                'clientsInformations' => $clientInformations,
            ]);
        }

        return $this->render('admin/contact/adminContact.html.twig', [
            'formView' => $form->createView(),
            'hour' => $openingHour
        ]);
    }


}
