<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            
            /*->add('roles', ChoiceType::class, [
                'attr' => [
                    'class' => 'form-control btn btn-dark gap-5'
                ],
                'label' => 'roles',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'choices' => [
                    'Role Profs' => 'Role Profs',
                    'Role Admin' => 'Role Admin',
                ],
              
            ])*/
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'label' => 'mot de passe',
                    'attr' => [
                        'class' => 'form-control'
                    ]
                ],
                'second_options' => [
                    'label' => 'confirmation du mot de passe',
                    'attr' => [
                        'class' => 'form-control'
                    ]
                ],
                'invalid_message' => 'les mots de passe ne correspondent pas.'
            ] )
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
                'label' => 'date',
                'label_attr' => [
                    'class' => 'date'
                ],
                ])
            
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
            ->add('adresse', textType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'adresse',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                ])
                ->add('telephone', NumberType::class, [
                    'attr' => [
                        'class' => 'form-control',
                    ],
                    'label' => 'telephone',
                    'label_attr' => [
                        'class' => 'form-label'
                    ],
                    ])
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
            'data_class' => User::class,
        ]);
    }
}
