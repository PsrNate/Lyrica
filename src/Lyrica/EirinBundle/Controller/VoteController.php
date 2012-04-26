<?php

namespace Lyrica\EirinBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class VoteController extends Controller
{
    /**
     * Displays the vote page with two personae and their appearances
     */
    public function indexAction()
    {
        
    }
    
    /**
     * Processes an encounter
     */
    public function matchAction()
    {   
    }
    
    /**
     * Displays the voting options
     */
    public function optionsAction()
    {
        // Fetching excluded games
        $argts['ex_games'] = $this->get('session')->get('ex_games');
        
        if (empty($argts['ex_games']))
        {
            $argts['ex_games'] = array();
        }
        
        // Fetching all games
        // Getting the Repository
        $em = $this->getDoctrine()->getEntityManager();
        $gr = $this->getRepository('LyricaEirinBundle:Game');
        
        // Configuring request
        $crt = array();
        $ord = array('opus', 'ASC');
        
        // Fetching
        $argts['games'] = $gr->findBy($crt, $ord);
        
        // Then rendering
        $tpl_path = 'LyricaEirinBundle:Vote:options.html.twig';
        return $this->render($tpl_path, $argts);
    }
    
    /**
     * Saves the options
     */
    public function saveOptionsAction()
    {
        // Fetching request and session
        $req = $this->get('request')->request;
        $ses = $this->get('session');
    }
}