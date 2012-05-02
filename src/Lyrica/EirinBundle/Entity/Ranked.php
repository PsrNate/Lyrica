<?php

namespace Lyrica\EirinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass
 */
abstract class Ranked
{
    /**
     * @var smallint $elo
     * @ORM\Column(name="elo", type="smallint")
     */
    private $elo;

    /**
     * @var smallint $wins
     * @ORM\Column(name="wins", type="smallint")
     */
    private $wins;

    /**
     * @var smallint $draws
     * @ORM\Column(name="draws", type="smallint")
     */
    private $draws;

    /**
     * @var smallint $losses
     * @ORM\Column(name="losses", type="smallint")
     */
    private $losses;

    /**
     * @var smallint $veteran
     * @ORM\Column(name="veteran", type="smallint")
     */
    private $veteran;

    public function __construct()
    {
        $this->elo = 1400;
        $this->wins = 0;
        $this->draws = 0;
        $this->losses = 0;
    }
    
    /**
     * Updates Elo score after an encounter
     * @param integer $opp the opponent's Elo
     * @param integer $res the encounter's result
     */
    public function updateElo($opp, $res)
    {
        // p(D) : victory probability
        $diff = $opp - $this->elo; // inverted for calc purposes
        $p = 1 / (1 + pow(10, $diff / 400));
        
        // k : Development coefficient
        $k = ($this->countMatches() < 30 ? 30 : ($$this->veteran ? 15 : 10));
        
        // Save 
        $this->elo = round($this->elo + $k * ($res - $p));
        
        // Then update match counter
        switch($res)
        {
            case 1: $this->wins++; break;
            case 0.5: $this->draws++; break;
            case 0: $this->losses++;
        }
        
        // Promote if needed
        if ($this->elo >= 2400)
        {
            $this->veteran = 1;
        }  
    }

    /**
     * Get elo
     * @return smallint 
     */
    public function getElo()
    {
        return $this->elo;
    }

    /**
     * Get wins
     * @return smallint 
     */
    public function getWins()
    {
        return $this->wins;
    }

    /**
     * Get draws
     * @return smallint 
     */
    public function getDraws()
    {
        return $this->draws;
    }

    /**
     * Get losses
     * @return smallint 
     */
    public function getLosses()
    {
        return $this->losses;
    }
    
    /**
     * Get the number of matches
     */
    public function countMatches()
    {
        return $this->wins + $this->losses + $this->draws;
    }
}