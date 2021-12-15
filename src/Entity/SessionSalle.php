<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * SessionSalle
 *
 * @ORM\Table(name="sessions_salles")
 * @ORM\Entity(repositoryClass="App\Repository\SessionSalleRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class SessionSalle
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\SessionEvenement", inversedBy="sessionsalles")
	*/
	private $sessionevenement;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Salle", inversedBy="sessionsalles")
	*/
	private $salle;

	/**
	* @ORM\OneToMany(targetEntity="App\Entity\VrReunion", mappedBy="sessionsalle", orphanRemoval=true, cascade={"remove","persist"})
	*/
	private $vrreunions;

   	/**
	* @ORM\OneToMany(targetEntity="App\Entity\SessionModuleParcours", mappedBy="sessionsalle")
	*/
	private $sessionmoduleparcours;

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
     * @return SessionSalle
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
     * @return SessionSalle
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
     * Set sessionevenement
     *
     * @param \App\Entity\SessionEvenement $sessionevenement
     *
     * @return SessionSalle
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
     * Set salle
     *
     * @param \App\Entity\Salle $salle
     *
     * @return SessionSalle
     */
    public function setSalle(\App\Entity\Salle $salle = null)
    {
        $this->salle = $salle;

        return $this;
    }

    /**
     * Get salle
     *
     * @return \App\Entity\Salle
     */
    public function getSalle()
    {
        return $this->salle;
    }

    /**
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return SessionSalle
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
     * @return SessionSalle
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
	
	// le nombre de personnes inscrites à cette session dans cette salle
	public function getNbPersonnes()
	{
		return $this->getSessionevenement()->getNbpersonnes();
	}
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->vrreunions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add vrreunion.
     *
     * @param \App\Entity\VrReunion $vrreunion
     *
     * @return SessionSalle
     */
    public function addVrreunion(\App\Entity\VrReunion $vrreunion)
    {
        $this->vrreunions[] = $vrreunion;
		$vrreunion->setSessionsalle($this);
        return $this;
    }

    /**
     * Remove vrreunion.
     *
     * @param \App\Entity\VrReunion $vrreunion
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeVrreunion(\App\Entity\VrReunion $vrreunion)
    {
        return $this->vrreunions->removeElement($vrreunion);
    }

    /**
     * Get vrreunions.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVrreunions()
    {
        return $this->vrreunions;
    }

    /**
     * Add sessionmoduleparcour.
     *
     * @param \App\Entity\SessionModuleParcours $sessionmoduleparcour
     *
     * @return SessionSalle
     */
    public function addSessionmoduleparcour(\App\Entity\SessionModuleParcours $sessionmoduleparcour)
    {
        $this->sessionmoduleparcours[] = $sessionmoduleparcour;
        $sessionmoduleparcour->setSessionsalle($this);
        return $this;
    }

    /**
     * Remove sessionmoduleparcour.
     *
     * @param \App\Entity\SessionModuleParcours $sessionmoduleparcour
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeSessionmoduleparcour(\App\Entity\SessionModuleParcours $sessionmoduleparcour)
    {
        return $this->sessionmoduleparcours->removeElement($sessionmoduleparcour);
    }

    /**
     * Get sessionmoduleparcours.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSessionmoduleparcours()
    {
        return $this->sessionmoduleparcours;
    }
}
