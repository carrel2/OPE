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
        ->add('receiveEmails', null, array(
          'label' => 'Check if this attendee wants to receive emails',
          'required' => false,
          'label_attr' => array(
            'class' => 'is-large',
          ),
        ))
        ->add('dietaryRestrictions', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType', array(
          'label' => 'Dietary Restrictions',
          'choices' => array(
            'No Dairy' => 'no_dairy',
            'No Gluten' => 'no_gluten',
          ),
          'multiple' => true,
          'choices_as_values' => true,
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
