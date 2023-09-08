<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\LoginType;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function login(
        AuthenticationUtils $authenticationUtils,
    ): Response
    {
        $form = $this->createForm(LoginType::class);

        $error = $authenticationUtils->getLastAuthenticationError();

        return $this->render('user/login.html.twig', [
            'formView' => $form->createView(),
            'error' => $error
        ]);
    }

    #[Route('/register', name: 'app_register')]
    public function register(
        Request $request,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $passwordHasher,
        Security $security
    ): Response
    {
        $user = new User();

        $form = $this->createForm(RegisterType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user->setRoles([]);

            $plaintextPassword = $user->getPassword();

            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $plaintextPassword
            );

            $user->setCreatedAt(new \DateTimeImmutable());

            $user->setPassword($hashedPassword);

            $em->persist($user);
            $em->flush();

            $security->login($user);

            $this->addFlash('success', 'Compte créer avec succès');


            return $this->redirectToRoute('app_home');
        } elseif ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash('error', 'Un problème est survenue...');
        }

        return $this->render('user/register.html.twig', [
            'formView' => $form->createView(),
            'error' => null
        ]);
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout()
    {
        $this->addFlash('warning', 'Vous avez était déconnecté');
    }


    #[Route('/user/{id}/delete', name: 'app_user_delete')]
    public function delete(
        User $user,
        EntityManagerInterface $em,
    ): Response
    {
        if (!$user) {
            throw new BadRequestException('Aucun compte associé');
        }

        if ($this->getUser()->getId() !== $user->getId()) {
            throw new AccessDeniedException('Ceci n\'est pas votre compte');
        }

        $em->getRepository(User::class)->remove($user, true);

        $session = new Session();
        $session->invalidate();

        $this->addFlash('success', 'Compte supprimer');

        return $this->redirectToRoute('app_register');
    }
}
