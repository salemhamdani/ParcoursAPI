<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OfferCategory
 *
 * @ORM\Table(name="offer_category")
 * @ORM\Entity(repositoryClass="App\Repository\OfferCategoryRepository")
 */
class OfferCategory
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
     * @var File
     *
     */
     private $file;
	 

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;

    /**
     * @var int
     *
     * @ORM\Column(name="rang", type="integer")
     */
    private $rang;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedate", type="datetime", nullable=true)
     */
    private $updatedate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creationdate", type="datetime")
     */
    private $creationdate;

    /**
     * @var bool
     *
     * @ORM\Column(name="archive", type="boolean")
     */
    private $archive;

    /**
     * @var string
     *
     * @ORM\Column(name="alias", type="string", length=255)
     */
    private $alias;

    /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\OfferSection", inversedBy="offercategory", cascade={"persist"})
     * @ORM\JoinColumn(name="offersection")
     */
    private $offersection;   



    /**
     * 
     * 
     * @ORM\OneToMany(targetEntity="App\Entity\Offer", mappedBy="offercategory")
     */
    private $offer;


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
     * @return OfferCategory
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
     * Set image
     *
     * @param string $image
     *
     * @return OfferCategory
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
     * Set rang
     *
     * @param integer $rang
     *
     * @return OfferCategory
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
     * Set updatedate
     *
     * @param \DateTime $updatedate
     *
     * @return OfferCategory
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
     * Set creationdate
     *
     * @param \DateTime $creationdate
     *
     * @return OfferCategory
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
     * Set archive
     *
     * @param boolean $archive
     *
     * @return OfferCategory
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
     * Set alias
     *
     * @param string $alias
     *
     * @return OfferCategory
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get alias
     *
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
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
     * @return OfferCategory
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }


    /**
     * Set offersection
     *
     * @param \App\Entity\OfferSection $offersection
     *
     * @return OfferSection
     */
    public function setOffersection(\App\Entity\OfferSection $offersection = null)
    {
        $this->offersection = $offersection;

        return $this;
    }

    /**
     * Get offersection
     *
     * @return \App\Entity\OfferSection
     */
    public function getOffersection()
    {
        return $this->offersection;
    }


    /**
     * Get offer
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOffer()
    {
        return $this->offer;
    }

    /**
     * Add offer
     *
     * @param \App\Entity\Offer $offer
     *
     * @return OfferCategory
     */
    public function addOffer(\App\Entity\Offer $offer)
    {
        $this->offer[] = $offer;

        return $this;
    }

    /**
     * Remove offer
     *
     * @param \App\Entity\Offer $offer
     */
    public function removeOffer(\App\Entity\Offer $offer)
    {
        $this->offer->removeElement($offer);
    }
}
