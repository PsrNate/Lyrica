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
        // Fetch exclusions
        $ex_games = $this->get('session')->get('ex_games') or array();
        
        // Then Personae
        $em = $this->getDoctrine()->getEntityManger();
        $pr = $em->getRepository('LyricaEirinBundle:Persona');
        
        $results = $pr->findOpponents($ex_games);
        $argts['c1'] = $results[0];
        $argts['c2'] = $results[1];
        
        // TODO : Externalize appearances for Twig displaying
        
        // Render
        $tpl_path = 'LyricaEirinBundle:Vote:index.html.twig';
        return $this->render($tpl_path, $argts);
    }
    
    /**
     * Processes an encounter
     */
    public function matchAction()
    {   
    }
    
    /**
     *
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
        
        // Fetching all games
        $em = $this->getDoctrine()->getEntityManager();
        $gr = $em->getRepository('LyricaEirinBundle:Game');
        $games = $gr->findAll();
        
        // Then adding every game
        foreach ($games as $game)
        {
            $formValue = $req->get($game->getOpus());
            
            if ($formValue === 'true')
            {
                $ex_games[] = $game->getOpus();
            }
        }
        
        // Security
        if (empty($ex_games))
        {
            $ex_games = array();
        }
        
        // Finally saving settings and forwarding to the
        // flash forwarding page
        $ses->set('ex_games', $ex_games);
        $act_name = 'LyricaReimuBundle:Flash:display';
        $argts['forward'] = 'Eirin_options';
        $argts['message'] = 'Vos options de vote ont été sauvegardées !';
        return $this->forward($act_name, $argts);
    }
}