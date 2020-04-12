<?php


namespace TaxiCoBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
class VehiculeForm extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('etat',ChoiceType::class,array(
            'choices'=>array(
                'Accepte La Livraison Des Colis'=>'1',
                'N\'accepte Pas La Livraison Des Colis'=>'0',)))
            ->add('poidsmax')
            ->add('acceptC',ChoiceType::class,array(
                'choices'=>array(
                    'Categorie Lourd'=>"Categorie Lourd",
                    'Categorie Liquide'=>"Categorie Liquide",
                    'Categorie Leger'=>"Categorie Leger",)));

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