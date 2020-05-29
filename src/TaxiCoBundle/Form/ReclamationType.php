<?php

namespace TaxiCoBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\VarDumper\Tests\Fixtures\DateTimeChild;
use TaxiCoBundle\Entity\User;

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

            ->add('chauff', EntityType::class, array(
                'class' => 'TaxiCoBundle:User',
                'label' => 'Chauffeur : ',
                'attr' => ['class' => 'form-control form-control-lg'],
                'multiple' => false,
                'disabled' => true,
                'choice_label' => function(User $user){
                    return $user->getPrenom() . ' ' . $user->getNom();
                },
            ))
            ->add('message', TextareaType::class, array(
                'attr' => ['class' => 'form-control form-control-lg',
                    'placeholder' => 'Votre message ici...',
                    'cols' => '30',
                    'rows' => '8'],
            ));
        $builder->get('Objet')->addEventListener(FormEvents::POST_SET_DATA,
            function (FormEvent $event) {
                $rec = $event->getData();
                var_dump($rec);
                $form = $event->getForm();
                if ($rec!='Voiture/Chauffeur') {
                    $form->getParent()->add('chauff', ChoiceType::class, array(
                        'label' => 'Chauffeur : ',
                        'attr' => ['class' => 'form-control form-control-lg'],
                        'multiple' => false,
                        'disabled' => true,
                        'choices' => array('None' => "None",)
                    ));
                } else {
                    $form->getParent()->add('chauff', EntityType::class, array(
                        'class' => 'TaxiCoBundle:User',
                        'label' => 'Chauffeur : ',
                        'attr' => ['class' => 'form-control form-control-lg'],
                        'multiple' => false,
                        'choice_label' => function (User $user) {
                            return $user->getPrenom() . ' ' . $user->getNom();
                        },
                    ));
                }
            });
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
