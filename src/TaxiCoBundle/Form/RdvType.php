<?php

namespace TaxiCoBundle\Form;

use Doctrine\DBAL\Types\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Gregwar\CaptchaBundle\Type\CaptchaType;
use Symfony\Component\Form\FormTypeInterface;

class RdvType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('idChauffeur')
            ->add('dateRdv')
            ->add('garage',EntityType::class,array(
                'class'=>'TaxiCoBundle:garage','choice_label'=>'name','multiple'=>false,))
            ->add('status')
            ->add('service',EntityType::class,array(
                'class'=>'TaxiCoBundle:service','choice_label'=>'name','multiple'=>false,'expanded'  => true,));
//            ->add('Add',SubmitType::class);
//            ->add('garage')
//            ->add('service');
        $builder->add('captcha', CaptchaType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TaxiCoBundle\Entity\Rdv'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'taxicobundle_rdv';
    }


}
