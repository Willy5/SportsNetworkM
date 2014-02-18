<?php

namespace TheFireflies\SportBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class InstanceTeamType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('beginDate')
            ->add('endDate')
            ->add('team', 'entity', array(
                'label' => 'team',
                'class' => 'TheFirefliesSportBundle:Team',
                'required' => true ,
                'multiple' => false,
                'property' => 'name'
        ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TheFireflies\SportBundle\Entity\InstanceTeam'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'thefireflies_sportbundle_instanceteam';
    }
}
