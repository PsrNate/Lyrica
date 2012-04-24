<?php

namespace Lyrica\EirinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Lyrica\EirinBundle\Entity\PersonaRepository;
use Lyrica\EirinBundle\Entity\Appearance;
use Lyrica\EirinBundle\Utility\Elo;

/**
 * Lyrica\EirinBundle\Entity\Persona
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PersonaRepository")
 */
class Persona
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
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
    
    /**
     * @var string $slug
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @var smallint $elo
     *
     * @ORM\Column(name="elo", type="smallint")
     */
    private $elo;

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
     * @var smallint $veteran
     *
     * @ORM\Column(name="veteran", type="smallint")
     */
    private $veteran;
    
    /**
     * @var Doctrine\Common\Collections\Collection $appearances
     * @ORM\OneToMany(targetEntity="Appearance", mappedBy="Appearance")
     *
     */
    private $appearances;
    
    public function __construct()
    {
        $this->appearances = new ArrayCollection();
        $this->elo = Elo::ROOKIE;
        $this->wins = 0;
        $this->draws = 0;
        $this->losses = 0;
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
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
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
     * Add appearances
     *
     * @param Lyrica\EirinBundle\Entity\Appearance $appearances
     */
    public function addAppearance(Appearance $appearance)
    {
        $this->appearances[] = $appearance;
    }

    /**
     * Get appearances
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getAppearances()
    {
        return $this->appearances;
    }
    
    /**
     * Get the number of matches
     */
    public function countMatches()
    {
        return $this->wins + $this->losses + $this->draws;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }
}