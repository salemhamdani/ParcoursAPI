<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Convention
 *
 * @ORM\Table(name="conventions")
 * @ORM\Entity(repositoryClass="App\Repository\ConventionRepository")
 */
class Convention
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
    * @ORM\ManyToOne(targetEntity="App\Entity\SessionParcoursStage", inversedBy="conventions", cascade={"persist"})
    */
    private $sessionparcoursstage;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Upload", cascade={"persist"})
    */
    private $upload;
   
    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Employe")
    */
    private $employe;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Entreprise")
    */
    private $entreprise;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\EntrepriseAdresse")
    */
    private $adresse;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Entrepriseavalider")
    */
    private $entrepriseavalider;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Tuteuravalider")
    */
    private $tuteuravalider;
    
    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Tuteur")
    */
    private $tuteur;

   
    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Dossier", inversedBy="conventions")
    */
    private $dossier;

    /**
     * @var string
     *
     * @ORM\Column(name="missions", type="string", length=255, nullable=true)
     */
    private $missions;

    /**
     * @var string
     *
     * @ORM\Column(name="objective_du_stage", type="text", nullable=true)
     */
    private $objectiveDuStage;

    /**
     * @var string
     *
     * @ORM\Column(name="objective_programme", type="string", length=255, nullable=true)
     */
    private $objectiveProgramme;

    /**
     * @var string
     *
     * @ORM\Column(name="activites_confiees", type="text", nullable=true)
     */
    private $activitesConfiees;

    /**
     * @var string
     *
     * @ORM\Column(name="competences_a_developper", type="string", length=255, nullable=true)
     */
    private $competencesADevelopper;
    
 
    /**
     * @var string
     *
     * @ORM\Column(name="heures", type="string", length=255, nullable=true)
     */
    private $heures;

    /**
     * @var string
     *
     * @ORM\Column(name="n_jour", type="string", length=255, nullable=true)
     */
    private $nJour;

    /**
     * @var string
     *
     * @ORM\Column(name="temps_stage", type="string", length=255, nullable=true)
     */
    private $tempsStage;

    /**
     * @var string
     *
     * @ORM\Column(name="conditions_particulieres", type="string", length=255, nullable=true)
     */
    private $conditionsParticulieres;

    /**
     * @var string
     *
     * @ORM\Column(name="modalites_encadrement", type="string", length=255, nullable=true)
     */
    private $modalitesEncadrement;

    /**
     * @var string
     *
     * @ORM\Column(name="avantages_offerts", type="string", length=255, nullable=true)
     */
    private $avantagesOfferts;

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
     * @var string
     *
     * @ORM\Column(name="signature_a", type="string", length=255, nullable=true)
     */
    private $signatureA;

     /**
     * @var \DateTime
     *
     * @ORM\Column(name="signature_le", type="datetime",nullable=true)
     */
    private $signatureLe;

    /**
     * @var string
     *
     * @ORM\Column(name="deroulementheurs", type="string", length=255, nullable=true)
     */
    private $deroulementheurs;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $state;

    /**
     * @var bool
     *
     * @ORM\Column(name="signature", type="boolean", nullable=true)
     */
    private $signature;

    /**
     * @var string
     *
     * @ORM\Column(name="annulation", type="string", length=255, nullable=true)
     */
    private $annulation;

    /**
    * @ORM\JoinColumn(nullable=true)
    * @ORM\OneToOne(targetEntity="App\Entity\Upload", cascade={"persist", "remove"})
     */
    private $signaturefile;

    /**
    * @ORM\JoinColumn(nullable=true)
    * @ORM\OneToOne(targetEntity="App\Entity\Upload", cascade={"persist", "remove"})
     */
    private $signatureentreprisefile;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $signatureelectronique; 

   

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
     * Set objectiveDuStage
     *
     * @param string $objectiveDuStage
     *
     * @return Convention
     */
    public function setObjectiveDuStage($objectiveDuStage)
    {
        $this->objectiveDuStage = $objectiveDuStage;

        return $this;
    }

    /**
     * Get objectiveDuStage
     *
     * @return string
     */
    public function getObjectiveDuStage()
    {
        return $this->objectiveDuStage;
    }

    /**
     * Set objectiveProgramme
     *
     * @param string $objectiveProgramme
     *
     * @return Convention
     */
    public function setObjectiveProgramme($objectiveProgramme)
    {
        $this->objectiveProgramme = $objectiveProgramme;

        return $this;
    }

    /**
     * Get objectiveProgramme
     *
     * @return string
     */
    public function getObjectiveProgramme()
    {
        return $this->objectiveProgramme;
    }

    /**
     * Set activitesConfiees
     *
     * @param string $activitesConfiees
     *
     * @return Convention
     */
    public function setActivitesConfiees($activitesConfiees)
    {
        $this->activitesConfiees = $activitesConfiees;

        return $this;
    }

    /**
     * Get activitesConfiees
     *
     * @return string
     */
    public function getActivitesConfiees()
    {
        return $this->activitesConfiees;
    }

    /**
     * Set competencesADevelopper
     *
     * @param string $competencesADevelopper
     *
     * @return Convention
     */
    public function setCompetencesADevelopper($competencesADevelopper)
    {
        $this->competencesADevelopper = $competencesADevelopper;

        return $this;
    }

    /**
     * Get competencesADevelopper
     *
     * @return string
     */
    public function getCompetencesADevelopper()
    {
        return $this->competencesADevelopper;
    }

   
    /**
     * Set heures
     *
     * @param string $heures
     *
     * @return Convention
     */
    public function setHeures($heures)
    {
        $this->heures = $heures;

        return $this;
    }

    /**
     * Get heures
     *
     * @return string
     */
    public function getHeures()
    {
        return $this->heures;
    }
