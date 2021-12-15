<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * TarifVenteParcours
 *
 * @ORM\Table(name="TarifVenteParcours")
 * @ORM\Entity(repositoryClass="App\Repository\TarifVenteParcoursRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class TarifVenteParcours
{

    public function __construct() {
		$this->archive = false;
		$this->forfaitmodules = false;
		$this->forfaitaccompagnements = false;
		$this->forfaitstages = false;
		$this->forfaitelearning = false;
		$this->forfaitvalidation = false;
		$this->estbondecommande = true;
		$this->fraisdossier=0;
		$this->fraiskit=0;
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
    * @ORM\ManyToOne(targetEntity="App\Entity\Parcours", inversedBy="tarifventes", cascade={"persist"})
    */
    private $parcours;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $estbondecommande;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\OffreFormation")
    */
    private $offreformation;

    /**
    * @ORM\OneToOne(targetEntity="App\Entity\BondecommandeParcours", inversedBy="tarifvente", cascade={"all"})
    */
    private $bdcparcours;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Profil")
     */
    private $profil;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
     */
    private $dispositif;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $forfaitmodules;

    /**
	* @Assert\Regex("/\d+(\.\d+)?/")
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $tarifmodules;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $montanttotmodules;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $forfaitaccompagnements;

    /**
	* @Assert\Regex("/\d+(\.\d+)?/")
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $tarifaccompagnements;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $montanttotaccompagnements;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $forfaitstages;

    /**
	* @Assert\Regex("/\d+(\.\d+)?/")
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $tarifstages;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $montanttotstages;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $forfaitelearning;

    /**
	* @Assert\Regex("/\d+(\.\d+)?/")
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $tarifelearning;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $montanttotelearning;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $forfaitvalidation;

    /**
	* @Assert\Regex("/\d+(\.\d+)?/")
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $tarifvalidation;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $montanttotvalidation;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $tarifht;

    /**
     *
    * @ORM\ManyToOne(targetEntity="App\Entity\CodeTva")
     */
    private $codetva;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
    */
    private $tauxtva;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
    */
    private $montanttva;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $tarifttc;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $fraisdossier;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $fraiskit;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Set forfaitmodules
     *
     * @param boolean $forfaitmodules
     *
     * @return TarifVenteParcours
     */
    public function setForfaitmodules($forfaitmodules)
    {
        $this->forfaitmodules = $forfaitmodules;

        return $this;
    }

    /**
     * Get forfaitmodules
     *
     * @return boolean
     */
    public function getForfaitmodules()
    {
        return $this->forfaitmodules;
    }

    /**
     * Set tarifmodules
     *
     * @param string $tarifmodules
     *
     * @return TarifVenteParcours
     */
    public function setTarifmodules($tarifmodules)
    {
        $this->tarifmodules = $tarifmodules;

        return $this;
    }

    /**
     * Get tarifmodules
     *
     * @return string
     */
    public function getTarifmodules()
    {
        return $this->tarifmodules;
    }

    /**
     * Set montanttotmodules
     *
     * @param string $montanttotmodules
     *
     * @return TarifVenteParcours
     */
    public function setMontanttotmodules($montanttotmodules)
    {
        $this->montanttotmodules = $montanttotmodules;

        return $this;
    }

    /**
     * Get montanttotmodules
     *
     * @return string
     */
    public function getMontanttotmodules()
    {
        return $this->montanttotmodules;
    }

    /**
     * Set forfaitaccompagnements
     *
     * @param boolean $forfaitaccompagnements
     *
     * @return TarifVenteParcours
     */
    public function setForfaitaccompagnements($forfaitaccompagnements)
    {
        $this->forfaitaccompagnements = $forfaitaccompagnements;

        return $this;
    }

    /**
     * Get forfaitaccompagnements
     *
     * @return boolean
     */
    public function getForfaitaccompagnements()
    {
        return $this->forfaitaccompagnements;
    }

    /**
     * Set tarifaccompagnements
     *
     * @param string $tarifaccompagnements
     *
     * @return TarifVenteParcours
     */
    public function setTarifaccompagnements($tarifaccompagnements)
    {
        $this->tarifaccompagnements = $tarifaccompagnements;

        return $this;
    }

    /**
     * Get tarifaccompagnements
     *
     * @return string
     */
    public function getTarifaccompagnements()
    {
        return $this->tarifaccompagnements;
    }

    /**
     * Set montanttotaccompagnements
     *
     * @param string $montanttotaccompagnements
     *
     * @return TarifVenteParcours
     */
    public function setMontanttotaccompagnements($montanttotaccompagnements)
    {
        $this->montanttotaccompagnements = $montanttotaccompagnements;

        return $this;
    }

    /**
     * Get montanttotaccompagnements
     *
     * @return string
     */
    public function getMontanttotaccompagnements()
    {
        return $this->montanttotaccompagnements;
    }

    /**
     * Set forfaitstages
     *
     * @param boolean $forfaitstages
     *
     * @return TarifVenteParcours
     */
    public function setForfaitstages($forfaitstages)
    {
        $this->forfaitstages = $forfaitstages;

        return $this;
    }

    /**
     * Get forfaitstages
     *
     * @return boolean
     */
    public function getForfaitstages()
    {
        return $this->forfaitstages;
    }

    /**
     * Set tarifstages
     *
     * @param string $tarifstages
     *
     * @return TarifVenteParcours
     */
    public function setTarifstages($tarifstages)
    {
        $this->tarifstages = $tarifstages;

        return $this;
    }

    /**
     * Get tarifstages
     *
     * @return string
     */
    public function getTarifstages()
    {
        return $this->tarifstages;
    }

    /**
     * Set montanttotstages
     *
     * @param string $montanttotstages
     *
     * @return TarifVenteParcours
     */
    public function setMontanttotstages($montanttotstages)
    {
        $this->montanttotstages = $montanttotstages;

        return $this;
    }

    /**
     * Get montanttotstages
     *
     * @return string
     */
    public function getMontanttotstages()
    {
        return $this->montanttotstages;
    }

    /**
     * Set tarifht
     *
     * @param string $tarifht
     *
     * @return TarifVenteParcours
     */
    public function setTarifht($tarifht)
    {
        $this->tarifht = $tarifht;

        return $this;
    }

    /**
     * Get tarifht
     *
     * @return string
     */
    public function getTarifht()
    {
        return $this->tarifht;
    }

    /**
     * Set tauxtva
     *
     * @param string $tauxtva
     *
     * @return TarifVenteParcours
     */
    public function setTauxtva($tauxtva)
    {
        $this->tauxtva = $tauxtva;

        return $this;
    }

    /**
     * Get tauxtva
     *
     * @return string
     */
    public function getTauxtva()
    {
        return $this->tauxtva;
    }

    /**
     * Set montanttva
     *
     * @param string $montanttva
     *
     * @return TarifVenteParcours
     */
    public function setMontanttva($montanttva)
    {
        $this->montanttva = $montanttva;

        return $this;
    }

    /**
     * Get montanttva
     *
     * @return string
     */
    public function getMontanttva()
    {
        return $this->montanttva;
    }

    /**
     * Set tarifttc
     *
     * @param string $tarifttc
     *
     * @return TarifVenteParcours
     */
    public function setTarifttc($tarifttc)
    {
        $this->tarifttc = $tarifttc;

        return $this;
    }

    /**
     * Get tarifttc
     *
     * @return string
     */
    public function getTarifttc()
    {
        return $this->tarifttc;
    }

    /**
     * Set datedebut
     *
     * @param \DateTime $datedebut
     *
     * @return TarifVenteParcours
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
     * @return TarifVenteParcours
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
     * Set archive
     *
     * @param boolean $archive
     *
     * @return TarifVenteParcours
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
     * @return TarifVenteParcours
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
     * @return TarifVenteParcours
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
     * Set parcours
     *
     * @param \App\Entity\Parcours $parcours
     *
     * @return TarifVenteParcours
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
     * Set codetva
     *
     * @param \App\Entity\CodeTva $codetva
     *
     * @return TarifVenteParcours
     */
    public function setCodetva(\App\Entity\CodeTva $codetva = null)
    {
        $this->codetva = $codetva;

        return $this;
    }

    /**
     * Get codetva
     *
     * @return \App\Entity\CodeTva
     */
    public function getCodetva()
    {
        return $this->codetva;
    }

    /**
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return TarifVenteParcours
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
     * @return TarifVenteParcours
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
     * Set forfaitelearning
     *
     * @param boolean $forfaitelearning
     *
     * @return TarifVenteParcours
     */
    public function setForfaitelearning($forfaitelearning)
    {
        $this->forfaitelearning = $forfaitelearning;

        return $this;
    }

    /**
     * Get forfaitelearning
     *
     * @return boolean
     */
    public function getForfaitelearning()
    {
        return $this->forfaitelearning;
    }

    /**
     * Set tarifelearning
     *
     * @param string $tarifelearning
     *
     * @return TarifVenteParcours
     */
    public function setTarifelearning($tarifelearning)
    {
        $this->tarifelearning = $tarifelearning;

        return $this;
    }

    /**
     * Get tarifelearning
     *
     * @return string
     */
    public function getTarifelearning()
    {
        return $this->tarifelearning;
    }

    /**
     * Set montanttotelearning
     *
     * @param string $montanttotelearning
     *
     * @return TarifVenteParcours
     */
    public function setMontanttotelearning($montanttotelearning)
    {
        $this->montanttotelearning = $montanttotelearning;

        return $this;
    }

    /**
     * Get montanttotelearning
     *
     * @return string
     */
    public function getMontanttotelearning()
    {
        return $this->montanttotelearning;
    }

    /**
     * Set offreformation
     *
     * @param \App\Entity\OffreFormation $offreformation
     *
     * @return TarifVenteParcours
     */
    public function setOffreformation(\App\Entity\OffreFormation $offreformation = null)
    {
        $this->offreformation = $offreformation;

        return $this;
    }

    /**
     * Get offreformation
     *
     * @return \App\Entity\OffreFormation
     */
    public function getOffreformation()
    {
        return $this->offreformation;
    }

	public function setAllTarifs()
	{
		
		$this->setTarifmodules((!is_null($this->getTarifmodules())) ? $this->getTarifmodules() : 0);
		$this->setTarifstages((!is_null($this->getTarifstages())) ? $this->getTarifstages() : 0);
		$this->setTarifaccompagnements((!is_null($this->getTarifaccompagnements())) ? $this->getTarifaccompagnements() : 0);
		$this->setTarifelearning((!is_null($this->getTarifelearning())) ? $this->getTarifelearning() : 0);
		$this->setTarifvalidation((!is_null($this->getTarifvalidation())) ? $this->getTarifvalidation() : 0);

		if($this->getForfaitmodules()==true){
			$this->setMontanttotmodules($this->getTarifmodules());
		}else{
			$this->setMontanttotmodules($this->getTarifmodules()*$this->getParcours()->getDureeCenter());
		}
		if($this->getForfaitaccompagnements()==true){
			$this->setMontanttotaccompagnements($this->getTarifaccompagnements());
		}else{
			// il n'y a pas de durée d'accompagnement dans parcours...
		//	$this->setMontanttotaccompagnements(0);
        // ben si !
			$this->setMontanttotaccompagnements($this->getTarifaccompagnements()*$this->getParcours()->getDureeAccompagnement());
		}
		if($this->getForfaitstages()==true){
			$this->setMontanttotstages($this->getTarifstages());
		}else{
			$this->setMontanttotstages($this->getTarifstages()*$this->getParcours()->getDureeStage());
		}
		if($this->getForfaitelearning()==true){
			$this->setMontanttotelearning($this->getTarifelearning());
		}else{
			$this->setMontanttotelearning($this->getTarifelearning()*$this->getParcours()->getDureeElearning());
		}
		if($this->getForfaitvalidation()==true){
			$this->setMontanttotvalidation($this->getTarifvalidation());
		}else{
//			$this->setMontanttotvalidation($this->getTarifvalidation()*$this->getParcours()->getDureeValidation());
			$this->setMontanttotvalidation(0);
		}

		$this->setTarifht($this->getMontanttotmodules()+$this->getMontanttotaccompagnements()+$this->getMontanttotstages()+$this->getMontanttotelearning()+$this->getMontanttotvalidation());
		$this->setMontanttva(round($this->getTarifht()*($this->getTauxtva()/100)),2);
		$this->setTarifttc($this->getTarifht()+$this->getMontanttva());

	}


    /**
     * Set profil
     *
     * @param \App\Entity\Profil $profil
     *
     * @return TarifVenteParcours
     */
    public function setProfil(\App\Entity\Profil $profil = null)
    {
        $this->profil = $profil;

        return $this;
    }

    /**
     * Get profil
     *
     * @return \App\Entity\Profil
     */
    public function getProfil()
    {
        return $this->profil;
    }

    /**
     * Set dispositif
     *
     * @param \App\Entity\Masterlistelg $dispositif
     *
     * @return TarifVenteParcours
     */
    public function setDispositif(\App\Entity\Masterlistelg $dispositif = null)
    {
        $this->dispositif = $dispositif;

        return $this;
    }

    /**
     * Get dispositif
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getDispositif()
    {
        return $this->dispositif;
    }

    /**
     * Set estbondecommande
     *
     * @param boolean $estbondecommande
     *
     * @return TarifVenteParcours
     */
    public function setEstbondecommande($estbondecommande)
    {
        $this->estbondecommande = $estbondecommande;

        return $this;
    }

    /**
     * Get estbondecommande
     *
     * @return boolean
     */
    public function getEstbondecommande()
    {
        return $this->estbondecommande;
    }


    /**
     * Set bdcparcours
     *
     * @param \App\Entity\BondecommandeParcours $bdcparcours
     *
     * @return TarifVenteParcours
     */
    public function setBdcparcours(\App\Entity\BondecommandeParcours $bdcparcours = null)
    {
        $this->bdcparcours = $bdcparcours;

        return $this;
    }

    /**
     * Get bdcparcours
     *
     * @return \App\Entity\BondecommandeParcours
     */
    public function getBdcparcours()
    {
        return $this->bdcparcours;
    }

    /**
     * Set forfaitvalidation
     *
     * @param boolean $forfaitvalidation
     *
     * @return TarifVenteParcours
     */
    public function setForfaitvalidation($forfaitvalidation)
    {
        $this->forfaitvalidation = $forfaitvalidation;

        return $this;
    }

    /**
     * Get forfaitvalidation
     *
     * @return boolean
     */
    public function getForfaitvalidation()
    {
        return $this->forfaitvalidation;
    }

    /**
     * Set tarifvalidation
     *
     * @param string $tarifvalidation
     *
     * @return TarifVenteParcours
     */
    public function setTarifvalidation($tarifvalidation)
    {
        $this->tarifvalidation = $tarifvalidation;

        return $this;
    }

    /**
     * Get tarifvalidation
     *
     * @return string
     */
    public function getTarifvalidation()
    {
        return $this->tarifvalidation;
    }

    /**
     * Set montanttotvalidation
     *
     * @param string $montanttotvalidation
     *
     * @return TarifVenteParcours
     */
    public function setMontanttotvalidation($montanttotvalidation)
    {
        $this->montanttotvalidation = $montanttotvalidation;

        return $this;
    }

    /**
     * Get montanttotvalidation
     *
     * @return string
     */
    public function getMontanttotvalidation()
    {
        return $this->montanttotvalidation;
    }

    /**
     * Set fraisdossier
     *
     * @param string $fraisdossier
     *
     * @return TarifVenteParcours
     */
    public function setFraisdossier($fraisdossier)
    {
        $this->fraisdossier = $fraisdossier;

        return $this;
    }

    /**
     * Get fraisdossier
     *
     * @return string
     */
    public function getFraisdossier()
    {
        return $this->fraisdossier;
    }

    /**
     * Set fraiskit
     *
     * @param string $fraiskit
     *
     * @return TarifVenteParcours
     */
    public function setFraiskit($fraiskit)
    {
        $this->fraiskit = $fraiskit;

        return $this;
    }

    /**
     * Get fraiskit
     *
     * @return string
     */
    public function getFraiskit()
    {
        return $this->fraiskit;
    }
}
