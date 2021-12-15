<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * BlocModule
 *
 * @ORM\Table(name="bloc_modules")
 * @ORM\Entity(repositoryClass="App\Repository\BlocModuleRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class BlocModule
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sessionmoduleblocs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sessionmoduleparcours = new \Doctrine\Common\Collections\ArrayCollection();
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
	* @ORM\ManyToOne(targetEntity="App\Entity\Bloc", inversedBy="blocmodules", cascade={"persist"})
	*/
	private $bloc;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Module", inversedBy="blocmodules")
	*/
	private $module;

    /**
    * @var int
    *
    * @ORM\Column(name="ordre", type="integer", nullable=true)
    */
    private $ordre;
        

	/**
	* @ORM\OneToMany(targetEntity="App\Entity\SessionModuleBloc", mappedBy="blocmodule")
	*/
	private $sessionmoduleblocs;

	/**
	* @ORM\OneToMany(targetEntity="App\Entity\SessionModuleParcours", mappedBy="blocmodule")
	*/
	private $sessionmoduleparcours;

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
     * @return BlocModule
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
     * @return BlocModule
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
     * Set bloc
     *
     * @param \App\Entity\Bloc $bloc
     *
     * @return BlocModule
     */
    public function setBloc(\App\Entity\Bloc $bloc = null)
    {
        $this->bloc = $bloc;

        return $this;
    }

    /**
     * Get bloc
     *
     * @return \App\Entity\Bloc
     */
    public function getBloc()
    {
        return $this->bloc;
    }

    /**
     * Set module
     *
     * @param \App\Entity\Module $module
     *
     * @return BlocModule
     */
    public function setModule(\App\Entity\Module $module = null)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get module
     *
     * @return \App\Entity\Module
     */
    public function getModule()
    {
        return $this->module;
    }

    /* Set ordre
     *
     * @param integer $ordre
     *
     * @return BlocModule
     */
    public function setOrdre($ordre)
    {
        $this->ordre = $ordre;

        return $this;
    }

    /**
     * Get ordre
     *
     * @return int
     */
    public function getOrdre()
    {
        return $this->ordre;
    }


    /**
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return BlocModule
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
     * @return BlocModule
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
     * Add sessionmodulebloc
     *
     * @param \App\Entity\SessionModuleBloc $sessionmodulebloc
     *
     * @return BlocModule
     */
    public function addSessionmodulebloc(\App\Entity\SessionModuleBloc $sessionmodulebloc)
    {
        $this->sessionmoduleblocs[] = $sessionmodulebloc;
		$sessionmodulebloc->setBlocmodule($this);
        return $this;
    }

    /**
     * Remove sessionmodulebloc
     *
     * @param \App\Entity\SessionModuleBloc $sessionmodulebloc
     */
    public function removeSessionmodulebloc(\App\Entity\SessionModuleBloc $sessionmodulebloc)
    {
        $this->sessionmoduleblocs->removeElement($sessionmodulebloc);
    }

    /**
     * Get sessionmoduleblocs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSessionmoduleblocs()
    {
        return $this->sessionmoduleblocs;
    }

    /**
     * Add sessionmoduleparcour
     *
     * @param \App\Entity\SessionModuleParcours $sessionmoduleparcour
     *
     * @return BlocModule
     */
    public function addSessionmoduleparcour(\App\Entity\SessionModuleParcours $sessionmoduleparcour)
    {
        $this->sessionmoduleparcours[] = $sessionmoduleparcour;
		$sessionmoduleparcour->setBlocmodule($this);
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
}
