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