<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SessionEmargement
 *
 * @ORM\Table(name="session_emargement_justificatif")
 * @ORM\Entity(repositoryClass="App\Repository\SessionEmargementJustificatifRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class SessionEmargementJustificatif {

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sessionemargements = new \Doctrine\Common\Collections\ArrayCollection();
		$this->justificationvalide = false;
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
    * @ORM\ManyToOne(targetEntity="App\Entity\SessionDossier", inversedBy="justificatifs", cascade={"persist"})
    */
    private $sessiondossier;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\SessionEmargement", mappedBy="justificatif", cascade={"persist"})
     */
    private $sessionemargements;

	/**
     * @ORM\Column(type="datetime", nullable=true)
	*/
	private $datedebut;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $debutampm;

	/**
     * @ORM\Column(type="datetime", nullable=true)
	*/
	private $datefin;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $finampm;

	/**
	* @ORM\JoinColumn(nullable=true)
	* @ORM\ManyToOne(targetEntity="App\Entity\Upload", cascade={"persist", "remove"})
     */
    private $justificatif;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $justificationvalide;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\User")
	*/
	private $quiinsert;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\User")
	*/
	private $quiupdate;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

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
     * @return SessionEmargementJustificatif
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
     * @return SessionEmargementJustificatif
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
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return SessionEmargementJustificatif
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set dateinsert
     *
     * @param \DateTime $dateinsert
     *
     * @return SessionEmargementJustificatif
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
     * @return SessionEmargementJustificatif
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
     * Add sessionemargement
     *
     * @param \App\Entity\SessionEmargement $sessionemargement
     *
     * @return SessionEmargementJustificatif
     */
    public function addSessionemargement(\App\Entity\SessionEmargement $sessionemargement)
    {
        $this->sessionemargements[] = $sessionemargement;

        return $this;
    }

    /**
     * Remove sessionemargement
     *
     * @param \App\Entity\SessionEmargement $sessionemargement
     */
    public function removeSessionemargement(\App\Entity\SessionEmargement $sessionemargement)
    {
        $this->sessionemargements->removeElement($sessionemargement);
    }

    /**
     * Get sessionemargements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSessionemargements()
    {
        return $this->sessionemargements;
    }

    /**
     * Set debutampm
     *
     * @param \App\Entity\Masterlistelg $debutampm
     *
     * @return SessionEmargementJustificatif
     */
    public function setDebutampm(\App\Entity\Masterlistelg $debutampm = null)
    {
        $this->debutampm = $debutampm;

        return $this;
    }

    /**
     * Get debutampm
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getDebutampm()
    {
        return $this->debutampm;
    }

    /**
     * Set finampm
     *
     * @param \App\Entity\Masterlistelg $finampm
     *
     * @return SessionEmargementJustificatif
     */
    public function setFinampm(\App\Entity\Masterlistelg $finampm = null)
    {
        $this->finampm = $finampm;

        return $this;
    }

    /**
     * Get finampm
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getFinampm()
    {
        return $this->finampm;
    }

    /**
     * Set justificatif
     *
     * @param \App\Entity\Upload $justificatif
     *
     * @return SessionEmargementJustificatif
     */
    public function setJustificatif(\App\Entity\Upload $justificatif = null)
    {
        $this->justificatif = $justificatif;
		$this->justificatif->setDirectoryUpload($this->getDirectoryUpload());
        return $this;
    }

	public function getDirectoryUpload()
	{
		return strtolower((new \ReflectionClass($this))->getShortName().'-'.'justificatif');
	}

    /**
     * Get justificatif
     *
     * @return \App\Entity\Upload
     */
    public function getJustificatif()
    {
        return $this->justificatif;
    }

    /**
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return SessionEmargementJustificatif
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
     * @return SessionEmargementJustificatif
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
     * Set justificationvalide
     *
     * @param boolean $justificationvalide
     *
     * @return SessionEmargementJustificatif
     */
    public function setJustificationvalide($justificationvalide)
    {
        $this->justificationvalide = $justificationvalide;

        return $this;
    }

    /**
     * Get justificationvalide
     *
     * @return boolean
     */
    public function getJustificationvalide()
    {
        return $this->justificationvalide;
    }

    /**
     * Set sessiondossier
     *
     * @param \App\Entity\SessionDossier $sessiondossier
     *
     * @return SessionEmargementJustificatif
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
}
