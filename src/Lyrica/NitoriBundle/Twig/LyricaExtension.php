<?php

namespace Lyrica\NitoriBundle\Twig;

use Twig_Extension;
use Twig_Function_Function;

class LyricaExtension extends Twig_Extension
{
    public function getName()
    {
        return 'lyrica_extension';
    }
    
    public function getFunctions()
    {
        return array(
            'in_array' => new Twig_Function_Function('in_array'),
        );
    }
}
