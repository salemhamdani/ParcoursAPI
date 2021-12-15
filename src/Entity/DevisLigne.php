<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * DevisLigne
 *
 * @ORM\Table(name="devislignes")
 * @ORM\Entity(repositoryClass="App\Repository\DevisLigneRepository")
 */
class DevisLigne
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->dateinsert = new \DateTime();
		$this->montantht = 0;
		$this->chargeht = true;
		$this->calendrier = true;
		$this->dureemodules = 0;
		$this->dureeaccompagnements = 0;
		$this->dureestages = 0;
		$this->dureeeleearning = 0;
		$this->dureevalidation = 0;
		$this->quantite = 1;
		$this->gratuit = false;
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
    * @ORM\ManyToOne(targetEntity="App\Entity\Devis", inversedBy="devislignes")
    */
    private $devis;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Dossier")
    */
    private $dossier;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Article")
	*/
	private $article;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $typeligne;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $designation;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\DevisLigne", inversedBy="enfants")
    */
    private $parent;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\DevisLigne", mappedBy="parent", orphanRemoval=true, cascade={"persist"})
    */
    private $enfants;

    /**
    * @ORM\ManyToMany(targetEntity="App\Entity\Dossier", mappedBy="devisligneentreprises")
    */
    private $dossiers;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Session")
	*/
	private $session;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Module")
	*/
	private $module;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\SessionModule")
	*/
	private $sessionmodule;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Certification")
	*/
	private $certification;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\SessionCertification")
	*/
	private $sessioncertification;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\SessionJury")
	*/
	private $sessionjury;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $chargeht;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $gratuit;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $calendrier;

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
	* @ORM\ManyToOne(targetEntity="App\Entity\User")
	*/
	private $quiinsert;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\User")
	*/
	private $quiupdate;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $quantite;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $prixunitaire;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $montantht;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dureemodules;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dureeaccompagnements;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dureestages;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dureeelearning;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dureevalidation;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $forfaitmodules;

    /**
	* @Assert\Regex("/\d+(\.\d+)?/")
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $tarifmodules;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $montanttotmodules;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $forfaitaccompagnements;

    /**
	* @Assert\Regex("/\d+(\.\d+)?/")
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $tarifaccompagnements;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $montanttotaccompagnements;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $forfaitstages;

    /**
	* @Assert\Regex("/\d+(\.\d+)?/")
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $tarifstages;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $montanttotstages;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $forfaitelearning;

    /**
	* @Assert\Regex("/\d+(\.\d+)?/")
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $tarifelearning;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $montanttotelearning;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $forfaitvalidation;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $tarifvalidation;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $montanttotvalidation;

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
        $this->state = false;
    }

    /**
     * @ORM\PreUpdate
     */
    public function modification()
    {
        $this->dateupdate = new \DateTime();
    }

    /**
     * Set dateinsert
     *
     * @param \DateTime $dateinsert
     *
     * @return DevisLigne
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
     * @return DevisLigne
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
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return DevisLigne
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
     * Set montantht
     *
     * @param string $montantht
     *
     * @return DevisLigne
     */
    public function setMontantht($montantht)
    {
        $this->montantht = $montantht;

        return $this;
    }

    /**
     * Get montantht
     *
     * @return string
     */
    public function getMontantht()
    {
        return $this->montantht;
    }

    /**
     * Set devis
     *
     * @param \App\Entity\Devis $devis
     *
     * @return DevisLigne
     */
    public function setDevis(\App\Entity\Devis $devis = null)
    {
        $this->devis = $devis;

        return $this;
    }

    /**
     * Get devis
     *
     * @return \App\Entity\Devis
     */
    public function getDevis()
    {
        return $this->devis;
    }

    /**
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return DevisLigne
     */
    public function setQuiinsert(\App\Entity\User $quiinsert = null)
    {
        $this->quiinsert = $quiinsert;

        return $this;
    }

    /**
     * Get quiinsert
     *
     * @return \App\Entity\User
     */
    public function getQuiinsert()
    {
        return $this->quiinsert;
    }

    /**
     * Set quiupdate
     *
     * @param \App\Entity\User $quiupdate
     *
     * @return DevisLigne
     */
    public function setQuiupdate(\App\Entity\User $quiupdate = null)
    {
        $this->quiupdate = $quiupdate;

        return $this;
    }

    /**
     * Get quiupdate
     *
     * @return \App\Entity\User
     */
    public function getQuiupdate()
    {
        return $this->quiupdate;
    }

    /**
     * Set typeligne
     *
     * @param string $typeligne
     *
     * @return DevisLigne
     */
    public function setTypeligne($typeligne)
    {
        $this->typeligne = $typeligne;

        return $this;
    }

    /**
     * Get typeligne
     *
     * @return string
     */
    public function getTypeligne()
    {
        return $this->typeligne;
    }

    /**
     * Set session
     *
     * @param \App\Entity\Session $session
     *
     * @return DevisLigne
     */
    public function setSession(\App\Entity\Session $session = null)
    {
        $this->session = $session;

        return $this;
    }

    /**
     * Get session
     *
     * @return \App\Entity\Session
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * Set parent
     *
     * @param \App\Entity\DevisLigne $parent
     *
     * @return DevisLigne
     */
    public function setParent(\App\Entity\DevisLigne $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \App\Entity\DevisLigne
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add enfant
     *
     * @param \App\Entity\DevisLigne $enfant
     *
     * @return DevisLigne
     */
    public function addEnfant(\App\Entity\DevisLigne $enfant)
    {
        $this->enfants[] = $enfant;
		$enfant->setParent($this);
        return $this;
    }

    /**
     * Remove enfant
     *
     * @param \App\Entity\DevisLigne $enfant
     */
    public function removeEnfant(\App\Entity\DevisLigne $enfant)
    {
        $this->enfants->removeElement($enfant);
    }

    /**
     * Get enfants
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEnfants()
    {
        return $this->enfants;
    }

    /**
     * Set designation
     *
     * @param string $designation
     *
     * @return DevisLigne
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * Get designation
     *
     * @return string
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * Set chargeht
     *
     * @param boolean $chargeht
     *
     * @return DevisLigne
     */
    public function setChargeht($chargeht)
    {
        $this->chargeht = $chargeht;

        return $this;
    }

    /**
     * Get chargeht
     *
     * @return boolean
     */
    public function getChargeht()
    {
        return $this->chargeht;
    }

    /**
     * Set calendrier
     *
     * @param boolean $calendrier
     *
     * @return DevisLigne
     */
    public function setCalendrier($calendrier)
    {
        $this->calendrier = $calendrier;

        return $this;
    }

    /**
     * Get calendrier
     *
     * @return boolean
     */
    public function getCalendrier()
    {
        return $this->calendrier;
    }

    /**
     * Set forfaitmodules
     *
     * @param boolean $forfaitmodules
     *
     * @return DevisLigne
     */
    public function setForfaitmodules($forfaitmodules)
    {
        $this->forfaitmodules = $forfaitmodules;

        return $this;
    }

    /**
     * Get forfaitmodules
     *
     * @return boolean
     */
    public function getForfaitmodules()
    {
        return $this->forfaitmodules;
    }

    /**
     * Set tarifmodules
     *
     * @param string $tarifmodules
     *
     * @return DevisLigne
     */
    public function setTarifmodules($tarifmodules)
    {
        $this->tarifmodules = $tarifmodules;

        return $this;
    }

    /**
     * Get tarifmodules
     *
     * @return string
     */
    public function getTarifmodules()
    {
        return $this->tarifmodules;
    }

    /**
     * Set montanttotmodules
     *
     * @param string $montanttotmodules
     *
     * @return DevisLigne
     */
    public function setMontanttotmodules($montanttotmodules)
    {
        $this->montanttotmodules = $montanttotmodules;

        return $this;
    }

    /**
     * Get montanttotmodules
     *
     * @return string
     */
    public function getMontanttotmodules()
    {
        return $this->montanttotmodules;
    }

    /**
     * Set forfaitaccompagnements
     *
     * @param boolean $forfaitaccompagnements
     *
     * @return DevisLigne
     */
    public function setForfaitaccompagnements($forfaitaccompagnements)
    {
        $this->forfaitaccompagnements = $forfaitaccompagnements;

        return $this;
    }

    /**
     * Get forfaitaccompagnements
     *
     * @return boolean
     */
    public function getForfaitaccompagnements()
    {
        return $this->forfaitaccompagnements;
    }

    /**
     * Set tarifaccompagnements
     *
     * @param string $tarifaccompagnements
     *
     * @return DevisLigne
     */
    public function setTarifaccompagnements($tarifaccompagnements)
    {
        $this->tarifaccompagnements = $tarifaccompagnements;

        return $this;
    }

    /**
     * Get tarifaccompagnements
     *
     * @return string
     */
    public function getTarifaccompagnements()
    {
        return $this->tarifaccompagnements;
    }

    /**
     * Set montanttotaccompagnements
     *
     * @param string $montanttotaccompagnements
     *
     * @return DevisLigne
     */
    public function setMontanttotaccompagnements($montanttotaccompagnements)
    {
        $this->montanttotaccompagnements = $montanttotaccompagnements;

        return $this;
    }

    /**
     * Get montanttotaccompagnements
     *
     * @return string
     */
    public function getMontanttotaccompagnements()
    {
        return $this->montanttotaccompagnements;
    }

    /**
     * Set forfaitstages
     *
     * @param boolean $forfaitstages
     *
     * @return DevisLigne
     */
    public function setForfaitstages($forfaitstages)
    {
        $this->forfaitstages = $forfaitstages;

        return $this;
    }

    /**
     * Get forfaitstages
     *
     * @return boolean
     */
    public function getForfaitstages()
    {
        return $this->forfaitstages;
    }

    /**
     * Set tarifstages
     *
     * @param string $tarifstages
     *
     * @return DevisLigne
     */
    public function setTarifstages($tarifstages)
    {
        $this->tarifstages = $tarifstages;

        return $this;
    }

    /**
     * Get tarifstages
     *
     * @return string
     */
    public function getTarifstages()
    {
        return $this->tarifstages;
    }

    /**
     * Set montanttotstages
     *
     * @param string $montanttotstages
     *
     * @return DevisLigne
     */
    public function setMontanttotstages($montanttotstages)
    {
        $this->montanttotstages = $montanttotstages;

        return $this;
    }

    /**
     * Get montanttotstages
     *
     * @return string
     */
    public function getMontanttotstages()
    {
        return $this->montanttotstages;
    }

    /**
     * Set forfaitelearning
     *
     * @param boolean $forfaitelearning
     *
     * @return DevisLigne
     */
    public function setForfaitelearning($forfaitelearning)
    {
        $this->forfaitelearning = $forfaitelearning;

        return $this;
    }

    /**
     * Get forfaitelearning
     *
     * @return boolean
     */
    public function getForfaitelearning()
    {
        return $this->forfaitelearning;
    }

    /**
     * Set tarifelearning
     *
     * @param string $tarifelearning
     *
     * @return DevisLigne
     */
    public function setTarifelearning($tarifelearning)
    {
        $this->tarifelearning = $tarifelearning;

        return $this;
    }

    /**
     * Get tarifelearning
     *
     * @return string
     */
    public function getTarifelearning()
    {
        return $this->tarifelearning;
    }

    /**
     * Set montanttotelearning
     *
     * @param string $montanttotelearning
     *
     * @return DevisLigne
     */
    public function setMontanttotelearning($montanttotelearning)
    {
        $this->montanttotelearning = $montanttotelearning;

        return $this;
    }

    /**
     * Get montanttotelearning
     *
     * @return string
     */
    public function getMontanttotelearning()
    {
        return $this->montanttotelearning;
    }

    /**
     * Set forfaitvalidation
     *
     * @param boolean $forfaitvalidation
     *
     * @return DevisLigne
     */
    public function setForfaitvalidation($forfaitvalidation)
    {
        $this->forfaitvalidation = $forfaitvalidation;

        return $this;
    }

    /**
     * Get forfaitvalidation
     *
     * @return boolean
     */
    public function getForfaitvalidation()
    {
        return $this->forfaitvalidation;
    }

    /**
     * Set tarifvalidation
     *
     * @param string $tarifvalidation
     *
     * @return DevisLigne
     */
    public function setTarifvalidation($tarifvalidation)
    {
        $this->tarifvalidation = $tarifvalidation;

        return $this;
    }

    /**
     * Get tarifvalidation
     *
     * @return string
     */
    public function getTarifvalidation()
    {
        return $this->tarifvalidation;
    }

    /**
     * Set montanttotvalidation
     *
     * @param string $montanttotvalidation
     *
     * @return DevisLigne
     */
    public function setMontanttotvalidation($montanttotvalidation)
    {
        $this->montanttotvalidation = $montanttotvalidation;

        return $this;
    }

    /**
     * Get montanttotvalidation
     *
     * @return string
     */
    public function getMontanttotvalidation()
    {
        return $this->montanttotvalidation;
    }

    /**
     * Set dureemodules
     *
     * @param integer $dureemodules
     *
     * @return DevisLigne
     */
    public function setDureemodules($dureemodules)
    {
        $this->dureemodules = $dureemodules;

        return $this;
    }

    /**
     * Get dureemodules
     *
     * @return integer
     */
    public function getDureemodules()
    {
        return $this->dureemodules;
    }

    /**
     * Set dureeaccompagnements
     *
     * @param integer $dureeaccompagnements
     *
     * @return DevisLigne
     */
    public function setDureeaccompagnements($dureeaccompagnements)
    {
        $this->dureeaccompagnements = $dureeaccompagnements;

        return $this;
    }

    /**
     * Get dureeaccompagnements
     *
     * @return integer
     */
    public function getDureeaccompagnements()
    {
        return $this->dureeaccompagnements;
    }

    /**
     * Set dureestages
     *
     * @param integer $dureestages
     *
     * @return DevisLigne
     */
    public function setDureestages($dureestages)
    {
        $this->dureestages = $dureestages;

        return $this;
    }

    /**
     * Get dureestages
     *
     * @return integer
     */
    public function getDureestages()
    {
        return $this->dureestages;
    }

    /**
     * Set dureevalidation
     *
     * @param integer $dureevalidation
     *
     * @return DevisLigne
     */
    public function setDureevalidation($dureevalidation)
    {
        $this->dureevalidation = $dureevalidation;

        return $this;
    }

    /**
     * Get dureevalidation
     *
     * @return integer
     */
    public function getDureevalidation()
    {
        return $this->dureevalidation;
    }

    /**
     * Set dureeelearning
     *
     * @param integer $dureeelearning
     *
     * @return DevisLigne
     */
    public function setDureeelearning($dureeelearning)
    {
        $this->dureeelearning = $dureeelearning;

        return $this;
    }

    /**
     * Get dureeelearning
     *
     * @return integer
     */
    public function getDureeelearning()
    {
        return $this->dureeelearning;
    }
	
	public function getTarifheure()
	{
		$heures=0;
		$tarif=0;
		$resultat=0;
		if($this->getForfaitmodules() != true && $this->dureemodules>0){
			$heures+=$this->dureemodules;
			$tarif+=$this->getMontanttotmodules();
		}
		if($this->getForfaitaccompagnements() != true && $this->dureeaccompagnements>0){
			$heures+=$this->dureeaccompagnements;
			$tarif+=$this->getMontanttotaccompagnements();
		}
		if($this->getForfaitelearning() != true && $this->dureeelearning>0){
			$heures+=$this->dureeelearning;
			$tarif+=$this->getMontanttotelearning();
		}
		if($this->getForfaitstages() != true && $this->dureestages>0){
			$heures+=$this->dureestages;
			$tarif+=$this->getMontanttotstages();
		}
		if($this->getForfaitvalidation() != true && $this->dureevalidation>0){
			$heures+=$this->dureevalidation;
			$tarif+=$this->getMontanttotvalidation();
		}
		if($heures>0){
			$resultat=round($tarif/$heures,2);
		}
		return $resultat;
	}

    /**
     * Set sessionmodule
     *
     * @param \App\Entity\SessionModule $sessionmodule
     *
     * @return DevisLigne
     */
    public function setSessionmodule(\App\Entity\SessionModule $sessionmodule = null)
    {
        $this->sessionmodule = $sessionmodule;

        return $this;
    }

    /**
     * Get sessionmodule
     *
     * @return \App\Entity\SessionModule
     */
    public function getSessionmodule()
    {
        return $this->sessionmodule;
    }

    /**
     * Set article
     *
     * @param \App\Entity\Article $article
     *
     * @return DevisLigne
     */
    public function setArticle(\App\Entity\Article $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \App\Entity\Article
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set sessioncertification.
     *
     * @param \App\Entity\SessionCertification|null $sessioncertification
     *
     * @return DevisLigne
     */
    public function setSessioncertification(\App\Entity\SessionCertification $sessioncertification = null)
    {
        $this->sessioncertification = $sessioncertification;

        return $this;
    }

    /**
     * Get sessioncertification.
     *
     * @return \App\Entity\SessionCertification|null
     */
    public function getSessioncertification()
    {
        return $this->sessioncertification;
    }

    /**
     * Set sessionjury.
     *
     * @param \App\Entity\SessionJury|null $sessionjury
     *
     * @return DevisLigne
     */
    public function setSessionjury(\App\Entity\SessionJury $sessionjury = null)
    {
        $this->sessionjury = $sessionjury;

        return $this;
    }

    /**
     * Get sessionjury.
     *
     * @return \App\Entity\SessionJury|null
     */
    public function getSessionjury()
    {
        return $this->sessionjury;
    }

    /**
     * Set quantite.
     *
     * @param string|null $quantite
     *
     * @return DevisLigne
     */
    public function setQuantite($quantite = null)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite.
     *
     * @return string|null
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set module.
     *
     * @param \App\Entity\Module|null $module
     *
     * @return DevisLigne
     */
    public function setModule(\App\Entity\Module $module = null)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get module.
     *
     * @return \App\Entity\Module|null
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Set prixunitaire.
     *
     * @param string|null $prixunitaire
     *
     * @return DevisLigne
     */
    public function setPrixunitaire($prixunitaire = null)
    {
        $this->prixunitaire = $prixunitaire;

        return $this;
    }

    /**
     * Get prixunitaire.
     *
     * @return string|null
     */
    public function getPrixunitaire()
    {
        return $this->prixunitaire;
    }

    /**
     * Set gratuit.
     *
     * @param bool|null $gratuit
     *
     * @return DevisLigne
     */
    public function setGratuit($gratuit = null)
    {
        $this->gratuit = $gratuit;

        return $this;
    }

    /**
     * Get gratuit.
     *
     * @return bool|null
     */
    public function getGratuit()
    {
        return $this->gratuit;
    }

    /**
     * Set certification.
     *
     * @param \App\Entity\Certification|null $certification
     *
     * @return DevisLigne
     */
    public function setCertification(\App\Entity\Certification $certification = null)
    {
        $this->certification = $certification;

        return $this;
    }

    /**
     * Get certification.
     *
     * @return \App\Entity\Certification|null
     */
    public function getCertification()
    {
        return $this->certification;
    }

    /**
     * Set dossier
     *
     * @param \App\Entity\Dossier $dossier
     *
     * @return DevisLigne
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
     * Add dossier.
     *
     * @param \App\Entity\Dossier $dossier
     *
     * @return DevisLigne
     */
    public function addDossier(\App\Entity\Dossier $dossier)
    {
        $this->dossiers[] = $dossier;

        return $this;
    }

    /**
     * Remove dossier.
     *
     * @param \App\Entity\Dossier $dossier
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeDossier(\App\Entity\Dossier $dossier)
    {
        return $this->dossiers->removeElement($dossier);
    }

    /**
     * Get dossiers.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDossiers()
    {
        return $this->dossiers;
    }
}
