<?php

namespace App\Controller;

use App\Entity\Opinion;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OpinionController extends AbstractController
{
    #[Route('/opinion/published/{id}', name: 'app_opinion_validate')]
    public function validate(
        Opinion $opinion,
        EntityManagerInterface $em
    ): Response
    {
        $opinion->setPublishedAt(new \DateTimeImmutable());

        $em->persist($opinion);
        $em->flush();

        $this->addFlash('success', 'Avis validé');

        return $this->redirectToRoute('app_account');
    }

    #[Route('/opinion/delete/{id}', name: 'app_opinion_delete')]
    public function delete(
        Opinion $opinion,
        EntityManagerInterface $em
    ): Response
    {
        $em->getRepository(Opinion::class)->remove($opinion, true);

        $this->addFlash('error', 'Commentaire supprimer');

        return $this->redirectToRoute('app_account');
    }
}
