<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * Dossier
 *
 * @ORM\Table(name="dossiers")
 * @ORM\Entity(repositoryClass="App\Repository\DossierRepository")
 */
class Dossier
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->dossiermodules = new \Doctrine\Common\Collections\ArrayCollection();
        $this->documents = new \Doctrine\Common\Collections\ArrayCollection();
        $this->deviss = new \Doctrine\Common\Collections\ArrayCollection();
        $this->avertissements = new \Doctrine\Common\Collections\ArrayCollection();
        $this->archive = false;
        $this->stagiaireexiste = false;
        $this->candidatexiste = false;
        $this->postulantExiste = false;
        $this->prospectExiste = false;
        $this->dossiergroupe = false;
        $this->activeClassroom = false;
        $this->delegueclasse = false;
        $this->islocked = false;
        $this->diplomant = false;
        $this->cursuss = new \Doctrine\Common\Collections\ArrayCollection();
        $this->participation = 0;
        $this->participationreglee = 0;
        $this->caution = 0;
        $this->dateinsert = new \DateTime();
        $this->conventions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->reunions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->financements = new \Doctrine\Common\Collections\ArrayCollection();
        $this->dossierfinanceurs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->datedebutcalendrier = new \DateTime();
        $this->datefincalendrier = new \DateTime();
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
     * @ORM\Column(name="reference", type="string", length=255, nullable=true)
     */
    private $reference;

    /**
     * @var string
     *
     * @ORM\Column(name="referenceclassroom", type="string", length=255, nullable=true)
     */
    private $referenceclassroom;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\SessionDossier", mappedBy="dossier", cascade={"persist"})
     */
    private $sessiondossier;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Stagiaire", mappedBy="dossier", cascade={"persist"})
     */
    private $stagiaire;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Candidat", mappedBy="dossier", cascade={"persist"})
     */
    private $candidat;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Alumni", mappedBy="dossier", cascade={"persist"})
     */
    private $alumni;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $participation;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $participationreglee;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $caution;

    /**
    * @ORM\ManyToMany(targetEntity="App\Entity\Devis", inversedBy="dossiers")
    */
    private $devisentreprises;

    /**
    * @ORM\ManyToMany(targetEntity="App\Entity\DevisLigne", inversedBy="dossiers")
    */
    private $devisligneentreprises;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $delegueclasse;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $stagiaireexiste;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $activeClassroom;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $allumiv1= false;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $candidatexiste;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $postulantExiste;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $prospectExiste;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $confirmeinscription = false;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Employe", inversedBy="referentpedagogiques")
    */
    private $referentpedagogique;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Employe", inversedBy="dossierreorienters")
    */
    private $reorienter;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Employe", inversedBy="referentcommercials")
    */
    private $referentcommercial;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Employe", inversedBy="referentcoachs")
    */
    private $referentcoach;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Societe", inversedBy="dossier")
    */
    private $societe;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\Contratapprenant", mappedBy="dossier",cascade={"persist","remove"})
    */
    private $contrats;
    
    /**
    * @ORM\OneToMany(targetEntity="App\Entity\Historiquestatut", mappedBy="dossier",cascade={"persist","remove"})
    */
    private $historiquestatuts;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\ListeDiffusion", mappedBy="dossier",cascade={"persist","remove"})
    */
    private $listediffusions;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\Avertissement", mappedBy="dossier",cascade={"persist","remove"})
    */
    private $avertissements;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Employe", inversedBy="referentadministratifs")
    */
    private $referentadministratif;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Personne", inversedBy="dossiers")
    */
    private $personne; 

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Entreprise", inversedBy="dossiers")
     */
    private $entreprise;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Contact")
     */
    private $entreprisecontact;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\PersonneDocument", mappedBy="dossier",cascade={"persist"})
    */
    private $documents;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\Reglement", mappedBy="dossier", orphanRemoval=true, cascade={"persist","remove"})
    */
    private $reglements;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\Financement", mappedBy="dossier",cascade={"persist"})
    */
    private $financements; 

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\DossierFinanceur", mappedBy="dossier",cascade={"persist"})
    */
    private $dossierfinanceurs;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\FinanceurEntreprise", mappedBy="dossier",cascade={"persist"})
    */
    private $financeurentreprises;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $autofinancement = false;


    /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Profil", cascade={"persist"})
     */
    private $profil;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\DossierModule", orphanRemoval=true, mappedBy="dossier",cascade={"persist"})
     */
    private $dossiermodules;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $typeformation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date", nullable=true)
     */
    private $debutcontrat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date", nullable=true)
     */
    private $fincontrat;

    /**
     * @var string
     *
     * @ORM\Column(name="statut_juriqique", type="string", length=20, nullable=true)
     */
    private $statutJuriqique;

    /**
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $rsa;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="date", nullable=true)
     */
    private $dateDebut;

    /**
    * @ORM\OneToOne(targetEntity="App\Entity\PersonalInformations",  cascade={"all"})
    */
    private $personalinformations;

    /**
    * @ORM\OneToOne(targetEntity="App\Entity\Dossierannexes",  cascade={"all"})
    */
    private $dossierannexes;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $archive;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean",nullable=true)
     */
    private $islocked;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean",nullable=true)
     */
    private $diplomant;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\User")
    */
    private $quilock;

    /**
     * @ORM\Column(type="datetime", nullable=true)
    */
    private $datelock;

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
    private $state ;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $statepoleemploi ;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Employe")
    */
    private $referentdevis ;
    
    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $affecte = false;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $typeactif;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $typeprog;
    
    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $typedossier;
    
    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $nonretenu;

    /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Parcours", cascade={"persist"})
     * @ORM\JoinColumn(name="parcours", nullable=true)
     */
    private $parcours;
    

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @var int
     *
     * @ORM\Column(name="parcoursclassrooms", type="integer", nullable=true)
     */
    private $parcoursclassrooms;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $dispositif;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $dossiergroupe;
    
    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $newsletter;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\Devis", mappedBy="dossier",cascade={"persist"})
    */
    private $deviss;


    /**
    * @ORM\JoinColumn(nullable=true)
    * @ORM\OneToOne(targetEntity="App\Entity\Upload", cascade={"persist", "remove"})
     */
    private $cv;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\Cursus", mappedBy="dossier",cascade={"persist"})
    */
    private $cursuss;

    /**
     * @var float
     *
     * @ORM\Column(name="repas", type="boolean", nullable=true)
     */
    private $repas;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\DossierMentor", mappedBy="dossier", orphanRemoval=true, cascade={"persist"})
    */
    private $mentors;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\Entretien", mappedBy="dossier",cascade={"persist"})
    */
    private $entretien;

    /**
     * @var string
     *
     * @ORM\Column(name="pourcentage", type="string", length=255, nullable=true)
     */
    private $pourcentage;

    /**
     * @var string
     *
     * @ORM\Column(name="verifdocuments", type="text", nullable=true)
     */
    private $verifdocuments;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateabondant ;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datedebutcalendrier ;

    /**
     * @var string
     *
     * @ORM\Column(name="dureecalendrier", type="string", length=255, nullable=true)
     */
    private $dureecalendrier;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datefincalendrier ;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateradiation;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $motifrefus;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $causeabandon;

    /**
     * @var string
     *
     * @ORM\Column(name="signature", type="text", nullable=true)
     */
    private $signature;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\Convention", mappedBy="dossier",cascade={"persist"})
    */
    private $conventions;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\Reunions", mappedBy="dossier",cascade={"persist"})
    */
    private $reunions;

    /**
     * @var string|null
     *
     * @ORM\Column(name="items", type="text",  nullable=true)
     */
    private $items;

    /**
     * @var string|null
     *
     * @ORM\Column(name="itempes", type="text",  nullable=true)
     */
    private $itempes; //items Pole Emploi

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateconfirminscription ;
    
    /**
     * @var File
     *
     */
     private $file;


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
     * Set reference
     *
     * @param string $reference
     *
     * @return Dossier
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set referenceclassroom
     *
     * @param string $referenceclassroom
     *
     * @return Dossier
     */
    public function setReferenceclassroom($referenceclassroom)
    {
        $this->referenceclassroom = $referenceclassroom;

        return $this;
    }

    /**
     * Get referenceclassroom
     *
     * @return string
     */
    public function getReferenceclassroom()
    {
        return $this->referenceclassroom;
    }

    /**
     * Set archive
     *
     * @param boolean $archive
     *
     * @return Dossier
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
     * Set state
     *
     * @param \App\Entity\Masterlistelg $state
     *
     * @return Dossier
     */
    public function setState(\App\Entity\Masterlistelg $state = null)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getState()
    {
        return $this->state;
    }




    /**
     * Set statepoleemploi
     *
     * @param \App\Entity\Masterlistelg $statepoleemploi
     *
     * @return Dossier
     */
    public function setStatepoleemploi(\App\Entity\Masterlistelg $statepoleemploi = null)
    {
        $this->statepoleemploi = $statepoleemploi;

        return $this;
    }

    /**
     * Get statepoleemploi
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getStatepoleemploi()
    {
        return $this->statepoleemploi;
    }


    /**
     * Set reorienter
     *
     * @param \App\Entity\Employe $reorienter
     *
     * @return Dossier
     */
    public function setReorienter(\App\Entity\Employe $reorienter = null)
    {
        $this->reorienter = $reorienter;

        return $this;
    }

    /**
     * Get reorienter
     *
     * @return \App\Entity\Employe
     */
    public function getReorienter()
    {
        return $this->reorienter;
    }


    /**
     * Set affecte
     *
     * @param boolean $affecte
     *
     * @return Dossier
     */
    public function setAffecte($affecte)
    {
        $this->affecte = $affecte;

        return $this;
    }

    /**
     * Get affecte
     *
     * @return boolean
     */
    public function getAffecte()
    {
        return $this->affecte;
    }

    /**
     * Set dateinsert
     *
     * @param \DateTime $dateinsert
     *
     * @return Dossier
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
     * Set dateradiation
     *
     * @param \DateTime $dateradiation
     *
     * @return Dossier
     */
    public function setDateradiation($dateradiation)
    {
        $this->dateradiation = $dateradiation;

        return $this;
    }

    /**
     * Get dateradiation
     *
     * @return \DateTime
     */
    public function getDateradiation()
    {
        return $this->dateradiation;
    }

    


    /**
     * Set dateconfirminscription
     *
     * @param \DateTime $dateconfirminscription
     *
     * @return Dossier
     */
    public function setDateconfirminscription($dateconfirminscription)
    {
        $this->dateconfirminscription = $dateconfirminscription;

        return $this;
    }

    /**
     * Get dateconfirminscription
     *
     * @return \DateTime
     */
    public function getDateconfirminscription()
    {
        return $this->dateconfirminscription;
    }

    /**
     * Set dateabondant
     *
     * @param \DateTime $dateabondant
     *
     * @return Dossier
     */
    public function setDateabondant($dateabondant)
    {
        $this->dateabondant = $dateabondant;

        return $this;
    }

    /**
     * Get dateabondant
     *
     * @return \DateTime
     */
    public function getDateabondant()
    {
        return $this->dateabondant;
    }
 

    /**
     * Set datedebutcalendrier
     *
     * @param \DateTime $datedebutcalendrier
     *
     * @return Dossier
     */
    public function setDatedebutcalendrier($datedebutcalendrier)
    {
        $this->datedebutcalendrier = $datedebutcalendrier;

        return $this;
    }

    /**
     * Get datedebutcalendrier
     *
     * @return \DateTime
     */
    public function getDatedebutcalendrier()
    {
        return $this->datedebutcalendrier;
    }



    /**
     * Set dureecalendrier
     *
     * @param string|null $dureecalendrier
     *
     * @return Dossier
     */
    public function setDureecalendrier($dureecalendrier)
    {
        $this->dureecalendrier = $dureecalendrier;

        return $this;
    }

    /**
     * Get dureecalendrier
     *
     * @return string|null
     */
    public function getDureecalendrier()
    {
        return $this->dureecalendrier;
    }
    
    /**
     * Set datefincalendrier
     *
     * @param \DateTime $datefincalendrier
     *
     * @return Dossier
     */
    public function setDatefincalendrier($datefincalendrier)
    {
        $this->datefincalendrier = $datefincalendrier;

        return $this;
    }

    /**
     * Get datefincalendrier
     *
     * @return \DateTime
     */
    public function getDatefincalendrier()
    {
        return $this->datefincalendrier;
    }
    
    /**
     * Set dateupdate
     *
     * @param \DateTime $dateupdate
     *
     * @return Dossier
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
     * Set typeformation
     *
     * @param \App\Entity\Masterlistelg $typeformation
     *
     * @return Dossier
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
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return Dossier
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set entreprise
     *
     * @param \App\Entity\Entreprise $entreprise
     *
     * @return Dossier
     */
    public function setEntreprise(\App\Entity\Entreprise $entreprise = null)
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    /**
     * Get entreprise
     *
     * @return \App\Entity\Entreprise
     */
    public function getEntreprise()
    {
        return $this->entreprise;
    }
    /**
     * Set allumiv1
     *
     * @param boolean $allumiv1
     *
     * @return Dossier
     */
    public function setAllumiv1($allumiv1)
    {
        $this->allumiv1 = $allumiv1;

        return $this;
    }

    /**
     * Get allumiv1
     *
     * @return boolean
     */
    public function getAllumiv1()
    {
        return $this->allumiv1;
    }

    /**
     * Set activeClassroom
     *
     * @param boolean $activeClassroom
     *
     * @return Dossier
     */
    public function setActiveClassroom($activeClassroom)
    {
        $this->activeClassroom = $activeClassroom;

        return $this;
    }

    /**
     * Get activeClassroom
     *
     * @return boolean
     */
    public function getActiveClassroom()
    {
        return $this->activeClassroom;
    }


    /**
     * Set stagiaireexiste
     *
     * @param boolean $stagiaireexiste
     *
     * @return Dossier
     */
    public function setStagiaireexiste($stagiaireexiste)
    {
        $this->stagiaireexiste = $stagiaireexiste;

        return $this;
    }

    /**
     * Get stagiaireexiste
     *
     * @return boolean
     */
    public function getStagiaireexiste()
    {
        return $this->stagiaireexiste;
    }

    /**
     * Set candidatexiste
     *
     * @param boolean $candidatexiste
     *
     * @return Dossier
     */
    public function setCandidatexiste($candidatexiste)
    {
        $this->candidatexiste = $candidatexiste;

        return $this;
    }

    /**
     * Get candidatexiste
     *
     * @return boolean
     */
    public function getCandidatexiste()
    {
        return $this->candidatexiste;
    }

    /**
     * Set prospectExiste
     *
     * @param boolean $prospectExiste
     *
     * @return Dossier
     */
    public function setProspectExiste($prospectExiste)
    {
        $this->prospectExiste = $prospectExiste;

        return $this;
    }

    /**
     * Get prospectExiste
     *
     * @return boolean
     */
    public function getProspectExiste()
    {
        return $this->prospectExiste;
    }

    /**
     * Set postulantExiste
     *
     * @param boolean $postulantExiste
     *
     * @return Dossier
     */
    public function setPostulantExiste($postulantExiste)
    {
        $this->postulantExiste = $postulantExiste;

        return $this;
    }

    /**
     * Get postulantExiste
     *
     * @return boolean
     */
    public function getPostulantExiste()
    {
        return $this->postulantExiste;
    }

  
    /**
     * Set profil
     *
     * @param \App\Entity\Profil $profil
     *
     * @return Dossier
     */

    public function setProfil(\App\Entity\Profil $profil)
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
     * Set sessiondossier
     *
     * @param \App\Entity\SessionDossier $sessiondossier
     *
     * @return Dossier
     */
    public function setSessiondossier(\App\Entity\SessionDossier $sessiondossier = null)
    {
        $this->sessiondossier = $sessiondossier;
        if(! is_null($sessiondossier))
        $sessiondossier->setDossier($this);
        return $this;
    }

    /**
     * Get sessiondossier
     *
     * @return \App\Entity\SessionDossier
     */
    public function getSessiondossier()
    {
        return $this->sessiondossier;
    }

    /**
     * Set stagiaire
     *
     * @param \App\Entity\Stagiaire $stagiaire
     *
     * @return Dossier
     */
    public function setStagiaire(\App\Entity\Stagiaire $stagiaire = null)
    {
        $this->stagiaire = $stagiaire;

        return $this;
    }

    /**
     * Get stagiaire
     *
     * @return \App\Entity\Stagiaire
     */
    public function getStagiaire()
    {
        return $this->stagiaire;
    }

    /**
     * Set candidat
     *
     * @param \App\Entity\Candidat $candidat
     *
     * @return Dossier
     */
    public function setCandidat(\App\Entity\Candidat $candidat = null)
    {
        $this->candidat = $candidat;

        return $this;
    }

    /**
     * Get candidat
     *
     * @return \App\Entity\Candidat
     */
    public function getCandidat()
    {
        return $this->candidat;
    }




    /**
     * Set alumni
     *
     * @param \App\Entity\Alumni $alumni
     *
     * @return Dossier
     */
    public function setAlumni(\App\Entity\Alumni $alumni = null)
    {
        $this->alumni = $alumni;

        return $this;
    }

    /**
     * Get alumni
     *
     * @return \App\Entity\Alumni
     */
    public function getAlumni()
    {
        return $this->alumni;
    }

    /**
     * Set referentpedagogique
     *
     * @param \App\Entity\Employe $referentpedagogique
     *
     * @return Dossier
     */
    public function setReferentpedagogique(\App\Entity\Employe $referentpedagogique = null)
    {
        $this->referentpedagogique = $referentpedagogique;

        return $this;
    }

    /**
     * Get referentpedagogique
     *
     * @return \App\Entity\Employe
     */
    public function getReferentpedagogique()
    {
        return $this->referentpedagogique;
    }

    /**
     * Set referentcoach
     *
     * @param \App\Entity\Employe $referentcoach
     *
     * @return Dossier
     */
    public function setReferentcoach(\App\Entity\Employe $referentcoach = null)
    {
        $this->referentcoach = $referentcoach;

        return $this;
    }

    /**
     * Get referentcoach
     *
     * @return \App\Entity\Employe
     */
    public function getReferentcoach()
    {
        return $this->referentcoach;
    }

    /**
     * Set referentcommercial
     *
     * @param \App\Entity\Employe $referentcommercial
     *
     * @return Dossier
     */
    public function setReferentcommercial(\App\Entity\Employe $referentcommercial = null)
    {
        $this->referentcommercial = $referentcommercial;

        return $this;
    }

    /**
     * Get referentcommercial
     *
     * @return \App\Entity\Employe
     */
    public function getReferentcommercial()
    {
        return $this->referentcommercial;
    }


    /**
     * Set societe
     *
     * @param \App\Entity\Societe $societe
     *
     * @return Dossier
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
     * Set referentadministratif
     *
     * @param \App\Entity\Employe $referentadministratif
     *
     * @return Dossier
     */
    public function setReferentadministratif(\App\Entity\Employe $referentadministratif = null)
    {
        $this->referentadministratif = $referentadministratif;

        return $this;
    }

    /**
     * Get referentadministratif
     *
     * @return \App\Entity\Employe
     */
    public function getReferentadministratif()
    {
        return $this->referentadministratif;
    }

    
    /**
     * Set referentdevis
     *
     * @param \App\Entity\Employe $referentdevis
     *
     * @return Dossier
     */
    public function setReferentdevis(\App\Entity\Employe $referentdevis = null)
    {
        $this->referentdevis = $referentdevis;

        return $this;
    }

    /**
     * Get referentdevis
     *
     * @return \App\Entity\Employe
     */
    public function getReferentdevis()
    {
        return $this->referentdevis;
    }

    /**
     * Set personne
     *
     * @param \App\Entity\Personne $personne
     *
     * @return Dossier
     */
    public function setPersonne(\App\Entity\Personne $personne = null)
    {
        $this->personne = $personne;

        return $this;
    }

    /**
     * Get personne
     *
     * @return \App\Entity\Personne
     */
    public function getPersonne()
    {
        return $this->personne;
    }

    /**
     * Set typeactif
     *
     * @param \App\Entity\Masterlistelg $typeactif
     *
     * @return Dossier
     */
    public function setTypeActif(\App\Entity\Masterlistelg $typeactif = null)
    {
        $this->typeactif = $typeactif;

        return $this;
    }

    /**
     * Get typeactif
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getTypeActif()
    {
        return $this->typeactif;
    }

    /**
     * Set typeprog
     *
     * @param \App\Entity\Masterlistelg $typeprog
     *
     * @return Dossier
     */
    public function setTypeProg(\App\Entity\Masterlistelg $typeprog = null)
    {
        $this->typeprog = $typeprog;

        return $this;
    }

    /**
     * Get typeprog
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getTypeProg()
    {
        return $this->typeprog;
    }

    /**
     * Set parcours
     *
     * @param \App\Entity\Parcours $parcours
     *
     * @return Dossier
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

    /**
     * Set dispositif
     *
     * @param \App\Entity\Masterlistelg $dispositif
     *
     * @return Dossier
     */
    public function setDispositif(\App\Entity\Masterlistelg $dispositif = null)
    {
        $this->dispositif = $dispositif;

        return $this;
    }

    /**
     * Get dispositif
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getDispositif()
    {
        return $this->dispositif;
    }

    /**
     * Set parcoursclassrooms
     *
     * @param integer $parcoursclassrooms
     *
     * @return Dossier
     */
    public function setParcoursclassrooms($parcoursclassrooms)
    {
        $this->parcoursclassrooms = $parcoursclassrooms;

        return $this;
    }

    /**
     * Get parcoursclassrooms
     *
     * @return integer
     */
    public function getParcoursclassrooms()
    {
        return $this->parcoursclassrooms;
    }

    /**
     * Set debutcontrat
     *
     * @param \DateTime $debutcontrat
     *
     * @return Dossier
     */
    public function setDebutcontrat($debutcontrat)
    {
        $this->debutcontrat = $debutcontrat;

        return $this;
    }

    /**
     * Get debutcontrat
     *
     * @return \DateTime
     */
    public function getDebutcontrat()
    {
        return $this->debutcontrat;
    }

    /**
     * Set fincontrat
     *
     * @param \DateTime $fincontrat
     *
     * @return Dossier
     */
    public function setFincontrat($fincontrat)
    {
        $this->fincontrat = $fincontrat;

        return $this;
    }

    /**
     * Get fincontrat
     *
     * @return \DateTime
     */
    public function getFincontrat()
    {
        return $this->fincontrat;
    }

    /**
     * Set dossiergroupe
     *
     * @param boolean $dossiergroupe
     *
     * @return Dossier
     */
    public function setDossiergroupe($dossiergroupe)
    {
        $this->dossiergroupe = $dossiergroupe;

        return $this;
    }

    /**
     * Get dossiergroupe
     *
     * @return boolean
     */
    public function getDossiergroupe()
    {
        return $this->dossiergroupe;
    }

    /**
     * Set typedossier
     *
     * @param \App\Entity\Masterlistelg $typedossier
     *
     * @return Dossier
     */
    public function setTypedossier(\App\Entity\Masterlistelg $typedossier = null)
    {
        $this->typedossier = $typedossier;

        return $this;
    }

    /**
     * Get typedossier
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getTypedossier()
    {
        return $this->typedossier;
    }


    /**
     * Set nonretenu
     *
     * @param \App\Entity\Masterlistelg $nonretenu
     *
     * @return Dossier
     */
    public function setNonretenu(\App\Entity\Masterlistelg $nonretenu = null)
    {
        $this->nonretenu = $nonretenu;

        return $this;
    }

    /**
     * Get nonretenu
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getNonretenu()
    {
        return $this->nonretenu;
    }

    /**
     * Add document
     *
     * @param \App\Entity\PersonneDocument $document
     *
     * @return Dossier
     */
    public function addDocument(\App\Entity\PersonneDocument $document)
    {
        $this->documents[] = $document;
        $document->setDossier($this);
        if(!is_null($this->getPersonne())){
            $document->setPersonne($this->getPersonne());
        }
        return $this;
    }

    /**
     * Remove document
     *
     * @param \App\Entity\PersonneDocument $document
     */
    public function removeDocument(\App\Entity\PersonneDocument $document)
    {
        $this->documents->removeElement($document);
    }

    /**
     * Get documents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDocuments()
    {
        return $this->documents;
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
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return Dossier
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;
    return $this;
    }

   /**
     * Set newsletter
     *
     * @param boolean $newsletter
     *
     * @return Dossier
     */
    public function setNewsletter($newsletter)
    {
        $this->newsletter = $newsletter;

        return $this;
    }

    /**
     * Get newsletter
     *
     * @return boolean
     */
    public function getNewsletter()
    {
        return $this->newsletter;
    }


    /**
     * Set statutJuriqique
     *
     * @param string $statutJuriqique
     *
     * @return Dossier
     */
    public function setStatutJuriqique($statutJuriqique)
    {
        $this->statutJuriqique = $statutJuriqique;

        return $this;
    }

    /**
     * Get statutJuriqique
     *
     * @return string
     */
    public function getStatutJuriqique()
    {
        return $this->statutJuriqique;
    }

    /**
     * Set rsa
     *
     * @param boolean $rsa
     *
     * @return Dossier
     */
    public function setRsa($rsa)
    {
        $this->rsa = $rsa;

        return $this;
    }

    /**
     * Get rsa
     *
     * @return boolean
     */
    public function getRsa()
    {
        return $this->rsa;
    }

    /**
     * Set personalinformations
     *
     * @param \App\Entity\PersonalInformations $personalinformations
     *
     * @return Dossier
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
    
    public function getNbStages()
    {
        $resultat=0;
        if(!is_null($this->getSessiondossier())){
            $resultat=count($this->getSessiondossier()->getSessionparcoursstages());
        }
        return $resultat;
    }

    /**
     * Set dossierannexes
     *
     * @param \App\Entity\Dossierannexes $dossierannexes
     *
     * @return Dossier
     */
    public function setDossierannexes(\App\Entity\Dossierannexes $dossierannexes = null)
    {
        $this->dossierannexes = $dossierannexes;

        return $this;
    }

    /**
     * Get dossierannexes
     *
     * @return \App\Entity\Dossierannexes
     */
    public function getDossierannexes()
    {
        return $this->dossierannexes;
    }
    
    public function getPersonalinformationsCourant()
    {
        if(!is_null($this->getPersonalinformations())){
            return $this->getPersonalinformations();
        }
        return $this->getPersonne()->getPersonalinformationsCourant();
    }

    public function getPersonnalInformationTestPersonne()
    {
        if(!is_null($this->getPersonalinformations())){
            return $this->getPersonalinformations();
        }
        if(! is_null($this->getPersonne()))
        return $this->getPersonne()->getPersonalinformationsCourant();
            else return null;
    }

    /**
     * Add dossierfinanceur
     *
     * @param \App\Entity\DossierFinanceur $dossierfinanceur
     *
     * @return Dossier
     */
    public function addDossierfinanceur(\App\Entity\DossierFinanceur $dossierfinanceur)
    {
        $this->dossierfinanceurs[] = $dossierfinanceur;
        $dossierfinanceur->setDossier($this);
        return $this;
    }

    /**
     * Remove dossierfinanceur
     *
     * @param \App\Entity\DossierFinanceur $dossierfinanceur
     */
    public function removeDossierfinanceur(\App\Entity\DossierFinanceur $dossierfinanceur)
    {
        $this->dossierfinanceurs->removeElement($dossierfinanceur);
    }

    /**
     * Get dossierfinanceurs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDossierfinanceurs()
    {
        return $this->dossierfinanceurs;
    }

    /**
     * Set autofinancement
     *
     * @param boolean $autofinancement
     *
     * @return Dossier
     */
    public function setAutofinancement($autofinancement)
    {
        $this->autofinancement = $autofinancement;

        return $this;
    }

    /**
     * Get autofinancement
     *
     * @return boolean
     */
    public function getAutofinancement()
    {
        return $this->autofinancement;
    }

    /**
     * Add financeeurentreprise
     *
     * @param \App\Entity\FinanceurEntreprise $financeeurentreprise
     *
     * @return Dossier
     */
    public function addFinanceeurentreprise(\App\Entity\FinanceurEntreprise $financeeurentreprise)
    {
        $this->financeeurentreprises[] = $financeeurentreprise;

        return $this;
    }

    /**
     * Remove financeeurentreprise
     *
     * @param \App\Entity\FinanceurEntreprise $financeeurentreprise
     */
    public function removeFinanceeurentreprise(\App\Entity\FinanceurEntreprise $financeeurentreprise)
    {
        $this->financeeurentreprises->removeElement($financeeurentreprise);
    }

    /**
     * Get financeeurentreprises
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFinanceeurentreprises()
    {
        return $this->financeeurentreprises;
    }

    /**
     * Add devis
     *
     * @param \App\Entity\Devis $devis
     *
     * @return Dossier
     */
    public function addDevis(\App\Entity\Devis $devis)
    {
        $this->deviss[] = $devis;
        $devis->setDossier($this);
        return $this;
    }

    /**
     * Remove devis
     *
     * @param \App\Entity\Devis $devis
     */
    public function removeDevis(\App\Entity\Devis $devis)
    {
        $this->deviss->removeElement($devis);
    }

    /**
     * Get deviss
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDeviss()
    {
        return $this->deviss;
    }


    public function getDeviscourant()
    {
        
        foreach($this->deviss as $devis) {
            if(! is_null($devis->getState()) and $devis->getState()->getCode()=='accord')return $devis;
        }
        return null;
    }
    

    /**
     * Set datelock
     *
     * @param \DateTime $datelock
     *
     * @return Dossier
     */
    public function setDatelock($datelock)
    {
        $this->datelock = $datelock;

        return $this;
    }

    /**
     * Get datelock
     *
     * @return \DateTime
     */
    public function getDatelock()
    {
        return $this->datelock;
    }

    /**
     * Set quilock
     *
     * @param \App\Entity\User $quilock
     *
     * @return Dossier
     */
    public function setQuilock(\App\Entity\User $quilock = null)
    {
        $this->quilock = $quilock;

        return $this;
    }

    /**
     * Get quilock
     *
     * @return \App\Entity\User
     */
    public function getQuilock()
    {
        return $this->quilock;
    }

    /**
     * Add deviss
     *
     * @param \App\Entity\Devis $deviss
     *
     * @return Dossier
     */
    public function addDeviss(\App\Entity\Devis $deviss)
    {
        $this->deviss[] = $deviss;

        return $this;
    }

    /**
     * Remove deviss
     *
     * @param \App\Entity\Devis $deviss
     */
    public function removeDeviss(\App\Entity\Devis $deviss)
    {
        $this->deviss->removeElement($deviss);
    }

    /**
     * Add financeurentreprise
     *
     * @param \App\Entity\FinanceurEntreprise $financeurentreprise
     *
     * @return Dossier
     */
    public function addFinanceurentreprise(\App\Entity\FinanceurEntreprise $financeurentreprise)
    {
        $this->financeurentreprises[] = $financeurentreprise;

        return $this;
    }

    /**
     * Remove financeurentreprise
     *
     * @param \App\Entity\FinanceurEntreprise $financeurentreprise
     */
    public function removeFinanceurentreprise(\App\Entity\FinanceurEntreprise $financeurentreprise)
    {
        $this->financeurentreprises->removeElement($financeurentreprise);
    }

    /**
     * Get financeurentreprises
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFinanceurentreprises()
    {
        return $this->financeurentreprises;
    }

    /**
     * Set islocked
     *
     * @param boolean $islocked
     *
     * @return Dossier
     */
    public function setIslocked($islocked)
    {
        $this->islocked = $islocked;

        return $this;
    }

    /**
     * Get islocked
     *
     * @return boolean
     */
    public function getIslocked()
    {
        return $this->islocked;
    }

    /**
     * Set diplomant
     *
     * @param boolean $diplomant
     *
     * @return Dossier
     */
    public function setDiplomant($diplomant)
    {
        $this->diplomant = $diplomant;

        return $this;
    }

    /**
     * Get diplomant
     *
     * @return boolean
     */
    public function getDiplomant()
    {
        return $this->diplomant;
    }
    


    /**
     * Set cv
     * @param \App\Entity\Upload $photo
     * @return PersonalInformations
     */
    public function setCv(\App\Entity\Upload $cv = null)
    {
        $this->cv = $cv;
        if( ! is_null($cv)) $this->cv->setDirectoryUpload($this->getDirectoryUpload());
        return $this;
    }
    
    public function getDirectoryUpload()
    {
        return strtolower((new \ReflectionClass($this))->getShortName().'-'.'cv');
    }

    /**
     * Get cv
     *
     * @return \App\Entity\Upload
     */
    public function getCv()
    {
        return $this->cv;
    }

    /**
     * Set repas
     *
     * @param float $repas
     *
     * @return Dossier
     */
    public function setRepas($repas) {
        $this->repas = $repas;

        return $this;
    }

    /**
     * Get repas
     *
     * @return string
     */
    public function getRepas() {
        return $this->repas;
    }

    /**
     * Add cursus.
     *
     * @param \App\Entity\Cursus $cursus
     *
     * @return Dossier
     */
    public function addCursus(\App\Entity\Cursus $cursus)
    {
        $this->cursuss[] = $cursus;
        $cursus->setDossier($this);
        return $this;
    }

    /**
     * Remove cursuss.
     *
     * @param \App\Entity\Cursus $cursus
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeCursus(\App\Entity\Cursus $cursus)
    {
        return $this->cursuss->removeElement($cursus);
    }

    /**
     * Get cursuss.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCursuss()
    {
        return $this->cursuss;
    }

    public function getCursusCourant()
    {
        if(is_null($this->cursuss)){
            return null;
        }
        
        $courant=null;
        foreach($this->cursuss as $ligne){
            $courant=$ligne;
        }
        return $courant;
    }

    /**
     * Add cursuss.
     *
     * @param \App\Entity\Cursus $cursuss
     *
     * @return Dossier
     */
    public function addCursuss(\App\Entity\Cursus $cursuss)
    {
        $this->cursuss[] = $cursuss;

        return $this;
    }

    /**
     * Remove cursuss.
     *
     * @param \App\Entity\Cursus $cursuss
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeCursuss(\App\Entity\Cursus $cursuss)
    {
        return $this->cursuss->removeElement($cursuss);
    }

    /**
     * Add dossiermodule.
     *
     * @param \App\Entity\DossierModule $dossiermodule
     *
     * @return Dossier
     */
    public function addDossiermodule(\App\Entity\DossierModule $dossiermodule)
    {
        $this->dossiermodules[] = $dossiermodule;
        $dossiermodule->setDossier($this);
        return $this;
    }

    /**
     * Remove dossiermodule.
     *
     * @param \App\Entity\DossierModule $dossiermodule
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeDossiermodule(\App\Entity\DossierModule $dossiermodule)
    {
        return $this->dossiermodules->removeElement($dossiermodule);
    }

    /**
     * Get dossiermodules.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDossiermodules()
    {
        return $this->dossiermodules;
    }

    /**
     * Add devisentreprise.
     *
     * @param \App\Entity\Devis $devisentreprise
     *
     * @return Dossier
     */
    public function addDevisentreprise(\App\Entity\Devis $devisentreprise)
    {
        $this->devisentreprises[] = $devisentreprise;
        return $this;
    }

    /**
     * Remove devisentreprise.
     *
     * @param \App\Entity\Devis $devisentreprise
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeDevisentreprise(\App\Entity\Devis $devisentreprise)
    {
        return $this->devisentreprises->removeElement($devisentreprise);
    }

    /**
     * Get devisentreprises.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDevisentreprises()
    {
        return $this->devisentreprises;
    }

    


    /**
     * Add devisentreprise.
     *
     * @param \App\Entity\DevisLigne $devisligneentreprise
     *
     * @return Dossier
     */
    public function addDevisligneentreprise(\App\Entity\DevisLigne $devisligneentreprise)
    {
        $this->devisligneentreprises[] = $devisligneentreprise;
        return $this;
    }

    /**
     * Remove devisentreprise.
     *
     * @param \App\Entity\Devis $devisligneentreprise
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeDevisligneentreprise(\App\Entity\DevisLigne $devisligneentreprise)
    {
        return $this->devisligneentreprises->removeElement($devisligneentreprise);
    }

    /**
     * Get devisligneentreprises.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDevisligneentreprises()
    {
        return $this->devisligneentreprises;
    }
    
    public function getDevisactif()
    {
        $devis=null;
        foreach($this->getDeviss() as $l)
        {
            if(!is_null($l->getState()) && $l->getState()->getCode()=='accord'){
                $devis=$l;
            }
        }

        if(! is_null($this->getDevisentreprises()))
        foreach($this->getDevisentreprises() as $l2)
        {
            if(!is_null($l2->getState()) && $l2->getState()->getCode()=='accord'){
                $devis=$l2;
            }
        }
        return $devis;
    }


    /**
     * Add financement.
     *
     * @param \App\Entity\Financement $financement
     *
     * @return Dossier
     */
    public function addFinancement(\App\Entity\Financement $financement)
    {
        $this->financements[] = $financement;

        return $this;
    }

    /**
     * Remove financement.
     *
     * @param \App\Entity\Financement $financement
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeFinancement(\App\Entity\Financement $financement)
    {
        return $this->financements->removeElement($financement);
    }

    /**
     * Get financements.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFinancements()
    {
        return $this->financements;
    }
    
    public function getDetailFinancement()
    {
        $resultat=[];
        $resultat['nbfinancements']=0;
        $resultat['montantht']=0;
        $resultat['montanttva']=0;
        $resultat['montantttc']=0;
        foreach($this->getFinancements() as $ligne)
        {
            $resultat['montantht']=$resultat['montantht']+$ligne->getMontantht();
            $resultat['montanttva']=$resultat['montanttva']+$ligne->getMontanttva();
            $resultat['montantttc']=$resultat['montantttc']+$ligne->getMontantttc();
            $resultat['nbfinancements']=$resultat['nbfinancements']+1;
        }
        return $resultat;
    }
    
    public function getAllFrais()
    {
        $resultat=0;
        if(!is_null($this->getDevisactif())){
            foreach($this->getDevisactif()->getDevislignes() as $ligne)
            {
                if($ligne->getChargeht()==false){
                    $resultat=$resultat+$ligne->getMontantht();
                }
            }
        }
        return $resultat;
    }

    /**
     * Set participation.
     *
     * @param string|null $participation
     *
     * @return Dossier
     */
    public function setParticipation($participation = null)
    {
        $this->participation = $participation;

        return $this;
    }

    /**
     * Get participation.
     *
     * @return string|null
     */
    public function getParticipation()
    {
        return $this->participation;
    }

    /**
     * Set participationreglee.
     *
     * @param string|null $participationreglee
     *
     * @return Dossier
     */
    public function setParticipationreglee($participationreglee = null)
    {
        $this->participationreglee = $participationreglee;

        return $this;
    }

    /**
     * Get participationreglee.
     *
     * @return string|null
     */
    public function getParticipationreglee()
    {
        return $this->participationreglee;
    }

    /**
     * Add reglement.
     *
     * @param \App\Entity\Reglement $reglement
     *
     * @return Dossier
     */
    public function addReglement(\App\Entity\Reglement $reglement)
    {
        $this->reglements[] = $reglement;
        $reglement->setDossier($this);
        return $this;
    }

    /**
     * Remove reglement.
     *
     * @param \App\Entity\Reglement $reglement
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeReglement(\App\Entity\Reglement $reglement)
    {
        return $this->reglements->removeElement($reglement);
    }

    /**
     * Get reglements.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReglements()
    {
        return $this->reglements;
    }

    /**
     * Set caution.
     *
     * @param string|null $caution
     *
     * @return Dossier
     */
    public function setCaution($caution = null)
    {
        $this->caution = $caution;

        return $this;
    }

    /**
     * Get caution.
     *
     * @return string|null
     */
    public function getCaution()
    {
        return $this->caution;
    }

    /**
     * Add mentor.
     *
     * @param \App\Entity\DossierMentor $mentor
     *
     * @return Dossier
     */
    public function addMentor(\App\Entity\DossierMentor $mentor)
    {
        $this->mentors[] = $mentor;
        $mentor->setDossier($this);
        return $this;
    }

    /**
     * Remove mentor.
     *
     * @param \App\Entity\DossierMentor $mentor
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeMentor(\App\Entity\DossierMentor $mentor)
    {
        return $this->mentors->removeElement($mentor);
    }

    /**
     * Get mentors.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMentors()
    {
        return $this->mentors;
    }

    /**
     * Get entretiens
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEntretiens()
    {
        return $this->entretien;
    }

        public function getEntretien()
    {
        $entretien=null;
        foreach($this->entretien as $entretien)
        {
            return $entretien;
        }
    
        return $entretien;
    }

    /**
     * Add contrat.
     *
     * @param \App\Entity\Contratapprenant $contrat
     *
     * @return Dossier
     */
    public function addContrat(\App\Entity\Contratapprenant $contrat)
    {
        $this->contrats[] = $contrat;
        $contrat->setDossier($this);
        return $this;
    }

    /**
     * Remove contrat.
     *
     * @param \App\Entity\Contratapprenant $contrat
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeContrat(\App\Entity\Contratapprenant $contrat)
    {
        return $this->contrats->removeElement($contrat);
    }

    /**
     * Get contrats.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContrats()
    {
        return $this->contrats;
    }

    /**
     * Set delegueclasse.
     *
     * @param bool $delegueclasse
     *
     * @return Dossier
     */
    public function setDelegueclasse($delegueclasse)
    {
        $this->delegueclasse = $delegueclasse;

        return $this;
    }

    /**
     * Get delegueclasse.
     *
     * @return bool
     */
    public function getDelegueclasse()
    {
        return $this->delegueclasse;
    }

    /**
     * Add entretien.
     *
     * @param \App\Entity\Entretien $entretien
     *
     * @return Dossier
     */
    public function addEntretien(\App\Entity\Entretien $entretien)
    {
        $this->entretien[] = $entretien;

        return $this;
    }

    /**
     * Remove entretien.
     *
     * @param \App\Entity\Entretien $entretien
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeEntretien(\App\Entity\Entretien $entretien)
    {
        return $this->entretien->removeElement($entretien);
    }

    /**
     * Set confirmeinscription
     *
     * @param boolean $confirmeinscription
     *
     * @return Dossier
     */
    public function setConfirmeinscription($confirmeinscription)
    {
        $this->confirmeinscription = $confirmeinscription;

        return $this;
    }

    /**
     * Get confirmeinscription
     *
     * @return boolean
     */
    public function getConfirmeinscription()
    {
        return $this->confirmeinscription;
    }

    /**
     * Set pourcentage.
     *
     * @param string|null $pourcentage
     *
     * @return Dossier
     */
    public function setPourcentage($pourcentage = null)
    {
        $this->pourcentage = $pourcentage;

        return $this;
    }

    /**
     * Get pourcentage.
     *
     * @return string|null
     */
    public function getPourcentage()
    {
        return $this->pourcentage;
    }

    /**
     * Set verifdocuments.
     *
     * @param string|null $verifdocuments
     *
     * @return Dossier
     */
    public function setVerifdocuments($verifdocuments = null)
    {
        $this->verifdocuments = $verifdocuments;

        return $this;
    }

    /**
     * Get verifdocuments.
     *
     * @return string|null
     */
    public function getVerifdocuments()
    {
        return $this->verifdocuments;
    }


    /**
     * Add avertissement.
     *
     * @param \App\Entity\Avertissement $avertissement
     *
     * @return Dossier
     */
    public function addAvertissement(\App\Entity\Avertissement $avertissement)
    {
        $this->avertissements[] = $avertissement;

        return $this;
    }

    /**
     * Remove avertissement.
     *
     * @param \App\Entity\Avertissement $avertissement
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeAvertissement(\App\Entity\Avertissement $avertissement)
    {
        return $this->avertissements->removeElement($avertissement);
    }

    /**
     * Get avertissements.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAvertissements()
    {
        return $this->avertissements;
    }

    /**
     * Get avertissements.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDatesAvertissements()
    {
        $dates='';
        foreach ($this->avertissements as $avertissement) {
           $dates .=$avertissement->getDateinsert()->format('d-m-Y').' ; ';
        }
        return $dates;
    }

    /**
     * Set entreprisecontact.
     *
     * @param \App\Entity\Contact|null $entreprisecontact
     *
     * @return Dossier
     */
    public function setEntreprisecontact(\App\Entity\Contact $entreprisecontact = null)
    {
        $this->entreprisecontact = $entreprisecontact;

        return $this;
    }

    /**
     * Get entreprisecontact.
     *
     * @return \App\Entity\Contact|null
     */
    public function getEntreprisecontact()
    {
        return $this->entreprisecontact;
    }

    /**
     * Add listediffusion.
     *
     * @param \App\Entity\ListeDiffusion $listediffusion
     *
     * @return Dossier
     */
    public function addListediffusion(\App\Entity\ListeDiffusion $listediffusion)
    {
        $this->listediffusions[] = $listediffusion;
        $listediffusion->setDossier($this);
        return $this;
    }

    /**
     * Remove listediffusion.
     *
     * @param \App\Entity\ListeDiffusion $listediffusion
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeListediffusion(\App\Entity\ListeDiffusion $listediffusion)
    {
        return $this->listediffusions->removeElement($listediffusion);
    }

    /**
     * Get listediffusions.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getListediffusions()
    {
        return $this->listediffusions;
    }

    /**
     * Set motifrefus.
     *
     * @param \App\Entity\Masterlistelg|null $motifrefus
     *
     * @return Dossier
     */
    public function setMotifrefus(\App\Entity\Masterlistelg $motifrefus = null)
    {
        $this->motifrefus = $motifrefus;

        return $this;
    }

    /**
     * Get motifrefus.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getMotifrefus()
    {
        return $this->motifrefus;
    }


    /**
     * Set causeabandon.
     *
     * @param \App\Entity\Masterlistelg|null $causeabandon
     *
     * @return Dossier
     */
    public function setCauseabandon(\App\Entity\Masterlistelg $causeabandon = null)
    {
        $this->causeabandon = $causeabandon;

        return $this;
    }

    /**
     * Get causeabandon.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getCauseabandon()
    {
        return $this->causeabandon;
    }

    /**
     * Set signature.
     *
     * @param string|null $signature
     *
     * @return Dossier
     */
    public function setSignature($signature = null)
    {
        $this->signature = $signature;

        return $this;
    }

    /**
     * Get signature.
     *
     * @return string|null
     */
    public function getSignature()
    {
        return $this->signature;
    }


    /**
     * Add convention
     *
     * @param \App\Entity\Convention $convention
     *
     * @return Dossier
     */
    public function addConvention(\App\Entity\Convention $convention)
    {
        $this->conventions[] = $convention;
        $convention->setDossier($this);
        return $this;
    }

    /**
     * Remove convention
     *
     * @param \App\Entity\Convention $convention
     */
    public function removeConvention(\App\Entity\Convention $convention)
    {
        $this->conventions->removeElement($convention);
    }

    /**
     * Get conventions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getConventions()
    {
        return $this->conventions;
    }

    /**
     * Get reunions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReunions()
    {
        return $this->reunions;
    }


    /**
     * Get reunions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReunionactif()
    {
        foreach ($this->reunions as $reunion ) {
            if(! is_null($reunion->getState()) and $reunion->getState()->getCode()=='reunionconfirme' )
                return $reunion;
        }
         return null;
    }


    /**
    * @return array
    */
    public function getItems()
    {
        if ($this->items === null) {
            return [];
        }
        return json_decode($this->items, true);
    }

   
    public function addItem(string $intitule , string $urltemplate,$espace,$type)
    {   
        $exit=false;
        $items = $this->getItems();

        foreach ($items as $item) {
            if($item['intitule']==$intitule and isset($item['espace']) and $item['espace']==$espace)$exit=true;
        } 

        if($exit==false) 
            $items[] = [
            'intitule' => $intitule,
            'urltemplate' => $urltemplate,
            'espace' => $espace,
            'type' => $type
            ];
        $this->items = json_encode($items);
        return $this;
    }
        public function removeItem(int $templateId)
    {
        $items = $this->getItems();
        if (array_key_exists($templateId, $items) === true) {
            unset($items[$templateId]);
        }
        $this->items = json_encode($items);
        return $this;
    }

    public function editItem(string $intitule , string $urltemplate)
    {
        $items = $this->getItems();

        if (array_key_exists($templateId, $items) === true) {
            $items[$productId]['urltemplate'] = $urltemplate;
            $items[$productId]['intitule'] = $intitule;
        }
        $this->items = json_encode($items);

        return $this;
    }

    
        public function removeItems()
    {
         $this->items = NULL;

        return $this;
    }

    /**
    * @return array
    */
    public function getItempes()
    {
        if ($this->itempes === null) {
            return [];
        }
        return json_decode($this->itempes, true);
    }

   
    public function addItempe(string $intitule , string $result)
    {   
        $exit=false;
        $itempes = $this->getItempes();
        $ke=0;
        foreach ($itempes as $itempe) {
            if( $itempe['intitule']==$intitule ){
                $itempes[$ke]['result']=$result ;
                $exit=true;
            }$ke++;
        } 

        if($exit==false) 
            $itempes[] = [
            'intitule' => $intitule,
            'result' => $result
            ];
        $this->itempes = json_encode($itempes);
        return $this;
    }
        public function removeItempe(string $intitule)
    {
        $itempes = $this->getItempes();
        if (array_key_exists($intitule, $itempes) === true) {
            unset($itempes[$intitule]);
        }
        $this->itempes = json_encode($itempes);
        return $this;
    }

    
        public function removeItempes()
    {
         $this->itempes = NULL;

        return $this;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }


    public function analysesessiondossier()
    {
        $log='';
        $session=$this->getSessiondossier()->getSession();
        $parcours=$this->getParcours();
        $devis=$this->getDeviscourant();
        $sessiondevis=null;
        if(! is_null($devis))
            foreach($devis->getDevislignes() as $devislignes){
                if(! is_null($devislignes->getSession()))
                    $sessiondevis=$devislignes->getSession();
            }
        if(! is_null($session) and ! is_null($parcours)){
            if($session->getParcours()->getId() != $parcours->getId()) $log.='<br>Parcours et session ne sont pas identiques ,  cause: Parcours session = '.$session->getParcours()->getIntitule().', parcours = '.$parcours->getIntitule().' , ';
        }else $log.='<br>Absence Session/parcours ';

        if(! is_null($devis)and ! is_null($session) and ! is_null($sessiondevis)){
            if($session->getId() != $sessiondevis->getId()) $log.='<br>Devis et session ne sont pas identiques ,  cause: session devis = '.$sessiondevis->getIntitule().', session dossier = '.$session->getIntitule().' , ';
        }else $log.='<br>Absence devis ';

        //if($session->getParcours()->getId() != $parcours->getId()) $log.='<br>parcours et session ne sont pas identique';
        return $log;
    }

}
