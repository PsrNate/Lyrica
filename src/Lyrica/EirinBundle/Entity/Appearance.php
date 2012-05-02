<?php

namespace Lyrica\EirinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Lyrica\EirinBundle\Entity\AppearanceRepository;
use Lyrica\EirinBundle\Entity\Persona;
use Lyrica\EirinBundle\Entity\Game;
use Lyrica\EirinBundle\Entity\Role;
use Lyrica\EirinBundle\Utility\Elo;

/**
 * Lyrica\EirinBundle\Entity\Appearance
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppearanceRepository")
 */
class Appearance
{
    /**
     * @var Persona $persona
     * @ORM\ManyToOne(targetEntity="Persona", inversedBy="Persona")
     */
    private $persona;
    
    /**
     * @var Game $game
     * @ORM\ManyToOne(targetEntity="Game")
     */
    private $game;
    
    /**
     * @var Role $roles
     * @ORM\ManyToMany(targetEntity="Role")
     */
    private $roles;
    
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    public function __construct()
    {
        $this->role = new ArrayCollection();
    }

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
     * Set persona
     *
     * @param Lyrica\EirinBundle\Entity\Persona $persona
     */
    public function setPersona(Persona $persona)
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
    public function setGame(Game $game)
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
     * Get roles
     *
     * @return Lyrica\EirinBundle\Entity\Role 
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Add role
     *
     * @param Lyrica\EirinBundle\Entity\Role $role
     */
    public function addRole(Role $role)
    {
        $this->roles[] = $role;
    }
}