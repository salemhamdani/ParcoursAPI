<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CvExperience
 *
 * @ORM\Table(name="cv_experience")
 * @ORM\Entity(repositoryClass="App\Repository\CvExperienceRepository")
 */
class CvExperience {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Personne", inversedBy="formations",cascade={"persist"})
     * @ORM\JoinColumn(name="formateur_id", nullable=true, onDelete="CASCADE" )
     */
    private $personne;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Formateur", inversedBy="experiences",cascade={"persist"})
     * @ORM\JoinColumn(name="formateurexp_id", nullable=true, onDelete="CASCADE" )
     */
    private $formateur;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $typePublic;


    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $typeFormation;

    /**
     * @var string
     *
     * @ORM\Column(name="poste", type="string", length=65, nullable=true)
     */
    private $poste;

    /**
     * @var string
     *
     * @ORM\Column(name="etablissement", type="string", length=65, nullable=true)
     */
    private $etablissement;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=65, nullable=true)
     */
    private $adresse;

    /**
     * @var \Date
     *
     * @ORM\Column(name="dateDebut", type="date", nullable=true)
     */
    private $dateDebut;

    /**
     * @var \Date
     *
     * @ORM\Column(name="dateFin", type="date", nullable=true)
     */
    private $dateFin;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var boolean 
     *
     * @ORM\Column(name="formationEtat", type="boolean", nullable=true)
     */
    private $formationEtat;

    /**
     * @var boolean 
     *
     * @ORM\Column(name="posteStatut", type="boolean", nullable=true)
     */
    private $posteStatut;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set poste
     *
     * @param string $poste
     *
     * @return Experience
     */
    public function setPoste($poste) {
        $this->poste = $poste;

        return $this;
    }

    /**
     * Get poste
     *
     * @return string
     */
    public function getPoste() {
        return $this->poste;
    }

    /**
     * Set entreprise
     *
     * @param string $entreprise
     *
     * @return Experience
     */
    public function setEntreprise($entreprise) {
        $this->entreprise = $entreprise;

        return $this;
    }

    /**
     * Get entreprise
     *
     * @return string
     */
    public function getEntreprise() {
        return $this->entreprise;
    }

    /**
     * Set lieu
     *
     * @param string $lieu
     *
     * @return Experience
     */
    public function setLieu($lieu) {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return string
     */
    public function getLieu() {
        return $this->lieu;
    }

    /**
     * Set dateDebut
     *
     * @param \Date $dateDebut
     *
     * @return Experience
     */
    public function setDateDebut($dateDebut) {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \Date
     */
    public function getDateDebut() {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \Date $dateFin
     *
     * @return Experience
     */
    public function setDateFin($dateFin) {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \Date
     */
    public function getDateFin() {
        return $this->dateFin;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Experience
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set formateur
     *
     * @param \App\Entity\Formateur $formateur
     *
     * @return Experience
     */
    public function setFormateur(\App\Entity\Formateur $formateur = null) {
        $this->formateur = $formateur;

        return $this;
    }

    /**
     * Get formateur
     *
     * @return \App\Entity\Formateur
     */
    public function getFormateur() {
        return $this->formateur;
    }

    /**
     * Set posteStatut
     *
     * @param boolean $posteStatut
     *
     * @return Experience
     */
    public function setPosteStatut($posteStatut) {
        $this->posteStatut = $posteStatut;

        return $this;
    }

    /**
     * Get posteStatut
     *
     * @return boolean
     */
    public function getPosteStatut() {
        return $this->posteStatut;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->typePublic = new \Doctrine\Common\Collections\ArrayCollection();
        $this->typeFormation = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set formationEtat
     *
     * @param boolean $formationEtat
     *
     * @return Experience
     */
    public function setFormationEtat($formationEtat) {
        $this->formationEtat = $formationEtat;

        return $this;
    }

    /**
     * Get formationEtat
     *
     * @return boolean
     */
    public function getFormationEtat() {
        return $this->formationEtat;
    }

    /**
     * Add typePublic
     *
     * @param \App\Entity\Masterlistelg $typePublic
     *
     * @return Experience
     */
    public function addTypePublic(\App\Entity\Masterlistelg $typePublic) {
        $typePublic->addExperience($this);
        $this->typePublic[] = $typePublic;

        return $this;
    }

    /**
     * Remove typePublic
     *
     * @param \App\Entity\Masterlistelg $typePublic
     */
    public function removeTypePublic(\App\Entity\Masterlistelg $typePublic) {
        $this->typePublic->removeElement($typePublic);
    }

    /**
     * Get typePublic
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTypePublic() {
        return $this->typePublic;
    }

    /**
     * Add typeFormation
     *
     * @param \App\Entity\Masterlistelg $typeFormation
     *
     * @return Experience
     */
    public function addTypeFormation(\App\Entity\Masterlistelg $typeFormation) {
        $typeFormation->addExperience($this);
        $this->typeFormation[] = $typeFormation;

        return $this;
    }

    /**
     * Remove typeFormation
     *
     * @param \App\Entity\Masterlistelg $typeFormation
     */
    public function removeTypeFormation(\App\Entity\Masterlistelg $typeFormation) {
        $this->typeFormation->removeElement($typeFormation);
    }

    /**
     * Get typeFormation
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTypeFormation() {
        return $this->typeFormation;
    }


    /**
     * Set etablissement.
     *
     * @param string|null $etablissement
     *
     * @return CvExperience
     */
    public function setEtablissement($etablissement = null)
    {
        $this->etablissement = $etablissement;

        return $this;
    }

    /**
     * Get etablissement.
     *
     * @return string|null
     */
    public function getEtablissement()
    {
        return $this->etablissement;
    }

    /**
     * Set adresse.
     *
     * @param string|null $adresse
     *
     * @return CvExperience
     */
    public function setAdresse($adresse = null)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse.
     *
     * @return string|null
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set personne.
     *
     * @param \App\Entity\Personne|null $personne
     *
     * @return CvExperience
     */
    public function setPersonne(\App\Entity\Personne $personne = null)
    {
        $this->personne = $personne;

        return $this;
    }

    /**
     * Get personne.
     *
     * @return \App\Entity\Personne|null
     */
    public function getPersonne()
    {
        return $this->personne;
    }

    /**
     * Set typePublic.
     *
     * @param \App\Entity\Masterlistelg|null $typePublic
     *
     * @return CvExperience
     */
    public function setTypePublic(\App\Entity\Masterlistelg $typePublic = null)
    {
        $this->typePublic = $typePublic;

        return $this;
    }

    /**
     * Set typeFormation.
     *
     * @param \App\Entity\Masterlistelg|null $typeFormation
     *
     * @return CvExperience
     */
    public function setTypeFormation(\App\Entity\Masterlistelg $typeFormation = null)
    {
        $this->typeFormation = $typeFormation;

        return $this;
    }
}
