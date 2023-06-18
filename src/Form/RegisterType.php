<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\CallbackTransformer;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('roles', ChoiceType::class, [
                'label' => 'Role utilisateur',
                'choices' => [
                    'Employé' => "ROLE_EMPLOYEES",
                    'Modérateur' => "ROLE_MODERATOR",
                ]
            ])
            ->add('gender', ChoiceType::class, [
                'label' => 'Genre',
                'placeholder' => 'Choisissez votre Genre',
                'required' => true,
                'choices' => [
                    'Homme' => 'male',
                    'Femme' => 'female',
                    'Non précisé' => 'not say'
                ],
                'attr' => [
                    'placeholder' => 'Genre'
                ]
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Entrez votre prénom'
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Entrez votre nom'
                ]
            ])
            ->add('phone_tel', TelType::class, [
                'label' => 'Numéro de téléphone',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Entrez votre numéro de téléphone'
                ]
            ])

            ->add('email', EmailType::class, [
                'label' => 'Email',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Entrez votre email'
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'required' => true,
                'invalid_message' => 'Les mots de passe doivent être identiques',
                'first_options'  => ['label' => 'Password', 'attr' => ['placeholder' => 'Entrez votre mot de passe']],
                'second_options' => ['label' => 'Vérification du mot de passe', 'attr' => ['placeholder' => 'Entrez de nouveau votre mot de passe']],
                'error_bubbling' => true
            ])
        ;
        $builder->get('roles')
            ->addModelTransformer(new CallbackTransformer(
                function ($rolesArray) {
                    // transform the array to a string
                    return  $rolesArray[0];
                },
                function ($rolesString) {
                    // transform the string back to an array
                    return [$rolesString];
                }
            ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
