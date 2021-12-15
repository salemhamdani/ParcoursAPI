<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * Evenement
 *
 * @ORM\Table(name="evenements")
 * @ORM\Entity(repositoryClass="App\Repository\EvenementRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
 *	"session" = "App\Entity\SessionEvenement",
 *	"evenement" = "App\Entity\Evenement"})
 * @ORM\HasLifecycleCallbacks() 
 */
class Evenement
{

    /**
     * Constructor
     */
    public function __construct()
    {
		$this->enfants = new \Doctrine\Common\Collections\ArrayCollection();
		$this->diffusions = new \Doctrine\Common\Collections\ArrayCollection();
		$this->archive = false;
		$this->aenfants = false;
		$this->jourentier = false;
		$this->emarge1valide = false;
		$this->emarge2valide = false;
		$this->codeemargement1 = "0000";
		$this->codeemargement2 = "0000";
    }

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean",nullable=true)
     */
    private $sitepartenaire;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean",nullable=true)
     */
    private $echue;

    

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Partenaire")
	*/
	private $partenaire;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Adresse")
	*/
	private $adressepartenaire;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Site")
	*/
	private $site;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Salle")
    */
    private $salle;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $designation;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
	*/
	private $typeevenement;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Evenement", inversedBy="enfants")
	*/
	private $pere;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Societe")
    */
    private $societe;

	/**
	* @ORM\OneToMany(targetEntity="App\Entity\Evenement", mappedBy="pere", orphanRemoval=true, cascade={"all"})
	*/
	private $enfants;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean",nullable=true)
     */
    private $aenfants;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $archive;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $codeemargement1;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $codeemargement2;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean",nullable=true)
     */
    private $jourentier;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $datedebut;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean",nullable=true)
     */
    private $emarge1valide;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\SessionFormateur")
	*/
	private $emarge1formateur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $dateemarge1;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean",nullable=true)
     */
    private $emarge2valide;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\SessionFormateur")
	*/
	private $emarge2formateur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $dateemarge2;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datefin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $heuredebut1;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $heurefin1;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $heuredebut2;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $heurefin2;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\SessionFormateur", inversedBy="evenements")
	*/
	private $sessionformateur;

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
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $categorie;


    /**
     * @var bool
     *
     * @ORM\Column(name="participation", type="boolean",nullable=true)
     */
    private $participation = true;


     /**
     * @var bool
     *
     * @ORM\Column(name="visible", type="boolean",nullable=true)
     */
    private $visible = true;


    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Masterlistelg", cascade={"persist"})
     */
    private $diffusions;


    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Session", inversedBy="evenements")
    */
    private $session;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\SessionCertification")
    */
    private $sessioncertification;

    /**
    * @ORM\OneToOne(targetEntity="App\Entity\Adresse",  cascade={"all"})
    */
    private $adresse;


    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;


    /**
     * @var string
     *
     * @ORM\Column(name="SeoTitle", type="string", length=255, nullable=true)
     */
    private $SeoTitle;


    /**
     * @var string
     *
     * @ORM\Column(name="alt", type="string", length=255, nullable=true)
     */
    private $alt;

    /**
     * @var string
     *
     * @ORM\Column(name="alias", type="string", length=255, nullable=true)
     */
    private $alias;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptioncourte", type="text", nullable=true)
     */
    private $descriptioncourte;
 
    /**
     * @var string
     *
     * @ORM\Column(name="seodescription", type="text", nullable=true)
     */
    private $seodescription;

    /**
     * @var File
     *
     */
     private $file;


   /**
    * @ORM\JoinColumn(nullable=true)
    * @ORM\ManyToOne(targetEntity="App\Entity\Upload", cascade={"persist", "remove"})
     */
    private $image;
    
    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Employe", inversedBy="evenements")
    */
    private $responsable;


    /**
     * @var string
     *
     * @ORM\Column(name="idapi", type="string", length=255, nullable=true)
     */
    private $idapi;

    
    /**
     * Set responsable
     *
     * @param \App\Entity\Employe $responsable
     *
     * @return Evenement
     */
    public function setResponsable(\App\Entity\Employe $referent = null)
    {
        $this->responsable = $responsable;

        return $this;
    }

    /**
     * Get responsable
     *
     * @return \App\Entity\Employe
     */
    public function getResponsable()
    {
        return $this->responsable;
    }



    /**
     * Set participation
     *
     * @param boolean $participation
     *
     * @return Evenement
     */
    public function setParticipation($participation)
    {
        $this->participation = $participation;

        return $this;
    }

