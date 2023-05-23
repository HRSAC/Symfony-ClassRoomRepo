<?php

namespace App\Form;


use App\Entity\Cours;
use App\Entity\Eleve;
use Doctrine\ORM\Mapping\Id;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EleveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('mail', EmailType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '100',
                ],
                'label' => 'Adresse email',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Email(),
                    new Assert\Length(['min' => 2, 'max' => 100]),
                ]
            ])
            ->add('nom', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '180',
                ],
                'label' => 'Nom',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'constraints' => [
                    
                    new Assert\Length(['min' => 2, 'max' => 180]),
                ]
            ])
            ->add('prenom', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '180',
                ],
                'label' => 'Prenom',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'constraints' => [
                    
                    new Assert\Length(['min' => 2, 'max' => 180]),
                ]
            ])
            ->add('date_naiss_eleve', DateType::class, [
                'attr' => [
                    'class' => 'date',
                ],
                'label' => 'date',
                'label_attr' => [
                    'class' => 'date'
                ],
                ])
            ->add('telephone_eleve', TextType::class, [
                    'attr' => [
                        'class' => 'form-control ',
                    ],
                    'label' => 'telephone',
                    'label_attr' => [
                        'class' => 'form-label'
                    ],
                    ])
            ->add('adresse', TextType::class, [
                        'attr' => [
                            'class' => 'form-control',
                        ],
                        'label' => 'adresse',
                        'label_attr' => [
                            'class' => 'form-label'
                        ],
                        ])
                    
                
                ->add('sexe',   TextType::class, [
                    'attr' => [
                        'class' => 'form-control',
                    ],
                    'label' => 'sexe',
                    'label_attr' => [
                        'class' => 'form-label'
                    ],
                ])/*
            ->add('cours' , ChoiceType::class, [
                'attr' => [
                    'class' => 'form-control btn btn-dark gap-5'
                ],
                'label' => 'cours',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'choices' => [
                    'html' => 'html',
                    'css' => 'css',
                    'php' => 'php',
                    'symfony' => 'symfony',
                ],
              
            ]);*/
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
            'data_class' => Eleve::class,
        ]);
    }
}
