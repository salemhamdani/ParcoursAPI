<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * Contratapprenant
 *
 * @ORM\Table(name="contratapprenant")
 * @ORM\Entity(repositoryClass="App\Repository\ContratapprenantRepository")
 */
class Contratapprenant
{

    /**
     * Constructor
     */
    public function __construct()
    {
		$this->assurancechomage = false;
		$this->travailmachine = false;
		$this->tuteureligible = true;
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numcontratancien;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $sortecontrat;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $typemployeurspec;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $assurancechomage;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $tuteureligible;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $travailmachine;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Dossier", inversedBy="contrats")
     */
    private $dossier;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Entreprise")
     */
    private $entreprise;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\EntrepriseAdresse")
     */
    private $adresse;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Contact")
     */
    private $tuteur1;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Contact")
     */
    private $tuteur2;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Contact")
     */
    private $referentadministratif;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Contact")
     */
    private $referentabsences;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Contact")
     */
    private $referentcommercial;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Contact")
     */
    private $representantlegal;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $situationavant;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $minimumsocial;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $diplomepluseleve;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $diplomevise;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $dernierdiplomevise;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $derniereclasse;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $qualificationvise;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $typecontrat;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $typederogation;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $naturecontrat;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $intituleemploi;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $niveauclassemploi;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $coefhierarchique;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=8, scale=2, nullable=true)
     */
    private $salairebrut;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=8, scale=2, nullable=true)
     */
    private $nourriture;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=8, scale=2, nullable=true)
     */
    private $logement;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=8, scale=2, nullable=true)
     */
    private $panier;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=3, nullable=true)
     */
    private $dureeessai;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=3, nullable=true)
     */
    private $dureehebdohrs;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=3, nullable=true)
     */
    private $dureehebdomin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date", nullable=true)
     */
    private $debut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date", nullable=true)
     */
    private $fin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date", nullable=true)
     */
    private $datesignature;

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
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set intituleemploi.
     *
     * @param string|null $intituleemploi
     *
     * @return Contratapprenant
     */
    public function setIntituleemploi($intituleemploi = null)
    {
        $this->intituleemploi = $intituleemploi;

        return $this;
    }

    /**
     * Get intituleemploi.
     *
     * @return string|null
     */
    public function getIntituleemploi()
    {
        return $this->intituleemploi;
    }

    /**
     * Set niveauclassemploi.
     *
     * @param string|null $niveauclassemploi
     *
     * @return Contratapprenant
     */
    public function setNiveauclassemploi($niveauclassemploi = null)
    {
        $this->niveauclassemploi = $niveauclassemploi;

        return $this;
    }

    /**
     * Get niveauclassemploi.
     *
     * @return string|null
     */
    public function getNiveauclassemploi()
    {
        return $this->niveauclassemploi;
    }

    /**
     * Set coefhierarchique.
     *
     * @param string|null $coefhierarchique
     *
     * @return Contratapprenant
     */
    public function setCoefhierarchique($coefhierarchique = null)
    {
        $this->coefhierarchique = $coefhierarchique;

        return $this;
    }

    /**
     * Get coefhierarchique.
     *
     * @return string|null
     */
    public function getCoefhierarchique()
    {
        return $this->coefhierarchique;
    }

    /**
     * Set salairebrut.
     *
     * @param string|null $salairebrut
     *
     * @return Contratapprenant
     */
    public function setSalairebrut($salairebrut = null)
    {
        $this->salairebrut = $salairebrut;

        return $this;
    }

    /**
     * Get salairebrut.
     *
     * @return string|null
     */
    public function getSalairebrut()
    {
        return $this->salairebrut;
    }

    /**
     * Set dureeessai.
     *
     * @param string|null $dureeessai
     *
     * @return Contratapprenant
     */
    public function setDureeessai($dureeessai = null)
    {
        $this->dureeessai = $dureeessai;

        return $this;
    }

    /**
     * Get dureeessai.
     *
     * @return string|null
     */
    public function getDureeessai()
    {
        return $this->dureeessai;
    }

    /**
     * Set dureehebdohrs.
     *
     * @param string|null $dureehebdohrs
     *
     * @return Contratapprenant
     */
    public function setDureehebdohrs($dureehebdohrs = null)
    {
        $this->dureehebdohrs = $dureehebdohrs;

        return $this;
    }

    /**
     * Get dureehebdohrs.
     *
     * @return string|null
     */
    public function getDureehebdohrs()
    {
        return $this->dureehebdohrs;
    }

    /**
     * Set dureehebdomin.
     *
     * @param string|null $dureehebdomin
     *
     * @return Contratapprenant
     */
    public function setDureehebdomin($dureehebdomin = null)
    {
        $this->dureehebdomin = $dureehebdomin;

        return $this;
    }

    /**
     * Get dureehebdomin.
     *
     * @return string|null
     */
    public function getDureehebdomin()
    {
        return $this->dureehebdomin;
    }

    /**
     * Set debut.
     *
     * @param \DateTime|null $debut
     *
     * @return Contratapprenant
     */
    public function setDebut($debut = null)
    {
        $this->debut = $debut;

        return $this;
    }

    /**
     * Get debut.
     *
     * @return \DateTime|null
     */
    public function getDebut()
    {
        return $this->debut;
    }

    /**
     * Set fin.
     *
     * @param \DateTime|null $fin
     *
     * @return Contratapprenant
     */
    public function setFin($fin = null)
    {
        $this->fin = $fin;

        return $this;
    }

    /**
     * Get fin.
     *
     * @return \DateTime|null
     */
    public function getFin()
    {
        return $this->fin;
    }

    /**
     * Set datesignature.
     *
     * @param \DateTime|null $datesignature
     *
     * @return Contratapprenant
     */
    public function setDatesignature($datesignature = null)
    {
        $this->datesignature = $datesignature;

        return $this;
    }

    /**
     * Get datesignature.
     *
     * @return \DateTime|null
     */
    public function getDatesignature()
    {
        return $this->datesignature;
    }

    /**
     * Set dateinsert.
     *
     * @param \DateTime|null $dateinsert
     *
     * @return Contratapprenant
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
     * @return Contratapprenant
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
     * Set dossier.
     *
     * @param \App\Entity\Dossier|null $dossier
     *
     * @return Contratapprenant
     */
    public function setDossier(\App\Entity\Dossier $dossier = null)
    {
        $this->dossier = $dossier;

        return $this;
    }

    /**
     * Get dossier.
     *
     * @return \App\Entity\Dossier|null
     */
    public function getDossier()
    {
        return $this->dossier;
    }

    /**
     * Set entreprise.
     *
     * @param \App\Entity\Entreprise|null $entreprise
     *
     * @return Contratapprenant
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
     * Set adresse.
     *
     * @param \App\Entity\EntrepriseAdresse|null $adresse
     *
     * @return Contratapprenant
     */
    public function setAdresse(\App\Entity\EntrepriseAdresse $adresse = null)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse.
     *
     * @return \App\Entity\EntrepriseAdresse|null
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set tuteur1.
     *
     * @param \App\Entity\Contact|null $tuteur1
     *
     * @return Contratapprenant
     */
    public function setTuteur1(\App\Entity\Contact $tuteur1 = null)
    {
        $this->tuteur1 = $tuteur1;

        return $this;
    }

    /**
     * Get tuteur1.
     *
     * @return \App\Entity\Contact|null
     */
    public function getTuteur1()
    {
        return $this->tuteur1;
    }

    /**
     * Set tuteur2.
     *
     * @param \App\Entity\Contact|null $tuteur2
     *
     * @return Contratapprenant
     */
    public function setTuteur2(\App\Entity\Contact $tuteur2 = null)
    {
        $this->tuteur2 = $tuteur2;

        return $this;
    }

    /**
     * Get tuteur2.
     *
     * @return \App\Entity\Contact|null
     */
    public function getTuteur2()
    {
        return $this->tuteur2;
    }

    /**
     * Set referentadministratif.
     *
     * @param \App\Entity\Contact|null $referentadministratif
     *
     * @return Contratapprenant
     */
    public function setReferentadministratif(\App\Entity\Contact $referentadministratif = null)
    {
        $this->referentadministratif = $referentadministratif;

        return $this;
    }

    /**
     * Get referentadministratif.
     *
     * @return \App\Entity\Contact|null
     */
    public function getReferentadministratif()
    {
        return $this->referentadministratif;
    }

    /**
     * Set referentabsences.
     *
     * @param \App\Entity\Contact|null $referentabsences
     *
     * @return Contratapprenant
     */
    public function setReferentabsences(\App\Entity\Contact $referentabsences = null)
    {
        $this->referentabsences = $referentabsences;

        return $this;
    }

    /**
     * Get referentabsences.
     *
     * @return \App\Entity\Contact|null
     */
    public function getReferentabsences()
    {
        return $this->referentabsences;
    }

    /**
     * Set referentcommercial.
     *
     * @param \App\Entity\Contact|null $referentcommercial
     *
     * @return Contratapprenant
     */
    public function setReferentcommercial(\App\Entity\Contact $referentcommercial = null)
    {
        $this->referentcommercial = $referentcommercial;

        return $this;
    }

    /**
     * Get referentcommercial.
     *
     * @return \App\Entity\Contact|null
     */
    public function getReferentcommercial()
    {
        return $this->referentcommercial;
    }

    /**
     * Set representantlegal.
     *
     * @param \App\Entity\Contact|null $representantlegal
     *
     * @return Contratapprenant
     */
    public function setRepresentantlegal(\App\Entity\Contact $representantlegal = null)
    {
        $this->representantlegal = $representantlegal;

        return $this;
    }

    /**
     * Get representantlegal.
     *
     * @return \App\Entity\Contact|null
     */
    public function getRepresentantlegal()
    {
        return $this->representantlegal;
    }

    /**
     * Set situationavant.
     *
     * @param \App\Entity\Masterlistelg|null $situationavant
     *
     * @return Contratapprenant
     */
    public function setSituationavant(\App\Entity\Masterlistelg $situationavant = null)
    {
        $this->situationavant = $situationavant;

        return $this;
    }

    /**
     * Get situationavant.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getSituationavant()
    {
        return $this->situationavant;
    }

    /**
     * Set minimumsocial.
     *
     * @param \App\Entity\Masterlistelg|null $minimumsocial
     *
     * @return Contratapprenant
     */
    public function setMinimumsocial(\App\Entity\Masterlistelg $minimumsocial = null)
    {
        $this->minimumsocial = $minimumsocial;

        return $this;
    }

    /**
     * Get minimumsocial.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getMinimumsocial()
    {
        return $this->minimumsocial;
    }

    /**
     * Set diplomepluseleve.
     *
     * @param \App\Entity\Masterlistelg|null $diplomepluseleve
     *
     * @return Contratapprenant
     */
    public function setDiplomepluseleve(\App\Entity\Masterlistelg $diplomepluseleve = null)
    {
        $this->diplomepluseleve = $diplomepluseleve;

        return $this;
    }

    /**
     * Get diplomepluseleve.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getDiplomepluseleve()
    {
        return $this->diplomepluseleve;
    }

    /**
     * Set diplomevise.
     *
     * @param \App\Entity\Masterlistelg|null $diplomevise
     *
     * @return Contratapprenant
     */
    public function setDiplomevise(\App\Entity\Masterlistelg $diplomevise = null)
    {
        $this->diplomevise = $diplomevise;

        return $this;
    }

    /**
     * Get diplomevise.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getDiplomevise()
    {
        return $this->diplomevise;
    }

    /**
     * Set qualificationvise.
     *
     * @param \App\Entity\Masterlistelg|null $qualificationvise
     *
     * @return Contratapprenant
     */
    public function setQualificationvise(\App\Entity\Masterlistelg $qualificationvise = null)
    {
        $this->qualificationvise = $qualificationvise;

        return $this;
    }

    /**
     * Get qualificationvise.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getQualificationvise()
    {
        return $this->qualificationvise;
    }

    /**
     * Set typecontrat.
     *
     * @param \App\Entity\Masterlistelg|null $typecontrat
     *
     * @return Contratapprenant
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
     * Set naturecontrat.
     *
     * @param \App\Entity\Masterlistelg|null $naturecontrat
     *
     * @return Contratapprenant
     */
    public function setNaturecontrat(\App\Entity\Masterlistelg $naturecontrat = null)
    {
        $this->naturecontrat = $naturecontrat;

        return $this;
    }

    /**
     * Get naturecontrat.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getNaturecontrat()
    {
        return $this->naturecontrat;
    }


    /**
     * Set sortecontrat.
     *
     * @param \App\Entity\Masterlistelg|null $sortecontrat
     *
     * @return Contratapprenant
     */
    public function setSortecontrat(\App\Entity\Masterlistelg $sortecontrat = null)
    {
        $this->sortecontrat = $sortecontrat;

        return $this;
    }

    /**
     * Get sortecontrat.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getSortecontrat()
    {
        return $this->sortecontrat;
    }

    /**
     * Set typemployeurspec.
     *
     * @param \App\Entity\Masterlistelg|null $typemployeurspec
     *
     * @return Contratapprenant
     */
    public function setTypemployeurspec(\App\Entity\Masterlistelg $typemployeurspec = null)
    {
        $this->typemployeurspec = $typemployeurspec;

        return $this;
    }

    /**
     * Get typemployeurspec.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getTypemployeurspec()
    {
        return $this->typemployeurspec;
    }

    /**
     * Set assurancechomage.
     *
     * @param bool $assurancechomage
     *
     * @return Contratapprenant
     */
    public function setAssurancechomage($assurancechomage)
    {
        $this->assurancechomage = $assurancechomage;

        return $this;
    }

    /**
     * Get assurancechomage.
     *
     * @return bool
     */
    public function getAssurancechomage()
    {
        return $this->assurancechomage;
    }

    /**
     * Set derniereclasse.
     *
     * @param \App\Entity\Masterlistelg|null $derniereclasse
     *
     * @return Contratapprenant
     */
    public function setDerniereclasse(\App\Entity\Masterlistelg $derniereclasse = null)
    {
        $this->derniereclasse = $derniereclasse;

        return $this;
    }

    /**
     * Get derniereclasse.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getDerniereclasse()
    {
        return $this->derniereclasse;
    }

    /**
     * Set numcontratancien.
     *
     * @param string|null $numcontratancien
     *
     * @return Contratapprenant
     */
    public function setNumcontratancien($numcontratancien = null)
    {
        $this->numcontratancien = $numcontratancien;

        return $this;
    }

    /**
     * Get numcontratancien.
     *
     * @return string|null
     */
    public function getNumcontratancien()
    {
        return $this->numcontratancien;
    }

    /**
     * Set typederogation.
     *
     * @param \App\Entity\Masterlistelg|null $typederogation
     *
     * @return Contratapprenant
     */
    public function setTypederogation(\App\Entity\Masterlistelg $typederogation = null)
    {
        $this->typederogation = $typederogation;

        return $this;
    }

    /**
     * Get typederogation.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getTypederogation()
    {
        return $this->typederogation;
    }

    /**
     * Set travailmachine.
     *
     * @param bool|null $travailmachine
     *
     * @return Contratapprenant
     */
    public function setTravailmachine($travailmachine = null)
    {
        $this->travailmachine = $travailmachine;

        return $this;
    }

    /**
     * Get travailmachine.
     *
     * @return bool|null
     */
    public function getTravailmachine()
    {
        return $this->travailmachine;
    }

    /**
     * Set nourriture.
     *
     * @param string|null $nourriture
     *
     * @return Contratapprenant
     */
    public function setNourriture($nourriture = null)
    {
        $this->nourriture = $nourriture;

        return $this;
    }

    /**
     * Get nourriture.
     *
     * @return string|null
     */
    public function getNourriture()
    {
        return $this->nourriture;
    }

    /**
     * Set logement.
     *
     * @param string|null $logement
     *
     * @return Contratapprenant
     */
    public function setLogement($logement = null)
    {
        $this->logement = $logement;

        return $this;
    }

    /**
     * Get logement.
     *
     * @return string|null
     */
    public function getLogement()
    {
        return $this->logement;
    }

    /**
     * Set panier.
     *
     * @param string|null $panier
     *
     * @return Contratapprenant
     */
    public function setPanier($panier = null)
    {
        $this->panier = $panier;

        return $this;
    }

    /**
     * Get panier.
     *
     * @return string|null
     */
    public function getPanier()
    {
        return $this->panier;
    }

    /**
     * Set tuteureligible.
     *
     * @param bool|null $tuteureligible
     *
     * @return Contratapprenant
     */
    public function setTuteureligible($tuteureligible = null)
    {
        $this->tuteureligible = $tuteureligible;

        return $this;
    }

    /**
     * Get tuteureligible.
     *
     * @return bool|null
     */
    public function getTuteureligible()
    {
        return $this->tuteureligible;
    }

    /**
     * Set dernierdiplomevise.
     *
     * @param \App\Entity\Masterlistelg|null $dernierdiplomevise
     *
     * @return Contratapprenant
     */
    public function setDernierdiplomevise(\App\Entity\Masterlistelg $dernierdiplomevise = null)
    {
        $this->dernierdiplomevise = $dernierdiplomevise;

        return $this;
    }

    /**
     * Get dernierdiplomevise.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getDernierdiplomevise()
    {
        return $this->dernierdiplomevise;
    }
}
