<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OfferSection
 *
 * @ORM\Table(name="offer_section")
 * @ORM\Entity(repositoryClass="App\Repository\OfferSectionRepository")
 */
class OfferSection
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creationdate", type="datetime")
     */
    private $creationdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedate", type="datetime", nullable=true)
     */
    private $updatedate;

    /**
     * @var bool
     *
     * @ORM\Column(name="archive", type="boolean")
     */
    private $archive;
    /**
     * @var int
     *
     * @ORM\Column(name="rang", type="integer")
     */
    private $rang=0;



    /**
     * 
     * 
     * @ORM\OneToMany(targetEntity="App\Entity\OfferCategory", mappedBy="offersection")
     */
    private $offercategory;


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
     * @return OfferSection
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
     * Set creationdate
     *
     * @param \DateTime $creationdate
     *
     * @return OfferSection
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
     * @return OfferSection
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
     * @return OfferSection
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
     * Set archive
     *
     * @param boolean $archive
     *
     * @return OfferSection
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
     * Get offercategory
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOffercategory()
    {
        return $this->offercategory;
    }

    /**
     * Add offercategory
     *
     * @param \App\Entity\OfferCategory $offercategory
     *
     * @return OfferSection
     */
    public function addOffercategory(\App\Entity\OfferCategory $offercategory)
    {
        $this->offercategory[] = $offercategory;

        return $this;
    }

    /**
     * Remove offercategory
     *
     * @param \App\Entity\OfferCategory $offercategory
     */
    public function removeOffercategory(\App\Entity\OfferCategory $offercategory)
    {
        $this->offercategory->removeElement($offercategory);
    }
}
