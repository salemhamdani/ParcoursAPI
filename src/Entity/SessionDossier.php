<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * SessionDossier
 *
 * @ORM\Table(name="sessions_dossiers")
 * @ORM\Entity(repositoryClass="App\Repository\SessionDossierRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class SessionDossier
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sessioncertifications = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sessionparcoursstages = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sessionparcoursbloccompetences = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sessionmoduleparcours = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sessionjurys = new \Doctrine\Common\Collections\ArrayCollection();
        $this->justificatifs = new \Doctrine\Common\Collections\ArrayCollection();
		$this->archive = false;

		$this->dureeplanifiee = 0;
		$this->dureecentre=0;
		$this->dureecentrewithacc=0;
		$this->dureestage=0;
		$this->dureeaccompagnement=0;
		$this->nbjourssession=0;
		$this->nbjoursinterruption=0;
		$this->dureemoysemaine=0;
		$this->dureeeffective=0;
		$this->nbsemaineseffectives=0;
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
	* @ORM\ManyToMany(targetEntity="App\Entity\SessionCertification", mappedBy="sessiondossiers", cascade={"persist"})
	*/
	private $sessioncertifications;

	/**
	* @ORM\OneToOne(targetEntity="App\Entity\Dossier", inversedBy="sessiondossier")
     */
    private $dossier;
	
	/**
	* @ORM\OneToMany(targetEntity="App\Entity\SessionParcoursStage", mappedBy="sessiondossier", orphanRemoval=true, cascade={"all"})
	*/
	private $sessionparcoursstages;

	/**
	* @ORM\OneToMany(targetEntity="App\Entity\SessionParcoursBlocCompetence", mappedBy="sessiondossier", cascade={"persist"})
	*/
	private $sessionparcoursbloccompetences;

	/**
	* @ORM\OneToMany(targetEntity="App\Entity\SessionModuleParcours", mappedBy="sessiondossier", orphanRemoval=true, cascade={"all"})
	*/
	private $sessionmoduleparcours;

	/**
	* @ORM\OneToMany(targetEntity="App\Entity\SessionEmargementJustificatif", mappedBy="sessiondossier", orphanRemoval=true, cascade={"all"})
	*/
	private $justificatifs;

	/**
	* @ORM\ManyToMany(targetEntity="App\Entity\SessionJury", inversedBy="sessiondossiers", cascade={"persist"})
	*/
	private $sessionjurys;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Session", inversedBy="sessiondossiers", cascade={"persist"})
	*/
	private $session;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $dureeplanifiee;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $dureecentre;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $dureecentrewithacc;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $dureestage;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $dureeaccompagnement;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbjourssession;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbjoursinterruption;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $dureeeffective;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $dureemoysemaine;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $nbsemaineseffectives;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sessiondokelio;

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
     * Add sessionparcoursstage
     *
     * @param \App\Entity\SessionParcoursStage $sessionparcoursstage
     *
     * @return SessionDossier
     */
    public function addSessionparcoursstage(\App\Entity\SessionParcoursStage $sessionparcoursstage)
    {
        $this->sessionparcoursstages[] = $sessionparcoursstage;
		$sessionparcoursstage->setSessiondossier($this);
        return $this;
    }

    /**
     * Remove sessionparcoursstage
     *
     * @param \App\Entity\SessionParcoursStage $sessionparcoursstage
     */
    public function removeSessionparcoursstage(\App\Entity\SessionParcoursStage $sessionparcoursstage)
    {
        $this->sessionparcoursstages->removeElement($sessionparcoursstage);
    }

    /**
     * Get sessionparcoursstages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSessionparcoursstages()
    {
        return $this->sessionparcoursstages;
    }


    /**
     * Get sessionparcoursstage
     *
     */
    public function getSessionparcoursstage()
    {
        foreach($this->sessionparcoursstages as $sessionparcoursstage)
        return $sessionparcoursstage;
        return null;
    }

    /**
     * Add sessionparcoursbloccompetence
     *
     * @param \App\Entity\SessionParcoursBlocCompetence $sessionparcoursbloccompetence
     *
     * @return SessionDossier
     */
    public function addSessionparcoursbloccompetence(\App\Entity\SessionParcoursBlocCompetence $sessionparcoursbloccompetence)
    {
        $this->sessionparcoursbloccompetences[] = $sessionparcoursbloccompetence;

        return $this;
    }

    /**
     * Remove sessionparcoursbloccompetence
     *
     * @param \App\Entity\SessionParcoursBlocCompetence $sessionparcoursbloccompetence
     */
    public function removeSessionparcoursbloccompetence(\App\Entity\SessionParcoursBlocCompetence $sessionparcoursbloccompetence)
    {
        $this->sessionparcoursbloccompetences->removeElement($sessionparcoursbloccompetence);
    }

    /**
     * Get sessionparcoursbloccompetences
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSessionparcoursbloccompetences()
    {
        return $this->sessionparcoursbloccompetences;
    }

    /**
     * Add sessionmoduleparcour
     *
     * @param \App\Entity\SessionModuleParcours $sessionmoduleparcour
     *
     * @return SessionDossier
     */
    public function addSessionmoduleparcour(\App\Entity\SessionModuleParcours $sessionmoduleparcour)
    {
        $this->sessionmoduleparcours[] = $sessionmoduleparcour;
		$sessionmoduleparcour->setSessiondossier($this);
        return $this;
    }

    /**
     * Remove sessionmoduleparcour
     *
     * @param \App\Entity\SessionModuleParcours $sessionmoduleparcour
     */
    public function removeSessionmoduleparcour(\App\Entity\SessionModuleParcours $sessionmoduleparcour)
    {
        $this->sessionmoduleparcours->removeElement($sessionmoduleparcour);
    }

    /**
     * Get sessionmoduleparcours
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSessionmoduleparcours()
    {
        return $this->sessionmoduleparcours;
    }

    /**
     * Add sessionjury
     *
     * @param \App\Entity\SessionJury $sessionjury
     *
     * @return SessionDossier
     */
    public function addSessionjury(\App\Entity\SessionJury $sessionjury)
    {
        $this->sessionjurys[] = $sessionjury;

        return $this;
    }

    /**
     * Remove sessionjury
     *
     * @param \App\Entity\SessionJury $sessionjury
     */
    public function removeSessionjury(\App\Entity\SessionJury $sessionjury)
    {
        $this->sessionjurys->removeElement($sessionjury);
    }

    /**
     * Get sessionjurys
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSessionjurys()
    {
        return $this->sessionjurys;
    }

    /**
     * Set session
     *
     * @param \App\Entity\Session $session
     *
     * @return SessionDossier
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
     * @return SessionDossier
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
     * @return SessionDossier
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
     * @return SessionDossier
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
     * Add sessioncertification
     *
     * @param \App\Entity\SessionCertification $sessioncertification
     *
     * @return SessionDossier
     */
    public function addSessioncertification(\App\Entity\SessionCertification $sessioncertification)
    {
        $this->sessioncertifications[] = $sessioncertification;

        return $this;
    }

    /**
     * Remove sessioncertification
     *
     * @param \App\Entity\SessionCertification $sessioncertification
     */
    public function removeSessioncertification(\App\Entity\SessionCertification $sessioncertification)
    {
        $this->sessioncertifications->removeElement($sessioncertification);
    }

    /**
     * Get sessioncertifications
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSessioncertifications()
    {
        return $this->sessioncertifications;
    }

    /**
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return SessionDossier
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
     * @return SessionDossier
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
     * Set dossier
     *
     * @param \App\Entity\Dossier $dossier
     *
     * @return SessionDossier
     */
    public function setDossier(\App\Entity\Dossier $dossier = null)
    {
        $this->dossier = $dossier;

        return $this;
    }

    /**
     * Get dossier
     *
     * @return \App\Entity\Dossier
     */
    public function getDossier()
    {
        return $this->dossier;
    }

    /**
     * Set dureeplanifiee
     *
     * @param string $dureeplanifiee
     *
     * @return SessionDossier
     */
    public function setDureeplanifiee($dureeplanifiee)
    {
        $this->dureeplanifiee = $dureeplanifiee;

        return $this;
    }

    /**
     * Get dureeplanifiee
     *
     * @return string
     */
    public function getDureeplanifiee()
    {
        return $this->dureeplanifiee;
    }
	
	public function setDureeplanifieeTot()
	{
		$resultat=0;
		foreach($this->getSessionmoduleparcours() as $smp)
		{
			if($smp->getCompteheure()==true){
				if(!is_null($smp->getSessionevenement()->getSessionmodule())){
					$resultat+=$smp->getSessionevenement()->getSessionmodule()->getDuree();
				}else{
					if(!is_null($smp->getSessionevenement()->getSessionaccompagnement())){
						$resultat+=$smp->getSessionevenement()->getSessionaccompagnement()->getDuree();
					}
				}
			}
		}
		$this->dureeplanifiee=$resultat;

		return $this;
	}

    /**
     * Set dureecentre
     *
     * @param string $dureecentre
     *
     * @return SessionDossier
     */
    public function setDureecentre($dureecentre)
    {
        $this->dureecentre = $dureecentre;

        return $this;
    }

    /**
     * Get dureecentre
     *
     * @return string
     */
    public function getDureecentre()
    {
        return $this->dureecentre;
    }

    /**
     * Set dureecentrewithacc
     *
     * @param string $dureecentrewithacc
     *
     * @return SessionDossier
     */
    public function setDureecentrewithacc($dureecentrewithacc)
    {
        $this->dureecentrewithacc = $dureecentrewithacc;

        return $this;
    }

    /**
     * Get dureecentrewithacc
     *
     * @return string
     */
    public function getDureecentrewithacc()
    {
        return $this->dureecentrewithacc;
    }

    /**
     * Set dureestage
     *
     * @param string $dureestage
     *
     * @return SessionDossier
     */
    public function setDureestage($dureestage)
    {
        $this->dureestage = $dureestage;

        return $this;
    }

    /**
     * Get dureestage
     *
     * @return string
     */
    public function getDureestage()
    {
        return $this->dureestage;
    }

    /**
     * Set dureeaccompagnement
     *
     * @param string $dureeaccompagnement
     *
     * @return SessionDossier
     */
    public function setDureeaccompagnement($dureeaccompagnement)
    {
        $this->dureeaccompagnement = $dureeaccompagnement;

        return $this;
    }

    /**
     * Get dureeaccompagnement
     *
     * @return string
     */
    public function getDureeaccompagnement()
    {
        return $this->dureeaccompagnement;
    }

    /**
     * Set nbjourssession
     *
     * @param integer $nbjourssession
     *
     * @return SessionDossier
     */
    public function setNbjourssession($nbjourssession)
    {
        $this->nbjourssession = $nbjourssession;

        return $this;
    }

    /**
     * Get nbjourssession
     *
     * @return integer
     */
    public function getNbjourssession()
    {
        return $this->nbjourssession;
    }

    /**
     * Set nbjoursinterruption
     *
     * @param integer $nbjoursinterruption
     *
     * @return SessionDossier
     */
    public function setNbjoursinterruption($nbjoursinterruption)
    {
        $this->nbjoursinterruption = $nbjoursinterruption;

        return $this;
    }

    /**
     * Get nbjoursinterruption
     *
     * @return integer
     */
    public function getNbjoursinterruption()
    {
        return $this->nbjoursinterruption;
    }

    /**
     * Set dureeeffective
     *
     * @param string $dureeeffective
     *
     * @return SessionDossier
     */
    public function setDureeeffective($dureeeffective)
    {
        $this->dureeeffective = $dureeeffective;

        return $this;
    }

    /**
     * Get dureeeffective
     *
     * @return string
     */
    public function getDureeeffective()
    {
        return $this->dureeeffective;
    }

    /**
     * Set dureemoysemaine
     *
     * @param string $dureemoysemaine
     *
     * @return SessionDossier
     */
    public function setDureemoysemaine($dureemoysemaine)
    {
        $this->dureemoysemaine = $dureemoysemaine;

        return $this;
    }

    /**
     * Get dureemoysemaine
     *
     * @return string
     */
    public function getDureemoysemaine()
    {
        return $this->dureemoysemaine;
    }

    /**
     * Set nbsemaineseffectives
     *
     * @param string $nbsemaineseffectives
     *
     * @return SessionDossier
     */
    public function setNbsemaineseffectives($nbsemaineseffectives)
    {
        $this->nbsemaineseffectives = $nbsemaineseffectives;

        return $this;
    }

    /**
     * Get nbsemaineseffectives
     *
     * @return string
     */
    public function getNbsemaineseffectives()
    {
        return $this->nbsemaineseffectives;
    }

    /**
     * Set datedebut
     *
     * @param \DateTime $datedebut
     *
     * @return SessionDossier
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
     * @return SessionDossier
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
	
	public function getNbJoursTotal()
	{
		if(!is_null($this->getDatedebut()) && !is_null($this->getDatefin())){
			return $this->getDatedebut()->diff($this->getDatefin())->days;
		}
		return 0;
	}

    
    public function getNbHeuresTotal()
    {
        if(!is_null($this->getDatedebut()) && !is_null($this->getDatefin())){
            return $this->getDatedebut()->diff($this->getDatefin())->h;
        }
        return 0;
    }


	public function getNbSemainesTotal()
	{
		return round($this->getNbJoursTotal()/7,1);
	}


    /**
     * Set sessiondokelio
     *
     * @param string $sessiondokelio
     *
     * @return SessionDossier
     */
    public function setSessiondokelio($sessiondokelio)
    {
        $this->sessiondokelio = $sessiondokelio;

        return $this;
    }

    /**
     * Get sessiondokelio
     *
     * @return string
     */
    public function getSessiondokelio()
    {
        return $this->sessiondokelio;
    }
	
	public function getFirstMoisFormation()
	{
		if(!is_null($this->getDossier()->getDatedebutcalendrier())){
			$madate=clone $this->getDossier()->getDatedebutcalendrier();
			$madate->modify('First day of this month');
			$madate->setTime(0,0);
			return $madate;
		}
		return null;
		
	}
	public function getLastMoisFormation()
	{
		if(!is_null($this->getDossier()->getDatefincalendrier())){
			$madate=clone $this->getDossier()->getDatefincalendrier();
			$madate->modify('First day of this month');
			$madate->setTime(0,0);
			return $madate;
		}
		return null;
	}
	
	public function getAllMoisFormation()
	{
		$resultat=[];
		if(!is_null($this->getFirstMoisFormation()) && !is_null($this->getLastMoisFormation())){
			$madatedebut=clone $this->getFirstMoisFormation();
			$madatefin=clone $this->getLastMoisFormation();
//			$interval = new \DateInterval('P1M');
			if($madatefin>=$madatedebut){
				$moiscourant=clone $this->getFirstMoisFormation();
				while($moiscourant<=$madatefin)
				{
					$monmois=clone $moiscourant;
					$resultat[]=$monmois;
					$moiscourant->modify('first day of next month');
				}
			}
		}
		return $resultat;
	}


    /**
     * Add justificatif
     *
     * @param \App\Entity\SessionEmargementJustificatif $justificatif
     *
     * @return SessionDossier
     */
    public function addJustificatif(\App\Entity\SessionEmargementJustificatif $justificatif)
    {
        $this->justificatifs[] = $justificatif;
		$justificatif->setSessiondossier($this);
        return $this;
    }

    /**
     * Remove justificatif
     *
     * @param \App\Entity\SessionEmargementJustificatif $justificatif
     */
    public function removeJustificatif(\App\Entity\SessionEmargementJustificatif $justificatif)
    {
        $this->justificatifs->removeElement($justificatif);
    }

    /**
     * Get justificatifs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getJustificatifs()
    {
        return $this->justificatifs;
    }

	public function getRemiseaniveau()
	{
		$resultat=0;
        foreach($this->getSessionmoduleparcours() as $smp){
            if(!is_null($smp->getSessionevenement())){
				if(!is_null($smp->getSessionevenement()->getSessionmodule())){
					if(!is_null($smp->getSessionevenement()->getSessionmodule()->getModule())){
						if(!is_null($smp->getSessionevenement()->getSessionmodule()->getModule()->getNiveautechnique())){
							if($smp->getSessionevenement()->getSessionmodule()->getModule()->getNiveautechnique()->getCode()=='REMISEANIVEAU'){
								$resultat+=$smp->getSessionevenement()->getSessionModule()->getDuree();
							}
						}
					}
                }
            }
        }
		return $resultat;
	}

	public function getSoutien()
	{
		$resultat=0;
        foreach($this->getSessionmoduleparcours() as $smp){
            if(!is_null($smp->getSessionevenement())){
				if(!is_null($smp->getSessionevenement()->getSessionAccompagnement())){
					if(!is_null($smp->getSessionevenement()->getSessionAccompagnement()->getTypeaccompagnement())){
						if($smp->getSessionevenement()->getSessionAccompagnement()->getTypeaccompagnement()->getCode()=='SOUTIEN'){
							$resultat+=$smp->getSessionevenement()->getSessionAccompagnement()->getDuree();
						}
					}
				}
			}
		}
		return $resultat;
	}

	public function getCoaching()
	{
		$resultat=0;
        foreach($this->getSessionmoduleparcours() as $smp){
            if(!is_null($smp->getSessionevenement())){
				if(!is_null($smp->getSessionevenement()->getSessionAccompagnement())){
					if(!is_null($smp->getSessionevenement()->getSessionAccompagnement()->getTypeaccompagnement())){
						if($smp->getSessionevenement()->getSessionAccompagnement()->getTypeaccompagnement()->getCode()=='COACHING'){
							$resultat+=$smp->getSessionevenement()->getSessionAccompagnement()->getDuree();
						}
					}
				}
			}
		}
		return $resultat;
	}

	public function getTre()
	{
		$resultat=0;
        foreach($this->getSessionmoduleparcours() as $smp){
            if(!is_null($smp->getSessionevenement())){
				if(!is_null($smp->getSessionevenement()->getSessionAccompagnement())){
					if(!is_null($smp->getSessionevenement()->getSessionAccompagnement()->getTypeaccompagnement())){
						if($smp->getSessionevenement()->getSessionAccompagnement()->getTypeaccompagnement()->getCode()=='TRE'){
							$resultat+=$smp->getSessionevenement()->getSessionAccompagnement()->getDuree();
						}
					}
				}
			}
		}
		return $resultat;
	}

}