/**
     * Set nJour
     *
     * @param string $nJour
     *
     * @return Convention
     */
    public function setNJour($nJour)
    {
        $this->nJour = $nJour;

        return $this;
    }

    /**
     * Get nJour
     *
     * @return string
     */
    public function getNJour()
    {
        return $this->nJour;
    }

    /**
     * Set tempsStage
     *
     * @param string $tempsStage
     *
     * @return Convention
     */
    public function setTempsStage($tempsStage)
    {
        $this->tempsStage = $tempsStage;

        return $this;
    }

    /**
     * Get tempsStage
     *
     * @return string
     */
    public function getTempsStage()
    {
        return $this->tempsStage;
    }

    /**
     * Set conditionsParticulieres
     *
     * @param string $conditionsParticulieres
     *
     * @return Convention
     */
    public function setConditionsParticulieres($conditionsParticulieres)
    {
        $this->conditionsParticulieres = $conditionsParticulieres;

        return $this;
    }

    /**
     * Get conditionsParticulieres
     *
     * @return string
     */
    public function getConditionsParticulieres()
    {
        return $this->conditionsParticulieres;
    }

    /**
     * Set modalitesEncadrement
     *
     * @param string $modalitesEncadrement
     *
     * @return Convention
     */
    public function setModalitesEncadrement($modalitesEncadrement)
    {
        $this->modalitesEncadrement = $modalitesEncadrement;

        return $this;
    }

    /**
     * Get modalitesEncadrement
     *
     * @return string
     */
    public function getModalitesEncadrement()
    {
        return $this->modalitesEncadrement;
    }

    /**
     * Set avantagesOfferts
     *
     * @param string $avantagesOfferts
     *
     * @return Convention
     */
    public function setAvantagesOfferts($avantagesOfferts)
    {
        $this->avantagesOfferts = $avantagesOfferts;

        return $this;
    }

    /**
     * Get avantagesOfferts
     *
     * @return string
     */
    public function getAvantagesOfferts()
    {
        return $this->avantagesOfferts;
    }

    /**
     * Set signatureA
     *
     * @param string $signatureA
     *
     * @return Convention
     */
    public function setSignatureA($signatureA)
    {
        $this->signatureA = $signatureA;

        return $this;
    }

    /**
     * Get signatureA
     *
     * @return string
     */
    public function getSignatureA()
    {
        return $this->signatureA;
    }

    /**
     * Set signatureLe
     *
     * @param DateTime $signatureLe
     *
     * @return Convention
     */
    public function setSignatureLe($signatureLe)
    {
        $this->signatureLe = $signatureLe;

        return $this;
    }

    /**
     * Get signatureLe
     *
     * @return DateTime
     */
    public function getSignatureLe()
    {
        return $this->signatureLe;
    }

    /**
     * Set deroulementheurs
     *
     * @param string $deroulementheurs
     *
     * @return Convention
     */
    public function setDeroulementheurs($deroulementheurs)
    {
        $this->deroulementheurs = $deroulementheurs;

        return $this;
    }

    /**
     * Get deroulementheurs
     *
     * @return string
     */
    public function getDeroulementheurs()
    {
        return $this->deroulementheurs;
    }

    /**
     * Set missions
     *
     * @param string $missions
     *
     * @return Convention
     */
    public function setMissions($missions)
    {
        $this->missions = $missions;

        return $this;
    }

    /**
     * Get missions
     *
     * @return string
     */
    public function getMissions()
    {
        return $this->missions;
    }

    /**
     * Set annulation
     *
     * @param string $annulation
     *
     * @return Convention
     */
    public function setAnnulation($annulation)
    {
        $this->annulation = $annulation;

        return $this;
    }

    /**
     * Get annulation
     *
     * @return string
     */
    public function getAnnulation()
    {
        return $this->annulation;
    }


    /**
     * Set employe
     *
     * @param \App\Entity\Employe $employe
     *
     * @return Convention
     */
    public function setEmploye(\App\Entity\Employe $employe = null)
    {
        $this->employe = $employe;

        return $this;
    }

    /**
     * Get employe
     *
     * @return \App\Entity\Employe
     */
    public function getEmploye()
    {
        return $this->employe;
    }
    

    /**
     * Set dossier
     *
     * @param \App\Entity\Dossier $stagiaire
     *
     * @return Convention
     */
    public function setDossier(\App\Entity\Dossier $dossier = null)
    {
        $this->dossier = $dossier;

        return $this;
    }

    /**
     * Get dossier
     *
     * @return \App\Entity\Dossier
     */
    public function getDossier()
    {
        return $this->dossier;
    }
    
    /**
     * Set sessionparcoursstage
     *
     * @param \App\Entity\SessionParcoursStage $sessionparcoursstage
     *
     * @return Convention
     */
    public function setSessionparcoursstage(\App\Entity\SessionParcoursStage $sessionparcoursstage = null)
    {
        $this->sessionparcoursstage = $sessionparcoursstage;
        return $this;
    }

    /**
     * Get sessionparcoursstage
     *
     * @return \App\Entity\SessionParcoursStage
     */
    public function getSessionparcoursstage()
    {
        return $this->sessionparcoursstage;
    }

    
    /**
     * Set upload
     *
     * @param \App\Entity\Upload $upload
     *
     * @return Convention
     */
    public function setUpload(\App\Entity\Upload $upload = null)
    {
        $this->upload = $upload;
        return $this;
    }

    /**
     * Get upload
     *
     * @return \App\Entity\Upload
     */
    public function getUpload()
    {
        return $this->upload;
    }

    
    /**
     * Set state
     *
     * @param \App\Entity\Masterlistelg $state
     *
     * @return Convention
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
     * Set signature
     *
     * @param boolean $signature
     *
     * @return Blog
     */
    public function setSignature($signature)
    {
        $this->signature = $signature;

        return $this;
    }

    /**
     * Get signature
     *
     * @return bool
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * Set entreprise
     *
     * @param \App\Entity\Entreprise $entreprise
     *
     * @return Convention
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
     * Set adresse
     *
     * @param \App\Entity\EntrepriseAdresse $adresse
     *
     * @return Convention
     */
    public function setAdresse(\App\Entity\EntrepriseAdresse $adresse = null)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return \App\Entity\EntrepriseAdresse
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set entrepriseavalider
     *
     * @param \App\Entity\Entrepriseavalider $entrepriseavalider
     *
     * @return Convention
     */
    public function setEntrepriseavalider(\App\Entity\Entrepriseavalider $entrepriseavalider = null)
    {
        $this->entrepriseavalider = $entrepriseavalider;

        return $this;
    }

    /**
     * Get entrepriseavalider
     *
     * @return \App\Entity\Entrepriseavalider
     */
    public function getEntrepriseavalider()
    {
        return $this->entrepriseavalider;
    }

    /**
     * Set tuteuravalider
     *
     * @param \App\Entity\Tuteuravalider $tuteuravalider
     *
     * @return Convention
     */
    public function setTuteuravalider(\App\Entity\Tuteuravalider $tuteuravalider = null)
    {
        $this->tuteuravalider = $tuteuravalider;

        return $this;
    }

    /**
     * Get tuteuravalider
     *
     * @return \App\Entity\Tuteuravalider
     */
    public function getTuteuravalider()
    {
        return $this->tuteuravalider;
    }


    /**
     * Set tuteur
     *
     * @param \App\Entity\Tuteur $tuteur
     *
     * @return Convention
     */
    public function setTuteur(\App\Entity\Tuteur $tuteur = null)
    {
        $this->tuteur = $tuteur;

        return $this;
    }

    /**
     * Get tuteur
     *
     * @return \App\Entity\Tuteur
     */
    public function getTuteur()
    {
        return $this->tuteur;
    }

   
    /**
     * Set datedebut
     *
     * @param \DateTime $datedebut
     *
     * @return Convention
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
     * @return Convention
     */
    public function setDatefin($datefin)
    {
        $this->datefin = $datefin;


        return $this;
    }

    /**
     * Get datedebut
     *
     * @return \DateTime
     */
    public function getDatefin()
    {
        return $this->datefin;
    }


    public function getDirectoryUploadSignature()
    {
        return strtolower((new \ReflectionClass($this))->getShortName().'-'.'signature');
    }
    /**
     * Set signaturefile
     * @param \App\Entity\Upload $signature
     * @return Convention
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
     * Set signatureentreprisefile
     * @param \App\Entity\Upload $signature
     * @return Convention
     */
    public function setSignatureentreprisefile(\App\Entity\Upload $signatureentreprisefile = null)
    {
        $this->signatureentreprisefile = $signatureentreprisefile;
        $this->signatureentreprisefile->setDirectoryUpload($this->getDirectoryUploadSignature());
        return $this;
    }
    /**
     * Get signatureentreprisefile
     *
     * @return \App\Entity\Upload
     */
    public function getSignatureentreprisefile()
    {
        return $this->signatureentreprisefile;
    }

    /**
     * Set signatureelectronique
     *
     * @param string $signatureelectronique
     *
     * @return Devis
     */
    public function setSignatureelectronique($signatureelectronique)
    {
        $this->signatureelectronique = $signatureelectronique;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getSignatureelectronique()
    {
        return $this->signatureelectronique;
    }
}