    /**
     * Get participation
     *
     * @return bool
     */
    public function getParticipation()
    {
        return $this->participation;
    }

    
    /**
     * Set visible
     *
     * @param boolean $visible
     *
     * @return Evenement
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;

        return $this;
    }

    /**
     * Get visible
     *
     * @return bool
     */
    public function getVisible()
    {
        return $this->visible;
    }




    /**
     * Set alt
     *
     * @param string $alt
     *
     * @return Evenement
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Evenement
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
     * Set descriptioncourte
     *
     * @param string $descriptioncourte
     *
     * @return Evenement
     */
    public function setDescriptioncourte($descriptioncourte)
    {
        $this->descriptioncourte = $descriptioncourte;

        return $this;
    }

    /**
     * Get descriptioncourte
     *
     * @return string
     */
    public function getDescriptioncourte()
    {
        return $this->descriptioncourte;
    }


    /**
     * Set seodescription
     *
     * @param string $seodescription
     *
     * @return Evenement
     */
    public function setSeodescription($seodescription)
    {
        $this->seodescription = $seodescription;

        return $this;
    }

    /**
     * Get seodescriptionseodescription
     *
     * @return string
     */
    public function getseoDescription()
    {
        return $this->seodescription;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Evenement
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }



    /**
     * Set idapi
     *
     * @param string $idapi
     *
     * @return Evenement
     */
    public function setIdapi($idapi)
    {
        $this->idapi = $idapi;

        return $this;
    }

    /**
     * Get idapi
     *
     * @return string
     */
    public function getIdapi()
    {
        return $this->idapi;
    }

    /**
     * Set SeoTitle
     *
     * @param string $SeoTitle
     *
     * @return Evenement
     */
    public function setSeoTitle($SeoTitle)
    {
        $this->SeoTitle = $SeoTitle;

        return $this;
    }

    /**
     * Get SeoTitle
     *
     * @return string
     */
    public function getSeoTitle()
    {
        return $this->SeoTitle;
    }

    /**
     * Set alias
     *
     * @param string $alias
     *
     * @return Evenement
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get alias
     *
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
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
     * @return Evenement
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
     * @return Evenement
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
     * @return Evenement
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
     * @return Evenement
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
     * @return Evenement
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
     * Set datedebut
     *
     * @param \DateTime $datedebut
     *
     * @return Evenement
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
     * @return Evenement
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
     * Set typeevenement
     *
     * @param \App\Entity\Masterlistelg $typeevenement
     *
     * @return Evenement
     */
    public function setTypeevenement(\App\Entity\Masterlistelg $typeevenement = null)
    {
        $this->typeevenement = $typeevenement;

        return $this;
    }

    /**
     * Get typeevenement
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getTypeevenement()
    {
        return $this->typeevenement;
    }

    /**
     * Set designation
     *
     * @param string $designation
     *
     * @return Evenement
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * Get designation
     *
     * @return string
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * Set pere
     *
     * @param \App\Entity\Evenement $pere
     *
     * @return Evenement
     */
    public function setPere(\App\Entity\Evenement $pere = null)
    {
        $this->pere = $pere;

        return $this;
    }

    /**
     * Get pere
     *
     * @return \App\Entity\Evenement
     */
    public function getPere()
    {
        return $this->pere;
    }

    /**
     * Add enfant
     *
     * @param \App\Entity\Evenement $enfant
     *
     * @return Evenement
     */
    public function addEnfant(\App\Entity\Evenement $enfant)
    {
        $this->enfants[] = $enfant;
		$enfant->setPere($this);
        return $this;
    }

    /**
     * Remove enfant
     *
     * @param \App\Entity\Evenement $enfant
     */
    public function removeEnfant(\App\Entity\Evenement $enfant)
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
     * Set aenfants
     *
     * @param boolean $aenfants
     *
     * @return Evenement
     */
    public function setAenfants($aenfants)
    {
        $this->aenfants = $aenfants;

        return $this;
    }

    /**
     * Get aenfants
     *
     * @return boolean
     */
    public function getAenfants()
    {
        return $this->aenfants;
    }
	
	public function getNbJours()
	{
		$resultat=0;
		if(!is_null($this->getDatedebut()) && !is_null($this->getDatefin())){
			$resultat = $this->getDatefin()->diff($this->getDatedebut())->format("%a");
			$resultat++;
		}
		
		return $resultat;
	}

