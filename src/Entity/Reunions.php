<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * reunions
 *
 * @ORM\Table(name="reunions")
 * @ORM\Entity(repositoryClass="App\Repository\ReunionRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Reunions
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->evenements = new \Doctrine\Common\Collections\ArrayCollection();
        $this->archive = false;
        $this->dateinsert = new \DateTime();
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Evenement", cascade={"persist"})
     */
    private $evenements;  // les réunions sélectionnées

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Evenement", cascade={"persist"})
     */
    private $evenement; // la réunion confirmée par le postulant 

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Dossier", inversedBy="reunions", cascade={"persist"})
     */
    private $dossier; 



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
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $state;

    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=255, nullable=true)
     */
    private $reference;



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
     * Set state
     *
     * @param \App\Entity\Masterlistelg $state
     *
     * @return Reunions
     */
    public function setState(\App\Entity\Masterlistelg $state = null)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set dossier
     *
     * @param \App\Entity\Dossier $dossier
     *
     * @return Reunions
     */
    public function setDossier(\App\Entity\Dossier $dossier = null)
    {
        $this->dossier = $dossier;

        return $this;
    }

    /**
     * Get dossier
     *
     * @return \App\Entity\Dossier
     */
    public function getDossier()
    {
        return $this->dossier;
    }

    /**
     * Add evenement
     *
     * @param \App\Entity\Evenement $evenement
     *
     * @return Reunions
     */
    public function addEvenement(\App\Entity\Evenement $evenement)
    {
        $this->evenements[] = $evenement;

        return $this;
    }

    /**
     * Remove evenement
     *
     * @param \App\Entity\Evenement $evenement
     */
    public function removEvenement(\App\Entity\Evenement $evenement)
    {
        $this->evenements->removeElement($evenement);
    }

    /**
     * Get Reunions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvenements()
    {
        return $this->evenements;
    }

    /**
     * Set evenement
     *
     * @param \App\Entity\Evenement $evenement
     *
     * @return Reunions
     */
    public function setEvenement(\App\Entity\Evenement $evenement = null)
    {
        $this->evenement = $evenement;

        return $this;
    }

    /**
     * Get Reunions
     *
     * @return \App\Entity\Evenement
     */
    public function getEvenement()
    {
        return $this->evenement;
    }


    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Reunions
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set reference
     *
     * @param string $reference
     *
     * @return Reunions
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }


    /**
     * Set dateinsert
     *
     * @param \DateTime $dateinsert
     *
     * @return Reunions
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
     * @return Reunions
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
     * Remove evenement
     *
     * @param \App\Entity\Evenement $evenement
     */
    public function removeEvenement(\App\Entity\Evenement $evenement)
    {
        $this->evenements->removeElement($evenement);
    }
}
