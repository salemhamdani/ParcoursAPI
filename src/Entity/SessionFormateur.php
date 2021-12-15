<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * SessionFormateur
 *
 * @ORM\Table(name="session_formateur")
 * @ORM\Entity(repositoryClass="App\Repository\SessionFormateurRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class SessionFormateur
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->evenements = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sessionemargements = new \Doctrine\Common\Collections\ArrayCollection();
		$this->nbjoursprevus = 0;
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
	* @ORM\ManyToOne(targetEntity="App\Entity\Formateur", inversedBy="sessionformateurs", cascade={"persist"})
	*/
	private $formateur;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $tarifheure;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=10, nullable=true)
     */
    private $nbjoursprevus;

	/**
    * @ORM\ManyToOne(targetEntity="App\Entity\SessionEvenement", inversedBy="sessionformateurs", cascade={"persist"})
    */
    private $sessionevenement;
    
    /**
    * @ORM\OneToMany(targetEntity="App\Entity\SessionEmargement", mappedBy="sessionformateur", cascade={"persist", "remove"})
    */
    private $sessionemargements;

	/**
	* @ORM\OneToMany(targetEntity="App\Entity\Evenement", mappedBy="sessionformateur")
	*/
	private $evenements;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
	*/
	private $statutformateur;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Contrat")
	*/
	private $contrat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime",nullable=true)
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
     * Set dateinsert
     *
     * @param \DateTime $dateinsert
     *
     * @return SessionFormateur
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
     * @return SessionFormateur
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
     * Set formateur
     *
     * @param \App\Entity\Formateur $formateur
     *
     * @return SessionFormateur
     */
    public function setFormateur(\App\Entity\Formateur $formateur = null)
    {
        $this->formateur = $formateur;

        return $this;
    }

    /**
     * Get formateur
     *
     * @return \App\Entity\Formateur
     */
    public function getFormateur()
    {
        return $this->formateur;
    }

    /**
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return SessionFormateur
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
     * @return SessionFormateur
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
     * Set statutformateur
     *
     * @param \App\Entity\Masterlistelg $statutformateur
     *
     * @return SessionFormateur
     */
    public function setStatutformateur(\App\Entity\Masterlistelg $statutformateur = null)
    {
        $this->statutformateur = $statutformateur;

        return $this;
    }

    /**
     * Get statutformateur
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getStatutformateur()
    {
        return $this->statutformateur;
    }

    /**
     * Set datedebut
     *
     * @param \DateTime $datedebut
     *
     * @return SessionFormateur
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
     * @return SessionFormateur
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
     * Add evenement
     *
     * @param \App\Entity\Evenement $evenement
     *
     * @return SessionFormateur
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
    public function removeEvenement(\App\Entity\Evenement $evenement)
    {
		$evenement->setSessionformateur(null);
        $this->evenements->removeElement($evenement);
    }

    /**
     * Get evenements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvenements()
    {
        return $this->evenements;
    }

    /**
     * Set sessionevenement
     *
     * @param \App\Entity\SessionEvenement $sessionevenement
     *
     * @return SessionFormateur
     */
    public function setSessionevenement(\App\Entity\SessionEvenement $sessionevenement = null)
    {
        $this->sessionevenement = $sessionevenement;

        return $this;
    }

    /**
     * Get sessionevenement
     *
     * @return \App\Entity\SessionEvenement
     */
    public function getSessionevenement()
    {
        return $this->sessionevenement;
    }

        public function getNbJoursTotal()
    {
        if(!is_null($this->getDatedebut()) && !is_null($this->getDatefin())){
            return $this->getDatedebut()->diff($this->getDatefin())->days;
        }
        return 0;
    }

    public function getNbSemainesTotal()
    {
        return round($this->getNbJoursTotal()/7,1);
    }

    /**
     * Set contrat.
     *
     * @param \App\Entity\Contrat|null $contrat
     *
     * @return SessionFormateur
     */
    public function setContrat(\App\Entity\Contrat $contrat = null)
    {
        $this->contrat = $contrat;

        return $this;
    }

    /**
     * Get contrat.
     *
     * @return \App\Entity\Contrat|null
     */
    public function getContrat()
    {
        return $this->contrat;
    }

    /**
     * Set tarifheure.
     *
     * @param string|null $tarifheure
     *
     * @return SessionFormateur
     */
    public function setTarifheure($tarifheure = null)
    {
        $this->tarifheure = $tarifheure;

        return $this;
    }

    /**
     * Get tarifheure.
     *
     * @return string|null
     */
    public function getTarifheure()
    {
        return $this->tarifheure;
    }

    /**
     * Set signature
     *
     * @param string $signature
     *
     * @return SessionFormateur
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
     * @return SessionFormateur
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

    /**
     * Set nbjoursprevus.
     *
     * @param string|null $nbjoursprevus
     *
     * @return SessionFormateur
     */
    public function setNbjoursprevus($nbjoursprevus = null)
    {
        $this->nbjoursprevus = $nbjoursprevus;

        return $this;
    }

    /**
     * Get nbjoursprevus.
     *
     * @return string|null
     */
    public function getNbjoursprevus()
    {
        return $this->nbjoursprevus;
    }


    /**
     * Add sessionemargement
     *
     * @param \App\Entity\SessionEmargement $sessionemargement
     *
     * @return SessionFormateur
     */
    public function addSessionemargement(\App\Entity\SessionEmargement $sessionemargement)
    {
        $this->sessionemargements[] = $sessionemargement;
        $sessionemargement->setSessionFormateur($this);
        return $this;
    }

    /**
     * Remove sessionemargement
     *
     * @param \App\Entity\SessionEmargement $sessionemargement
     */
    public function removeSessionemargement(\App\Entity\SessionEmargement $sessionemargement)
    {
        $this->sessionemargements->removeElement($sessionemargement);
    }

    /**
     * Get sessionemargements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSessionemargements()
    {
        return $this->sessionemargements;
    }
}
