<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * StatutJuridique
 *
 * @ORM\Table(name="statut_juridique")
 * @ORM\Entity(repositoryClass="App\Repository\StatutJuridiqueRepository")
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(fields={"intitule"}, message="Ce status juridique existe déjà.")
 */
class StatutJuridique
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
     * @var string
     *
     * @ORM\Column(name="intitule", type="string", length=250)
     * @Assert\Length(min=2, minMessage="L'intitulé doit faire au moins {{ limit }} caractères.")
     * @Assert\NotBlank(message="L'intitulé est obligatoire.")
     */
    private $intitule;
    /**
     * @var string
     *
     * @ORM\Column(name="abreviation", type="string", length=65)
     * @Assert\Length(
     *      min = 1,
     *      max = 6,
     *      minMessage = "L'abréviation doit faire au moins {{ limit }} caractère",
     *      maxMessage = "L'abréviation doit faire au max {{ limit }} caractères"
     * )
     * @Assert\NotBlank(message="L'abréviation est obligatoire.")
     */
    private $abreviation;
    /**
     * @var bool
     *
     * @ORM\Column(name="archive", type="boolean")
     */
    private $archive = false;
    /**
     * @var int
     *
     * @ORM\Column(name="ordre", type="integer")
     */
    private $ordre = 0;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateinscription", type="datetimetz")
     */
    private $dateinscription;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datemodification", type="datetimetz", nullable=true)
     */
    private $datemodification;

    /**
     * @ORM\PrePersist
     */
    public function ajout()
    {
        $this->dateinscription = new \DateTime();
    }

    /**
     * @ORM\PreUpdate
     */
    public function modification()
    {
        $this->datemodification = new \DateTime();
    }

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
     * Get intitule
     *
     * @return string
     */
    public function getIntitule()
    {
        return $this->intitule;
    }

    /**
     * Set intitule
     *
     * @param string $intitule
     *
     * @return StatutJuridique
     */
    public function setIntitule($intitule)
    {
        $this->intitule = $intitule;

        return $this;
    }

    /**
     * Get archive
     *
     * @return bool
     */
    public function getArchive()
    {
        return $this->archive;
    }

    /**
     * Set archive
     *
     * @param boolean $archive
     *
     * @return StatutJuridique
     */
    public function setArchive($archive)
    {
        $this->archive = $archive;

        return $this;
    }

    /**
     * Get ordre
     *
     * @return int
     */
    public function getOrdre()
    {
        return $this->ordre;
    }

    /**
     * Set ordre
     *
     * @param integer $ordre
     *
     * @return StatutJuridique
     */
    public function setOrdre($ordre)
    {
        $this->ordre = $ordre;

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
     * Set dateinscription
     *
     * @param \DateTime $dateinscription
     *
     * @return StatutJuridique
     */
    public function setDateinscription($dateinscription)
    {
        $this->dateinscription = $dateinscription;

        return $this;
    }

    /**
     * Get datemodification
     *
     * @return \DateTime
     */
    public function getDatemodification()
    {
        return $this->datemodification;
    }

    /**
     * Set datemodification
     *
     * @param \DateTime $datemodification
     *
     * @return StatutJuridique
     */
    public function setDatemodification($datemodification)
    {
        $this->datemodification = $datemodification;

        return $this;
    }

    /**
     * Get abreviation
     *
     * @return string
     */
    public function getAbreviation()
    {
        return $this->abreviation;
    }

    /**
     * Set abreviation
     *
     * @param string $abreviation
     *
     * @return StatutJuridique
     */
    public function setAbreviation($abreviation)
    {
        $this->abreviation = $abreviation;

        return $this;
    }
}
