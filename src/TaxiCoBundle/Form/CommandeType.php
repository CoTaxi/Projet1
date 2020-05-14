<?php

namespace TaxiCoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('ptDepart')
            ->add('ptArrivee')
            ->add('date')
            ->add('time')
            ->add('modepaiement',ChoiceType::class,
                [
                    'choices'  => [
                        'MasterCard' => 'MasterCard' ,
                        'VISA' => 'VISA',
                        'e-dinar' => 'e-dinar',
                    ],
                ])
            ->add('typePaiement', TypePaiementType::class)
            ->add('submit',SubmitType::class);
        //->add('client')->add('vehicule')
        ;    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CommandeBundle\Entity\Commande'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'commandebundle_commande';
    }


}
