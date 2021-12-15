<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Theme
 *
 * @ORM\Table(name="theme")
 * @ORM\Entity(repositoryClass="App\Repository\ThemeRepository")
 * @UniqueEntity(fields={"intitule"}, message="Ce thème existe déjà.")
 * @ORM\HasLifecycleCallbacks
 */
class Theme {

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->archive = false;
        $this->sousthemetheme = new \Doctrine\Common\Collections\ArrayCollection();
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
     * 
     * 
     * @ORM\OneToMany(targetEntity="App\Entity\SousThemeTheme", mappedBy="theme")
	 * @ORM\OrderBy({"ordre" = "ASC"})
     */
    private $sousthemetheme;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule", type="string", length=250)
     * @Assert\Length(min=2, minMessage="L'intitulé doit faire au moins {{ limit }} caractères.")
     * @Assert\NotBlank(message="L'intitulé est obligatoire.")
     */
    private $intitule;

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
    * @ORM\JoinColumn(nullable=true)
    * @ORM\OneToOne(targetEntity="App\Entity\Upload", cascade={"persist", "remove"})
     */
    private $banniere;



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
    * @ORM\JoinColumn(nullable=true)
    * @ORM\OneToOne(targetEntity="App\Entity\Upload", cascade={"persist", "remove"})
     */
    private $vignette;

    /**
     * @var string
     *
     * @ORM\Column(name="couleur", type="string", length=7)
     * @Assert\Length(min=4, minMessage="La couleur doit être au format hexadécimal, et faire au moins {{ limit }} caractères.")
     * @Assert\NotBlank(message="La couleur est obligatoire, et doit être au format hexadécimal.")
     */
    private $couleur;

