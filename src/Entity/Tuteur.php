<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * Tuteur
 *
 * @ORM\Table(name="tuteurs")
 * @ORM\Entity(repositoryClass="App\Repository\TuteurRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class Tuteur
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sessionparcoursstages = new \Doctrine\Common\Collections\ArrayCollection();
		$this->responsable = false;
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
	* @ORM\OneToMany(targetEntity="App\Entity\SessionParcoursStage", mappedBy="tuteur")
	*/
	private $sessionparcoursstages;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\PersonalInformations",cascade={"persist"})
    */
    private $personalinformations;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Entreprise", inversedBy="tuteurs")
	*/
	private $entreprise;

	/**
	* @ORM\JoinColumn(nullable=true)
	* @ORM\OneToOne(targetEntity="App\Entity\Upload", cascade={"persist", "remove"})
     */
    private $cv;

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
     * @ORM\Column(name="responsable", type="boolean")
     */
    private $responsable;

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
     * @return Tuteur
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
     * @return Tuteur
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
     * Set entreprise
     *
     * @param \App\Entity\Entreprise $entreprise
     *
     * @return Tuteur
     */
    public function setEntreprise(\App\Entity\Entreprise $entreprise = null)
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    /**
     * Get entreprise
     *
     * @return \App\Entity\Entreprise
     */
    public function getEntreprise()
    {
        return $this->entreprise;
    }

    /**
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return Tuteur
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
     * @return Tuteur
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
     * Add sessionparcoursstage
     *
     * @param \App\Entity\SessionParcoursStage $sessionparcoursstage
     *
     * @return Tuteur
     */
    public function addSessionparcoursstage(\App\Entity\SessionParcoursStage $sessionparcoursstage)
    {
        $this->sessionparcoursstages[] = $sessionparcoursstage;
		$sessionparcoursstage->setTuteur($this);
        return $this;
    }

    /**
     * Remove sessionparcoursstage
     *
     * @param \App\Entity\SessionParcoursStage $sessionparcoursstage
     */
    public function removeSessionparcoursstage(\App\Entity\SessionParcoursStage $sessionparcoursstage)
    {
        $this->sessionparcoursstages->removeElement($sessionparcoursstage);
    }

    /**
     * Get sessionparcoursstages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSessionparcoursstages()
    {
        return $this->sessionparcoursstages;
    }

    /**
     * Set personalinformations
     *
     * @param \App\Entity\PersonalInformations $personalinformations
     *
     * @return Tuteur
     */
    public function setPersonalinformations(\App\Entity\PersonalInformations $personalinformations = null)
    {
        $this->personalinformations = $personalinformations;

        return $this;
    }

    /**
     * Get personalinformations
     *
     * @return \App\Entity\PersonalInformations
     */
    public function getPersonalinformations()
    {
        return $this->personalinformations;
    }

    /**
     * Set cv
     *
     * @param \App\Entity\Upload $cv
     *
     * @return Tuteur
     */
    public function setCv(\App\Entity\Upload $cv = null)
    {
        $this->cv = $cv;
		if(!is_null($cv)){
			$this->cv->setDirectoryUpload($this->getDirectoryUpload());
		}
        return $this;
    }

	public function getDirectoryUpload()
	{
		return strtolower((new \ReflectionClass($this))->getShortName().'-'.'cv');
	}

    /**
     * Get cv
     *
     * @return \App\Entity\Upload
     */
    public function getCv()
    {
        return $this->cv;
    }
    
    /**
     * Set responsable
     *
     * @param boolean $responsable
     *
     * @return Tuteur
     */
    public function setResponsable($responsable)
    {
        $this->responsable = $responsable;

        return $this;
    }

    /**
     * Get responsable
     *
     * @return boolean
     */
    public function getResponsable()
    {
        return $this->responsable;
    }
}
