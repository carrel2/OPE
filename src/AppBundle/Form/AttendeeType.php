<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AttendeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstname', null, array(
          'label' => 'First name',
        ))
        ->add('middleinitial', null, array(
          'label' => 'Middle initial',
        ))
        ->add('lastname', null, array(
          'label' => 'Last name',
        ))
        ->add('email')
        ->add('phonenumber', null, array(
          'label' => 'Phone number',
        ))
        ->add('opeEvents', 'Symfony\Bridge\Doctrine\Form\Type\EntityType', array(
          'class' => 'AppBundle:OPEEvent',
          'label' => 'Events attended',
          'choice_label' => 'title',
          'multiple' => true,
          'required' => false,
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Attendee',
            'attr' => array(
              'onsubmit' => 'submitForm(event, this)',
            )
        ));
    }

    public function getBlockPrefix()
    {
        return 'appbundle_attendee';
    }
}
