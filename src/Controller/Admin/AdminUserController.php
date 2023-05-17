<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminUserController extends AbstractController
{
    #[Route('/admin/admin/user', name: 'app_admin_admin_user')]
    public function index(): Response
    {
        return $this->render('admin/user/adminProducts.html.twig', [
            'controller_name' => 'AdminUserController',
        ]);
    }
}
