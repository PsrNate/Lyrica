<?php

namespace Lyrica\EirinBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class AppearanceType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('persona', 'hidden');
        
        $opt['class'] = 'LyricaEirinBundle:Game';
        $opt['empty_value'] = false;
        $opt['query_builder'] =
            function (EntityRepository $er)
            {
                return $this->createQueryBuilder('g')
                            ->orderBy('g.opus', 'ASC');
            };
        
        $builder->add('game', 'entity', $opt);
    }

    public function getName()
    {
        return 'lyrica_eirinbundle_appearancetype';
    }
}
