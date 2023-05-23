<?php

namespace App\Form;


use App\Entity\User;
use App\Entity\Cours;
use App\Entity\Eleve;
use Symfony\Component\Form\AbstractType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class CoursType extends AbstractType
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
