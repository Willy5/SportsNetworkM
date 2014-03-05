<?php

namespace TheFireflies\SportBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\True;

class PlayerDetailType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('public', 'checkbox', array(
                'label' => 'Création de votre fiche joueur ?',
                'required' => false,
                'mapped' => false,
                'data' => true
        ))
            ->add('nameIfGuest')
            ->add('playerNumber')
            ->add('position')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TheFireflies\SportBundle\Entity\PlayerDetail'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'thefireflies_sportbundle_playerdetail';
    }
}
