<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContentSlide
 *
 * @ORM\Table(name="content_slide")
 * @ORM\Entity(repositoryClass="App\Repository\ContentSlideRepository")
 */
class ContentSlide
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var int
     *
     * @ORM\Column(name="rang", type="integer")
     */
    private $rang;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creationdate", type="date")
     */
    private $creationdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedate", type="date", nullable=true)
     */
    private $updatedate;

    /**
     * @var bool
     *
     * @ORM\Column(name="button", type="boolean")
     */
    private $button;

      /**
     * @ORM\Column(name="image", type="string", nullable=true)
     */
     private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="alt", type="string", length=255)
     */
    private $alt;

    /**
     * @var string
     *
     * @ORM\Column(name="buttonUrl", type="string", length=255, nullable=true)
     */
    private $buttonUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="buttonTxt", type="string", length=255, nullable=true)
     */
    private $buttonTxt;

    /**
     * @var File
     *
     */
     private $file;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;


    /**
     * @ORM\ManyToOne(targetEntity="ContentSlider", inversedBy="contentslides")
     * @ORM\JoinColumn(nullable=false)
     */
    private $contentslider;



    /**
     * Constructor
     */
    public function __construct() {

        $this->creationdate = new \DateTime();
    }


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
     * Set title
     *
     * @param string $title
     *
     * @return ContentSlide
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set alt
     *
     * @param string $alt
     *
     * @return ContentSlide
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
     * Set buttonUrl
     *
     * @param string $buttonUrl
     *
     * @return ContentSlide
     */
    public function setButtonUrl($buttonUrl)
    {
        $this->buttonUrl = $buttonUrl;

        return $this;
    }

    /**
     * Get buttonUrl
     *
     * @return string
     */
    public function getButtonUrl()
    {
        return $this->buttonUrl;
    }

    /**
     * Set buttonTxt
     *
     * @param string $buttonTxt
     *
     * @return ContentSlide
     */
    public function setButtonTxt($buttonTxt)
    {
        $this->buttonTxt = $buttonTxt;

        return $this;
    }

    /**
     * Get buttonTxt
     *
     * @return string
     */
    public function getButtonTxt()
    {
        return $this->buttonTxt;
    }

    /**
     * Set rang
     *
     * @param integer $rang
     *
     * @return ContentSlide
     */
    public function setRang($rang)
    {
        $this->rang = $rang;

        return $this;
    }

    /**
     * Get rang
     *
     * @return int
     */
    public function getRang()
    {
        return $this->rang;
    }

    /**
     * Set creationdate
     *
     * @param \DateTime $creationdate
     *
     * @return ContentSlide
     */
    public function setCreationdate($creationdate)
    {
        $this->creationdate = $creationdate;

        return $this;
    }

    /**
     * Get creationdate
     *
     * @return \DateTime
     */
    public function getCreationdate()
    {
        return $this->creationdate;
    }

    /**
     * Set updatedate
     *
     * @param \DateTime $updatedate
     *
     * @return ContentSlide
     */
    public function setUpdatedate($updatedate)
    {
        $this->updatedate = $updatedate;

        return $this;
    }

    /**
     * Get updatedate
     *
     * @return \DateTime
     */
    public function getUpdatedate()
    {
        return $this->updatedate;
    }

    /**
     * Set button
     *
     * @param boolean $button
     *
     * @return ContentSlide
     */
    public function setButton($button)
    {
        $this->button = $button;

        return $this;
    }

    /**
     * Get button
     *
     * @return bool
     */
    public function getButton()
    {
        return $this->button;
    }


    /**
     * Set image
     *
     * @param string $image
     *
     * @return ContentSlide
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }



    /**
     * @return File|null
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param File $file
     *
     * @return ContentSlide
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }


    /**
     * Set description
     *
     * @param string $description
     *
     * @return ContentSlide
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }


    
    /**
     * Set contentslider
     *
     * @param \App\Entity\ContentSlider $contentslider
     *
     * @return ContentSlide
     */
    public function setContentslider(\App\Entity\ContentSlider $contentslider = null)
    {
        $this->contentslider = $contentslider;

        return $this;
    }

    /**
     * Get contentslider
     *
     * @return \App\Entity\ContentSlider
     */
    public function getContentslider()
    {
        return $this->contentslider;
    }


}
