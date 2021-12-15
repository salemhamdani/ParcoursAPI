<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Template
 *
 * @ORM\Table(name="template")
 * @ORM\Entity(repositoryClass="App\Repository\TemplateRepository")
 * 
 */
class Template {

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
     * @ORM\Column(name="nom", type="string", length=256, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="designation", type="text", nullable=true)
     */
    private $designation;


    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=256, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="background", type="string", length=256, nullable=true)
     */
    private $background;

    /**
     * @var string
     *
     * @ORM\Column(name="subtitle", type="string", length=256, nullable=true)
     */
    private $subtitle;

   
    /**
     @ORM\ManyToMany(targetEntity="App\Entity\Motclegraphique", cascade={"persist"})
     */
    private $motclegraphiques;


    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")

    */
    private $codetemplate;


    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")

    */
    private $categorie;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Societe")
    */
    private $societe;
    
    /**
     * @var string
     *
     * @ORM\Column(name="objet", type="text", nullable=true)
     */
    private $objet;
    
    /**
     * @var string
     *
     * @ORM\Column(name="data", type="text", nullable=true)
     */
    private $data;
   
    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
     */
    private $type;

    /**
     * @var bool
     *
     * @ORM\Column(name="stylesociete", type="boolean", nullable=true)
     */
    private $stylesociete;
    
    /**
     * @var bool
     *
     * @ORM\Column(name="default_template", type="boolean", nullable=true)
     */
    private $defaultTemplate;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    private $content;
    
        /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text", nullable=true)
     */
    private $comment;

    /**
     * @var File
     *
     */
     private $file;

    /**
     * @var File
     *
     */
     private $filepage;

        /**
     * @var string
     *
     * @ORM\Column(name="logo", type="text", nullable=true)
     */
    private $logo;
     
        /**
     * @var string
     *
     * @ORM\Column(name="piedpage", type="text", nullable=true)
     */
    private $piedpage;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dataCreation", type="datetime", nullable=true)
     */
    private $dataCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dataUpdated", type="datetime", nullable=true)
     */
    private $dataUpdated;

    /**
     * @var string
     *
     * @ORM\Column(name="cssstyle", type="text", nullable=true)
     */
    private $cssstyle;

    /**
     * @ORM\Column(name="lignecolor", type="text", nullable=true)
    */
    private $lignecolor;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")

    */
    private $fontcontent;
    
    /**
     * @var bool
     *
     * @ORM\Column(name="ligne", type="boolean", nullable=true)
     */
    private $ligne;
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
     * @ORM\Column(name="sizeh1", type="text", nullable=true)
     */
    private $sizeh1;


    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")

    */
    private $fonth1;

    /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Profil", cascade={"persist"})
     * @ORM\JoinColumn(name="profil", nullable=true)
     */
    private $profil;

    /**
     @ORM\ManyToMany(targetEntity="App\Entity\Masterlistelg",  cascade={"persist"} )
     */
    private $diffusions;

    function __construct() {

        $this->dataCreation = new \DateTime();

        $this->diffusions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Template
     */
    public function setNom($nom) {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom() {
        return $this->nom;
    }

    /**
     * Set designation
     *
     * @param string $designation
     *
     * @return Template
     */
    public function setDesignation($designation) {
        $this->designation = $designation;

        return $this;
    }

    /**
     * Get designation
     *
     * @return string
     */
    public function getDesignation() {
        return $this->designation;
    }
    


    /**
     * Set title
     *
     * @param string $title
     *
     * @return Template
     */
    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }


    /**
     * Set fontcontent
     *
     * @param \App\Entity\Masterlistelg $fontcontent
     *
     * @return Societe
     */
    public function setFontcontent(\App\Entity\Masterlistelg $fontcontent = null)
    {
        $this->fontcontent = $fontcontent;

        return $this;
    }

    /**
     * Get fontcontent
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getFontcontent()
    {
        return $this->fontcontent;
    }


 
    /**
     * Set background
     *
     * @param string $background
     *
     * @return Template
     */
    public function setBackground($background) {
        $this->background = $background;

        return $this;
    }

    /**
     * Get background
     *
     * @return string
     */
    public function getBackground() {
        return $this->background;
    }
    /**
     * Set subtitle
     *
     * @param string $subtitle
     *
     * @return Template
     */
    public function setSubtitle($subtitle) {
        $this->subtitle = $subtitle;

        return $this;
    }

    /**
     * Get subtitle
     *
     * @return string
     */
    public function getSubtitle() {
        return $this->subtitle;
    }


    /**
     * Set nom
     *
     * @param string $objet
     *
     * @return Template
     */
    public function setObjet($objet) {
        $this->objet = $objet;

        return $this;
    }

    /**
     * Get objet
     *
     * @return string
     */
    public function getObjet() {
        return $this->objet;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Template
     */
    public function setContent($content) {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent() {
        return $this->content;
    }
    
        /**
     * Set comment
     *
     * @param string $comment
     *
     * @return Template
     */
    public function setComment($comment) {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment() {
        return $this->comment;
    }

    /**
     * Set archive
     *
     * @param boolean $archive
     *
     * @return Template
     */
    public function setArchive($archive) {
        $this->archive = $archive;

        return $this;
    }

    /**
     * Get archive
     *
     * @return boolean
     */
    public function getArchive() {
        return $this->archive;
    }

    /**
     * Set dataCreation
     *
     * @param \DateTime $dataCreation
     * ORM\PrePersist
     * @return Template
     */
    public function setDataCreation()
    {
        $this->dataCreation = new \DateTime();

        return $this;
    }

    /**
     * Get dataCreation
     *
     * @return \DateTime
     */
    public function getDataCreation()
    {
        return $this->dataCreation;
    }

    /**
     * Set dataUpdated
     *
     * @param \DateTime $dataUpdated
     *
     * @return Template
     */
    public function setDataUpdated($dataUpdated)
    {
        $this->dataUpdated = $dataUpdated;

        return $this;
    }

    /**
     * Get dataUpdated
     *
     * @return \DateTime
     */
    public function getDataUpdated()
    {
        return $this->dataUpdated;
    }

    /**
     * Set type
     *
     * @param \App\Entity\Masterlistelg $type
     *
     * @return Template
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
     * Set data
     *
     * @param array $data
     *
     * @return Template
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return string
     */
    public function getData()
    {
        return explode(",", $this->data);
    }

    /**
     * Set defaultTemplate
     *
     * @param boolean $defaultTemplate
     *
     * @return Template
     */
    public function setDefaultTemplate($defaultTemplate)
    {
        $this->defaultTemplate = $defaultTemplate;

        return $this;
    }

    /**
     * Get defaultTemplate
     *
     * @return boolean
     */
    public function getDefaultTemplate()
    {
        return $this->defaultTemplate;
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
     * Add motclegraphique
     *
     * @param \App\Entity\Motclegraphique $motclegraphique
     *
     * @return Template
     */
    public function addMotclegraphique(\App\Entity\Motclegraphique $motclegraphique)
    {
        $this->motclegraphiques[] = $motclegraphique;

        return $this;
    }

    /**
     * Remove motclegraphique
     *
     * @param \App\Entity\Motclegraphique $liste
     */
    public function removeMotclegraphique(\App\Entity\Motclegraphique $motclegraphique)
    {
        $this->motclegraphiques->removeElement($motclegraphique);
    }

    /**
     * Get motclegraphiques
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMotclegraphiques()
    {
        return $this->motclegraphiques;
    }


    /**
     * Set codetemplate
     *
     * @param \App\Entity\Masterlistelg $codetemplate
     *
     * @return Template
     */
    public function setCodetemplate(\App\Entity\Masterlistelg $codetemplate = null)
    {
        $this->codetemplate = $codetemplate;

        return $this;
    }

    /**
     * Get codetemplate
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getCodetemplate()
    {
        return $this->codetemplate;
    }

    /**
     * Set categorie
     *
     * @param \App\Entity\Masterlistelg $categorie
     *
     * @return Template
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
     * Set societe
     *
     * @param \App\Entity\Societe $societe
     *
     * @return Template
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
     * Set profil
     *
     * @param \App\Entity\Profil $profil
     *
     * @return Template
     */
    public function setProfil(\App\Entity\Profil $profil = null)
    {
        $this->profil = $profil;

        return $this;
    }

    /**
     * Get Profil
     *
     * @return \App\Entity\Profil
     */
    public function getProfil()
    {
        return $this->profil;
    }


    /**
     * Set cssstyle
     *
     * @param string $cssstyle
     *
     * @return Template
     */
    public function setCssstyle($cachet)
    {
        $this->cachet = $cachet;

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
     * Set stylesociete
     *
     * @param boolean $stylesociete
     *
     * @return Template
     */
    public function setStylesociete($stylesociete) {
        $this->stylesociete = $stylesociete;

        return $this;
    }

    /**
     * Get stylesociete
     *
     * @return boolean
     */
    public function getStylesociete() {
        return $this->stylesociete;
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
     * Set fonth1
     *
     * @param \App\Entity\Masterlistelg $fonth1
     *
     * @return Template
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
     * Set widthlogoheader
     *
     * @param integer $widthlogoheader
     *
     * @return Template
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
     * @return Template
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
     * @return Template
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
     * @return Template
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
     * Set sizeh1
     *
     * @param string $sizeh1
     *
     * @return Template
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
    } /**
     * Add diffusion
     *
     * @param \App\Entity\Masterlistelg $diffusion
     *
     * @return Contentsection
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


}
