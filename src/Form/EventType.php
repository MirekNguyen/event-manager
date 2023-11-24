<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', TextType::class, [
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'Event name...',
            ],
        ])
        ->add('description', TextareaType::class, [
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'Description...',
            ],
            'required' => false,
        ])
        ->add('participants', IntegerType::class, [
            'attr' => [
                'class' => 'form-control'
            ]
        ])
        ->add('category', ChoiceType::class, [
        ])
        ->add('start_date', DateTimeType::class, [
            'attr' => [
                'class' => 'form-control',
            ],
            'html5' => false,
            'widget' => 'single_text',
            'format' => 'dd/MM/yyyy HH:mm'
        ])
        ->add('end_date', DateTimeType::class, [
            'attr' => [
                'class' => 'form-control',
            ],
            'html5' => false,
            'widget' => 'single_text',
            'format' => 'dd/MM/yyyy HH:mm'
        ])
        ->add('save', SubmitType::class, [
            'attr' => [
                'class' => 'btn btn-primary'
            ]
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