    /**
     * Set sessionformateur
     *
     * @param \App\Entity\SessionFormateur $sessionformateur
     *
     * @return Evenement
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
     * Set heuredebut1
     *
     * @param \DateTime $heuredebut1
     *
     * @return Evenement
     */
    public function setHeuredebut1($heuredebut1)
    {
        $this->heuredebut1 = $heuredebut1;

        return $this;
    }

    /**
     * Get heuredebut1
     *
     * @return \DateTime
     */
    public function getHeuredebut1()
    {
        return $this->heuredebut1;
    }

    /**
     * Set heurefin1
     *
     * @param \DateTime $heurefin1
     *
     * @return Evenement
     */
    public function setHeurefin1($heurefin1)
    {
        $this->heurefin1 = $heurefin1;

        return $this;
    }

    /**
     * Get heurefin1
     *
     * @return \DateTime
     */
    public function getHeurefin1()
    {
        return $this->heurefin1;
    }

    /**
     * Set heuredebut2
     *
     * @param \DateTime $heuredebut2
     *
     * @return Evenement
     */
    public function setHeuredebut2($heuredebut2)
    {
        $this->heuredebut2 = $heuredebut2;

        return $this;
    }

    /**
     * Get heuredebut2
     *
     * @return \DateTime
     */
    public function getHeuredebut2()
    {
        return $this->heuredebut2;
    }

    /**
     * Set heurefin2
     *
     * @param \DateTime $heurefin2
     *
     * @return Evenement
     */
    public function setHeurefin2($heurefin2)
    {
        $this->heurefin2 = $heurefin2;

        return $this;
    }

    /**
     * Get heurefin2
     *
     * @return \DateTime
     */
    public function getHeurefin2()
    {
        return $this->heurefin2;
    }

    /**
     * Set jourentier
     *
     * @param boolean $jourentier
     *
     * @return Evenement
     */
    public function setJourentier($jourentier)
    {
        $this->jourentier = $jourentier;

        return $this;
    }

    /**
     * Get jourentier
     *
     * @return boolean
     */
    public function getJourentier()
    {
        return $this->jourentier;
    }



    /**
     * Add diffusion
     *
     * @param \App\Entity\Masterlistelg $evaluation
     *
     * @return Evenement
     */
    public function addDiffusion(\App\Entity\Masterlistelg $diffusion)
    {
        $this->diffusions[] = $diffusion;

        return $this;
    }

    /**
     * Remove diffusion
     *
     * @param \App\Entity\Masterlistelg $diffusion
     */
    public function removeDiffusion(\App\Entity\Masterlistelg $diffusion)
    {
        $this->diffusions->removeElement($diffusion);
    }

    /**
     * Get diffusions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDiffusions()
    {
        return $this->diffusions;
    }

    /**
     * Set session
     *
     * @param \App\Entity\Session $session
     *
     * @return Evenement
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
     * Set sessioncertification
     *
     * @param \App\Entity\SessionCertification $sessioncertification
     *
     * @return Evenement
     */
    public function setSessionCertification(\App\Entity\SessionCertification $sessioncertification = null)
    {
        $this->sessioncertification = $sessioncertification;

        return $this;
    }

    /**
     * Get sessioncertification
     *
     * @return \App\Entity\SessionCertification
     */
    public function getSessionCertification()
    {
        return $this->sessioncertification;
    }

    /**
     * Set societe
     *
     * @param \App\Entity\Societe $societe
     *
     * @return Evenement
     */
    public function setSociete(\App\Entity\Societe $societe = null)
    {
        $this->societe = $societe;

        return $this;
    }

    /**
     * Get societe
     *
     * @return \App\Entity\Societe
     */
    public function getSociete()
    {
        return $this->societe;
    }

