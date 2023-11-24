<?php

namespace App\Form;

use App\Entity\EventCategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
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
        ->add('start_date', DateTimeType::class, [
            'attr' => [
                'class' => 'form-control',
            ],
            'html5' => false,
            'widget' => 'single_text',
            'format' => 'dd/MM/yyyy',
            'required' => false
        ])
        ->add('end_date', DateTimeType::class, [
            'attr' => [
                'class' => 'form-control',
            ],
            'html5' => false,
            'widget' => 'single_text',
            'format' => 'dd/MM/yyyy',
            'required' => false
        ])
        ->add('category', EntityType::class, [
            'class' => EventCategory::class,
            'choice_label' => 'name',
            'required' => false,
            # 'multiple' => true,
            # 'expanded' => true,
        ])
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
