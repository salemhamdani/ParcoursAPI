<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Certification
 *
 * @ORM\Table(name="certification")
 * @ORM\Entity(repositoryClass="App\Repository\CertificationRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Certification {

    /**
     * @ORM\PrePersist
     */
    public function ajout() {
        $this->dateinscription = new \DateTime();
    }

    /**
     * @ORM\PreUpdate
     */
    public function modification() {
        $this->datemodification = new \DateTime();
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
     * @ORM\Column(name="intitule", type="string", length=250)
     */
    private $intitule;

    /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Editeur", cascade={"persist"})
     * @ORM\JoinColumn(name="editeur")
     */
    private $editeur;

    /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Theme", cascade={"persist"})
     * @ORM\JoinColumn(name="theme")
     */
    private $theme;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ModeFormation", inversedBy="certifications", cascade={"persist"})
     * @ORM\JoinColumn(name="mode_formation", nullable=true )
     */

    private $modeFormation;

	/**
     * @ORM\OneToOne(targetEntity="App\Entity\Article", inversedBy="certification")
     */
    private $article;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=15, nullable=true)
     */
    private $code;
    
            /**
     * @var bool
     *
     * @ORM\Column(name="cpf", type="boolean")
     */
    private $cpf = false;

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
     * @ORM\Column(name="commentaire", type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @var string
     *
     * @ORM\Column(name="programme", type="text")
     * @Assert\Length(min=2, minMessage="Le programme doit faire au moins {{ limit }} caractères.")
     * @Assert\NotBlank(message="Le programme est obligatoire.")
     */
    private $programme;

    /**
     * @var string
     *
     * @ORM\Column(name="objectif", type="text")
     * @Assert\Length(min=2, minMessage="L'objectif doit faire au moins {{ limit }} caractères.")
     * @Assert\NotBlank(message="L'objectif est obligatoire.")
     */
    private $objectif;

    /**
     * @var string
     *
     * @ORM\Column(name="certification", type="text")
     * @Assert\Length(min=2, minMessage="La certification doit faire au moins {{ limit }} caractères.")
     * @Assert\NotBlank(message="La certification est obligatoire.")
     */
    private $certification;

    /**
     * @var int
     *
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $duree = 0;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $tarifvente;

    /**
     * @var bool
     *
     * @ORM\Column(name="archive", type="boolean")
     */
    private $archive = false;
    
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateinscription", type="datetime", nullable=true)
     */
    private $dateinscription;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datemodification", type="datetime", nullable=true)
     */
    private $datemodification;
    
    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=256, nullable=true)
     */
    private $path;


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
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set intitule
     *
     * @param string $intitule
     *
     * @return Certification
     */
    public function setIntitule($intitule) {
        $this->intitule = $intitule;

        return $this;
    }

    /**
     * Get intitule
     *
     * @return string
     */
    public function getIntitule() {
        return $this->intitule;
    }

    /**
     * Set cpf
     *
     * @param boolean $cpf
     *
     * @return Certification
     */
    public function setCpf($cpf) {
        $this->cpf = $cpf;

        return $this;
    }

    /**
     * Get cpf
     *
     * @return bool
     */
    public function getCpf() {
        return $this->cpf;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Certification
     */
    public function setCode($code) {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode() {
        return $this->code;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return Certification
     */
    public function setCommentaire($commentaire) {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string
     */
    public function getCommentaire() {
        return $this->commentaire;
    }

    /**
     * Set programme
     *
     * @param string $programme
     *
     * @return Certification
     */
    public function setProgramme($programme) {
        $this->programme = $programme;

        return $this;
    }

    /**
     * Get programme
     *
     * @return string
     */
    public function getProgramme() {
        return $this->programme;
    }

    /**
     * Set objectif
     *
     * @param string $objectif
     *
     * @return Certification
     */
    public function setObjectif($objectif) {
        $this->objectif = $objectif;

        return $this;
    }

    /**
     * Get objectif
     *
     * @return string
     */
    public function getObjectif() {
        return $this->objectif;
    }

    /**
     * Set certification
     *
     * @param string $certification
     *
     * @return Certification
     */
    public function setCertification($certification) {
        $this->certification = $certification;

        return $this;
    }

    /**
     * Get certification
     *
     * @return string
     */
    public function getCertification() {
        return $this->certification;
    }

    /**
     * Set archive
     *
     * @param boolean $archive
     *
     * @return Certification
     */
    public function setArchive($archive) {
        $this->archive = $archive;

        return $this;
    }

    /**
     * Get archive
     *
     * @return bool
     */
    public function getArchive() {
        return $this->archive;
    }

    /**
     * Set dateinscription
     *
     * @param \DateTime $dateinscription
     *
     * @return Certification
     */
    public function setDateinscription($dateinscription) {
        $this->dateinscription = $dateinscription;

        return $this;
    }

    /**
     * Get dateinscription
     *
     * @return \DateTime
     */
    public function getDateinscription() {
        return $this->dateinscription;
    }

    /**
     * Set datemodification
     *
     * @param \DateTime $datemodification
     *
     * @return Certification
     */
    public function setDatemodification($datemodification) {
        $this->datemodification = $datemodification;

        return $this;
    }

    /**
     * Get datemodification
     *
     * @return \DateTime
     */
    public function getDatemodification() {
        return $this->datemodification;
    }


    /**
     * Set editeur
     *
     * @param \App\Entity\Editeur $editeur
     *
     * @return Certification
     */
    public function setEditeur(\App\Entity\Editeur $editeur = null)
    {
        $this->editeur = $editeur;

        return $this;
    }

    /**
     * Get editeur
     *
     * @return \App\Entity\Editeur
     */
    public function getEditeur()
    {
        return $this->editeur;
    }

    /**
     * Set theme
     *
     * @param \App\Entity\Theme $theme
     *
     * @return Certification
     */
    public function setTheme(\App\Entity\Theme $theme = null)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return \App\Entity\Theme
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Set seotitre
     *
     * @param string $seotitre
     *
     * @return Certification
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
     * @return Certification
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
     * Set autoriteDelivranceCpf
     *
     * @param App\Entity\Delivrance $autoriteDelivranceCpf
     *
     * @return Certification
     */
    public function setAutoriteDelivranceCpf(\App\Entity\Delivrance $autoriteDelivranceCpf = null)
    {
        $this->autoriteDelivranceCpf = $autoriteDelivranceCpf;

        return $this;
    }

    /**
     * Get autoriteDelivranceCpf
     *
     * @return App\Entity\Delivrance
     */
    public function getAutoriteDelivranceCpf()
    {
        return $this->autoriteDelivranceCpf;
    }


    /**
     * Set codecpf
     *
     * @param string $codecpf
     *
     * @return Certification
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
     * @return Certification
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
     * @return Certification
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
     * Set modeFormation
     *
     * @param \App\Entity\ModeFormation $modeFormation
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
     * @return \App\Entity\Entity\ModeFormation
     */
    public function getModeFormation()
    {
        return $this->modeFormation;
    }

    /**
     * Set article
     *
     * @param \App\Entity\Article $article
     *
     * @return Certification
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
     * @return Certification
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
     * @return Certification
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
     * Set tarifvente.
     *
     * @param string|null $tarifvente
     *
     * @return Certification
     */
    public function setTarifvente($tarifvente = null)
    {
        $this->tarifvente = $tarifvente;

        return $this;
    }

    /**
     * Get tarifvente.
     *
     * @return string|null
     */
    public function getTarifvente()
    {
        return $this->tarifvente;
    }

    /**
     * Set duree.
     *
     * @param string $duree
     *
     * @return Certification
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree.
     *
     * @return string
     */
    public function getDuree()
    {
        return $this->duree;
    }
    
    /**
     * Set contenuapres
     *
     * @param string $contenuapres
     *
     * @return Certification
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
     * @return Certification
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
