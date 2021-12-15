<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * Echeancier
 *
 * @ORM\Table(name="echeanciers")
 * @ORM\Entity(repositoryClass="App\Repository\EcheancierRepository")
 */
class Echeancier
{
    /**
     * Constructor
     */
    public function __construct()
    {
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
    * @ORM\ManyToOne(targetEntity="App\Entity\Financement", inversedBy="echeances")
    */
    private $financement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateecheance;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $montantht;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\CodeTva")
    */
    private $codetva;

    /**	
     * @var string
     *
     * @ORM\Column(name="taux", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $tauxtva;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $montanttva;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $montantttc;

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
     * Set dateecheance.
     *
     * @param \DateTime|null $dateecheance
     *
     * @return Echeancier
     */
    public function setDateecheance($dateecheance = null)
    {
        $this->dateecheance = $dateecheance;

        return $this;
    }

    /**
     * Get dateecheance.
     *
     * @return \DateTime|null
     */
    public function getDateecheance()
    {
        return $this->dateecheance;
    }

    /**
     * Set montantht.
     *
     * @param string|null $montantht
     *
     * @return Echeancier
     */
    public function setMontantht($montantht = null)
    {
        $this->montantht = $montantht;

        return $this;
    }

    /**
     * Get montantht.
     *
     * @return string|null
     */
    public function getMontantht()
    {
        return $this->montantht;
    }

    /**
     * Set tauxtva.
     *
     * @param string|null $tauxtva
     *
     * @return Echeancier
     */
    public function setTauxtva($tauxtva = null)
    {
        $this->tauxtva = $tauxtva;

        return $this;
    }

    /**
     * Get tauxtva.
     *
     * @return string|null
     */
    public function getTauxtva()
    {
        return $this->tauxtva;
    }

    /**
     * Set montanttva.
     *
     * @param string|null $montanttva
     *
     * @return Echeancier
     */
    public function setMontanttva($montanttva = null)
    {
        $this->montanttva = $montanttva;

        return $this;
    }

    /**
     * Get montanttva.
     *
     * @return string|null
     */
    public function getMontanttva()
    {
        return $this->montanttva;
    }

    /**
     * Set montantttc.
     *
     * @param string|null $montantttc
     *
     * @return Echeancier
     */
    public function setMontantttc($montantttc = null)
    {
        $this->montantttc = $montantttc;

        return $this;
    }

    /**
     * Get montantttc.
     *
     * @return string|null
     */
    public function getMontantttc()
    {
        return $this->montantttc;
    }

    /**
     * Set dateinsert.
     *
     * @param \DateTime|null $dateinsert
     *
     * @return Echeancier
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
     * @return Echeancier
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
     * Set financement.
     *
     * @param \App\Entity\Financement|null $financement
     *
     * @return Echeancier
     */
    public function setFinancement(\App\Entity\Financement $financement = null)
    {
        $this->financement = $financement;

        return $this;
    }

    /**
     * Get financement.
     *
     * @return \App\Entity\Financement|null
     */
    public function getFinancement()
    {
        return $this->financement;
    }

    /**
     * Set codetva.
     *
     * @param \App\Entity\CodeTva|null $codetva
     *
     * @return Echeancier
     */
    public function setCodetva(\App\Entity\CodeTva $codetva = null)
    {
        $this->codetva = $codetva;

        return $this;
    }

    /**
     * Get codetva.
     *
     * @return \App\Entity\CodeTva|null
     */
    public function getCodetva()
    {
        return $this->codetva;
    }
}
