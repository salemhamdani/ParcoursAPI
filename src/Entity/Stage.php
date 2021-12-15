<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * Stage
 *
 * @ORM\Table(name="stages")
 * @ORM\Entity(repositoryClass="App\Repository\StageRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class Stage
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sessionparcoursstages = new \Doctrine\Common\Collections\ArrayCollection();
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
	* @ORM\OneToMany(targetEntity="App\Entity\SessionParcoursStage", mappedBy="stage", cascade={"persist"})
	*/
	private $sessionparcoursstages;

     /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg", cascade={"persist"})
     */
    private $typeformation;

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
     * Set dateinsert
     *
     * @param \DateTime $dateinsert
     *
     * @return Stage
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
     * @return Stage
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
     * Set typeformation
     *
     * @param \App\Entity\Masterlistelg $typeformation
     *
     * @return Parcours
     */
    public function setTypeformation(\App\Entity\Masterlistelg $typeformation = null)
    {
        $this->typeformation = $typeformation;

        return $this;
    }

    /**
     * Get typeformation
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getTypeformation()
    {
        return $this->typeformation;
    }


    /**
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return Stage
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
     * @return Stage
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
     * @return Stage
     */
    public function addSessionparcoursstage(\App\Entity\SessionParcoursStage $sessionparcoursstage)
    {
        $this->sessionparcoursstages[] = $sessionparcoursstage;
		$sessionparcoursstage->setStage($this);
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
}
