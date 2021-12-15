<?php

namespace App\Entity;

use App\Entity\Evenement;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * SessionEvenement
 *
 * @ORM\Table(name="session_evenements")
 * @ORM\Entity(repositoryClass="App\Repository\SessionEvenementRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class SessionEvenement extends Evenement
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sessionsalles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sessionmoduleparcours = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sessionformateurs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sessionemargements = new \Doctrine\Common\Collections\ArrayCollection();
		$this->archive = false;
    }

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
	*/
	private $statutsessionevt;

	/**
     * @ORM\OneToOne(targetEntity="App\Entity\SessionCertification", mappedBy="sessionevenement", cascade={"remove","persist"})
     */
    private $sessioncertif;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
//    private $id;

	/**
	* @ORM\OneToMany(targetEntity="App\Entity\SessionSalle", mappedBy="sessionevenement", orphanRemoval=true, cascade={"remove","persist"})
	*/
	private $sessionsalles;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\SessionParcoursStage", inversedBy="sessionevenements")
	*/
	private $sessionparcoursstage;

	/**
     * @ORM\OneToOne(targetEntity="App\Entity\SessionJury", mappedBy="sessionevenement")
     */
    private $sessionjury;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\SessionModule", inversedBy="sessionevenements")
	*/
	private $sessionmodule;

	/**
    * @ORM\OneToMany(targetEntity="App\Entity\SessionFormateur", mappedBy="sessionevenement", cascade={"persist", "remove"})
    */
    private $sessionformateurs;

	/**
    * @ORM\OneToMany(targetEntity="App\Entity\SessionEmargement", mappedBy="sessionevenement", cascade={"persist", "remove"})
    */
    private $sessionemargements;

	/**
     * @ORM\OneToOne(targetEntity="App\Entity\SessionAccompagnement", mappedBy="sessionevenement", cascade={"persist"})
     */
    private $sessionaccompagnement;

	/**
	* @ORM\OneToMany(targetEntity="App\Entity\SessionModuleParcours", mappedBy="sessionevenement", cascade={"persist"})
	*/
	private $sessionmoduleparcours;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
	*/
	private $typesessionevenement;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
	*/
	private $modaliteapprentissage;

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
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $convocationstagiaire=false;
    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $convocationformateur=false;

 
    /**
     * Get id
     *
     * @return integer
     */
