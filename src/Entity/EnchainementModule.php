<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * EnchainementModule
 *
 * @ORM\Table(name="enchainement_modules")
 * @ORM\Entity(repositoryClass="App\Repository\EnchainementModuleRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class EnchainementModule
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sessionmoduleenchainements = new \Doctrine\Common\Collections\ArrayCollection();
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
	* @ORM\ManyToOne(targetEntity="App\Entity\Enchainement", inversedBy="enchainementmodules")
	*/
	private $enchainement;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Module")
	*/
	private $module;

                /**
        * @var int
        *
        * @ORM\Column(name="ordre", type="integer", nullable=true)
        */
        private $ordre;
        
	/**
	* @ORM\OneToMany(targetEntity="App\Entity\SessionModuleEnchainement", mappedBy="enchainementmodule")
	*/
	private $sessionmoduleenchainements;

	/**
	* @ORM\OneToMany(targetEntity="App\Entity\SessionModuleParcours", mappedBy="enchainementmodule")
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
     * @return EnchainementModule
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
     * @return EnchainementModule
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
     * Set enchainement
     *
     * @param \App\Entity\Enchainement $enchainement
     *
     * @return EnchainementModule
     */
    public function setEnchainement(\App\Entity\Enchainement $enchainement = null)
    {
        $this->enchainement = $enchainement;

        return $this;
    }

    /**
     * Get enchainement
     *
     * @return \App\Entity\Enchainement
     */
    public function getEnchainement()
    {
        return $this->enchainement;
    }

    /**
     * Set module
     *
     * @param \App\Entity\Module $module
     *
     * @return EnchainementModule
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
     * @return EnchainementModule
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
     * @return EnchainementModule
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
     * @return EnchainementModule
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
     * Add sessionmoduleenchainement
     *
     * @param \App\Entity\SessionModuleEnchainement $sessionmoduleenchainement
     *
     * @return EnchainementModule
     */
    public function addSessionmoduleenchainement(\App\Entity\SessionModuleEnchainement $sessionmoduleenchainement)
    {
        $this->sessionmoduleenchainements[] = $sessionmoduleenchainement;
		$sessionmoduleenchainement->setEnchainementmodule($this);
        return $this;
    }

    /**
     * Remove sessionmoduleenchainement
     *
     * @param \App\Entity\SessionModuleEnchainement $sessionmoduleenchainement
     */
    public function removeSessionmoduleenchainement(\App\Entity\SessionModuleEnchainement $sessionmoduleenchainement)
    {
        $this->sessionmoduleenchainements->removeElement($sessionmoduleenchainement);
    }

    /**
     * Get sessionmoduleenchainements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSessionmoduleenchainements()
    {
        return $this->sessionmoduleenchainements;
    }

    /**
     * Add sessionmoduleparcour
     *
     * @param \App\Entity\SessionModuleParcours $sessionmoduleparcour
     *
     * @return EnchainementModule
     */
    public function addSessionmoduleparcour(\App\Entity\SessionModuleParcours $sessionmoduleparcour)
    {
        $this->sessionmoduleparcours[] = $sessionmoduleparcour;
		$sessionmoduleparcour->setEnchainementmodule($this);
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
