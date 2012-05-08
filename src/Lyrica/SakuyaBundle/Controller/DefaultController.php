<?php

namespace Lyrica\SakuyaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction($name)
    {
        return $this->render('LyricaSakuyaBundle:Default:index.html.twig', array('name' => $name));
    }
}
