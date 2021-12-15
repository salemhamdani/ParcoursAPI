<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * Session
 *
 * @ORM\Table(name="sessions")
 * @ORM\Entity(repositoryClass="App\Repository\SessionRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class Session
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sessiondossiers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->evenements = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sessioncertifications = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sessionmoduleblocs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sessionstages = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sessionaccompagnementsessions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sessionperiodes = new \Doctrine\Common\Collections\ArrayCollection();
		$this->bdcparcours = new \Doctrine\Common\Collections\ArrayCollection();
		$this->sessionmoduleenchainements = new \Doctrine\Common\Collections\ArrayCollection();
        
        $this->duree=0;
        $this->dureemodules=0;
        $this->dureecentre=0;
        $this->dureecentrewithacc=0;
        $this->dureestage=0;
        $this->dureeaccompagnement=0;
        $this->nbjourssession=0;
        $this->nbjoursinterruption=0;
        $this->dureemoysemaine=0;
        $this->dureeeffective=0;
        $this->nbsemaineseffectives=0;
		$this->simulnbapprenants=0;
        $this->archive=false;
        $this->publiesite=false;
		$this->dateslarges=false;

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
     * @ORM\Column(type="boolean",nullable=true)
     */
    private $sitepartenaire;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Partenaire")
	*/
	private $partenaire;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Salle", inversedBy="sessions")
	*/
	private $salledefaut;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Adresse")
	*/
	private $adressepartenaire;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Site")
	*/
	private $site;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $intitule;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $numeroSession;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean",nullable=true)
     */
    private $dateslarges;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $statut;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $duree;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $dureecentre;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $dureemodules;

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
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $simulnbapprenants;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\SessionModuleEnchainement", mappedBy="session", cascade={"persist"})
    */
    private $sessionmoduleenchainements;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\SessionDossier", mappedBy="session", cascade={"persist"})
    */
    private $sessiondossiers;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\Evenement", mappedBy="session", cascade={"persist"})
    */
    private $evenements;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\SessionStage", mappedBy="session", orphanRemoval=true, cascade={"persist"})
    */
    private $sessionstages;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\SessionAccompagnementSession", mappedBy="session", cascade={"persist"})
    */
    private $sessionaccompagnementsessions;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\SessionCertification", mappedBy="session", cascade={"persist"})
    */
    private $sessioncertifications;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Parcours", inversedBy="sessions", cascade={"persist"})
    */
    private $parcours;
	
	/**
     * @ORM\ManyToMany(targetEntity="App\Entity\BondecommandeParcours", mappedBy="sessions")
     */
	private $bdcparcours;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Enchainement")
    */
    private $enchainement;

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
     * @var \DateTime
     *
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $datedebutaffichage;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $datefinaffichage;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $jurydatedebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $jurydatefin;

    /**
    * @ORM\OneToOne(targetEntity="App\Entity\SessionJury")
    */
    private $sessionjury;

    /**
     * @var int
     *
     * @ORM\Column(type="integer",nullable=true)
     */
    private $juryduree;

    /**

     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $archive;
    
    /**

     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $publiesite;

      /**
     * --@var \stdClass
     *
     * --@ORM\ManyToOne(targetEntity="App\Entity\Module", cascade={"persist"})
     * --@ORM\JoinColumn(name="module", nullable=true)
     */
   /* private $module; */
    

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=65, nullable=true)
     */
    private $type;
    

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\SessionModuleBloc", mappedBy="session", orphanRemoval=true, cascade={"persist", "remove"})
    */
    private $sessionmoduleblocs;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\SessionPeriode", mappedBy="session", orphanRemoval=true, cascade={"persist", "remove"})
    */
    private $sessionperiodes;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sessiondokelio;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dokelioparcours;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Employe")
    */
    private $referentpedagogique;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Employe")
    */
    private $referentcoach;

     /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Employe")
    */
    private $referentadministratif;

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
     * @return Session
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
     * @return Session
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
     * @return Session
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
     * @return Session
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
     * @return Session
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
     * @return Session
     */
    public function addSessioncertification(\App\Entity\SessionCertification $sessioncertification)
    {
        $this->sessioncertifications[] = $sessioncertification;
        $sessioncertification->setSession($this);

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
     * @return Session
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
     * @return Session
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
     * Set type
     *
     * @param string $type
     *
     * @return Session
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }


    /**
     * Add sessionmodulebloc
     *
     * @param \App\Entity\SessionModuleBloc $sessionmodulebloc
     *
     * @return Session
     */
    public function addSessionmodulebloc(\App\Entity\SessionModuleBloc $sessionmodulebloc)
    {
        $this->sessionmoduleblocs[] = $sessionmodulebloc;
        $sessionmodulebloc->setSession($this);
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
     * Set intitule
     *
     * @param string $intitule
     *
     * @return Session
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
     * Set numeroSession
     *
     * @param string $numeroSession
     *
     * @return Session
     */
    public function setNumeroSession($numeroSession)
    {
        $this->numeroSession = $numeroSession;

        return $this;
    }

    /**
     * Get numeroSession
     *
     * @return string
     */
    public function getNumeroSession()
    {
        return $this->numeroSession;
    }

    /**
     * Set datedebutaffichage
     *
     * @param \DateTime $datedebutaffichage
     *
     * @return Session
     */
    public function setDatedebutaffichage($datedebutaffichage)
    {
        $this->datedebutaffichage = $datedebutaffichage;

        return $this;
    }

    /**
     * Get datedebutaffichage
     *
     * @return \DateTime
     */
    public function getDatedebutaffichage()
    {
        return $this->datedebutaffichage;
    }

    /**
     * Set datefinaffichage
     *
     * @param \DateTime $datefinaffichage
     *
     * @return Session
     */
    public function setDatefinaffichage($datefinaffichage)
    {
        $this->datefinaffichage = $datefinaffichage;

        return $this;
    }

    /**
     * Get datefinaffichage
     *
     * @return \DateTime
     */
    public function getDatefinaffichage()
    {
        return $this->datefinaffichage;
    }

    /**
     * Set statut
     *
     * @param \App\Entity\Masterlistelg $statut
     *
     * @return Session
     */
    public function setStatut(\App\Entity\Masterlistelg $statut = null)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Add sessionstage
     *
     * @param \App\Entity\SessionStage $sessionstage
     *
     * @return Session
     */
    public function addSessionstage(\App\Entity\SessionStage $sessionstage)
    {
        $this->sessionstages[] = $sessionstage;
        $sessionstage->setSession($this);

        return $this;
    }

    /**
     * Remove sessionstage
     *
     * @param \App\Entity\SessionStage $sessionstage
     */
    public function removeSessionstage(\App\Entity\SessionStage $sessionstage)
    {
        $this->sessionstages->removeElement($sessionstage);
    }

    /**
     * Get sessionstages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSessionstages()
    {
        return $this->sessionstages;
    }

    public function setDatedebutTotal()
    {
        $madatedebut=\DateTime::createFromFormat('d/m/Y', '31/12/2030');
        // stages
        foreach($this->getSessionstages() as $stage){
            if(!is_null($stage->getDatedebut())){
                if($stage->getDatedebut()<$madatedebut){
                    $madatedebut=$stage->getDatedebut();
                }
            }
        }
        // accompagnement
        foreach($this->getSessionaccompagnementsessions() as $ligne){
            if(!is_null($ligne->getSessionAccompagnement()->getDatedebut())){
                if($ligne->getSessionAccompagnement()->getDatedebut()<$madatedebut){
                    $madatedebut=$ligne->getSessionAccompagnement()->getDatedebut();
                }
            }
        }
        // modules
        foreach($this->getSessionmoduleblocs() as $modulebloc){
            if(!is_null($modulebloc->getSessionModule())){
                if(!is_null($modulebloc->getSessionModule()->getDatedebut())){
                    if($modulebloc->getSessionModule()->getDatedebut()<$madatedebut){
                        $madatedebut=$modulebloc->getSessionModule()->getDatedebut();
                    }
                }
            }
        }
        if($madatedebut->format('d/m/Y')=='31/12/2030'){
            $madatedebut=$this->getDatedebut();
        }

        $this->setDatedebut($madatedebut);
    }

    public function getDatefinTotale()
    {
        $datefin=$this->datedebut;
        // stages
        foreach($this->getSessionstages() as $stage){
            if($stage->getDatefin()>$datefin){
                $datefin=$stage->getDatefin();
            }
        }
        // accompagnement
        foreach($this->getSessionaccompagnementsessions() as $ligne){
            if($ligne->getSessionAccompagnement()->getDatefin()>$datefin){
                $datefin=$ligne->getSessionAccompagnement()->getDatefin();
            }
        }
        // modules
        foreach($this->getSessionmoduleblocs() as $modulebloc){
            if(!is_null($modulebloc->getSessionModule())){
                foreach($modulebloc->getSessionModule()->getSessionEvenements() as $sevent){
                    if($sevent->getDatefin()>$datefin){
                        $datefin=$sevent->getDatefin();
                    }
                }
            }
        }
        return $datefin;
    }
        

    /**
     * Set duree
     *
     * @param integer $duree
     *
     * @return Session
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
    
    public function getnbSessionModuleEvenements()
    {

        $resultat=0;
        foreach($this->getSessionmoduleblocs() as $ligne)
        {
            if(!is_null($ligne->getSessionmodule())){
                if(!is_null($ligne->getSessionmodule()->getDatedebut())){
                    $resultat+=1;
                }
            }
        }
        return $resultat;
    }

    /**
     * Set jurydatedebut
     *
     * @param \DateTime $jurydatedebut
     *
     * @return Session
     */
    public function setJurydatedebut($jurydatedebut)
    {
        $this->jurydatedebut = $jurydatedebut;


        return $this;
    }

    /**
     * Get jurydatedebut
     *
     * @return \DateTime
     */
    public function getJurydatedebut()
    {
        return $this->jurydatedebut;
    }

    /**
     * Set jurydatefin
     *
     * @param \DateTime $jurydatefin
     *
     * @return Session
     */
    public function setJurydatefin($jurydatefin)
    {
        $this->jurydatefin = $jurydatefin;

        return $this;
    }

    /**
     * Get jurydatefin
     *
     * @return \DateTime
     */
    public function getJurydatefin()
    {
        return $this->jurydatefin;
    }

    // tous les événements de cette session
    public function getAllEvenements()
    {
        $resultat=[];
        $i=0;
        // les sessionmodule
        foreach($this->getSessionmoduleblocs() as $modulebloc){
            if(!is_null($modulebloc->getSessionModule())){
                foreach($modulebloc->getSessionModule()->getSessionevenementPeres() as $sevent){
                    
                    $i++;
                    $resultat[$i]['origine']='sessionmodule';
                    $resultat[$i]['objet']=$modulebloc->getSessionModule();
                    $resultat[$i]['datedebut']=$sevent->getDatedebut();
                    $resultat[$i]['datefin']=$sevent->getDatefin();
                }
            }
        }
        // les stages
        foreach($this->getSessionstages() as $ligne){
            $i++;
            $resultat[$i]['origine']='stage';
            $resultat[$i]['objet']=$ligne;
            $resultat[$i]['datedebut']=$ligne->getDatedebut();
            $resultat[$i]['datefin']=$ligne->getDatefin();
        }
        // les accompagnements
        foreach($this->getSessionaccompagnementsessions() as $ligne){
            $i++;
            $resultat[$i]['origine']='accompagnement';
            $resultat[$i]['objet']=$ligne->getSessionaccompagnement();
            $resultat[$i]['datedebut']=$ligne->getSessionaccompagnement()->getDatedebut();
            $resultat[$i]['datefin']=$ligne->getSessionaccompagnement()->getDatefin();
        }
        // jury
        if(!is_null($this->getJurydatedebut())){
            $i++;
            $resultat[$i]['origine']='jury';
            $resultat[$i]['objet']='';
            $resultat[$i]['datedebut']=$this->getJurydatedebut();
            $resultat[$i]['datefin']=$this->getJurydatefin();
        }
        return $resultat;

    }


    /**
     * Set juryduree
     *
     * @param integer $juryduree
     *
     * @return Session
     */
    public function setJuryduree($juryduree)
    {
        $this->juryduree = $juryduree;

        return $this;
    }

    /**
     * Get juryduree
     *
     * @return integer
     */
    public function getJuryduree()
    {
        return $this->juryduree;
    }

    /**
     * Add sessiondossier
     *
     * @param \App\Entity\SessionDossier $sessiondossier
     *
     * @return Session
     */
    public function addSessiondossier(\App\Entity\SessionDossier $sessiondossier)
    {
        $this->sessiondossiers[] = $sessiondossier;
        $sessiondossier->setSession($this);

        return $this;
    }

    /**
     * Remove sessiondossier
     *
     * @param \App\Entity\SessionDossier $sessiondossier
     */
    public function removeSessiondossier(\App\Entity\SessionDossier $sessiondossier)
    {
        $this->sessiondossiers->removeElement($sessiondossier);
        $sessiondossier->setSession(null);
    }


    /**
     * Get sessiondossiers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSessiondossiers()
    {
        return $this->sessiondossiers;
    }


    /**
     * Remove evenement
     *
     * @param \App\Entity\Evenement $evenement
     */
    public function removeEvenement(\App\Entity\Evenement $evenement)
    {
        $this->evenements->removeElement($evenement);
        $evenement->setSession(null);
    }


    /**
     * Get evenements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvenements()
    {
        return $this->evenements;
    }

    /**
     * Set parcours
     *
     * @param \App\Entity\Parcours $parcours
     *
     * @return Session
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
    
    public function getDureeSessionModules()
    {   
        $resultat=0;
        foreach($this->getSessionmoduleblocs() as $ligne)
        {
            $resultat=$resultat+$ligne->getDuree();
        }
        return $resultat;
    }

    public function getDureeSessionEvenements()
    {   
        $resultat=0;
        foreach($this->getSessionmoduleblocs() as $ligne)
        {
            $resultat=$resultat+$ligne->getDureeEvenement();
        }
        return $resultat;
    }
    
    public function getDureeSessionstages()
    {   
        $resultat=0;
        foreach($this->getSessionstages() as $ligne)
        {
            $resultat=$resultat+$ligne->getDuree();
        }
        return $resultat;
    }

    public function getDureeSessionaccompagnements()
    {
        $resultat=0;
        foreach($this->getSessionaccompagnementsessions() as $ligne)
        {
            if($ligne->getCompteheure()==true){
                $resultat=$resultat+$ligne->getSessionaccompagnement()->getDuree();
            }
        }
        return $resultat;
    }


    /**
     * Set enchainement
     *
     * @param \App\Entity\Enchainement $enchainement
     *
     * @return Session
     */
    public function setEnchainement(\App\Entity\Enchainement $enchainement = null)
    {
        $this->enchainement = $enchainement;

        return $this;
    }

    /**
     * Get enchainement
     *
     * @return \App\Entity\Enchainement
     */
    public function getEnchainement()
    {
        return $this->enchainement;
    }

    /**
     * Add sessionaccompagnementsession
     *
     * @param \App\Entity\SessionAccompagnementSession $sessionaccompagnementsession
     *
     * @return Session
     */
    public function addSessionaccompagnementsession(\App\Entity\SessionAccompagnementSession $sessionaccompagnementsession)
    {
        $this->sessionaccompagnementsessions[] = $sessionaccompagnementsession;
        $sessionaccompagnementsession->setSession($this);
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
     * Set sessionjury
     *
     * @param \App\Entity\SessionJury $sessionjury
     *
     * @return Session
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
     * Set publiesite
     *
     * @param boolean $publiesite
     *
     * @return Session
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
    
    // méthode pour set la durée de la session
    public function getDureetotale()
    {
        $resultat=$this->getDureeSessionModules();
        $resultat+=$this->getDureeSessionstages();
        $resultat+=$this->getDureeSessionaccompagnements();
        
        return $resultat;
    }

    
    // méthode pour set la durée de la session
    public function getDureetotaleEvenements()
    {
        $resultat=$this->getDureeSessionEvenements();
        $resultat+=$this->getDureeSessionstages();
        $resultat+=$this->getDureeSessionaccompagnements();
        
        return $resultat;
    }


    public function getNbJoursTotal()
    {
        return $this->getDatedebut()->diff($this->getDatefin())->days;
    }

    public function getNbSemainesTotal()
    {
        return round($this->getNbJoursTotal()/7,1);
    }
    

    /**
     * Set dureecentre
     *
     * @param string $dureecentre
     *
     * @return Session
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
     * Set dureestage
     *
     * @param string $dureestage
     *
     * @return Session
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
     * @return Session
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
     * @return Session
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
     * @return Session
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
     * @return Session
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
     * @return Session
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
     * @return Session
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
     * Add sessionperiode
     *
     * @param \App\Entity\SessionPeriode $sessionperiode
     *
     * @return Session
     */
    public function addSessionperiode(\App\Entity\SessionPeriode $sessionperiode)
    {
        $this->sessionperiodes[] = $sessionperiode;
        $sessionperiode->setSession($this);
        return $this;
    }

    /**
     * Remove sessionperiode
     *
     * @param \App\Entity\SessionPeriode $sessionperiode
     */
    public function removeSessionperiode(\App\Entity\SessionPeriode $sessionperiode)
    {
        $this->sessionperiodes->removeElement($sessionperiode);
    }

    /**
     * Get sessionperiodes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSessionperiodes()
    {
        return $this->sessionperiodes;
    }
    
    public function removeAllSessionperiodes()
    {
        foreach($this->getSessionperiodes() as $ligne)
        {
            $this->removeSessionperiode($ligne);
        }
    }

    /**
     * Set dureecentrewithacc
     *
     * @param string $dureecentrewithacc
     *
     * @return Session
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
    
    public function isAnnulable()
    {
        $resultat=true;
        if(count($this->getSessionstages())>0){$resultat=false;}
        if(count($this->getSessionaccompagnementsessions())>0){$resultat=false;}
        if(count($this->getSessioncertifications())>0){$resultat=false;}
        if(!is_null($this->getSessionjury())){$resultat=false;}

        foreach($this->getSessionmoduleblocs() as $ligne)
        {
            if(count($ligne->getSessionmodule()->getSessionEvenements())>0){$resultat=false;}
        }
        
        return $resultat;

    }

    /**
     * Set sessiondokelio
     *
     * @param string $sessiondokelio
     *
     * @return Session
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

    /**
     * Set dokelioparcours
     *
     * @param string $dokelioparcours
     *
     * @return Session
     */
    public function setDokelioparcours($dokelioparcours)
    {
        $this->dokelioparcours = $dokelioparcours;

        return $this;
    }

    /**
     * Get dokelioparcours
     *
     * @return string
     */
    public function getDokelioparcours()
    {
        return $this->dokelioparcours;
    }

    /**
     * Add bdcparcour
     *
     * @param \App\Entity\BondecommandeParcours $bdcparcour
     *
     * @return Session
     */
    public function addBdcparcour(\App\Entity\BondecommandeParcours $bdcparcour)
    {
        $this->bdcparcours[] = $bdcparcour;

        return $this;
    }

    /**
     * Remove bdcparcour
     *
     * @param \App\Entity\BondecommandeParcours $bdcparcour
     */
    public function removeBdcparcour(\App\Entity\BondecommandeParcours $bdcparcour)
    {
        $this->bdcparcours->removeElement($bdcparcour);
    }

    /**
     * Get bdcparcours
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBdcparcours()
    {
        return $this->bdcparcours;
    }

    /**
     * Add sessionmoduleenchainement
     *
     * @param \App\Entity\SessionModuleEnchainement $sessionmoduleenchainement
     *
     * @return Session
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
	
	public function getRemiseaniveau()
	{
		$resultat=0;
        foreach($this->getSessionmoduleblocs() as $modulebloc){
            if(!is_null($modulebloc->getSessionModule())){
                if(!is_null($modulebloc->getSessionModule()->getModule())){
					if(!is_null($modulebloc->getSessionModule()->getModule()->getNiveautechnique())){
						if($modulebloc->getSessionModule()->getModule()->getNiveautechnique()->getCode()=='REMISEANIVEAU'){
							$resultat+=$modulebloc->getSessionModule()->getDuree();
						}
					}
                }
            }
        }
		return $resultat;
	}
    
    public function getRemiseaniveauByEvenement()
    {
        $resultat=0;
        foreach($this->getSessionmoduleblocs() as $modulebloc){
            foreach($modulebloc->getSessionModule()->getSessionEvenements() as $Evenement){
                    if( !is_null($modulebloc->getSessionModule()->getModule()) )
                    {
                        if(!is_null($modulebloc->getSessionModule()->getModule()->getNiveautechnique())){
                            if($modulebloc->getSessionModule()->getModule()->getNiveautechnique()->getCode()=='REMISEANIVEAU'){
                                $resultat+=$modulebloc->getSessionModule()->getDuree();
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
        foreach($this->getSessionaccompagnementsessions() as $ligne){
            if(!is_null($ligne->getSessionAccompagnement()->getTypeaccompagnement())){
                if($ligne->getSessionAccompagnement()->getTypeaccompagnement()->getCode()=='SOUTIEN'){
					$resultat+=$ligne->getSessionAccompagnement()->getDuree();
                }
            }
        }
		return $resultat;
	}

	public function getCoaching()
	{
		$resultat=0;
        foreach($this->getSessionaccompagnementsessions() as $ligne){
            if(!is_null($ligne->getSessionAccompagnement()->getTypeaccompagnement())){
                if($ligne->getSessionAccompagnement()->getTypeaccompagnement()->getCode()=='COACHING'){
					$resultat+=$ligne->getSessionAccompagnement()->getDuree();
                }
            }
        }
		return $resultat;
	}

	public function getTre()
	{
		$resultat=0;
        foreach($this->getSessionaccompagnementsessions() as $ligne){
            if(!is_null($ligne->getSessionAccompagnement()->getTypeaccompagnement())){
                if($ligne->getSessionAccompagnement()->getTypeaccompagnement()->getCode()=='TRE'){
					$resultat+=$ligne->getSessionAccompagnement()->getDuree();
                }
            }
        }
		return $resultat;
	}


    /**
     * Set dureemodules.
     *
     * @param string|null $dureemodules
     *
     * @return Session
     */
    public function setDureemodules($dureemodules = null)
    {
        $this->dureemodules = $dureemodules;

        return $this;
    }

    /**
     * Get dureemodules.
     *
     * @return string|null
     */
    public function getDureemodules()
    {
        return $this->dureemodules;
    }


    /**
     * Set sitepartenaire.
     *
     * @param bool|null $sitepartenaire
     *
     * @return Session
     */
    public function setSitepartenaire($sitepartenaire = null)
    {
        $this->sitepartenaire = $sitepartenaire;

        return $this;
    }

    /**
     * Get sitepartenaire.
     *
     * @return bool|null
     */
    public function getSitepartenaire()
    {
        return $this->sitepartenaire;
    }

    /**
     * Set partenaire.
     *
     * @param \App\Entity\Partenaire|null $partenaire
     *
     * @return Session
     */
    public function setPartenaire(\App\Entity\Partenaire $partenaire = null)
    {
        $this->partenaire = $partenaire;

        return $this;
    }

    /**
     * Get partenaire.
     *
     * @return \App\Entity\Partenaire|null
     */
    public function getPartenaire()
    {
        return $this->partenaire;
    }

    /**
     * Set adressepartenaire.
     *
     * @param \App\Entity\Adresse|null $adressepartenaire
     *
     * @return Session
     */
    public function setAdressepartenaire(\App\Entity\Adresse $adressepartenaire = null)
    {
        $this->adressepartenaire = $adressepartenaire;

        return $this;
    }

    /**
     * Get adressepartenaire.
     *
     * @return \App\Entity\Adresse|null
     */
    public function getAdressepartenaire()
    {
        return $this->adressepartenaire;
    }

    /**
     * Set site.
     *
     * @param \App\Entity\Site|null $site
     *
     * @return Session
     */
    public function setSite(\App\Entity\Site $site = null)
    {
        $this->site = $site;

        return $this;
    }

    /**
     * Get site.
     *
     * @return \App\Entity\Site|null
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * Set simulnbapprenants.
     *
     * @param string|null $simulnbapprenants
     *
     * @return Session
     */
    public function setSimulnbapprenants($simulnbapprenants = null)
    {
        $this->simulnbapprenants = $simulnbapprenants;

        return $this;
    }

    /**
     * Get simulnbapprenants.
     *
     * @return string|null
     */
    public function getSimulnbapprenants()
    {
        return $this->simulnbapprenants;
    }

    /**
     * Set dateslarges.
     *
     * @param bool|null $dateslarges
     *
     * @return Session
     */
    public function setDateslarges($dateslarges = null)
    {
        $this->dateslarges = $dateslarges;

        return $this;
    }

    /**
     * Get dateslarges.
     *
     * @return bool|null
     */
    public function getDateslarges()
    {
        return $this->dateslarges;
    }

    /**
     * Set salledefaut.
     *
     * @param \App\Entity\Salle|null $salledefaut
     *
     * @return Session
     */
    public function setSalledefaut(\App\Entity\Salle $salledefaut = null)
    {
        $this->salledefaut = $salledefaut;

        return $this;
    }

    /**
     * Get salledefaut.
     *
     * @return \App\Entity\Salle|null
     */
    public function getSalledefaut()
    {
        return $this->salledefaut;
    }

    /**
     * Add evenement.
     *
     * @param \App\Entity\Evenement $evenement
     *
     * @return Session
     */
    public function addEvenement(\App\Entity\Evenement $evenement)
    {
        $this->evenements[] = $evenement;

        return $this;
    }

    /**
     * Set referentpedagogique.
     *
     * @param \App\Entity\Employe|null $referentpedagogique
     *
     * @return Session
     */
    public function setReferentpedagogique(\App\Entity\Employe $referentpedagogique = null)
    {
        $this->referentpedagogique = $referentpedagogique;

        return $this;
    }

    /**
     * Get referentpedagogique.
     *
     * @return \App\Entity\Employe|null
     */
    public function getReferentpedagogique()
    {
        return $this->referentpedagogique;
    }

    /**
     * Set referentadministratif.
     *
     * @param \App\Entity\Employe|null $referentadministratif
     *
     * @return Session
     */
    public function setReferentAdministratif(\App\Entity\Employe $referentadministratif = null)
    {
        $this->referentadministratif = $referentadministratif;

        return $this;
    }

    /**
     * Get referentadministratif.
     *
     * @return \App\Entity\Employe|null
     */
    public function getReferentAdministratif()
    {
        return $this->referentadministratif;
    }


    /**
     * Set referentcoach.
     *
     * @param \App\Entity\Employe|null $referentcoach
     *
     * @return Session
     */
    public function setReferentcoach(\App\Entity\Employe $referentcoach = null)
    {
        $this->referentcoach = $referentcoach;

        return $this;
    }

    /**
     * Get referentcoach.
     *
     * @return \App\Entity\Employe|null
     */
    public function getReferentcoach()
    {
        return $this->referentcoach;
    }
}
