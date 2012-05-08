<?php

namespace Lyrica\EirinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Lyrica\EirinBundle\Entity\Avatar
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lyrica\EirinBundle\Entity\AvatarRepository")
 */
class Avatar
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
     * @var string $path
     *
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $path;
    
    /**
     * @Assert\File()
     */
    private $file;
    
    /**
     * Moves the file to where it should be
     */
    public function upload()
    {
        // we use the original file name here but you should
        // sanitize it at least to avoid any security issues
    
        // move takes the target directory and the target filename
        $upr = $this->getUploadRootDir();
        $con = $this->file->getClientOriginalName();
        $this->file->move($upr, $con);
    
        // set the path property to the filename where you'ved saved the file
        $this->path = $con;
    
        // clean up the file property as you won't need it anymore
        $this->file = null;
    }
    
    public function getAbsolutePath()
    {
        return $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        return 'uploads/eirin/avatars';
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
     * Set path
     *
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }
    
    /**
     * Set file
     * @param Symfony\Component\HttpFoundation\File\UploadedFile
     */
    public function setFile($file)
    {
        $this->file = $file;
    }
    
    /**
     * Get file
     * @return Symfony\Component\HttpFoundation\File\UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }
}