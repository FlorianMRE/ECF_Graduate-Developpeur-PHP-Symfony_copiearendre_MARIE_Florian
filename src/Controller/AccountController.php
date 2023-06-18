<?php

namespace App\Controller;

use App\Entity\Opinion;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    #[Route('/account', name: 'app_account')]
    public function index(
        EntityManagerInterface $em,
    ): Response
    {
        $opinions = $em->getRepository(Opinion::class)->getOpinionsNotPublished();

        return $this->render('user/account.html.twig', [
            'opinions' => $opinions
        ]);
    }
}
