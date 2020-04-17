<?php

namespace TaxiCoBundle\Form;

//use FOS\UserBundle\Event\FormEvent;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;
use TaxiCoBundle\Entity\Rdv;
use TaxiCoBundle\Repository\GarageRepository;
use TaxiCoBundle\Repository\RdvRepository;
use TaxiCoBundle\Repository\ServiceRepository;
use TaxiCoBundle\TaxiCoBundle;

//use FOS\TaxiCoBundle\FOSUserEvents;


class ReserveType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('service',EntityType::class,array(
            'class'=>'TaxiCoBundle:Service',
//            'attr' => ['value' => 'lavage'],
//            'choice_value'=> 'lavage',
            'choice_label'=>'name',
            'placeholder' => 'Select Service',
            'mapped' => false,
            'multiple'=>false,
//            'expanded'  => true,
            'required'=>false,
            ));
 $builder->add('garage',EntityType::class,array(
            'class'=>'TaxiCoBundle:Garage',
//            'attr' => ['value' => 'lavage'],
//            'choice_value'=> 'lavage',
            'choice_label'=>'name',
            'placeholder' => 'Select Service',
            'mapped' => false,
            'multiple'=>false,
//            'expanded'  => true,
            'required'=>false,
            ));
 $builder->add('rdv',EntityType::class,array(
            'class'=>'TaxiCoBundle:Rdv',
//            'attr' => ['value' => 'lavage'],
//            'choice_value'=> 'lavage',

     'choice_label'=>'dateRdv',
            'placeholder' => 'Select Service',
            'mapped' => false,
            'multiple'=>false,
//            'expanded'  => true,
            'required'=>false,
            ));

        $builder->get('service')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                $form = $event->getForm();
                $form1 = $event->getForm()->getData();
                $id = $form1 ? $form1->getIdService() : 1;
                $builder = $form->getParent()->getConfig()->getFormFactory()->createNamedBuilder(
                    'garage',
                    EntityType::class,
                    null,
                    [
                        'class' => 'TaxiCoBundle:Garage',
                        'choice_label' => 'name',
                        'auto_initialize' => false,
                        'mapped' => false,
                        'multiple' => false,
//            'expanded'  => true,
                        'required' => false,
                        'placeholder' => '-- Choose a garage --',
                        'query_builder' => function (GarageRepository $sr) use ($id) {
                            return $sr->createQueryBuilder('s')
                                ->where('s.idService =?1 ')
                                ->setParameter(1, $id);

                        }
                    ]
                );
                $builder->addEventListener(
                    FormEvents::POST_SUBMIT,
                    function (FormEvent $event) {
                        $form = $event->getForm();
                        $form1 =$event->getForm()->getData();
                        $id = $form1 ? $form1->getIdGarage() : 2 ;
                        $form ->getParent()->add('rdv', EntityType::class, [
                    'class' => 'TaxiCoBundle:Rdv',
                    'choice_label' => 'dateRdv',
                            'auto_initialize' => false,
                            'mapped' => false,
                            'multiple' => false,
                            'required' => false,
                    'placeholder' => '-- Choose a Rdv --',
                    'query_builder' =>  function(RdvRepository $sr) use ($id) {
                          return $sr->createQueryBuilder('s')
                            ->where('s.idGarage =?1 ')
                            ->setParameter(1,$id);

                    }

                ]

                    );
//                        $data= $event->getForm()->getParent();
//                        dump($data);
//                        /* @var $rdv TaxiCoBundle:Rdv */
//                        $rdv =$data->setStatus("nondisponible");

//                        dump($event->getForm());
                    }
                );

                $form->getParent()->add($builder->getForm());
            }
        );
//        $builder->addEventListener(
//            FormEvents::POST_SET_DATA,
//            function(FormEvent $event){
//                $data= $event->getData();
//            }
//        );

//        $builder ->add('Add',SubmitType::class);

            }
    /**
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
