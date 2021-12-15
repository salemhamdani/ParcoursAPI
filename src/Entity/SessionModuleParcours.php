<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * SessionModuleParcours
 *
 * @ORM\Table(name="session_module_parcours")
 * @ORM\Entity(repositoryClass="App\Repository\SessionModuleParcoursRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class SessionModuleParcours
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sessionemargements = new \Doctrine\Common\Collections\ArrayCollection();
		$this->apprenantconfirme = false;
		$this->compteheure = false;
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
	* @ORM\ManyToOne(targetEntity="App\Entity\BlocModule", inversedBy="sessionmoduleparcours")
	*/
	private $blocmodule;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\SessionEvenement", inversedBy="sessionmoduleparcours")
	*/
	private $sessionevenement;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\SessionSalle", inversedBy="sessionmoduleparcours")
	*/
	private $sessionsalle;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Formateur")
    */
    private $formateur;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\EnchainementModule", inversedBy="sessionmoduleparcours")
    */
    private $enchainementmodule;
    
	/**
	* @ORM\OneToMany(targetEntity="App\Entity\SessionEmargement", mappedBy="sessionmoduleparcours", cascade={"persist", "remove"})
	*/
	private $sessionemargements;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\SessionDossier", inversedBy="sessionmoduleparcours")
	*/
	private $sessiondossier;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $compteheure;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $apprenantconfirme;

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
    * @ORM\Column(name="note", type="text", nullable=true)
    */
    private $note;

    /**
    * @ORM\Column(name="commentaire", type="text", nullable=true)
    */
    private $commentaire;

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
     * @return SessionModuleParcours
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
     * @return SessionModuleParcours
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
     * Set blocmodule
     *
     * @param \App\Entity\BlocModule $blocmodule
     *
     * @return SessionModuleParcours
     */
    public function setBlocmodule(\App\Entity\BlocModule $blocmodule = null)
    {
        $this->blocmodule = $blocmodule;

        return $this;
    }

    /**
     * Get blocmodule
     *
     * @return \App\Entity\BlocModule
     */
    public function getBlocmodule()
    {
        return $this->blocmodule;
    }

    /**
     * Add sessionemargement
     *
     * @param \App\Entity\SessionEmargement $sessionemargement
     *
     * @return SessionModuleParcours
     */
    public function addSessionemargement(\App\Entity\SessionEmargement $sessionemargement)
    {
        $this->sessionemargements[] = $sessionemargement;
		$sessionemargement->setSessionmoduleparcours($this);
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
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return SessionModuleParcours
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
     * @return SessionModuleParcours
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
     * Set sessiondossier
     *
     * @param \App\Entity\SessionDossier $sessiondossier
     *
     * @return SessionModuleParcours
     */
    public function setSessiondossier(\App\Entity\SessionDossier $sessiondossier = null)
    {
        $this->sessiondossier = $sessiondossier;


        return $this;
    }

    /**
     * Get sessiondossier
     *
     * @return \App\Entity\SessionDossier
     */
    public function getSessiondossier()
    {
        return $this->sessiondossier;

    }

    /**
     * Set apprenantconfirme
     *
     * @param boolean $apprenantconfirme
     *
     * @return SessionModuleParcours
     */
    public function setApprenantconfirme($apprenantconfirme)
    {
        $this->apprenantconfirme = $apprenantconfirme;

        return $this;
    }

    /**
     * Get apprenantconfirme
     *
     * @return boolean
     */
    public function getApprenantconfirme()
    {
        return $this->apprenantconfirme;
    }
	
	public function changeApprenantconfirme()
	{
		if($this->getApprenantconfirme()==true){
			$this->setApprenantconfirme(false);
		}else{
			$this->setApprenantconfirme(true);
		}
		return $this;
	}

    /**
     * Set sessionevenement
     *
     * @param \App\Entity\SessionEvenement $sessionevenement
     *
     * @return SessionModuleParcours
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

    /**
     * Set compteheure
     *
     * @param boolean $compteheure
     *
     * @return SessionModuleParcours
     */
    public function setCompteheure($compteheure)
    {
        $this->compteheure = $compteheure;

        return $this;
    }

    /**
     * Get compteheure
     *
     * @return boolean
     */
    public function getCompteheure()
    {
        return $this->compteheure;
    }

    /**
     * Set enchainementmodule
     *
     * @param \App\Entity\EnchainementModule $enchainementmodule
     *
     * @return SessionModuleParcours
     */
    public function setEnchainementmodule(\App\Entity\EnchainementModule $enchainementmodule = null)
    {
        $this->enchainementmodule = $enchainementmodule;

        return $this;
    }

    /**
     * Get enchainementmodule
     *
     * @return \App\Entity\EnchainementModule
     */
    public function getEnchainementmodule()
    {
        return $this->enchainementmodule;
    }

    /**
     * Set sessionsalle.
     *
     * @param \App\Entity\SessionSalle|null $sessionsalle
     *
     * @return SessionModuleParcours
     */
    public function setSessionsalle(\App\Entity\SessionSalle $sessionsalle = null)
    {
        $this->sessionsalle = $sessionsalle;

        return $this;
    }

    /**
     * Get sessionsalle.
     *
     * @return \App\Entity\SessionSalle|null
     */
    public function getSessionsalle()
    {
        return $this->sessionsalle;
    }

    /**
     * Set note.
     *
     * @param string|null $note
     *
     * @return SessionModuleParcours
     */
    public function setNote($note = null)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note.
     *
     * @return string|null
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set commentaire.
     *
     * @param string|null $commentaire
     *
     * @return SessionModuleParcours
     */
    public function setCommentaire($commentaire = null)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire.
     *
     * @return string|null
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set formateur.
     *
     * @param \App\Entity\Formateur|null $formateur
     *
     * @return SessionModuleParcours
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

}
