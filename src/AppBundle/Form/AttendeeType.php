<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AttendeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstname')
          ->add('middleinitial')
          ->add('lastname')
          ->add('email')
          ->add('phonenumber')
          ->add('opeEvents');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Attendee'
        ));
    }

    public function getBlockPrefix()
    {
        return 'appbundle_attendee';
    }
}
