<?php

namespace ColisBundle\Form;

use Gregwar\CaptchaBundle\Type\CaptchaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
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
            ->add('depart',ChoiceType::class,['choices' => [ 'Depart' => [
            'Bizerte'=> 'bizerte' ,
            'Tunis'=> 'Tunis' ,
            'ariana'=> 'ariana' ,
            'Zaghwen'=> 'zaghwen' ,
            ]]])
            ->add('destination',ChoiceType::class,['choices' => [ 'Destination' => [
                'Bizerte'=> 'bizerte' ,
                'Tunis'=> 'Tunis' ,
                'ariana'=> 'ariana' ,
                'Zaghwen'=> 'zaghwen' ,
            ]]])
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
