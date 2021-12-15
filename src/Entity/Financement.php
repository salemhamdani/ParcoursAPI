<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Financement
 *
 * @ORM\Table(name="financements")
 * @ORM\Entity(repositoryClass="App\Repository\FinancementRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Financement
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->archive = false;
        $this->concernefrais = false;
		$this->montantht = 0;
		$this->montantttc = 0;
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Dossier", inversedBy="financements", cascade={"persist"})
     */
    private $dossier;
    
    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Devis",cascade={"persist"})
    */
    private $devis;

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
     * @var string
     *
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $montantregleht;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $montantreglettc;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numdossier;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $subrogation;

    /**
    * @ORM\JoinColumn(nullable=true)
    * @ORM\OneToOne(targetEntity="App\Entity\Upload", cascade={"persist", "remove"})
     */
    private $document;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $financementtotal;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $financementprincipal;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $typefinancement;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Financeur")
    */
    private $financeur;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\BondecommandeParcours")
	*/
	private $bdcparcours;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Session")
	*/
	private $bdcsession;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $echeancier;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\Echeancier", mappedBy="financement",cascade={"persist","remove"})
	* @ORM\OrderBy({"dateecheance" = "ASC"})
    */
    private $echeances;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $montantecheancesht;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $archive;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $concernefrais;

	/**
	* @ORM\OneToOne(targetEntity="App\Entity\Tchat", cascade={"all"})
     */
    private $tchat;

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
     * Set archive.
     *
     * @param bool $archive
     *
     * @return Financement
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
     * Set concernefrais.
     *
     * @param bool $concernefrais
     *
     * @return Financement
     */
    public function setConcernefrais($concernefrais)
    {
        $this->concernefrais = $concernefrais;

        return $this;
    }

    /**
     * Get concernefrais.
     *
     * @return bool
     */
    public function getConcernefrais()
    {
        return $this->concernefrais;
    }

    /**
     * Set dateinsert.
     *
     * @param \DateTime|null $dateinsert
     *
     * @return Financement
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
     * @return Financement
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
     * @return Financement
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
     * @return Financement
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
     * Set tchat.
     *
     * @param \App\Entity\Tchat|null $tchat
     *
     * @return Financement
     */
    public function setTchat(\App\Entity\Tchat $tchat = null)
    {
        $this->tchat = $tchat;

        return $this;
    }

    /**
     * Get tchat.
     *
     * @return \App\Entity\Tchat|null
     */
    public function getTchat()
    {
        return $this->tchat;
    }

    /**
     * Set quiinsert.
     *
     * @param \App\Entity\User|null $quiinsert
     *
     * @return Financement
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
     * @return Financement
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
     * Set financementtotal.
     *
     * @param bool|null $financementtotal
     *
     * @return Financement
     */
    public function setFinancementtotal($financementtotal = null)
    {
        $this->financementtotal = $financementtotal;

        return $this;
    }

    /**
     * Get financementtotal.
     *
     * @return bool|null
     */
    public function getFinancementtotal()
    {
        return $this->financementtotal;
    }

    /**
     * Set financementprincipal.
     *
     * @param bool|null $financementprincipal
     *
     * @return Financement
     */
    public function setFinancementprincipal($financementprincipal = null)
    {
        $this->financementprincipal = $financementprincipal;

        return $this;
    }

    /**
     * Get financementprincipal.
     *
     * @return bool|null
     */
    public function getFinancementprincipal()
    {
        return $this->financementprincipal;
    }

    /**
     * Set typefinancement.
     *
     * @param \App\Entity\Masterlistelg|null $typefinancement
     *
     * @return Financement
     */
    public function setTypefinancement(\App\Entity\Masterlistelg $typefinancement = null)
    {
        $this->typefinancement = $typefinancement;

        return $this;
    }

    /**
     * Get typefinancement.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getTypefinancement()
    {
        return $this->typefinancement;
    }

    /**
     * Set financeur.
     *
     * @param \App\Entity\Financeur|null $financeur
     *
     * @return Financement
     */
    public function setFinanceur(\App\Entity\Financeur $financeur = null)
    {
        $this->financeur = $financeur;

        return $this;
    }

    /**
     * Get financeur.
     *
     * @return \App\Entity\Financeur|null
     */
    public function getFinanceur()
    {
        return $this->financeur;
    }

    /**
     * Set montantht.
     *
     * @param string|null $montantht
     *
     * @return Financement
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
     * @return Financement
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
     * @return Financement
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
     * @return Financement
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
     * Set codetva.
     *
     * @param \App\Entity\CodeTva|null $codetva
     *
     * @return Financement
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
     * Set subrogation.
     *
     * @param bool|null $subrogation
     *
     * @return Financement
     */
    public function setSubrogation($subrogation = null)
    {
        $this->subrogation = $subrogation;

        return $this;
    }

    /**
     * Get subrogation.
     *
     * @return bool|null
     */
    public function getSubrogation()
    {
        return $this->subrogation;
    }

    /**
     * Set numdossier.
     *
     * @param string|null $numdossier
     *
     * @return Financement
     */
    public function setNumdossier($numdossier = null)
    {
        $this->numdossier = $numdossier;

        return $this;
    }

    /**
     * Get numdossier.
     *
     * @return string|null
     */
    public function getNumdossier()
    {
        return $this->numdossier;
    }

    /**
     * Set bdcparcours.
     *
     * @param \App\Entity\BondecommandeParcours|null $bdcparcours
     *
     * @return Financement
     */
    public function setBdcparcours(\App\Entity\BondecommandeParcours $bdcparcours = null)
    {
        $this->bdcparcours = $bdcparcours;

        return $this;
    }

    /**
     * Get bdcparcours.
     *
     * @return \App\Entity\BondecommandeParcours|null
     */
    public function getBdcparcours()
    {
        return $this->bdcparcours;
    }

    /**
     * Set bdcsession.
     *
     * @param \App\Entity\Session|null $bdcsession
     *
     * @return Financement
     */
    public function setBdcsession(\App\Entity\Session $bdcsession = null)
    {
        $this->bdcsession = $bdcsession;

        return $this;
    }

    /**
     * Get bdcsession.
     *
     * @return \App\Entity\Session|null
     */
    public function getBdcsession()
    {
        return $this->bdcsession;
    }

    /**
     * Set document.
     *
     * @param \App\Entity\Upload|null $document
     *
     * @return Financement
     */
    public function setDocument(\App\Entity\Upload $document = null)
    {
        $this->document = $document;
		$this->document->setDirectoryUpload(strtolower((new \ReflectionClass($this))->getShortName().'-'.'document'));
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
     * Set echeancier.
     *
     * @param \App\Entity\Masterlistelg|null $echeancier
     *
     * @return Financement
     */
    public function setEcheancier(\App\Entity\Masterlistelg $echeancier = null)
    {
        $this->echeancier = $echeancier;

        return $this;
    }

    /**
     * Get echeancier.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getEcheancier()
    {
        return $this->echeancier;
    }

    /**
     * Add echeance.
     *
     * @param \App\Entity\Echeancier $echeance
     *
     * @return Financement
     */
    public function addEcheance(\App\Entity\Echeancier $echeance)
    {
        $this->echeances[] = $echeance;
		$echeance->setFinancement($this);
        return $this;
    }

    /**
     * Remove echeance.
     *
     * @param \App\Entity\Echeancier $echeance
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeEcheance(\App\Entity\Echeancier $echeance)
    {
        return $this->echeances->removeElement($echeance);
    }

    /**
     * Get echeances.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEcheances()
    {
        return $this->echeances;
    }

    /**
     * Set montantecheancesht.
     *
     * @param string|null $montantecheancesht
     *
     * @return Financement
     */
    public function setMontantecheancesht($montantecheancesht = null)
    {
        $this->montantecheancesht = $montantecheancesht;

        return $this;
    }

    /**
     * Get montantecheancesht.
     *
     * @return string|null
     */
    public function getMontantecheancesht()
    {
        return $this->montantecheancesht;
    }

    /**
     * Set montantregleht.
     *
     * @param string|null $montantregleht
     *
     * @return Financement
     */
    public function setMontantregleht($montantregleht = null)
    {
        $this->montantregleht = $montantregleht;

        return $this;
    }

    /**
     * Get montantregleht.
     *
     * @return string|null
     */
    public function getMontantregleht()
    {
        return $this->montantregleht;
    }

    /**
     * Set montantreglettc.
     *
     * @param string|null $montantreglettc
     *
     * @return Financement
     */
    public function setMontantreglettc($montantreglettc = null)
    {
        $this->montantreglettc = $montantreglettc;

        return $this;
    }

    /**
     * Get montantreglettc.
     *
     * @return string|null
     */
    public function getMontantreglettc()
    {
        return $this->montantreglettc;
    }
}
