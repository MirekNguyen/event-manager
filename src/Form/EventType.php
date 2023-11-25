<?php

namespace App\Form;

use App\Entity\Event;
use App\Entity\EventCategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

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
        ->add('category', EntityType::class, [
            'attr' => [
                'class' => 'form-control',
            ],
            'class' => EventCategory::class,
            'choice_label' => 'name',
            'required' => false,
            'multiple' => true,
            'expanded' => true,
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
        ->add('attachment_filename', FileType::class, [
            'label' => 'Attachment (PDF file)',
            'mapped' => false,
            'required' => false,
            'attr' => [
                'class' => 'form-control',
            ],
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
