<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminContactController extends AbstractController
{
    #[Route('/admin/admin/contact', name: 'app_admin_admin_contact')]
    public function index(): Response
    {
        return $this->render('admin/contact/adminProducts.html.twig', [
            'controller_name' => 'AdminContactController',
        ]);
    }
}
