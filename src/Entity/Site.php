<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * Site
 *
 * @ORM\Table(name="sites")
 * @ORM\Entity(repositoryClass="App\Repository\SiteRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class Site
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->salles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->archive = false;
        $this->virtuel = false;
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
     * @ORM\Column(type="string", length=250)
     * @Assert\NotBlank(message="Ce champ est obligatoire.")
     */
    private $intitule;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $siret;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Societe", inversedBy="sites")
	*/
	private $societe;
	
	/**
	* @ORM\OneToMany(targetEntity="App\Entity\Salle", mappedBy="site")
	*/
	private $salles;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Adresse",  cascade={"persist"})
	*/
	private $adresse;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\PersonalInformations",  cascade={"persist"})
	*/
	private $personalinformations;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $archive;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $virtuel;

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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

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
     * Set dateinsert
     *
     * @param \DateTime $dateinsert
     *
     * @return Societe
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
     * @return Societe
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
     * Set societe
     *
     * @param \App\Entity\societe $societe
     *
     * @return Site
     */
    public function setSociete(\App\Entity\Societe $societe = null)
    {
        $this->societe = $societe;

        return $this;
    }

    /**
     * Get societe
     *
     * @return \App\Entity\societe
     */
    public function getSociete()
    {
        return $this->societe;
    }

    /**
     * Set intitule
     *
     * @param string $intitule
     *
     * @return Site
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
     * Set archive
     *
     * @param boolean $archive
     *
     * @return Site
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
     * Add salle
     *
     * @param \App\Entity\Salle $salle
     *
     * @return Site
     */
    public function addSalle(\App\Entity\Salle $salle)
    {
        $this->salles[] = $salle;
		$salle->setSite($this);
        return $this;
    }

    /**
     * Remove salle
     *
     * @param \App\Entity\Salle $salle
     */
    public function removeSalle(\App\Entity\Salle $salle)
    {
        $this->salles->removeElement($salle);
    }

    /**
     * Get salles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSalles()
    {
        return $this->salles;
    }

    /**
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return Site
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
     * @return Site
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
     * Set adresse
     *
     * @param \App\Entity\Adresse $adresse
     *
     * @return Site
     */
    public function setAdresse(\App\Entity\Adresse $adresse = null)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return \App\Entity\Adresse
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

	public function getNbSalles()
	{
		return count($this->getSalles());
	}


    /**
     * Set personalinformations
     *
     * @param \App\Entity\PersonalInformations $personalinformations
     *
     * @return Site
     */
    public function setPersonalinformations(\App\Entity\PersonalInformations $personalinformations = null)
    {
        $this->personalinformations = $personalinformations;

        return $this;
    }

    /**
     * Get personalinformations
     *
     * @return \App\Entity\PersonalInformations
     */
    public function getPersonalinformations()
    {
        return $this->personalinformations;
    }

    /**
     * Set siret
     *
     * @param string $siret
     *
     * @return Site
     */
    public function setSiret($siret)
    {
        $this->siret = $siret;

        return $this;
    }

    /**
     * Get siret
     *
     * @return string
     */
    public function getSiret()
    {
        return $this->siret;
    }
	
	public function getFullIntitule()
	{
		return $this->getSociete()->getRaisonsociale().' '.$this->getIntitule();
	}
    
    public function getFullAdresse()
    {
        return $this->adresse->getFullDesignation();
    }

    /**
     * Set virtuel.
     *
     * @param bool $virtuel
     *
     * @return Site
     */
    public function setVirtuel($virtuel)
    {
        $this->virtuel = $virtuel;

        return $this;
    }

    /**
     * Get virtuel.
     *
     * @return bool
     */
    public function getVirtuel()
    {
        return $this->virtuel;
    }
}
