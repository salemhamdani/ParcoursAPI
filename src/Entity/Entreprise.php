<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Entreprise
 *
 * @ORM\Table(name="entreprises")
 * @ORM\Entity(repositoryClass="App\Repository\EntrepriseRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Entreprise
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tuteurs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->stages = new \Doctrine\Common\Collections\ArrayCollection();
        $this->contacts = new \Doctrine\Common\Collections\ArrayCollection(); 
        $this->entrepriseadresses = new \Doctrine\Common\Collections\ArrayCollection();
		$this->sessionparcoursstages = new \Doctrine\Common\Collections\ArrayCollection();
        $this->formateurEntreprises = new \Doctrine\Common\Collections\ArrayCollection();
        $this->archive = false;
    }
    
    /**
    * @ORM\OneToMany(targetEntity="App\Entity\Dossier", mappedBy="entreprise",cascade={"persist"})
    */
    private $dossiers;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\Devis", mappedBy="entreprise",cascade={"all"})
    */
    private $deviss;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\FormateurEntreprise", mappedBy="entreprise",cascade={"persist"})
    */
    private $formateurEntreprises;
    
    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Offer")
     */
    private $offer;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\StatutJuridique",cascade={"all"})
     * @var StatutJuridique
     */
    private $statutJuridique;
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tiers",cascade={"all"})
     */
    private $tiers;

    /**
     * @var string
     *
     * @ORM\Column(name="raisonSocial", type="string", length=255, nullable=true)
     */
    private $raisonSocial;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $caisseretraite;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prevoyance;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $urssaf;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg",cascade={"persist"})
     */
    private $conventioncollective;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg",cascade={"persist"})
     */
    private $typeemployeur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg",cascade={"persist"})
     */
    private $categorie;

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
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;
    
    /**
     * @var File
     *
     */
     private $file;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Financeur")
     */
    private $financeur;

    /**
     * @var string
     * 
     * @Assert\Email(
     *     message = "ce email '{{ value }}' est non valide.",
     *     checkMX = true
     * )
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg", cascade={"persist"})
     */
    private $naf;

    /**
     * @var string
     *
     * @ORM\Column(name="siret", type="string", length=255, nullable=true)
     */
    private $siret;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $rna;

    /**
     * @var string
     *
     * @ORM\Column(name="numTva", type="string", length=255, nullable=true)
     */
    private $numTva;

    /**
     * @var string
     *
     * @ORM\Column(name="effectif", type="string", length=65, nullable=true)
     */
    private $effectif;

    /**
     * @var string
     * 
     * @ORM\Column(name="profil", type="string", length=65, nullable=true)
     */
    private $profil;

    /**
     * @var string
     * 
     * @ORM\Column(name="typeProfil", type="string", length=65, nullable=true)
     */
    private $typeProfil;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\Tuteur", mappedBy="entreprise", cascade={"all"})
    */
    private $tuteurs;

    /**
    * @ORM\ManyToMany(targetEntity="App\Entity\Stage")
    */
    private $stages;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\SessionParcoursStage", mappedBy="entreprise", cascade={"all"})
    */
    private $sessionparcoursstages;

	/**
	* @ORM\JoinColumn(nullable=true)
	* @ORM\OneToOne(targetEntity="App\Entity\Upload", cascade={"persist", "remove"})
     */
    private $logo;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $archive;

	/**
	* @ORM\OneToOne(targetEntity="App\Entity\Tchat", cascade={"all"})
     */
    private $tchat;

    /**
    * @ORM\ManyToMany(targetEntity="App\Entity\Contact", inversedBy="entreprises",cascade={"persist"})
    */
    private $contacts;

    /**
     * @var \stdClass
     *
     * @ORM\OneToMany(targetEntity="App\Entity\EntrepriseAdresse", cascade={"persist", "remove"}, mappedBy="entreprise", orphanRemoval=true)
     */
    private $entrepriseadresses;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\PersonalInformations",cascade={"all"})
    */
    private $personalinformations;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $siteweb;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

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
    * @ORM\ManyToOne(targetEntity="App\Entity\Personne",cascade={"persist"})
    */
    private $personne;

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
     * Set archive
     *
     * @param boolean $archive
     *
     * @return Entreprise
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
     * @return Entreprise
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
     * @return Entreprise
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
     * Add tuteur
     *
     * @param \App\Entity\Tuteur $tuteur
     *
     * @return Entreprise
     */
    public function addTuteur(\App\Entity\Tuteur $tuteur)
    {
        $this->tuteurs[] = $tuteur;
		$tuteur->setEntreprise($this);
        return $this;
    }

    /**
     * Remove tuteur
     *
     * @param \App\Entity\Tuteur $tuteur
     */
    public function removeTuteur(\App\Entity\Tuteur $tuteur)
    {
        $this->tuteurs->removeElement($tuteur);
    }

    /**
     * Get tuteurs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTuteurs()
    {
        return $this->tuteurs;
    }

    /**
     * Add stage
     *
     * @param \App\Entity\Stage $stage
     *
     * @return Entreprise
     */
    public function addStage(\App\Entity\Stage $stage)
    {
        $this->stages[] = $stage;

        return $this;
    }

    /**
     * Remove stage
     *
     * @param \App\Entity\Stage $stage
     */
    public function removeStage(\App\Entity\Stage $stage)
    {
        $this->stages->removeElement($stage);
    }

    /**
     * Get stages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStages()
    {
        return $this->stages;
    }

    /**
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return Entreprise
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
     * @return Entreprise
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
     * Set raisonSocial
     *
     * @param string $raisonSocial
     *
     * @return Entreprise
     */
    public function setRaisonSocial($raisonSocial) {
        $this->raisonSocial = $raisonSocial;

        return $this;
    }

    /**
     * Get raisonSocial
     *
     * @return string
     */
    public function getRaisonSocial() {
        return $this->raisonSocial;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Entreprise
     */
    public function setUrl($url) {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Entreprise
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set siret
     *
     * @param string $siret
     *
     * @return Entreprise
     */
    public function setSiret($siret) {
        $this->siret = $siret;

        return $this;
    }

    /**
     * Get siret
     *
     * @return string
     */
    public function getSiret() {
        return $this->siret;
    }

    /**
     * Set numTva
     *
     * @param string $numTva
     *
     * @return Entreprise
     */
    public function setNumTva($numTva) {
        $this->numTva = $numTva;

        return $this;
    }

    /**
     * Get numTva
     *
     * @return string
     */
    public function getNumTva() {
        return $this->numTva;
    }

    /**
     * Set effectif
     *
     * @param string $effectif
     *
     * @return Entreprise
     */
    public function setEffectif($effectif) {
        $this->effectif = $effectif;

        return $this;
    }

    /**
     * Get effectif
     *
     * @return string
     */
    public function getEffectif() {
        return $this->effectif;
    }

    /**
     * Set profil
     *
     * @param string $profil
     *
     * @return Entreprise
     */
    public function setProfil($profil) {
        $this->profil = $profil;

        return $this;
    }

    /**
     * Get profil
     *
     * @return string
     */
    public function getProfil() {
        return $this->profil;
    }

    /**
     * Set typeProfil
     *
     * @param string $typeProfil
     *
     * @return Entreprise
     */
    public function setTypeProfil($typeProfil) {
        $this->typeProfil = $typeProfil;

        return $this;
    }

    /**
     * Get typeProfil
     *
     * @return string
     */
    public function getTypeProfil() {
        return $this->typeProfil;
    }

    /**
     * Set offer
     *
     * @param \App\Entity\Offer $offer
     *
     * @return Entreprise
     */
    public function setOffer(\App\Entity\Offer $offer = null)
    {
        $this->offer = $offer;

        return $this;
    }

    /**
     * Get offer
     *
     * @return \App\Entity\Offer
     */
    public function getOffer()
    {
        return $this->offer;
    }


    /**
     * @return StatutJuridique
     */
    public function getStatutJuridique()
    {
        return $this->statutJuridique;
    }

    /**
     * @param StatutJuridique $statutJuridique
     * @return Entreprise
     */
    public function setStatutJuridique($statutJuridique)
    {
        $this->statutJuridique = $statutJuridique;
        return $this;
    }

    /**
     * Set tchat
     *
     * @param \App\Entity\Tchat $tchat
     *
     * @return Entreprise
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
     * Add contact
     *
     * @param \App\Entity\Contact $contact
     *
     * @return Entreprise
     */
    public function addContact(\App\Entity\Contact $contact)
    {
        $this->contacts[] = $contact;

        return $this;
    }

    /**
     * Remove contact
     *
     * @param \App\Entity\Contact $contact
     */
    public function removeContact(\App\Entity\Contact $contact)
    {
        $this->contacts->removeElement($contact);
    }

    /**
     * Get contacts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContacts()
    {
        return $this->contacts;
    }

    /**
     * Set siteweb
     *
     * @param string $siteweb
     *
     * @return Entreprise
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
     * Set description
     *
     * @param string $description
     *
     * @return Entreprise
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
     * Set logo
     *
     * @param \App\Entity\Upload $logo
     *
     * @return Entreprise
     */
    public function setLogo(\App\Entity\Upload $logo = null)
    {
        $this->logo = $logo;
		$this->logo->setDirectoryUpload(strtolower((new \ReflectionClass($this))->getShortName().'-'.'logo'));
        return $this;
    }

    /**
     * Get logo
     *
     * @return \App\Entity\Upload
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set personalinformations
     *
     * @param \App\Entity\PersonalInformations $personalinformations
     *
     * @return Entreprise
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
     * Get contact
     *
     * @return \App\Entity\Contact
     */
    public function getContactprincipal()
    {
        $contacts= $this->contacts;
        $contact=null;
        foreach ($contacts as $item) {
            if($item->getPrincipal())return $item;
        }
        return $contact;
    }


    /**
     * Add entrepriseadress
     *
     * @param \App\Entity\EntrepriseAdresse $entrepriseadress
     *
     * @return Entreprise
     */
    public function addEntrepriseadress(\App\Entity\EntrepriseAdresse $entrepriseadress)
    {
        $this->entrepriseadresses[] = $entrepriseadress;
		$entrepriseadress->setEntreprise($this);
        return $this;
    }

    /**
     * Remove entrepriseadress
     *
     * @param \App\Entity\EntrepriseAdresse $entrepriseadress
     */
    public function removeEntrepriseadress(\App\Entity\EntrepriseAdresse $entrepriseadress)
    {
        $this->entrepriseadresses->removeElement($entrepriseadress);
    }

    /**
     * Get entrepriseadresses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEntrepriseadresses()
    {
        return $this->entrepriseadresses;
    }

    /**
     * Set codebanque
     *
     * @param string $codebanque
     *
     * @return Entreprise
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
     * @return Entreprise
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
     * @return Entreprise
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
     * @return Entreprise
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
     * @return Entreprise
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
     * Set conventioncollective
     *
     * @param \App\Entity\Masterlistelg $conventioncollective
     *
     * @return Entreprise
     */
    public function setConventioncollective(\App\Entity\Masterlistelg $conventioncollective = null)
    {
        $this->conventioncollective = $conventioncollective;

        return $this;
    }

    /**
     * Get conventioncollective
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getConventioncollective()
    {
        return $this->conventioncollective;
    }



    /**
     * Set categorie
     *
     * @param \App\Entity\Masterlistelg $categorie
     *
     * @return Entreprise
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
     * Set naf
     *
     * @param \App\Entity\Masterlistelg $naf
     *
     * @return Entreprise
     */
    public function setNaf(\App\Entity\Masterlistelg $naf = null)
    {
        $this->naf = $naf;
        return $this;
    }

    /**
     * Get naf
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getNaf()
    {
        return $this->naf;
    }
	
	public function estTuteur($contact)
	{
		$resultat=false;
		foreach($this->getTuteurs() as $tuteur)
		{
			if($tuteur->getPersonalinformations()==$contact){
				$resultat=true;
			}
		}
		return $resultat;
	}
	
	public function getTuteurByContact($contact)
	{
		$resultat=null;
		foreach($this->getTuteurs() as $tuteur)
		{
			if($tuteur->getPersonalinformations()==$contact){
				$resultat=$tuteur;
			}
		}
		return $resultat;
	}
	
	public function getContactByPersonal($personal)
	{
		$resultat=null;
		foreach($this->getContacts() as $contact)
		{
			if($contact->getPersonalinformations()==$personal){
				$resultat=$contact;
			}
		}
		return $resultat;
	}

	public function getContactsAndTuteurs()
	{
		$resultat=[];
		$i=0;
		foreach($this->getTuteurs() as $ligne)
		{
			$resultat[$i]['esttuteur']=true;
			$resultat[$i]['estcontact']=false;
			$resultat[$i]['objet']=$ligne;
			$i++;
		}
		foreach($this->getContacts() as $ligne)
		{
			$resultat[$i]['esttuteur']=false;
			$resultat[$i]['estcontact']=true;
			$resultat[$i]['objet']=$ligne;
			$i++;
		}
		return $resultat;
	}

    /**
     * Add sessionparcoursstage
     *
     * @param \App\Entity\SessionParcoursStage $sessionparcoursstage
     *
     * @return Entreprise
     */
    public function addSessionparcoursstage(\App\Entity\SessionParcoursStage $sessionparcoursstage)
    {
        $this->sessionparcoursstages[] = $sessionparcoursstage;
		$sessionparcoursstage->setEntreprise($this);
        return $this;
    }

    /**
     * Remove sessionparcoursstage
     *
     * @param \App\Entity\SessionParcoursStage $sessionparcoursstage
     */
    public function removeSessionparcoursstage(\App\Entity\SessionParcoursStage $sessionparcoursstage)
    {
        $this->sessionparcoursstages->removeElement($sessionparcoursstage);
    }

    /**
     * Get sessionparcoursstages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSessionparcoursstages()
    {
        return $this->sessionparcoursstages;
    }


    /**
     * Add dossier
     *
     * @param \App\Entity\Dossier $dossier
     *
     * @return Entreprise
     */
    public function addDossier(\App\Entity\Dossier $dossier)
    {
        $this->dossiers[] = $dossier;
        $dossier->setEntreprise($this);
        return $this;
    }

    /**
     * Remove dossier
     *
     * @param \App\Entity\Dossier $dossier
     */
    public function removeDossier(\App\Entity\Dossier $dossier)
    {
        $this->dossiers->removeElement($dossier);
    }

    /**
     * Get dossiers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDossiers()
    {
        return $this->dossiers;
    }

    /**
     * Set tiers.
     *
     * @param \App\Entity\Tiers|null $tiers
     *
     * @return Entreprise
     */
    public function setTiers(\App\Entity\Tiers $tiers = null)
    {
        $this->tiers = $tiers;

        return $this;
    }

    /**
     * Get tiers.
     *
     * @return \App\Entity\Tiers|null
     */
    public function getTiers()
    {
        return $this->tiers;
    }

    /**
     * Add formateurEntreprise.
     *
     * @param \App\Entity\FormateurEntreprise $formateurEntreprise
     *
     * @return Entreprise
     */
    public function addFormateurEntreprise(\App\Entity\FormateurEntreprise $formateurEntreprise)
    {
        $this->formateurEntreprises[] = $formateurEntreprise;
		$formateurEntreprise->setEntreprise($this);
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
     * Add deviss.
     *
     * @param \App\Entity\Devis $deviss
     *
     * @return Entreprise
     */
    public function addDeviss(\App\Entity\Devis $deviss)
    {
        $this->deviss[] = $deviss;
		$deviss->setEntreprise($this);
        return $this;
    }

    /**
     * Remove deviss.
     *
     * @param \App\Entity\Devis $deviss
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeDeviss(\App\Entity\Devis $deviss)
    {
        return $this->deviss->removeElement($deviss);
    }

    /**
     * Get deviss.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDeviss()
    {
        return $this->deviss;
    }

    /**
     * Set rna.
     *
     * @param string|null $rna
     *
     * @return Entreprise
     */
    public function setRna($rna = null)
    {
        $this->rna = $rna;

        return $this;
    }

    /**
     * Get rna.
     *
     * @return string|null
     */
    public function getRna()
    {
        return $this->rna;
    }

    /**
     * Set urssaf.
     *
     * @param string|null $urssaf
     *
     * @return Entreprise
     */
    public function setUrssaf($urssaf = null)
    {
        $this->urssaf = $urssaf;

        return $this;
    }

    /**
     * Get urssaf.
     *
     * @return string|null
     */
    public function getUrssaf()
    {
        return $this->urssaf;
    }

    /**
     * Set caisseretraite.
     *
     * @param string|null $caisseretraite
     *
     * @return Entreprise
     */
    public function setCaisseretraite($caisseretraite = null)
    {
        $this->caisseretraite = $caisseretraite;

        return $this;
    }

    /**
     * Get caisseretraite.
     *
     * @return string|null
     */
    public function getCaisseretraite()
    {
        return $this->caisseretraite;
    }

    /**
     * Set prevoyance.
     *
     * @param string|null $prevoyance
     *
     * @return Entreprise
     */
    public function setPrevoyance($prevoyance = null)
    {
        $this->prevoyance = $prevoyance;

        return $this;
    }

    /**
     * Get prevoyance.
     *
     * @return string|null
     */
    public function getPrevoyance()
    {
        return $this->prevoyance;
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

    /**
     * Set typeemployeur.
     *
     * @param \App\Entity\Masterlistelg|null $typeemployeur
     *
     * @return Entreprise
     */
    public function setTypeemployeur(\App\Entity\Masterlistelg $typeemployeur = null)
    {
        $this->typeemployeur = $typeemployeur;

        return $this;
    }

    /**
     * Get typeemployeur.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getTypeemployeur()
    {
        return $this->typeemployeur;
    }

    /**
     * Set financeur.
     *
     * @param \App\Entity\Financeur|null $financeur
     *
     * @return Entreprise
     */
    public function setFinanceur(\App\Entity\Financeur $financeur = null)
    {
        $this->financeur = $financeur;

        return $this;
    }

    /**
     * Get financeur.
     *
     * @return \App\Entity\Financeur|null
     */
    public function getFinanceur()
    {
        return $this->financeur;
    }

    

    /**
     * Set personne
     *
     * @param \App\Entity\Personne $personne
     *
     * @return Contact
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
    
}
