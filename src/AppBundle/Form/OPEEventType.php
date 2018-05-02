<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OPEEventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title')
          ->add('dates', 'Symfony\Component\Form\Extension\Core\Type\CollectionType', array(
            'entry_type' => 'Symfony\Component\Form\Extension\Core\Type\DateType',
            'allow_add' => true,
            'allow_delete' => true,
          ))
          ->add('attendees', 'Symfony\Bridge\Doctrine\Form\Type\EntityType', array(
            'class' => 'AppBundle:Attendee',
            'choice_label' => 'fullName',
            'multiple' => true,
            'required' => false,
          ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\OPEEvent'
        ));
    }

    public function getBlockPrefix()
    {
        return 'appbundle_opeevent';
    }
}
