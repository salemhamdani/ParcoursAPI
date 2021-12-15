<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cursuslg
 *
 * @ORM\Table(name="cursuslg")
 * @ORM\Entity(repositoryClass="App\Repository\CursuslgRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Cursuslg {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cursus", inversedBy="cursuslgs",cascade={"persist"})
     */
    private $cursus;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $categorie;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=65, nullable=true)
     */
    private $etablissement;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=65, nullable=true)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=65, nullable=true)
     */
    private $diplome;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $typeligne;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=65, nullable=true)
     */
    private $domaineEtude;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=65, nullable=true)
     */
    private $resultatObtenu;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $typePublic;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=65, nullable=true)
     */
    private $poste;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=65, nullable=true)
     */
    private $adresse;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateFin;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @var boolean 
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $formationEtat;

    /**
     * @var boolean 
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $posteStatut;

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
     * Set dateinsert.
     *
     * @param \DateTime|null $dateinsert
     *
     * @return Cursuslg
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
     * @return Cursuslg
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
     * Set cursus.
     *
     * @param \App\Entity\Cursus|null $cursus
     *
     * @return Cursuslg
     */
    public function setCursus(\App\Entity\Cursus $cursus = null)
    {
        $this->cursus = $cursus;

        return $this;
    }

    /**
     * Get cursus.
     *
     * @return \App\Entity\Cursus|null
     */
    public function getCursus()
    {
        return $this->cursus;
    }

    /**
     * Set categorie.
     *
     * @param \App\Entity\Masterlistelg|null $categorie
     *
     * @return Cursuslg
     */
    public function setCategorie(\App\Entity\Masterlistelg $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set etablissement.
     *
     * @param string|null $etablissement
     *
     * @return Cursuslg
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
     * Set ville.
     *
     * @param string|null $ville
     *
     * @return Cursuslg
     */
    public function setVille($ville = null)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville.
     *
     * @return string|null
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set diplome.
     *
     * @param string|null $diplome
     *
     * @return Cursuslg
     */
    public function setDiplome($diplome = null)
    {
        $this->diplome = $diplome;

        return $this;
    }

    /**
     * Get diplome.
     *
     * @return string|null
     */
    public function getDiplome()
    {
        return $this->diplome;
    }

    /**
     * Set domaineEtude.
     *
     * @param string|null $domaineEtude
     *
     * @return Cursuslg
     */
    public function setDomaineEtude($domaineEtude = null)
    {
        $this->domaineEtude = $domaineEtude;

        return $this;
    }

    /**
     * Get domaineEtude.
     *
     * @return string|null
     */
    public function getDomaineEtude()
    {
        return $this->domaineEtude;
    }

    /**
     * Set resultatObtenu.
     *
     * @param string|null $resultatObtenu
     *
     * @return Cursuslg
     */
    public function setResultatObtenu($resultatObtenu = null)
    {
        $this->resultatObtenu = $resultatObtenu;

        return $this;
    }

    /**
     * Get resultatObtenu.
     *
     * @return string|null
     */
    public function getResultatObtenu()
    {
        return $this->resultatObtenu;
    }

    /**
     * Set poste.
     *
     * @param string|null $poste
     *
     * @return Cursuslg
     */
    public function setPoste($poste = null)
    {
        $this->poste = $poste;

        return $this;
    }

    /**
     * Get poste.
     *
     * @return string|null
     */
    public function getPoste()
    {
        return $this->poste;
    }

    /**
     * Set adresse.
     *
     * @param string|null $adresse
     *
     * @return Cursuslg
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
     * Set dateDebut.
     *
     * @param \DateTime|null $dateDebut
     *
     * @return Cursuslg
     */
    public function setDateDebut($dateDebut = null)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut.
     *
     * @return \DateTime|null
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin.
     *
     * @param \DateTime|null $dateFin
     *
     * @return Cursuslg
     */
    public function setDateFin($dateFin = null)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin.
     *
     * @return \DateTime|null
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set description.
     *
     * @param string|null $description
     *
     * @return Cursuslg
     */
    public function setDescription($description = null)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set formationEtat.
     *
     * @param bool|null $formationEtat
     *
     * @return Cursuslg
     */
    public function setFormationEtat($formationEtat = null)
    {
        $this->formationEtat = $formationEtat;

        return $this;
    }

    /**
     * Get formationEtat.
     *
     * @return bool|null
     */
    public function getFormationEtat()
    {
        return $this->formationEtat;
    }

    /**
     * Set posteStatut.
     *
     * @param bool|null $posteStatut
     *
     * @return Cursuslg
     */
    public function setPosteStatut($posteStatut = null)
    {
        $this->posteStatut = $posteStatut;

        return $this;
    }

    /**
     * Get posteStatut.
     *
     * @return bool|null
     */
    public function getPosteStatut()
    {
        return $this->posteStatut;
    }

    /**
     * Set typePublic.
     *
     * @param \App\Entity\Masterlistelg|null $typePublic
     *
     * @return Cursuslg
     */
    public function setTypePublic(\App\Entity\Masterlistelg $typePublic = null)
    {
        $this->typePublic = $typePublic;

        return $this;
    }

    /**
     * Get typePublic.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getTypePublic()
    {
        return $this->typePublic;
    }

    /**
     * Set typeligne.
     *
     * @param \App\Entity\Masterlistelg|null $typeligne
     *
     * @return Cursuslg
     */
    public function setTypeligne(\App\Entity\Masterlistelg $typeligne = null)
    {
        $this->typeligne = $typeligne;

        return $this;
    }

    /**
     * Get typeligne.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getTypeligne()
    {
        return $this->typeligne;
    }
}
