<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * SessionAccompagnementSession
 *
 * @ORM\Table(name="session_accompagnement_session")
 * @ORM\Entity(repositoryClass="App\Repository\SessionAccompagnementSessionRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class SessionAccompagnementSession
{

    /**
     * Constructor
     */
    public function __construct()
    {
		$this->archive = false;
		$this->compteheure = false;
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
	* @ORM\ManyToOne(targetEntity="App\Entity\SessionAccompagnement", inversedBy="sessionaccompagnementsessions", cascade={"persist"})
	*/
	private $sessionaccompagnement;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $compteheure;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Session", inversedBy="sessionaccompagnementsessions", cascade={"persist"})
	*/
	private $session;

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
     * Set archive
     *
     * @param boolean $archive
     *
     * @return SessionAccompagnementSession
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
     * Set compteheure
     *
     * @param boolean $compteheure
     *
     * @return SessionAccompagnementSession
     */
    public function setCompteheure($compteheure)
    {
        $this->compteheure = $compteheure;

        return $this;
    }

    /**
     * Get compteheure
     *
     * @return boolean
     */
    public function getCompteheure()
    {
        return $this->compteheure;
    }

    /**
     * Set dateinsert
     *
     * @param \DateTime $dateinsert
     *
     * @return SessionAccompagnementSession
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
     * @return SessionAccompagnementSession
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
     * Set sessionaccompagnement
     *
     * @param \App\Entity\SessionAccompagnement $sessionaccompagnement
     *
     * @return SessionAccompagnementSession
     */
    public function setSessionaccompagnement(\App\Entity\SessionAccompagnement $sessionaccompagnement = null)
    {
        $this->sessionaccompagnement = $sessionaccompagnement;

        return $this;
    }

    /**
     * Get sessionaccompagnement
     *
     * @return \App\Entity\SessionAccompagnement
     */
    public function getSessionaccompagnement()
    {
        return $this->sessionaccompagnement;
    }

    /**
     * Set session
     *
     * @param \App\Entity\Session $session
     *
     * @return SessionAccompagnementSession
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
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return SessionAccompagnementSession
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
     * @return SessionAccompagnementSession
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
