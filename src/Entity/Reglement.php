<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Reglement
 *
 * @ORM\Table(name="reglements")
 * @ORM\Entity(repositoryClass="App\Repository\ReglementRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Reglement
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->archive = false;
		$this->montantht = 0;
		$this->montanttva = 0;
		$this->montantttc = 0;
		$this->caution = false;
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Dossier", inversedBy="reglements")
     */
    private $dossier;
    
    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Devis")
    */
    private $devis;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Financement")
    */
    private $financement;

    /**
     * @var string
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
    * @ORM\JoinColumn(nullable=true)
    * @ORM\OneToOne(targetEntity="App\Entity\Upload", cascade={"persist", "remove"})
     */
    private $document;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $typereglement;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $modereglement;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean",nullable=true)
     */
    private $caution;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $archive;

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
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set montantht.
     *
     * @param string|null $montantht
     *
     * @return Reglement
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
     * @return Reglement
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
     * @return Reglement
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
     * @return Reglement
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
     * Set archive.
     *
     * @param bool $archive
     *
     * @return Reglement
     */
    public function setArchive($archive)
    {
        $this->archive = $archive;

        return $this;
    }

    /**
     * Get archive.
     *
     * @return bool
     */
    public function getArchive()
    {
        return $this->archive;
    }

    /**
     * Set dateinsert.
     *
     * @param \DateTime|null $dateinsert
     *
     * @return Reglement
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
     * @return Reglement
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
     * @return Reglement
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
     * Set devis.
     *
     * @param \App\Entity\Devis|null $devis
     *
     * @return Reglement
     */
    public function setDevis(\App\Entity\Devis $devis = null)
    {
        $this->devis = $devis;

        return $this;
    }

    /**
     * Get devis.
     *
     * @return \App\Entity\Devis|null
     */
    public function getDevis()
    {
        return $this->devis;
    }

    /**
     * Set financement.
     *
     * @param \App\Entity\Financement|null $financement
     *
     * @return Reglement
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
     * @return Reglement
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

    /**
     * Set document.
     *
     * @param \App\Entity\Upload|null $document
     *
     * @return Reglement
     */
    public function setDocument(\App\Entity\Upload $document = null)
    {
        $this->document = $document;

        return $this;
    }

    /**
     * Get document.
     *
     * @return \App\Entity\Upload|null
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * Set typereglement.
     *
     * @param \App\Entity\Masterlistelg|null $typereglement
     *
     * @return Reglement
     */
    public function setTypereglement(\App\Entity\Masterlistelg $typereglement = null)
    {
        $this->typereglement = $typereglement;

        return $this;
    }

    /**
     * Get typereglement.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getTypereglement()
    {
        return $this->typereglement;
    }

    /**
     * Set modereglement.
     *
     * @param \App\Entity\Masterlistelg|null $modereglement
     *
     * @return Reglement
     */
    public function setModereglement(\App\Entity\Masterlistelg $modereglement = null)
    {
        $this->modereglement = $modereglement;

        return $this;
    }

    /**
     * Get modereglement.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getModereglement()
    {
        return $this->modereglement;
    }

    /**
     * Set quiinsert.
     *
     * @param \App\Entity\User|null $quiinsert
     *
     * @return Reglement
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
     * @return Reglement
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
     * Set caution.
     *
     * @param bool|null $caution
     *
     * @return Reglement
     */
    public function setCaution($caution = null)
    {
        $this->caution = $caution;

        return $this;
    }

    /**
     * Get caution.
     *
     * @return bool|null
     */
    public function getCaution()
    {
        return $this->caution;
    }
}
