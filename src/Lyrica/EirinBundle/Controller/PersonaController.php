<?php

namespace Lyrica\EirinBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class PersonaController extends Controller
{
    /**
     * Displays rankings of every persona, with only global Elo
     */
    public function rankingsAction()
    {
        // Short for Entity Manager
        $em = $this->getDoctrine()->getEntityManager();
        // Short for Persona Repository
        $pr = $em->getRepository('LyricaEirinBundle:Persona');
        
        // Configure the query
        $criteria = array();
        $order = array('elo' => 'desc');
        
        // Fetch personae
        $argts['personae'] = $pr->findBy($criteria, $order);
        
        // Then return a response
        $tpl_path = 'LyricaEirinBundle:Persona:rankings.html.twig';
        return $this->render($tpl_path, $argts);
    }
}