/*
    public function getId()
    {
        return $this->id;
    }
*/
    /**
     * Set dateinsert
     *
     * @param \DateTime $dateinsert
     *
     * @return Session
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
     * @return Session
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
     * Add sessionsalle
     *
     * @param \App\Entity\SessionSalle $sessionsalle
     *
     * @return Session
     */
    public function addSessionsalle(\App\Entity\SessionSalle $sessionsalle)
    {
        $this->sessionsalles[] = $sessionsalle;
		$sessionsalle->setSessionEvenement($this);
        return $this;
    }

    /**
     * Remove sessionsalle
     *
     * @param \App\Entity\SessionSalle $sessionsalle
     */
    public function removeSessionsalle(\App\Entity\SessionSalle $sessionsalle)
    {
        $this->sessionsalles->removeElement($sessionsalle);
    }

    /**
     * Get sessionsalles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSessionsalles()
    {
        return $this->sessionsalles;
    }

    /**
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return Session
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
     * @return Session
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
     * Set sessionjury
     *
     * @param \App\Entity\SessionJury $sessionjury
     *
     * @return SessionEvenement
     */
    public function setSessionjury(\App\Entity\SessionJury $sessionjury = null)
    {
        $this->sessionjury = $sessionjury;

        return $this;
    }

    /**
     * Get sessionjury
     *
     * @return \App\Entity\SessionJury
     */
    public function getSessionjury()
    {
        return $this->sessionjury;
    }

    /**
     * Set sessioncertification
     *
     * @param \App\Entity\SessionCertification $sessioncertification
     *
     * @return SessionEvenement
     */
    public function setSessioncertification(\App\Entity\SessionCertification $sessioncertification = null)
    {
        $this->sessioncertif = $sessioncertification;

        return $this;
    }

    /**
     * Get sessioncertification
     *
     * @return \App\Entity\SessionCertification
     */
    public function getSessioncertification()
    {
        return $this->sessioncertif;
    }

	// retourne le nombre de personnes inscrites à cet évènement
	public function getNbPersonnes(){

		$resultat=0;
		if(!is_null($this->getSessionjury())){
			$resultat +=count($this->getSessionjury()->getNbPersonnes());
		}
		if(!is_null($this->getSessioncertification())){
			$resultat +=count($this->getSessioncertification()->getNbPersonnes());
		}
		if(!is_null($this->getSessionmodule())){
			$resultat +=count($this->getSessionmodule()->getNbPersonnes());
		}
		return $resultat;
	}

    /**
     * Set sessionparcoursstage
     *
     * @param \App\Entity\SessionParcoursStage $sessionparcoursstage
     *
     * @return SessionEvenement
     */
    public function setSessionparcoursstage(\App\Entity\SessionParcoursStage $sessionparcoursstage = null)
    {
        $this->sessionparcoursstage = $sessionparcoursstage;

        return $this;
    }

    /**
     * Get sessionparcoursstage
     *
     * @return \App\Entity\SessionParcoursStage
     */
    public function getSessionparcoursstage()
    {
        return $this->sessionparcoursstage;
    }

    /**
     * Set sessionaccompagnement
     *
     * @param \App\Entity\SessionAccompagnement $sessionaccompagnement
     *
     * @return SessionEvenement
     */
    public function setSessionaccompagnement(\App\Entity\SessionAccompagnement $sessionaccompagnement = null)
    {
        $this->sessionaccompagnement = $sessionaccompagnement;
		$sessionaccompagnement->setSessionEvenement($this);
        return $this;
    }

    /**
     * Get sessionaccompagnement
     *
     * @return \App\Entity\SessionAccompagnement
     */
    public function getSessionaccompagnement()
    {
        return $this->sessionaccompagnement;
    }

    /**
     * Set statutsessionevt
     *
     * @param \App\Entity\Masterlistelg $statutsessionevt
     *
     * @return SessionEvenement
     */
    public function setStatutsessionevt(\App\Entity\Masterlistelg $statutsessionevt = null)
    {
        $this->statutsessionevt = $statutsessionevt;

        return $this;
    }

    /**
     * Get statutsessionevt
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getStatutsessionevt()
    {
        return $this->statutsessionevt;
    }
	
	public function getIdSallesFusionnables()
	{
		$resultat=[];
		if(count($this->getSessionsalles())==0){
			return $resultat;
		}
		foreach($this->getSessionsalles() as $sessionsalle){
            if(! is_null($sessionsalle->getSalle()))
			foreach($sessionsalle->getSalle()->getFusionnableavec() as $autresalle){
				$resultat[]=$autresalle->getId();
			}
		}
		$resultat = array_unique($resultat);
		return $resultat;
	}

    /**
     * Set sessionmodule
     *
     * @param \App\Entity\SessionModule $sessionmodule
     *
     * @return SessionEvenement
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
     * Add sessionmoduleparcour
     *
     * @param \App\Entity\SessionModuleParcours $sessionmoduleparcour
     *
     * @return SessionEvenement
     */
    public function addSessionmoduleparcour(\App\Entity\SessionModuleParcours $sessionmoduleparcour)
    {
        $this->sessionmoduleparcours[] = $sessionmoduleparcour;

        return $this;
    }

    /**
     * Remove sessionmoduleparcour
     *
     * @param \App\Entity\SessionModuleParcours $sessionmoduleparcour
     */
    public function removeSessionmoduleparcour(\App\Entity\SessionModuleParcours $sessionmoduleparcour)
    {
        $this->sessionmoduleparcours->removeElement($sessionmoduleparcour);
    }

    /**
     * Get sessionmoduleparcours
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSessionmoduleparcours()
    {
        return $this->sessionmoduleparcours;
    }

    /**
     * Add sessionformateur
     *
     * @param \App\Entity\SessionFormateur $sessionformateur
     *
     * @return SessionEvenement
     */
    public function addSessionformateur(\App\Entity\SessionFormateur $sessionformateur)
    {
        $this->sessionformateurs[] = $sessionformateur;
		$sessionformateur->setSessionevenement($this);
        return $this;
    }

    /**
     * Remove sessionformateur
     *
     * @param \App\Entity\SessionFormateur $sessionformateur
     */
    public function removeSessionformateur(\App\Entity\SessionFormateur $sessionformateur)
    {
        $this->sessionformateurs->removeElement($sessionformateur);
    }

    /**
     * Get sessionformateurs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSessionformateurs()
    {
        return $this->sessionformateurs;
    }

    /**
     * Set typesessionevenement
     *
     * @param \App\Entity\Masterlistelg $typesessionevenement
     *
     * @return SessionEvenement
     */
    public function setTypesessionevenement(\App\Entity\Masterlistelg $typesessionevenement = null)
    {
        $this->typesessionevenement = $typesessionevenement;

        return $this;
    }

    /**
     * Get typesessionevenement
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getTypesessionevenement()
    {
        return $this->typesessionevenement;
    }
	
	public function getIntitule()
	{
		if(!is_null($this->getPere())){
			$sevent=$this->getPere();
		}else{
			$sevent=$this;
		}
		// module
		if(!is_null($sevent->getSessionmodule())){
			return $sevent->getSessionmodule()->getModule()->getCode().' '.$sevent->getSessionmodule()->getModule()->getIntitule();
		}
		// accompagnement..
		if(!is_null($sevent->getSessionaccompagnement())){
			if(!is_null($sevent->getSessionaccompagnement()->getTypeaccompagnement())){
				return $sevent->getSessionaccompagnement()->getTypeaccompagnement()->getDesignation();
			}else{
				return 'Accompagnement';
			}
		}
		return '';
	}

    /**
     * Add sessionemargement
     *
     * @param \App\Entity\SessionEmargement $sessionemargement
     *
     * @return SessionEvenement
     */
    public function addSessionemargement(\App\Entity\SessionEmargement $sessionemargement)
    {
        $this->sessionemargements[] = $sessionemargement;
		$sessionemargement->setSessionevenement($this);
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

    /**
     * Set sessioncertif
     *
     * @param \App\Entity\SessionCertification $sessioncertif
     *
     * @return SessionEvenement
     */
    public function setSessioncertif(\App\Entity\SessionCertification $sessioncertif = null)
    {
        $this->sessioncertif = $sessioncertif;

        return $this;
    }

    /**
     * Get sessioncertif
     *
     * @return \App\Entity\SessionCertification
     */
    public function getSessioncertif()
    {
        return $this->sessioncertif;
    }

    /**
     * Set modaliteapprentissage.
     *
     * @param \App\Entity\Masterlistelg|null $modaliteapprentissage
     *
     * @return SessionEvenement
     */
    public function setModaliteapprentissage(\App\Entity\Masterlistelg $modaliteapprentissage = null)
    {
        $this->modaliteapprentissage = $modaliteapprentissage;

        return $this;
    }

    /**
     * Get modaliteapprentissage.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getModaliteapprentissage()
    {
        return $this->modaliteapprentissage;
    }



    /**
     * Set convocationstagiaire
     *
     * @param boolean $convocationstagiaire
     *
     * @return Dossier
     */
    public function setConvocationstagiaire($convocationstagiaire)
    {
        $this->convocationstagiaire = $convocationstagiaire;

        return $this;
    }
  
    /**
     * Get convocationstagiaire
     *
     * @return boolean
     */
    public function getConvocationstagiaire()
    {
        return $this->convocationstagiaire;
    }


    /**
     * Set convocationformateur
     *
     * @param boolean $convocationformateur
     *
     * @return Dossier
     */
    public function setConvocationformateur($convocationformateur)
    {
        $this->convocationformateur = $convocationformateur;

        return $this;
    }
  
    /**
     * Get convocationformateur
     *
     * @return boolean
     */
    public function getConvocationformateur()
    {
        return $this->convocationformateur;
    }

}
