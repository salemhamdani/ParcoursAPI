<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CvFormation
 *
 * @ORM\Table(name="cv_formation")
 * @ORM\Entity(repositoryClass="App\Repository\CvFormationRepository")
 */
class CvFormation {

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
     * @var string
     *
     * @ORM\Column(name="ecole", type="string", length=65, nullable=true)
     */
    private $ecole;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=65, nullable=true)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="diplome", type="string", length=65, nullable=true)
     */
    private $diplome;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="domaineEtude", type="string", length=65, nullable=true)
     */
    private $domaineEtude;

    /**
     * @var string
     *
     * @ORM\Column(name="resultatObtenu", type="string", length=65, nullable=true)
     */
    private $resultatObtenu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDebut", type="date", nullable=true)
     */
    private $dateDebut;

    /**
     * @var \DateTime
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
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set ecole
     *
     * @param string $ecole
     *
     * @return CvFormation
     */
    public function setEcole($ecole) {
        $this->ecole = $ecole;

        return $this;
    }

    /**
     * Get ecole
     *
     * @return string
     */
    public function getEcole() {
        return $this->ecole;
    }
    
    /**
     * Set diplome
     *
     * @param string $diplome
     *
     * @return CvFormation
     */
    public function setDiplome($diplome) {
        $this->diplome = $diplome;

        return $this;
    }

    /**
     * Get diplome
     *
     * @return string
     */
    public function getDiplome() {
        return $this->diplome;
    }

    /**
     * Set domaineEtude
     *
     * @param string $domaineEtude
     *
     * @return CvFormation
     */
    public function setDomaineEtude($domaineEtude) {
        $this->domaineEtude = $domaineEtude;

        return $this;
    }

    /**
     * Get domaineEtude
     *
     * @return string
     */
    public function getDomaineEtude() {
        return $this->domaineEtude;
    }

    /**
     * Set resultatObtenu
     *
     * @param string $resultatObtenu
     *
     * @return CvFormation
     */
    public function setResultatObtenu($resultatObtenu) {
        $this->resultatObtenu = $resultatObtenu;

        return $this;
    }

    /**
     * Get resultatObtenu
     *
     * @return string
     */
    public function getResultatObtenu() {
        return $this->resultatObtenu;
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return CvFormation
     */
    public function setDateDebut($dateDebut) {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut() {
         return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return CvFormation
     */
    public function setDateFin($dateFin) {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin() {
        return $this->dateFin;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return CvFormation
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
     * @return CvFormation
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
     * Set type
     *
     * @param \App\Entity\Masterlistelg $type
     *
     * @return Employe
     */
    public function setType(\App\Entity\Masterlistelg $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get qualite
     *
     * @return \App\Entity\Masterlistelg
     */
    
    public function getType()
    {
        return $this->type;
    }


    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return CvFormation
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }
    
    /**
     * Set intitule
     *
     * @param string $intitule
     *
     * @return CvFormation
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
     * Set personne
     *
     * @param \App\Entity\Personne $personne
     *
     * @return Personne
     */
    public function setPersonne(\App\Entity\Personne $personne = null) {
        $this->personne = $personne;

        return $this;
    }

    /**
     * Get personne
     *
     * @return \App\Entity\Personne
     */
    public function getPersonne() {
        return $this->personne;
    }



}
