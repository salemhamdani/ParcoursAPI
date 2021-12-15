<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * TarifVenteThemeIntra
 *
 * @ORM\Table(name="tarifVenteThemeIntra")
 * @ORM\Entity(repositoryClass="App\Repository\TarifVenteThemeIntraRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class TarifVenteThemeIntra
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->intrajourclients = new \Doctrine\Common\Collections\ArrayCollection();
        $this->intrajourofs = new \Doctrine\Common\Collections\ArrayCollection();
		$this->archive = false;
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
    * @ORM\ManyToOne(targetEntity="App\Entity\Theme", inversedBy="tarifsventeintra",cascade={"persist"})
    */
    private $theme;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Module", inversedBy="tarifsventeintra",cascade={"persist"})
    */
    private $module;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $datedebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datefin;

    /**
     * @ORM\OneToMany(targetEntity="TarifVenteIntraJourClient", mappedBy="tarifventethemeintra", cascade={"persist", "remove"}, orphanRemoval=TRUE)
     */
    protected $intrajourclients;

    /**
     * @ORM\OneToMany(targetEntity="TarifVenteIntraJourOf", mappedBy="tarifventethemeintra", cascade={"persist", "remove"}, orphanRemoval=TRUE)
     */
    protected $intrajourofs;

    /**
	* @Assert\Regex("/\d+(\.\d+)?/")
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $testprerequispersint;

    /**
	* @Assert\Regex("/\d+(\.\d+)?/")
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $testprerequispersext;

    /**
	* @Assert\Regex("/\d+(\.\d+)?/")
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $ingenieriejourint;

    /**
	* @Assert\Regex("/\d+(\.\d+)?/")
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $ingenieriejourext;

    /**
	* @Assert\Regex("/\d+(\.\d+)?/")
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $supportinternepersint;

    /**
	* @Assert\Regex("/\d+(\.\d+)?/")
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $supportinternepersext;

    /**
	* @Assert\Regex("/\d+(\.\d+)?/")
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $locationsallejourint;

    /**
	* @Assert\Regex("/\d+(\.\d+)?/")
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $repasjourint;

    /**
	* @Assert\Regex("/\d+(\.\d+)?/")
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $testvalidationpersint;

    /**
	* @Assert\Regex("/\d+(\.\d+)?/")
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $testvalidationpersext;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\TarifVenteThemeIntra")
    */
    private $tarifdefaut;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set datedebut
     *
     * @param \DateTime $datedebut
     *
     * @return TarifVenteThemeIntra
     */
    public function setDatedebut($datedebut)
    {
        $this->datedebut = $datedebut;

        return $this;
    }

    /**
     * Get datedebut
     *
     * @return \DateTime
     */
    public function getDatedebut()
    {
        return $this->datedebut;
    }

    /**
     * Set datefin
     *
     * @param \DateTime $datefin
     *
     * @return TarifVenteThemeIntra
     */
    public function setDatefin($datefin)
    {
        $this->datefin = $datefin;

        return $this;
    }

    /**
     * Get datefin
     *
     * @return \DateTime
     */
    public function getDatefin()
    {
        return $this->datefin;
    }

    /**
     * Set testprerequispersint
     *
     * @param string $testprerequispersint
     *
     * @return TarifVenteThemeIntra
     */
    public function setTestprerequispersint($testprerequispersint)
    {
        $this->testprerequispersint = $testprerequispersint;

        return $this;
    }

    /**
     * Get testprerequispersint
     *
     * @return string
     */
    public function getTestprerequispersint()
    {
        return $this->testprerequispersint;
    }

    /**
     * Set testprerequispersext
     *
     * @param string $testprerequispersext
     *
     * @return TarifVenteThemeIntra
     */
    public function setTestprerequispersext($testprerequispersext)
    {
        $this->testprerequispersext = $testprerequispersext;

        return $this;
    }

    /**
     * Get testprerequispersext
     *
     * @return string
     */
    public function getTestprerequispersext()
    {
        return $this->testprerequispersext;
    }

    /**
     * Set ingenieriejourint
     *
     * @param string $ingenieriejourint
     *
     * @return TarifVenteThemeIntra
     */
    public function setIngenieriejourint($ingenieriejourint)
    {
        $this->ingenieriejourint = $ingenieriejourint;

        return $this;
    }

    /**
     * Get ingenieriejourint
     *
     * @return string
     */
    public function getIngenieriejourint()
    {
        return $this->ingenieriejourint;
    }

    /**
     * Set ingenieriejourext
     *
     * @param string $ingenieriejourext
     *
     * @return TarifVenteThemeIntra
     */
    public function setIngenieriejourext($ingenieriejourext)
    {
        $this->ingenieriejourext = $ingenieriejourext;

        return $this;
    }

    /**
     * Get ingenieriejourext
     *
     * @return string
     */
    public function getIngenieriejourext()
    {
        return $this->ingenieriejourext;
    }

    /**
     * Set supportinternepersint
     *
     * @param string $supportinternepersint
     *
     * @return TarifVenteThemeIntra
     */
    public function setSupportinternepersint($supportinternepersint)
    {
        $this->supportinternepersint = $supportinternepersint;

        return $this;
    }

    /**
     * Get supportinternepersint
     *
     * @return string
     */
    public function getSupportinternepersint()
    {
        return $this->supportinternepersint;
    }

    /**
     * Set supportinternepersext
     *
     * @param string $supportinternepersext
     *
     * @return TarifVenteThemeIntra
     */
    public function setSupportinternepersext($supportinternepersext)
    {
        $this->supportinternepersext = $supportinternepersext;

        return $this;
    }

    /**
     * Get supportinternepersext
     *
     * @return string
     */
    public function getSupportinternepersext()
    {
        return $this->supportinternepersext;
    }

    /**
     * Set locationsallejourint
     *
     * @param string $locationsallejourint
     *
     * @return TarifVenteThemeIntra
     */
    public function setLocationsallejourint($locationsallejourint)
    {
        $this->locationsallejourint = $locationsallejourint;

        return $this;
    }

    /**
     * Get locationsallejourint
     *
     * @return string
     */
    public function getLocationsallejourint()
    {
        return $this->locationsallejourint;
    }

    /**
     * Set repasjourint
     *
     * @param string $repasjourint
     *
     * @return TarifVenteThemeIntra
     */
    public function setRepasjourint($repasjourint)
    {
        $this->repasjourint = $repasjourint;

        return $this;
    }

    /**
     * Get repasjourint
     *
     * @return string
     */
    public function getRepasjourint()
    {
        return $this->repasjourint;
    }

    /**
     * Set testvalidationpersint
     *
     * @param string $testvalidationpersint
     *
     * @return TarifVenteThemeIntra
     */
    public function setTestvalidationpersint($testvalidationpersint)
    {
        $this->testvalidationpersint = $testvalidationpersint;

        return $this;
    }

    /**
     * Get testvalidationpersint
     *
     * @return string
     */
    public function getTestvalidationpersint()
    {
        return $this->testvalidationpersint;
    }

    /**
     * Set testvalidationpersext
     *
     * @param string $testvalidationpersext
     *
     * @return TarifVenteThemeIntra
     */
    public function setTestvalidationpersext($testvalidationpersext)
    {
        $this->testvalidationpersext = $testvalidationpersext;

        return $this;
    }

    /**
     * Get testvalidationpersext
     *
     * @return string
     */
    public function getTestvalidationpersext()
    {
        return $this->testvalidationpersext;
    }

    /**
     * Set archive
     *
     * @param boolean $archive
     *
     * @return TarifVenteThemeIntra
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
     * @return TarifVenteThemeIntra
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
     * @return TarifVenteThemeIntra
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
     * Set theme
     *
     * @param \App\Entity\Theme $theme
     *
     * @return TarifVenteThemeIntra
     */
    public function setTheme(\App\Entity\Theme $theme = null)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return \App\Entity\Theme
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Set module
     *
     * @param \App\Entity\Module $module
     *
     * @return TarifVenteThemeIntra
     */
    public function setModule(\App\Entity\Module $module = null)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get module
     *
     * @return \App\Entity\Module
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return TarifVenteThemeIntra
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
     * @return TarifVenteThemeIntra
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
     * Add intrajourclient
     *
     * @param \App\Entity\TarifVenteIntraJourClient $intrajourclient
     *
     * @return TarifVenteThemeIntra
     */
    public function addIntrajourclient(\App\Entity\TarifVenteIntraJourClient $intrajourclient)
    {
        $this->intrajourclients[] = $intrajourclient;
		$intrajourclient->setTarifVenteThemeIntra($this);
        return $this;
    }

    /**
     * Remove intrajourclient
     *
     * @param \App\Entity\TarifVenteIntraJourClient $intrajourclient
     */
    public function removeIntrajourclient(\App\Entity\TarifVenteIntraJourClient $intrajourclient)
    {
        $this->intrajourclients->removeElement($intrajourclient);
    }

    /**
     * Get intrajourclients
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIntrajourclients()
    {
        return $this->intrajourclients;
    }

    /**
     * Add intrajourof
     *
     * @param \App\Entity\TarifVenteIntraJourOf $intrajourof
     *
     * @return TarifVenteThemeIntra
     */
    public function addIntrajourof(\App\Entity\TarifVenteIntraJourOf $intrajourof)
    {
        $this->intrajourofs[] = $intrajourof;
		$intrajourof->setTarifVenteThemeIntra($this);
        return $this;
    }

    /**
     * Remove intrajourof
     *
     * @param \App\Entity\TarifVenteIntraJourOf $intrajourof
     */
    public function removeIntrajourof(\App\Entity\TarifVenteIntraJourOf $intrajourof)
    {
        $this->intrajourofs->removeElement($intrajourof);
    }

    /**
     * Get intrajourofs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIntrajourofs()
    {
        return $this->intrajourofs;
    }

    /**
     * Set tarifdefaut
     *
     * @param \App\Entity\TarifVenteThemeIntra $tarifdefaut
     *
     * @return TarifVenteThemeIntra
     */
    public function setTarifdefaut(\App\Entity\TarifVenteThemeIntra $tarifdefaut = null)
    {
        $this->tarifdefaut = $tarifdefaut;

        return $this;
    }

    /**
     * Get tarifdefaut
     *
     * @return \App\Entity\TarifVenteThemeIntra
     */
    public function getTarifdefaut()
    {
        return $this->tarifdefaut;
    }


    public function getIntrajourclient()
    {
       foreach ($this->intrajourclients as $intrajourclient) {
           return $intrajourclient;
       }
    }


     
}
