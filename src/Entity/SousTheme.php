<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * SousTheme
 *
 * @ORM\Table(name="soustheme")
 * @ORM\Entity(repositoryClass="App\Repository\SousThemeRepository")
 * @ORM\HasLifecycleCallbacks
 */
class SousTheme
{

    /**
     * Constructor
     */
    public function __construct()
    {
		$this->archive = false;
		$this->sousthemetheme = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $archive;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\User")
	*/
	private $quiinsert;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\User")
	*/
	private $quiupdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateinsert;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateupdate;

    /**
     * @ORM\PrePersist
     */
    public function ajout()
    {
        $this->dateinsert = new \DateTime();
    }

    /**
     * @ORM\PreUpdate
     */
    public function modification()
    {
        $this->dateupdate = new \DateTime();
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
     * @ORM\Column(name="intitule", type="string", length=250)
     * @Assert\Length(min=2, minMessage="L'intitulé doit faire au moins {{ limit }} caractères.")
     * @Assert\NotBlank(message="L'intitulé est obligatoire.")
     */
    private $intitule;

    private $themes;

    /**
    * @ORM\JoinColumn(nullable=true)
    * @ORM\OneToOne(targetEntity="App\Entity\Upload", cascade={"persist", "remove"})
     */
    private $photo;

    /**
     * @var File
     *
     */
     private $filephoto;


    /**
     * @var string
     *
     * @ORM\Column(name="alt", type="string", length=65, nullable=true)
     */
    private $alt;
    
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SousThemeTheme", mappedBy="soustheme")
     */
    private $sousthemetheme;

    /**
     * @return mixed
     */
    public function getThemes()
    {
        return $this->themes;
    }

    /**
     * @param mixed $themes
     * @return SousTheme
     */
    public function setThemes($themes)
    {
        $this->themes = $themes;
        return $this;
    }

    /**
     * Set archive
     *
     * @param boolean $archive
     *
     * @return SousTheme
     */
    public function setArchive($archive)
    {
        $this->archive = $archive;

        return $this;
    }

    /**
     * Get archive
     *
     * @return boolean
     */
    public function getArchive()
    {
        return $this->archive;
    }

    /**
     * Set dateinsert
     *
     * @param \DateTime $dateinsert
     *
     * @return SousTheme
     */
    public function setDateinsert($dateinsert)
    {
        $this->dateinsert = $dateinsert;

        return $this;
    }

    /**
     * Get dateinsert
     *
     * @return \DateTime
     */
    public function getDateinsert()
    {
        return $this->dateinsert;
    }

    /**
     * Set dateupdate
     *
     * @param \DateTime $dateupdate
     *
     * @return SousTheme
     */
    public function setDateupdate($dateupdate)
    {
        $this->dateupdate = $dateupdate;

        return $this;
    }

    /**
     * Get dateupdate
     *
     * @return \DateTime
     */
    public function getDateupdate()
    {
        return $this->dateupdate;
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
     * Set intitule
     *
     * @param string $intitule
     *
     * @return SousTheme
     */
    public function setIntitule($intitule)
    {
        $this->intitule = $intitule;

        return $this;
    }

    /**
     * Get intitule
     *
     * @return string
     */
    public function getIntitule()
    {
        return $this->intitule;
    }

    /**
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return SousTheme
     */
    public function setQuiinsert(\App\Entity\User $quiinsert = null)
    {
        $this->quiinsert = $quiinsert;

        return $this;
    }

    /**
     * Get quiinsert
     *
     * @return \App\Entity\User
     */
    public function getQuiinsert()
    {
        return $this->quiinsert;
    }

    /**
     * Set quiupdate
     *
     * @param \App\Entity\User $quiupdate
     *
     * @return SousTheme
     */
    public function setQuiupdate(\App\Entity\User $quiupdate = null)
    {
        $this->quiupdate = $quiupdate;

        return $this;
    }

    /**
     * Get quiupdate
     *
     * @return \App\Entity\User
     */
    public function getQuiupdate()
    {
        return $this->quiupdate;
    }


   /**
     * Set alt
     *
     * @param string $alt
     *
     * @return SousTheme
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
     * Set photo
     * @param \App\Entity\Upload $photo
     * @return SousTheme
     */
    public function setPhoto(\App\Entity\Upload $photo = null)
    {
        $this->photo = $photo;
        $this->photo->setDirectoryUpload($this->getDirectoryUploadPhoto());
        return $this;
    }
    
    public function getDirectoryUploadPhoto()
    {
        return strtolower((new \ReflectionClass($this))->getShortName().'-'.'photo');
    }

    /**
     * Get photo
     *
     * @return \App\Entity\Upload
     */
    public function getPhoto()
    {
        return $this->photo;
    }


    /**
     * @return File|null
     */
    public function getFilephoto()
    {
        return $this->filephoto;
    }

    /**
     * @param File $filephoto
     *
     * @return SousTheme
     */
    public function setFilephoto($filephoto)
    {
        $this->filephoto = $filephoto;

        return $this;
    }


    /**
     * Add sousthemetheme.
     *
     * @param \App\Entity\SousThemeTheme $sousthemetheme
     *
     * @return SousTheme
     */
    public function addSousthemetheme(\App\Entity\SousThemeTheme $sousthemetheme)
    {
        $this->sousthemetheme[] = $sousthemetheme;

        return $this;
    }

    /**
     * Remove sousthemetheme.
     *
     * @param \App\Entity\SousThemeTheme $sousthemetheme
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeSousthemetheme(\App\Entity\SousThemeTheme $sousthemetheme)
    {
        return $this->sousthemetheme->removeElement($sousthemetheme);
    }

    /**
     * Get sousthemetheme.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSousthemetheme()
    {
        return $this->sousthemetheme;
    }
}
