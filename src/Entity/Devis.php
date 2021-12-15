<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * Devis
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="devis")
 * @ORM\Entity(repositoryClass="App\Repository\DevisRepository")
 */
class Devis
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->devislignes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->archive = false;
        $this->devisapprenant = false;
        $this->devisentreprise = false;
		$this->sourcecalendrier = false;
		$this->devisinter = false;
		$this->devisintra = false;
		$this->sourceappli = false;
		$this->sourcefront = false;
		$this->valide = false;
		$this->chezclient = false;
		$this->chezof = false;
        $this->dateinsert = new \DateTime();
        $this->dateupdate = new \DateTime();
		$this->montantht = 0;
		$this->remisepourc = 0;
		$this->remise = 0;
		$this->montantpied = 0;
		$this->totalht = 0;
		$this->montanttva = 0;
		$this->montantttc = 0;
		$this->nbapprenants = 0;
        $this->repas = 0;
        $this->calendrierperso= false;
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
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $state;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Employe")
    */
    private $referentcommercial;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Societe")
    */
    private $societesource;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $repas;

    /**
    * @ORM\JoinColumn(nullable=true)
    * @ORM\OneToOne(targetEntity="App\Entity\Upload", cascade={"persist", "remove"})
     */
    private $signaturefile;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $signature; 

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Dossier", inversedBy="deviss")
    */
    private $dossier;

    /**
    * @ORM\ManyToMany(targetEntity="App\Entity\Dossier", mappedBy="devisentreprises")
    */
    private $dossiers;

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
    private $calendrierperso;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $devisapprenant;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $valide;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $devisentreprise;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Entreprise", inversedBy="deviss")
	*/
	private $entreprise;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $sourceappli;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $sourcefront;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $devisinter;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $devisintra;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbapprenants;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $sourcecalendrier;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $chezclient;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $chezof;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $debutformation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $finformation;

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
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $montantht;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $remisepourc;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $remise;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $montantpied;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $totalht;

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
    * @ORM\OneToMany(targetEntity="App\Entity\DevisLigne", mappedBy="devis", orphanRemoval=true, cascade={"persist"})
    */
    private $devislignes;

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
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function modification()
    {
        $this->dateupdate = new \DateTime();
    }

    /**
     * Set archive
     *
     * @param boolean $archive
     *
     * @return Devis
     */
    public function setArchive($archive)
    {
        $this->archive = $archive;

        return $this;
    }

    /**
     * Get archive
     *
     * @return boolean
     */
    public function getArchive()
    {
        return $this->archive;
    }

    /**
     * Set dateinsert
     *
     * @param \DateTime $dateinsert
     *
     * @return Devis
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
     * @return Devis
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
     * @return Devis
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
     * Set repas
     *
     * @param string $repas
     *
     * @return Devis
     */
    public function setRepas($repas)
    {
        $this->repas = $repas;

        return $this;
    }

    /**
     * Get repas
     *
     * @return string
     */
    public function getRepas()
    {
        return $this->repas;
    }
    /**
     * Set montantht
     *
     * @param string $montantht
     *
     * @return Devis
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
     * Set montantpied
     *
     * @param string $montantpied
     *
     * @return Devis
     */
    public function setMontantpied($montantpied)
    {
        $this->montantpied = $montantpied;

        return $this;
    }

    /**
     * Get montantpied
     *
     * @return string
     */
    public function getMontantpied()
    {
        return $this->montantpied;
    }

    /**
     * Set totalht
     *
     * @param string $totalht
     *
     * @return Devis
     */
    public function setTotalht($totalht)
    {
        $this->totalht = $totalht;

        return $this;
    }

    /**
     * Get totalht
     *
     * @return string
     */
    public function getTotalht()
    {
        return $this->totalht;
    }

    /**
     * Set tauxtva
     *
     * @param string $tauxtva
     *
     * @return Devis
     */
    public function setTauxtva($tauxtva)
    {
        $this->tauxtva = $tauxtva;

        return $this;
    }

    /**
     * Get tauxtva
     *
     * @return string
     */
    public function getTauxtva()
    {
        return $this->tauxtva;
    }

    /**
     * Set montanttva
     *
     * @param string $montanttva
     *
     * @return Devis
     */
    public function setMontanttva($montanttva)
    {
        $this->montanttva = $montanttva;

        return $this;
    }

    /**
     * Get montanttva
     *
     * @return string
     */
    public function getMontanttva()
    {
        return $this->montanttva;
    }

    /**
     * Set montantttc
     *
     * @param string $montantttc
     *
     * @return Devis
     */
    public function setMontantttc($montantttc)
    {
        $this->montantttc = $montantttc;

        return $this;
    }

    /**
     * Get montantttc
     *
     * @return string
     */
    public function getMontantttc()
    {
        return $this->montantttc;
    }

    /**
     * Set dossier
     *
     * @param \App\Entity\Dossier $dossier
     *
     * @return Devis
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
        if(! is_null($this->dossier))
        return $this->dossier;
         else foreach ($this->dossiers  as $dossier) {
            return $dossier;
        }
    }

    /**
     * Set codetva
     *
     * @param \App\Entity\CodeTva $codetva
     *
     * @return Devis
     */
    public function setCodetva(\App\Entity\CodeTva $codetva = null)
    {
        $this->codetva = $codetva;

        return $this;
    }

    /**
     * Get codetva
     *
     * @return \App\Entity\CodeTva
     */
    public function getCodetva()
    {
        return $this->codetva;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Devis
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return Devis
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
     * @return Devis
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
     * Add devisligne
     *
     * @param \App\Entity\DevisLigne $devisligne
     *
     * @return Devis
     */
    public function addDevisligne(\App\Entity\DevisLigne $devisligne)
    {
        $this->devislignes[] = $devisligne;
		$devisligne->setDevis($this);
        return $this;
    }

    /**
     * Remove devisligne
     *
     * @param \App\Entity\DevisLigne $devisligne
     */
    public function removeDevisligne(\App\Entity\DevisLigne $devisligne)
    {
        $this->devislignes->removeElement($devisligne);
    }

    /**
     * Get devislignes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDevislignes()
    {
        return $this->devislignes;
    }

    /**
     * Set remisepourc
     *
     * @param string $remisepourc
     *
     * @return Devis
     */
    public function setRemisepourc($remisepourc)
    {
        $this->remisepourc = $remisepourc;

        return $this;
    }

    /**
     * Get remisepourc
     *
     * @return string
     */
    public function getRemisepourc()
    {
        return $this->remisepourc;
    }

    /**
     * Set remise
     *
     * @param string $remise
     *
     * @return Devis
     */
    public function setRemise($remise)
    {
        $this->remise = $remise;

        return $this;
    }

    /**
     * Get remise
     *
     * @return string
     */
    public function getRemise()
    {
        return $this->remise;
    }

    /**
     * Set state
     *
     * @param \App\Entity\Masterlistelg $state
     *
     * @return Devis
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
     * Get archive
     *
     * @return boolean
     */
    public function getSessionsExiste()
    {
        $SessionsExiste=false;
        foreach ($this->devislignes as $DevisLigne) {
        $SessionsExiste=true;
            if( is_null($DevisLigne->getSession())  and is_null($DevisLigne->getSessionmodule()))
                $SessionsExiste=false ;
        } return $SessionsExiste;
    }
    

    /**
     * Set devisapprenant.
     *
     * @param bool $devisapprenant
     *
     * @return Devis
     */
    public function setDevisapprenant($devisapprenant)
    {
        $this->devisapprenant = $devisapprenant;

        return $this;
    }

    /**
     * Get devisapprenant.
     *
     * @return bool
     */
    public function getDevisapprenant()
    {
        return $this->devisapprenant;
    }

    /**
     * Set devisentreprise.
     *
     * @param bool $devisentreprise
     *
     * @return Devis
     */
    public function setDevisentreprise($devisentreprise)
    {
        $this->devisentreprise = $devisentreprise;

        return $this;
    }

    /**
     * Get devisentreprise.
     *
     * @return bool
     */
    public function getDevisentreprise()
    {
        return $this->devisentreprise;
    }


    /**
     * Set calendrierperso.
     *
     * @param bool $calendrierperso
     *
     * @return Devis
     */
    public function setCalendrierperso($calendrierperso)
    {
        $this->calendrierperso = $calendrierperso;

        return $this;
    }

    /**
     * Get calendrierperso.
     *
     * @return bool
     */
    public function getCalendrierperso()
    {
        return $this->calendrierperso;
    }
    /**
     * Set sourcecalendrier.
     *
     * @param bool $sourcecalendrier
     *
     * @return Devis
     */
    public function setSourcecalendrier($sourcecalendrier)
    {
        $this->sourcecalendrier = $sourcecalendrier;

        return $this;
    }

    /**
     * Get sourcecalendrier.
     *
     * @return bool
     */
    public function getSourcecalendrier()
    {
        return $this->sourcecalendrier;
    }

    /**
     * Set valide.
     *
     * @param bool $valide
     *
     * @return Devis
     */
    public function setValide($valide)
    {
        $this->valide = $valide;

        return $this;
    }

    /**
     * Get valide.
     *
     * @return bool
     */
    public function getValide()
    {
        return $this->valide;
    }

    /**
     * Set nbapprenants.
     *
     * @param int|null $nbapprenants
     *
     * @return Devis
     */
    public function setNbapprenants($nbapprenants = null)
    {
        $this->nbapprenants = $nbapprenants;

        return $this;
    }

    /**
     * Get nbapprenants.
     *
     * @return int|null
     */
    public function getNbapprenants()
    {
        return $this->nbapprenants;
    }

    /**
     * Set entreprise.
     *
     * @param \App\Entity\Entreprise|null $entreprise
     *
     * @return Devis
     */
    public function setEntreprise(\App\Entity\Entreprise $entreprise = null)
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    /**
     * Get entreprise.
     *
     * @return \App\Entity\Entreprise|null
     */
    public function getEntreprise()
    {
        return $this->entreprise;
    }

    /**
     * Set devisinter.
     *
     * @param bool|null $devisinter
     *
     * @return Devis
     */
    public function setDevisinter($devisinter = null)
    {
        $this->devisinter = $devisinter;

        return $this;
    }

    /**
     * Get devisinter.
     *
     * @return bool|null
     */
    public function getDevisinter()
    {
        return $this->devisinter;
    }

    /**
     * Set devisintra.
     *
     * @param bool|null $devisintra
     *
     * @return Devis
     */
    public function setDevisintra($devisintra = null)
    {
        $this->devisintra = $devisintra;

        return $this;
    }

    /**
     * Get devisintra.
     *
     * @return bool|null
     */
    public function getDevisintra()
    {
        return $this->devisintra;
    }

    /**
     * Set sourceappli.
     *
     * @param bool|null $sourceappli
     *
     * @return Devis
     */
    public function setSourceappli($sourceappli = null)
    {
        $this->sourceappli = $sourceappli;

        return $this;
    }

    /**
     * Get sourceappli.
     *
     * @return bool|null
     */
    public function getSourceappli()
    {
        return $this->sourceappli;
    }

    /**
     * Set sourcefront.
     *
     * @param bool|null $sourcefront
     *
     * @return Devis
     */
    public function setSourcefront($sourcefront = null)
    {
        $this->sourcefront = $sourcefront;

        return $this;
    }

    /**
     * Get sourcefront.
     *
     * @return bool|null
     */
    public function getSourcefront()
    {
        return $this->sourcefront;
    }

    /**
     * Set chezclient.
     *
     * @param bool|null $chezclient
     *
     * @return Devis
     */
    public function setChezclient($chezclient = null)
    {
        $this->chezclient = $chezclient;

        return $this;
    }

    /**
     * Get chezclient.
     *
     * @return bool|null
     */
    public function getChezclient()
    {
        return $this->chezclient;
    }

    /**
     * Set chezof.
     *
     * @param bool|null $chezof
     *
     * @return Devis
     */
    public function setChezof($chezof = null)
    {
        $this->chezof = $chezof;

        return $this;
    }

    /**
     * Get chezof.
     *
     * @return bool|null
     */
    public function getChezof()
    {
        return $this->chezof;
    }

    /**
     * Set societesource.
     *
     * @param \App\Entity\Societe|null $societesource
     *
     * @return Devis
     */
    public function setSocietesource(\App\Entity\Societe $societesource = null)
    {
        $this->societesource = $societesource;

        return $this;
    }

    /**
     * Get societesource.
     *
     * @return \App\Entity\Societe|null
     */
    public function getSocietesource()
    {
        return $this->societesource;
    }

    /**
     * Set referentcommercial.
     *
     * @param \App\Entity\Employe|null $referentcommercial
     *
     * @return Devis
     */
    public function setReferentcommercial(\App\Entity\Employe $referentcommercial = null)
    {
        $this->referentcommercial = $referentcommercial;

        return $this;
    }

    /**
     * Get referentcommercial.
     *
     * @return \App\Entity\Employe|null
     */
    public function getReferentcommercial()
    {
        return $this->referentcommercial;
    }

    /**
     * Add dossier.
     *
     * @param \App\Entity\Dossier $dossier
     *
     * @return Devis
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

    /**
     * Set debutformation.
     *
     * @param \DateTime|null $debutformation
     *
     * @return Devis
     */
    public function setDebutformation($debutformation = null)
    {
        $this->debutformation = $debutformation;

        return $this;
    }

    /**
     * Get debutformation.
     *
     * @return \DateTime|null
     */
    public function getDebutformation()
    {
        return $this->debutformation;
    }

    /**
     * Set finformation.
     *
     * @param \DateTime|null $finformation
     *
     * @return Devis
     */
    public function setFinformation($finformation = null)
    {
        $this->finformation = $finformation;

        return $this;
    }

    /**
     * Get finformation.
     *
     * @return \DateTime|null
     */
    public function getFinformation()
    {
        return $this->finformation;
    }

    /**
     * Set signature
     *
     * @param string $signature
     *
     * @return Devis
     */
    public function setSignature($signature)
    {
        $this->signature = $signature;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getSignature()
    {
        return $this->signature;
    }


    public function getDirectoryUploadSignature()
    {
        return strtolower((new \ReflectionClass($this))->getShortName().'-'.'signature');
    }
    /**
     * Set signaturefile
     * @param \App\Entity\Upload $signature
     * @return Devis
     */
    public function setSignaturefile(\App\Entity\Upload $signaturefile = null)
    {
        $this->signaturefile = $signaturefile;
        $this->signaturefile->setDirectoryUpload($this->getDirectoryUploadSignature());
        return $this;
    }
    /**
     * Get signaturefile
     *
     * @return \App\Entity\Upload
     */
    public function getSignaturefile()
    {
        return $this->signaturefile;
    }
}
