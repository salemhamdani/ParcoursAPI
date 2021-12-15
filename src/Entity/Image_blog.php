<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Image_blog
 *
 * @ORM\Table(name="image_blog")
 * @ORM\Entity(repositoryClass="App\Repository\Image_blogRepository")
 */
class Image_blog
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="alt", type="string", length=255)
     */
    private $alt;



    /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Blog", inversedBy="images", cascade={"persist"})
     * @ORM\JoinColumn(name="blog")
     */
    private $blog;   

    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Image_blog
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
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
     * Set alt
     *
     * @param string $alt
     *
     * @return Image_blog
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }



    /**
     * Set blog
     *
     * @param \App\Entity\Blog $blog
     *
     * @return Blog
     */
    public function setBlog(\App\Entity\Blog $blog = null)
    {
        $this->blog = $blog;

        return $this;
    }

    /**
     * Get blog
     *
     * @return \App\Entity\Blog
     */
    public function getBlog()
    {
        return $this->blog;
    }
}
