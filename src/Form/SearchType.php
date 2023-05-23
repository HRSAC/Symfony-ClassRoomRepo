<?php

namespace App\Form;

use App\Entity\Cours;
use App\classe\Search;
use Symfony\Component\Form\AbstractType; 
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
              ->add('cours', EntityType::class, [
                'label' => false,
                'required' => false,
                'class' => Cours::class,
                'multiple' => true,
                'expanded' => true,
              ])
              ->add( 'submit', SubmitType::class, [
              'label' => 'Ok',
              ])
              ;
    }



    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Search::class,
            'method' => 'GET',
            'crsf_protection' => false,
        ]);
    }

    //Sert à ne pas avoir le nom de de la classe dans l'URL 
    public function getBlockPrefix(){
        return '';
    }

    
}
