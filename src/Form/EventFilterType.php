<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add(
            'nameFilter',
            TextType::class,
            [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Event name...',
                ],
                'required' => false
            ]
        )
        ->add(
            'filter',
            SubmitType::class,
            [
                'attr' => [
                    'class' => 'btn btn-primary'
                ],
            ]
        )
        ->getForm();
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
