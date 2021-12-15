<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * SessionListeJury
 *
 * @ORM\Table(name="sessions_liste_jurys")
 * @ORM\Entity(repositoryClass="App\Repository\SessionListeJuryRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class SessionListeJury
{

    /**
     * Constructor
     */
    public function __construct()
    {
		$this->president = false;
		$this->present = false;
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
	* @ORM\ManyToOne(targetEntity="App\Entity\SessionJury", inversedBy="sessionlistejurys")
	*/
	private $sessionjury;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Jury", inversedBy="sessionlistejurys")
	*/
	private $jury;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $president;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $present;

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
     * Set president
     *
     * @param boolean $president
     *
     * @return SessionListeJury
     */
    public function setPresident($president)
    {
        $this->president = $president;

        return $this;
    }

    /**
     * Get president
     *
     * @return boolean
     */
    public function getPresident()
    {
        return $this->president;
    }

    /**
     * Set present
     *
     * @param boolean $present
     *
     * @return SessionListeJury
     */
    public function setPresent($present)
    {
        $this->present = $present;

        return $this;
    }

    /**
     * Get present
     *
     * @return boolean
     */
    public function getPresent()
    {
        return $this->present;
    }

    /**
     * Set dateinsert
     *
     * @param \DateTime $dateinsert
     *
     * @return SessionListeJury
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
     * @return SessionListeJury
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
     * Set sessionjury
     *
     * @param \App\Entity\SessionJury $sessionjury
     *
     * @return SessionListeJury
     */
    public function setSessionjury(\App\Entity\SessionJury $sessionjury = null)
    {
        $this->sessionjury = $sessionjury;

        return $this;
    }

    /**
     * Get sessionjury
     *
     * @return \App\Entity\SessionJury
     */
    public function getSessionjury()
    {
        return $this->sessionjury;
    }

    /**
     * Set jury
     *
     * @param \App\Entity\Jury $jury
     *
     * @return SessionListeJury
     */
    public function setJury(\App\Entity\Jury $jury = null)
    {
        $this->jury = $jury;

        return $this;
    }

    /**
     * Get jury
     *
     * @return \App\Entity\Jury
     */
    public function getJury()
    {
        return $this->jury;
    }

    /**
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return SessionListeJury
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
     * @return SessionListeJury
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
}
