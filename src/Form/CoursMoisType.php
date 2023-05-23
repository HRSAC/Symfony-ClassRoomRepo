<?php

namespace App\Form;

use App\Entity\Cours;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CoursMoisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateType::class, [
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('heure_debut', TimeType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('heure_fin', TimeType::class, [
                'attr' => [
                    'class' => 'form-control'    
                ]
            ])
            ->add('periode_debut', DateType::class, [
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('periode_fin', DateType::class, [
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('description', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('matiere', TextType::class,[
                'attr' => [
                    'class' => 'form-control',
            ]
            ])
            ->add('eleve_max', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]

            ] )
            ->add('user', EntityType::class, [
                'class' => User::class,
                'attr' => [
                    'class' => 'form-control'
                ]
            
            ] )
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary mt-4'
                ]
            ])
            ;
            // ->add('inscrits', EntityType::class, [
            //     'class' => Eleve::class,
            //     'choice_label' => function(Eleve $eleve) {
            //         return $eleve->getNom();
            //     },
            // ])
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cours::class,
        ]);
    }


}
