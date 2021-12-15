<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * Salle
 *
 * @ORM\Table(name="salles")
 * @ORM\Entity(repositoryClass="App\Repository\SalleRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class Salle
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->vrreunions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sessionsalles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sessions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->fusionnableavec = new \Doctrine\Common\Collections\ArrayCollection();
        $this->fusionnesavecmoi = new \Doctrine\Common\Collections\ArrayCollection();
		$this->archive = false;
		$this->capacite = 0;
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
     * @ORM\Column(name="intitule", type="string", length=255)
     * @Assert\NotBlank(message="Ce champ est obligatoire.")
     */
    private $intitule;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=20,nullable=true)
     */
    private $logocouleur;

    /**
     * @var string
     *
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Range(min=0, invalidMessage="La capacité doit être numérique.")
     * @Assert\NotBlank(message="Ce champ est obligatoire.")
     */
    private $capacite;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Site", inversedBy="salles")
	*/
	private $site;

	/**
	* @ORM\OneToMany(targetEntity="App\Entity\SessionSalle", mappedBy="salle")
	*/
	private $sessionsalles;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\Session", mappedBy="salledefaut")
    */
    private $sessions;

	/**
	* @ORM\OneToMany(targetEntity="App\Entity\VrReunion", mappedBy="salle")
	*/
	private $vrreunions;

    /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg", cascade={"persist"})
     */
    private $niveaumateriel;

	/**
	 * @ORM\ManyToMany(targetEntity="App\Entity\Salle", inversedBy="fusionnesavecmoi")
	 * @ORM\JoinTable(name="salles_fusionnables",
	 *      joinColumns={@ORM\JoinColumn(name="salle1", referencedColumnName="id")},
	 *      inverseJoinColumns={@ORM\JoinColumn(name="salle2", referencedColumnName="id")}
	 *      )
	 **/
	private $fusionnableavec;

	/**
     * @ORM\ManyToMany(targetEntity="App\Entity\Salle", mappedBy="fusionnableavec")
     */
    private $fusionnesavecmoi;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $archive;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\User")
	*/
	private $usertv;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $uservituelid;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sallevirtuelleid;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lienvirtuel;

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
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $reservee;

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
     * Set intitule
     *
     * @param string $intitule
     *
     * @return Salle
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
     * @return Salle
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
     * Set dateinsert
     *
     * @param \DateTime $dateinsert
     *
     * @return Salle
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
     * @return Salle
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
     * Set site
     *
     * @param \App\Entity\Site $site
     *
     * @return Salle
     */
    public function setSite(\App\Entity\Site $site = null)
    {
        $this->site = $site;

        return $this;
    }

    /**
     * Get site
     *
     * @return \App\Entity\Site
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * Add sessionsalle
     *
     * @param \App\Entity\SessionSalle $sessionsalle
     *
     * @return Salle
     */
    public function addSessionsalle(\App\Entity\SessionSalle $sessionsalle)
    {
        $this->sessionsalles[] = $sessionsalle;
		$sessionsalle->setSalle($this);
        return $this;
    }

    /**
     * Remove sessionsalle
     *
     * @param \App\Entity\SessionSalle $sessionsalle
     */
    public function removeSessionsalle(\App\Entity\SessionSalle $sessionsalle)
    {
        $this->sessionsalles->removeElement($sessionsalle);
    }

    /**
     * Get sessionsalles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSessionsalles()
    {
        return $this->sessionsalles;
    }

    /**
     * Get sessions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSessions()
    {
        return $this->sessions;
    }

    /**
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return Salle
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
     * @return Salle
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
     * Set capacite
     *
     * @param integer $capacite
     *
     * @return Salle
     */
    public function setCapacite($capacite)
    {
        $this->capacite = $capacite;

        return $this;
    }

    /**
     * Get capacite
     *
     * @return integer
     */
    public function getCapacite()
    {
        return $this->capacite;
    }

    /**
     * Set logocouleur
     *
     * @param string $logocouleur
     *
     * @return Salle
     */
    public function setLogocouleur($logocouleur)
    {
        $this->logocouleur = $logocouleur;

        return $this;
    }

    /**
     * Get logocouleur
     *
     * @return string
     */
    public function getLogocouleur()
    {
        return $this->logocouleur;
    }

    /**
     * Add fusionnableavec
     *
     * @param \App\Entity\Salle $fusionnableavec
     *
     * @return Salle
     */
    public function addFusionnableavec(\App\Entity\Salle $fusionnableavec)
    {
        $this->fusionnableavec[] = $fusionnableavec;
//		$fusionnableavec->setFusionn($this);
        return $this;
    }

    /**
     * Remove fusionnableavec
     *
     * @param \App\Entity\Salle $fusionnableavec
     */
    public function removeFusionnableavec(\App\Entity\Salle $fusionnableavec)
    {
        $this->fusionnableavec->removeElement($fusionnableavec);
    }

    /**
     * Get fusionnableavec
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFusionnableavec()
    {
        return $this->fusionnableavec;
    }

    /**
     * Add fusionnesavecmoi
     *
     * @param \App\Entity\Salle $fusionnesavecmoi
     *
     * @return Salle
     */
    public function addFusionnesavecmoi(\App\Entity\Salle $fusionnesavecmoi)
    {
        $this->fusionnesavecmoi[] = $fusionnesavecmoi;

        return $this;
    }

    /**
     * Remove fusionnesavecmoi
     *
     * @param \App\Entity\Salle $fusionnesavecmoi
     */
    public function removeFusionnesavecmoi(\App\Entity\Salle $fusionnesavecmoi)
    {
        $this->fusionnesavecmoi->removeElement($fusionnesavecmoi);
    }

    /**
     * Get fusionnesavecmoi
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFusionnesavecmoi()
    {
        return $this->fusionnesavecmoi;
    }

    /**
     * Set niveaumateriel
     *
     * @param \App\Entity\Masterlistelg $niveaumateriel
     *
     * @return Salle
     */
    public function setNiveaumateriel(\App\Entity\Masterlistelg $niveaumateriel = null)
    {
        $this->niveaumateriel = $niveaumateriel;

        return $this;
    }

    /**
     * Get niveaumateriel
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getNiveaumateriel()
    {
        return $this->niveaumateriel;
    }

    /**
     * Set usertv
     *
     * @param \App\Entity\User $usertv
     *
     * @return Salle
     */
    public function setUsertv(\App\Entity\User $usertv = null)
    {
        $this->usertv = $usertv;

        return $this;
    }

    /**
     * Get usertv
     *
     * @return \App\Entity\User
     */
    public function getUsertv()
    {
        return $this->usertv;
    }


    /**
     * Set uservituelid.
     *
     * @param string|null $uservituelid
     *
     * @return Salle
     */
    public function setUservituelid($uservituelid = null)
    {
        $this->uservituelid = $uservituelid;

        return $this;
    }

    /**
     * Get uservituelid.
     *
     * @return string|null
     */
    public function getUservituelid()
    {
        return $this->uservituelid;
    }

    /**
     * Set sallevirtuelleid.
     *
     * @param string|null $sallevirtuelleid
     *
     * @return Salle
     */
    public function setSallevirtuelleid($sallevirtuelleid = null)
    {
        $this->sallevirtuelleid = $sallevirtuelleid;

        return $this;
    }

    /**
     * Get sallevirtuelleid.
     *
     * @return string|null
     */
    public function getSallevirtuelleid()
    {
        return $this->sallevirtuelleid;
    }

    /**
     * Add vrreunion.
     *
     * @param \App\Entity\VrReunion $vrreunion
     *
     * @return Salle
     */
    public function addVrreunion(\App\Entity\VrReunion $vrreunion)
    {
        $this->vrreunions[] = $vrreunion;

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
	
	public function getFullIntitule()
	{
		return $this->getSite()->getIntitule().' '.$this->getIntitule();
	}

    /**
     * Set lienvirtuel.
     *
     * @param string|null $lienvirtuel
     *
     * @return Salle
     */
    public function setLienvirtuel($lienvirtuel = null)
    {
        $this->lienvirtuel = $lienvirtuel;

        return $this;
    }

    /**
     * Get lienvirtuel.
     *
     * @return string|null
     */
    public function getLienvirtuel()
    {
        return $this->lienvirtuel;
    }

    public function getLieu()
    {   
        if(! is_null($this->lienvirtuel))
        return $this->intitule.' '.$this->lienvirtuel;
        else  return $this->intitule.' '.$this->getSite()->getFullAdresse();
    }
 

     /**
     * Set reservee
     *
     * @param boolean $archive
     *
     * @return Salle
     */
    public function setReservee($val = false)
    {
        $this->reservee = $val;

        return $this;
    }

    /**
     * Get reservee
     *
     * @return boolean
     */
    public function getReservee()
    {
        return $this->reservee;
    }



    public function isLibre($datedebut,$datefin){ // sessionsalle
            $libre=true;
            $datedebut=$datedebut->format('Y-m-d');
            $datefin=$datefin->format('Y-m-d');
            foreach ($this->sessionsalles as $session) {
                $datedebutsession= $session->getSessionevenement()->getDatedebut()->format('Y-m-d');
                $datefinsession= $session->getSessionevenement()->getDatefin()->format('Y-m-d');
                if( ! is_null($datedebut) and ! is_null($datefin) ){
        if($datedebut >= $datedebutsession and $datedebut <= $datefinsession)$libre=false;
        if($datefin >= $datedebutsession and $datefin <= $datefinsession)$libre=false;

        if($datedebut <= $datedebutsession and $datefin >= $datefinsession)$libre=false;
                }
            }
            return $libre;



    }

    public function islibreSession($datedebut,$datefin,$currentsession){ //salle par default
            $libre=true;
            foreach ($this->sessions as $session) // sessions
            if($currentsession != $session->getId()) {
                $datedebutsession= $session->getDatedebut();
                $datefinsession= $session->getDatefin();
                if( ! is_null($datedebut) and ! is_null($datefin) ){
if($datedebut >= $datedebutsession and $datedebut <= $datefinsession)$libre=false;
if($datefin >= $datedebutsession and $datefin <= $datefinsession)$libre=false;

if($datedebut <= $datedebutsession and $datefin >= $datefinsession)$libre=false;

                }
            }
            return $libre;
    }
    
}

