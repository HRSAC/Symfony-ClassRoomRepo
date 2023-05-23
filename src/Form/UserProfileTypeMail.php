<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints as Assert;

use Symfony\Component\Form\Extension\Core\Type\EmailType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Assert\NotBlank;


class UserProfileTypeMail extends AbstractType
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
 

        ->add('submit', SubmitType::class, [
            'attr' => [
                'class' => 'btn btn-primary mt-4'
            ]
            ]);

        }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}