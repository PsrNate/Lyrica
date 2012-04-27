<?php

namespace Lyrica\ReimuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FlashController extends Controller
{
    /**
     * Displays flash then redirects to another page
     *
     * @param string $message
     * @param string $forward name of the forwarding route
     */
    public function displayAction($message, $forward)
    {
        $argts['message'] = $message;
        $argts['forward'] = $forward;
        
        $tpl_path = 'LyricaReimuBundle:Flash:display.html.twig';
        return $this->render($tpl_path, $argts);
    }
}