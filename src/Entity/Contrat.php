<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * Contrat
 *
 * @ORM\Table(name="contrat")
 * @ORM\Entity(repositoryClass="App\Repository\ContratRepository")
 */
class Contrat
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Societe")
     */
    private $societe;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Entreprise")
     */
    private $entreprise;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date", nullable=true)
     */
    private $debutvalidite;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date", nullable=true)
     */
    private $finvalidite;

    /**
     *
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
     */
    private $typecontrat;

    /**
     @ORM\ManyToMany(targetEntity="App\Entity\Theme", cascade={"persist"})
     */
    private $themes;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $statut;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Formateur", inversedBy="contrats",cascade={"persist"})
     * @ORM\JoinColumn(name="formateur_id", nullable=true, onDelete="CASCADE" )
     */
    private $formateur;

    /**
     * @var string
     *
     * @ORM\Column(name="refcontrat", type="text", nullable=true)
     */
    private $refcontrat;

    /**
     * @var string
     *
     * @ORM\Column(name="duree", type="text", nullable=true)
     */
    private $duree;

    /**
     * @var string
     *
     * @ORM\Column(name="tarif", type="text", nullable=true)
     */
    private $tarif;

    /**
    * @ORM\JoinColumn(nullable=true)
    * @ORM\OneToOne(targetEntity="App\Entity\Upload", cascade={"persist", "remove"})
     */
    private $signaturefile;
    
    /**
     *
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
     */
    private $objet;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="text", nullable=true)
     */
    private $commentaire;

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
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $signature;

    /** 
     * 
     * @ORM\OneToMany(targetEntity="App\Entity\ModuleContrat", mappedBy="contrat")
     */
    private $modulecontrats ;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
     */
    private $receptiondocs;

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
     * Constructor
     */
    public function __construct()
    {
        $this->themes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->modulecontrats = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set debutvalidite.
     *
     * @param \DateTime|null $debutvalidite
     *
     * @return Contrat
     */
    public function setDebutvalidite($debutvalidite = null)
    {
        $this->debutvalidite = $debutvalidite;

        return $this;
    }

    /**
     * Get debutvalidite.
     *
     * @return \DateTime|null
     */
    public function getDebutvalidite()
    {
        return $this->debutvalidite;
    }

    /**
     * Set finvalidite.
     *
     * @param \DateTime|null $finvalidite
     *
     * @return Contrat
     */
    public function setFinvalidite($finvalidite = null)
    {
        $this->finvalidite = $finvalidite;

        return $this;
    }

    /**
     * Get finvalidite.
     *
     * @return \DateTime|null
     */
    public function getFinvalidite()
    {
        return $this->finvalidite;
    }

    /**
     * Set refcontrat.
     *
     * @param string|null $refcontrat
     *
     * @return Contrat
     */
    public function setRefcontrat($refcontrat = null)
    {
        $this->refcontrat = $refcontrat;

        return $this;
    }

    /**
     * Get refcontrat.
     *
     * @return string|null
     */
    public function getRefcontrat()
    {
        return $this->refcontrat;
    }

    /**
     * Set commentaire.
     *
     * @param string|null $commentaire
     *
     * @return Contrat
     */
    public function setCommentaire($commentaire = null)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire.
     *
     * @return string|null
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set dateinsert.
     *
     * @param \DateTime|null $dateinsert
     *
     * @return Contrat
     */
    public function setDateinsert($dateinsert = null)
    {
        $this->dateinsert = $dateinsert;

        return $this;
    }

    /**
     * Get dateinsert.
     *
     * @return \DateTime|null
     */
    public function getDateinsert()
    {
        return $this->dateinsert;
    }

    /**
     * Set dateupdate.
     *
     * @param \DateTime|null $dateupdate
     *
     * @return Contrat
     */
    public function setDateupdate($dateupdate = null)
    {
        $this->dateupdate = $dateupdate;

        return $this;
    }

    /**
     * Get dateupdate.
     *
     * @return \DateTime|null
     */
    public function getDateupdate()
    {
        return $this->dateupdate;
    }

    /**
     * Set societe.
     *
     * @param \App\Entity\Societe|null $societe
     *
     * @return Contrat
     */
    public function setSociete(\App\Entity\Societe $societe = null)
    {
        $this->societe = $societe;

        return $this;
    }

    /**
     * Get societe.
     *
     * @return \App\Entity\Societe|null
     */
    public function getSociete()
    {
        return $this->societe;
    }

    /**
     * Set entreprise.
     *
     * @param \App\Entity\Entreprise|null $entreprise
     *
     * @return Contrat
     */
    public function setEntreprise(\App\Entity\Entreprise $entreprise = null)
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    /**
     * Get entreprise.
     *
     * @return \App\Entity\Entreprise|null
     */
    public function getEntreprise()
    {
        return $this->entreprise;
    }

    /**
     * Set typecontrat.
     *
     * @param \App\Entity\Masterlistelg|null $typecontrat
     *
     * @return Contrat
     */
    public function setTypecontrat(\App\Entity\Masterlistelg $typecontrat = null)
    {
        $this->typecontrat = $typecontrat;

        return $this;
    }

    /**
     * Get typecontrat.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getTypecontrat()
    {
        return $this->typecontrat;
    }

    /**
     * Add theme.
     *
     * @param \App\Entity\Theme $theme
     *
     * @return Contrat
     */
    public function addTheme(\App\Entity\Theme $theme)
    {
        $this->themes[] = $theme;

        return $this;
    }

    /**
     * Remove theme.
     *
     * @param \App\Entity\Theme $theme
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeTheme(\App\Entity\Theme $theme)
    {
        return $this->themes->removeElement($theme);
    }

    /**
     * Get themes.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getThemes()
    {
        return $this->themes;
    }

    /**
     * Set statut.
     *
     * @param \App\Entity\Masterlistelg|null $statut
     *
     * @return Contrat
     */
    public function setStatut(\App\Entity\Masterlistelg $statut = null)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set formateur.
     *
     * @param \App\Entity\Formateur|null $formateur
     *
     * @return Contrat
     */
    public function setFormateur(\App\Entity\Formateur $formateur = null)
    {
        $this->formateur = $formateur;

        return $this;
    }

    /**
     * Get formateur.
     *
     * @return \App\Entity\Formateur|null
     */
    public function getFormateur()
    {
        return $this->formateur;
    }

    /**
     * Set objet.
     *
     * @param \App\Entity\Masterlistelg|null $objet
     *
     * @return Contrat
     */
    public function setObjet(\App\Entity\Masterlistelg $objet = null)
    {
        $this->objet = $objet;

        return $this;
    }

    /**
     * Get objet.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getObjet()
    {
        return $this->objet;
    }

    /**
     * Set signature
     *
     * @param string $signature
     *
     * @return Contrat
     */
    public function setSignature($signature)
    {
        $this->signature = $signature;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getSignature()
    {
        return $this->signature;
    }



    public function getDirectoryUploadSignature()
    {
        return strtolower((new \ReflectionClass($this))->getShortName().'-'.'signature');
    }
    /**
     * Set signaturefile
     * @param \App\Entity\Upload $signature
     * @return Contrat
     */
    public function setSignaturefile(\App\Entity\Upload $signaturefile = null)
    {
        $this->signaturefile = $signaturefile;
        $this->signaturefile->setDirectoryUpload($this->getDirectoryUploadSignature());
        return $this;
    }
    /**
     * Get signaturefile
     *
     * @return \App\Entity\Upload
     */
    public function getSignaturefile()
    {
        return $this->signaturefile;
    }

    /**
     * Get modulecontrats
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getModulecontrats()
    {
        return $this->modulecontrats;
    }

    /**
     * Set duree
     *
     * @param string $duree
     *
     * @return Contrat
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree
     *
     * @return string
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * Set tarif
     *
     * @param string $tarif
     *
     * @return Contrat
     */
    public function setTarif($tarif)
    {
        $this->tarif = $tarif;

        return $this;
    }

    /**
     * Get tarif
     *
     * @return string
     */
    public function getTarif()
    {
        return $this->tarif;
    }

    /**
     * Set receptiondocs.
     *
     * @param \App\Entity\Masterlistelg|null $receptiondocs
     *
     * @return FormateurEntreprise
     */
    public function setReceptiondocs(\App\Entity\Masterlistelg $receptiondocs = null)
    {
        $this->receptiondocs = $receptiondocs;

        return $this;
    }

    /**
     * Get receptiondocs.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getReceptiondocs()
    {
        return $this->receptiondocs;
    }
}
