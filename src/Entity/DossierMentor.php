<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * DossierMentor
 *
 * @ORM\Table(name="dossiermentors")
 * @ORM\Entity(repositoryClass="App\Repository\DossierMentorRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class DossierMentor {

    /**
     * Constructor
     */
    public function __construct()
    {
		$this->actif=true;
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Dossier", inversedBy="mentors")
     */
    private $dossier;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Formateur", inversedBy="mentores")
     */
    private $formateur;

    /**
     * @var string
     * 
     * @ORM\Column(type="text", nullable=true)
     */
    private $contenu;

    /**
     * @var boolean 
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $actif;

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
     * 
     * @ORM\OneToOne(targetEntity="App\Entity\DossierMentorContrat", mappedBy="dossiermentor")
     */
    private $dossiermentorcontrat ;

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
     * Set contenu.
     *
     * @param string|null $contenu
     *
     * @return DossierMentor
     */
    public function setContenu($contenu = null)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu.
     *
     * @return string|null
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set actif.
     *
     * @param bool|null $actif
     *
     * @return DossierMentor
     */
    public function setActif($actif = null)
    {
        $this->actif = $actif;

        return $this;
    }

    /**
     * Get actif.
     *
     * @return bool|null
     */
    public function getActif()
    {
        return $this->actif;
    }

    /**
     * Set dateinsert.
     *
     * @param \DateTime|null $dateinsert
     *
     * @return DossierMentor
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
     * @return DossierMentor
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
     * @return DossierMentor
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
     * Set formateur.
     *
     * @param \App\Entity\Formateur|null $formateur
     *
     * @return DossierMentor
     */
    public function setFormateur(\App\Entity\Formateur $formateur = null)
    {
        $this->formateur = $formateur;

        return $this;
    }

    /**
     * Get formateur.
     *
     * @return \App\Entity\Formateur|null
     */
    public function getFormateur()
    {
        return $this->formateur;
    }

    /**
     * Set quiinsert.
     *
     * @param \App\Entity\User|null $quiinsert
     *
     * @return DossierMentor
     */
    public function setQuiinsert(\App\Entity\User $quiinsert = null)
    {
        $this->quiinsert = $quiinsert;

        return $this;
    }

    /**
     * Get quiinsert.
     *
     * @return \App\Entity\User|null
     */
    public function getQuiinsert()
    {
        return $this->quiinsert;
    }

    /**
     * Set quiupdate.
     *
     * @param \App\Entity\User|null $quiupdate
     *
     * @return DossierMentor
     */
    public function setQuiupdate(\App\Entity\User $quiupdate = null)
    {
        $this->quiupdate = $quiupdate;

        return $this;
    }

    /**
     * Get quiupdate.
     *
     * @return \App\Entity\User|null
     */
    public function getQuiupdate()
    {
        return $this->quiupdate;
    }

    /**
     * Get dossiermentorcontrat
     *
     * @return \App\Entity\Dossiermentorcontrat|null
     */
    public function getDossiermentorcontrat()
    {
        return $this->dossiermentorcontrat;
    }

    /**
     * Set dossiermentorcontrat.
     *
     * @param \App\Entity\DossierMentorContrat|null $dossiermentorcontrat
     *
     * @return DossierMentor
     */
    public function setDossiermentorcontrat(\App\Entity\DossierMentorContrat $dossiermentorcontrat = null)
    {
        $this->dossiermentorcontrat = $dossiermentorcontrat;

        return $this;
    }
}
