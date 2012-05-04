<?php

namespace Lyrica\EirinBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class RoleType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('order')
            ->add('title')
        ;
    }

    public function getName()
    {
        return 'lyrica_eirinbundle_roletype';
    }
}
