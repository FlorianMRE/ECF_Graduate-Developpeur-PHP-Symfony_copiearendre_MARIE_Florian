<?php

namespace App\Form;

use App\Entity\Products;
use App\Entity\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'required' => true,
                'label' => 'Nom du produit',
                'attr' => [
                    'placeholder' => 'Entrez le nom de votre produit'
                ]
            ])
            ->add('description', TextareaType::class, [
                'required' => true,
                'label' => 'Description',
                'attr' => [
                    'placeholder' => 'Entrez une description pour ce produit'
                ]
            ])
            ->add('price', MoneyType::class, [
                'required' => true,
                'label' => 'Prix (€)',
                'divisor' => 100,
                'html5' => true,
                'currency' => false,
                'attr' => [
                    'placeholder' => 'Entrez un prix en euros'
                ]
            ])
            ->add('images', FileType::class, [
                'label' => false,
                'multiple' => true,
                'mapped' => false,
                'required' => false
            ])
            ->add('type', EntityType::class, [
                'label' => 'Type',
                'class' => Type::class,
                'choice_label' => 'type',
                'placeholder' => 'Choisissez une catégorie'
            ])
            ->add('kilometrages', IntegerType::class, [
                'label' => 'kilometrages',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Entrez le kilométrage du véhicule'
                ]
            ])->add('years_of_release', IntegerType::class, [
                'label' => 'Année de mise en circulation',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Entrez l\'année de mise en circulation'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Products::class,
        ]);
    }
}
