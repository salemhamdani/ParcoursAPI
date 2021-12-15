<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SessionEmargement
 *
 * @ORM\Table(name="session_emargement")
 * @ORM\Entity(repositoryClass="App\Repository\SessionEmargementRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class SessionEmargement {

    /**
     * Constructor
     */
    public function __construct()
    {
		$this->actionrealisee = false;
		$this->retard = false;
		$this->tpsretardminutes = 0;
		$this->codeemargement = "0000";
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
     * @ORM\ManyToOne(targetEntity="App\Entity\SessionModuleParcours", inversedBy="sessionemargements")
     */
    private $sessionmoduleparcours;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SessionFormateur", inversedBy="sessionemargements")
     */
    private $sessionformateur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SessionEvenement", inversedBy="sessionemargements")
     */
    private $sessionevenement;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $ampm;

	/**
	* @ORM\Column(type="boolean",nullable=true)
	*/
    private $actionrealisee;

	/**
	* @ORM\Column(type="boolean",nullable=true)
	*/
    private $estpresent;

    /**
    * @ORM\ManyToMany(targetEntity="App\Entity\CodeAbsence")
    */
    private $motifabsences;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $motifabsencecentre;

	/**
	* @ORM\Column(type="boolean",nullable=true)
	*/
    private $retard;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=4, scale=0)
     */
    private $tpsretardminutes;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $codeemargement;

    /**
    * @ORM\ManyToMany(targetEntity="App\Entity\CodeRetard")
    */
    private $motifretards;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $motifretardcentre;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\User")
	*/
	private $quiemarge;

	/**
     * @ORM\Column(type="datetime", nullable=true)
	*/
	private $dateemarge;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=4, scale=0, nullable=true)
     */
    private $duree;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SessionEmargementJustificatif", inversedBy="sessionemargements", cascade={"persist"})
     */
    private $justificatif;

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
     * Set dateinsert
     *
     * @param \DateTime $dateinsert
     *
     * @return SessionEmargement
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
     * @return SessionEmargement
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return SessionEmargement
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
     * @return SessionEmargement
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
     * Set sessionmoduleparcours
     *
     * @param \App\Entity\SessionModuleParcours $sessionmoduleparcours
     *
     * @return SessionEmargement
     */
    public function setSessionmoduleparcours(\App\Entity\SessionModuleParcours $sessionmoduleparcours = null)
    {
        $this->sessionmoduleparcours = $sessionmoduleparcours;

        return $this;
    }

    /**
     * Get sessionmoduleparcours
     *
     * @return \App\Entity\SessionModuleParcours
     */
    public function getSessionmoduleparcours()
    {
        return $this->sessionmoduleparcours;
    }


    /**
     * Set sessionformateur
     *
     * @param \App\Entity\SessionFormateur $sessionformateur
     *
     * @return SessionFormateur
     */
    public function setSessionformateur(\App\Entity\SessionFormateur $sessionformateur = null)
    {
        $this->sessionformateur = $sessionformateur;

        return $this;
    }

    /**
     * Get sessionformateur
     *
     * @return \App\Entity\SessionFormateur
     */
    public function getSessionformateur()
    {
        return $this->sessionformateur;
    }


    /**
     * Set ampm
     *
     * @param \App\Entity\Masterlistelg $ampm
     *
     * @return SessionEmargement
     */
    public function setAmpm(\App\Entity\Masterlistelg $ampm = null)
    {
        $this->ampm = $ampm;

        return $this;
    }

    /**
     * Get ampm
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getAmpm()
    {
        return $this->ampm;
    }

    /**
     * Set dateemarge
     *
     * @param \DateTime $dateemarge
     *
     * @return SessionEmargement
     */
    public function setDateemarge($dateemarge)
    {
        $this->dateemarge = $dateemarge;

        return $this;
    }

    /**
     * Get dateemarge
     *
     * @return \DateTime
     */
    public function getDateemarge()
    {
        return $this->dateemarge;
    }

    /**
     * Set quiemarge
     *
     * @param \App\Entity\User $quiemarge
     *
     * @return SessionEmargement
     */
    public function setQuiemarge(\App\Entity\User $quiemarge = null)
    {
        $this->quiemarge = $quiemarge;

        return $this;
    }

    /**
     * Get quiemarge
     *
     * @return \App\Entity\User
     */
    public function getQuiemarge()
    {
        return $this->quiemarge;
    }

    /**
     * Set actionrealisee
     *
     * @param boolean $actionrealisee
     *
     * @return SessionEmargement
     */
    public function setActionrealisee($actionrealisee)
    {
        $this->actionrealisee = $actionrealisee;

        return $this;
    }

    /**
     * Get actionrealisee
     *
     * @return boolean
     */
    public function getActionrealisee()
    {
        return $this->actionrealisee;
    }

    /**
     * Set estpresent
     *
     * @param boolean $estpresent
     *
     * @return SessionEmargement
     */
    public function setEstpresent($estpresent)
    {
        $this->estpresent = $estpresent;

        return $this;
    }

    /**
     * Get estpresent
     *
     * @return boolean
     */
    public function getEstpresent()
    {
        return $this->estpresent;
    }

    /**
     * Set sessionevenement
     *
     * @param \App\Entity\SessionEvenement $sessionevenement
     *
     * @return SessionEmargement
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
	
	public function getDatetimeEmargement()
	{
		$resultat=[];
		if($this->getAmpm()->getCode()=='AM'){
			$resultat[0]=$this->getSessionevenement()->getHeuredebut1();
			$resultat[1]=$this->getSessionevenement()->getHeurefin1();
			return $resultat;
		}
		if($this->getAmpm()->getCode()=='PM'){
			$resultat[0]=$this->getSessionevenement()->getHeuredebut2();
			$resultat[1]=$this->getSessionevenement()->getHeurefin2();
			return $resultat;
		}
		return null;
	}

    /**
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return SessionEmargement
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
     * Set justificatif
     *
     * @param \App\Entity\SessionEmargementJustificatif $justificatif
     *
     * @return SessionEmargement
     */
    public function setJustificatif(\App\Entity\SessionEmargementJustificatif $justificatif = null)
    {
        $this->justificatif = $justificatif;

        return $this;
    }

    /**
     * Get justificatif
     *
     * @return \App\Entity\SessionEmargementJustificatif
     */
    public function getJustificatif()
    {
        return $this->justificatif;
    }

    /**
     * Add motifabsence.
     *
     * @param \App\Entity\CodeAbsence $motifabsence
     *
     * @return SessionEmargement
     */
    public function addMotifabsence(\App\Entity\CodeAbsence $motifabsence)
    {
        $this->motifabsences[] = $motifabsence;

        return $this;
    }

    /**
     * Remove motifabsence.
     *
     * @param \App\Entity\CodeAbsence $motifabsence
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeMotifabsence(\App\Entity\CodeAbsence $motifabsence)
    {
        return $this->motifabsences->removeElement($motifabsence);
    }

    /**
     * Get motifabsences.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMotifabsences()
    {
        return $this->motifabsences;
    }

    /**
     * Add motifretard.
     *
     * @param \App\Entity\CodeRetard $motifretard
     *
     * @return SessionEmargement
     */
    public function addMotifretard(\App\Entity\CodeRetard $motifretard)
    {
        $this->motifretards[] = $motifretard;

        return $this;
    }

    /**
     * Remove motifretard.
     *
     * @param \App\Entity\CodeRetard $motifretard
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeMotifretard(\App\Entity\CodeRetard $motifretard)
    {
        return $this->motifretards->removeElement($motifretard);
    }

    /**
     * Get motifretards.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMotifretards()
    {
        return $this->motifretards;
    }

    /**
     * Set retard.
     *
     * @param bool|null $retard
     *
     * @return SessionEmargement
     */
    public function setRetard($retard = null)
    {
        $this->retard = $retard;

        return $this;
    }

    /**
     * Get retard.
     *
     * @return bool|null
     */
    public function getRetard()
    {
        return $this->retard;
    }

    /**
     * Set codeemargement.
     *
     * @param string|null $codeemargement
     *
     * @return SessionEmargement
     */
    public function setCodeemargement($codeemargement = null)
    {
        $this->codeemargement = $codeemargement;

        return $this;
    }

    /**
     * Get codeemargement.
     *
     * @return string|null
     */
    public function getCodeemargement()
    {
        return $this->codeemargement;
    }

    /**
     * Set tpsretardminutes.
     *
     * @param string $tpsretardminutes
     *
     * @return SessionEmargement
     */
    public function setTpsretardminutes($tpsretardminutes)
    {
        $this->tpsretardminutes = $tpsretardminutes;

        return $this;
    }

    /**
     * Get tpsretardminutes.
     *
     * @return string
     */
    public function getTpsretardminutes()
    {
        return $this->tpsretardminutes;
    }

    /**
     * Set motifabsencecentre.
     *
     * @param \App\Entity\Masterlistelg|null $motifabsencecentre
     *
     * @return SessionEmargement
     */
    public function setMotifabsencecentre(\App\Entity\Masterlistelg $motifabsencecentre = null)
    {
        $this->motifabsencecentre = $motifabsencecentre;

        return $this;
    }

    /**
     * Get motifabsencecentre.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getMotifabsencecentre()
    {
        return $this->motifabsencecentre;
    }

    /**
     * Set motifretardcentre.
     *
     * @param \App\Entity\Masterlistelg|null $motifretardcentre
     *
     * @return SessionEmargement
     */
    public function setMotifretardcentre(\App\Entity\Masterlistelg $motifretardcentre = null)
    {
        $this->motifretardcentre = $motifretardcentre;

        return $this;
    }

    /**
     * Get motifretardcentre.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getMotifretardcentre()
    {
        return $this->motifretardcentre;
    }

    /**
     * Set duree.
     *
     * @param string|null $duree
     *
     * @return SessionEmargement
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
