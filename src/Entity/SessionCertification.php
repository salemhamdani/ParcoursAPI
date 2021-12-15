<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * SessionCertification
 *
 * @ORM\Table(name="sessions_certifications")
 * @ORM\Entity(repositoryClass="App\Repository\SessionCertificationRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class SessionCertification
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sessiondossiers = new \Doctrine\Common\Collections\ArrayCollection();

		$this->archive = false;
		$this->publiesite=false;
		$this->duree=0;
		$this->sessionunitaire=false;
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
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $archive;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $intitule;

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
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $sessionunitaire;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Certification")
	*/
	private $certification;

	/**
	* @ORM\ManyToMany(targetEntity="App\Entity\SessionDossier", inversedBy="sessioncertifications")
	*/
	private $sessiondossiers;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $duree;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $publiesite;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Session", inversedBy="sessioncertifications")
	*/
	private $session;

	/**
    * @ORM\OneToOne(targetEntity="App\Entity\SessionEvenement", inversedBy="sessioncertif", cascade={"remove","persist"})
    */
    private $sessionevenement;

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
     * @return SessionCertification
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
     * @return SessionCertification
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
     * Set certification
     *
     * @param \App\Entity\Certification $certification
     *
     * @return SessionCertification
     */
    public function setCertification(\App\Entity\Certification $certification = null)
    {
        $this->certification = $certification;

        return $this;
    }

    /**
     * Get certification
     *
     * @return \App\Entity\Certification
     */
    public function getCertification()
    {
        return $this->certification;
    }

    /**
     * Add sessiondossier
     *
     * @param \App\Entity\SessionDossier $sessiondossier
     *
     * @return SessionCertification
     */
    public function addSessiondossier(\App\Entity\SessionDossier $sessiondossier)
    {
        $this->sessiondossiers[] = $sessiondossier;

        return $this;
    }

    /**
     * Remove sessiondossier
     *
     * @param \App\Entity\SessionDossier $sessiondossier
     */
    public function removeSessiondossier(\App\Entity\SessionDossier $sessiondossier)
    {
        $this->sessiondossiers->removeElement($sessiondossier);
    }

    /**
     * Get sessiondossiers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSessiondossiers()
    {
        return $this->sessiondossiers;
    }

    /**
     * Set session
     *
     * @param \App\Entity\Session $session
     *
     * @return SessionCertification
     */
    public function setSession(\App\Entity\Session $session = null)
    {
        $this->session = $session;

        return $this;
    }

    /**
     * Get session
     *
     * @return \App\Entity\Session
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * Set sessionevenement
     *
     * @param \App\Entity\SessionEvenement $sessionevenement
     *
     * @return SessionCertification
     */
    public function setSessionevenement(\App\Entity\SessionEvenement $sessionevenement = null)
    {
        $this->sessionevenement = $sessionevenement;

        return $this;
    }

    /**
     * Get sessionevenement
     *
     * @return \App\Entity\SessionEvenement
     */
    public function getSessionevenement()
    {
        return $this->sessionevenement;
    }

    /**
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return SessionCertification
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
     * @return SessionCertification
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

	public function getNbPersonnes(){
		return count($this->getSessionDossiers());
	}


    /**
     * Set archive.
     *
     * @param bool $archive
     *
     * @return SessionCertification
     */
    public function setArchive($archive)
    {
        $this->archive = $archive;

        return $this;
    }

    /**
     * Get archive.
     *
     * @return bool
     */
    public function getArchive()
    {
        return $this->archive;
    }

    /**
     * Set sessionunitaire.
     *
     * @param bool|null $sessionunitaire
     *
     * @return SessionCertification
     */
    public function setSessionunitaire($sessionunitaire = null)
    {
        $this->sessionunitaire = $sessionunitaire;

        return $this;
    }

    /**
     * Get sessionunitaire.
     *
     * @return bool|null
     */
    public function getSessionunitaire()
    {
        return $this->sessionunitaire;
    }

    /**
     * Set publiesite.
     *
     * @param bool $publiesite
     *
     * @return SessionCertification
     */
    public function setPubliesite($publiesite)
    {
        $this->publiesite = $publiesite;

        return $this;
    }

    /**
     * Get publiesite.
     *
     * @return bool
     */
    public function getPubliesite()
    {
        return $this->publiesite;
    }

    /**
     * Set datedebut.
     *
     * @param \DateTime|null $datedebut
     *
     * @return SessionCertification
     */
    public function setDatedebut($datedebut = null)
    {
        $this->datedebut = $datedebut;

        return $this;
    }

    /**
     * Get datedebut.
     *
     * @return \DateTime|null
     */
    public function getDatedebut()
    {
        return $this->datedebut;
    }

    /**
     * Set datefin.
     *
     * @param \DateTime|null $datefin
     *
     * @return SessionCertification
     */
    public function setDatefin($datefin = null)
    {
        $this->datefin = $datefin;

        return $this;
    }

    /**
     * Get datefin.
     *
     * @return \DateTime|null
     */
    public function getDatefin()
    {
        return $this->datefin;
    }

    /**
     * Set intitule.
     *
     * @param string|null $intitule
     *
     * @return SessionCertification
     */
    public function setIntitule($intitule = null)
    {
        $this->intitule = $intitule;

        return $this;
    }

    /**
     * Get intitule.
     *
     * @return string|null
     */
    public function getIntitule()
    {
        return $this->intitule;
    }

    /**
     * Set duree.
     *
     * @param string $duree
     *
     * @return SessionCertification
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree.
     *
     * @return string
     */
    public function getDuree()
    {
        return $this->duree;
    }
}
