<?php

namespace Lyrica\EirinBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class PersonaType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('slug')
            ->add('avatar')
        ;
    }

    public function getName()
    {
        return 'lyrica_eirinbundle_personatype';
    }
}
