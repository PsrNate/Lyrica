<?php

namespace Lyrica\EirinBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Lyrica\EirinBundle\Entity\Encounter;


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
        
        // Render
        $tpl_path = 'LyricaEirinBundle:Vote:index.html.twig';
        return $this->render($tpl_path, $argts);
    }
    
    /**
     * Processes an encounter
     */
    public function matchAction()
    {
        // Fetching POST data, entity manager and repositories
        $post = $this->get('request')->request;
        $em = $this->getDoctrine()->getEntityManager();
        $pr = $em->getRepository('LyricaEirinBundle:Persona');
        
        // Calculating results (Elo)
        $wr = ($post->get('draw') ? 0.5 : 1);
        $lr = ($post->get('draw') ? 0.5 : 0);
        
        // Elo update : intergame ranking
        $w = $pr->findComplete($post->get('w_id'));
        $l = $pr->findComplete($post->get('l_id'));
        
        $w->updateElo($l->getElo(), $wr);
        $l->updateElo($w->getElo(), $lr);
        
        // Internal ranking
        foreach ($w->getAppearances() as $wa)
        {
            foreach ($l->getAppearances() as $la)
            {
                if ($wa->getGame() == $la->getGame())
                {
                    $wa->updateElo($la->getElo(), $wr);
                    $la->updateElo($wa->getElo(), $lr);
                }
            }
        }
        
        // Registering the encounter
        $e = new Encounter();
        $e->setWinner($w);
        $e->setLoser($l);
        $e->setDraw(($post->get('draw') ? 1 : 0));
        
        // Saving everything
        $em->persist($e);
        $em->flush();
        
        // Forwarding to index
        $act_name = 'LyricaEirinBundle:Vote:index';
        return $this->forward($act_name);
        
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