<?php

namespace App\Controller;

use App\Entity\Opinion;
use App\Form\OpinionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(
        Request $request,
        EntityManagerInterface $em,
    ): Response
    {

        $opinion = new Opinion();

        $form = $this->createForm(OpinionType::class, $opinion);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $opinion->setCreatedAt(new \DateTimeImmutable());

            $em->persist($opinion);
            $em->flush();

            $this->addFlash('success', 'Votre avis à bien était envoyé');
            $this->addFlash('warning', 'Votre avis doit être vérifier avant d\'apparaître');

            unset($opinion);
            unset($form);

            return $this->redirect($request->getUri());
        } elseif ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash('error', 'Un problème est survenue...');
        }

        $opinions = $em->getRepository(Opinion::class)->getOpinionsPublished();

        return $this->render('home/home.html.twig', [
            'formOpinion' => $form->createView(),
            'opinions' => $opinions
        ]);
    }
}
