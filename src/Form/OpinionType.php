<?php

namespace App\Form;

use App\Entity\Opinion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OpinionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => '(obligatoire)',
                'required' => true,
                'label_attr' => [
                    'class' => 'mini-text'
                ],
                'attr' => [
                    'placeholder' => 'Entrez votre email'
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => '(obligatoire)',
                'required' => true,
                'label_attr' => [
                    'class' => 'mini-text'
                ],
                'attr' => [
                    'placeholder' => 'Entrez votre nom'
                ]
            ])
            ->add('firstname', TextType::class, [
                'label' => '(facultatif)',
                'label_attr' => [
                    'class' => 'mini-text'
                ],
                'required' => false,
                'attr' => [
                    'placeholder' => 'Entrez votre prénom'
                ]
            ])
            ->add('comment', TextareaType::class, [
                'label' => '(obligatoire)',
                'required' => true,
                'label_attr' => [
                    'class' => 'mini-text'
                ],
                'attr' => [
                    'placeholder' => 'Entrez votre commentaire'
                ]
            ])
            ->add('note', IntegerType::class, [
                'label' => '(obligatoire)',
                'required' => true,
                'label_attr' => [
                    'class' => 'mini-text'
                ],
                'attr' => [
                    'placeholder' => 'Entrez une note sur 10'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Opinion::class,
        ]);
    }
}
