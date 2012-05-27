<?php

namespace Lyrica\EirinBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class AppearanceRoleType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        // Appearance id
        $opt = array();
        $opt['data'] = 'id';
        $builder->add('app_id', 'hidden', $opt);
        
        // Role
        $opt = array();
        $opt['class'] = 'LyricaEirinBundle:Role';
        $opt['empty_value'] = false;
        $opt['query_builder'] =
            function(EntityRepository $er)
            {
                return $this->createQueryBuilder('r')
                            ->orderBy('r.order', 'ASC');
            };
        
        $builder->add('role', 'entity', $opt);
    }
    
    public function getName()
    {
        return 'lyrica_eirinbundle_appearanceroletype';
    }
}