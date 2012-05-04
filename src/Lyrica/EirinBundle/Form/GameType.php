<?php

namespace Lyrica\EirinBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class GameType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('opus')
            ->add('name')
            ->add('slug')
        ;
    }

    public function getName()
    {
        return 'lyrica_eirinbundle_gametype';
    }
}
