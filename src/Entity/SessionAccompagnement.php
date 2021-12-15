<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * SessionAccompagnement
 *
 * @ORM\Table(name="session_accompagnement")
 * @ORM\Entity(repositoryClass="App\Repository\SessionAccompagnementRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class SessionAccompagnement
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sessionaccompagnementsessions = new \Doctrine\Common\Collections\ArrayCollection();
		$this->archive = false;
    }

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $archive;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $duree;

	/**
	* @ORM\OneToMany(targetEntity="App\Entity\SessionAccompagnementSession", mappedBy="sessionaccompagnement", cascade={"persist"})
	*/
	private $sessionaccompagnementsessions;

	/**
    * @ORM\OneToOne(targetEntity="App\Entity\SessionEvenement", inversedBy="sessionaccompagnement", cascade={"persist", "remove"})
    */
    private $sessionevenement;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
	*/
	private $typeaccompagnement;

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
     * @return SessionAccompagnement
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
     * Set duree
     *
     * @param integer $duree
     *
     * @return SessionAccompagnement
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
     * Set datedebut
     *
     * @param \DateTime $datedebut
     *
     * @return SessionAccompagnement
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
     * @return SessionAccompagnement
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
     * Set dateinsert
     *
     * @param \DateTime $dateinsert
     *
     * @return SessionAccompagnement
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
     * @return SessionAccompagnement
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
     * Add sessionaccompagnementsession
     *
     * @param \App\Entity\SessionAccompagnementSession $sessionaccompagnementsession
     *
     * @return SessionAccompagnement
     */
    public function addSessionaccompagnementsession(\App\Entity\SessionAccompagnementSession $sessionaccompagnementsession)
    {
        $this->sessionaccompagnementsessions[] = $sessionaccompagnementsession;
		$sessionaccompagnementsession->setSessionaccompagnement($this);
        return $this;
    }

    /**
     * Remove sessionaccompagnementsession
     *
     * @param \App\Entity\SessionAccompagnementSession $sessionaccompagnementsession
     */
    public function removeSessionaccompagnementsession(\App\Entity\SessionAccompagnementSession $sessionaccompagnementsession)
    {
        $this->sessionaccompagnementsessions->removeElement($sessionaccompagnementsession);
//		$sessionaccompagnementsession->setSessionaccompagnement(null);
    }

    /**
     * Get sessionaccompagnementsessions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSessionaccompagnementsessions()
    {
        return $this->sessionaccompagnementsessions;
    }

    /**
     * Set sessionevenement
     *
     * @param \App\Entity\SessionEvenement $sessionevenement
     *
     * @return SessionAccompagnement
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
     * Set typeaccompagnement
     *
     * @param \App\Entity\Masterlistelg $typeaccompagnement
     *
     * @return SessionAccompagnement
     */
    public function setTypeaccompagnement(\App\Entity\Masterlistelg $typeaccompagnement = null)
    {
        $this->typeaccompagnement = $typeaccompagnement;

        return $this;
    }

    /**
     * Get typeaccompagnement
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getTypeaccompagnement()
    {
        return $this->typeaccompagnement;
    }

    /**
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return SessionAccompagnement
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
     * @return SessionAccompagnement
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

	public function getDureeJours()
	{
		if(!is_null($this->duree)){
			return $this->duree/7;
		}else{
			return 0;
		}
	}
}
