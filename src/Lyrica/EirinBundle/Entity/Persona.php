<?php

namespace Lyrica\EirinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Lyrica\EirinBundle\Entity\PersonaRepository;
use Lyrica\EirinBundle\Entity\Appearance;
use Lyrica\EirinBundle\Entity\Avatar;

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
     * @var Doctrine\Common\Collections\Collection $appearances
     * @ORM\OneToMany(targetEntity="Appearance", mappedBy="Appearance")
     
     */
    private $appearances;
    
    /**
     * @var Lyrica\EirinBundle\Entity\Avatar $avatar
     * @ORM\OneToOne(targetEntity="Avatar")
     */
    private $avatar;
    
    public function __construct()
    {
        $this->appearances = new ArrayCollection();
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
     * Add appearance
     *
     * @param Lyrica\EirinBundle\Entity\Appearance $appearance
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
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }
    
    /**
     * Set avatar
     * @param Lyrica\EirinBundle\Entity\Avatar $avatar
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }
    
    /**
     * Get avatar
     * @return Lyrica\EirinBundle\Entity\Avatar
     */
    public function getAvatar()
    {
        return $this->avatar();
    }
}