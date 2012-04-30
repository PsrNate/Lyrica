<?php

namespace Lyrica\NitoriBundle\Twig;

use Twig_Extension;
use Twig_Function_Function;
use Twig_Filter_Method;

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
    
    public function getFilters()
    {
        return array(
            'a2h' => new Twig_Filter_Method($this, 'appearancesToHTML'),
        );
    }
    
    /**
     * Takes all the appearances that a Persona holds and renders
     * it in HTML Format
     */
    public function appearancesToHTML($appearances)
    {
        // List beginning
        $res = '<ul class="first_level">';
        
        for ($i = 0, $c = count($appearances) ; $i < $c ; $i++)
        {
            $cur = $appearances[$i];
            $pre = ($i == 0 ? null : $appearances[$i-1]);
            
            // First role of a game
            if ($i != 0 and $pre->getGame() == $cur->getGame())
            {
                $res .= '</ul>';
            }
            // First role (of a game, or overall)
            if ($i == 0 or $pre->getGame() == $cur->getGame())
            {
                $res .= '<li>'.$cur->getGame()->getFullName().'</li>';
                $res .= '<ul class="second_level">';
            }
            // Common to every case
            $res .= '<li>'.$cur->getRole()->getFullName().'</li>';
        }
        // Final rendering (closing both lists)
        return $res.'</ul></ul>';
    }
}
