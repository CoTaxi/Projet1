<?php

namespace TaxiCoBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\VarDumper\Tests\Fixtures\DateTimeChild;

class ReclamationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('Objet', EntityType::class, array(
            'class' => 'TaxiCoBundle:typereclamation',
            'choice_label' => 'titre',
            'label' => 'Objet : ',
            'attr' => ['class' => 'form-control form-control-lg'],
            'multiple' => false,
        ))
            ->add('message', TextareaType::class, array(
                'attr' => ['class' => 'form-control form-control-lg',
                    'placeholder' => 'Votre message ici...',
                    'cols' => '30',
                    'rows' => '8'],
            ));
            //->add('Ajouter', SubmitType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TaxiCoBundle\Entity\Reclamation'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'taxicobundle_reclamation';
    }


}
