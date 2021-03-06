<?php

namespace TaxiCoBundle\Form;

use Gregwar\CaptchaBundle\Type\CaptchaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\DomCrawler\Field\TextareaFormField;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ColisType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomcategorie',EntityType::class,array('class'=>'ColisBundle:Category','choice_label'=>'categorie'))
            ->add('depart',ChoiceType::class,array('choices'=> array(

            'Bizerte'=> 'bizerte' ,
            'Tunis'=> 'Tunis' ,
            'ariana'=> 'ariana' ,
            'Zaghwen'=> 'zaghwen' ,
        )))
            ->add('destination',ChoiceType::class,array('choices'=> array(

                'Bizerte'=> 'bizerte' ,
                'Tunis'=> 'Tunis' ,
                'ariana'=> 'ariana' ,
                'Zaghwen'=> 'zaghwen' ,
            )))
            ->add('nomExpediteur')

            ->add('mailExpediteur')
            ->add('poids')
            ->add('etat' ,HiddenType::class, [
        'data' => 0,
    ])

        ->add('nomDestinataire')
            ->add('telDestinataire')
            ->add('mailDestinataire')
            ->add('captcha', CaptchaType::class);
           ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ColisBundle\Entity\Colis'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'colisbundle_colis';
    }


}