    /**
     * @var int
     *
     * @ORM\Column(name="ordre", type="integer")
     */
    private $ordre = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="text", nullable=true)
     */
    private $commentaire;
    
    /**
     * @var string
     *
     * @ORM\Column(name="seotitre", type="string", length=250, nullable=true)
     * @Assert\Length(min=2, minMessage="La meta title doit faire au moins {{ limit }} caractères.")
     * @Assert\NotBlank(message="La meta title est obligatoire.")
     */
    private $seotitre;

    /**
     * @var string
     *
     * @ORM\Column(name="seodescription", type="string", length=250, nullable=true)
     * @Assert\Length(min=2, minMessage="La meta description doit faire au moins {{ limit }} caractères.")
     * @Assert\NotBlank(message="La meta description est obligatoire.")
     */
    private $seodescription;

	/**
	* @ORM\OneToMany(targetEntity="App\Entity\TarifVenteTheme", mappedBy="theme", cascade={"persist", "remove"})
	*/
	private $tarifsvente;

	/**
	* @ORM\OneToMany(targetEntity="App\Entity\TarifVenteThemeIntra", mappedBy="theme", cascade={"persist", "remove"})
	*/
	private $tarifsventeintra;

	/**
    * @ORM\ManyToOne(targetEntity="App\Entity\TarifVenteTheme")
	*/
	private $tarifventedefaut;

	/**
    * @ORM\ManyToOne(targetEntity="App\Entity\TarifVenteThemeIntra")
	*/
	private $tarifventeintradefaut;
    
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
     * @return Theme
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
     * @return Theme
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
     * @return Theme
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
     * Set intitule
     *
     * @param string $intitule
     *
     * @return Theme
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
     * Set altBanniere
     *
     * @param string $altBanniere
     *
     * @return Theme
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
     * @return Theme
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
     * Set couleur
     *
     * @param string $couleur
     *
     * @return Theme
     */
    public function setCouleur($couleur)
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * Get couleur
     *
     * @return string
     */
    public function getCouleur()
    {
        return $this->couleur;
    }

    /**
     * Set ordre
     *
     * @param integer $ordre
     *
     * @return Theme
     */
    public function setOrdre($ordre)
    {
        $this->ordre = $ordre;

        return $this;
    }

    /**
     * Get ordre
     *
     * @return integer
     */
    public function getOrdre()
    {
        return $this->ordre;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return Theme
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
     * Set seotitre
     *
     * @param string $seotitre
     *
     * @return Theme
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
     * @return Theme
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
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return Theme
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
     * @return Theme
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
     * Add sousthemetheme
     *
     * @param \App\Entity\SousThemeTheme $sousthemetheme
     *
     * @return Theme
     */
    public function addSousthemetheme(\App\Entity\SousThemeTheme $sousthemetheme)
    {
        $this->sousthemetheme[] = $sousthemetheme;
        $sousthemetheme->setTheme($this);
        return $this;
    }

    /**
     * Remove sousthemetheme
     *
     * @param \App\Entity\SousThemeTheme $sousthemetheme
     */
    public function removeSousthemetheme(\App\Entity\SousThemeTheme $sousthemetheme)
    {
        $this->sousthemetheme->removeElement($sousthemetheme);
    }

    /**
     * Get sousthemetheme
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSousthemetheme()
    {
        return $this->sousthemetheme;
    }

      /**
     * Set banniere
     * @param \App\Entity\Upload $banniere
     * @return Theme
     */
    public function setBanniere(\App\Entity\Upload $banniere = null)
    {
        $this->banniere = $banniere;
        $this->banniere->setDirectoryUpload($this->getDirectoryUploadbanniere());
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
     * @return Theme
     */
    public function setVignette(\App\Entity\Upload $vignette = null)
    {
        $this->vignette = $vignette;
        $this->vignette->setDirectoryUpload($this->getDirectoryUploadvignette());
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
     * @return Theme
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
     * @return Theme
     */
    public function setFilevignette($filevignette)
    {
        $this->filevignette = $filevignette;

        return $this;
    }

    /**
     * Add tarifsvente
     *
     * @param \App\Entity\TarifVenteTheme $tarifsvente
     *
     * @return Theme
     */
    public function addTarifsvente(\App\Entity\TarifVenteTheme $tarifsvente)
    {
        $this->tarifsvente[] = $tarifsvente;
		$tarifsvente->setTheme($this);
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
     * Set tarifventedefaut
     *
     * @param \App\Entity\TarifVenteTheme $tarifventedefaut
     *
     * @return Theme
     */
    public function setTarifventedefaut(\App\Entity\TarifVenteTheme $tarifventedefaut = null)
    {
        $this->tarifventedefaut = $tarifventedefaut;

        return $this;
    }

    /**
     * Get tarifventedefaut
     *
     * @return \App\Entity\TarifVenteTheme
     */
    public function getTarifventedefaut()
    {
        return $this->tarifventedefaut;
    }

    /**
     * Set tarifventeintradefaut
     *
     * @param \App\Entity\TarifVenteThemeIntra $tarifventeintradefaut
     *
     * @return Theme
     */
    public function setTarifventeintradefaut(\App\Entity\TarifVenteThemeIntra $tarifventeintradefaut = null)
    {
        $this->tarifventeintradefaut = $tarifventeintradefaut;

        return $this;
    }

    /**
     * Get tarifventeintradefaut
     *
     * @return \App\Entity\TarifVenteThemeIntra
     */
    public function getTarifventeintradefaut()
    {
        return $this->tarifventeintradefaut;
    }

    /**
     * Add tarifsventeintra
     *
     * @param \App\Entity\TarifVenteThemeIntra $tarifsventeintra
     *
     * @return Theme
     */
    public function addTarifsventeintra(\App\Entity\TarifVenteThemeIntra $tarifsventeintra)
    {
        $this->tarifsventeintra[] = $tarifsventeintra;
		$tarifsventeintra->setTheme($this);
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

	public function getTarifVenteActuel()
	{
		if(count($this->getTarifsvente())==0){
			return $this->getTarifventedefaut();
		}

		$datedujour=new \DateTime();
		$datedujour->setTime(0,0);

		// retourne le tarif dans les dates actuelles
		foreach($this->getTarifsvente() as $tarif)
		{
			if($tarif->getDatedebut()<=$datedujour && ($tarif->getDatefin()>=$datedujour || is_null($tarif->getDatefin()))){
				return $tarif;
			}
		}

		return $this->getTarifventedefaut();
	}

	public function getTarifVenteIntraActuel()
	{
		if(count($this->getTarifsventeintra())==0){
			return $this->getTarifventeintradefaut();
		}

		$datedujour=new \DateTime();
		$datedujour->setTime(0,0);

		// retourne le tarif dans les dates actuelles
		foreach($this->getTarifsventeintra() as $tarif)
		{
			if($tarif->getDatedebut()<=$datedujour && ($tarif->getDatefin()>=$datedujour || is_null($tarif->getDatefin()))){
				return $tarif;
			}
		}

		return $this->getTarifventeintradefaut();
	}

    /**
     * Set path
     *
     * @param string $path
     *
     * @return Theme
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
}
