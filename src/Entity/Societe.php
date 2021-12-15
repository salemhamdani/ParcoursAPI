<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * Societe
 *
 * @ORM\Table(name="societe")
 * @ORM\Entity(repositoryClass="App\Repository\SocieteRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class Societe
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sites = new \Doctrine\Common\Collections\ArrayCollection();
		$this->cfaentreprise = false;
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $siteweb;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $opco;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $codeape;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $pardefaut;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $cfaentreprise;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $defautalternance;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numactivite;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numecole;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $codeadherent;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numtva;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Ce champ est obligatoire.")
     */
    private $raisonsociale;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $siren;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $formejuridique;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $codebanque;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $codeguichet;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $numcompte;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $clerib;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $domiciliation;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\CodeTva")
    */
    private $codetva;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Etablissement",  cascade={"persist"})
    */
    private $etablissement;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Financeur",  cascade={"persist"})
    */
    private $financeurmodeleabsence;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Financeur",  cascade={"persist"})
    */
    private $financeurmodeleretard;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\PersonalInformations",  cascade={"persist"})
    */
    private $personalinformations;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\Site", mappedBy="societe")
    */
    private $sites;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\Dossier", mappedBy="societe")
    */
    private $dossier;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Employe")
    */
    private $referenthandicap;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\User")
    */
    private $quiinsert;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\User")
    */
    private $quiupdate;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Employe")
    */
    private $representant;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")

    */
    private $type;

    /**
     * @ORM\Column(name="cssstyle", type="text", nullable=true)
    */
    private $cssstyle;

    /**
     * @ORM\Column(name="lignecolor", type="text", nullable=true)
    */
    private $lignecolor;
    
    /**
     * @var bool
     *
     * @ORM\Column(name="ligne", type="boolean", nullable=true)
     */
    private $ligne;

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
     * @var File
     *
     */
     private $file;

    /**
     * @var File
     *
     */
     private $fileright;

    /**
     * @var File
     *
     */
     private $fileleft;

    /**
     * @var File
     *
     */
     private $filepage;

    /**
     * @var File
     *
     */
     private $filecachet;

    /**
     * @var File
     *
     */
     private $filerib;

        /**
     * @var string
     *
     * @ORM\Column(name="logo", type="text", nullable=true)
     */
    private $logo;

        /**
     * @var string
     *
     * @ORM\Column(name="imagerib", type="text", nullable=true)
     */
    private $imagerib;

        /**
     * @var string
     *
     * @ORM\Column(name="logoleft", type="text", nullable=true)
     */
    private $logoleft;

        /**
     * @var string
     *
     * @ORM\Column(name="logoright", type="text", nullable=true)
     */
    private $logoright;

        /**
     * @var string
     *
     * @ORM\Column(name="cachet", type="text", nullable=true)
     */
    private $cachet;
     
        /**
     * @var string
     *
     * @ORM\Column(name="piedpage", type="text", nullable=true)
     */
    private $piedpage;

  /**
     * @var int
     *
     * @ORM\Column(name="widthlogoheader", type="integer", nullable=true)
     */
    private $widthlogoheader;

  /**
     * @var int
     *
     * @ORM\Column(name="heightlogoheader", type="integer", nullable=true)
     */
    private $heightlogoheader;

  /**
     * @var int
     *
     * @ORM\Column(name="widthlogofooter", type="integer", nullable=true)
     */
    private $widthlogofooter;

  /**
     * @var int
     *
     * @ORM\Column(name="heightlogofooter", type="integer", nullable=true)
     */
    private $heightlogofooter;

  
        /**
     * @var string
     *
     * @ORM\Column(name="colorh1", type="text", nullable=true)
     */
    private $colorh1;

  
        /**
     * @var string
     *
     * @ORM\Column(name="colorh2", type="text", nullable=true)
     */
    private $colorh2;

  
        /**
     * @var string
     *
     * @ORM\Column(name="colorh3", type="text", nullable=true)
     */
    private $colorh3;

  
        /**
     * @var string
     *
     * @ORM\Column(name="colorparag", type="text", nullable=true)
     */
    private $colorparag;

  
        /**
     * @var string
     *
     * @ORM\Column(name="sizeh1", type="text", nullable=true)
     */
    private $sizeh1;

  
        /**
     * @var string
     *
     * @ORM\Column(name="sizeh2", type="text", nullable=true)
     */
    private $sizeh2;

        /**
     * @var string
     *
     * @ORM\Column(name="sizeh3", type="text", nullable=true)
     */
    private $sizeh3;


        /**
     * @var string
     *
     * @ORM\Column(name="sizeparag", type="text", nullable=true)
     */
    private $sizeparag;


    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")

    */
    private $fonth1;


        /**
     * @var string
     *
     * @ORM\Column(name="signatureemail", type="text", nullable=true)
     */
    private $signatureemail ;

	/**
	* @ORM\OneToOne(targetEntity="App\Entity\Tchat", cascade={"all"})
     */
    private $tchat;

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
     * Set dateinsert
     *
     * @param \DateTime $dateinsert
     *
     * @return Societe
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
     * @return Societe
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
     * @return Societe
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
     * @return Societe
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
     * Set representant
     *
     * @param \App\Entity\Employe $representant
     *
     * @return Societe
     */
    public function setRepresentant(\App\Entity\Employe $representant = null)
    {
        $this->representant = $representant;

        return $this;
    }

    /**
     * Get representant
     *
     * @return \App\Entity\Employe
     */
    public function getRepresentant()
    {
        return $this->representant;
    }
 
    /**
     * Set etablissement
     *
     * @param \App\Entity\Etablissement $etablissement
     *
     * @return Societe
     */
    public function setEtablissement(\App\Entity\Etablissement $etablissement = null)
    {
        $this->etablissement = $etablissement;

        return $this;
    }

    /**
     * Get etablissement
     *
     * @return \App\Entity\Etablissement
     */
    public function getEtablissement()
    {
        return $this->etablissement;
    }

    /**
     * Set siteweb
     *
     * @param string $siteweb
     *
     * @return Societe
     */
    public function setSiteweb($siteweb)
    {
        $this->siteweb = $siteweb;

        return $this;
    }

    /**
     * Get siteweb
     *
     * @return string
     */
    public function getSiteweb()
    {
        return $this->siteweb;
    }

    /**
     * Set numtva
     *
     * @param string $numtva
     *
     * @return Societe
     */
    public function setNumtva($numtva)
    {
        $this->numtva = $numtva;

        return $this;
    }

    /**
     * Get numtva
     *
     * @return string
     */
    public function getNumtva()
    {
        return $this->numtva;
    }

    /**
     * Set raisonsociale
     *
     * @param string $raisonsociale
     *
     * @return Societe
     */
    public function setRaisonsociale($raisonsociale)
    {
        $this->raisonsociale = $raisonsociale;

        return $this;
    }

    /**
     * Get raisonsociale
     *
     * @return string
     */
    public function getRaisonsociale()
    {
        return $this->raisonsociale;
    }

    /**
     * Set siren
     *
     * @param string $siren
     *
     * @return Societe
     */
    public function setSiren($siren)
    {
        $this->siren = $siren;

        return $this;
    }

    /**
     * Get siren
     *
     * @return string
     */
    public function getSiren()
    {
        return $this->siren;
    }

    /**
     * Set formejuridique
     *
     * @param string $formejuridique
     *
     * @return Societe
     */
    public function setFormejuridique($formejuridique)
    {
        $this->formejuridique = $formejuridique;

        return $this;
    }

    /**
     * Get formejuridique
     *
     * @return string
     */
    public function getFormejuridique()
    {
        return $this->formejuridique;
    }

    /**
     * Set codebanque
     *
     * @param string $codebanque
     *
     * @return Societe
     */
    public function setCodebanque($codebanque)
    {
        $this->codebanque = $codebanque;

        return $this;
    }

    /**
     * Get codebanque
     *
     * @return string
     */
    public function getCodebanque()
    {
        return $this->codebanque;
    }

    /**
     * Set codeguichet
     *
     * @param string $codeguichet
     *
     * @return Societe
     */
    public function setCodeguichet($codeguichet)
    {
        $this->codeguichet = $codeguichet;

        return $this;
    }

    /**
     * Get codeguichet
     *
     * @return string
     */
    public function getCodeguichet()
    {
        return $this->codeguichet;
    }

    /**
     * Set numcompte
     *
     * @param string $numcompte
     *
     * @return Societe
     */
    public function setNumcompte($numcompte)
    {
        $this->numcompte = $numcompte;

        return $this;
    }

    /**
     * Get numcompte
     *
     * @return string
     */
    public function getNumcompte()
    {
        return $this->numcompte;
    }

    /**
     * Set clerib
     *
     * @param string $clerib
     *
     * @return Societe
     */
    public function setClerib($clerib)
    {
        $this->clerib = $clerib;

        return $this;
    }

    /**
     * Get clerib
     *
     * @return string
     */
    public function getClerib()
    {
        return $this->clerib;
    }

    /**
     * Set domiciliation
     *
     * @param string $domiciliation
     *
     * @return Societe
     */
    public function setDomiciliation($domiciliation)
    {
        $this->domiciliation = $domiciliation;

        return $this;
    }

    /**
     * Get domiciliation
     *
     * @return string
     */
    public function getDomiciliation()
    {
        return $this->domiciliation;
    }

    /**
     * Add site
     *
     * @param \App\Entity\Site $site
     *
     * @return Societe
     */
    public function addSite(\App\Entity\Site $site)
    {
        $this->sites[] = $site;
        $site->setSociete($this);
        return $this;
    }

    /**
     * Remove site
     *
     * @param \App\Entity\Site $site
     */
    public function removeSite(\App\Entity\Site $site)
    {
        $this->sites->removeElement($site);
    }

    /**
     * Get sites
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSites()
    {
        return $this->sites;
    }
    
    public function getNbSites()
    {
        return count($this->getSites());
    }

    public function getNbSalles()
    {
        $resultat=0;
        foreach($this->getSites() as $site){
            $resultat+=$site->getNbSalles();
        }
        return $resultat;
    }

    public function getNbDossiers()
    {
        return count($this->getDossier());
    }


    /**
     * Set personalinformations
     *
     * @param \App\Entity\PersonalInformations $personalinformations
     *
     * @return Societe
     */
    public function setPersonalinformations(\App\Entity\PersonalInformations $personalinformations = null)
    {
        $this->personalinformations = $personalinformations;

        return $this;
    }

    /**
     * Get personalinformations
     *
     * @return \App\Entity\PersonalInformations
     */
    public function getPersonalinformations()
    {
        return $this->personalinformations;
    }



    /**
     * Set logo
     *
     * @param string $logo
     *
     * @return Template
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set imagerib
     *
     * @param string $imagerib
     *
     * @return Template
     */
    public function setImagerib($imagerib)
    {
        $this->imagerib = $imagerib;

        return $this;
    }

    /**
     * Get imagerib
     *
     * @return string
     */
    public function getImagerib()
    {
        return $this->imagerib;
    }
    

    /**
     * Set logoright
     *
     * @param string $logoright
     *
     * @return Template
     */
    public function setLogoright($logoright)
    {
        $this->logoright = $logoright;

        return $this;
    }


    /**
     * Get logoright
     *
     * @return string
     */
    public function getLogoright()
    {
        return $this->logoright;
    }


    /**
     * Set logoleft
     *
     * @param string $logoleft
     *
     * @return Template
     */
    public function setLogoleft($logoleft)
    {
        $this->logoleft = $logoleft;

        return $this;
    }


    /**
     * Get logoleft
     *
     * @return string
     */
    public function getLogoleft()
    {
        return $this->logoleft;
    }


    /**
     * Set cachet
     *
     * @param string $cachet
     *
     * @return Template
     */
    public function setCachet($cachet)
    {
        $this->cachet = $cachet;

        return $this;
    }


    /**
     * Get cachet
     *
     * @return string
     */
    public function getCachet()
    {
        return $this->cachet;
    }
    /**
     * Set piedpage
     *
     * @param string $piedpage
     *
     * @return Template
     */
    public function setPiedpage($piedpage)
    {
        $this->piedpage = $piedpage;

        return $this;
    }

    /**
     * Get piedpage
     *
     * @return string
     */
    public function getPiedpage()
    {
        return $this->piedpage;
    }




    /**
     * @return File|null
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param File $file
     *
     * @return Template
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }



    /**
     * @return File|null
     */
    public function getFilecachet()
    {
        return $this->filecachet;
    }

    /**
     * @param File $filecachet
     *
     * @return Template
     */
    public function setFilecachet($filecachet)
    {
        $this->filecachet = $filecachet;

        return $this;
    }


    /**
     * @return File|null
     */
    public function getFilerib()
    {
        return $this->filerib;
    }

    /**
     * @param File $filerib
     *
     * @return Template
     */
    public function setFilerib($filerib)
    {
        $this->filerib = $filerib;

        return $this;
    }


    /**
     * @return File|null
     */
    public function getFilepage()
    {
        return $this->filepage;
    }

    /**
     * @param File $filepage
     *
     * @return Template
     */
    public function setFilepage($filepage)
    {
        $this->filepage = $filepage;

        return $this;
    }

    /**
     * @return File|null
     */
    public function getFileright()
    {
        return $this->fileright;
    }

    /**
     * @param File $fileright
     *
     * @return Template
     */
    public function setFileright($fileright)
    {
        $this->fileright = $fileright;

        return $this;
    }

    /**
     * @return File|null
     */
    public function getFileleft()
    {
        return $this->fileleft;
    }

    /**
     * @param File $fileleft
     *
     * @return Template
     */
    public function setFileleft($fileleft)
    {
        $this->fileleft = $fileleft;

        return $this;
    }


    /**
     * Set type
     *
     * @param \App\Entity\Masterlistelg $type
     *
     * @return Societe
     */
    public function setType(\App\Entity\Masterlistelg $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set widthlogoheader
     *
     * @param integer $widthlogoheader
     *
     * @return Societe
     */
    public function setWidthlogoheader($widthlogoheader)
    {
        $this->widthlogoheader = $widthlogoheader;

        return $this;
    }

    /**
     * Get widthlogoheader
     *
     * @return int
     */
    public function getWidthlogoheader()
    {
        return $this->widthlogoheader;
    }

    /**
     * Set heightlogoheader
     *
     * @param integer $heightlogoheader
     *
     * @return Societe
     */
    public function setHeightlogoheader($heightlogoheader)
    {
        $this->heightlogoheader = $heightlogoheader;

        return $this;
    }

    /**
     * Get heightlogoheader
     *
     * @return int
     */
    public function getHeightlogoheader()
    {
        return $this->heightlogoheader;
    }



    /**
     * Set widthlogofooter
     *
     * @param integer $widthlogofooter
     *
     * @return Societe
     */
    public function setWidthlogofooter($widthlogofooter)
    {
        $this->widthlogofooter = $widthlogofooter;

        return $this;
    }

    /**
     * Get widthlogofooter
     *
     * @return int
     */
    public function getWidthlogofooter()
    {
        return $this->widthlogofooter;
    }

    /**
     * Set heightlogofooter
     *
     * @param integer $heightlogofooter
     *
     * @return Societe
     */
    public function setHeightlogofooter($heightlogofooter)
    {
        $this->heightlogofooter = $heightlogofooter;

        return $this;
    }

    /**
     * Get heightlogofooter
     *
     * @return int
     */
    public function getHeightlogofooter()
    {
        return $this->heightlogofooter;
    }


    /**
     * Set cssstyle
     *
     * @param string $cssstyle
     *
     * @return Template
     */
    public function setCssstyle($cssstyle)
    {
        $this->cssstyle = $cssstyle;

        return $this;
    }


    /**
     * Get cssstyle
     *
     * @return string
     */
    public function getCssstyle()
    {
        return $this->cssstyle;
    }
    
    /**
     * Set lignecolor
     *
     * @param string $lignecolor
     *
     * @return Template
     */
    public function setLignecolor($lignecolor)
    {
        $this->lignecolor = $lignecolor;

        return $this;
    }

    /**
     * Get lignecolor
     *
     * @return string
     */
    public function getLignecolor()
    {
        return $this->lignecolor;
    }

    /**
     * Set ligne
     *
     * @param boolean $ligne
     *
     * @return Template
     */
    public function setLigne($ligne)
    {
        $this->ligne = $ligne;

        return $this;
    }

    /**
     * Get ligne
     *
     * @return boolean
     */
    public function getLigne()
    {
        return $this->ligne;
    }


    /**
     * Set colorh1
     *
     * @param string $colorh1
     *
     * @return Societe
     */
    public function setColorh1($colorh1)
    {
        $this->colorh1 = $colorh1;

        return $this;
    }

    /**
     * Get colorh1
     *
     * @return string
     */
    public function getColorh1()
    {
        return $this->colorh1;
    }

    /**
     * Set colorh2
     *
     * @param string $colorh2
     *
     * @return Societe
     */
    public function setColorh2($colorh2)
    {
        $this->colorh2 = $colorh2;

        return $this;
    }

    /**
     * Get colorh2
     *
     * @return string
     */
    public function getColorh2()
    {
        return $this->colorh2;
    }

    /**
     * Set colorh3
     *
     * @param string $colorh3
     *
     * @return Societe
     */
    public function setColorh3($colorh3)
    {
        $this->colorh3 = $colorh3;

        return $this;
    }

    /**
     * Get colorh3
     *
     * @return string
     */
    public function getColorh3()
    {
        return $this->colorh3;
    }

    /**
     * Set colorparag
     *
     * @param string $colorparag
     *
     * @return Societe
     */
    public function setColorparag($colorparag)
    {
        $this->colorparag = $colorparag;

        return $this;
    }

    /**
     * Get colorparag
     *
     * @return string
     */
    public function getColorparag()
    {
        return $this->colorparag;
    }


    /**
     * Set sizeh1
     *
     * @param string $sizeh1
     *
     * @return Societe
     */
    public function setSizeh1($sizeh1)
    {
        $this->sizeh1 = $sizeh1;

        return $this;
    }

    /**
     * Get sizeh1
     *
     * @return string
     */
    public function getSizeh1()
    {
        return $this->sizeh1;
    }

    /**
     * Set sizeh2
     *
     * @param string $sizeh2
     *
     * @return Societe
     */
    public function setSizeh2($sizeh2)
    {
        $this->sizeh2 = $sizeh2;

        return $this;
    }

    /**
     * Get sizeh2
     *
     * @return string
     */
    public function getSizeh2()
    {
        return $this->sizeh2;
    }
    /**
     * Set sizeh3
     *
     * @param string $sizeh3
     *
     * @return Societe
     */
    public function setSizeh3($sizeh3)
    {
        $this->sizeh3 = $sizeh3;

        return $this;
    }

    /**
     * Get sizeh3
     *
     * @return string
     */
    public function getSizeh3()
    {
        return $this->sizeh3;
    }
    /**
     * Set sizeparag
     *
     * @param string $sizeparag
     *
     * @return Societe
     */
    public function setSizeparag($sizeparag)
    {
        $this->sizeparag = $sizeparag;

        return $this;
    }

    /**
     * Get sizeparag
     *
     * @return string
     */
    public function getSizeparag()
    {
        return $this->sizeparag;
    }
    /**
     * Set signatureemail
     *
     * @param string $signatureemail
     *
     * @return Societe
     */
    public function setSignatureemail($signatureemail)
    {
        $this->signatureemail = $signatureemail;

        return $this;
    }

    /**
     * Get signatureemail
     *
     * @return string
     */
    public function getSignatureemail()
    {
        return $this->signatureemail;
    }


    /**
     * Set financeurmodeleabsence
     *
     * @param \App\Entity\Financeur $financeurmodeleabsence
     *
     * @return Societe
     */
    public function setFinanceurmodeleabsence(\App\Entity\Financeur $financeurmodeleabsence = null)
    {
        $this->financeurmodeleabsence = $financeurmodeleabsence;

        return $this;
    }

    /**
     * Get financeurmodeleabsence
     *
     * @return \App\Entity\Financeur
     */
    public function getFinanceurmodeleabsence()
    {
        return $this->financeurmodeleabsence;
    }

    /**
     * Set financeurmodeleretard
     *
     * @param \App\Entity\Financeur $financeurmodeleretard
     *
     * @return Societe
     */
    public function setFinanceurmodeleretard(\App\Entity\Financeur $financeurmodeleretard = null)
    {
        $this->financeurmodeleretard = $financeurmodeleretard;

        return $this;
    }

    /**
     * Get financeurmodeleretard
     *
     * @return \App\Entity\Financeur
     */
    public function getFinanceurmodeleretard()
    {
        return $this->financeurmodeleretard;
    }

    /**
     * Add dossier
     *
     * @param \App\Entity\Dossier $dossier
     *
     * @return Societe
     */
    public function addDossier(\App\Entity\Dossier $dossier)
    {
        $this->dossier[] = $dossier;

        return $this;
    }

    /**
     * Remove dossier
     *
     * @param \App\Entity\Dossier $dossier
     */
    public function removeDossier(\App\Entity\Dossier $dossier)
    {
        $this->dossier->removeElement($dossier);
    }

    /**
     * Get dossier
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDossier()
    {
        return $this->dossier;
    }

    /**
     * Set tchat
     *
     * @param \App\Entity\Tchat $tchat
     *
     * @return Societe
     */
    public function setTchat(\App\Entity\Tchat $tchat = null)
    {
        $this->tchat = $tchat;

        return $this;
    }

    /**
     * Get tchat
     *
     * @return \App\Entity\Tchat
     */
    public function getTchat()
    {
        return $this->tchat;
    }

    /**
     * Set opco
     *
     * @param string $opco
     *
     * @return Societe
     */
    public function setOpco($opco)
    {
        $this->opco = $opco;

        return $this;
    }

    /**
     * Get opco
     *
     * @return string
     */
    public function getOpco()
    {
        return $this->opco;
    }

    /**
     * Set codeape
     *
     * @param string $codeape
     *
     * @return Societe
     */
    public function setCodeape($codeape)
    {
        $this->codeape = $codeape;

        return $this;
    }

    /**
     * Get codeape
     *
     * @return string
     */
    public function getCodeape()
    {
        return $this->codeape;
    }

    /**
     * Set numactivite
     *
     * @param string $numactivite
     *
     * @return Societe
     */
    public function setNumactivite($numactivite)
    {
        $this->numactivite = $numactivite;

        return $this;
    }

    /**
     * Get numactivite
     *
     * @return string
     */
    public function getNumactivite()
    {
        return $this->numactivite;
    }

    /**
     * Set numecole
     *
     * @param string $numecole
     *
     * @return Societe
     */
    public function setNumecole($numecole)
    {
        $this->numecole = $numecole;

        return $this;
    }

    /**
     * Get numecole
     *
     * @return string
     */
    public function getNumecole()
    {
        return $this->numecole;
    }

    /**
     * Set codeadherent
     *
     * @param string $codeadherent
     *
     * @return Societe
     */
    public function setCodeadherent($codeadherent)
    {
        $this->codeadherent = $codeadherent;

        return $this;
    }

    /**
     * Get codeadherent
     *
     * @return string
     */
    public function getCodeadherent()
    {
        return $this->codeadherent;
    }

    /**
     * Set fonth1
     *
     * @param \App\Entity\Masterlistelg $fonth1
     *
     * @return Societe
     */
    public function setFonth1(\App\Entity\Masterlistelg $fonth1 = null)
    {
        $this->fonth1 = $fonth1;

        return $this;
    }

    /**
     * Get fonth1
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getFonth1()
    {
        return $this->fonth1;
    }

    

    /**
     * Set pardefaut.
     *
     * @param bool|null $pardefaut
     *
     * @return Societe
     */
    public function setPardefaut($pardefaut = null)
    {
        $this->pardefaut = $pardefaut;

        return $this;
    }

    /**
     * Get pardefaut.
     *
     * @return bool|null
     */
    public function getPardefaut()
    {
        return $this->pardefaut;
    }

    /**
     * Set codetva.
     *
     * @param \App\Entity\CodeTva|null $codetva
     *
     * @return Societe
     */
    public function setCodetva(\App\Entity\CodeTva $codetva = null)
    {
        $this->codetva = $codetva;

        return $this;
    }

    /**
     * Get codetva.
     *
     * @return \App\Entity\CodeTva|null
     */
    public function getCodetva()
    {
        return $this->codetva;
    }

    /**
     * Set defautalternance.
     *
     * @param bool|null $defautalternance
     *
     * @return Societe
     */
    public function setDefautalternance($defautalternance = null)
    {
        $this->defautalternance = $defautalternance;

        return $this;
    }

    /**
     * Get defautalternance.
     *
     * @return bool|null
     */
    public function getDefautalternance()
    {
        return $this->defautalternance;
    }

    /**
     * Set cfaentreprise.
     *
     * @param bool|null $cfaentreprise
     *
     * @return Societe
     */
    public function setCfaentreprise($cfaentreprise = null)
    {
        $this->cfaentreprise = $cfaentreprise;

        return $this;
    }

    /**
     * Get cfaentreprise.
     *
     * @return bool|null
     */
    public function getCfaentreprise()
    {
        return $this->cfaentreprise;
    }


    /**
     * Set referenthandicap.
     *
     * @param \App\Entity\Employe|null $referenthandicap
     *
     * @return Societe
     */
    public function setReferenthandicap(\App\Entity\Employe $referenthandicap = null)
    {
        $this->referenthandicap = $referenthandicap;

        return $this;
    }

    /**
     * Get referenthandicap.
     *
     * @return \App\Entity\Employe|null
     */
    public function getReferenthandicap()
    {
        return $this->referenthandicap;
    }
}
