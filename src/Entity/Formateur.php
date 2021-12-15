<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;
use App\Entity\User;
/**
 * Formateur
 * 
 * @ORM\Table(name="formateurs")
 * @ORM\Entity(repositoryClass="App\Repository\FormateurRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class Formateur extends Personne
{

    public function __construct() {

        $this->competences = new \Doctrine\Common\Collections\ArrayCollection();
        $this->experiences = new \Doctrine\Common\Collections\ArrayCollection();
        $this->formations = new \Doctrine\Common\Collections\ArrayCollection();
        $this->contrats = new \Doctrine\Common\Collections\ArrayCollection();
        $this->documents = new \Doctrine\Common\Collections\ArrayCollection();
        $this->formateurmodules = new \Doctrine\Common\Collections\ArrayCollection();
        $this->formateurParcours = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sessionformateurs = new \Doctrine\Common\Collections\ArrayCollection();
		$this->formateurEntreprises = new \Doctrine\Common\Collections\ArrayCollection();
        $this->archive = false;
        $this->dateinsert = new \DateTime();
        $this->dateinscription = new \DateTime();
		parent::__construct();
    }

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $archive;

    /**
    * @ORM\JoinColumn(nullable=true)
    * @ORM\OneToOne(targetEntity="App\Entity\Upload", cascade={"persist", "remove"})
     */
    private $cv;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\Entretien", mappedBy="formateur",cascade={"persist"})
    */
    private $entretienformateurs;
    
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FormateurModule", mappedBy="formateur",  cascade={"persist"})
     */
    private $formateurModules;
    
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FormateurParcours", mappedBy="formateur",  cascade={"persist"})
     */
    private $formateurParcours;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SessionFormateur", mappedBy="formateur",  cascade={"persist"})
     */
    private $sessionformateurs;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CvExperience", mappedBy="formateur",cascade={"all"})
     */
    private $experiences;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Contrat", mappedBy="formateur",cascade={"all"})
     */
    private $contrats;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Documents", mappedBy="formateur",cascade={"all"})
     */
    private $documents;

    /**
     * @var string
     *
     * @ORM\Column(name="TarifJournalierDefaut", type="string", length=100, nullable=true)
     */
    private $TarifJournalierDefaut;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $Tarifheure;

    /**
     * @var string
     *
     * @ORM\Column(name="NoUrssaf", type="string", length=100, nullable=true)
     */
    private $NoUrssaf;

    /**
     * @var string
     *
     * @ORM\Column(name="retraite", type="string", length=100, nullable=true)
     */
    private $retraite;

    /**
     * @var string
     *
     * @ORM\Column(name="listecompetences", type="string", length=100, nullable=true)
     */
    private $listecompetences ;

    /**
     * @var string
     *
     * @ORM\Column(name="source", type="string", length=200, nullable=true)
     */
    private $source;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $statut;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $statutintervenant;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @var string
     *
     * @ORM\Column(name="professional_info_commentaire", type="text", nullable=true)
     */
    private $professionalInfocommentaire;

    /**
     * @var float
     *
     * @ORM\Column(name="niveau_progress", type="float", nullable=true)
     */
    private $niveauProgress;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $tva=false;

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
     * @ORM\Column(type="datetime")
     */

    private $dateinscription;
    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateupdate;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\FormateurEntreprise", mappedBy="formateur",cascade={"persist"})
    */
    private $formateurEntreprises;

    /**
     * @var string
     *
     * @ORM\Column(name="classroomstype", type="string", length=200, nullable=true)
     */
    private $classroomstype ;  

    /**
     * @var bool
     *
     * @ORM\Column(name="stateclassrooms", type="boolean", nullable=true)
     */
    private $stateclassrooms = false;

    /**
     * @var bool
     *
     * @ORM\Column(name="attendinformation", type="boolean", nullable=true)
     */
    private $attendinformation = false;
    
    /**
    * @ORM\OneToMany(targetEntity="App\Entity\DossierMentor", mappedBy="formateur", orphanRemoval=true, cascade={"persist"})
    */
    private $mentores;

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
     * @var string
     *
     * @ORM\Column(name="prefecture", type="string", length=255, nullable=true)
     */
    private $prefecture;

    /**
     * @var string
     *
     * @ORM\Column(name="numeroactivite", type="string", length=255, nullable=true)
     */
    private $numeroactivite;

    /**
     * @var string
     *
     * @ORM\Column(name="signature", type="string", length=255, nullable=true)
     */
    private $signature;

    /**
     * Set dateinscription
     *
     * @param \DateTime $dateinscription
     *
     * @return Formateur
     */
    public function setDateinscription($dateinscription)
    {
        $this->dateinscription = $dateinscription;

        return $this;
    }

    /**
     * Get dateinscription
     *
     * @return \DateTime
     */
    public function getDateinscription()
    {
        return $this->dateinscription;
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
     * Get entreprise
     *
     * @return \App\Entity\Entreprise
     */
    public function getEntreprise()
    {
        foreach ($this->getFormateurEntreprises() as $entreprise) {
             return $entreprise->getEntreprise();
        }
        return null ;
    }




    /**
     * Set classroomstype
     *
     * @param string $classroomstype
     *
     * @return Formateur
     */
    public function setClassroomstype($classroomstype)
    {
        $this->classroomstype = $classroomstype;

        return $this;
    }

    /**
     * Get classroomstype
     *
     * @return string
     */
    public function getClassroomstype()
    {
        return $this->classroomstype;
    }

    /**
     * Set stateclassrooms
     *
     * @param boolean $stateclassrooms
     *
     * @return Formateur
     */
    public function setStateclassrooms($stateclassrooms)
    {
        $this->stateclassrooms = $stateclassrooms;

        return $this;
    }

    /**
     * Get stateclassrooms
     *
     * @return boolean
     */
    public function getStateclassrooms()
    {
        return $this->stateclassrooms;
    }



    /**
     * Set attendinformation
     *
     * @param boolean $attendinformation
     *
     * @return Formateur
     */
    public function setAttendinformation($attendinformation)
    {
        $this->attendinformation = $attendinformation;

        return $this;
    }

    /**
     * Get attendinformation
     *
     * @return boolean
     */
    public function getAttendinformation()
    {
        return $this->attendinformation;
    }


      /**
     * Set statut
     *
     * @param \App\Entity\Masterlistelg $statut
     *
     * @return Formateur
     */
    public function setStatut(\App\Entity\Masterlistelg $statut = null)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getStatut()
    {
        return $this->statut;
    }



      /**
     * Set statutintervenant
     *
     * @param \App\Entity\Masterlistelg $statutintervenant
     *
     * @return Formateur
     */
    public function setStatutintervenant(\App\Entity\Masterlistelg $statutintervenant = null)
    {
        $this->statutintervenant = $statutintervenant;

        return $this;
    }

    /**
     * Get statutintervenant
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getStatutintervenant()
    {
        return $this->statutintervenant;
    }


    /**
     * Set TarifJournalierDefaut
     *
     * @param string $TarifJournalierDefaut
     *
     * @return Formateur
     */
    public function setTarifJournalierDefaut($TarifJournalierDefaut)
    {
        $this->TarifJournalierDefaut = $TarifJournalierDefaut;

        return $this;
    }

    /**
     * Get TarifJournalierDefaut
     *
     * @return string
     */
    public function getTarifJournalierDefaut()
    {
        return $this->TarifJournalierDefaut;
    }

    /**
     * Set retraite
     *
     * @param string $retraite
     *
     * @return Formateur
     */
    public function setRetraite($retraite)
    {
        $this->retraite = $retraite;

        return $this;
    }

    /**
     * Get retraite
     *
     * @return string
     */
    public function getRetraite()
    {
        return $this->retraite;
    }

    /**
     * Set NoUrssaf
     *
     * @param string $NoUrssaf
     *
     * @return Formateur
     */
    public function setNoUrssaf($NoUrssaf)
    {
        $this->NoUrssaf = $NoUrssaf;

        return $this;
    }

    /**
     * Get NoUrssaf
     *
     * @return string
     */
    public function getNoUrssaf()
    {
        return $this->NoUrssaf;
    }
 
    /**
     * Set listecompetences
     *
     * @param string $societe
     *
     * @return Formateur
     */
    public function setListecompetences($listecompetences)
    {
        $this->listecompetences = $listecompetences;

        return $this;
    }

    /**
     * Get listecompetences
     *
     * @return string
     */
    public function getListecompetences()
    {
        return $this->listecompetences;
    }


    /**
     * Set source
     *
     * @param string $source
     *
     * @return Formateur
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }


    /**
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return Formateur
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
     * Set professionalInfocommentaire
     *
     * @param string $professionalInfocommentaire
     *
     * @return Formateur
     */
    public function setProfessionalInfocommentaire($professionalInfocommentaire)
    {
        $this->professionalInfocommentaire = $professionalInfocommentaire;

        return $this;
    }

    /**
     * Get professionalInfocommentaire
     *
     * @return string
     */
    public function getProfessionalInfocommentaire()
    {
        return $this->professionalInfocommentaire;
    }

    /**
     * Set niveauProgress
     *
     * @param float $niveauProgress
     *
     * @return Formateur
     */
    public function setNiveauProgress($niveauProgress)
    {
        $this->niveauProgress = $niveauProgress;

        return $this;
    }

    /**
     * Get niveauProgress
     *
     * @return float
     */
    public function getNiveauProgress()
    {
        return $this->niveauProgress;
    }


    /**
     * Add competence
     *
     * @param \App\Entity\Competence $competence
     *
     * @return Formateur
     */
    public function addCompetence(\App\Entity\Competence $competence)
    {
        $this->competences[] = $competence;

        return $this;
    }

    /**
     * Remove competence
     *
     * @param \App\Entity\Competence $competence
     */
    public function removeCompetence(\App\Entity\Competence $competence)
    {
        $this->competences->removeElement($competence);
    }

    /**
     * Get competences
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCompetences()
    {
        return $this->competences;
    }

    /**
     * Add experience
     *
     * @param \App\Entity\CvExperience $experience
     *
     * @return Formateur
     */
    public function addExperience(\App\Entity\CvExperience $experience)
    {
        $this->experiences[] = $experience;

        return $this;
    }

    /**
     * Remove experience
     *
     * @param \App\Entity\CvExperience $experience
     */
    public function removeExperience(\App\Entity\CvExperience $experience)
    {
        $this->experiences->removeElement($experience);
    }

    /**
     * Get experiences
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getExperiences()
    {
        return $this->experiences;
    }


    /**
     * Add contrat
     *
     * @param \App\Entity\Contrat $contrat
     *
     * @return Formateur
     */
    public function addContrat(\App\Entity\Contrat $contrat)
    {
        $this->contrats[] = $contrat;
		$contrat->setFormateur($this);
        return $this;
    }

    /**
     * Remove contrat
     *
     * @param \App\Entity\Contrat $contrat
     */
    public function removeContrat(\App\Entity\Contrat $contrat)
    {
        $this->contrats->removeElement($contrat);
    }

    /**
     * Get contrats
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContrats()
    {
        return $this->contrats;
    }


    /**
     * Add formateurModule
     *
     * @param \App\Entity\FormateurModule $formateurModule
     *
     * @return Formateur
     */
    public function addFormateurModule(\App\Entity\FormateurModule $formateurModule)
    {
        $this->formateurModules[] = $formateurModule;
        $formateurModule->setFormateur($this);
        return $this;
    }

    /**
     * Remove formateurModule
     *
     * @param \App\Entity\FormateurModule $formateurModule
     */
    public function removeFormateurModule(\App\Entity\FormateurModule $formateurModule)
    {
        $this->formateurModules->removeElement($formateurModule);
    }

    /**
     * Get formateurModules
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFormateurModules()
    {
        return $this->formateurModules;
    }




    /**
     * Add formateurParcours
     *
     * @param \App\Entity\FormateurParcours $formateurParcours
     *
     * @return Formateur
     */
    public function addFormateurParcours(\App\Entity\FormateurParcours $formateurParcours)
    {
        $this->formateurParcours[] = $formateurParcours;
        $formateurParcours->setFormateur($this);
        return $this;
    }

    /**
     * Remove formateurParcours
     *
     * @param \App\Entity\FormateurParcours $formateurParcours
     */
    public function removeFormateurParcours(\App\Entity\FormateurParcours $formateurParcours)
    {
        $this->formateurParcours->removeElement($formateurParcours);
    }

    /**
     * Get formateurParcours
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFormateurParcours()
    {
        return $this->formateurParcours;
    }

    /**
     * Add sessionformateur
     *
     * @param \App\Entity\SessionFormateur $sessionformateur
     *
     * @return Formateur
     */
    public function addSessionformateur(\App\Entity\SessionFormateur $sessionformateur)
    {
        $this->sessionformateurs[] = $sessionformateur;
        $sessionformateur->setFormateur($this);
        return $this;
    }

    /**
     * Remove sessionformateur
     *
     * @param \App\Entity\SessionFormateur $sessionformateur
     */
    public function removeSessionformateur(\App\Entity\SessionFormateur $sessionformateur)
    {
        $this->sessionformateurs->removeElement($sessionformateur);
    }

    /**
     * Get sessionformateurs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSessionformateurs()
    {
        return $this->sessionformateurs;
    }

    /**
     * Add entretienformateur
     *
     * @param \App\Entity\Entretien $entretienformateur
     *
     * @return Personne
     */
    public function addEntretienformateur(\App\Entity\Entretien $entretienformateur)
    {
        $this->entretienformateurs[] = $entretienformateur;
        $entretienformateur->setFormateur($this);
        return $this;
    }

    /**
     * Remove entretienformateur
     *
     * @param \App\Entity\Entretien $entretienformateur
     */
    public function removeEntretienformateur(\App\Entity\Entretien $entretienformateur)
    {
        $this->entretienformateurs->removeElement($entretienformateur);
    }

    /**
     * Get entretienformateurs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEntretienformateurs()
    {
        return $this->entretienformateurs;
    }

    /**
     * Set tva
     *
     * @param boolean $tva
     *
     * @return Filiere
     */
    public function setTva($tva)
    {
        $this->tva = $tva;

        return $this;
    }

    /**
     * Get tva
     *
     * @return boolean
     */
    public function getTva()
    {
        return $this->tva;
    }


    /**
     * Set cv
     * @param \App\Entity\Upload $cv
     * @return PersonalInformations
     */
    public function setCv(\App\Entity\Upload $cv = null)
    {
        $this->cv = $cv;
//      $this->photo->setDirectoryUpload(strtolower((new \ReflectionClass($this))->getShortName().'-'.'photo'));
        $this->cv->setDirectoryUpload($this->getDirectoryUpload());
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
     * Add formateurParcour.
     *
     * @param \App\Entity\FormateurParcours $formateurParcour
     *
     * @return Formateur
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
     * Set tarifheure.
     *
     * @param string|null $tarifheure
     *
     * @return Formateur
     */
    public function setTarifheure($tarifheure = null)
    {
        $this->Tarifheure = $tarifheure;

        return $this;
    }

    /**
     * Get tarifheure.
     *
     * @return string|null
     */
    public function getTarifheure()
    {
        return $this->Tarifheure;
    }

    /**
     * Add formateurEntreprise.
     *
     * @param \App\Entity\FormateurEntreprise $formateurEntreprise
     *
     * @return Formateur
     */
    public function addFormateurEntreprise(\App\Entity\FormateurEntreprise $formateurEntreprise)
    {
        $this->formateurEntreprises[] = $formateurEntreprise;
		$formateurEntreprise->setFormateur($this);
        return $this;
    }

    /**
     * Remove formateurEntreprise.
     *
     * @param \App\Entity\FormateurEntreprise $formateurEntreprise
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeFormateurEntreprise(\App\Entity\FormateurEntreprise $formateurEntreprise)
    {
        return $this->formateurEntreprises->removeElement($formateurEntreprise);
    }

    /**
     * Get formateurEntreprises.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFormateurEntreprises()
    {
        return $this->formateurEntreprises;
    }

    /**
     * Add mentore.
     *
     * @param \App\Entity\DossierMentor $mentore
     *
     * @return Formateur
     */
    public function addMentore(\App\Entity\DossierMentor $mentore)
    {
        $this->mentores[] = $mentore;
		$mentore->setFormateur($this);
        return $this;
    }

    /**
     * Remove mentore.
     *
     * @param \App\Entity\DossierMentor $mentore
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeMentore(\App\Entity\DossierMentor $mentore)
    {
        return $this->mentores->removeElement($mentore);
    }

    /**
     * Get mentores.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMentores()
    {
        return $this->mentores;
    }

    public function getEntretienformateursactif()
    {
        $entretienformateurs=null;
        foreach($this->getEntretienformateurs() as $entretienformateurs)
        {
            return $entretienformateurs;
        }
    
        return $entretienformateurs;
    }
    

    /**
     * Set pourcentage.
     *
     * @param string|null $pourcentage
     *
     * @return Formateur
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
     * @return Formateur
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
     * Set prefecture.
     *
     * @param string|null $prefecture
     *
     * @return Formateur
     */
    public function setPrefecture($prefecture = null)
    {
        $this->prefecture = $prefecture;

        return $this;
    }

    /**
     * Get prefecture.
     *
     * @return string|null
     */
    public function getPrefecture()
    {
        return $this->prefecture;
    }

    /**
     * Set numeroactivite.
     *
     * @param string|null $numeroactivite
     *
     * @return Formateur
     */
    public function setNumeroactivite($numeroactivite = null)
    {
        $this->numeroactivite = $numeroactivite;

        return $this;
    }

    /**
     * Get numeroactivite.
     *
     * @return string|null
     */
    public function getNumeroactivite()
    {
        return $this->numeroactivite;
    }

    /**
     * Set signature.
     *
     * @param string|null $signature
     *
     * @return Formateur
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
}
