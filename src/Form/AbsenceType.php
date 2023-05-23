<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Eleve;
use App\Entity\Absence;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AbsenceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateType::class, [
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('justificatif', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('peut', EntityType::class, [
                'class' => Eleve::class,
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Prénom',
                'label_attr' => [
                    'class' => 'form-abel'
                ],
            
            ] )
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary mt-4'
                ]
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Absence::class,
        ]);
    }
}
