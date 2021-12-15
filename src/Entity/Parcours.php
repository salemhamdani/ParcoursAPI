<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Parcours
 *
 * @ORM\Table(name="parcours")
 * @ORM\Entity(repositoryClass="App\Repository\ParcoursRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Parcours {

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->blocs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->enchainements = new \Doctrine\Common\Collections\ArrayCollection();
        $this->themes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sanctions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->parcoursavant = new \Doctrine\Common\Collections\ArrayCollection();
        $this->parcoursapres = new \Doctrine\Common\Collections\ArrayCollection();
        $this->coderome = new \Doctrine\Common\Collections\ArrayCollection();
        $this->codesromes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sessions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->formacodes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->archive = false;
        $this->cpf = false;
        $this->rncp = false;

        $this->duree = 0;
        $this->dureeModulaire = 0;
        $this->dureeAccompagnement = 0;
        $this->dureeStage = 0;
		$this->dureeCenter = 0;
        $this->dureeElearning = 0;
		$this->tarifjury = 0;

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
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datedebutvalide;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datefinvalide;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datepublicationofficiel;
    
    /**
     * @var string
     *
     * @ORM\Column(name="plus", type="text", nullable=true)
    */
    private $plus;


    /**
     * @var bool
     *
     * @ORM\Column(name="publication", type="boolean")
     */
    private $publication = true ;

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
    * @ORM\ManyToOne(targetEntity="App\Entity\Employe", inversedBy="referentparcours")
    */
    private $referent;

    /**
     * @var string
     *
     * @ORM\Column(name="alt_banniere", type="string", length=250, nullable=true)
     * 
     */
    private $altBanniere;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="alt_vignette", type="string", length=250, nullable=true)
     * 
     */
    private $altVignette;

	/**
     * @ORM\OneToOne(targetEntity="App\Entity\Article", inversedBy="parcours")
     */
    private $article;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $tarifjury;

    /**
     * @var \stdClass
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Bloc", cascade={"persist", "remove"}, mappedBy="parcours", orphanRemoval=true)
     */
    private $blocs;

    /**
     * @var \stdClass
     *
     * @ORM\OneToMany(targetEntity="App\Entity\FormateurParcours", cascade={"persist", "remove"}, mappedBy="parcours", orphanRemoval=true)
     */
    private $formateurParcours;

    /**
     * @var \stdClass
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Enchainement", cascade={"persist", "remove"}, mappedBy="parcours", orphanRemoval=true)
     */
    private $enchainements;


    /**
     * @var \stdClass
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Session", mappedBy="parcours", cascade={"persist"})

     */
    private $sessions;

    /**
     * @var \stdClass
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Theme", cascade={"persist"})
     * @ORM\JoinTable(name="parcourstheme")
     */
    private $themes;

    /**
     * @var \stdClass
     *&
     * @ORM\ManyToMany(targetEntity="App\Entity\Sanction")
     */
    private $sanctions;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=15, nullable=true)
     */
    private $code;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Parcours", inversedBy="enfants", cascade={"persist"})
    */
    private $parent;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\Parcours", cascade={"all"}, mappedBy="parent", orphanRemoval=true)
    */
    private $enfants;


    /**
     * @var string
     * @Assert\NotBlank(message="Le sigle est obligatoire.")
     * @ORM\Column(name="sigle", type="string", length=15, nullable=true)
     */
    private $sigle;

    /**
     * @var bool
     *
     * @ORM\Column(name="cpf", type="boolean")
     */
    private $cpf;

    /**
     * @var bool
     *
     * @ORM\Column(name="rncp", type="boolean")
     */
    private $rncp;

     /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg", cascade={"persist"})
     */
    private $autoriteDelivranceCpf;
    
    /**
     * @var string
     * @ORM\Column(name="codecpf", type="string", length=255, nullable=true)
     */
    private $codecpf;
    
    /**
     * @var string
     * @ORM\Column(name="coderncp", type="string", length=255, nullable=true)
     */
    private $coderncp;
    
    /**
     * @var string
     * @ORM\Column(name="coders", type="string", length=255, nullable=true)
     */
    private $coders;
    
    /**
     * @var string
     * @ORM\Column(name="codecpfsalarie", type="string", length=255, nullable=true)
     */
    private $codeCpfSalarie;
    
    /**
     * @var string
     * @ORM\Column(name="codecpfdemandeuremploi", type="string", length=255, nullable=true)
     */
    private $codeCpfDemandeurEmploi;
    /**
     * @var string
     * @ORM\Column(name="codensf", type="string", length=30, nullable=true)
     */
    private $codensf;

  /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
     */
    private $nsf;

  /**
     * @var \stdClass
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Masterlistelg", cascade={"persist"})
     * @ORM\JoinTable(name="parcoursformacodes")
     */
    private $formacodes;


    /**
     * @var int
     *
     * @ORM\Column(name="duree", type="integer")
     */
    private $duree;
    

    /**
     * @var int
     *
     * @ORM\Column(name="dureeModulaire", type="integer")
     */
    private $dureeModulaire;

    /**
     * @var int
     *
     * @ORM\Column(name="dureeAccompagnement", type="integer")
     */
    private $dureeAccompagnement;
        /**
     * @var int
     *
     * @ORM\Column(name="dureestage", type="integer", nullable=true)
     * 
     */
    private $dureeStage;
   
    /**
     * @var int
     *
     * @ORM\Column(name="dureecenter", type="integer", nullable=true)
     * 
     */
    private $dureeCenter;
    
    /**
     * @var int
     *
     * @ORM\Column(name="dureeelearning", type="integer", nullable=true)
     * 
     */
    private $dureeElearning;
    
    /**
     * @var bool
     *
     * @ORM\Column(name="stageobligatoire", type="boolean")
     */
    private $stageObligatoire = false;
    
    /**
     * @var bool
     *
     * @ORM\Column(name="formationpermanente", type="boolean")
     */
    private $formationPermanente = false;
    /**
     * @var string
     *
     * @ORM\Column(name="intitule", type="string", length=255)
     * @Assert\Length(min=2, minMessage="L'intitulé doit faire au moins {{ limit }} caractères.")
     * @Assert\NotBlank(message="L'intitulé est obligatoire.")
     */
    private $intitule; 

    /**
     * @var string
     *
     * @ORM\Column(name="intituleofficiel", type="string", length=255, nullable=true )
     */
    private $intituleofficiel; 


    /**
     * @var string
     *
     * @ORM\Column(name="sanctionresume", type="string", length=255, nullable=true)
     */
    private $sanctionresume;

    /**
     * @var string
     *
     * @ORM\Column(name="sanctionlong", type="text", nullable=true)
     */
    private $sanctionlong;

    /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Filiere", cascade={"persist"})
     * @ORM\JoinColumn(name="filiere")
     */
    private $filiere;

    /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Niveau", cascade={"persist"})
     */
    private $niveauentree;

    /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Niveau", cascade={"persist"})
     * @ORM\JoinColumn(name="niveau")
     */
    private $niveau;

     /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg", cascade={"persist"})
     */
    private $niveautechnique;
    

     /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg", cascade={"persist"})
     */
    private $typeformation;
    

     /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg", cascade={"persist"})
     */
    private $autorite;

    /**
     * @var string
     *
     * @ORM\Column(name="metier", type="text", nullable=true)
     */
    private $metier;

    /**
     * @var string
     *
     * @ORM\Column(name="prerequis", type="text", nullable=true)
     */
    private $prerequis;

    /**
     * @var string
     *
     * @ORM\Column(name="objectif", type="text", nullable=true)
     */
    private $objectif;

    /**
     * @var string
     *
     * @ORM\Column(name="debouche", type="text", nullable=true)
     */
    private $debouche;

    /**
     * @var string
     *
     * @ORM\Column(name="conditionadmission", type="text", nullable=true)
     */
    private $conditionadmission;

    /**
     * @var string
     *
     * @ORM\Column(name="public", type="text", nullable=true)
     */
    private $public;

    /**
     * @var string
     *
     * @ORM\Column(name="detailexamen", type="text", nullable=true)
     */
    private $detailexamen;

    /**
     * @var string
     *
     * @ORM\Column(name="fraispedagogique", type="text", nullable=true)
     */
    private $fraispedagogique;

    /**
     * @var \stdClass
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Parcours", cascade={"persist"})
     * @ORM\JoinTable(name="parcoursavant")
     */
    private $parcoursavant;

    /**
     * @var \stdClass
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Parcours", cascade={"persist"})
     * @ORM\JoinTable(name="parcoursapres")
     */
    private $parcoursapres;

  /**
     * @var \stdClass
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Masterlistelg", cascade={"persist"})
     * @ORM\JoinTable(name="parcourscoderome")
     */
    private $codesromes;

    /**
     * @var string
     *
     * @ORM\Column(name="seotitre", type="string", length=250, nullable=true)
     * @Assert\Length(min=2, minMessage="La meta title doit faire au moins {{ limit }} caractères.")
     * 
     */
    private $seotitre;

    /**
     * @var string
     *
     * @ORM\Column(name="seodescription", type="string", length=250, nullable=true)
     * @Assert\Length(min=2, minMessage="La meta description doit faire au moins {{ limit }} caractères.")
     * 
     */
    private $seodescription;

    /**
     * @var string
     *
     * @ORM\Column(name="rythme", type="text", nullable=true)
     */
    private $rythme;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ModeFormation", cascade={"persist"})
     * @ORM\JoinColumn(name="mode_formation", nullable=true )
     */
    private $modeFormation;

    /**
     * @var string
     *
     * @ORM\Column(name="identifiantDokelio", type="text" , nullable=true)
     */
    private $identifiantDokelio;

    /**
     * @var string
     *
     * @ORM\Column(name="dokelioparcours", type="text" , nullable=true)
     */
    private $dokelioparcours;

   /**
    * @ORM\JoinColumn(nullable=true)
    * @ORM\OneToOne(targetEntity="App\Entity\Upload", cascade={"persist", "remove"})
     */
    private $banniere;

   /**
    * @ORM\JoinColumn(nullable=true)
    * @ORM\OneToOne(targetEntity="App\Entity\Upload", cascade={"persist", "remove"})
     */
    private $vignette;


    /**
     * @var File
     *
     */
     private $filebanniere;



    /**
     * @var File
     *
     */
     private $filevignette;

    /**
     * @var \stdClass
     *
     * @ORM\OneToMany(targetEntity="App\Entity\TarifVenteParcours", cascade={"persist", "remove"}, mappedBy="parcours", orphanRemoval=true)
     */
    private $tarifventes;

    /**
     * @var string
     *
     * @ORM\Column(name="contenuapres", type="text", nullable=true)
     */
    private $contenuapres;

    /**
     * @var string
     *
     * @ORM\Column(name="contenuavant", type="text", nullable=true)
     */
    private $contenuavant;
    
    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=256, nullable=true)
     */
    private $path;
    
    /**
     * Set archive
     *
     * @param boolean $archive
     *
     * @return Parcours
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
     * @return Parcours
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
     * @return Parcours
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
     * Set datefinvalide
     *
     * @param \DateTime $datefinvalide
     *
     * @return Parcours
     */
    public function setDatefinvalide($datefinvalide)
    {
        $this->datefinvalide = $datefinvalide;

        return $this;
    }

    /**
     * Get datefinvalide
     *
     * @return \DateTime
     */
    public function getDatefinvalide()
    {
        return $this->datefinvalide;
    }

    /**
     * Set datepublicationofficiel
     *
     * @param \DateTime $datepublicationofficiel
     *
     * @return Parcours
     */
    public function setDatepublicationofficiel($datepublicationofficiel)
    {
        $this->datepublicationofficiel = $datepublicationofficiel;

        return $this;
    }

    /**
     * Get datepublicationofficiel
     *
     * @return \DateTime
     */
    public function getDatepublicationofficiel()
    {
        return $this->datepublicationofficiel;
    }

    /**
     * Set datedebutvalide
     *
     * @param \DateTime $datedebutvalide
     *
     * @return Parcours
     */
    public function setDatedebutvalide($datedebutvalide)
    {
        $this->datedebutvalide = $datedebutvalide;

        return $this;
    }

    /**
     * Get datedebutvalide
     *
     * @return \DateTime
     */
    public function getDatedebutvalide()
    {
        return $this->datedebutvalide;
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
     * Set altBanniere
     *
     * @param string $altBanniere
     *
     * @return Parcours
     */
    public function setAltBanniere($altBanniere)
    {
        $this->altBanniere = $altBanniere;

        return $this;
    }

    /**
     * Get altBanniere
     *
     * @return string
     */
    public function getAltBanniere()
    {
        return $this->altBanniere;
    }

    /**
     * Set altVignette
     *
     * @param string $altVignette
     *
     * @return Parcours
     */
    public function setAltVignette($altVignette)
    {
        $this->altVignette = $altVignette;

        return $this;
    }

    /**
     * Get altVignette
     *
     * @return string
     */
    public function getAltVignette()
    {
        return $this->altVignette;
    }


    /**
     * Set code
     *
     * @param string $code
     *
     * @return Parcours
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set sigle
     *
     * @param string $sigle
     *
     * @return Parcours
     */
    public function setSigle($sigle)
    {
        $this->sigle = $sigle;

        return $this;
    }

    /**
     * Get sigle
     *
     * @return string
     */
    public function getSigle()
    {
        return $this->sigle;
    }

    /**
     * Set cpf
     *
     * @param boolean $cpf
     *
     * @return Parcours
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;

        return $this;
    }

    /**
     * Get cpf
     *
     * @return boolean
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * Set rncp
     *
     * @param boolean $rncp
     *
     * @return Parcours
     */
    public function setRncp($rncp)
    {
        $this->rncp = $rncp;

        return $this;
    }

    /**
     * Get rncp
     *
     * @return boolean
     */
    public function getRncp()
    {
        return $this->rncp;
    }

    /**
     * Set codecpf
     *
     * @param string $codecpf
     *
     * @return Parcours
     */
    public function setCodecpf($codecpf)
    {
        $this->codecpf = $codecpf;

        return $this;
    }

    /**
     * Get codecpf
     *
     * @return string
     */
    public function getCodecpf()
    {
        return $this->codecpf;
    }

    /**
     * Set codeCpfSalarie
     *
     * @param string $codeCpfSalarie
     *
     * @return Parcours
     */
    public function setCodeCpfSalarie($codeCpfSalarie)
    {
        $this->codeCpfSalarie = $codeCpfSalarie;

        return $this;
    }

    /**
     * Get codeCpfSalarie
     *
     * @return string
     */
    public function getCodeCpfSalarie()
    {
        return $this->codeCpfSalarie;
    }

    /**
     * Set codeCpfDemandeurEmploi
     *
     * @param string $codeCpfDemandeurEmploi
     *
     * @return Parcours
     */
    public function setCodeCpfDemandeurEmploi($codeCpfDemandeurEmploi)
    {
        $this->codeCpfDemandeurEmploi = $codeCpfDemandeurEmploi;

        return $this;
    }

    /**
     * Get codeCpfDemandeurEmploi
     *
     * @return string
     */
    public function getCodeCpfDemandeurEmploi()
    {
        return $this->codeCpfDemandeurEmploi;
    }

    /**
     * Set codensf
     *
     * @param string $codensf
     *
     * @return Parcours
     */
    public function setCodensf($codensf)
    {
        $this->codensf = $codensf;

        return $this;
    }

    /**
     * Get codensf
     *
     * @return string
     */
    public function getCodensf()
    {
        return $this->codensf;
    }

    /**
     * Set duree
     *
     * @param integer $duree
     *
     * @return Parcours
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
     * Set dureeStage
     *
     * @param integer $dureeStage
     *
     * @return Parcours
     */
    public function setDureeStage($dureeStage)
    {
        $this->dureeStage = $dureeStage;

        return $this;
    }

    /**
     * Get dureeStage
     *
     * @return integer
     */
    public function getDureeStage()
    {
        return $this->dureeStage;
    }

    /**
     * Set dureeAccompagnement
     *
     * @param integer $dureeAccompagnement
     *
     * @return Parcours
     */
    public function setDureeAccompagnement($dureeAccompagnement)
    {
        $this->dureeAccompagnement = $dureeAccompagnement;

        return $this;
    }

    /**
     * Get dureeAccompagnement
     *
     * @return integer
     */
    public function getDureeAccompagnement()
    {
        return $this->dureeAccompagnement;
    }

    /**
     * Set dureeModulaire
     *
     * @param integer $dureeModulaire
     *
     * @return Parcours
     */
    public function setDureeModulaire($dureeModulaire)
    {
        $this->dureeModulaire = $dureeModulaire;

        return $this;
    }

    /**
     * Get dureeModulaire
     *
     * @return integer
     */
    public function getDureeModulaire()
    {
        return $this->dureeModulaire;
    }

    /**
     * Set intitule
     *
     * @param string $intitule
     *
     * @return Parcours
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
     * Set intituleofficiel
     *
     * @param string $intituleofficiel
     *
     * @return Parcours
     */
    public function setIntituleofficiel($intituleofficiel)
    {
        $this->intituleofficiel = $intituleofficiel;

        return $this;
    }

    /**
     * Get intituleofficiel
     *
     * @return string
     */
    public function getIntituleofficiel()
    {
        return $this->intituleofficiel;
    }

    /**
     * Set sanctionresume
     *
     * @param string $sanctionresume
     *
     * @return Parcours
     */
    public function setSanctionresume($sanctionresume)
    {
        $this->sanctionresume = $sanctionresume;

        return $this;
    }

    /**
     * Get sanctionresume
     *
     * @return string
     */
    public function getSanctionresume()
    {
        return $this->sanctionresume;
    }

    /**
     * Set sanctionlong
     *
     * @param string $sanctionlong
     *
     * @return Parcours
     */
    public function setSanctionlong($sanctionlong)
    {
        $this->sanctionlong = $sanctionlong;

        return $this;
    }

    /**
     * Get sanctionlong
     *
     * @return string
     */
    public function getSanctionlong()
    {
        return $this->sanctionlong;
    }

    /**
     * Set metier
     *
     * @param string $metier
     *
     * @return Parcours
     */
    public function setMetier($metier)
    {
        $this->metier = $metier;

        return $this;
    }

    /**
     * Get metier
     *
     * @return string
     */
    public function getMetier()
    {
        return $this->metier;
    }

    /**
     * Set prerequis
     *
     * @param string $prerequis
     *
     * @return Parcours
     */
    public function setPrerequis($prerequis)
    {
        $this->prerequis = $prerequis;

        return $this;
    }

    /**
     * Get prerequis
     *
     * @return string
     */
    public function getPrerequis()
    {
        return $this->prerequis;
    }

    /**
     * Set objectif
     *
     * @param string $objectif
     *
     * @return Parcours
     */
    public function setObjectif($objectif)
    {
        $this->objectif = $objectif;

        return $this;
    }

    /**
     * Get objectif
     *
     * @return string
     */
    public function getObjectif()
    {
        return $this->objectif;
    }


    /**
     * Set contenuapres
     *
     * @param string $contenuapres
     *
     * @return Parcours
     */
    public function setContenuapres($contenuapres)
    {
        $this->contenuapres = $contenuapres;

        return $this;
    }

    /**
     * Get contenuapres
     *
     * @return string
     */
    public function getContenuapres()
    {
        return $this->contenuapres;
    }

    /**
     * Set contenuavant
     *
     * @param string $contenuavant
     *
     * @return Parcours
     */
    public function setContenuavant($contenuavant)
    {
        $this->contenuavant = $contenuavant;

        return $this;
    }

    /**
     * Get contenuavant
     *
     * @return string
     */
    public function getContenuavant()
    {
        return $this->contenuavant;
    }



    /**
     * Set debouche
     *
     * @param string $debouche
     *
     * @return Parcours
     */
    public function setDebouche($debouche)
    {
        $this->debouche = $debouche;

        return $this;
    }

    /**
     * Get debouche
     *
     * @return string
     */
    public function getDebouche()
    {
        return $this->debouche;
    }

    /**
     * Set conditionadmission
     *
     * @param string $conditionadmission
     *
     * @return Parcours
     */
    public function setConditionadmission($conditionadmission)
    {
        $this->conditionadmission = $conditionadmission;

        return $this;
    }

    /**
     * Get conditionadmission
     *
     * @return string
     */
    public function getConditionadmission()
    {
        return $this->conditionadmission;
    }

    /**
     * Set public
     *
     * @param string $public
     *
     * @return Parcours
     */
    public function setPublic($public)
    {
        $this->public = $public;

        return $this;
    }

    /**
     * Get public
     *
     * @return string
     */
    public function getPublic()
    {
        return $this->public;
    }

    /**
     * Set detailexamen
     *
     * @param string $detailexamen
     *
     * @return Parcours
     */
    public function setDetailexamen($detailexamen)
    {
        $this->detailexamen = $detailexamen;

        return $this;
    }

    /**
     * Get detailexamen
     *
     * @return string
     */
    public function getDetailexamen()
    {
        return $this->detailexamen;
    }

    /**
     * Set fraispedagogique
     *
     * @param string $fraispedagogique
     *
     * @return Parcours
     */
    public function setFraispedagogique($fraispedagogique)
    {
        $this->fraispedagogique = $fraispedagogique;

        return $this;
    }

    /**
     * Get fraispedagogique
     *
     * @return string
     */
    public function getFraispedagogique()
    {
        return $this->fraispedagogique;
    }

    /**
     * Set seotitre
     *
     * @param string $seotitre
     *
     * @return Parcours
     */
    public function setSeotitre($seotitre)
    {
        $this->seotitre = $seotitre;

        return $this;
    }

    /**
     * Get seotitre
     *
     * @return string
     */
    public function getSeotitre()
    {
        return $this->seotitre;
    }

    /**
     * Set seodescription
     *
     * @param string $seodescription
     *
     * @return Parcours
     */
    public function setSeodescription($seodescription)
    {
        $this->seodescription = $seodescription;

        return $this;
    }

    /**
     * Get seodescription
     *
     * @return string
     */
    public function getSeodescription()
    {
        return $this->seodescription;
    }

    /**
     * Set rythme
     *
     * @param string $rythme
     *
     * @return Parcours
     */
    public function setRythme($rythme)
    {
        $this->rythme = $rythme;

        return $this;
    }

    /**
     * Get rythme
     *
     * @return string
     */
    public function getRythme()
    {
        return $this->rythme;
    }

    /**
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return Parcours
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
     * @return Parcours
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
     * Add theme
     *
     * @param \App\Entity\Theme $theme
     *
     * @return Parcours
     */
    public function addTheme(\App\Entity\Theme $theme)
    {
        $this->themes[] = $theme;
        return $this;
    }

    /**
     * Remove theme
     *
     * @param \App\Entity\Theme $theme
     */
    public function removeTheme(\App\Entity\Theme $theme)
    {
        $this->themes->removeElement($theme);
    }

    /**
     * Set themes
     *
     * @param \stdClass $themes
     *
     * @return Themes
     */
    public function setThemes($themes) {
        $this->themes = $themes;

        return $this;
    }


    /**
     * Get themes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getThemes()
    {
        return $this->themes;
    }

    /**
     * Add sanction
     *
     * @param \App\Entity\Sanction $sanction
     *
     * @return Parcours
     */
    public function addSanction(\App\Entity\Sanction $sanction)
    {
        $this->sanctions[] = $sanction;
        return $this;
    }

    /**
     * Remove sanction
     *
     * @param \App\Entity\Sanction $sanction
     */
    public function removeSanction(\App\Entity\Sanction $sanction)
    {
        $this->sanctions->removeElement($sanction);
    }

    /**
     * Get sanctions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSanctions()
    {
        return $this->sanctions;
    }

     /**
     * @param \stdClass $sanctions
     * @return Parcours
     */
    public function setSanctions($sanctions)
    {
        $this->sanctions = $sanctions;
        return $this;
    }

    /**
     * Set parent
     *
     * @param \App\Entity\Parcours $parent
     *
     * @return Parcours
     */
    public function setParent(\App\Entity\Parcours $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \App\Entity\Parcours
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set autoriteDelivranceCpf
     *
     * @param \App\Entity\Masterlistelg $autoriteDelivranceCpf
     *
     * @return Parcours
     */
    public function setAutoriteDelivranceCpf(\App\Entity\Masterlistelg $autoriteDelivranceCpf = null)
    {
        $this->autoriteDelivranceCpf = $autoriteDelivranceCpf;

        return $this;
    }

    /**
     * Get autoriteDelivranceCpf
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getAutoriteDelivranceCpf()
    {
        return $this->autoriteDelivranceCpf;
    }

    /**
     * Set filiere
     *
     * @param \App\Entity\Filiere $filiere
     *
     * @return Parcours
     */
    public function setFiliere(\App\Entity\Filiere $filiere = null)
    {
        $this->filiere = $filiere;

        return $this;
    }

    /**
     * Get filiere
     *
     * @return \App\Entity\Filiere
     */
    public function getFiliere()
    {
        return $this->filiere;
    }

    /**
     * Set niveau
     *
     * @param \App\Entity\Niveau $niveau
     *
     * @return Parcours
     */
    public function setNiveau(\App\Entity\Niveau $niveau = null)
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * Get niveau
     *
     * @return \App\Entity\Niveau
     */
    public function getNiveau()
    {
        return $this->niveau;
    }


 /**
     * Set typeformation
     *
     * @param \App\Entity\Masterlistelg $typeformation
     *
     * @return Parcours
     */
    public function setTypeformation(\App\Entity\Masterlistelg $typeformation = null)
    {
        $this->typeformation = $typeformation;

        return $this;
    }

    /**
     * Get typeformation
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getTypeformation()
    {
        return $this->typeformation;
    }


      /**
     * Set niveautechnique
     *
     * @param \App\Entity\Masterlistelg $niveautechnique
     *
     * @return Parcours
     */
    public function setNiveautechnique(\App\Entity\Masterlistelg $niveautechnique = null)
    {
        $this->niveautechnique = $niveautechnique;

        return $this;
    }

    /**
     * Get niveautechnique
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getNiveautechnique()
    {
        return $this->niveautechnique;
    }


    /**
     * Add parcoursavant
     *
     * @param \App\Entity\Parcours $parcoursavant
     *
     * @return Parcours
     */
    public function addParcoursavant(\App\Entity\Parcours $parcoursavant)
    {
        $this->parcoursavant[] = $parcoursavant;
        return $this;
    }

    /**
     * Remove parcoursavant
     *
     * @param \App\Entity\Parcours $parcoursavant
     */
    public function removeParcoursavant(\App\Entity\Parcours $parcoursavant)
    {
        $this->parcoursavant->removeElement($parcoursavant);
    }

    /**
     * Get parcoursavant
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParcoursavant()
    {
        return $this->parcoursavant;
    }

    /**
     * Add parcoursapre
     *
     * @param \App\Entity\Parcours $parcoursapre
     *
     * @return Parcours
     */
    public function addParcoursapre(\App\Entity\Parcours $parcoursapre)
    {
        $this->parcoursapres[] = $parcoursapre;
        return $this;
    }

    /**
     * Remove parcoursapre
     *
     * @param \App\Entity\Parcours $parcoursapre
     */
    public function removeParcoursapre(\App\Entity\Parcours $parcoursapre)
    {
        $this->parcoursapres->removeElement($parcoursapre);
    }

    /**
     * Get parcoursapres
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParcoursapres()
    {
        return $this->parcoursapres;
    }

        /**
     * Set parcoursavant
     *
     * @param \stdClass $parcoursavant
     *
     * @return Parcours
     */
    public function setParcoursavant($parcoursavant) {
        $this->parcoursavant = $parcoursavant;

        return $this;
    }

    

    /**
     * Set parcoursapres
     *
     * @param \stdClass $parcoursapres
     *
     * @return Parcours
     */
    public function setParcoursapres($parcoursapres) {
        $this->parcoursapres = $parcoursapres;

        return $this;
    }


    /**
     * Add bloc
     *
     * @param \App\Entity\Bloc $bloc
     *
     * @return Parcours
     */
    public function addBloc(\App\Entity\Bloc $bloc)
    {
        $this->blocs[] = $bloc;
        return $this;
    }

    /**
     * Remove bloc
     *
     * @param \App\Entity\Bloc $bloc
     */
    public function removeBloc(\App\Entity\Bloc $bloc)
    {
        $this->blocs->removeElement($bloc);
        $bloc->setParcours(null);
    }

    /**
     * Get blocs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBlocs()
    {
        return $this->blocs;
    }
    
    
    /**
     * Add enchainement
     *
     * @param \App\Entity\Enchainement $enchainement
     *
     * @return Parcours
     */
    public function addEnchainement(\App\Entity\Enchainement $enchainement)
    {
        $this->enchainements[] = $enchainement;

        return $this;
    }

    /**

     * Remove enchainement
     *
     * @param \App\Entity\Enchainement $enchainement
     */
    public function removeEnchainement(\App\Entity\Enchainement $enchainement)
    {
        $this->enchainements->removeElement($enchainement);
        $enchainement->setParcours(null);
    }

    /**
     * Get enchainements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEnchainements()
    {
        return $this->enchainements;
    }
    
    
    /**
     * Set referent
     *
     * @param \App\Entity\Employe $referent
     *
     * @return Parcours
     */
    public function setReferent(\App\Entity\Employe $referent = null)
    {
        $this->referent = $referent;

        return $this;
    }

    /**
     * Get referent
     *
     * @return \App\Entity\Employe
     */
    public function getReferent()
    {
        return $this->referent;
    }
    
    /**
     * Set modeFormation
     *
     * @param \App\Entity\ModeFormation $modeFormation
     *
     * @return Parcours
     */
    public function setModeFormation(\App\Entity\ModeFormation $modeFormation = null)
    {
        $this->modeFormation = $modeFormation;

        return $this;
    }

    /**
     * Get modeFormation
     *
     * @return \App\Entity\ModeFormation
     */
    public function getModeFormation()
    {
        return $this->modeFormation;
    }
        /**
     * Set dureeCenter
     *
     * @param integer $dureeCenter
     *
     * @return Parcours
     */
    public function setDureeCenter($dureeCenter)
    {
        $this->dureeCenter = $dureeCenter;

        return $this;
    }

    /**
     * Get dureeCenter
     *
     * @return integer
     */
    public function getDureeCenter()
    {
        return $this->dureeCenter;
    }

    /**
     * Set dureeElearning
     *
     * @param integer $dureeElearning
     *
     * @return Parcours
     */
    public function setDureeElearning($dureeElearning)
    {
        $this->dureeElearning = $dureeElearning;

        return $this;
    }

    /**
     * Get dureeElearning
     *
     * @return integer
     */
    public function getDureeElearning()
    {
        return $this->dureeElearning;
    }

    /**
     * Set stageObligatoire
     *
     * @param boolean $stageObligatoire
     *
     * @return Parcours
     */
    public function setStageObligatoire($stageObligatoire)
    {
        $this->stageObligatoire = $stageObligatoire;

        return $this;
    }

    /**
     * Get stageObligatoire
     *
     * @return boolean
     */
    public function getStageObligatoire()
    {
        return $this->stageObligatoire;
    }

    /**
     * Set formationPermanente
     *
     * @param boolean $formationPermanente
     *
     * @return Parcours
     */
    public function setFormationPermanente($formationPermanente)
    {
        $this->formationPermanente = $formationPermanente;

        return $this;
    }

    /**
     * Get formationPermanente
     *
     * @return boolean
     */
    public function getFormationPermanente()
    {
        return $this->formationPermanente;
    }

    /**
     * Add enfant
     *
     * @param \App\Entity\Parcours $enfant
     *
     * @return Parcours
     */
    public function addEnfant(\App\Entity\Parcours $enfant)
    {
        $this->enfants[] = $enfant;
        $enfant->setParent($this);
        return $this;
    }

    /**
     * Remove enfant
     *
     * @param \App\Entity\Parcours $enfant
     */
    public function removeEnfant(\App\Entity\Parcours $enfant)
    {
        $this->enfants->removeElement($enfant);
    }

    /**
     * Get enfants
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEnfants()
    {
        return $this->enfants;
    }

    /**
     * Add session
     *
     * @param \App\Entity\Session $session
     *
     * @return Parcours
     */
    public function addSession(\App\Entity\Session $session)
    {
        $this->sessions[] = $session;
        return $this;
    }

    /**
     * Remove session
     *
     * @param \App\Entity\Session $session
     */
    public function removeSession(\App\Entity\Session $session)
    {
        $this->sessions->removeElement($session);
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


    public function getIntituleLong()
    {
        return $this->sigle.'('.$this->code.') '.$this->intitule;
    }

    /**
     * Set identifiantDokelio
     *
     * @param string $identifiantDokelio
     *
     * @return Parcours
     */
    public function setIdentifiantDokelio($identifiantDokelio) {
        $this->identifiantDokelio = $identifiantDokelio;

        return $this;
    }

    /**
     * Get identifiantDokelio
     *
     * @return string
     */
    public function getIdentifiantDokelio() {
        return $this->identifiantDokelio;
    }

      /**
     * Set banniere
     * @param \App\Entity\Upload $banniere
     * @return Parcours
     */
    public function setBanniere(\App\Entity\Upload $banniere = null)
    {
        $this->banniere = $banniere;
        if(! is_null($this->banniere))
        $this->banniere->setDirectoryUpload($this->getDirectoryUploadbanniere());
        return $this;
    }
    
    public function getDirectoryUploadbanniere()
    {
        return strtolower((new \ReflectionClass($this))->getShortName().'-'.'banniere');
    }

    /**
     * Get banniere
     *
     * @return \App\Entity\Upload
     */
    public function getBanniere()
    {
        return $this->banniere;
    }


      /**
     * Set vignette
     * @param \App\Entity\Upload $vignette
     * @return Parcours
     */
    public function setVignette(\App\Entity\Upload $vignette = null)
    {
        $this->vignette = $vignette;
        if(! is_null($this->vignette))
        $this->vignette->setDirectoryUpload($this->getDirectoryUploadvignette());
        return $this;
    }
    
    public function getDirectoryUploadvignette()
    {
        return strtolower((new \ReflectionClass($this))->getShortName().'-'.'vignette');
    }

    /**
     * Get vignette
     *
     * @return \App\Entity\Upload
     */
    public function getVignette()
    {
        return $this->vignette;
    }



    /**
     * @return File|null
     */
    public function getFilebanniere()
    {
        return $this->filebanniere;
    }

    /**
     * @param File $filebanniere
     *
     * @return Parcours
     */
    public function setFilebanniere($filebanniere)
    {
        $this->filebanniere = $filebanniere;

        return $this;
    }

    /**
     * @return File|null
     */
    public function getFilevignette()
    {
        return $this->filevignette;
    }

    /**
     * @param File $filevignette
     *
     * @return Parcours
     */
    public function setFilevignette($filevignette)
    {
        $this->filevignette = $filevignette;

        return $this;
    }


    /**
     * Set autorite
     *
     * @param \App\Entity\Masterlistelg $autorite
     *
     * @return Societe
     */
    public function setAutorite(\App\Entity\Masterlistelg $autorite = null)
    {
        $this->autorite = $autorite;

        return $this;
    }

    /**
     * Get autorite
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getAutorite()
    {
        return $this->autorite;
    }


    /**
     * Add tarifvente
     *
     * @param \App\Entity\TarifVenteParcours $tarifvente
     *
     * @return Parcours
     */
    public function addTarifvente(\App\Entity\TarifVenteParcours $tarifvente)
    {
        $this->tarifventes[] = $tarifvente;
        return $this;
    }

    /**
     * Remove tarifvente
     *
     * @param \App\Entity\TarifVenteParcours $tarifvente
     */
    public function removeTarifvente(\App\Entity\TarifVenteParcours $tarifvente)
    {
        $this->tarifventes->removeElement($tarifvente);
    }

    /**
     * Get tarifventes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTarifventes()
    {
        return $this->tarifventes;
    }


    /**
     * Add codesrome
     *
     * @param \App\Entity\Masterlistelg $codesrome
     *
     * @return Parcours
     */
    public function addCodesrome(\App\Entity\Masterlistelg $codesrome)
    {
        $this->codesromes[] = $codesrome;

        return $this;
    }



    /**
     * Remove codesrome
     *
     * @param \App\Entity\Masterlistelg $codesrome
     */
    public function removeCodesrome(\App\Entity\Masterlistelg $codesrome)
    {
        $this->codesromes->removeElement($codesrome);
    }

    /**
     * Get codesromes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCodesromes()
    {
        return $this->codesromes;
    }


    public function existeCodesromes($code)
    {
        foreach ($this->codesromes as $codesrome) {
            if($codesrome->getCode()==$code) return true;
        }
        return  false;
    }

    /**
     * Set niveauentree
     *
     * @param \App\Entity\Niveau $niveauentree
     *
     * @return Parcours
     */
    public function setNiveauentree(\App\Entity\Niveau $niveauentree = null)
    {
        $this->niveauentree = $niveauentree;

        return $this;
    }

    /**
     * Get niveauentree
     *
     * @return \App\Entity\Niveau
     */
    public function getNiveauentree()
    {
        return $this->niveauentree;
    }

    /**
     * Add formacode
     *
     * @param \App\Entity\Masterlistelg $formacode
     *
     * @return Parcours
     */
    public function addFormacode(\App\Entity\Masterlistelg $formacode)
    {
        $this->formacodes[] = $formacode;

        return $this;
    }

    /**
     * Remove formacode
     *
     * @param \App\Entity\Masterlistelg $formacode
     */
    public function removeFormacode(\App\Entity\Masterlistelg $formacode)
    {
        $this->formacodes->removeElement($formacode);
    }

    /**
     * Get formacodes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFormacodes()
    {
        return $this->formacodes;
    }

    /**
     * Set nsf
     *
     * @param \App\Entity\Masterlistelg $nsf
     *
     * @return Parcours
     */
    public function setNsf(\App\Entity\Masterlistelg $nsf = null)
    {
        $this->nsf = $nsf;

        return $this;
    }

    /**
     * Get nsf
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getNsf()
    {
        return $this->nsf;
    }

    /**
     * Set article
     *
     * @param \App\Entity\Article $article
     *
     * @return Parcours
     */
    public function setArticle(\App\Entity\Article $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \App\Entity\Article
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set path
     *
     * @param string $path
     *
     * @return Parcours
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }
    
    /**
     * Set publication
     *
     * @param boolean $publication
     *
     * @return Parcours
     */
    public function setPublication($publication)
    {
        $this->publication = $publication;

        return $this;
    }

    /**
     * Get publication
     *
     * @return bool
     */
    public function getPublication()
    {
        return $this->publication;
    }

    /**
     * Set tarifjury.
     *
     * @param string|null $tarifjury
     *
     * @return Parcours
     */
    public function setTarifjury($tarifjury = null)
    {
        $this->tarifjury = $tarifjury;

        return $this;
    }

    /**
     * Get tarifjury.
     *
     * @return string|null
     */
    public function getTarifjury()
    {
        return $this->tarifjury;
    }



    /**
     * Set coders
     *
     * @param string $coders
     *
     * @return Parcours
     */
    public function setCoders($coders)
    {
        $this->coders = $coders;

        return $this;
    }

    /**
     * Get coders
     *
     * @return string
     */
    public function getCoders()
    {
        return $this->coders;
    }

    /**
     * Set coderncp
     *
     * @param string $coderncp
     *
     * @return Parcours
     */
    public function setCoderncp($coderncp)
    {
        $this->coderncp = $coderncp;

        return $this;
    }

    /**
     * Get coderncp
     *
     * @return string
     */
    public function getCoderncp()
    {
        return $this->coderncp;
    }
 

    /**
     * Set plus
     *
     * @param string $plus
     *
     * @return Parcours
     */
    public function setPlus($plus)
    {
         $strLignesFiltrees="";
        $value = preg_split("/\\r\\n|\\r|\\n/",$plus);
        for ($i = 0; $i < count($value); ++$i) {
                    $strLigne = trim($value[$i], '., '); // Suppression des ponctuantions et autres autour de la chaine.
                    if (! empty($strLigne)) {
                        $strLignesFiltrees .= ucfirst($strLigne) . PHP_EOL; // Première lettre de l aligne en majuscule.
                    }
                }
                $strLignesFiltrees = rtrim($strLignesFiltrees, PHP_EOL); // Suppression du dernier retour à la ligne.
        
        
       
        
        $this->plus = $strLignesFiltrees;

        return $this;
    }

    /**
     * Get plus
     *
     * @return string
     */
    public function getPlus()
    {
        return $this->plus;
    }


    /**
     * Set dokelioparcours.
     *
     * @param string|null $dokelioparcours
     *
     * @return Parcours
     */
    public function setDokelioparcours($dokelioparcours = null)
    {
        $this->dokelioparcours = $dokelioparcours;

        return $this;
    }

    /**
     * Get dokelioparcours.
     *
     * @return string|null
     */
    public function getDokelioparcours()
    {
        return $this->dokelioparcours;
    }

    /**
     * Add formateurParcour.
     *
     * @param \App\Entity\FormateurParcours $formateurParcour
     *
     * @return Parcours
     */
    public function addFormateurParcour(\App\Entity\FormateurParcours $formateurParcour)
    {
        $this->formateurParcours[] = $formateurParcour;

        return $this;
    }

    /**
     * Remove formateurParcour.
     *
     * @param \App\Entity\FormateurParcours $formateurParcour
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeFormateurParcour(\App\Entity\FormateurParcours $formateurParcour)
    {
        return $this->formateurParcours->removeElement($formateurParcour);
    }

    /**
     * Get formateurParcours.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFormateurParcours()
    {
        return $this->formateurParcours;
    }
}
