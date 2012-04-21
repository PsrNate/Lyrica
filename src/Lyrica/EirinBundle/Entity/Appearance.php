<?php

namespace Lyrica\EirinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Lyrica\EirinBundle\Entity\Game;
use Lyrica\EirinBundle\Entity\Persona;
use Lyrica\EirinBundle\Entity\Role;

/**
 * Lyrica\EirinBundle\Entity\Appearance
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lyrica\EirinBundle\Entity\AppearanceRepository")
 */
class Appearance
{
    /**
     * @var Persona $persona
     * @ORM\ManyToOne(targetEntity="Lyrica\EirinBundle\Entity\Persona")
     */
    private $persona;
    
    /**
     * @var Game $game
     * @ORM\ManyToOne(targetEntity="Lyrica\EirinBundle\Entity\Game")
     */
    private $game;
    
    /**
     * @var Role $role
     * @ORM\ManyToOne(targetEntity="Lyrica\EirinBundle\Entity\Role")
     */
    private $role;
    
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var smallint $wins
     *
     * @ORM\Column(name="wins", type="smallint")
     */
    private $wins;

    /**
     * @var smallint $draws
     *
     * @ORM\Column(name="draws", type="smallint")
     */
    private $draws;

    /**
     * @var smallint $losses
     *
     * @ORM\Column(name="losses", type="smallint")
     */
    private $losses;

    /**
     * @var smallint $elo
     *
     * @ORM\Column(name="elo", type="smallint")
     */
    private $elo;

    /**
     * @var smallint $veteran
     *
     * @ORM\Column(name="veteran", type="smallint")
     */
    private $veteran;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set wins
     *
     * @param smallint $wins
     */
    public function setWins($wins)
    {
        $this->wins = $wins;
    }

    /**
     * Get wins
     *
     * @return smallint 
     */
    public function getWins()
    {
        return $this->wins;
    }

    /**
     * Set draws
     *
     * @param smallint $draws
     */
    public function setDraws($draws)
    {
        $this->draws = $draws;
    }

    /**
     * Get draws
     *
     * @return smallint 
     */
    public function getDraws()
    {
        return $this->draws;
    }

    /**
     * Set losses
     *
     * @param smallint $losses
     */
    public function setLosses($losses)
    {
        $this->losses = $losses;
    }

    /**
     * Get losses
     *
     * @return smallint 
     */
    public function getLosses()
    {
        return $this->losses;
    }

    /**
     * Set elo
     *
     * @param smallint $elo
     */
    public function setElo($elo)
    {
        $this->elo = $elo;
    }

    /**
     * Get elo
     *
     * @return smallint 
     */
    public function getElo()
    {
        return $this->elo;
    }

    /**
     * Set veteran
     *
     * @param smallint $veteran
     */
    public function setVeteran($veteran)
    {
        $this->veteran = $veteran;
    }

    /**
     * Get veteran
     *
     * @return smallint 
     */
    public function getVeteran()
    {
        return $this->veteran;
    }

    /**
     * Set persona
     *
     * @param Lyrica\EirinBundle\Entity\Persona $persona
     */
    public function setPersona(\Lyrica\EirinBundle\Entity\Persona $persona)
    {
        $this->persona = $persona;
    }

    /**
     * Get persona
     *
     * @return Lyrica\EirinBundle\Entity\Persona 
     */
    public function getPersona()
    {
        return $this->persona;
    }

    /**
     * Set game
     *
     * @param Lyrica\EirinBundle\Entity\Game $game
     */
    public function setGame(\Lyrica\EirinBundle\Entity\Game $game)
    {
        $this->game = $game;
    }

    /**
     * Get game
     *
     * @return Lyrica\EirinBundle\Entity\Game 
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * Set role
     *
     * @param Lyrica\EirinBundle\Entity\Role $role
     */
    public function setRole(\Lyrica\EirinBundle\Entity\Role $role)
    {
        $this->role = $role;
    }

    /**
     * Get role
     *
     * @return Lyrica\EirinBundle\Entity\Role 
     */
    public function getRole()
    {
        return $this->role;
    }
}