<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


// Pour la gestion des validations.

/**
 * Module
 *
 * @ORM\Table(name="module")
 * @ORM\Entity(repositoryClass="App\Repository\ModuleRepository")
 * @UniqueEntity(fields={"intitule", "duree", "sousthemetheme", "archive", "objectif", "public", "prerequis", "plus"}, message="Ce module existe déjà.")
 */
class Module
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->financeurs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->formateurModule = new \Doctrine\Common\Collections\ArrayCollection();
        $this->chapitres = new \Doctrine\Common\Collections\ArrayCollection();
        $this->certification = new \Doctrine\Common\Collections\ArrayCollection();
        $this->moduleExigeAvant = new \Doctrine\Common\Collections\ArrayCollection();
        $this->moduleSouhaitableAvant = new \Doctrine\Common\Collections\ArrayCollection();
        $this->moduleConseilleApres = new \Doctrine\Common\Collections\ArrayCollection();
        $this->blocmodules = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sessionmodules = new \Doctrine\Common\Collections\ArrayCollection();
        $this->modulecompetences = new \Doctrine\Common\Collections\ArrayCollection();
        $this->modulemodaliteevaluationfinales = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tarifsvente = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tarifsventeintra = new \Doctrine\Common\Collections\ArrayCollection();
        $this->archive = false;
        $this->cpf = false;
        $this->publie = true;
		
		$this->nbrsessioninter = 0;
		$this->nbrsessionintra = 0;
		$this->tarifjury = 0;
	}

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
    private $certifiantes;

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
     * @ORM\OneToOne(targetEntity="App\Entity\Article", inversedBy="module")
     */
    private $article;

      /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ModeFormation", inversedBy="modules", cascade={"persist"})
     * @ORM\JoinColumn(name="mode_formation", nullable=true )
     */
    private $modeFormation;
    

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\SousThemeTheme", inversedBy="module", cascade={"persist"})
     * @ORM\JoinColumn(name="sousthemetheme")
     */
    private $sousthemetheme;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FormateurModule", mappedBy="module")
     */
    private $formateurModule;
    /**
     * @var \stdClass
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Chapitre", mappedBy="module")
     */
    private $chapitres;
    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=15, nullable=true)
	* @ORM\OrderBy({"ordre" = "ASC"})
	*/
    private $code;
    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=256, nullable=true)
     */
    private $path;
    
        /**
     * @var bool
     *
     * @ORM\Column(name="cpf", type="boolean")
     */
    private $cpf;

    /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Delivrance", cascade={"persist"})
     * @ORM\JoinColumn(name="autoriteDelivranceCpf")
     */
    private $autoriteDelivranceCpf;
    
    /**
     * @var string
     * @ORM\Column(name="codecpf", type="string", length=255, nullable=true)
     */
    private $codecpf;
    
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
     *
     * @ORM\Column(name="intitule", type="string", length=256)
     * @Assert\Length(min=2, minMessage="L'intitulé doit faire au moins {{ limit }} caractères.")
     * @Assert\NotBlank(message="L'intitulé est obligatoire.")
     */
    private $intitule;
    /**
     * @var int
     *
     * @ORM\Column(name="duree", type="integer")
     * @Assert\Range(min=1, invalidMessage="La durée doit être numérique, et d'au moins 1 heure.")
     * @Assert\NotBlank(message="La durée est obligatoire.")
     */
    private $duree;
    /**
     * @var string
     *
     * @ORM\Column(name="tarifinterjour", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $tarifinterjour;
    /**
     * @var string
     *
     * @ORM\Column(name="tarifinterhoraire", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $tarifinterhoraire;
    /**
     * @var string
     *
     * @ORM\Column(name="tarifintrajour", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $tarifintrajour;
    /**
     * @var string
     * @ORM\Column(name="tarifintrahoraire", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $tarifintrahoraire;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $tarifjury;

    /**
     * @var string
     *
     * @ORM\Column(name="prerequis", type="text")
     * @Assert\Length(max=500)
     */
    private $prerequis;
    
     
     /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg", cascade={"persist"})
     */

    private $niveaumateriel;

     /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg", cascade={"persist"})
     */
    private $niveautechnique;
    
    /**
     * @var string
     *
     * @ORM\Column(name="objectif", type="text")
     * @Assert\Length(max=500)
    */
    private $objectif;
    /**
     * @var string
     *
     * @ORM\Column(name="plus", type="text", nullable=true)
     * @Assert\Length(max=500)
    */
    private $plus;
    /**
     * @var string
     *
     * @ORM\Column(name="public", type="text", nullable=true)
     */
    private $public;
    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="text", nullable=true)
     */
    private $commentaire;
    /**
     * @var string
     *
     * @ORM\Column(name="certificationcommentaire", type="text", nullable=true)
     */
    private $certificationcommentaire;
    /**
     * @var \stdClass
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Certification", cascade={"persist"})
     * @ORM\JoinTable(name="module_certification")
     */
    private $certification;
    /**
     * @var \stdClass
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Module", cascade={"persist"})
     * @ORM\JoinTable(name="module_exige_avant")
     */
    private $moduleExigeAvant;
    /**
     * @var \stdClass
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Module", cascade={"persist"})
     * @ORM\JoinTable(name="module_souhaitable_avant")
     */
    private $moduleSouhaitableAvant;
    /**
     * @var \stdClass
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Module", cascade={"persist"})
     * @ORM\JoinTable(name="module_conseille_apres")
     */
    private $moduleConseilleApres;

    /**
     * @var bool
     *
     * @ORM\Column(name="publie", type="boolean")
     */
    private $publie;

    /**
     * @var string
     *
     * @ORM\Column(name="seotitre", type="string", length=250, nullable=true)
     * @Assert\Length(min=2, minMessage="La meta title doit faire au moins {{ limit }} caractères.")
     */
    private $seotitre;
    /**
     * @var string
     *
     * @ORM\Column(name="seodescription", type="string", length=250, nullable=true)
     * @Assert\Length(min=2, minMessage="La meta description doit faire au moins {{ limit }} caractères.")
     */
    private $seodescription;
    /**
     * @var string
     *
     * @ORM\Column(name="infopratique", type="text", nullable=true)
     */
    private $infopratique;
    
    /**
     * @var string
     *
     * @ORM\Column(name="alt_vignette", type="string", length=65, nullable=true)
     */
    private $altvignette;
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text",nullable=true)
     * @Assert\Length(min=2, minMessage="La description qui sera affichée sur le site doit faire au moins {{ limit }} caractères.")
     * @Assert\NotBlank(message="La description qui sera affichée sur le site est obligatoire.")
     */
    private $description;
    
    
     /**
     * @var string
     *
     * @ORM\Column(name="alt_photo", type="string", length=65, nullable=true)
     */
    private $altbanniere;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="App\Entity\BlocModule",mappedBy="module" ,cascade={"all"})
     */
    private $blocmodules;

    /**
     * @var string
     *
     * @ORM\Column(name="modalitepedagogiques", type="text", nullable=true)
     */
    private $modalitepedagogiques;

    /**
     * @var string
     *
     * @ORM\Column(name="modaliteevaluationinitial", type="text", nullable=true)
     */
    private $modaliteevaluationinitial;

    /**
     * @var int
     *
     * @ORM\Column(name="nbrsessioninter", type="integer")
     */
    private $nbrsessioninter;

    /**
     * @var int
     *
     * @ORM\Column(name="nbrsessionintra", type="integer")
     */
    private $nbrsessionintra;    

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="App\Entity\SessionModule",mappedBy="module" ,cascade={"all"})
     */
    private $sessionmodules;

    /**
     * @var string
     *
     * @ORM\Column(name="identifiantDokelio", type="string", length=65, nullable=true)
     */
    private $identifiantDokelio;


    /**
    * @ORM\OneToMany(targetEntity="App\Entity\ModuleCompetence", mappedBy="module", cascade={"all"})
    */
    private $modulecompetences;
    /**
    * @ORM\OneToMany(targetEntity="App\Entity\ModuleModaliteevaluationfinale", mappedBy="module", cascade={"all"})
    */
    private $modulemodaliteevaluationfinales;
      

   /**
    * @ORM\JoinColumn(nullable=true)
    * @ORM\ManyToOne(targetEntity="App\Entity\Upload", cascade={"persist", "remove"})
     */
    private $banniere;

   /**
    * @ORM\JoinColumn(nullable=true)
    * @ORM\ManyToOne(targetEntity="App\Entity\Upload", cascade={"persist", "remove"})
     */
    private $vignette;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\TarifVenteTheme", mappedBy="module", cascade={"persist", "remove"})
    */
    private $tarifsvente;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\TarifVenteThemeIntra", mappedBy="module", cascade={"persist", "remove"})
    */
    private $tarifsventeintra;

    /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Theme")
     */
    private $themetarif;

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
     @ORM\ManyToMany(targetEntity="App\Entity\Financeur", cascade={"persist"})
     */
    private $financeurs;


    /**
     * @var bool
     *
     * @ORM\Column(name="publication", type="boolean")
     */
    private $publication = true;

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
     * Set altbanniere
     *
     * @param string $altbanniere
     *
     * @return PersonalInformations
     */
    public function setAltbanniere($altbanniere)
    {
        $this->altbanniere = $altbanniere;

        return $this;
    }

    /**
     * Get altbanniere
     *
     * @return string
     */
    public function getAltbanniere()
    {
        return $this->altbanniere;
    }
    
    
    /**
     * Set archive
     *
     * @param boolean $archive
     *
     * @return Module
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
     * Set certifiantes
     *
     * @param boolean $certifiantes
     *
     * @return Module
     */
    public function setCertifiantes($certifiantes)
    {
        $this->certifiantes = $certifiantes;

        return $this;
    }

    /**
     * Get certifiantes
     *
     * @return boolean
     */
    public function getCertifiantes()
    {
        return $this->certifiantes;
    }

    /**
     * Set dateinsert
     *
     * @param \DateTime $dateinsert
     *
     * @return Module
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
     * @return Module
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
     * Set code
     *
     * @param string $code
     *
     * @return Module
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
     * Set path
     *
     * @param string $path
     *
     * @return Module
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
     * Set cpf
     *
     * @param boolean $cpf
     *
     * @return Module
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
     * Set codecpf
     *
     * @param string $codecpf
     *
     * @return Module
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
     * @return Module
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
     * @return Module
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
     * Set intitule
     *
     * @param string $intitule
     *
     * @return Module
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
     * Set duree
     *
     * @param integer $duree
     *
     * @return Module
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
     * Set tarifinterjour
     *
     * @param string $tarifinterjour
     *
     * @return Module
     */
    public function setTarifinterjour($tarifinterjour)
    {
        $this->tarifinterjour = $tarifinterjour;

        return $this;
    }

    /**
     * Get tarifinterjour
     *
     * @return string
     */
    public function getTarifinterjour()
    {
        return $this->tarifinterjour;
    }

    /**
     * Set tarifinterhoraire
     *
     * @param string $tarifinterhoraire
     *
     * @return Module
     */
    public function setTarifinterhoraire($tarifinterhoraire)
    {
        $this->tarifinterhoraire = $tarifinterhoraire;

        return $this;
    }

    /**
     * Get tarifinterhoraire
     *
     * @return string
     */
    public function getTarifinterhoraire()
    {
        return $this->tarifinterhoraire;
    }

    /**
     * Set tarifintrajour
     *
     * @param string $tarifintrajour
     *
     * @return Module
     */
    public function setTarifintrajour($tarifintrajour)
    {
        $this->tarifintrajour = $tarifintrajour;

        return $this;
    }

    /**
     * Get tarifintrajour
     *
     * @return string
     */
    public function getTarifintrajour()
    {
        return $this->tarifintrajour;
    }

    /**
     * Set tarifintrahoraire
     *
     * @param string $tarifintrahoraire
     *
     * @return Module
     */
    public function setTarifintrahoraire($tarifintrahoraire)
    {
        $this->tarifintrahoraire = $tarifintrahoraire;

        return $this;
    }

    /**
     * Get tarifintrahoraire
     *
     * @return string
     */
    public function getTarifintrahoraire()
    {
        return $this->tarifintrahoraire;
    }

    /**
     * Set prerequis
     *
     * @param string $prerequis
     *
     * @return Module
     */
    public function setPrerequis($prerequis)
    {
        $strLignesFiltrees="";
        $value = preg_split("/\\r\\n|\\r|\\n/",$prerequis);
        for ($i = 0; $i < count($value); ++$i) {
                    $strLigne = trim($value[$i], '., '); // Suppression des ponctuantions et autres autour de la chaine.
                    if (! empty($strLigne)) {
                        $strLignesFiltrees .= ucfirst($strLigne) . PHP_EOL; // Première lettre de l aligne en majuscule.
                    }
                }
                $strLignesFiltrees = rtrim($strLignesFiltrees, PHP_EOL); // Suppression du dernier retour à la ligne.
        
        
        $this->prerequis = $strLignesFiltrees;

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
     * @return Module
     */
    public function setObjectif($objectif)
    {
         $strLignesFiltrees="";
        $value = preg_split("/\\r\\n|\\r|\\n/",$objectif);
        for ($i = 0; $i < count($value); ++$i) {
                    $strLigne = trim($value[$i], '., '); // Suppression des ponctuantions et autres autour de la chaine.
                    if (! empty($strLigne)) {
                        $strLignesFiltrees .= ucfirst($strLigne) . PHP_EOL; // Première lettre de l aligne en majuscule.
                    }
                }
                $strLignesFiltrees = rtrim($strLignesFiltrees, PHP_EOL); // Suppression du dernier retour à la ligne.
        
        
       
        
        $this->objectif = $strLignesFiltrees;

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
     * Set plus
     *
     * @param string $plus
     *
     * @return Module
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
     * Set public
     *
     * @param string $public
     *
     * @return Module
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
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return Module
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
     * Set certificationcommentaire
     *
     * @param string $certificationcommentaire
     *
     * @return Module
     */
    public function setCertificationcommentaire($certificationcommentaire)
    {
        $this->certificationcommentaire = $certificationcommentaire;

        return $this;
    }

    /**
     * Get certificationcommentaire
     *
     * @return string
     */
    public function getCertificationcommentaire()
    {
        return $this->certificationcommentaire;
    }
    
     /**
     * Set certification
     *
     * @param $certification
     * @return $this
     */
    public function setCertification($certification)
    {
        $this->certification = $certification;

        return $this;
    }

    /**
     * Set publie
     *
     * @param boolean $publie
     *
     * @return Module
     */
    public function setPublie($publie)
    {
        $this->publie = $publie;

        return $this;
    }

    /**
     * Get publie
     *
     * @return boolean
     */
    public function getPublie()
    {
        return $this->publie;
    }

    /**
     * Set seotitre
     *
     * @param string $seotitre
     *
     * @return Module
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
     * @return Module
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
     * Set infopratique
     *
     * @param string $infopratique
     *
     * @return Module
     */
    public function setInfopratique($infopratique)
    {
        $this->infopratique = $infopratique;

        return $this;
    }

    /**
     * Get infopratique
     *
     * @return string
     */
    public function getInfopratique()
    {
        return $this->infopratique;
    }

   

    /**
     * Set altvignette
     *
     * @param string $altvignette
     *
     * @return Module
     */
    public function setAltvignette($altvignette)
    {
        $this->altvignette = $altvignette;

        return $this;
    }

    /**
     * Get altvignette
     *
     * @return string
     */
    public function getAltvignette()
    {
        return $this->altvignette;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Module
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return Module
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
     * @return Module
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
     * Set sousthemetheme
     *
     * @param \App\Entity\SousThemeTheme $sousthemetheme
     *
     * @return Module
     */
    public function setSousthemetheme(\App\Entity\SousThemeTheme $sousthemetheme = null)
    {
        $this->sousthemetheme = $sousthemetheme;

        return $this;
    }

    /**
     * Get sousthemetheme
     *
     * @return \App\Entity\SousThemeTheme
     */
    public function getSousthemetheme()
    {
        return $this->sousthemetheme;
    }

    /**
     * Add formateurModule
     *
     * @param \App\Entity\FormateurModule $formateurModule
     *
     * @return Module
     */
    public function addFormateurModule(\App\Entity\FormateurModule $formateurModule)
    {
        $this->formateurModule[] = $formateurModule;
        $formateurModule->setModule($this);
        return $this;
    }

    /**
     * Remove formateurModule
     *
     * @param \App\Entity\FormateurModule $formateurModule
     */
    public function removeFormateurModule(\App\Entity\FormateurModule $formateurModule)
    {
        $this->formateurModule->removeElement($formateurModule);
    }

    /**
     * Get formateurModule
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFormateurModule()
    {
        return $this->formateurModule;
    }

    /**
     * Add chapitre
     *
     * @param \App\Entity\Chapitre $chapitre
     *
     * @return Module
     */
    public function addChapitre(\App\Entity\Chapitre $chapitre)
    {
        $this->chapitres[] = $chapitre;
        $chapitre->setModule($this);
        return $this;
    }

    /**
     * Remove chapitre
     *
     * @param \App\Entity\Chapitre $chapitre
     */
    public function removeChapitre(\App\Entity\Chapitre $chapitre)
    {
        $this->chapitres->removeElement($chapitre);
    }

    /**
     * Get chapitres
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChapitres()
    {
        return $this->chapitres;
    }

    /**
     * Set autoriteDelivranceCpf
     *
     * @param \App\Entity\Delivrance $autoriteDelivranceCpf
     *
     * @return Module
     */
    public function setAutoriteDelivranceCpf(\App\Entity\Delivrance $autoriteDelivranceCpf = null)
    {
        $this->autoriteDelivranceCpf = $autoriteDelivranceCpf;

        return $this;
    }

    /**
     * Get autoriteDelivranceCpf
     *
     * @return \App\Entity\Delivrance
     */
    public function getAutoriteDelivranceCpf()
    {
        return $this->autoriteDelivranceCpf;
    }

    /**
     * Add certification
     *
     * @param \App\Entity\Certification $certification
     *
     * @return Module
     */
    public function addCertification(\App\Entity\Certification $certification)
    {
        $this->certification[] = $certification;
       // $certification->setModule($this);
        return $this;
    }

    /**
     * Remove certification
     *
     * @param \App\Certification $certification
     */
    public function removeCertification(\App\Entity\Certification $certification)
    {
        $this->certification->removeElement($certification);
    }

    /**
     * Get certification
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCertification()
    {
        return $this->certification;
    }

    /**
     * Add moduleExigeAvant
     *
     * @param \App\Entity\Module $moduleExigeAvant
     *
     * @return Module
     */
    public function addModuleExigeAvant(\App\Entity\Module $moduleExigeAvant)
    {
        $this->moduleExigeAvant[] = $moduleExigeAvant;
        //$moduleExigeAvant->setModule($this);
        return $this;
    }

    /**
     * Remove moduleExigeAvant
     *
     * @param \App\Entity\Module $moduleExigeAvant
     */
    public function removeModuleExigeAvant(\App\Entity\Module $moduleExigeAvant)
    {
        $this->moduleExigeAvant->removeElement($moduleExigeAvant);
    }

    /**
     * Get moduleExigeAvant
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getModuleExigeAvant()
    {
        return $this->moduleExigeAvant;
    }

    /**
     * Add moduleSouhaitableAvant
     *
     * @param \App\Entity\Module $moduleSouhaitableAvant
     *
     * @return Module
     */
    public function addModuleSouhaitableAvant(\App\Entity\Module $moduleSouhaitableAvant)
    {
        $this->moduleSouhaitableAvant[] = $moduleSouhaitableAvant;
      //  $moduleSouhaitableAvant->setModule($this);
        return $this;
    }

    /**
     * Remove moduleSouhaitableAvant
     *
     * @param \App\Entity\Module $moduleSouhaitableAvant
     */
    public function removeModuleSouhaitableAvant(\App\Entity\Module $moduleSouhaitableAvant)
    {
        $this->moduleSouhaitableAvant->removeElement($moduleSouhaitableAvant);
    }

    /**
     * Get moduleSouhaitableAvant
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getModuleSouhaitableAvant()
    {
        return $this->moduleSouhaitableAvant;
    }

    /**
     * Add moduleConseilleApre
     *
     * @param \App\Entity\Module $moduleConseilleApre
     *
     * @return Module
     */
    public function addModuleConseilleApre(\App\Entity\Module $moduleConseilleApre)
    {
        $this->moduleConseilleApres[] = $moduleConseilleApre;
        //$moduleConseilleApre->setModule($this);
        return $this;
    }

    /**
     * Remove moduleConseilleApre
     *
     * @param \App\Entity\Module $moduleConseilleApre
     */
    public function removeModuleConseilleApre(\App\Entity\Module $moduleConseilleApre)
    {
        $this->moduleConseilleApres->removeElement($moduleConseilleApre);
    }

    /**
     * Get moduleConseilleApres
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getModuleConseilleApres()
    {
        return $this->moduleConseilleApres;
    }

 /**
     * Set modeFormation
     *
     * @param \DorancoGestiform\ParametrageBundle\Entity\ModeFormation $modeFormation
     *
     * @return Module
     */
    public function setModeFormation(\App\Entity\ModeFormation $modeFormation = null)
    {
        $this->modeFormation = $modeFormation;

        return $this;
    }

    /**
     * Get modeFormation
     *
     * @return \DorancoGestiform\ParametrageBundle\Entity\ModeFormation
     */
    public function getModeFormation()
    {
        return $this->modeFormation;
    }
    
      /**
     * Set niveaumateriel
     *
     * @param \App\Entity\Masterlistelg $niveaumateriel
     *
     * @return Module
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
     * Set niveautechnique
     *
     * @param \App\Entity\Masterlistelg $niveautechnique
     *
     * @return Module
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
     * Add blocmodule
     *
     * @param \App\Entity\BlocModule $blocmodule
     *
     * @return Module
     */
    public function addBlocmodule(\App\Entity\BlocModule $blocmodule)
    {
        $this->blocmodules[] = $blocmodule;
        $blocmodule->setModule($this);
        return $this;
    }

    /**
     * Remove blocmodule
     *
     * @param \App\Entity\BlocModule $blocmodule
     */
    public function removeBlocmodule(\App\Entity\BlocModule $blocmodule)
    {
        $this->blocmodules->removeElement($blocmodule);
    }

    /**
     * Get blocmodules
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBlocmodules()
    {
        return $this->blocmodules;
    }

    /**
     * Set modaliteevaluationinitial
     *
     * @param string $modaliteevaluationinitial
     *
     * @return Module
     */
    public function setModaliteevaluationinitial($modaliteevaluationinitial)
    {
        $this->modaliteevaluationinitial = $modaliteevaluationinitial;

        return $this;
    }

    /**
     * Get modaliteevaluationinitial
     *
     * @return string
     */
    public function getModaliteevaluationinitial()
    {
        return $this->modaliteevaluationinitial;
    }


    /**
     * Set modalitepedagogiques
     *
     * @param string $modalitepedagogiques
     *
     * @return Module
     */
    public function setModalitepedagogiques($modalitepedagogiques)
    {
        $this->modalitepedagogiques = $modalitepedagogiques;

        return $this;
    }

    /**
     * Get modalitepedagogiques
     *
     * @return string
     */
    public function getModalitepedagogiques()
    {
        return $this->modalitepedagogiques;
    }

    /**
     * Set nbrsessioninter
     *
     * @param integer $nbrsessioninter
     *
     * @return Module
     */
    public function setNbrsessioninter($nbrsessioninter)
    {
        $this->nbrsessioninter = $nbrsessioninter;

        return $this;
    }

    /**
     * Get nbrsessioninter
     *
     * @return int
     */
    public function getNbrsessioninter()
    {
        return $this->nbrsessioninter;
    }  

    /**
     * Set nbrsessionintra
     *
     * @param integer $nbrsessionintra
     *
     * @return Module
     */
    public function setNbrsessionintra($nbrsessionintra)
    {
        $this->nbrsessionintra = $nbrsessionintra;

        return $this;
    }

    /**
     * Get nbrsessionintra
     *
     * @return int
     */
    public function getNbrsessionintra()
    {
        return $this->nbrsessionintra;
    } 
    /**
     * Get sessionmodule
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSessionmodules()
    {
        return $this->sessionmodules;
    }

    /**
     * Set identifiantDokelio
     *
     * @param string $identifiantDokelio
     *
     * @return Module
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
     * Add modulecompetences
     *
     * @param \App\Entity\ModuleCompetence $modulecompetences
     *
     * @return ModuleCompetence
     */
    public function addModuleCompetence(\App\Entity\ModuleCompetence $modulecompetence)
    {
        $this->modulecompetences[] = $modulecompetence;
        $modulecompetence->setModule($this);
        return $this;
    }

    /**
     * Remove modulecompetence
     *
     * @param \App\Entity\ModuleCompetence $modulecompetence
     */
    public function removeModuleCompetence(\App\Entity\ModuleCompetence $modulecompetence)
    {
        $this->modulecompetences->removeElement($modulecompetence);
    }


    public function clearModuleCompetence()
    {
    $this->modulecompetences->clear();
    }


    /**
     * Get modulecompetences
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getModuleCompetences()
    {
        return $this->modulecompetences;
    }


      /**
     * Add modulecompetence
     *
     * @param \App\Entity\ModuleModaliteevaluationfinale $modulemodaliteevaluationfinale
     *
     * @return modulemodaliteevaluationfinales
     */
    public function addModuleModaliteevaluationfinale(\App\Entity\ModuleModaliteevaluationfinale $modulemodaliteevaluationfinale)
    {
        $this->modulemodaliteevaluationfinales[] = $modulemodaliteevaluationfinale;
        $modulemodaliteevaluationfinale->setModule($this);
        return $this;
    }

    /**
     * Remove modulemodaliteevaluationfinale
     *
     * @param \App\Entity\ModuleModaliteevaluationfinale $modulemodaliteevaluationfinale
     */
    public function removeModuleModaliteevaluationfinale(\App\Entity\ModuleModaliteevaluationfinale $modulemodaliteevaluationfinale)
    {
        $this->modulemodaliteevaluationfinales->removeElement($modulemodaliteevaluationfinale);
    }


    public function clearModuleModaliteevaluationfinale()
    {
    $this->modulemodaliteevaluationfinales->clear();
    }


    /**
     * Get modulemodaliteevaluationfinales
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getModuleModaliteevaluationfinales()
    {
        return $this->modulemodaliteevaluationfinales;
    }

 
      /**
     * Set banniere
     * @param \App\Entity\Upload $banniere
     * @return Module
     */
    public function setBanniere(\App\Entity\Upload $banniere = null)
    {
        $this->banniere = $banniere;
        if(! is_null($banniere))$this->banniere->setDirectoryUpload($this->getDirectoryUploadbanniere());
        return $this;
    }
    
    public function getDirectoryUploadbanniere()
    {
        return strtolower((new \ReflectionClass($this))->getShortName().'-'.'photo');
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
     * @return Module
     */
    public function setVignette(\App\Entity\Upload $vignette = null)
    {
        $this->vignette = $vignette;
        if(! is_null($vignette))$this->vignette->setDirectoryUpload($this->getDirectoryUploadvignette());
        return $this;
    }
    
    public function getDirectoryUploadvignette()
    {
        return strtolower((new \ReflectionClass($this))->getShortName().'-'.'photo');
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
     * @return Module
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
     * @return Module
     */
    public function setFilevignette($filevignette)
    {
        $this->filevignette = $filevignette;

        return $this;
    }


    /**
     * Add sessionmodule
     *
     * @param \App\Entity\SessionModule $sessionmodule
     *
     * @return Module
     */
    public function addSessionmodule(\App\Entity\SessionModule $sessionmodule)
    {
        $this->sessionmodules[] = $sessionmodule;

        return $this;
    }

    /**
     * Remove sessionmodule
     *
     * @param \App\Entity\SessionModule $sessionmodule
     */
    public function removeSessionmodule(\App\Entity\SessionModule $sessionmodule)
    {
        $this->sessionmodules->removeElement($sessionmodule);
    }

    /**
     * Add tarifsvente
     *
     * @param \App\Entity\TarifVenteTheme $tarifsvente
     *
     * @return Module
     */
    public function addTarifsvente(\App\Entity\TarifVenteTheme $tarifsvente)
    {
        $this->tarifsvente[] = $tarifsvente;
        $tarifsvente->setModule($this);
        return $this;
    }

    /**
     * Remove tarifsvente
     *
     * @param \App\Entity\TarifVenteTheme $tarifsvente
     */
    public function removeTarifsvente(\App\Entity\TarifVenteTheme $tarifsvente)
    {
        $this->tarifsvente->removeElement($tarifsvente);
    }


    /**
     * Get tarifsvente
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTarifsvente()
    {
        return $this->tarifsvente;
    }
    
    /**
     * Set themetarif
     *
     * @param \App\Entity\Theme $themetarif
     *
     * @return Module
     */
    public function setThemetarif(\App\Entity\Theme $themetarif = null)
    {
        $this->themetarif = $themetarif;

        return $this;
    }

    /**
     * Get themetarif
     *
     * @return \App\Entity\Theme
     */
    public function getThemetarif()
    {
        return $this->themetarif;
    }

    /**
     * Add tarifsventeintra
     *
     * @param \App\Entity\TarifVenteThemeIntra $tarifsventeintra
     *
     * @return Module
     */
    public function addTarifsventeintra(\App\Entity\TarifVenteThemeIntra $tarifsventeintra)
    {
        $this->tarifsventeintra[] = $tarifsventeintra;
        $tarifsventeintra->setModule($this);
        return $this;
    }

    /**
     * Remove tarifsventeintra
     *
     * @param \App\Entity\TarifVenteThemeIntra $tarifsventeintra
     */
    public function removeTarifsventeintra(\App\Entity\TarifVenteThemeIntra $tarifsventeintra)
    {
        $this->tarifsventeintra->removeElement($tarifsventeintra);
    }

    /**
     * Get tarifsventeintra
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTarifsventeintra()
    {
        return $this->tarifsventeintra;
    }

    public function getTarifVenteActuel($datedujour=null)
    {

        if(is_null($datedujour)){
            $datedujour=new \DateTime();
        }
        $datedujour->setTime(0,0);

        // retourne le tarif spécifique au module
        foreach($this->getTarifsvente() as $tarif)
        {
            if($tarif->getDatedebut()<=$datedujour && ($tarif->getDatefin()>=$datedujour || is_null($tarif->getDatefin()))){
                return $tarif;
            }
        }
        
        // retourne le tarif du thème
        if(!is_null($this->getThemetarif())){
            return $this->getThemetarif()->getTarifVenteActuel();
        }
        
        // retourne le tarif du thème
        if(!is_null($this->getSousthemetheme())){
            return $this->getSousthemetheme()->getTheme()->getTarifVenteActuel();
        }
        
        
        // n'a trouvé aucun tarif
        return null;
    }

    // le tarif pour la date en paramètre
    public function getTarifVenteByDate($date)
    {
        return $this->getTarifVenteActuel($date);
    }

    public function getTarifVenteIntraActuel($datedujour=null)
    {
        if(is_null($datedujour)){
            $datedujour=new \DateTime();
            $datedujour->setTime(0,0);
        }
        $datedujour->setTime(0,0);

        // retourne le tarif spécifique au module
        foreach($this->getTarifsventeintra() as $tarif)
        {
            if($tarif->getDatedebut()<=$datedujour && ($tarif->getDatefin()>=$datedujour || is_null($tarif->getDatefin()))){
                return $tarif;
            }
        }
        
        // retourne le tarif du thème
        if(!is_null($this->getThemetarif())){
            return $this->getThemetarif()->getTarifVenteIntraActuel();
        }
        
        // n'a trouvé aucun tarif
        return null;
    }

    // 0 -> ne sait pas
    // 1 -> tarif défaut
    // 2 -> thème
    // 3 -> module
    public function getOrigineTarifInter()
    {
        $tarifactuel=$this->getTarifVenteActuel();
/*
if(is_null($tarifactuel)){
	echo($this->getId());
die(' fin ');
}
*/
		if(!is_null($tarifactuel)){
			if(!is_null($tarifactuel->getModule())){
				return 3;
			}
			if(!is_null($tarifactuel->getTheme())){
				return 2;
			}
			if(is_null($tarifactuel->getTarifdefaut())){
				return 1;
			}
		}
        return 0;
    }

    // 0 -> ne sait pas
    // 1 -> tarif défaut
    // 2 -> thème
    // 3 -> module
    public function getOrigineTarifIntra()
    {
        $tarifactuel=$this->getTarifVenteIntraActuel();
        if(!is_null($tarifactuel->getModule())){
            return 3;
        }
        if(!is_null($tarifactuel->getTheme())){
            return 2;
        }
        if(is_null($tarifactuel->getTarifdefaut())){
            return 1;
        }
        return 0;
    }
    
    public function getTarifVenteIntraClientActuelJour($jour=null)
    {
        if($jour==null)
        {
            $jour=$this->duree/7;
        }
        if(!is_null($this->getTarifVenteIntraActuel())){
            foreach($this->getTarifVenteIntraActuel()->getIntrajourclients() as $ligne)
            {
                if($ligne->getJour()==$jour){
                    return $ligne->getTarif()*$ligne->getJour();
                }
            }
        }
        return null;
    }

    public function getTarifVenteIntraOfActuelJour($jour=null)
    {
        if($jour==null)
        {
            $jour=$this->duree/7;
        }
        if(!is_null($this->getTarifVenteIntraActuel())){
            foreach($this->getTarifVenteIntraActuel()->getIntrajourofs() as $ligne)
            {
                if($ligne->getJour()==$jour){
                    return $ligne->getTarif()*$ligne->getJour();
                }
            }
        }
        return null;
    }
    
    public function getTarifVenteInterValeurActuel($valeur=null)
    {
        if($valeur==null){
            if($this->getTarifVenteActuel()->getTarifjour()==true){
                $valeur=$this->duree/7;
            }else{
                $valeur=$this->duree;
            }
        }
        foreach($this->getTarifVenteActuel()->getLignes() as $ligne)
        {
            if($this->getTarifVenteActuel()->getTarifjour()==true){
                if($ligne->getValeurmin()==$valeur){
                    return $ligne->getTarif()*$valeur;
                }
            }else{
                if($valeur>=$ligne->getValeurmin() && $valeur<=$ligne->getValeurmax()){
                    return $ligne->getTarif()*$valeur;
                }
            }
        }
        return null;
    }


    /**
     * Add financeur
     *
     * @param \App\Entity\Financeur $financeur
     *
     * @return Dossier
     */
    public function addFinanceur(\App\Entity\Financeur $financeur)
    {
        $this->financeurs[] = $financeur;

        return $this;
    }

    /**
     * Remove financeur
     *
     * @param \App\Entity\Financeur $financeur
     */
    public function removeFinanceur(\App\Entity\Financeur $financeur)
    {
        $this->financeurs->removeElement($financeur);
    }

    /**
     * Get financeur
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFinanceur()
    {
        return $this->financeurs;
    }

   /**
     * Get financeurs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFinanceurs()
    {
        return $this->financeurs;
    }


    /**
     * Set article
     *
     * @param \App\Entity\Article $article
     *
     * @return Module
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
     * Set publication
     *
     * @param boolean $publication
     *
     * @return Module
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
     * @return Module
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
     * Set contenuapres
     *
     * @param string $contenuapres
     *
     * @return Module
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
     * @return Module
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

}
