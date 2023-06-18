<?php

namespace App\Form;

use App\Entity\OpeningHours;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('close_day', CheckboxType::class, [
                'label' => 'Fermé',
                'required' => false
            ])
            ->add('am_open', TimeType::class, [
                'label' => 'Ouverture',
            ])
            ->add('am_close', TimeType::class, [
                'label' => 'Fermeture'
            ])
            ->add('pm_open', TimeType::class, [
                'label' => 'Ouverture'
            ])
            ->add('pm_close', TimeType::class, [
                'label' => 'Fermeture',
                'placeholder' => ''
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => OpeningHours::class,
        ]);
    }
}
