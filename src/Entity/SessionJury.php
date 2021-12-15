<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * SessionJury
 *
 * @ORM\Table(name="sessions_jurys")
 * @ORM\Entity(repositoryClass="App\Repository\SessionJuryRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class SessionJury
{

    /**
     * Constructor
     */
    public function __construct()
    {
		$this->sessionlistejurys = new \Doctrine\Common\Collections\ArrayCollection();
		$this->sessiondossiers = new \Doctrine\Common\Collections\ArrayCollection();
		$this->aeulieu = false;
		$this->sessionunitaire = false;
		$this->duree = 0;
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
    * @ORM\OneToMany(targetEntity="App\Entity\SessionListeJury", mappedBy="sessionjury")
    */
    private $sessionlistejurys;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Jury", inversedBy="sessionjurys")
	*/
	private $jury;

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
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $duree;

    /**
    * @ORM\ManyToMany(targetEntity="App\Entity\SessionDossier", mappedBy="sessionjurys")
    */
    private $sessiondossiers;


    /**
    * @ORM\OneToOne(targetEntity="App\Entity\SessionEvenement", inversedBy="sessionjury", cascade={"persist", "remove"})
    */
    private $sessionevenement;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Parcours")
    */
    private $parcours;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $aeulieu;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $sessionunitaire;

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
     * Set aeulieu
     *
     * @param boolean $aeulieu
     *
     * @return SessionJury
     */
    public function setAeulieu($aeulieu)
    {
        $this->aeulieu = $aeulieu;

        return $this;
    }

    /**
     * Get aeulieu
     *
     * @return boolean
     */
    public function getAeulieu()
    {
        return $this->aeulieu;
    }

    /**
     * Set dateinsert
     *
     * @param \DateTime $dateinsert
     *
     * @return SessionJury
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
     * @return SessionJury
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
     * Add sessionlistejury
     *
     * @param \App\Entity\Sessionlistejury $sessionlistejury
     *
     * @return SessionJury
     */
    public function addSessionlistejury(\App\Entity\Sessionlistejury $sessionlistejury)
    {
        $this->sessionlistejurys[] = $sessionlistejury;
        $sessionlistejury->setSessionjury($this);
        return $this;
    }

    /**
     * Remove sessionlistejury
     *
     * @param \App\Entity\Sessionlistejury $sessionlistejury
     */
    public function removeSessionlistejury(\App\Entity\Sessionlistejury $sessionlistejury)
    {
        $this->sessionlistejurys->removeElement($sessionlistejury);
    }

    /**
     * Get sessionlistejurys
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSessionlistejurys()
    {
        return $this->sessionlistejurys;
    }

    /**
     * Set sessionevenement
     *
     * @param \App\Entity\SessionEvenement $sessionevenement
     *
     * @return SessionJury
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
     * Set parcours
     *
     * @param \App\Entity\Parcours $parcours
     *
     * @return SessionJury
     */
    public function setParcours(\App\Entity\Parcours $parcours = null)
    {
        $this->parcours = $parcours;

        return $this;
    }

    /**
     * Get parcours
     *
     * @return \App\Entity\Parcours
     */
    public function getParcours()
    {
        return $this->parcours;
    }

    /**
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return SessionJury
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
     * @return SessionJury
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
        return count($this->getSessiondossiers());
    }

    /**
     * Add sessiondossier
     *
     * @param \App\Entity\SessionDossier $sessiondossier
     *
     * @return SessionJury
     */
    public function addSessiondossier(\App\Entity\SessionDossier $sessiondossier)
    {
        $this->sessiondossiers[] = $sessiondossier;
        $sessiondossier->setSessionJury($this);
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
     * Set jury.
     *
     * @param \App\Entity\Jury|null $jury
     *
     * @return SessionJury
     */
    public function setJury(\App\Entity\Jury $jury = null)
    {
        $this->jury = $jury;

        return $this;
    }

    /**
     * Get jury.
     *
     * @return \App\Entity\Jury|null
     */
    public function getJury()
    {
        return $this->jury;
    }

    /**
     * Set datedebut.
     *
     * @param \DateTime|null $datedebut
     *
     * @return SessionJury
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
     * @return SessionJury
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
     * Set sessionunitaire.
     *
     * @param bool|null $sessionunitaire
     *
     * @return SessionJury
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
     * Set duree.
     *
     * @param string|null $duree
     *
     * @return SessionJury
     */
    public function setDuree($duree = null)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree.
     *
     * @return string|null
     */
    public function getDuree()
    {
        return $this->duree;
    }
}
