<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class AdminUserController extends AbstractController
{
    #[Route('/admin/user/create', name: 'app_admin_user_create')]
    public function create(
        Request $request,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $passwordHasher,
    ): Response
    {
        $user = new User();

        $form = $this->createForm(RegisterType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if (in_array("ROLE_MODERATOR", $user->getRoles())) {
                $roles = $user->getRoles();
                $roles[] = "ROLE_EMPLOYEES";
                $user->setRoles($roles);
            }

            $plaintextPassword = $user->getPassword();

            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $plaintextPassword
            );

            $user->setPassword($hashedPassword);


            $user->setCreatedAt(new \DateTimeImmutable());

            $em->persist($user);
            $em->flush();

            if (in_array("ROLE_MODERATOR", $user->getRoles())) {
            $this->addFlash('success',  'Modérateur créer avec succès');
            } else {
                $this->addFlash('success',  'Employé créer avec succès');
            }


            return $this->redirectToRoute('app_account');
        } elseif ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash('error', 'Un problème est survenue...');
        }

        return $this->render('admin/user/adminUsers.html.twig', [
            'formView' => $form->createView(),
        ]);
    }
}
