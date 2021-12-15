<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * PersonalInformations
 *
 * @ORM\Table(name="personal_informations")
 * @ORM\Entity(repositoryClass="App\Repository\PersonalInformationsRepository")
 */
class PersonalInformations {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $civilite;

    /**
     * @var string
     * @ORM\Column(name="nom", type="string", length=100, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_jeune_fille", type="string", length=100, nullable=true)
     */
    private $nomJeuneFille;

    /**
     * @var string
     * @ORM\Column(name="prenom", type="string", length=50, nullable=true)
     */
    private $prenom;

    /**
     * @var string
     * @ORM\Column(type="string", length=250, nullable=true)
     */
    private $autresprenoms;

    /**
     * @var string
     *
     * @ORM\Column(name="ville_naissance", type="string", length=200, nullable=true)
     */
    private $villeNaissance;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $departementnaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="pays_naissance", type="string", length=200, nullable=true)
     */
    private $paysnaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="nationality", type="string", length=200, nullable=true)
     */
    private $nationality;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $nationalite;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $regimesocial;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $arepresentantlegal;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nomreplegal;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prenomreplegal;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telreplegal;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numvoiereplegal;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $voiereplegal;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cpreplegal;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $communereplegal;

    /**
     * @var string
     *
     * @ORM\Column(name="telfixe", type="string", length=20, nullable=true)
     */
    private $telfixe;

    /**
     * @var string
     * @ORM\Column(name="telmobile", type="string", length=20, nullable=true)
     */
    private $telmobile;

    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=20, nullable=true)
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fonction;

    /**
     * @var string
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $numsecusociale;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $referentadministratif;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $referentabsences;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $referentcommercial;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $representantlegal;

    /**
     * @var string
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $publierweb;

	/**
	* @ORM\JoinColumn(nullable=true)
	* @ORM\OneToOne(targetEntity="App\Entity\Upload", cascade={"persist", "remove"})
     */
    private $photo;

    /**
    * @ORM\JoinColumn(nullable=true)
    * @ORM\OneToOne(targetEntity="App\Entity\Upload", cascade={"persist", "remove"})
     */
    private $signature;

    /**
     * @var string
     *
     * @ORM\Column(name="alt_photo", type="string", length=65, nullable=true)
     */
    private $altphoto;

    /**
     * @var string
     * @ORM\Column(name="adresse", type="string", length=200, nullable=true)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse_complementaire", type="string", length=200, nullable=true)
     */
    private $adresseComplementaire;

    /**
     * @var string
     * @ORM\Column(name="ville", type="string", length=200, nullable=true)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=200, nullable=true)
     */
    private $pays;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_naissance", type="date", nullable=true)
     */
    private $dateNaissance;

    /**
     * @var string
     * @ORM\Column(name="cp", type="string", length=20, nullable=true)
     */
    private $cp;

    /**
     * @var string
     * @ORM\Column(name="cv", type="string", length=200, nullable=true)
     */
    private $cv;

	/**
	* @ORM\JoinColumn(nullable=true)
	* @ORM\OneToOne(targetEntity="App\Entity\Adresse", cascade={"persist", "remove"})
     */
    private $adressev3;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $esttuteur;

    /**
     * @var string
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $handicap;

    /**
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $handicapremarques;

    /**
     * @var string
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $reconnaissancehandicap;

    /**
     * @var string
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $nomurgence;

    /**
     * @var string
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $prenomurgence;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $telurgence;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;


    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $connuDoranco;


     /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_cartesejour", type="date", nullable=true)
     */
    private $datecartesejour;

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
     * Set nom
     *
     * @param string $nom
     *
     * @return PersonalInformations
     */
    public function setNom($nom)
    {
        $this->nom = strtoupper($nom);

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set nomJeuneFille
     *
     * @param string $nomJeuneFille
     *
     * @return PersonalInformations
     */
    public function setNomJeuneFille($nomJeuneFille)
    {
        $this->nomJeuneFille = $nomJeuneFille;

        return $this;
    }

    /**
     * Get nomJeuneFille
     *
     * @return string
     */
    public function getNomJeuneFille()
    {
        return $this->nomJeuneFille;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return PersonalInformations
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set villeNaissance
     *
     * @param string $villeNaissance
     *
     * @return PersonalInformations
     */
    public function setVilleNaissance($villeNaissance)
    {
        $this->villeNaissance = $villeNaissance;

        return $this;
    }

    /**
     * Get villeNaissance
     *
     * @return string
     */
    public function getVilleNaissance()
    {
        return $this->villeNaissance;
    }

    /**
     * Set paysnaissance
     *
     * @param string $paysnaissance
     *
     * @return PersonalInformations
     */
    public function setPaysnaissance($paysnaissance)
    {
        $this->paysnaissance = $paysnaissance;

        return $this;
    }

    /**
     * Get paysnaissance
     *
     * @return string
     */
    public function getPaysnaissance()
    {
        return $this->paysnaissance;
    }

    /**
     * Set nationality
     *
     * @param string $nationality
     *
     * @return PersonalInformations
     */
    public function setNationality($nationality)
    {
        $this->nationality = $nationality;

        return $this;
    }

    /**
     * Get nationality
     *
     * @return string
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * Set telfixe
     *
     * @param string $telfixe
     *
     * @return PersonalInformations
     */
    public function setTelfixe($telfixe)
    {
        $this->telfixe = $telfixe;

        return $this;
    }

    /**
     * Get telfixe
     *
     * @return string
     */
    public function getTelfixe()
    {
        return $this->telfixe;
    }

    /**
     * Set telmobile
     *
     * @param string $telmobile
     *
     * @return PersonalInformations
     */
    public function setTelmobile($telmobile)
    {
        $this->telmobile = $telmobile;

        return $this;
    }

    /**
     * Get telmobile
     *
     * @return string
     */
    public function getTelmobile()
    {
        return $this->telmobile;
    }

    /**
     * Set fax
     *
     * @param string $fax
     *
     * @return PersonalInformations
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

     /**
     * Set connuDoranco
     *
     * @param \App\Entity\Masterlistelg $connuDoranco
     *
     * @return Dossier
     */
    public function setConnuDoranco(\App\Entity\Masterlistelg $connuDoranco = null)
    {
        $this->connuDoranco = $connuDoranco;

        return $this;
    }

    /**
     * Get connuDoranco
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getConnuDoranco()
    {
        return $this->connuDoranco;
    }

    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     *
     * @return PersonalInformations
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }


    /**
     * Set datecartesejour
     *
     * @param \DateTime datecartesejour
     *
     * @return PersonalInformations
     */
    public function setDateCartesejour($datecartesejour)
    {
        $this->datecartesejour = $datecartesejour;

        return $this;
    }

    /**
     * Get datecartesejour
     *
     * @return \DateTime
     */
    public function getDateCartesejour()
    {
        return $this->datecartesejour;
    }




    /**
     * Set fonction
     *
     * @param string $fonction
     *
     * @return PersonalInformations
     */
    public function setFonction($fonction)
    {
        $this->fonction = $fonction;

        return $this;
    }

    /**
     * Get fonction
     *
     * @return string
     */
    public function getFonction()
    {
        return $this->fonction;
    }

    /**
     * Set publierweb
     *
     * @param boolean $publierweb
     *
     * @return PersonalInformations
     */
    public function setPublierweb($publierweb)
    {
        $this->publierweb = $publierweb;

        return $this;
    }

    /**
     * Get publierweb
     *
     * @return boolean
     */
    public function getPublierweb()
    {
        return $this->publierweb;
    }

    /**
     * Set altphoto
     *
     * @param string $altphoto
     *
     * @return PersonalInformations
     */
    public function setAltphoto($altphoto)
    {
        $this->altphoto = $altphoto;

        return $this;
    }

    /**
     * Get altphoto
     *
     * @return string
     */
    public function getAltphoto()
    {
        return $this->altphoto;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return PersonalInformations
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
     * Set photo
     * @param \App\Entity\Upload $photo
     * @return PersonalInformations
     */
    public function setPhoto(\App\Entity\Upload $photo = null)
    {
        $this->photo = $photo;
//		$this->photo->setDirectoryUpload(strtolower((new \ReflectionClass($this))->getShortName().'-'.'photo'));
		if(! is_null($photo))$this->photo->setDirectoryUpload($this->getDirectoryUpload());
        return $this;
    }
	
	public function getDirectoryUpload()
	{
		return strtolower((new \ReflectionClass($this))->getShortName().'-'.'photo');
	}

    /**
     * Get photo
     *
     * @return \App\Entity\Upload
     */
    public function getPhoto()
    {
        return $this->photo;
    }
	
    public function getFullName()
    {
            return strtoupper($this->getNom()) . ' '. $this->getPrenom();
    }



    
    public function getDirectoryUploadSignature()
    {
        return strtolower((new \ReflectionClass($this))->getShortName().'-'.'signature');
    }
    /**
     * Set signature
     * @param \App\Entity\Upload $signature
     * @return PersonalInformations
     */
    public function setSignature(\App\Entity\Upload $signature = null)
    {
        $this->signature = $signature;
        $this->signature->setDirectoryUpload($this->getDirectoryUploadSignature());
        return $this;
    }
    /**
     * Get signature
     *
     * @return \App\Entity\Upload
     */
    public function getSignature()
    {
        return $this->signature;
    }


    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return PersonalInformations
     */
    public function setAdresse($adresse) {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse() {
        return $this->adresse;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return PersonalInformations
     */
    public function setVille($ville) {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille() {
        return $this->ville;
    }

    /**
     * Set pays
     *
     * @param string $pays
     *
     * @return PersonalInformations
     */
    public function setPays($pays) {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return string
     */
    public function getPays() {
        return $this->pays;
    } 
     /**
     * Set adresseComplementaire
     *
     * @param string $adresseComplementaire
     *
     * @return PersonalInformations
     */
    public function setAdresseComplementaire($adresseComplementaire) {
        $this->adresseComplementaire = $adresseComplementaire;

        return $this;
    }

    /**
     * Get adresseComplementaire
     *
     * @return string
     */
    public function getAdresseComplementaire() {
        return $this->adresseComplementaire;
    }


    /**
     * Set cp
     *
     * @param string $cp
     *
     * @return PersonalInformations
     */
    public function setCp($cp) {
        $this->cp = $cp;

        return $this;
    }

    /**
     * Get cp
     *
     * @return string
     */
    public function getCp() {
        return $this->cp;
    }


    /**
     * Set cv
     *
     * @param string $cv
     *
     * @return PersonalInformations
     */
    public function setCv($cv) {
        $this->cv = $cv;

        return $this;
    }

    /**
     * Get cv
     *
     * @return string
     */
    public function getCv() {
        return $this->cv;
    }

    /**
     * Set civilite
     *
     * @param \App\Entity\Masterlistelg $civilite
     *
     * @return PersonalInformations
     */
    public function setCivilite(\App\Entity\Masterlistelg $civilite = null)
    {
        $this->civilite = $civilite;

        return $this;
    }

    /**
     * Get civilite
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getCivilite()
    {
        return $this->civilite;
    }
	

    /**
     * Set adressev3
     *
     * @param \App\Entity\Adresse $adressev3
     *
     * @return PersonalInformations
     */
    public function setAdressev3(\App\Entity\Adresse $adressev3 = null)
    {
        $this->adressev3 = $adressev3;

        return $this;
    }

    /**
     * Get adressev3
     *
     * @return \App\Entity\Adresse
     */
    public function getAdressev3()
    {
        return $this->adressev3;
    }

    /**
     * Set autresprenoms
     *
     * @param string $autresprenoms
     *
     * @return PersonalInformations
     */
    public function setAutresprenoms($autresprenoms)
    {
        $this->autresprenoms = $autresprenoms;

        return $this;
    }

    /**
     * Get autresprenoms
     *
     * @return string
     */
    public function getAutresprenoms()
    {
        return $this->autresprenoms;
    }

    /**
     * Set handicap
     *
     * @param boolean $handicap
     *
     * @return PersonalInformations
     */
    public function setHandicap($handicap)
    {
        $this->handicap = $handicap;

        return $this;
    }

    /**
     * Get handicap
     *
     * @return boolean
     */
    public function getHandicap()
    {
        return $this->handicap;
    }

    /**
     * Set handicapremarques
     *
     * @param string $handicapremarques
     *
     * @return PersonalInformations
     */
    public function setHandicapremarques($handicapremarques)
    {
        $this->handicapremarques = $handicapremarques;

        return $this;
    }

    /**
     * Get handicapremarques
     *
     * @return string
     */
    public function getHandicapremarques()
    {
        return $this->handicapremarques;
    }

    /**
     * Set nomurgence
     *
     * @param string $nomurgence
     *
     * @return PersonalInformations
     */
    public function setNomurgence($nomurgence)
    {
        $this->nomurgence = $nomurgence;

        return $this;
    }

    /**
     * Get nomurgence
     *
     * @return string
     */
    public function getNomurgence()
    {
        return $this->nomurgence;
    }

    /**
     * Set prenomurgence
     *
     * @param string $prenomurgence
     *
     * @return PersonalInformations
     */
    public function setPrenomurgence($prenomurgence)
    {
        $this->prenomurgence = $prenomurgence;

        return $this;
    }

    /**
     * Get prenomurgence
     *
     * @return string
     */
    public function getPrenomurgence()
    {
        return $this->prenomurgence;
    }

    /**
     * Set telurgence
     *
     * @param string $telurgence
     *
     * @return PersonalInformations
     */
    public function setTelurgence($telurgence)
    {
        $this->telurgence = $telurgence;

        return $this;
    }

    /**
     * Get telurgence
     *
     * @return string
     */
    public function getTelurgence()
    {
        return $this->telurgence;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return PersonalInformations
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

	public function getAge()
    {
        $now = new \DateTime('now');
        $age = $this->dateNaissance;
        $difference = $now->diff($age);

        return $difference->format('%y');
    }	

    /**
     * Set numsecusociale.
     *
     * @param string|null $numsecusociale
     *
     * @return PersonalInformations
     */
    public function setNumsecusociale($numsecusociale = null)
    {
        $this->numsecusociale = $numsecusociale;

        return $this;
    }

    /**
     * Get numsecusociale.
     *
     * @return string|null
     */
    public function getNumsecusociale()
    {
        return $this->numsecusociale;
    }

    /**
     * Set referentadministratif.
     *
     * @param bool|null $referentadministratif
     *
     * @return PersonalInformations
     */
    public function setReferentadministratif($referentadministratif = null)
    {
        $this->referentadministratif = $referentadministratif;

        return $this;
    }

    /**
     * Get referentadministratif.
     *
     * @return bool|null
     */
    public function getReferentadministratif()
    {
        return $this->referentadministratif;
    }

    /**
     * Set referentabsences.
     *
     * @param bool|null $referentabsences
     *
     * @return PersonalInformations
     */
    public function setReferentabsences($referentabsences = null)
    {
        $this->referentabsences = $referentabsences;

        return $this;
    }

    /**
     * Get referentabsences.
     *
     * @return bool|null
     */
    public function getReferentabsences()
    {
        return $this->referentabsences;
    }

    /**
     * Set referentcommercial.
     *
     * @param bool|null $referentcommercial
     *
     * @return PersonalInformations
     */
    public function setReferentcommercial($referentcommercial = null)
    {
        $this->referentcommercial = $referentcommercial;

        return $this;
    }

    /**
     * Get referentcommercial.
     *
     * @return bool|null
     */
    public function getReferentcommercial()
    {
        return $this->referentcommercial;
    }

    /**
     * Set reconnaissancehandicap.
     *
     * @param bool|null $reconnaissancehandicap
     *
     * @return PersonalInformations
     */
    public function setReconnaissancehandicap($reconnaissancehandicap = null)
    {
        $this->reconnaissancehandicap = $reconnaissancehandicap;

        return $this;
    }

    /**
     * Get reconnaissancehandicap.
     *
     * @return bool|null
     */
    public function getReconnaissancehandicap()
    {
        return $this->reconnaissancehandicap;
    }

    /**
     * Set esttuteur.
     *
     * @param bool|null $esttuteur
     *
     * @return PersonalInformations
     */
    public function setEsttuteur($esttuteur = null)
    {
        $this->esttuteur = $esttuteur;

        return $this;
    }

    /**
     * Get esttuteur.
     *
     * @return bool|null
     */
    public function getEsttuteur()
    {
        return $this->esttuteur;
    }

    /**
     * Set arepresentantlegal.
     *
     * @param bool|null $arepresentantlegal
     *
     * @return PersonalInformations
     */
    public function setArepresentantlegal($arepresentantlegal = null)
    {
        $this->arepresentantlegal = $arepresentantlegal;

        return $this;
    }

    /**
     * Get arepresentantlegal.
     *
     * @return bool|null
     */
    public function getArepresentantlegal()
    {
        return $this->arepresentantlegal;
    }

    /**
     * Set nomreplegal.
     *
     * @param string|null $nomreplegal
     *
     * @return PersonalInformations
     */
    public function setNomreplegal($nomreplegal = null)
    {
        $this->nomreplegal = $nomreplegal;

        return $this;
    }

    /**
     * Get nomreplegal.
     *
     * @return string|null
     */
    public function getNomreplegal()
    {
        return $this->nomreplegal;
    }

    /**
     * Set prenomreplegal.
     *
     * @param string|null $prenomreplegal
     *
     * @return PersonalInformations
     */
    public function setPrenomreplegal($prenomreplegal = null)
    {
        $this->prenomreplegal = $prenomreplegal;

        return $this;
    }

    /**
     * Get prenomreplegal.
     *
     * @return string|null
     */
    public function getPrenomreplegal()
    {
        return $this->prenomreplegal;
    }

    /**
     * Set telreplegal.
     *
     * @param string|null $telreplegal
     *
     * @return PersonalInformations
     */
    public function setTelreplegal($telreplegal = null)
    {
        $this->telreplegal = $telreplegal;

        return $this;
    }

    /**
     * Get telreplegal.
     *
     * @return string|null
     */
    public function getTelreplegal()
    {
        return $this->telreplegal;
    }

    /**
     * Set numvoiereplegal.
     *
     * @param string|null $numvoiereplegal
     *
     * @return PersonalInformations
     */
    public function setNumvoiereplegal($numvoiereplegal = null)
    {
        $this->numvoiereplegal = $numvoiereplegal;

        return $this;
    }

    /**
     * Get numvoiereplegal.
     *
     * @return string|null
     */
    public function getNumvoiereplegal()
    {
        return $this->numvoiereplegal;
    }

    /**
     * Set voiereplegal.
     *
     * @param string|null $voiereplegal
     *
     * @return PersonalInformations
     */
    public function setVoiereplegal($voiereplegal = null)
    {
        $this->voiereplegal = $voiereplegal;

        return $this;
    }

    /**
     * Get voiereplegal.
     *
     * @return string|null
     */
    public function getVoiereplegal()
    {
        return $this->voiereplegal;
    }

    /**
     * Set cpreplegal.
     *
     * @param string|null $cpreplegal
     *
     * @return PersonalInformations
     */
    public function setCpreplegal($cpreplegal = null)
    {
        $this->cpreplegal = $cpreplegal;

        return $this;
    }

    /**
     * Get cpreplegal.
     *
     * @return string|null
     */
    public function getCpreplegal()
    {
        return $this->cpreplegal;
    }

    /**
     * Set communereplegal.
     *
     * @param string|null $communereplegal
     *
     * @return PersonalInformations
     */
    public function setCommunereplegal($communereplegal = null)
    {
        $this->communereplegal = $communereplegal;

        return $this;
    }

    /**
     * Get communereplegal.
     *
     * @return string|null
     */
    public function getCommunereplegal()
    {
        return $this->communereplegal;
    }

    /**
     * Set departementnaissance.
     *
     * @param string|null $departementnaissance
     *
     * @return PersonalInformations
     */
    public function setDepartementnaissance($departementnaissance = null)
    {
        $this->departementnaissance = $departementnaissance;

        return $this;
    }

    /**
     * Get departementnaissance.
     *
     * @return string|null
     */
    public function getDepartementnaissance()
    {
        return $this->departementnaissance;
    }

    /**
     * Set nationalite.
     *
     * @param \App\Entity\Masterlistelg|null $nationalite
     *
     * @return PersonalInformations
     */
    public function setNationalite(\App\Entity\Masterlistelg $nationalite = null)
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    /**
     * Get nationalite.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getNationalite()
    {
        return $this->nationalite;
    }

    /**
     * Set regimesocial.
     *
     * @param \App\Entity\Masterlistelg|null $regimesocial
     *
     * @return PersonalInformations
     */
    public function setRegimesocial(\App\Entity\Masterlistelg $regimesocial = null)
    {
        $this->regimesocial = $regimesocial;

        return $this;
    }

    /**
     * Get regimesocial.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getRegimesocial()
    {
        return $this->regimesocial;
    }

    /**
     * Set representantlegal.
     *
     * @param bool|null $representantlegal
     *
     * @return PersonalInformations
     */
    public function setRepresentantlegal($representantlegal = null)
    {
        $this->representantlegal = $representantlegal;

        return $this;
    }

    /**
     * Get representantlegal.
     *
     * @return bool|null
     */
    public function getRepresentantlegal()
    {
        return $this->representantlegal;
    }
}
