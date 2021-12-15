<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SessionModule
 *
 * @ORM\Table(name="session_module")
 * @ORM\Entity(repositoryClass="App\Repository\SessionModuleRepository")
 */
class SessionModule {

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sessionmoduleblocs = new \Doctrine\Common\Collections\ArrayCollection();
		$this->sessionevenements = new \Doctrine\Common\Collections\ArrayCollection();
		$this->sessionevenementperes = new \Doctrine\Common\Collections\ArrayCollection();
		$this->sessionmoduleenchainements = new \Doctrine\Common\Collections\ArrayCollection();

		$this->archive = false;
		$this->publiesite=false;
		$this->duree=0;
		$this->sessionunitaire=false;

    }

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $archive;

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
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**

     * @ORM\Column(type="integer")
     */
    private $duree;

    /**

     * @ORM\ManyToOne(targetEntity="App\Entity\Module", inversedBy="sessionmodules", cascade={"persist"})
     */
    private $module;

	/**
	* @ORM\OneToMany(targetEntity="App\Entity\SessionModuleBloc", mappedBy="sessionmodule", cascade={"persist", "remove"})
	*/
	private $sessionmoduleblocs;

	/**
	* @ORM\OneToMany(targetEntity="App\Entity\SessionModuleEnchainement", mappedBy="sessionmodule", cascade={"persist", "remove"})
	*/
	private $sessionmoduleenchainements;

	/**
    * @ORM\OneToMany(targetEntity="App\Entity\SessionEvenement", mappedBy="sessionmodule", cascade={"persist"})
    */
    private $sessionevenements;

	private $sessionevenementperes;

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
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $intitule;

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
     * Set module
     *
     * @param \App\Entity\Module $module
     *
     * @return SessionModule
     */
    public function setModule(\App\Entity\Module $module = null)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get module
     *
     * @return \App\Entity\Module
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $publiesite;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $sessionunitaire;

    /**
     * Add sessionmodulebloc
     *
     * @param \App\Entity\SessionModuleBloc $sessionmodulebloc
     *
     * @return SessionModule
     */
    public function addSessionmodulebloc(\App\Entity\SessionModuleBloc $sessionmodulebloc)
    {
        $this->sessionmoduleblocs[] = $sessionmodulebloc;
		$sessionmodulebloc->setSessionmodule($this);
        return $this;
    }

    /**
     * Remove sessionmodulebloc
     *
     * @param \App\Entity\SessionModuleBloc $sessionmodulebloc
     */
    public function removeSessionmodulebloc(\App\Entity\SessionModuleBloc $sessionmodulebloc)
    {
        $this->sessionmoduleblocs->removeElement($sessionmodulebloc);
		$sessionmodulebloc->setSessionmodule(null);
    }

    /**
     * Get sessionmoduleblocs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSessionmoduleblocs()
    {
        return $this->sessionmoduleblocs;
    }

    /**
     * Set archive
     *
     * @param boolean $archive
     *
     * @return SessionModule
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
     * @return SessionModule
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
     * @return SessionModule
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
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return SessionModule
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
     * @return SessionModule
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
		return count($this->getSessionmoduleparcours());
	}


    /**
     * Set duree
     *
     * @param integer $duree
     *
     * @return SessionModule
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
     * Add sessionevenement
     *
     * @param \App\Entity\SessionEvenement $sessionevenement
     *
     * @return SessionModule
     */
    public function addSessionevenement(\App\Entity\SessionEvenement $sessionevenement)
    {
        $this->sessionevenements[] = $sessionevenement;
		$sessionevenement->setSessionmodule($this);
        return $this;
    }

    /**
     * Remove sessionevenement
     *
     * @param \App\Entity\SessionEvenement $sessionevenement
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
	
    public function getSessionevenementPeres()
    {
		foreach($this->sessionevenements as $sevent){
			if(!is_null($sevent->getSessionmodule())){
				$this->sessionevenementperes[]=$sevent;
			}
		}
        return $this->sessionevenements;
    }
/*
	public function getDatedebut()
	{
		$resultat=null;
		foreach($this->getSessionevenements() as $sevent)
		{
			$resultat=$sevent->getDatedebut();
		}
		return $resultat;
	}

	public function getDatefin()
	{
		$resultat=null;
		foreach($this->getSessionevenements() as $sevent)
		{
			$resultat=$sevent->getDatefin();
		}
		return $resultat;
	}
*/

    /**
     * Set datedebut
     *
     * @param \DateTime $datedebut
     *
     * @return SessionModule
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
     * @return SessionModule
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
	
	public function getDureeJours()
	{
		if(!is_null($this->duree)){
			return $this->duree/7;
		}else{
			return 0;
		}
	}

    /**
     * Set publiesite
     *
     * @param boolean $publiesite
     *
     * @return SessionModule
     */
    public function setPubliesite($publiesite)
    {
        $this->publiesite = $publiesite;

        return $this;
    }

    /**
     * Get publiesite
     *
     * @return boolean
     */
    public function getPubliesite()
    {
        return $this->publiesite;
    }


    /**
     * Set intitule
     *
     * @param string $intitule
     *
     * @return SessionModule
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

	public function getTarifVente()
	{
		return $this->getModule()->getTarifVenteByDate($this->getDatedebut());
	}

    /**
     * Set sessionunitaire
     *
     * @param boolean $sessionunitaire
     *
     * @return SessionModule
     */
    public function setSessionunitaire($sessionunitaire)
    {
        $this->sessionunitaire = $sessionunitaire;

        return $this;
    }

    /**
     * Get sessionunitaire
     *
     * @return boolean
     */
    public function getSessionunitaire()
    {
        return $this->sessionunitaire;
    }

    /**
     * Add sessionmoduleenchainement
     *
     * @param \App\Entity\SessionModuleEnchainement $sessionmoduleenchainement
     *
     * @return SessionModule
     */
    public function addSessionmoduleenchainement(\App\Entity\SessionModuleEnchainement $sessionmoduleenchainement)
    {
        $this->sessionmoduleenchainements[] = $sessionmoduleenchainement;

        return $this;
    }

    /**
     * Remove sessionmoduleenchainement
     *
     * @param \App\Entity\SessionModuleEnchainement $sessionmoduleenchainement
     */
    public function removeSessionmoduleenchainement(\App\Entity\SessionModuleEnchainement $sessionmoduleenchainement)
    {
        $this->sessionmoduleenchainements->removeElement($sessionmoduleenchainement);
    }

    /**
     * Get sessionmoduleenchainements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSessionmoduleenchainements()
    {
        return $this->sessionmoduleenchainements;
    }
	
	public function getSimulNbApprenants()
	{
		$resultat=0;
		foreach($this->getSessionmoduleblocs() as $smb)
		{
			$resultat+=$smb->getSession()->getSimulnbapprenants();
		}
		return $resultat;
	}
    
    public function getNbApprenants()
    {
        $resultat=0;
        foreach($this->getSessionevenements() as $sessionevenement)
        {
            $resultat+=$sessionevenement->getSession()->getSimulnbapprenants();
        }
        return $resultat;
    }

    public function getNbJoursTotal()
    {   
        if(! is_null($this->duree))
        return round($this->duree/7);
    else return 0;
    }

    public function getNbSemainesTotal()
    {
        return round($this->getNbJoursTotal()/7,1);
    }
}
