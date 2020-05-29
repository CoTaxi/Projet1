<?php

namespace TaxiCoBundle\Form;

use Gregwar\CaptchaBundle\Type\CaptchaType;
use Symfony\Component\DomCrawler\Field\TextareaFormField;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
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
            ->add('marque',ChoiceType::class,array('choices'=> array(

                'Alfa Romeo'=> 'Alfa Romeo' ,
                'Audi'=> 'Audi' ,
                'Ford'=> 'Ford' ,
                'Peugeot'=> 'Peugeot' ,
            )))
            ->add('modele')
            ->add('cartegrise',FileType::class, array('data_class'=>null, 'required'=>false))
            ->add('couleur',ChoiceType::class,array('choices'=> array(

                'Blanc'=> 'Blanc' ,
                'Bleu'=> 'Bleu' ,
                'Rouge'=> 'Rouge' ,
                'Vert'=> 'Vert' ,
                'Noir'=> 'Noir' ,
                'Jaune'=> 'Jaune' ,
            )))
            ->add('type',ChoiceType::class,array('choices'=> array(

                'Covoiturage'=> 'Covoiturage' ,
                'Taxi'=> 'Taxi' ,
            )))
            ->add('position',ChoiceType::class,array('choices'=> array(

                'Aryanah'=> 'Aryanah' ,
                'Bardo'=> 'Bardo' ,
                'Centre ville'=> 'Centre ville' ,
            )))
            ->add('destination')
            ->add('places',ChoiceType::class,array('choices'=> array(

                '1'=> '1' ,
                '2'=> '2' ,
                '3'=> '3' ,
                '4'=> '4' ,
            )))
            ->add('zone',ChoiceType::class,array('choices'=> array(

                'Nord'=> 'Nord' ,
                'Sud'=> 'Sud' ,
                'East'=> 'East' ,
                'Ouest'=> 'Ouest' ,
            )))
            ->add('acceptC',ChoiceType::class,array('choices'=> array(

                'Oui'=> 'Oui' ,
                'Non'=> 'Non' ,
            )))
            ->add('captcha', CaptchaType::class)
;
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
