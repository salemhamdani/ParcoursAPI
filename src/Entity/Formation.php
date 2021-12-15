<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Formation
 *
 * @ORM\Table(name="formation")
 * @ORM\Entity(repositoryClass="App\Repository\FormationRepository")
 */
class Formation {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Formateur", inversedBy="formations",cascade={"persist"})
     * @ORM\JoinColumn(name="formateur_id", nullable=true, onDelete="CASCADE" )
     */
    private $formateur;

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
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=65, nullable=true)
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
     * @var string
     *
     * @ORM\Column(name="intitule", type="string", length=65, nullable=true)
     */
    private $intitule;

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
     * @return Formation
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
     * @return Formation
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
     * @return Formation
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
     * @return Formation
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
     * @return Formation
     */
    public function setDateDebut($dateDebut) {
        $this->dateDebut = \DateTime::createFromFormat('d/m/Y', $dateDebut);

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut() {
        if ($this->dateDebut == null) {
            return $this->dateDebut;
        } else {
            return $this->dateDebut->format('d/m/Y');
        }
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return Formation
     */
    public function setDateFin($dateFin) {
        $this->dateFin = \DateTime::createFromFormat('d/m/Y', $dateFin);

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin() {

        if ($this->dateFin == null) {
            return $this->dateFin;
        } else {
            return $this->dateFin->format('d/m/Y');
        }
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Formation
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
     * @return Formation
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
     * @param string $type
     *
     * @return Formation
     */
    public function setType($type) {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType() {
        return $this->type;
    }


    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Formation
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
     * @return Formation
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

}
