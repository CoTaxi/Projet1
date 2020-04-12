<?php

namespace ContratBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use VehiculeBundle\Entity\User;
use Gregwar\CaptchaBundle\Type\CaptchaType;

class ContratType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder            ->add('Email',EntityType::class,[
            'class' => User::class,
            'mapped' => false,
            'choice_label' => 'Email'
        ] )
            ->add('typeC',ChoiceType::class,array(
                'choices'=>array(
                    'CDD'=>"CDD",
                    'CDI'=>"CDI",))
                )
            ->add('duree')
            ->add('idChauff')
            ->add('captcha', CaptchaType::class)
        ->add('Ajouter Contrat',SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ContratBundle\Entity\Contrat'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'contratbundle_contrat';
    }


}
