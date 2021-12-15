<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PageBlocView
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="App\Repository\PageBlocViewRepository")
 */
class PageBlocView
{   
    
     /**
     * Constructor
     */
    public function __construct()
    {
        $this->creationdate = new \DateTime();
        $this->contentsections = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @ORM\ManyToOne(targetEntity="ContentPage", inversedBy="pagesections")
     * @ORM\JoinColumn(nullable=false)
     */
    private $contentpage;
    
    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ContentSection", cascade={"persist"})
     */
    private $contentsections;


    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")

    */
    private $blocview;

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
     * @var int
     *
     * @ORM\Column(name="rang", type="integer")
     */
    private $rang;
    
     /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=250, nullable=true)
     * 
     */
    private $color;

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
     * Set contentsection
     *
     * @param \App\Entity\ContentSection $contentsection
     *
     * @return Contentsection
     */
    public function setContentsection(\App\Entity\ContentSection $contentsection = null)
    {
        $this->contentsection = $contentsection;

        return $this;
    }

    /**
     * Get contentsection
     *
     * @return \App\Entity\ContentSection
     */
    public function getContentsection()
    {
        return $this->contentsection;
    }




    
    /**
     * Set contentpage
     *
     * @param \App\Entity\ContentPage $contentpage
     *
     * @return Category
     */
    public function setContentpage(\App\Entity\ContentPage $contentpage = null)
    {
        $this->contentpage = $contentpage;

        return $this;
    }

    /**
     * Get contentpage
     *
     * @return \App\Entity\ContentPage
     */
    public function getContentpage()
    {
        return $this->contentpage;
    }

    
    /**
     * Set creationdate
     *
     * @param \DateTime $creationdate
     *
     * @return ContentSection
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
     * @return ContentSection
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
     * Set rang
     *
     * @param integer $rang
     *
     * @return ContentSection
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
     * Set blocview
     *
     * @param \App\Entity\Masterlistelg $blocview
     *
     * @return Template
     */
    public function setBlocview(\App\Entity\Masterlistelg $blocview = null)
    {
        $this->blocview = $blocview;

        return $this;
    }

    /**
     * Get blocview
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getBlocview()
    {
        return $this->blocview;
    }

      /**
     * Add contentsection
     *
     * @param \App\Entity\ContentSection $contentsection
     *
     * @return PageBlocView
     */
    public function addContentsection(\App\Entity\ContentSection $contentsection)
    {
        $this->contentsections[] = $contentsection;

        return $this;
    }

    /**
     * Remove contentsection
     *
     * @param \App\Entity\ContentSection $contentsection
     */
    public function removeContentsection(\App\Entity\ContentSection $contentsection)
    {
        $this->contentsections->removeElement($contentsection);
    }

    /**
     * Get contentsections
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContentsections()
    {
        return $this->contentsections;
    }

    /**
     * Set color
     *
     * @param string $color
     *
     * @return PageBlocView
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }


    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }




    
}
