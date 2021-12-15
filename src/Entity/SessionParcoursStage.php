<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * SessionParcoursStage
 *
 * @ORM\Table(name="sessionparcours_stage")
 * @ORM\Entity(repositoryClass="App\Repository\SessionParcoursStageRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class SessionParcoursStage
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sessionevenements = new \Doctrine\Common\Collections\ArrayCollection();
        $this->conventions = new \Doctrine\Common\Collections\ArrayCollection();
		$this->duree=0;
		$this->reel = false;
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
	* @ORM\ManyToOne(targetEntity="App\Entity\SessionDossier", inversedBy="sessionparcoursstages", cascade={"persist"})
	*/
	private $sessiondossier;

	/**
	* @ORM\OneToMany(targetEntity="App\Entity\SessionEvenement", mappedBy="sessionparcoursstage", cascade={"persist"})
	*/
	private $sessionevenements;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Tuteur", inversedBy="sessionparcoursstages", cascade={"persist"})
	*/
	private $tuteur;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Stage", inversedBy="sessionparcoursstages", cascade={"persist"})
	*/
	private $stage;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Entreprise", inversedBy="sessionparcoursstages")
	*/
	private $entreprise;

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
     * @ORM\Column(type="integer",nullable=true)
     */
    private $duree;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $reel;

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
     * @var string
     *
     * @ORM\Column(name="statut", type="string", length=255)
     */
    private $statut = false;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\Convention", mappedBy="sessionparcoursstage", cascade={"persist"})
    */
    private $conventions;

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
     * Set dateinsert
     *
     * @param \DateTime $dateinsert
     *
     * @return SessionParcoursStage
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
     * @return SessionParcoursStage
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
     * Set tuteur
     *
     * @param \App\Entity\Tuteur $tuteur
     *
     * @return SessionParcoursStage
     */
    public function setTuteur(\App\Entity\Tuteur $tuteur = null)
    {
        $this->tuteur = $tuteur;

        return $this;
    }

    /**
     * Get tuteur
     *
     * @return \App\Entity\Tuteur
     */
    public function getTuteur()
    {
        return $this->tuteur;
    }

    /**
     * Set stage
     *
     * @param \App\Entity\Stage $stage
     *
     * @return SessionParcoursStage
     */
    public function setStage(\App\Entity\Stage $stage = null)
    {
        $this->stage = $stage;

        return $this;
    }

    /**
     * Get stage
     *
     * @return \App\Entity\Stage
     */
    public function getStage()
    {
        return $this->stage;
    }

    /**
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return SessionParcoursStage
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
     * @return SessionParcoursStage
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
     * Add sessionevenement
     *
     * @param \App\Entity\SessionEvenements $sessionevenement
     *
     * @return SessionParcoursStage
     */
    public function addSessionevenement(\App\Entity\SessionEvenement $sessionevenement)
    {
        $this->sessionevenements[] = $sessionevenement;
		$sessionevenement->setSessionParcoursStage($this);
        return $this;
    }

    /**
     * Remove sessionevenement
     *
     * @param \App\Entity\SessionEvenements $sessionevenement
     */
    public function removeSessionevenement(\App\Entity\SessionEvenement $sessionevenement)
    {
        $this->sessionevenements->removeElement($sessionevenement);
    }

    /**
     * Get sessionevenements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSessionevenements()
    {
        return $this->sessionevenements;
    }

    /**
     * Set sessiondossier
     *
     * @param \App\Entity\SessionDossier $sessiondossier
     *
     * @return SessionParcoursStage
     */
    public function setSessiondossier(\App\Entity\SessionDossier $sessiondossier = null)
    {
        $this->sessiondossier = $sessiondossier;

        return $this;
    }

    /**
     * Get sessiondossier
     *
     * @return \App\Entity\SessionDossier
     */
    public function getSessiondossier()
    {
        return $this->sessiondossier;
    }

    /**
     * Set datedebut
     *
     * @param \DateTime $datedebut
     *
     * @return SessionParcoursStage
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
     * @return SessionParcoursStage
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
     * Set duree
     *
     * @param integer $duree
     *
     * @return SessionParcoursStage
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree
     *
     * @return integer
     */
    public function getDuree()
    {
        return $this->duree;
    }




    /**
     * Set entreprise
     *
     * @param \App\Entity\Entreprise $entreprise
     *
     * @return SessionParcoursStage
     */
    public function setEntreprise(\App\Entity\Entreprise $entreprise = null)
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    /**
     * Get entreprise
     *
     * @return \App\Entity\Entreprise
     */
    public function getEntreprise()
    {
        return $this->entreprise;
    }

    /**
     * Set reel
     *
     * @param boolean $reel
     *
     * @return SessionParcoursStage
     */
    public function setReel($reel)
    {
        $this->reel = $reel;

        return $this;
    }

    /**
     * Get reel
     *
     * @return boolean
     */
    public function getReel()
    {
        return $this->reel;
    }



    /**
     * Add convention
     *
     * @param \App\Entity\Convention $convention
     *
     * @return Convention
     */
    public function addConvention(\App\Entity\Convention $convention)
    {
        $this->conventions[] = $convention;
        $convention->setSessionparcoursstage($this);
        return $this;
    }

    /**
     * Remove convention
     *
     * @param \App\Entity\Convention $convention
     */
    public function removeConvention(\App\Entity\Convention $convention)
    {
        $this->conventions->removeElement($convention);
    }

    /**
     * Get conventions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getConventions()
    {
        return $this->conventions;
    }


    /**
     * Set statut
     *
     * @param string $statut
     *
     * @return SessionParcoursStage
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return string
     */
    public function getStatut()
    {
        return $this->statut;
    }


    public function getSessionevenement()
    {
        foreach ($this->sessionevenements as $sessionevenement) {
           return $sessionevenement;
        }
         
    }
}
