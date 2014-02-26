<?php

namespace TheFireflies\SportBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SportMatchType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//         var_dump($builder->getData()->getStatusList());
        $builder
            ->add('summary')
            ->add('date')
            ->add('beginTime')
            ->add('status', 'choice', array(
            'choices' => $builder->getData()->getStatusList(), 
            'empty_value' => 'Choisissez un statut',
        ))
            ->add('homeTeam', 'entity', array(
                'label' => 'Equipe receveuse',
                'class' => 'TheFirefliesSportBundle:Team',
                'required' => true,
                'multiple' => false,
                'property' => 'name'
        ))
            ->add('awayTeam', 'entity', array(
                'label' => 'Equipe visiteuse',
                'class' => 'TheFirefliesSportBundle:Team',
                'required' => true,
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
            'data_class' => 'TheFireflies\SportBundle\Entity\SportMatch'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'thefireflies_sportbundle_sportMatch';
    }
}
