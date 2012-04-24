<?php

namespace Lyrica\EirinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Lyrica\EirinBundle\Entity\Persona;

/**
 * Lyrica\EirinBundle\Entity\Encounter
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lyrica\EirinBundle\Entity\EncounterRepository")
 */
class Encounter
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var Lyrica\EirinBundle\Entity\Persona $winner
     * @ORM\ManyToOne(targetEntity="Persona")
     */
    private $winner;

    /**
     * @var Lyrica\EirinBundle\Entity\Persona $loser
     * @ORM\ManyToOne(targetEntity="Persona")
     */
    private $loser;
    
    /**
     * @var datetime $date
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var smallint $draw
     *
     * @ORM\Column(name="draw", type="smallint")
     */
    private $draw;


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
     * Set date
     *
     * @param datetime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * Get date
     *
     * @return datetime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set draw
     *
     * @param smallint $draw
     */
    public function setDraw($draw)
    {
        $this->draw = $draw;
    }

    /**
     * Get draw
     *
     * @return smallint 
     */
    public function getDraw()
    {
        return $this->draw;
    }

    /**
     * Set winner
     *
     * @param Lyrica\EirinBundle\Entity\Persona $winner
     */
    public function setWinner(Persona $winner)
    {
        $this->winner = $winner;
    }

    /**
     * Get winner
     *
     * @return Lyrica\EirinBundle\Entity\Persona 
     */
    public function getWinner()
    {
        return $this->winner;
    }

    /**
     * Set loser
     *
     * @param Lyrica\EirinBundle\Entity\Persona $loser
     */
    public function setLoser(Persona $loser)
    {
        $this->loser = $loser;
    }

    /**
     * Get loser
     *
     * @return Lyrica\EirinBundle\Entity\Persona 
     */
    public function getLoser()
    {
        return $this->loser;
    }
}