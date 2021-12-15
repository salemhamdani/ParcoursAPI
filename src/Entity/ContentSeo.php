<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContentSeo
 *
 * @ORM\Table(name="content_seo")
 * @ORM\Entity(repositoryClass="App\Repository\ContentSeoRepository")
 */
class ContentSeo
{   
     /**
     * Constructor
     */
    public function __construct()
    {
        $this->archive = false;
        $this->creationdate = new \DateTime();
    }
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
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;
    /**
     * @var bool
     *
     * @ORM\Column(name="archive", type="boolean")
     */
    private $archive;

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
     * @var string
     *
     * @ORM\Column(name="keyword", nullable=true, type="string", length=255, nullable=true)
     */
    private $keyword;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var bool
     *
     * @ORM\Column(name="robots",nullable=true, type="boolean")
     */
    private $robots;

    /** 
     * 
     * @ORM\OneToOne(targetEntity="App\Entity\ContentPage", mappedBy="contentseo")
     */
    private $contentpage ;


    /**
     * Get contentpage
     *
     * @return \App\Entity\ContentPage
     */
    public function getContentpage() {
        return $this->contentpage;
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
     * @return ContentSeo
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
     * Set keyword
     *
     * @param string $keyword
     *
     * @return ContentSeo
     */
    public function setKeyword($keyword)
    {
        $this->keyword = $keyword;

        return $this;
    }

    /**
     * Get keyword
     *
     * @return string
     */
    public function getKeyword()
    {
        return $this->keyword;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return ContentSeo
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
     * Set robots
     *
     * @param boolean $robots
     *
     * @return ContentSeo
     */
    public function setRobots($robots)
    {
        $this->robots = $robots;

        return $this;
    }

    /**
     * Get robots
     *
     * @return bool
     */
    public function getRobots()
    {
        return $this->robots;
    }

    /**
     * Set archive
     *
     * @param boolean $archive
     *
     * @return ContentSeo
     */
    public function setArchive($archive)
    {
        $this->archive = $archive;

        return $this;
    }

    /**
     * Get archive
     *
     * @return bool
     */
    public function getArchive()
    {
        return $this->archive;
    }

    /**
     * Set creationdate
     *
     * @param \DateTime $creationdate
     *
     * @return ContentSeo
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
     * @return ContentSeo
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
     * Set contentpage
     *
     * @param \App\Entity\ContentPage $contentpage
     *
     * @return ContentSeo
     */
    public function setContentpage(\App\Entity\ContentPage $contentpage = null)
    {
        $this->contentpage = $contentpage;

        return $this;
    }
}
