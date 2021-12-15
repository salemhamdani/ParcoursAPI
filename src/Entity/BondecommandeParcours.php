<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * BondecommandeParcours
 *
 * @ORM\Table(name="bondecommande_parcours")
 * @ORM\Entity(repositoryClass="App\Repository\BondecommandeParcoursRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class BondecommandeParcours
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cotraitance = false;
        $this->sessions = new \Doctrine\Common\Collections\ArrayCollection();
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
	* @ORM\ManyToOne(targetEntity="App\Entity\Bondecommande", inversedBy="bdcparcours", cascade={"persist"})
	*/
	private $bondecommande;

    /**
    * @ORM\OneToOne(targetEntity="App\Entity\TarifVenteParcours", mappedBy="bdcparcours")
    */
    private $tarifvente;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Parcours")
	*/
	private $parcours;

	/**
	* @ORM\ManyToMany(targetEntity="App\Entity\Session", inversedBy="bdcparcours")
	*/
	private $sessions;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $volumetotal;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $effectif;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $cotraitance;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Partenaire")
	*/
	private $partenaire;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Societe")
	*/
	private $societe;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Site")
	*/
	private $site;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Adresse")
	*/
	private $adresse;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datedebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datefin;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set datedebut
     *
     * @param \DateTime $datedebut
     *
     * @return BondecommandeParcours
     */
    public function setDatedebut($datedebut)
    {
        $this->datedebut = $datedebut;

        return $this;
    }

    /**
     * Get datedebut
     *
     * @return \DateTime
     */
    public function getDatedebut()
    {
        return $this->datedebut;
    }

    /**
     * Set datefin
     *
     * @param \DateTime $datefin
     *
     * @return BondecommandeParcours
     */
    public function setDatefin($datefin)
    {
        $this->datefin = $datefin;

        return $this;
    }

    /**
     * Get datefin
     *
     * @return \DateTime
     */
    public function getDatefin()
    {
        return $this->datefin;
    }

    /**
     * Set dateinsert
     *
     * @param \DateTime $dateinsert
     *
     * @return BondecommandeParcours
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
     * @return BondecommandeParcours
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
     * Set bondecommande
     *
     * @param \App\Entity\Bondecommande $bondecommande
     *
     * @return BondecommandeParcours
     */
    public function setBondecommande(\App\Entity\Bondecommande $bondecommande = null)
    {
        $this->bondecommande = $bondecommande;

        return $this;
    }

    /**
     * Get bondecommande
     *
     * @return \App\Entity\Bondecommande
     */
    public function getBondecommande()
    {
        return $this->bondecommande;
    }

    /**
     * Set parcours
     *
     * @param \App\Entity\Parcours $parcours
     *
     * @return BondecommandeParcours
     */
    public function setParcours(\App\Entity\Parcours $parcours = null)
    {
        $this->parcours = $parcours;

        return $this;
    }

    /**
     * Get parcours
     *
     * @return \App\Entity\Parcours
     */
    public function getParcours()
    {
        return $this->parcours;
    }

    /**
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return BondecommandeParcours
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
     * @return BondecommandeParcours
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
     * Set partenaire
     *
     * @param \App\Entity\Partenaire $partenaire
     *
     * @return BondecommandeParcours
     */
    public function setPartenaire(\App\Entity\Partenaire $partenaire = null)
    {
        $this->partenaire = $partenaire;

        return $this;
    }

    /**
     * Get partenaire
     *
     * @return \App\Entity\Partenaire
     */
    public function getPartenaire()
    {
        return $this->partenaire;
    }

    /**
     * Set cotraitance
     *
     * @param boolean $cotraitance
     *
     * @return BondecommandeParcours
     */
    public function setCotraitance($cotraitance)
    {
        $this->cotraitance = $cotraitance;

        return $this;
    }

    /**
     * Get cotraitance
     *
     * @return boolean
     */
    public function getCotraitance()
    {
        return $this->cotraitance;
    }

    /**
     * Set societe
     *
     * @param \App\Entity\Societe $societe
     *
     * @return BondecommandeParcours
     */
    public function setSociete(\App\Entity\Societe $societe = null)
    {
        $this->societe = $societe;

        return $this;
    }

    /**
     * Get societe
     *
     * @return \App\Entity\Societe
     */
    public function getSociete()
    {
        return $this->societe;
    }

    /**
     * Set site
     *
     * @param \App\Entity\Site $site
     *
     * @return BondecommandeParcours
     */
    public function setSite(\App\Entity\Site $site = null)
    {
        $this->site = $site;

        return $this;
    }

    /**
     * Get site
     *
     * @return \App\Entity\Site
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * Set adresse
     *
     * @param \App\Entity\Adresse $adresse
     *
     * @return BondecommandeParcours
     */
    public function setAdresse(\App\Entity\Adresse $adresse = null)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return \App\Entity\Adresse
     */
    public function getAdresse()
    {
        return $this->adresse;
    }
	
	public function getSocieteEntiteDesignation()
	{
		if($this->cotraitance==true){
			if(!is_null($this->partenaire)){
				return $this->partenaire->getTiers()->getRaisonSocial();
			}
		}else{
			if(!is_null($this->societe)){
				return $this->societe->getRaisonsociale();
			}
		}
		return null;
	}

    /**
     * Set volumetotal
     *
     * @param string $volumetotal
     *
     * @return BondecommandeParcours
     */
    public function setVolumetotal($volumetotal)
    {
        $this->volumetotal = $volumetotal;

        return $this;
    }

    /**
     * Get volumetotal
     *
     * @return string
     */
    public function getVolumetotal()
    {
        return $this->volumetotal;
    }

    /**
     * Set effectif
     *
     * @param integer $effectif
     *
     * @return BondecommandeParcours
     */
    public function setEffectif($effectif)
    {
        $this->effectif = $effectif;

        return $this;
    }

    /**
     * Get effectif
     *
     * @return integer
     */
    public function getEffectif()
    {
        return $this->effectif;
    }


    /**
     * Set tarifvente
     *
     * @param \App\Entity\TarifVenteParcours $tarifvente
     *
     * @return BondecommandeParcours
     */
    public function setTarifvente(\App\Entity\TarifVenteParcours $tarifvente = null)
    {
        $this->tarifvente = $tarifvente;

        return $this;
    }

    /**
     * Get tarifvente
     *
     * @return \App\Entity\TarifVenteParcours
     */
    public function getTarifvente()
    {
        return $this->tarifvente;
    }


    /**
     * Add session
     *
     * @param \App\Entity\Session $session
     *
     * @return BondecommandeParcours
     */
    public function addSession(\App\Entity\Session $session)
    {
        $this->sessions[] = $session;

        return $this;
    }

    /**
     * Remove session
     *
     * @param \App\Entity\Session $session
     */
    public function removeSession(\App\Entity\Session $session)
    {
        $this->sessions->removeElement($session);
    }

    /**
     * Get sessions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSessions()
    {
        return $this->sessions;
    }
}
