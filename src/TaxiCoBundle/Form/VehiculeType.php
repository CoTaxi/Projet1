<?php

namespace TaxiCoBundle\Form;

use Gregwar\CaptchaBundle\Type\CaptchaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehiculeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('matricule',FileType::class, array('data_class'=>null, 'required'=>false))
            ->add('marque',ChoiceType::class,array(
                'choices'=>array(
                    'Alfa Romeo'=>"Alfa Romeo",
                    'Audi'=>"Audi",
                    'Citroen'=>"Citroen",
                    'Ford'=>"Ford",
                    'Peugeot'=>"Peugeot",)))
            ->add('modele')
            ->add('cartegrise',FileType::class, array('data_class'=>null, 'required'=>false))
            ->add('couleur')
            ->add('type',ChoiceType::class,array(
                'choices'=>array(
                    'Taxi'=>"taxi",
                    'Covoiturage'=>"covoiturage",)))
            ->add('position')
            ->add('destination')
            ->add('places')
            ->add('zone')
            ->add('acceptC')
            ->add('captcha', CaptchaType::class)
            ->add('Ajouter Vehicule',SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TaxiCoBundle\Entity\Vehicule'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'taxicobundle_vehicule';
    }


}
