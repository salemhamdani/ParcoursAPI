<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * SocialSettings
 *
 * @ORM\Table(name="social_settings")
 * @ORM\Entity()
 */
class SocialSettings {

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=65, nullable=true)
     */
    private $title;

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
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;
    
    /**
     * @var string
     *
     * @ORM\Column(name="alt_logo", type="string", length=255, nullable=true)
     */
    private $alt;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255, nullable=true)
     */
    private $path;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return SocialSettings
     */
    public function setUrl($url) {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return SocialSettings
     */
    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    public function getPath() {
        return $this->path;
    }

    /**
     * Set path
     *
     * @param string $path
     *
     * @return SocialSettings
     */
    public function setPath($path) {
        $this->path = $path;

        return $this;
    }


    /**
     * Set alt
     *
     * @param string $alt
     *
     * @return SocialSettings
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
}
