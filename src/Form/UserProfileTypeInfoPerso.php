<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Validator\Constraints as Assert;

class UserProfileTypeInfoPerso extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

      
   
        ->add('nom_user', TextType::class, [
            'attr' => [
                'class' => 'form-control',
                'minlenght' => '2',
                'maxlenght' => '100',
            ],
            'label' => 'Nom',
            'label_attr' => [
                'class' => 'form-abel'
            ],
            'constraints' => [
                new Assert\NotBlank(),
                new Assert\Length(['min' => 2, 'max' => 100]),
            ]
        ])
        ->add('prenom_user', TextType::class, [
            'attr' => [
                'class' => 'form-control',
                'minlenght' => '2',
                'maxlenght' => '50',
            ],
            'label' => 'Prénom',
            'label_attr' => [
                'class' => 'form-abel'
            ],
            'constraints' => [
                new Assert\NotBlank(),
                new Assert\Length(['min' => 2, 'max' => 50]),
            ]
        ])
        ->add('date_naiss_user', DateType::class, [
            'attr' => [
                'class' => 'date',
            ],
            'label' => 'Date',
            'label_attr' => [
                'class' => 'date'
            ],
            ])
        
        ->add('submit', SubmitType::class, [
            'attr' => [
                'class' => 'btn btn-primary mt-4'
            ]
        ])

        ->add('annuler', ButtonType::class, [
            'attr' => [
                'class' => 'btn btn-primary mt-4',
            'method' => 'GET',
            ]

        ])
        ;
}

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
