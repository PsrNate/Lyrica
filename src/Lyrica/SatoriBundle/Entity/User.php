<?php

namespace Lyrica\SatoriBundle\Entity;

use FOS\UserBundle\Entity\User as FOSUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="satori_user")
 */
class User extends FOSUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;    
}