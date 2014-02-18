<?php

namespace TheFireflies\SportBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EventType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('teams', 'entity', array(
                'label' => 'Equipes',
                'class' => 'TheFirefliesSportBundle:Team',
                'required' => false,
                'multiple' => true,
                'property' => 'name'
        ))
            ->add('beginDate')
            ->add('endDate')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TheFireflies\SportBundle\Entity\Event'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'thefireflies_sportbundle_event';
    }
}
