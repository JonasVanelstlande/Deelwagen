<?php

namespace App\Form;

use App\Entity\Kilometers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class KilometerFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('startKm', NumberType::class)
            ->add('endKm', NumberType::class)
            ->add('totalKm', NumberType::class, [
                'attr' => [
                    'readonly' => true,
                ]
            ])
            ->add('date', DateType::class)
            // ->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Kilometers::class,
        ]);
    }
}
