<?php

namespace App\Form;

use App\Entity\Kilometers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class KilometerFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('startKm', IntegerType::class, [
                'attr' => [
                    'placeholder' => "bv. 13400"                    
                ]
            ])
            ->add('endKm', IntegerType::class, [
                'attr' => [
                    'placeholder' => "bv. 13500"                    
                ]
            ])
            ->add('totalKm', IntegerType::class, [
                'attr' => [
                    'readonly' => true,
                    'value' => 0

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