    /**
     * Set categorie
     *
     * @param \App\Entity\Masterlistelg $categorie
     *
     * @return Evenement
     */
    public function setCategorie(\App\Entity\Masterlistelg $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getCategorie()
    {
        return $this->categorie;
    }


    /**
     * Set adresse
     *
     * @param \App\Entity\Adresse $adresse
     *
     * @return Evenement
     */
    public function setAdresse(\App\Entity\Adresse $adresse = null)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return \App\Entity\Adresse
     */
    public function getAdresse()
    {
        return $this->adresse;
    }



      /**
     * Set image
     *
     * @param string $image
     *
     * @return Evenement
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
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
     * @return Evenement
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Set sitepartenaire.
     *
     * @param bool|null $sitepartenaire
     *
     * @return Evenement
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
     * Set echue.
     *
     * @param bool|null $echue
     *
     * @return Evenement
     */
    public function setEchue($echue = null)
    {
        $this->echue = $echue;

        return $this;
    }

    /**
     * Get echue.
     *
     * @return bool|null
     */
    public function getEchue()
    {
        return $this->echue;
    }



    /**
     * Set partenaire.
     *
     * @param \App\Entity\Partenaire|null $partenaire
     *
     * @return Evenement
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
     * Set site.
     *
     * @param \App\Entity\Site|null $site
     *
     * @return Evenement
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
     * Set salle.
     *
     * @param \App\Entity\Salle|null $salle
     *
     * @return Evenement
     */
    public function setSalle(\App\Entity\Salle $salle = null)
    {
        $this->salle = $salle;

        return $this;
    }

    /**
     * Get salle.
     *
     * @return \App\Entity\Salle|null
     */
    public function getSalle()
    {
        return $this->salle;
    }

    /**
     * Set adressepartenaire.
     *
     * @param \App\Entity\Adresse|null $adressepartenaire
     *
     * @return Evenement
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
     * Set emarge1valide.
     *
     * @param bool|null $emarge1valide
     *
     * @return Evenement
     */
    public function setEmarge1valide($emarge1valide = null)
    {
        $this->emarge1valide = $emarge1valide;

        return $this;
    }

    /**
     * Get emarge1valide.
     *
     * @return bool|null
     */
    public function getEmarge1valide()
    {
        return $this->emarge1valide;
    }

    /**
     * Set dateemarge1.
     *
     * @param \DateTime|null $dateemarge1
     *
     * @return Evenement
     */
    public function setDateemarge1($dateemarge1 = null)
    {
        $this->dateemarge1 = $dateemarge1;

        return $this;
    }

    /**
     * Get dateemarge1.
     *
     * @return \DateTime|null
     */
    public function getDateemarge1()
    {
        return $this->dateemarge1;
    }

    /**
     * Set emarge2valide.
     *
     * @param bool|null $emarge2valide
     *
     * @return Evenement
     */
    public function setEmarge2valide($emarge2valide = null)
    {
        $this->emarge2valide = $emarge2valide;

        return $this;
    }

    /**
     * Get emarge2valide.
     *
     * @return bool|null
     */
    public function getEmarge2valide()
    {
        return $this->emarge2valide;
    }

    /**
     * Set dateemarge2.
     *
     * @param \DateTime|null $dateemarge2
     *
     * @return Evenement
     */
    public function setDateemarge2($dateemarge2 = null)
    {
        $this->dateemarge2 = $dateemarge2;

        return $this;
    }

    /**
     * Get dateemarge2.
     *
     * @return \DateTime|null
     */
    public function getDateemarge2()
    {
        return $this->dateemarge2;
    }

    /**
     * Set emarge1formateur.
     *
     * @param \App\Entity\SessionFormateur|null $emarge1formateur
     *
     * @return Evenement
     */
    public function setEmarge1formateur(\App\Entity\SessionFormateur $emarge1formateur = null)
    {
        $this->emarge1formateur = $emarge1formateur;

        return $this;
    }

    /**
     * Get emarge1formateur.
     *
     * @return \App\Entity\SessionFormateur|null
     */
    public function getEmarge1formateur()
    {
        return $this->emarge1formateur;
    }

    /**
     * Set emarge2formateur.
     *
     * @param \App\Entity\SessionFormateur|null $emarge2formateur
     *
     * @return Evenement
     */
    public function setEmarge2formateur(\App\Entity\SessionFormateur $emarge2formateur = null)
    {
        $this->emarge2formateur = $emarge2formateur;

        return $this;
    }

    /**
     * Get emarge2formateur.
     *
     * @return \App\Entity\SessionFormateur|null
     */
    public function getEmarge2formateur()
    {
        return $this->emarge2formateur;
    }


    /**
     * Set codeemargement1.
     *
     * @param string|null $codeemargement1
     *
     * @return Evenement
     */
    public function setCodeemargement1($codeemargement1 = null)
    {
        $this->codeemargement1 = $codeemargement1;

        return $this;
    }

    /**
     * Get codeemargement1.
     *
     * @return string|null
     */
    public function getCodeemargement1()
    {
        return $this->codeemargement1;
    }

    /**
     * Set codeemargement2.
     *
     * @param string|null $codeemargement2
     *
     * @return Evenement
     */
    public function setCodeemargement2($codeemargement2 = null)
    {
        $this->codeemargement2 = $codeemargement2;

        return $this;
    }

    /**
     * Get codeemargement2.
     *
     * @return string|null
     */
    public function getCodeemargement2()
    {
        return $this->codeemargement2;
    }
}
