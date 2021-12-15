<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Editeur
 *
 * @ORM\Table(name="editeur")
 * @ORM\Entity(repositoryClass="App\Repository\EditeurRepository")
 * @UniqueEntity(fields={"intitule"}, message="Cet éditeur existe déjà.")
 * @ORM\HasLifecycleCallbacks
 */
class Editeur
{
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
     * @Assert\NotBlank(message="L'intitulé est obligatoire. entity")
     */
    private $intitule;

    /**
     * @var string
     *
     * @ORM\Column(name="alt", type="string", length=255, nullable=true)
     */
    private $alt;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @var string
     *
     * @ORM\Column(name="detail", type="text", nullable=true)
     */
    private $detail;


    /**
     * @var string
     *
     * @ORM\Column(name="lien", type="text", nullable=true)
     * @Assert\Url(message = "Le lien '{{ value }}' n'est pas une URL valide.")
     */
    private $lien;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateinscription", type="datetime")
     */
    private $dateinscription;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datemodification", type="datetime", nullable=true)
     */
    private $datemodification;


    /**
     * @var bool
     *
     * @ORM\Column(name="archive", type="boolean")
     */
    private $archive = false;



    /**
    * @ORM\JoinColumn(nullable=true)
    * @ORM\OneToOne(targetEntity="App\Entity\Upload", cascade={"persist", "remove"})
     */
    private $photo;

    /**
     * @var string
     *
     * @ORM\Column(name="alt_photo", type="string", length=65, nullable=true)
     */
    private $altphoto;

    /**
     * @var File
     *
     */
     private $logo;

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
     * Set intitule
     *
     * @param string $intitule
     *
     * @return Editeur
     */
    public function setIntitule($intitule)
    {
        $this->intitule = $intitule;

        return $this;
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
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return Editeur
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
     * Set detail
     *
     * @param string $detail
     *
     * @return Editeur
     */
    public function setDetail($detail)
    {
        $this->detail = $detail;

        return $this;
    }

    /**
     * Get detail
     *
     * @return string
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * Set archive
     *
     * @param boolean $archive
     *
     * @return Editeur
     */
    public function setArchive($archive)
    {
        $this->archive = $archive;

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
     * Set dateinscription
     *
     * @param \DateTime $dateinscription
     *
     * @return Editeur
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
     * Set datemodification
     *
     * @param \DateTime $datemodification
     *
     * @return Editeur
     */
    public function setDatemodification($datemodification)
    {
        $this->datemodification = $datemodification;

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
     * Set lien
     *
     * @param string $lien
     *
     * @return Editeur
     */
    public function setLien($lien)
    {
        $this->lien = $lien;

        return $this;
    }

    /**
     * Get lien
     *
     * @return string
     */
    public function getLien()
    {
        return $this->lien;
    }

   /**
     * Set altphoto
     *
     * @param string $altphoto
     *
     * @return Editeur
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
     * Set photo
     * @param \App\Entity\Upload $photo
     * @return Editeur
     */
    public function setPhoto(\App\Entity\Upload $photo = null)
    {
        $this->photo = $photo;
//      $this->photo->setDirectoryUpload(strtolower((new \ReflectionClass($this))->getShortName().'-'.'photo'));
        $this->photo->setDirectoryUpload($this->getDirectoryUpload());
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
    
    /**
     * @return File|null
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param File $logo
     *
     * @return Theme
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }


  /**
     * Set alt
     *
     * @param string $alt
     *
     * @return Editeur
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }


}
