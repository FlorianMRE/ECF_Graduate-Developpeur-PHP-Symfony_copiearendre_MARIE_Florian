<?php

namespace App\Controller;

use App\Entity\Prestations;
use App\Form\PrestationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrestationController extends AbstractController
{

    public function __construct(
        private EntityManagerInterface $em
    )
    {
    }

    #[Route('/prestation/create', name: 'app_prestation_create')]
    public function createPrestation(
        Request $request,
    ): Response
    {

        $prestation = new Prestations();

        $form = $this->createForm(PrestationType::class, $prestation);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($prestation);
            $this->em->flush();

            return $this->redirectToRoute('app_services');
        }

        return $this->render('prestation/prestation_create.html.twig', [
            'formPrestation' => $form->createView(),
        ]);
    }

    #[Route('/prestation/delete/{id}', name: 'app_prestation_delete')]
    public function deletePrestation(
        Prestations $prestation
    ): Response
    {
        $this->em->getRepository(Prestations::class)->remove($prestation, true);


        return $this->redirectToRoute('app_services');
    }

}
